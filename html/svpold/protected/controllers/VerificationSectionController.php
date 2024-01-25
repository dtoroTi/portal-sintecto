<?php

class VerificationSectionController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
        $model = new VerificationSection;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['VerificationSection'])) {
            $model->attributes = $_POST['VerificationSection'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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

        if (isset($_POST['VerificationSection'])) {
            $model->attributes = $_POST['VerificationSection'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
//    public function actionDelete($id) {
//        if (Yii::app()->request->isPostRequest) {
//            // we only allow deletion via POST request
//            $this->loadModel($id)->delete();
//
//            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//            if (!isset($_GET['ajax']))
//                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//        } else
//            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
//    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('VerificationSection');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new VerificationSection('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['VerificationSection']))
            $model->attributes = $_GET['VerificationSection'];

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
        if(Yii::app()->user->getIsByRole()){
            return VerificationSection::model()->findByPk($id);
        }else{
            $model = VerificationSection::model()->findByPk($id);
            if ($model === null || !$model->backgroundCheck->userHasAccess)
                throw new CHttpException(404, 'The requested page does not exist.');
            return $model;
        }
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'verification-section-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateSection($id) {
        $section = $this->loadModel($id);

        if (isset($_POST['verificationSection'][$id]) && $section->backgroundCheck->canUpdate) {

            //18/08/2021 Herman, Jonathan, Natalia H.
            $verificationSectionold=$section->getAttributes(true);

            $section->attributes = $_POST['verificationSection'][$id];

            if ($section->save()) {

                //18/08/2021 Herman, Jonathan, Natalia H.
                $verificationSectionNew=$section->getAttributes(true);
                
                //WebUser::logAccess("Guardo Sección: " . $section->verificationSectionType->name .', Bajo el Concepto: '.$section->result->name,$section->backgroundCheck->code);

                //almacenar en el log el detalle de cambios realizados en las secciones.
                //18/08/2021 Herman, Jonathan, Natalia H.
                WebUser::logRecordChange("Guardo Sección: {$section->verificationSectionType->name}: ", $section->backgroundCheck->code, get_class($section), $verificationSectionNew, $verificationSectionold);

                if (isset($_POST['verificationSection'][$id]['_details'])) {
                    foreach ($_POST['verificationSection'][$id]['_details'] as $key => $detail) {
                        $class = $section->verificationSectionType->class;
                        if ($key != 'new') {                        
                            $row = CActiveRecord::model($class)->findByPk($key);

                            //18/08/2021 Herman, Jonathan, Natalia H.
                            $rowold=$row->getAttributes(true);
                            
                            if ($section->isXmlSection) {
                                $xmlAns = array();
                                foreach ($_POST['verificationSection'][$id]['_details'][$key] as $varName => $val) {
                                    if ($varName != 'verificationResultId') {
                                        $xmlAns[CHtml::encode($varName)] = CHtml::encode($val);
                                    }
                                }
                                $row->answer = serialize($xmlAns);
                                $row->verificationResultId = $_POST['verificationSection'][$id]['_details'][$key]['verificationResultId'];
                            } else if ($section->isHtmlSection) {
                                $row->setHtmlAnswer($_POST['verificationSection'][$id]['_details'][$key]);
                            } else {
                                $row->attributes = $_POST['verificationSection'][$id]['_details'][$key];
                            }
                            if (!$row->save()) {
                                Yii::app()->user->setFlash('verificationSection_' . $id, HtmlHelper::modelErrorsStr($row));
                            }

                            //18/08/2021 Herman, Jonathan, Natalia H.
                            $rowNew=$row->getAttributes(true);

                            //almacenar en el log el detalle de cambios realizados en las secciones.
                            //18/08/2021 Herman, Jonathan, Natalia H.
                            WebUser::logRecordChange("Cambio: ".$section->verificationSectionType->name.': ', $section->backgroundCheck->code, $class, $rowNew, $rowold);

                        } else {
                            $row = new $class();
                            $row->attributes = $_POST['verificationSection'][$id]['_details']['new'];
                            $row->verificationSectionId = $id;
                            if ($row->hasEnoughData) {
                               //WebUser::logAccess("LOG :" . var_export($row,true));
                                if (!$row->save()) {
                                    Yii::app()->user->setFlash('verificationSection_' . $id, HtmlHelper::modelErrorsStr($row));
                                }
                            }
                        }
                    }
                }
                //Almacenamiento de los extras de una sección
                if ( isset($_POST['verificationSection'][$id]['_extras']) ){
                    $class = array_keys($_POST['verificationSection'][$id]['_extras'])[0]; //Clase que debe ser guardada
                    $isNew = array_keys($_POST['verificationSection'][$id]['_extras'][$class])[0];
                    if ( $isNew == "new" ){
                        $row = new $class();
                        $row->verificationSectionId = $id;
                        $row->attributes = $_POST['verificationSection'][$id]['_extras'][$class][$isNew];
                        //WebUser::logAccess("LOG :" . var_export($row,true));
                        if (!$row->save()) {
                            Yii::app()->user->setFlash('verificationSection_' . $id, HtmlHelper::modelErrorsStr($row));
                        }
                    } else{
                        $row = CActiveRecord::model($class)->findByPk($isNew);
                        $row->attributes = $_POST['verificationSection'][$id]['_extras'][$class][$isNew];
                        if (!$row->save()) {
                            Yii::app()->user->setFlash('verificationSection_' . $id, HtmlHelper::modelErrorsStr($row));
                        }
                    }
                }
            }
        }
        $url = $this->createUrl('/backgroundCheck/update/', array('code' => $section->backgroundCheck->code, 'activeTab' => $id));
        $this->redirect($url, true);
    }

    //Funcion Anterior sin el log--03/09/2021
    /*public function actionUpdateSection($id) {
        $section = $this->loadModel($id);

        if (isset($_POST['verificationSection'][$id]) && $section->backgroundCheck->canUpdate) {
            $section->attributes = $_POST['verificationSection'][$id];
            if ($section->save()) {
                 WebUser::logAccess("Guardo Sección :" . $section->verificationSectionType->name, $section->backgroundCheck->code);
                if (isset($_POST['verificationSection'][$id]['_details'])) {
                    foreach ($_POST['verificationSection'][$id]['_details'] as $key => $detail) {
                        $class = $section->verificationSectionType->class;
                        if ($key != 'new') {                        
                            $row = CActiveRecord::model($class)->findByPk($key);
                            if ($section->isXmlSection) {
                                $xmlAns = array();
                                foreach ($_POST['verificationSection'][$id]['_details'][$key] as $varName => $val) {
                                    if ($varName != 'verificationResultId') {
                                        $xmlAns[CHtml::encode($varName)] = CHtml::encode($val);
                                    }
                                }
                                $row->answer = serialize($xmlAns);
                                $row->verificationResultId = $_POST['verificationSection'][$id]['_details'][$key]['verificationResultId'];
                            } else if ($section->isHtmlSection) {
                                $row->setHtmlAnswer($_POST['verificationSection'][$id]['_details'][$key]);
                            } else {
                                $row->attributes = $_POST['verificationSection'][$id]['_details'][$key];
                            }
                            if (!$row->save()) {
                                Yii::app()->user->setFlash('verificationSection_' . $id, HtmlHelper::modelErrorsStr($row));
                            }
                        } else {
                            $row = new $class();
                            $row->attributes = $_POST['verificationSection'][$id]['_details']['new'];
                            $row->verificationSectionId = $id;
                            if ($row->hasEnoughData) {
                               // WebUser::logAccess("LOG :" . var_export($row,true));
                                if (!$row->save()) {
                                    Yii::app()->user->setFlash('verificationSection_' . $id, HtmlHelper::modelErrorsStr($row));
                                }
                            }
                        }
                    }
                }
                //Almacenamiento de los extras de una sección
                if ( isset($_POST['verificationSection'][$id]['_extras']) ){
                    $class = array_keys($_POST['verificationSection'][$id]['_extras'])[0]; //Clase que debe ser guardada
                    $isNew = array_keys($_POST['verificationSection'][$id]['_extras'][$class])[0];
                    if ( $isNew == "new" ){
                        $row = new $class();
                        $row->verificationSectionId = $id;
                        $row->attributes = $_POST['verificationSection'][$id]['_extras'][$class][$isNew];
                       // WebUser::logAccess("LOG :" . var_export($row,true));
                        if (!$row->save()) {
                            Yii::app()->user->setFlash('verificationSection_' . $id, HtmlHelper::modelErrorsStr($row));
                        }
                    } else{
                        $row = CActiveRecord::model($class)->findByPk($isNew);
                        $row->attributes = $_POST['verificationSection'][$id]['_extras'][$class][$isNew];
                        if (!$row->save()) {
                            Yii::app()->user->setFlash('verificationSection_' . $id, HtmlHelper::modelErrorsStr($row));
                        }
                    }
                }
            }
        }
        $url = $this->createUrl('/backgroundCheck/update/', array('code' => $section->backgroundCheck->code, 'activeTab' => $id));
        $this->redirect($url, true);
    }*/

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionFinishSection($id) {
        $section = $this->loadModel($id);
        if ($section) {
            
            if(($section->verificationSectionType->id==5 || $section->verificationSectionType->id==18) && $section->backgroundCheck->customer->surveyLinkId!=null){

                $links = SurveyLink::model()->findByPK($section->backgroundCheck->customer->surveyLinkId);
                $link= $links->link;
                $dateresponse = VerificationSection::sendTextMessageSection($section->backgroundCheckId, $link);

                if ($dateresponse['status'] == 1) {
                    if ($dateresponse['result']->totalFailed == 0) {
                        WebUser::logAccess("Se finalizo la sección [".$section->verificationSectionType->name."] y se envío un mensaje de texto con respuesta: [".$dateresponse['result']->receivedRequests[0]->reason."], al número de celular: {$section->backgroundCheck->mobile}", $section->backgroundCheck->code);
                    } else {
                        WebUser::logAccess("Se finalizo la sección [".$section->verificationSectionType->name."] y se envío un mensaje de texto con respuesta: [".$dateresponse['result']->failedRequests[0]->reason."], al número de celular: {$section->backgroundCheck->mobile}", $section->backgroundCheck->code);
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Solicitud Incorrecta.");
                }

                $body = $this->renderPartial('/verificationSection/_mailFinishSection', array(
                    'Section' => $section,
                    'link'=>$link,
                ), true);

                if (Yii::app()->user->sendMailInBackground(
                    "❗⏰ Encuesta de Satisfacción Ref. [".$section->backgroundCheck->code."] ❗⏰",
                    $body,
                    $section->backgroundCheck->mailsParamContact,
                    [],
                    [],
                    []
                )) {
                    WebUser::logAccess("Se envío a [" . $section->backgroundCheck->firstName . " " . $section->backgroundCheck->lastName . "] un correo con el link de la encuesta.", $section->backgroundCheck->code);
                }
            }

            $assignedUsers = AssignedUser::model()->findAllByAttributes(array('verificationSectionId' => $id, 'userId' => Yii::app()->user->id));
            WebUser::logAccess("Finalizo la Sección :" . $section->verificationSectionType->name, $section->backgroundCheck->code);
            foreach ($assignedUsers as $assignedUser) {
                $assignedUser->finishedAt= new CDbExpression('NOW()');
                $assignedUser->save();
            }

            //Proceso Facturacion visitadores registro factura
            //Natalia Henao M
            $assignedUs = AssignedUser::model()->findByAttributes(array('verificationSectionId' => $id, 'userId' => Yii::app()->user->id));
            if($assignedUs->userRoleId==3){
                if (!$section->backgroundCheck->invoiceVisit && ($section->verificationSectionType->id==5 || $section->verificationSectionType->id==17 || $section->verificationSectionType->id==33 || $section->verificationSectionType->id==44 || $section->verificationSectionType->id==85)) {
                    if($section->backgroundCheck->customerProduct->costVisitId==''){
                        Yii::app()->user->setFlash('error', "El producto no cuenta con un tipo de costo asociado para ser facturado.");
                    }else{
                        $section->backgroundCheck->assignInvoiceVisit();
                        WebUser::logAccess("Registro factura de visitadores: ".$section->backgroundCheck->invoiceVisitId, $section->backgroundCheck->code);
                    }
                }
            }

        }
        $url = $this->createUrl('/backgroundCheck/update/', array('code' => $section->backgroundCheck->code, 'activeTab' => $id));
        $this->redirect($url, true);
    }

    public function actionDelete($verificationSectionId, $id) {
        $verificationSection = VerificationSection::model()->findByPk($verificationSectionId);
        if ($verificationSection && $verificationSection->backgroundCheck->userHasAccess && $verificationSection->backgroundCheck->canUpdate) {
            $class = $verificationSection->verificationSectionType->class;
            $row = CActiveRecord::model($class)->findByPk($id);
            $row->delete();
            $verificationSection->save();
            $url = $this->createUrl('/backgroundCheck/update/', array('code' => $verificationSection->backgroundCheck->code)) . "&activeTab={$verificationSection->id}";
            $this->redirect($url, true);
        } else {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    //Proceso de export coface
    public function actionCsvImportCoface() {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $sectionImport = VerificationSection::getSectionImport();
            echo $this->renderPartial( 'exportImportCSV'
                    , array(
                'sectionImport' => $sectionImport,
            ));
        }
    }

    public function actionCsvExportCoface() {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $sectionExport = VerificationSection::getSectionExport();
            echo $this->renderPartial( 'exportExportCSV'
                    , array(
                'sectionExport' => $sectionExport,
            ));


        }
    }

    public function actionCsvCompanyCoface() {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $sectionCompany = VerificationSection::getSectionCompany();
            echo $this->renderPartial( 'exportCompanyCSV'
                    , array(
                'sectionCompany' => $sectionCompany,
            ));


        }
    }

    public function actionCsvContactPersonCoface() {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $sectionContactPerson = VerificationSection::getSectionContactPerson();
            echo $this->renderPartial( 'exportContactPersonCSV'
                    , array(
                'sectionContactPerson' => $sectionContactPerson,
            ));


        }
    }

    public function actionCsvShareHoldersCoface() {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $sectionShareHolders = VerificationSection::getSectionShareHolders();
            echo $this->renderPartial( 'exportShareHoldersCSV'
                    , array(
                'sectionShareHolders' => $sectionShareHolders,
            ));


        }
    }

    public function actionCsvAddressCoface() {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $sectionAddress = VerificationSection::getSectionAddress();
            echo $this->renderPartial( 'exportAddressCSV'
                    , array(
                'sectionAddress' => $sectionAddress,
            ));


        }
    }

    public function actionCsvCommentsCoface() {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $sectionComments = VerificationSection::getSectionComments();
            echo $this->renderPartial( 'exportCommentsCSV'
                    , array(
                'sectionComments' => $sectionComments,
            ));


        }
    }

    public function actionCsvFinantialAnalysCoface() {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $sectionFinantialAnalys = VerificationSection::getSectionFinantialAnalys();
            echo $this->renderPartial( 'exportFinantialAnalysCSV'
                    , array(
                'sectionFinantialAnalys' => $sectionFinantialAnalys,
            ));


        }
    }

    public function actionCsvTrakingCoface() {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $sectionTraking = VerificationSection::getSectionTraking();
            echo $this->renderPartial( 'exportTrakingCSV'
                    , array(
                'sectionTraking' => $sectionTraking,
            ));


        }
    }

    public function actionCsvCommercialRefCoface() {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $sectionCommercialRef = VerificationSection::getSectionCommercialRef();
            echo $this->renderPartial( 'exportCommercialRefCSV'
                    , array(
                'sectionCommercialRef' => $sectionCommercialRef,
            ));


        }
    }

    public function actionTransUnion(){

        Yii::import('application.extensions.TransUnion.*');
        $bckid=CHtml::encode($_GET['bckid']);
        $type=CHtml::encode($_GET['typedoc']);
        $idnumber=CHtml::encode($_GET['idnumber']);
        $motConsulta=CHtml::encode($_GET['motConsulta']);
        $codInfo=CHtml::encode($_GET['codInfo']);
        
        $backgroundCheck = BackgroundCheck::model()->findByPk($bckid);
  
        $transUnion = new TransUnion();
        $data=$transUnion->getUbicaPlus($bckid, $type, $idnumber, $motConsulta, $codInfo);

        WebUser::logAccess("Genero el informe de TransUnion, Ubica Plus.", $backgroundCheck->code);

        if(isset($data->Error)){
            echo "Error: ".$data->Error->MensajeError; 
        }else{
            $this->renderPartial('_pdfUbicaPlus', array(
                'dataTU' => $data,
                'bckid'=>$bckid)
            );
            echo "Informe Generado con Éxito."; 
        }
    }
}
