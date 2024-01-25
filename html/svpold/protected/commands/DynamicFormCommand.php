<?php

class DynamicFormCommand extends CConsoleCommand {

    public function run($args) {
        Yii::import('application.models.*');
        Yii::import('application.models.basic.*'); 
        Yii::import('application.controllers.*');
        Yii::import('application.components.*');
        Yii::import('application.extensions.DynamicForm.*');


        $tusDatos = new DynamicForm();
        $tusDatos->getDynamicForm();
    }

    public function getHelp() {
        return "Usage: dynamicForm";
    }

    public function getName() {
        return "dynamicForm";
    }
}
