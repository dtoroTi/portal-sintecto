<?php

class RotateLogCommand extends CConsoleCommand {

    public function run($args) {
        Yii::import('application.models.*');
        Yii::import('application.models.basic.*');
        Yii::import('application.controllers.*');
        Yii::import('application.components.*');

        $date = new DateTime('now', timezone_open('America/Bogota'));
        // only maitain 15 days of actual log
        $date->sub(new DateInterval('P30D'));

        $until = $date->format('Y-m-d');
        $sql = "insert {{OldLog}} select * from {{Log}} l where l.created <'{$until}'";
        $ans = Yii::app()->db->createCommand($sql)->execute();
        if ($ans>0) {
            print "inserted {$ans} rows\n";
            $sql = "delete from {{Log}} where created <'{$until}'";
            $ans = Yii::app()->db->createCommand($sql)->execute();
            print "deleted {$ans} rows\n";
        }
    }

    public function getHelp() {
        return "Usage: \rotateLog";
    }

    public function getName() {
        return "rotateLog";
    }

}
