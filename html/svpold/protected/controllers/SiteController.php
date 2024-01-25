<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
// captcha action renders the CAPTCHA image displayed on the contact page
              'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor' => 0xFFFFFF, // Color de fondo
                'foreColor' => 0x0277BC,
                'minLength' => 6, // El más corto es de 4 dígitos
                'maxLength' => 6, // tiene 4 dígitos
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
// They can be accessed via: index.php?r=site/page&view=FileName
           'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
// renders the view file 'protected/views/site/index.php'
// using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionHelp() {
// renders the view file 'protected/views/site/index.php'
// using the default layout 'protected/views/layouts/main.php'
        $this->render('help');
    }

    
    public function actionInstructive() {        
        $this->render('instructive');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionLogin() {
        $model = new LoginForm;

// if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

// collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
// validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                if (trim($model->otp) != "") {
                    WebUser::logAccess("Aceptó terminos y condiciones");
                    WebUser::logAccess(" - Ingreso al sistema con la llave de seguridad : " . substr($model->otp, 0, 12));
                } else {
                    WebUser::logAccess("Aceptó terminos y condiciones");
                    WebUser::logAccess(" - Ingreso al sistema");
                }
                if (Yii::app()->user->arUser->mustChangePassword) {
                    $this->redirect(array('/site/changePassword'));
                } else {
                    $this->redirect(array('/user/myPendingReports'));
                }
            }
        }
// display the login form

        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionChangePassword() {
        $form = new ChangePasswordForm;
// collect user input data

        if (isset($_POST['ChangePasswordForm'])) {
            $form->attributes = $_POST['ChangePasswordForm'];
// validate user input and redirect to previous page if valid
            if ($form->validate()) {
                $user = User::model()->findByPk(Yii::app()->user->getId());
                $user->setPassword($form->newPassword1);
                $user->mustChangePassword = false;
                if (!$user->save()) {
                    WebUser::logAccess("Error en el Cambio de password");
                    Yii::log(__FILE__ . "[" . __LINE__ . "]Error in password change : " . serialize($user->errors), "error", "ZWF." . __CLASS__);
                } else {
                    Yii::app()->user->setFlash('success', 'La palabra clave del usuario ha sido cambiada.');
                    WebUser::logAccess("Cambio de password");
                }
            }
        }
// display the login form
        $this->render('changePassword', array('form' => $form));
    }

    public function actionChangeOtp() {
        $user = Yii::app()->user->arUser;

        if ($user->temporalOtpGKey == '') {
            $user->temporalOtpGKey = $user->getNewOtpGKey();
            $user->save();
        }

        if (isset($_POST['validate'])) {
            $otpCode = CHtml::encode($_POST['otpCode']);
            if ($user->validateOtpGKey($otpCode, $user->temporalOtpGKey)) {
                $user->otpGKey = $user->temporalOtpGKey;
                $user->temporalOtpGKey = '';
                if (!$user->save()) {
                    Yii::app()->user->setFlash('error', 'No se pudo validar.');
                    WebUser::logAccess("Error en la autenticación de OTP");
                } else {
                    Yii::app()->user->setFlash('success', 'Se valido el Código de ingreso.');
                    WebUser::logAccess("Válido el OTP");
                }
            } else {
                Yii::app()->user->setFlash('error', 'Error en el código de validación.');
                WebUser::logAccess("Error en la autenticación de OTP");
            }
        }
// display the login form
        $this->render('changeOtpG', array('qrCode' => $user->getOtpGQrTemporalImage()));
    }

    public function actionImage($filename) {
        if (Yii::app()->user->isValidUser) {
            $fileUrl = Yii::app()->basePath . '/images/' . CHtml::encode($filename);
            if (file_exists($fileUrl)) {
                $filename = basename($fileUrl);
                $file_extension = strtolower(substr(strrchr($filename, "."), 1));

                switch ($file_extension) {
                    case "gif": $ctype = "image/gif";
                        break;
                    case "png": $ctype = "image/png";
                        break;
                    case "jpeg":
                    case "jpg": $ctype = "image/jpeg";
                        break;
                    default:
                }

                header('Content-type: ' . $ctype);

                header('Content-transfer-encoding: binary');
                header('Content-length: ' . filesize($fileUrl));
                readfile($fileUrl);
                die();
            }
        } else {
            return;
        }
    }

    public function actionChangePdfPassword() {

// collect user input data
        $user = Yii::app()->user->arUser;

        if (isset($_POST['User'])) {
            $user->pdfPassword = $_POST['User']['pdfPassword'];
            $user->pdfPasswordChangedOn = new CDbExpression('NOW()');
// validate user input and redirect to previous page if valid
            if (!$user->save()) {
                Yii::log(__FILE__ . "[" . __LINE__ . "]Error in pdf password change" . serialize($user->errors), "error", "ZWF." . __CLASS__);
            } else {
                Yii::app()->user->setFlash('success', 'La palabra clave para PDF ha sido cambiada.');
                WebUser::logAccess("Cambio la palabra clave de PDF con exito.");
            }
        }
// display the login form
        $this->render('changePdfPassword', array('user' => $user));
    }

}
