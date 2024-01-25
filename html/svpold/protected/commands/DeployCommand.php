<?php

class DeployCommand extends CConsoleCommand {

    private function deploy($serverName, $args) {
        $userPath = Yii::app()->params['server'][$serverName]['userPath'];
        $fullBasePath = $userPath . Yii::app()->params['server'][$serverName]['basePath'];
        $serverUser = Yii::app()->params['server'][$serverName]['serverUser'];
        $devPath = Yii::app()->params['server']['dev']['userPath'] . Yii::app()->params['server']['dev']['basePath'];

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

        if (count($commands) > 0) {
            $com = implode(" && ", $commands);
            passthru("ssh {$serverUser}  \" {$com} \"");
        }
    }

    public function actionTest($args) {
        $this->deploy("test", $args);
    }

    public function actionTestLocal($args) {
        $this->deploy("testlocal", $args);
    }

    public function actionDemo($args) {
        $this->deploy("demo", $args);
    }

    public function actionOnline($args) {
        $this->deploy("online", $args);
    }

    public function getHelp() {
        return "Usage: \ndeploy test\ndeploy online \ndeploy demo\n";
    }

    public function getName() {
        return "deploy";
    }

}
