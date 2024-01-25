<?php

class UpdateYiiCommand extends CConsoleCommand {

    private function localUpdate($tag) {
        $serverName = Yii::app()->params['serverName'];
        $userPath = Yii::app()->params['server'][$serverName]['userPath'];
        $fullBasePath = $userPath . Yii::app()->params['server'][$serverName]['basePath'];
        $yiiPath = $userPath . Yii::app()->params['server'][$serverName]['yiiPath'];
        $yiifwPath = $userPath . Yii::app()->params['server'][$serverName]['yiifwPath']."/{$tag}";

        $commands = array(
            "( mkdir --mode=0700 -p " . $yiifwPath  . ") ",
            "( svn checkout  https://github.com/yiisoft/yii/tags/{$tag} {$yiifwPath}  ) ",
            "( rm -rf {$yiiPath} ) ",
            "( ln -s {$yiifwPath} {$yiiPath} ) ",
            "( rm -rf " . $fullBasePath . "assets/* ) ",
        );
        $com = implode(" && ", $commands);
        passthru($com);
    }

    public function run($args) {
        if (count($args) == 1) {
            $this->localUpdate($args[0]);
        } else if (count($args)==2){
            $serverName = "";

            if (count($args) == 2 && $args[1] == "test") {
                $serverName = "test";
            } else if (count($args) == 2 && $args[1] == "online") {
                $serverName = "online";
            }
            if ($serverName != "") {
                $userPath = Yii::app()->params['server'][$serverName]['userPath'];
                $fullBasePath = $userPath . Yii::app()->params['server'][$serverName]['basePath'];
                $serverUser = Yii::app()->params['server'][$serverName]['serverUser'];
                $commands = array(
                    "( /usr/bin/php {$fullBasePath}protected/yiic.php updateYii {$args[0]} ) ",
                );
                $com = implode(" && ", $commands);
                passthru("ssh {$serverUser}  \" {$com} \" ");
            }
        }else{
            print $this->help."\n";
        }
    }

    public function getHelp() {
        return "Usage: \nupdateYii <tag> [<server>]";
    }

    public function getName() {
        return "updateYii";
    }

}