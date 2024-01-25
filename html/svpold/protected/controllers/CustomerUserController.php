<?php

class CustomerUserController extends Controller {

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
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new CustomerUser('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CustomerUser'])) {
            $model->attributes = $_POST['CustomerUser'];
            $model->setPassword($model->clearPassword1);
            if (trim($model->otp) != "") {
                $model->setOtpKey($model->otp);
            }

            if ($model->save()) {
                WebUser::logAccess("Creo un usuario de cliente :" . $model->username);
                $this->redirect(array('admin'));
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
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CustomerUser'])) {

            $model->attributes = $_POST['CustomerUser'];
            $passwordChanged = false;
            if ($model->clearPassword1 != "" && $model->clearPassword1 == $model->clearPassword2) {
                $model->setPassword($model->clearPassword1);
                $model->mustChangePassword = true;
                $passwordChanged = true;
            }
            if (trim($model->otp) != "") {
                $model->setOtpKey($model->otp);
            }

            if ($model->save()) {
                if ($passwordChanged) {
                    WebUser::logAccess("Le cambio el password al usuario de cliente :" . $model->username);
                    Yii::app()->user->setFlash('notification', 'Se ha cambiado la clave del usuario!');
                } else {
                    WebUser::logAccess("Modifico el usuario de cliente :" . $model->username);
                }
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            $customerUser = $this->loadModel($id);
            WebUser::logAccess("Borro el cliente de cliente :" . $customerUser->username);
            $customerUser->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = GridViewFilter::getFilter('CustomerUser', 'search');
        if (isset($_GET['CustomerUser']))
            $model->attributes = $_GET['CustomerUser'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return CustomerUser the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        if (Yii::app()->user->getIsByRole()) {
			return CustomerUser::model()->findByPk($id);
		}else if (Yii::app()->user->isAdmin) {
            $model = CustomerUser::model()->findByPk($id);
            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
            return $model;
        }else{
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    /**
     * Performs the AJAX validation.
     * @param CustomerUser $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'customer-user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionResetOtpG($id) {
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            // we only allow deletion via POST request
            $user = $this->loadModel($id);
            $user->otpGKey = '';
            $user->temporalOtpGKey = '';
            $user->save();
            $this->redirect(array('update', 'id' => $id));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionSendTestMail($id) {
        $customerUser = $this->loadModel($id);
        if ($customerUser && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())) {
            $date = new DateTime();
            Yii::app()->user->sendMailInBackground(
                    'Correo de Prueba (' . $date->format('Y-m-d H:i:s') . ')', //
                    'Este es un correo de prueba enviado desde el sistema.', //
                    array($customerUser->mailParam, Yii::app()->user->arUser->mailParam,) //
            );
        }
        echo json_encode(null);
    }

}
