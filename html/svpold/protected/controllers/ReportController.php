<?php

class ReportController extends Controller {

  public $defaultAction = 'pie';

  public function actionPieStudiesResult() {

    $backgroundCheck = GridViewFilter::getFilter('BackgroundCheck', 'search');
    if (isset($_GET['BackgroundCheck'])) {
      $backgroundCheck->attributes = $_GET['BackgroundCheck'];
    }

    if (!Yii::app()->user->isAdmin) {
      $backgroundCheck->assignedUserId = Yii::app()->user->id;
    }

    if ($backgroundCheck->assignedUserId > 0) {
      $withAssignedUser = true;
    } else {
      $withAssignedUser = false;
    }

    $data = $backgroundCheck->getResultSummary($withAssignedUser);
    Yii::app()->clientScript->registerScriptFile('https://www.google.com/jsapi');
    $this->render('pieStudiesStatus', array('data' => $data, 'model' => $backgroundCheck));
  }

  public function actionBarStudiesResult() {

    $backgroundCheck = GridViewFilter::getFilter('BackgroundCheck', 'search');
    if (isset($_GET['BackgroundCheck'])) {
      $backgroundCheck->attributes = $_GET['BackgroundCheck'];
    }

    if (!Yii::app()->user->isAdmin) {
      $backgroundCheck->assignedUserId = Yii::app()->user->id;
    }

    if ($backgroundCheck->assignedUserId > 0) {
      $withAssignedUser = true;
    } else {
      $withAssignedUser = false;
    }

    $data = $backgroundCheck->getResultSummaryByMonth($withAssignedUser);
    Yii::app()->clientScript->registerScriptFile('https://www.google.com/jsapi');
    $this->render('barStudiesStatus', array('data' => $data, 'model' => $backgroundCheck));
  }

  public function actionBarStudiesResultByCustomer() {

    $backgroundCheck = GridViewFilter::getFilter('BackgroundCheck', 'search');
    if (isset($_GET['BackgroundCheck'])) {
      $backgroundCheck->attributes = $_GET['BackgroundCheck'];
    }

    if (!Yii::app()->user->isAdmin) {
      $backgroundCheck->assignedUserId = Yii::app()->user->id;
    }

    if ($backgroundCheck->assignedUserId > 0) {
      $withAssignedUser = true;
    } else {
      $withAssignedUser = false;
    }

    $data = $backgroundCheck->getResultSummaryByCustomer($withAssignedUser);
    Yii::app()->clientScript->registerScriptFile('https://www.google.com/jsapi');
    $this->render('barStudiesStatusByCustomer', array('data' => $data, 'model' => $backgroundCheck));
  }


  public function actionStudiesResultByCustomerReportType() {

    $backgroundCheck = GridViewFilter::getFilter('BackgroundCheck', 'search');
    if (isset($_GET['BackgroundCheck'])) {
      $backgroundCheck->attributes = $_GET['BackgroundCheck'];
    }

    if (!Yii::app()->user->isAdmin) {
      $backgroundCheck->assignedUserId = Yii::app()->user->id;
    }

    if ($backgroundCheck->assignedUserId > 0) {
      $withAssignedUser = true;
    } else {
      $withAssignedUser = false;
    }

    $data = $backgroundCheck->getResultSummaryByCustomerReportType($withAssignedUser);
    Yii::app()->clientScript->registerScriptFile('https://www.google.com/jsapi');
    $this->render('studiesStatusByCustomerReportType', array('data' => $data, 'model' => $backgroundCheck));
  }

}
