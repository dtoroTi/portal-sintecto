<?php

class BackupCommand extends CConsoleCommand {

    private function localBackup() {
        $serverName = Yii::app()->params['serverName'];
        $userPath = Yii::app()->params['server'][$serverName]['userPath'];
        $fullBasePath = $userPath . Yii::app()->params['server'][$serverName]['basePath'];
        $fullBackupPath = $userPath . Yii::app()->params['server'][$serverName]['backupPath'];
        $filename = date("Ymd_His");
        $backupFileName = $fullBackupPath . $serverName . "_" . $filename;

        $conString = Yii::app()->db->connectionString;
        preg_match("/dbname\=(?<dbname>\w+)/", $conString, $match);
        $dbname = $match["dbname"];

        $commands = array(
            "( mkdir --mode=0700 -p " . $fullBackupPath  . ") ",
            "( tar -cvzf " . $backupFileName . ".tgz " . $fullBasePath . ") ",
            "( mysqldump -u " . Yii::app()->db->username . " -p" . Yii::app()->db->password . " " . $dbname . " > " . $backupFileName . ".sql ) ",
            "( gzip " . $backupFileName . ".sql ) ",
        );
        $com = implode(" && ", $commands);
        passthru($com);
    }

    public function run($args) {
        if (count($args) == 0) {
            $this->localBackup();
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
                    "( /usr/bin/php {$fullBasePath}protected/yiic.php backup ) ",
                );
                $com = implode(" && ", $commands);
                passthru("ssh {$serverUser}  \" {$com} \" ");
            }
        }
    }

    public function getHelp() {
        return "Usage: \nbackup ";
    }

    public function getName() {
        return "backup";
    }

}