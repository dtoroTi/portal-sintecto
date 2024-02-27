<?php

/**
 * Clase ReportCommand
 * 
 * Este comando maneja la generación de informes.
 */
class ReportCommand extends CConsoleCommand {

    /**
     * Ejecuta la generación de informes.
     *
     * @param array $args Argumentos pasados al comando.
     */
    public function run($args) {
        // Importa las clases necesarias.
        Yii::import('application.models.*');
        Yii::import('application.models.basic.*');
        Yii::import('application.controllers.*');
        Yii::import('application.components.*');

        // Instancia el controlador de informes y ejecuta los métodos de generación de informes.
        $controller = new BackgroundCheckReportController('default');
        $controller->dailyReport();
        $controller->productionReport();
    }

    /**
     * Obtiene el mensaje de ayuda para el comando report.
     *
     * @return string El mensaje de ayuda.
     */
    public function getHelp() {
        return "Usage: \mailreport";
    }

    /**
     * Obtiene el nombre del comando report.
     *
     * @return string El nombre del comando.
     */
    public function getName() {
        return "report";
    }

}
