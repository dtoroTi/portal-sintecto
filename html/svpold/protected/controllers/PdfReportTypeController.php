<?php
require_once(Yii::app()->basePath . '/components/SvpTcPdf.php');

class PdfReportTypeController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';
    public $defaultAction = 'admin';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        /* @var $model PdfReportType */
        $model = $this->loadModel($id);
        if ($model) {
            $pdf = $model->getPdfReport(null);
            $pdf->Output('Rep_' . $model->name . '.pdf', 'I');
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new PdfReportType;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PdfReportType'])) {
            $model->attributes = $_POST['PdfReportType'];
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id, $section = '') {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PdfReportType'])) {
            $model->attributes = $_POST['PdfReportType'];
            if ($model->save()) {
                if (!isset($_POST['continue'])) {
                    $this->redirect(array('admin'));
                }
            }
        }

        if (in_array($section, array('header', 'footer', 'body'))) {
            $this->render('htmlSection', array(
                'model' => $model,
                'section' => $section,
            ));
        } else {
            $this->render('update', array(
                'model' => $model,
            ));
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        /* @var $model PdfReportType  */
        $model = GridViewFilter::getFilter('PdfReportType', 'search');

        if (isset($_GET['PdfReportType'])) {
            $model->attributes = $_GET['PdfReportType'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PdfReportType the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = PdfReportType::model()->findByPk($id);
        if ($model === null || (!Yii::app()->user->isSuperAdmin && !Yii::app()->user->getIsByRole()))
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PdfReportType $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pdf-report-type-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
