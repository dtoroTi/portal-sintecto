<?php
//require_once(dirname(__FILE__) .'/../../../../conf/conf.php');
//require_once(dirname(__FILE__) .'/../config/main.php');

// change the following paths if necessary
//$yii = dirname(__FILE__) . '/../yii1/framework/yii.php';
//$config = dirname(__FILE__) . '/protected/config/main.php';

class TusDatosCommand extends CConsoleCommand {

    public function run($args) {
        Yii::import('application.models.*');
        Yii::import('application.models.basic.*');
        Yii::import('application.controllers.*');
        Yii::import('application.components.*');
        Yii::import('application.extensions.TusDatos.*');

        $tusDatos = new TusDatos();
        $tusDatos->getTusDatosPending();
    }

    public function getHelp() {
        return "Usage: tusDatos";
    }

    public function getName() {
        return "tusDatos";
    }

}
