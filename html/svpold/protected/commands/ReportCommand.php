<?php

class ReportCommand extends CConsoleCommand {

    public function run($args) {
        Yii::import('application.models.*');
        Yii::import('application.models.basic.*');
        Yii::import('application.controllers.*');
        Yii::import('application.components.*');

        $controller = new BackgroundCheckReportController('default');
        $controller->dailyReport();
        $controller->productionReport();
    }

    public function getHelp() {
        return "Usage: \mailreport";
    }

    public function getName() {
        return "report";
    }

}
