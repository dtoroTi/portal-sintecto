<?php

/**
 * Clase DeployCommand
 *
 * Esta clase maneja operaciones de despliegue.
 */
class DeployCommand extends CConsoleCommand {

    /**
     * Despliega archivos y realiza operaciones adicionales en el servidor especificado.
     *
     * @param string $serverName El nombre del servidor.
     * @param array $args Argumentos adicionales.
     */
    private function deploy($serverName, $args) {
        $userPath = Yii::app()->params['server'][$serverName]['userPath'];
        $fullBasePath = $userPath . Yii::app()->params['server'][$serverName]['basePath'];
        $serverUser = Yii::app()->params['server'][$serverName]['serverUser'];
        $devPath = Yii::app()->params['server']['dev']['userPath'] . Yii::app()->params['server']['dev']['basePath'];

        // Ejecuta el comando rsync para desplegar archivos.
        passthru('rsync -vr -L --delete ' .
                '--exclude ".svn"  ' .
                '--exclude ".git"  ' .
                '--exclude ".hg"  ' .
                '--exclude "/assets/*" ' .
                '--exclude "/protected/runtime/*" ' .
                '--exclude "/temp/*" ' .
                '--exclude "/tests/*" ' .
                '--exclude "/index-test.php" ' .
//            '--exclude "/DumpDataCommand.php" ' .
//            '--exclude "InitialData.php" ' .
//            '--exclude "TestData.php" ' .
//            '--exclude "/data/*" ' .
                '--exclude "/.buildpath" ' .
                '--exclude ".settings" ' .
                '--exclude ".yii" ' .
                '--exclude "test.php" ' .
                '--exclude "._.DS_Store" ' .
                '--exclude ".DS_Store" ' .
                '--exclude "*.log" ' .
                '--perms ' .
                "{$devPath} " .
                "{$serverUser}:{$fullBasePath}");

        // Ejecuta comandos adicionales basados en argumentos.
        $commands = array();
        $commands[] = "( rm -rf " . $fullBasePath . "assets/* ) ";
        foreach ($args as $arg) {
            switch (strtolower($arg)) {
                case 'up':
                case 'down':
                    $commands [] = "( /usr/bin/php " . $fullBasePath . "protected/yiic.php migrate " . strtolower($arg) . ") ";
                    break;
            }
        }

        // Ejecuta comandos adicionales mediante SSH.
        if (count($commands) > 0) {
            $com = implode(" && ", $commands);
            passthru("ssh {$serverUser}  \" {$com} \"");
        }
    }

    /**
     * Despliega en el servidor de prueba.
     *
     * @param array $args Argumentos adicionales.
     */
    public function actionTest($args) {
        $this->deploy("test", $args);
    }

    /**
     * Despliega en el servidor de prueba local.
     *
     * @param array $args Argumentos adicionales.
     */
    public function actionTestLocal($args) {
        $this->deploy("testlocal", $args);
    }

    /**
     * Despliega en el servidor de demostración.
     *
     * @param array $args Argumentos adicionales.
     */
    public function actionDemo($args) {
        $this->deploy("demo", $args);
    }

    /**
     * Despliega en el servidor en línea.
     *
     * @param array $args Argumentos adicionales.
     */
    public function actionOnline($args) {
        $this->deploy("online", $args);
    }

    /**
     * Obtiene el mensaje de ayuda para el comando de despliegue.
     *
     * @return string El mensaje de ayuda.
     */
    public function getHelp() {
        return "Usage: \ndeploy test\ndeploy online \ndeploy demo\n";
    }

    /**
     * Obtiene el nombre del comando.
     *
     * @return string El nombre del comando.
     */
    public function getName() {
        return "deploy";
    }

}
