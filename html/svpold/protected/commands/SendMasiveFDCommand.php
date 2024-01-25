<?php

class SendMasiveFDCommand extends CConsoleCommand {

public function run($args) {
    Yii::import('application.models.*');
    Yii::import('application.models.basic.*');
    Yii::import('application.controllers.*');
    Yii::import('application.components.*');
    Yii::import('application.extensions.DynamicForm.*');

    //$controller = new BackgroundCheckReportController('default');
    $controlador = new ContactController('default');
    $controlador->processSendMail();
}

public function getHelp() {
    return "Usage: \mailsendMasiveFD";
}

public function getName() {
    return "sendMasiveFD";
}

}