<?php

use mageekguy\atoum\asserters\dateTime;

class SiteController extends Controller {

    public $defaultAction = "login";

    
    public function actions() {
        return array(
                // captcha action renders the CAPTCHA p_w_picpath displayed on the contact page
                'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor' => 0xFFFFFF, // Color de fondo
                'foreColor' => 0x0277BC,
                'minLength' => 6, // El más corto es de 4 dígitos
                'maxLength' => 6, // tiene 4 dígitos
            ),
            );
    }
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIntro() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('intro');
    }

    private function getDates(){
        
        $dateAct = new \DateTime(" "); //'first day of this Month'
        $FechaActual=$dateAct->format('Y-m-d');
        
        if (!empty($_POST["Desde"]) && !empty($_POST["Hasta"])) {
            $fromDate = (new \DateTime(CHtml::encode($_POST['Desde'])))->format('Y-m-d');
            $untilDate = (new \DateTime(CHtml::encode($_POST['Hasta'])))->format('Y-m-d');
        } else {

            //first Year, Month and day del año en curso
            //$year_start = strtotime('first day of January', time());
            $date1 = new \DateTime("first day of January");
            $fromDate=$date1->format('Y-m-d');

            $date2 = new \DateTime(" "); //'first day of this Month'
            $untilDate=$date2->format('Y-m-d');
        }
        return ['fromDate'=>$fromDate, 'untilDate'=>$untilDate, 'fechaActual'=>$FechaActual];
    }

    private function validateUserAccessToCompliance(){
        if(Yii::app()->user->termsAccepted and Yii::app()->user->arUser->compliance==0){
            $this->redirect('/site/intro');
        }
    }

    private function getCustomerUs(){
        $customerUsr=Yii::app()->user->arUser;
        if(!$customerUsr || !$customerUsr->customerId){
            $this->redirect('/site/intro');
        }else{
            return $customerUsr;
        }
    }

    public function actionFormularioCompliance() {

        $this->validateUserAccessToCompliance();
        
        $dates=$this->getDates();
        $customerUs = $this->getCustomerUs();
        //$customerUser = Yii::app()->user->arUser->customerId;

        //Natalia Henao 
        //funciones para traer consultas proceso dashboard
        $NumStudytotal = $customerUs->getCountStatusStudy($dates['fromDate'], $dates['untilDate']);  
        $RiesgoSarlaft = $customerUs->getXMLsection($dates['fromDate'], $dates['untilDate']);
        $totalNot = $customerUs->getAllNovedades($dates['fechaActual']);

        $totalTipoSecciones = $customerUs->getVerificationsetionsInDates($dates['fromDate'], $dates['untilDate']);
        $totalsec=0;
        foreach ($totalTipoSecciones as $totals){
            $totalsec+=$totals['Total_Secciones'];
        }
        $totalSecciones[]=['Total_Secciones'=>$totalsec]; 

        //Natalia Henao 
        //proceso para llamar funcion que consume la informacion de la API tus datos
        if (!empty($_POST['documento']) && !empty($_POST['criteriotd'])) {
            
            $documento=CHtml::encode($_POST['documento']);
            $criteriotd=CHtml::encode($_POST['criteriotd']);

            if(!empty($_POST['fecha_expedicion'])){
                $fecha_expedicion=(new \DateTime(CHtml::encode($_POST['fecha_expedicion'])))->format('Y-m-d');
            }else{
                $fecha_expedicion=NULL;
            }
            

            $customerUs->getApiTusDatos($documento, $criteriotd, $fecha_expedicion);
        }

        $user=Yii::app()->user->arUser->customer->businessLine;
        if($user=="Ev.Terceros"){

            //Render Nuevo Formulario Compliance Cumplimiento
            $this->render('formularioCompliance',array('customerUser'=>$customerUs->customerId, 
            'NumStudytotal' => $NumStudytotal,'RiesgoSarlaft' => $RiesgoSarlaft, 
            'totalNot' => $totalNot, 'totalSecciones' => $totalSecciones,
            'totalTipoSecciones' => $totalTipoSecciones, 'Desde' => $dates['fromDate'], 'Hasta' => $dates['untilDate']));  

        }else if($user=="Integridad"){

            //llamada consulta proceso de integridad
            $resultforstudy = $customerUs->getResultStudy($dates['fromDate'], $dates['untilDate']);  
            $detaillimitdaysStudy = $customerUs->getDaysfortimestudy($dates['fromDate'], $dates['untilDate']);
            $totalNotIn = $customerUs->getAllNovedadesIn($dates['fechaActual']);

            //Render Nuevo Formulario Compliance Integridad
            $this->render('formularioComplianceIn',array('customerUser'=>$customerUs->customerId, 
            'NumStudytotal' => $NumStudytotal,'RiesgoSarlaft' => $RiesgoSarlaft, 
            'totalNot' => $totalNotIn, 'totalSecciones' => $totalSecciones,
            'totalTipoSecciones' => $totalTipoSecciones, 'resultforstudy'=>$resultforstudy, 'detaillimitdaysStudy'=>$detaillimitdaysStudy, 'Desde' => $dates['fromDate'], 'Hasta' => $dates['untilDate']));  
        }
    }

    //Natalia Henao 
    //funcion para ver el detallado de las secciones en este periodo (Integridad y Cumplimiento).
    public function actionDetailSections(){
        $this->validateUserAccessToCompliance();
        $fromDate = CHtml::encode($_POST['from']);
        $untilDate = CHtml::encode($_POST['until']);
        
        $customerUs = $this->getCustomerUs();
        //$customerUs = Yii::app()->user->arUser;
        $detalleSeccion = $customerUs->getBackgroundchecksInDates($fromDate, $untilDate);

        header('Content-type: application/json');
        echo CJSON::encode($detalleSeccion);    
        Yii::app()->end();
    }

    //Natalia Henao 
    //funcion para ver el detallado de las notificaciones en este periodo (cumplimiento).
    public function actionDetailNotifications(){
        $this->validateUserAccessToCompliance();
        $dateAct = new \DateTime(" "); //'first day of this Month'
        $FechaActual=$dateAct->format('Y-m-d');
        
        $customerUs = $this->getCustomerUs();
        //$customerUs = Yii::app()->user->arUser;
        $notificaciones = $customerUs->getDetalleAllNovedades($FechaActual);

        header('Content-type: application/json');
        echo CJSON::encode($notificaciones);    
        Yii::app()->end();
    }

     //Natalia Henao 
    //funcion para ver el detallado de las notificaciones en este periodo (Integridad).
    public function actionDetailNotificationsIn(){
        $this->validateUserAccessToCompliance();
        $dateAct = new \DateTime(" "); //'first day of this Month'
        $FechaActual=$dateAct->format('Y-m-d');
        
        $customerUs = $this->getCustomerUs();
        $notificacionesIn = $customerUs->getDetalleAllNovedadesIn($FechaActual);

        header('Content-type: application/json');
        echo CJSON::encode($notificacionesIn);    
        Yii::app()->end();
    }


    //Natalia Henao 
    //funcion para ver el detallado de los estudios en este periodo (Integridad-colaboradores y cumplimiento-Todos Tipos estudio).
    public function actionDetailStudy(){
        $this->validateUserAccessToCompliance();
        $fromDate = CHtml::encode($_POST['from']);
        $untilDate = CHtml::encode($_POST['until']);

        if(!empty($_POST['typeStudy'])){
            $typeStudy=CHtml::encode($_POST['typeStudy']);
        }else{
            $typeStudy=null;
        }

        $customerUs = $this->getCustomerUs();
        $NumStudytotaldetalle = $customerUs->getAllDetailStudy($fromDate, $untilDate, $typeStudy); 

        header('Content-type: application/json');
        echo CJSON::encode($NumStudytotaldetalle);    
        Yii::app()->end();
    }

    //Natalia Henao 
    //Descargar PDF de tus datos (cumplimiento)
    public function actionDescargaPDF() {
        $this->validateUserAccessToCompliance();
        $id=$_GET['valor'];
        $doc=$_GET['doc'];
        $typeid=$_GET['type'];
        $customerid = Yii::app()->user->arUser->customerId;

        echo $this->renderPartial('DescargaPDF',array('id'=>$id, 'doc'=>$doc, 'customerId'=>$customerid, 'typeid'=>$typeid));
    }
    
    //Natalia Henao 
    //Exportar archivo csv con historial de consultas tus datos (cumplimiento)
    public function actionCsvTusDatos() {
        $this->validateUserAccessToCompliance();
        $value=$_GET['_export'];
        echo $this->renderPartial('csvTusDatos', array('_export'=>$value));
    }
    
    //Natalia Henao 
    //Exportar archivo csv con registro de secciones que tienen CH (Integridad y cumplimiento)
    public function actionCsvSeccionesCH() {
        $this->validateUserAccessToCompliance();
        $value=$_GET['_export'];
        $from=$_GET['from'];
        $until=$_GET['until'];
        echo $this->renderPartial('csvSeccionesCH', array('_export'=>$value, 'from'=>$from, 'until'=>$until));
    }

    //Natalia Henao 
    //Exportar archivo csv con registro de estudios en este periodo (Integridad)
    public function actionCsvStudyperiod() {
        $this->validateUserAccessToCompliance();
        $value=$_GET['_export'];
        $from=$_GET['from'];
        $until=$_GET['until'];
        echo $this->renderPartial('csvStudyperiod', array('_export'=>$value, 'from'=>$from, 'until'=>$until));
    }

    //Natalia Henao 
    //funcion para ver resultado de la evaluación de estudios (Integridad).
    public function actionDetailresultStudy(){
        $this->validateUserAccessToCompliance();
        $fromDate = CHtml::encode($_POST['from']);
        $untilDate = CHtml::encode($_POST['until']);
        $id = CHtml::encode($_POST['id']);
        
        $customerUs = $this->getCustomerUs();
        //$customerUs = Yii::app()->user->arUser;
        $detalleResultStudy = $customerUs->getDetailResultStudys($fromDate, $untilDate, $id);

        header('Content-type: application/json');
        echo CJSON::encode($detalleResultStudy);    
        Yii::app()->end();
    }
    
    //Natalia Henao 
    //funcion para ver tiempo de respuesta entre limite de dias de un estudio (Integridad).
    public function actionDayslimitforStudys(){
        $this->validateUserAccessToCompliance();
        $fromDate = CHtml::encode($_POST['from']);
        $untilDate = CHtml::encode($_POST['until']);

        $customerUs = $this->getCustomerUs();
        //$customerUs = Yii::app()->user->arUser;
        $detaillimitdaysStudy = $customerUs->getDaysfortimestudy($fromDate, $untilDate);

        header('Content-type: application/json');
        echo CJSON::encode($detaillimitdaysStudy);    
        Yii::app()->end();
    }

    //Natalia Henao 
    //funcion para ver el detallado de tiempo de respuesta por tipo de estudio (Integridad)
    public function actionDetailProductsStudydays(){
        $this->validateUserAccessToCompliance();
        $fromDate = CHtml::encode($_POST['from']);
        $untilDate = CHtml::encode($_POST['until']);
        $id = CHtml::encode($_POST['idproducts']);
        
        $customerUs = $this->getCustomerUs();
        //$customerUs = Yii::app()->user->arUser;
        $detallProductsStudys = $customerUs->getDetailStudysforProducts($fromDate, $untilDate, $id);

        header('Content-type: application/json');
        echo CJSON::encode($detallProductsStudys);    
        Yii::app()->end();
    }

    //Natalia Henao 
    //Insertar la observacion del cliente en el estudio de backgroundcheck (Integridad)
    public function actionInsertObsv() {
        $this->validateUserAccessToCompliance();
        $code=$_POST['ref'];
        $obs=$_POST['obs'];

        $customerUs = $this->getCustomerUs();
        $insertobservationstudy = $customerUs->getInsertObservation($code, $obs);

        header('Content-type: application/json');
        echo CJSON::encode($insertobservationstudy);    
        Yii::app()->end();
    }

    //Natalia Henao 
    //Abrir novedades por tiempo de respuesta segun tipo de estudio (Integridad)
    public function actionNovedadStudy() {
        $this->validateUserAccessToCompliance();
        $code=$_POST['code'];

        $customerUs = $this->getCustomerUs();
        $novResultStudy = $customerUs->getViewNovResultStudy($code);

        header('Content-type: application/json');
        echo CJSON::encode($novResultStudy);    
        Yii::app()->end();
    }

    public function actionRefresh($valor, $doc, $type){

        
        /*$id=CHtml::encode($_GET['valor']);
        $type=CHtml::encode($_GET['type']);
        $idnumber=CHtml::encode($_GET['doc']);*/

        $this->validateUserAccessToCompliance();
        $customerUs = $this->getCustomerUs();
        $refreshTD = $customerUs->getTusDatosRetry($valor, $type, $doc);

        if($refreshTD==1){
            /*echo '<script type="text/javascript">
                alert("Descargue nuevamente el PDF para validar el recargue de las fuentes caidas.");
            </script>';*/
            $this->redirect(array('/site/formularioCompliance', 'refr'=>$refreshTD, 'idnumber'=>$doc));
        }

        //$tusDatos = new TusDatos();
        /*$tusdatos= TusDatosResponse::model()->findByAttributes(array('backgroundcheckId' => $id));
        $tusdatos->status = TusDatosResponse::STATUS_PENDING;
        $tusdatos->update();*/
    }
    
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            //Yii::log("Error:" . $error['message'], "error", "ZWF." . __CLASS__);
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
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
                    WebUser::logAccess("Ingreso al sistema con la llave de seguridad : " . substr($model->otp, 0, 12));
                } else {
                    WebUser::logAccess("Ingreso al sistema");
                }
                $this->redirect('/site/terms');
            }
        }
        // display the login form
        Yii::app()->user->logout();
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionChangeOtp() {
        /* @var $user CustomerUser */
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

    public function actionChangePassword() {
        $form = new ChangePasswordForm;
// collect user input data

        if (isset($_POST['ChangePasswordForm'])) {
            $form->attributes = $_POST['ChangePasswordForm'];
// validate user input and redirect to previous page if valid
            if ($form->validate()) {
                $customerUser = CustomerUser::model()->findByPk(Yii::app()->user->getId());
                $customerUser->setPassword($form->newPassword1);
                $customerUser->mustChangePassword = 0;

                if (!$customerUser->save()) {
                    Yii::log(__FILE__ . "[" . __LINE__ . "]Error in password change" . serialize($customerUser->errors), "error", "ZWF." . __CLASS__);
                    $form->addErrors($customerUser->errors);
                } else {
                    WebUser::logAccess("Cambio de Password.");
                    $this->render('changePasswordSuccess', array());
                    return;
                }
            } else {
                WebUser::logAccess("Error en el cambio de Password.");
            }
        }
// display the login form
        $this->render('changePassword', array('form' => $form));
    }

    public function actionChangePdfPassword() {

// collect user input data
        $customerUser = Yii::app()->user->arUser;
        $customerUser->scenario = 'updatePdfPassword';

        if (isset($_POST['CustomerUser'])) {
            $customerUser->pdfPassword = $_POST['CustomerUser']['pdfPassword'];
            $customerUser->pdfPasswordChangedOn = new CDbExpression('NOW()');
// validate user input and redirect to previous page if valid
            if (!$customerUser->save()) {
                Yii::log(__FILE__ . "[" . __LINE__ . "]Error in password change" . serialize($customerUser->errors), "error", "ZWF." . __CLASS__);
            } else {
                Yii::app()->user->setFlash('success', 'La palabra clave para PDF ha sido cambiada.');
                WebUser::logAccess("Cambio la palabra clave de PDF con exito.");
            }
        }
// display the login form
        $this->render('changePdfPassword', array('customerUser' => $customerUser));
    }

    public function actionTerms() {
        $customerUser = Yii::app()->user->arUser;

        // Render Nuevo Formulario Compliance
        if (isset($_POST['btAccepted']) and $customerUser->compliance==0) {
            WebUser::logAccess("Acepto los términos de uso.");
            Yii::app()->user->setTermsAccepted();
            $this->redirect(array('/site/intro'));
        } else if (isset($_POST['btAccepted'])  and $customerUser->compliance==1) {
            WebUser::logAccess("Acepto los términos de uso.");
            Yii::app()->user->setTermsAccepted();
            $this->redirect(array('/site/formularioCompliance'));
        } else if (isset($_POST['btNotAccepted'])) {
            WebUser::logAccess("No acepto los términos de uso.");
            $this->redirect(array('/site/login'));
        } else {
            $this->render('terms', array());
        }
    }

}
