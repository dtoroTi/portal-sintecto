<?php

/**
 * Clase SendMasiveFDCommand
 * 
 * Este comando se encarga de enviar correos masivos.
 */
class SendMasiveFDCommand extends CConsoleCommand {

/**
 * Ejecuta el envío de correos masivos.
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

    // Crea una instancia del controlador de Contacto.
    $controlador = new ContactController('default');

    // Procesa el envío de correos masivos.
    $controlador->processSendMail();
}

/**
 * Obtiene el mensaje de ayuda para el comando sendMasiveFD.
 *
 * @return string El mensaje de ayuda.
 */
public function getHelp() {
    return "Usage: \mailsendMasiveFD";
}

/**
 * Obtiene el nombre del comando sendMasiveFD.
 *
 * @return string El nombre del comando.
 */
public function getName() {
    return "sendMasiveFD";
}

}