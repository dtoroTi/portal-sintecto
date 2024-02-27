<?php

/**
 * Clase para realizar copias de seguridad.
 */
class BackupCommand extends CConsoleCommand {
    /**
     * Realiza una copia de seguridad local.
     *
     * @param bool $fullDb Indica si se debe realizar una copia completa de la base de datos.
     * @return void
     */

    private function localBackup($fullDb) {
        // Contenido del método...
        $serverName = Yii::app()->params['serverName'];
        $userPath = Yii::app()->params['server'][$serverName]['userPath'];
        $fullBasePath = $userPath . Yii::app()->params['server'][$serverName]['basePath']."../";
        $fullBackupPath = $userPath . Yii::app()->params['server'][$serverName]['backupPath'];

        $timeZone = new DateTimeZone('America/Bogota');
        $now = new DateTime('now', $timeZone);
        $fromDate = new DateTime("first day of this month  00:00:00", $timeZone);
        $fromDate->modify("first day of previous month 00:00:00");

        $filename = $now->format("Ymd_His");
        $fromDateStr = $fromDate->format("Y-m-d");

        $backupFileName = $fullBackupPath . $serverName . "_" . $filename;
        $OldLogBackupFileName = $fullBackupPath . $serverName . "_OldLog_Until_" . $fromDate->format("Y_m_d");

        $conString = Yii::app()->db->connectionString;
        preg_match("/dbname\=(?<dbname>\w+)/", $conString, $match);
        $dbname = $match["dbname"];

        $commandsTar = array();
        $commandsDB = array();
        $commandsTar = array(
            "( mkdir --mode=0700 -p " . $fullBackupPath . ") ",
            "( tar -czf {$backupFileName}.tgz   " .
            "--exclude='*/projects/svp/*/assets/*'  " .
            "--exclude='*/projects/svp/svp/files/*'  " .
            "--exclude='*/projects/svp/*/protected/runtime/*'" .
            "   {$fullBasePath}svp/ {$fullBasePath}ses/) ",
            "( openssl enc -aes-256-cbc -pass 'file:" . dirname(__FILE__) . "/../../../conf/.backup" . "' -in {$backupFileName}.tgz -out {$backupFileName}.tgz.enc  ) ",
            "( rm {$backupFileName}.tgz ) ",
        );
        $commandsDB = array(
            "( mysqldump -u " . Yii::app()->db->username . " -p" . Yii::app()->db->password .
            " --ignore-table=" . $dbname . ".ses_OldLog  " . $dbname . " > " . $backupFileName . ".sql ) ",
            "( mysqldump -u " . Yii::app()->db->username . " -p" . Yii::app()->db->password .
            " --databases {$dbname} --tables ses_OldLog --where=\"created>='" . $fromDateStr . "'\" >> {$backupFileName}.sql ) ",
            "( gzip {$backupFileName}.sql ) ",
            "( openssl enc -aes-256-cbc -pass 'file:" . dirname(__FILE__) . "/../../../conf/.backup" . "' -in {$backupFileName}.sql.gz -out {$backupFileName}.sql.gz.enc  ) ",
            "( rm {$backupFileName}.sql.gz ) ",
        );
        if ($fullDb) {
            $extraCommands = array(
                "( mysqldump -u " . Yii::app()->db->username . " -p" . Yii::app()->db->password .
                " --databases {$dbname} --no-create-info --tables ses_OldLog --where=\"created<'" . $fromDateStr . "'\" >  {$OldLogBackupFileName}.sql ) ",
                "( rm -f {$OldLogBackupFileName}.sql.gz ) ",
                "( gzip {$OldLogBackupFileName}.sql ) ",
                "( openssl enc -aes-256-cbc -pass 'file:" . dirname(__FILE__) . "/../../../conf/.backup" . "' -in {$OldLogBackupFileName}.sql.gz -out {$OldLogBackupFileName}.sql.gz.enc  ) ",
                "( rm {$OldLogBackupFileName}.sql.gz ) ",
            );
        } else {
            $extraCommands = array();
        }
        $commands = array_merge($commandsTar, $commandsDB, $extraCommands);
        $com = implode(" && ", $commands);
        passthru($com);
    }

    /**
     * Ejecuta el comando de copia de seguridad.
     *
     * @param array $args Argumentos pasados al comando.
     * @return void
     */
    public function run($args) {
        // Contenido del método...
        $onlyDb = false;
        if (count($args) > 0 && $args[count($args) - 1] == "fullDb") {
            $onlyDb = true;
            unset($args[count($args) - 1]);
        }
        if (count($args) == 0) {
            $this->localBackup($onlyDb);
        } else {
            $serverName = "";
            if (count($args) == 1 && $args[0] == "test") {
                $serverName = "test";
            } else if (count($args) == 1 && $args[0] == "online") {
                $serverName = "online";
            }
            if ($serverName != "") {
                $userPath = Yii::app()->params['server'][$serverName]['userPath'];
                $fullBasePath = $userPath . Yii::app()->params['server'][$serverName]['basePath'];
                $serverUser = Yii::app()->params['server'][$serverName]['serverUser'];
                $commands = array(
                    "( /usr/bin/php {$fullBasePath}protected/yiic.php backup " . ($onlyDb ? "fullDb" : "") . ") ",
                );
                $com = implode(" && ", $commands);
                passthru("ssh {$serverUser}  \" {$com} \" ");
            }
        }
    }

    /**
     * Obtiene la ayuda para el comando.
     *
     * @return string La ayuda para el comando.
     */
    public function getHelp() {
        return "Usage: \nbackup [server] [fullDb]\n";
    }

    /**
     * Obtiene el nombre del comando.
     *
     * @return string El nombre del comando.
     */

    public function getName() {
        return "backup";
    }

}
