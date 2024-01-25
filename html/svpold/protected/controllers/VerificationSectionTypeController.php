<?php
require_once(Yii::app()->basePath . '/components/SvpTcPdf.php');

class VerificationSectionTypeController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';
    public $defaulAction = 'admin';

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new VerificationSectionType;

        $model->class = 'XmlSection';
        $model->fieldId = 'xmlSection';

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['VerificationSectionType'])) {
            $model->attributes = $_POST['VerificationSectionType'];
            if ($model->save()) {
                WebUser::logAccess("Creo la sección : {$model->name}");
                if (!isset($_POST['continue'])) {
                    $this->redirect(array('admin'));
                } else {
                    $this->redirect(array('update', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateHtml() {
        $model = new VerificationSectionType;

        $model->class = 'HtmlSection';
        $model->fieldId = 'htmlSection';

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['VerificationSectionType'])) {
            $model->attributes = $_POST['VerificationSectionType'];
            if ($model->save()) {
                WebUser::logAccess("Creo la sección : {$model->name}");
                if (!isset($_POST['continue'])) {
                    $this->redirect(array('admin'));
                } else {
                    $this->redirect(array('update', 'id' => $model->id));
                }
            }
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

        if (isset($_POST['VerificationSectionType'])) {
            $model->attributes = $_POST['VerificationSectionType'];
            if ($model->save() && !isset($_POST['continue'])) {
                $this->redirect(array('admin'));
            }
            WebUser::logAccess("Modificó la sección : {$model->name}");
        }
        if (in_array($section, array('htmlSection'))) {
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
     * Manages all models.
     */
    public function actionAdmin() {
        $model = GridViewFilter::getFilter('VerificationSectionType', 'search');

        if (isset($_GET['VerificationSectionType']))
            $model->attributes = $_GET['VerificationSectionType'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            $model = VerificationSectionType::model()->findByPk($id);
            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
            return $model;
        }else{
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'verification-section-type-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
// we only allow deletion via POST request

            $model = $this->loadModel($id);
            if ($model->isXmlSection || $model->isHtmlSection) {
                $model->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if (!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

}
