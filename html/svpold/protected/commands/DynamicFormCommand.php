<?php

/**
 * Clase DynamicFormCommand
 * 
 * Este comando maneja la generación de formularios dinámicos.
 */
class DynamicFormCommand extends CConsoleCommand {

    /**
     * Ejecuta la generación de un formulario dinámico.
     *
     * @param array $args Argumentos pasados al comando.
     */
    public function run($args) {
        // Importa las clases necesarias.
        Yii::import('application.models.*');
        Yii::import('application.models.basic.*'); 
        Yii::import('application.controllers.*');
        Yii::import('application.components.*');
        Yii::import('application.extensions.DynamicForm.*');

        // Instancia y obtiene el formulario dinámico.
        $tusDatos = new DynamicForm();
        $tusDatos->getDynamicForm();
    }

    /**
     * Obtiene el mensaje de ayuda para el comando dynamicForm.
     *
     * @return string El mensaje de ayuda.
     */
    public function getHelp() {
        return "Usage: dynamicForm";
    }

    /**
     * Obtiene el nombre del comando dynamicForm.
     *
     * @return string El nombre del comando.
     */
    public function getName() {
        return "dynamicForm";
    }
}
