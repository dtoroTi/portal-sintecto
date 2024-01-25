<?php

class VettingController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $defaultAction = 'admin';

    /**
     * Displays a particular model.
     * @param string $code the ID of the model to be displayed
     */


    private $permitedFields = array(
        'firstName',
        'lastName',
        'idNumber',
        'idFrom',
        'tels',
        'mobile',
        'applyToPosition',
        'email',
    );
    private $permitedCompanyFields = array(
        'lastName',
        'idNumber',
        'tels',
        'mobile',
        'email',
    );




    /**
     * Displays a particular model.
     * @param string $code the ID of the model to be displayed
     */


    //Creada por Jonathan Export


    public function actionPcAdmin() {
        if (isset($_GET['exportvencidos'])) {
            echo $this->renderPartial( '_csvEstudiosavencer');
        }

        $model = GridViewFilter::getFilter('BackgroundCheck', 'search');

        if (isset($_GET['BackgroundCheck']))
            $model->attributes = $_GET['BackgroundCheck'];

        if (isset($_GET['_export'])) {
            set_time_limit(300);
            $this->renderPartial('_csvPcAdmin', array(
                'model' => $model,
                'withEvents' => false,
            ));
        } elseif (isset($_GET['_exportWithEvents'])) {
            set_time_limit(300);
            $this->renderPartial('_csvPcAdmin', array(
                'model' => $model,
                'withEvents' => true,
            ));
        } elseif (isset($_GET['_exportDetail'])) {
            $this->renderPartial('_csvPcAdminDetail', array(
                'backgroundCheck' => $model,
            ));
        } elseif (isset($_GET['_export_full'])) {
            if (Yii::app()->user->isSuperAdmin && Yii::app()->user->isRegisteredIp) {
                header('Content-type: text/html; charset=utf-8');
                $dp = $model->search(4000);
                $models = $dp->getData();
                $i = 0;
                foreach ($models as $backgroundCheck) {
                    if ($backgroundCheck && $backgroundCheck->reportAvailable && file_exists($backgroundCheck->absolutePath)) {
                        $i++;
                        $pdfFile = Yii::app()->basePath . "/runtime/reports/informe_" . $backgroundCheck->idNumber . '_' . $backgroundCheck->code . ".pdf";
                        if (!file_exists($pdfFile)) {
                            //WebUser::logAccess("Descargo el archivo Final PDF del estudio", $backgroundCheck->code);
                            $pdfData = $backgroundCheck->getBackgroundCheckReport(Yii::app()->user->arUser->pdfPassword, (Yii::app()->user->isAdmin || Yii::app()->user->IsRegisteredIP || Yii::app()->user->arUser->isInhouse), Yii::app()->user->name);
                            file_put_contents($pdfFile, $pdfData);
                            $pdfData = null;
                            print ($i . ' : Guardando ' . $backgroundCheck->code . '<br/>');
                        } else {
                            print ($i . ' : Existía ' . $backgroundCheck->code . '<br/>');
                        }
                        $backgroundCheck = null;
                        flush();
                        ob_flush();
                    }
                }
            }
        } else {
            $this->render('pcAdmin', array(
                'model' => $model,
            ));
        }
    }





    //Creada por Jonathan


    public function actionCreateMultipleCompanyStudies() {
        $model = new BackgroundCheck;
        $records = array();
        if (isset($_POST['BackgroundCheck']) && isset($_POST['studies']) && isset($_POST['create'])) {
            $model->attributes = $_POST['BackgroundCheck'];
            foreach ($_POST['studies'] as $key => $study) {
                $attributes = $_POST['BackgroundCheck'];
                $attributes['backgroundCheckStatusId'] = BackgroundCheckStatus::REQUESTED;

                $attributes['requestSystemId'] = RequestSystem::SES_SYSTEM;
                $attributes['firstName'] = "EMPRESA";
                $attributes['applyToPosition'] = 0;

                if (isset($study['include']) && $study['include'] != 0) {
                    foreach ($study as $field => $value) {
                        if (array_search($field, $this->permitedCompanyFields, true) !== FALSE) {
                            $attributes[$field] = CHtml::encode($value);
                        }

                    }


                    $records[] = $this->createRecord($attributes, FALSE, FALSE, FALSE);
                }

            }

            $body = $this->renderPartial('_mailCreateMultiple', array(
                'model' => $model,
                'records' => $records,
            ), true);

            Yii::app()->user->sendMailInBackground(
                'Petición de Estudios de Seguridad [Ref:' . $model->code . '] (SVision)', //
                $body, //
                array(Yii::app()->user->arUser->mailParam,), //
                array(Yii::app()->params['serviceEmail']['solicitud'],)
            );
            Yii::app()->user->setFlash('notification', "Se crearon los registros.");
        } else {
            Yii::app()->user->setFlash('error', "Error en archivo de cargas múltiples.");
        }
        $this->render('createMultipleCompanyConfirm', array(
            'model' => $model,
            'records' => $records,
        ));
    }


    public function actionCreateMultipleCompany() {
        $model = new BackgroundCheck;
        $fileForm = new MultipleStudiesForm();
        $records = array();


        if (isset($_POST['BackgroundCheck'])) {
            $model->attributes = $_POST['BackgroundCheck'];

            if (isset($_POST['uploadButton']) && $fileForm->validate()) {
                $fileForm->doc = CUploadedFile::getInstance($fileForm, 'doc');
                if (isset($fileForm->doc)) {
                    $baseName = basename($fileForm->doc->name);
                    $fileName = Yii::app()->getRuntimePath() . "/" . uniqid("_", true) . $baseName;
                    $fileForm->doc->saveAs($fileName);

                    $filestring = file_get_contents($fileName);
                    if ($fileName != "" && file_exists($fileName)) {
                        unlink($fileName);
                    }
                    $error = false;
                    $numRecords = 0;

                    $isMac = (isset($_POST['fileType']) && $_POST['fileType'] === 'mac');
                    if (!$isMac) {
                        $filestring = $this->mb_punctuation_trim($filestring);
                    }

                    $rows = $this->getRecordArray($filestring, $isMac);

                    $records = array();
                    for ($i = 0; $i < count($rows); $i++) {
                        $row = array();
                        for ($j = 0; $j < count($this->permitedCompanyFields); $j++) {
                            if (isset($rows[$i][$j])) {
                                $row[$this->permitedCompanyFields[$j]] = $rows[$i][$j];
                            } else {
                                $row[$this->permitedCompanyFields[$j]] = '';
                            }
                        }

                        
                    $customerGroup =  CustomerGroup::model()->findByPk(['id'=>$model->customer->customerGroupId]);
                    if($customerGroup){
                        $alert=$customerGroup->alertGroupDoc;
                    }
                    $criteria = new CDbCriteria;
   
                    if($alert==1){
                        $criteria->addCondition('customer.customerGroupId=:customerGrpId');
                        $criteria->addCondition('t.idNumber=:idNumber');
                        $criteria->with=['customer.customerGroup'];
                        $criteria->params=[':customerGrpId'=>$model->customer->customerGroupId, ':idNumber'=>CHtml::encode($row['idNumber'])];
                    }else{
                        $criteria->addCondition('t.customerId=:customerId');
                        $criteria->addCondition('t.idNumber=:idNumber');
                        $criteria->params=[':customerId'=>$model->customerId, ':idNumber'=>CHtml::encode($row['idNumber'])];
                    }
                
                        $prevRecord= BackgroundCheck::model()->findAll($criteria);
                        /*$prevRecord = BackgroundCheck::model()->findByAttributes(
                            array(
                                'idNumber' => $row['idNumber'],
                                'customerId' => $model->customerId,
                            ));*/

                        if ($prevRecord) {
                            $row['error'] = 'Cédula Repetida';
                        } else {
                            $row['error'] = '';
                        }

                        $records[] = $row;
                    }

                    $this->render('createMultipleCompanyVerify', array(
                        'model' => $model,
                        'records' => $records,
                        'permitedCompanyFields' => $this->permitedCompanyFields,
                    ));
                    return;
                } else {
                    Yii::app()->user->setFlash('error', "Error en archivo de cargas múltiples.");
                }
            }
        }

        $this->render('createMultipleCompany', array(
            'model' => $model,
            'file' => $fileForm,
            'permitedCompanyFields' => $this->permitedCompanyFields,
        ));
    }

    public function actionCreateMultipleArmada() {
        $model = new BackgroundCheck;
        $fileForm = new MultipleArmadaStudiesForm();
        $records = array();

        if (isset($_POST['uploadButton']) && $fileForm->validate()) {
            $fileForm->doc = CUploadedFile::getInstance($fileForm, 'doc');
            if (isset($fileForm->doc)) {
                $baseName = basename($fileForm->doc->name);
                $fileName = Yii::app()->getRuntimePath() . "/" . uniqid("_", true) . $baseName;
                $fileForm->doc->saveAs($fileName);

                $data = $this->getCsvData($fileName);
                $data = $this->getMultipleFields($data);

                /*echo "<pre>";
                print_r($data);
                exit;//*/

                $this->createMultipleStudiesArmada($data);
            } else {
                Yii::app()->user->setFlash('error', "Error en archivo de cargas múltiples.");
            }
        }

        $this->render('createMultiple', array(
            'model' => $model,
            'file' => $fileForm,
            'permitedFields' => $this->permitedFields,
        ));
    }

    private function createRecord($attributes, $isCompanySurvey = FALSE, $redirect = TRUE, $sendMail = TRUE) {
        if ($isCompanySurvey) {
            $model = new BackgroundCheck('createCompany');
        } else {
            $model = new BackgroundCheck('createPerson');
        }

        if (isset($attributes)) {
            $model->attributes = $attributes;
            $model->cost = @$model->customerProduct->cost;
            if(@$model->customer->isRecover==0){
                $model->price = @$model->customerProduct->price;
            }else{
                $model->price = 0;
            }
            if ($model->isCompanySurvey) {
                $model->firstName = BackgroundCheck::DEFAULT_COMPANY_FIRSTNAME;
            }

            if ($model->save()) {
                foreach ($model->customerProduct->verificationsInProduct as $verificationInProduct) {
                    $verificationSection = new VerificationSection;
                    $verificationSection->backgroundCheckId = $model->id;
                    $verificationSection->verificationSectionTypeId = $verificationInProduct->verificationSectionTypeId;
                    $verificationSection->showOrder = $verificationInProduct->showOrder;
                    if (!$verificationSection->save()) {
                        Yii::app()->user->setFlash('error', implode(", ", $verificationSection->errors));
                    } else {
                        $verificationSection->createBasicRecords();
                    }

                        //Natalia Henao Mayorga
                        //18/01/2023
                        //inicio de la condicion 
                        if($verificationSection->verificationSectionTypeId==2 || $verificationSection->verificationSectionTypeId==3){
                            $criteria = new CDbCriteria;
                            $criteria->addCondition("t.created<DATE(NOW()) AND t.backgroundCheckStatusId=4");
                            $criteria->addCondition("verificationSections.verificationSectionTypeId=2 OR verificationSections.verificationSectionTypeId=3");
                            $criteria->with=['verificationSections'];
                            $criteria->order='t.id DESC';
                            $modelRell = BackgroundCheck::model()->findByAttributes(array('idNumber' => $model->idNumber), $criteria);

                            if($modelRell){
                                $criteria = new CDbCriteria;
                                $criteria->compare('backgroundCheckId', $modelRell->id);
                                $criteria->addCondition("t.verificationSectionTypeId=2 OR t.verificationSectionTypeId=3");
                                $valVerification = VerificationSection::model()->findAll($criteria);

                                if($valVerification){
                                    foreach ($valVerification as $idVerification) {
                                        if($idVerification->verificationSectionTypeId==2){
                                            $detailEducation = DetailEducation::model()->findAllByAttributes(array('verificationSectionId' => $idVerification->id));
                                            if($detailEducation){
                                                $RegEducation=DetailEducation::automaticCompletionEd($detailEducation, $verificationSection->id);
                                            }
                                        }
                                        if($idVerification->verificationSectionTypeId==3){
                                            $detailJob = DetailJob::model()->findAllByAttributes(array('verificationSectionId' => $idVerification->id));
                                            if($detailJob){
                                                $RegJob=DetailJob::automaticCompletionJob($detailJob, $verificationSection->id);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        //Fin de la condicon
                }
                WebUser::logAccess("Creo un estudio", $model->code);
                WebUser::logAccess("Fecha Limite de creacion: ".$model->studyLimitOn,$model->code);

                $model->dateLimitQuality =  $model->studyLimitOn;

                $model->assignDefaultUser();

                if ($sendMail){
                    $customerMailParam = array ("mail" => $model->customerUser->username, "name" => $model->customerUser->name);
                    $body = $this->renderPartial('_mailCreate', array(
                        'backgroundCheck' => $model,
                    ), true);
                    Yii::app()->user->sendMailInBackground(
                        'Petición de Estudio de Seguridad [Ref:' . $model->code . '] (SVision)', //
                        $body, //
                        array(Yii::app()->user->arUser->mailParam,), // Desactivar
                        array(Yii::app()->user->arUser->mailParam, $customerMailParam ), //
                        array(Yii::app()->params['serviceEmail']['solicitud'],), //
                        ($model->responsible ? $model->getResponsibleMail() : null)
                    );
                }

                //proceso jeimy
                //17/09/2021
                $criteria = new CDbCriteria;
                $criteria->compare('backgroundCheckId', $model->id);
                $criteria->addCondition("verificationSectionTypeId=4 OR verificationSectionTypeId=24");
                //$criteria->compare('verificationSectionTypeId', '4');
                $seccionAdv = VerificationSection::model()->findAll($criteria);
                if($seccionAdv && $model->customer->isRecover==0 && $model->customer->businessLine=="Integridad"){
                    $this->createTusDatosRegister($model);
                }

                if ($redirect) {
                    $this->redirect(array('/backgroundCheck/update', 'code' => $model->code));
                }
            }
        } else {
            $model->setDefaults();
        }

        return $model;
    }





    function w1250ToUtf8($text, $isMac = false) {

        $mapMac = array(
            chr(0x87) => chr(0xC3) . chr(0xA1), // á
            chr(0x8E) => chr(0xC3) . chr(0xA9), // é
            chr(0x92) => chr(0xC3) . chr(0xAD), // í
            chr(0x97) => chr(0xC3) . chr(0xB3), // ó
            chr(0x9C) => chr(0xC3) . chr(0xBA), // ú
            chr(0xE7) => chr(0xC3) . chr(0x81), // Á
            chr(0x83) => chr(0xC3) . chr(0x89), // É
            chr(0xEA) => chr(0xC3) . chr(0x8D), // Í
            chr(0xEE) => chr(0xC3) . chr(0x93), // Ó
            chr(0xF2) => chr(0xC3) . chr(0x9A), // Ú
            chr(0x9F) => chr(0xC3) . chr(0xBC), // ü
            chr(0x86) => chr(0xC3) . chr(0x9C), // Ü
            chr(0x96) => chr(0xC3) . chr(0xB1), // ñ
            chr(0x84) => chr(0xC3) . chr(0x91), // Ñ
        );

        $mapPc = array(
            chr(0xE1) => $mapMac[chr(0x87)], // á
            chr(0xE9) => $mapMac[chr(0x8E)], // é
            chr(0xED) => $mapMac[chr(0x92)], // í
            chr(0xF3) => $mapMac[chr(0x97)], // ó
            chr(0xFA) => $mapMac[chr(0x9C)], // ú
            chr(0xC1) => $mapMac[chr(0xE7)], // Á
            chr(0xC9) => $mapMac[chr(0x83)], // É
            chr(0xCD) => $mapMac[chr(0xEA)], // Í
            chr(0xD3) => $mapMac[chr(0xEE)], // Ó
            chr(0xDA) => $mapMac[chr(0xF2)], // Ú
            chr(0xFC) => $mapMac[chr(0x9F)], // ü
            chr(0xDC) => $mapMac[chr(0x86)], // Ü
            chr(0xF1) => $mapMac[chr(0x96)], // ñ
            chr(0xD1) => $mapMac[chr(0x84)], // Ñ
        );

        if ($isMac) {
            $map = $mapMac;
        } else {
            $map = $mapPc;
        }
        return strtr($text, $map);
    }





    function getRecordArray($filestring, $isMac) {
        $ans = array();
        $end = false;
        $field = "";
        $row = array();



        for ($i = 0; $i < strlen($filestring); $i++) {
            $char = $filestring[$i];

            switch ($char) {
                case "\n":
                case "\r":
                    if (strlen($field) > 0) {
                        $row[] = $this->w1250ToUtf8($field, $isMac);
                    }
                    $field = '';
                    if (count($row) > 0) {
                        $ans[] = $row;
                    }
                    $row = array();
                    break;
                case "\t":
                    $row[] = $this->w1250ToUtf8($field, $isMac);
                    $field = '';
                    break;
                default:
                    $field.=$char;
            }
        }

        if (count($row) > 0 || $field != '') {
            if ($field != '') {
                $row[] = $this->w1250ToUtf8($field, $isMac);
            }
            $ans[] = $row;
        }

        return $ans;
    }



    function mb_punctuation_trim($string) {
        $ans = str_replace(array(chr(0xff) . chr(0xfe), chr(0x00)), '', $string);
        return $ans;
    }



    public function actionCreateMultipleStudies() {
        $model = new BackgroundCheck;
        $records = array();
        if (isset($_POST['BackgroundCheck']) && isset($_POST['studies']) && isset($_POST['create'])) {
            $model->attributes = $_POST['BackgroundCheck'];
            foreach ($_POST['studies'] as $key => $study) {
                $attributes = $_POST['BackgroundCheck'];
                $attributes['backgroundCheckStatusId'] = BackgroundCheckStatus::REQUESTED;
                $attributes['requestSystemId'] = RequestSystem::SES_SYSTEM;
                if (isset($study['include']) && $study['include'] != 0) {
                    foreach ($study as $field => $value) {
                        if (array_search($field, $this->permitedFields, true) !== FALSE) {
                            $attributes[$field] = CHtml::encode($value);
                        }
                    }
                    $records[] = $this->createRecord($attributes, FALSE, FALSE, FALSE);
                }
            }
            $body = $this->renderPartial('_mailCreateMultiple', array(
                'model' => $model,
                'records' => $records,
            ), true);

            Yii::app()->user->sendMailInBackground(
                'Petición de Estudios de Seguridad [Ref:' . $model->code . '] (SVision)', //
                $body, //
                array(Yii::app()->user->arUser->mailParam,), //
                array(Yii::app()->params['serviceEmail']['solicitud'],)
            );
            Yii::app()->user->setFlash('notification', "Se crearon los registros.");
        } else {
            Yii::app()->user->setFlash('error', "Error en archivo de cargas múltiples.");
        }
        $this->render('createMultipleConfirm', array(
            'model' => $model,
            'records' => $records,
        ));
    }








    public function actionCreateMultiple() {
        $model = new BackgroundCheck;
        $fileForm = new MultipleStudiesForm();
        $records = array();


        if (isset($_POST['BackgroundCheck'])) {
            $model->attributes = $_POST['BackgroundCheck'];

            if (isset($_POST['uploadButton']) && $fileForm->validate()) {
                $fileForm->doc = CUploadedFile::getInstance($fileForm, 'doc');
                if (isset($fileForm->doc)) {
                    $baseName = basename($fileForm->doc->name);
                    $fileName = Yii::app()->getRuntimePath() . "/" . uniqid("_", true) . $baseName;
                    $fileForm->doc->saveAs($fileName);

                    $filestring = file_get_contents($fileName);
                    if ($fileName != "" && file_exists($fileName)) {
                        unlink($fileName);
                    }
                    $error = false;
                    $numRecords = 0;

                    $isMac = (isset($_POST['fileType']) && $_POST['fileType'] === 'mac');
                    if (!$isMac) {
                        $filestring = $this->mb_punctuation_trim($filestring);
                    }

                    $rows = $this->getRecordArray($filestring, $isMac);

                    $records = array();
                    for ($i = 0; $i < count($rows); $i++) {
                        $row = array();
                        for ($j = 0; $j < count($this->permitedFields); $j++) {
                            if (isset($rows[$i][$j])) {
                                $row[$this->permitedFields[$j]] = $rows[$i][$j];
                            } else {
                                $row[$this->permitedFields[$j]] = '';
                            }
                        }

                        $customerGroup =  CustomerGroup::model()->findByPk(['id'=>$model->customer->customerGroupId]);
                        if($customerGroup){
                            $alert=$customerGroup->alertGroupDoc;
                        }
                        
                        $criteria = new CDbCriteria;
                        if($alert==1){
                            $criteria->addCondition('customer.customerGroupId=:customerGrpId');
                            $criteria->addCondition('t.idNumber=:idNumber');
                            $criteria->with=['customer.customerGroup'];
                            $criteria->params=[':customerGrpId'=>$model->customer->customerGroupId, ':idNumber'=>CHtml::encode($row['idNumber'])];
                        }else{
                            $criteria->addCondition('t.customerId=:customerId');
                            $criteria->addCondition('t.idNumber=:idNumber');
                            $criteria->params=[':customerId'=>$model->customerId, ':idNumber'=>CHtml::encode($row['idNumber'])];
                        }
                    
                        $prevRecord= BackgroundCheck::model()->findAll($criteria);
                        
                        /*$prevRecord = BackgroundCheck::model()->findByAttributes(
                            array(
                                'idNumber' => $row['idNumber'],
                                'customerId' => $model->customerId,
                            ));*/
                        if ($prevRecord) {
                            $row['error'] = 'Cédula Repetida';
                        } else {
                            $row['error'] = '';
                        }

                        $records[] = $row;
                    }

                    $this->render('createMultipleVerify', array(
                        'model' => $model,
                        'records' => $records,
                        'permitedFields' => $this->permitedFields,
                    ));
                    return;
                } else {
                    Yii::app()->user->setFlash('error', "Error en archivo de cargas múltiples.");
                }
            }
        }

        $this->render('createMultiple', array(
            'model' => $model,
            'file' => $fileForm,
            'permitedFields' => $this->permitedFields,
        ));
    }

    public function actionDynamicCustomerProducts($companySurvey) {
        $ans = '';
        if (!isset($_POST['BackgroundCheck']['customerId'])) {
            $customerId = 0;
        } else {
            $customerId = (int) $_POST['BackgroundCheck']['customerId'];
        }
        $customer = Customer::model()->findByPk($customerId);

        if ($customer) {
            $ans = array('customerUsers' => '', 'customerProducts' => '');
            foreach ($customer->customerProducts as $customerProduct) {
                if (($companySurvey == 1 && $customerProduct->isCompanySurvey) ||
                    ($companySurvey == 0 && !$customerProduct->isCompanySurvey)) {
                    $ans['customerProducts'].=
                        CHtml::tag(
                            'option', //
                            array('value' => $customerProduct->id), //
                            CHtml::encode($customerProduct->name . (!$customerProduct->isActive ? ' [** Inactivo **]' : '')), //
                            true);
                }
            }

            foreach ($customer->customerUsers as $customerUser) {
                $ans['customerUsers'].=
                    CHtml::tag(
                        'option', //
                        array('value' => $customerUser->id), //
                        CHtml::encode($customerUser->username . (!$customerUser->isActive ? ' [** Inactivo **]' : '')), //
                        true);
            }

            $ans['customerFields']['field1'] = $customer->field1;
            $ans['customerFields']['field2'] = $customer->field2;
            $ans['customerFields']['field3'] = $customer->field3;
            $ans['customerFields']['optionsField1'] = $customer->optionsInFieldArray(1);
            $ans['customerFields']['optionsField2'] = $customer->optionsInFieldArray(2);
            $ans['customerFields']['optionsField3'] = $customer->optionsInFieldArray(3);
        }
        echo CJavaScript::jsonEncode($ans);
        Yii::app()->end();
    }

    //proceso natalia, Herman, Jonathan
    //18/08/2021
    public function actionViewPdfSindoc($code) {
        WebUser::logAccess("Descargo Reporte sin documentos.", $code);
        $this->loadDocument($code, true);
    }

    //proceso natalia, Herman, Jonathan
    //25/08/2021
    public function actionV($code) {
        WebUser::logAccess("Descargo Reporte.", $code);
        $this->loadDocument($code, false);
    }

    //proceso natalia, Herman, Jonathan ($short)
    //25/08/2021
    //Creada por Herman
    private function loadDocument($code, $short) {
        $backgroundCheck = $this->loadModel($code);
        if ($backgroundCheck &&
            ($backgroundCheck->isReportAvailable || $backgroundCheck->isTemporalReportAvailable) &&
            file_exists($backgroundCheck->absolutePath) &&
            Yii::app()->user->arUser->accessToPdfReport) {
            WebUser::logAccess("Descargo el archivo PDF del estudio de : " . $backgroundCheck->fullName . " [" . $backgroundCheck->idNumber . "]", $backgroundCheck->code);

            $backgroundCheck->numberOfDownloads = $backgroundCheck->numberOfDownloads + 1;

            if ($backgroundCheck->save()) {

                if($short){
                    if($backgroundCheck->pagesPDF==""){
                        $pages=20;
                    }else{
                        $pages=$backgroundCheck->pagesPDF;
                    }   
                }else{
                    $pages=null; 
                }

                $pdfData = $backgroundCheck->getBackgroundCheckReport(Yii::app()->user->arUser->pdfPassword, true, Yii::app()->user->name, 0, 10, $pages);

                header('Content-type: application/pdf');
                // 19-05-2017
                // Se cambia el nombre del archivo
                header('Content-Disposition: inline; filename="' . $backgroundCheck->lastName . ' ' . $backgroundCheck->firstName . '-' . $backgroundCheck->idNumber . '.pdf"');
                header('Content-Transfer-Encoding: binary');
                header('Content-Length: ' . strlen($pdfData));

                echo $pdfData;

                exit();
            }
            $this->redirect(array('admin'));
        } else {
            if ($backgroundCheck) {
                WebUser::logAccess("ERROR: Intento descargar el archivo PDF del estudio de sin privilegios: " . $backgroundCheck->fullName . " [" . $backgroundCheck->idNumber . "]", $backgroundCheck->code);
            }
            // Not Available Model;
            $this->redirect(array('admin'));
        }
        return;
    }

    /**
     * Displays a particular model.
     * @param string $code the ID of the model to be displayed
     */

    //Creada por Jonathan Cancelar estudios luego de 1 hora
    public function actionUpdateCancelar2($code) {
        $backgroundCheck = $this->loadModel($code);
        $data = "UPDATE ses_BackgroundCheck SET backgroundCheckStatusId=2, resultId=5, price=0  WHERE  code='".$code."';";
        $query = Yii::app()->db->createCommand($data)->execute();
        WebUser::logAccess("El cliente cancelo el estudio de: " . $backgroundCheck->fullName . " [" . $backgroundCheck->idNumber . "]", $backgroundCheck->code);

        //Eliminar registro de estudio en la tabla TusDatosResponse, si el estudio es cancelado.
        //Natalia Henao--07/01/2022
        $tusDatos = new TusDatosResponse();
        $tusDatos->deleteRegTD($backgroundCheck->id);

        $this->redirect(array('admin'));
        return $query;

    }

    //Creada por Jonathan Cancelar estudios luego de 1 hora


    public function actionVC($code) {
        $backgroundCheck = $this->loadModel($code);
        if ($backgroundCheck &&
            ($backgroundCheck->isCertificateAvailable) &&
            file_exists($backgroundCheck->absolutePath) &&
            Yii::app()->user->arUser->hasAccessToCertificates) {
            WebUser::logAccess("Descargo el certificado PDF del estudio de : " . $backgroundCheck->fullName . " [" . $backgroundCheck->idNumber . "]", $backgroundCheck->code);

            $backgroundCheck->numberOfDownloads = $backgroundCheck->numberOfDownloads + 1;

            if ($backgroundCheck->save()) {

                $pdfData = $backgroundCheck->getBackgroundCheckReportCert(Yii::app()->user->arUser->pdfPassword, true, Yii::app()->user->name, 0, 255);

                header('Content-type: application/pdf');
                // 19-05-2017
                // Se cambia el nombre del archivo
                header('Content-Disposition: inline; filename="' . $backgroundCheck->lastName . ' ' . $backgroundCheck->firstName . '-' . $backgroundCheck->idNumber . '.pdf"');
                header('Content-Transfer-Encoding: binary');
                header('Content-Length: ' . strlen($pdfData));

                echo $pdfData;

                exit();
            }
            $this->redirect(array('admin'));
        } else {
            if ($backgroundCheck) {
                WebUser::logAccess("ERROR: Intento descargar el archivo PDF del estudio de sin privilegios: " . $backgroundCheck->fullName . " [" . $backgroundCheck->idNumber . "]", $backgroundCheck->code);
            }
            // Not Available Model;
            $this->redirect(array('admin'));
        }
        return;
    }

    public function actionCreateCompany() {
        if (Yii::app()->user->arUser->canRequestCompanyReports) {
            $this->create(true);
        } else {
            $this->redirect(array('/site/intro'));
        }
    }

    public function actionCreate() {
        if (Yii::app()->user->arUser->canRequestPersonReport) {
            $this->create(false);
        } else {
            $this->redirect(array('/site/intro'));
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    private function create($isCompanyStudy) {
        if ($isCompanyStudy) {
            $backgroundCheck = new BackgroundCheck('createCompany');
        } else {
            $backgroundCheck = new BackgroundCheck('createPerson');
        }
        $docForm = new DocForm;

        if (isset($_POST['BackgroundCheck'])) {
            $backgroundCheck->attributes = $_POST['BackgroundCheck'];
            $user = CustomerUser::model()->findByPK(Yii::app()->user->id);
            if (!$user || !$user->customerId) {
                $this->redirect(array('/site/intro'));
            }
            $backgroundCheck->customerId = Yii::app()->user->arUser->customerId;
            if (Yii::app()->user->isGroupSupervisor) {
                if ($user->customer->customerGroupId == $backgroundCheck->customerProduct->customer->customerGroupId && Yii::app()->user->arUser->customer->customerGroupId == $backgroundCheck->customerProduct->customer->customerGroupId) {
                    $backgroundCheck->customerId = $backgroundCheck->customerProduct->customerId;
                }
            }
            $backgroundCheck->customerUserId = Yii::app()->user->id;
            $backgroundCheck->backgroundCheckStatusId = BackgroundCheckStatus::REQUESTED;
            $backgroundCheck->requestSystemId = RequestSystem::SES_CLIENT;
            $backgroundCheck->resultId = Result::PENDING;
            $backgroundCheck->studyStartedOn = Yii::app()->db->createCommand('select curdate()')->queryScalar();
            if ($backgroundCheck->customerProduct) {
                $backgroundCheck->cost = $backgroundCheck->customerProduct->cost;
                if($backgroundCheck->customer->isRecover==0){
                    $backgroundCheck->price = $backgroundCheck->customerProduct->price;
                }else{
                    $backgroundCheck->price = 0;
                }
            }
            if ($isCompanyStudy) {
                $backgroundCheck->firstName = BackgroundCheck::DEFAULT_COMPANY_FIRSTNAME;
            }

            if ($backgroundCheck->validate() && $backgroundCheck->checkCustomerFields() && $docForm->validate()) {
                if ($backgroundCheck->save()) {
                    WebUser::logAccess("Solicito el estudio de : " . $backgroundCheck->fullName . " [" . $backgroundCheck->idNumber . "]", $backgroundCheck->code);
                    WebUser::logAccess("Fecha Limite de creacion: ".$backgroundCheck->studyLimitOn,$backgroundCheck->code);

                    $backgroundCheck->dateLimitQuality =  $backgroundCheck->studyLimitOn;

                    foreach ($backgroundCheck->customerProduct->verificationsInProduct as $verificationInProduct) {
                        $verificationSection = new VerificationSection;
                        $verificationSection->backgroundCheckId = $backgroundCheck->id;
                        $verificationSection->verificationSectionTypeId = $verificationInProduct->verificationSectionTypeId;
                        if (!$verificationSection->save()) {
                            Yii::app()->user->setFlash('error', implode(", ", $verificationSection->errors));
                        } else {
                            $verificationSection->createBasicRecords();
                        }

                        //Natalia Henao Mayorga
                        //18/01/2023
                        //inicio de la condicion 
                        if($verificationSection->verificationSectionTypeId==2 || $verificationSection->verificationSectionTypeId==3){
                            $criteria = new CDbCriteria;
                            $criteria->addCondition("t.created<DATE(NOW()) AND t.backgroundCheckStatusId=4");
                            $criteria->addCondition("verificationSections.verificationSectionTypeId=2 OR verificationSections.verificationSectionTypeId=3");
                            $criteria->with=['verificationSections'];
                            $criteria->order='t.id DESC';
                            $modelRell = BackgroundCheck::model()->findByAttributes(array('idNumber' => $backgroundCheck->idNumber), $criteria);

                            if($modelRell){
                                $criteria = new CDbCriteria;
                                $criteria->compare('backgroundCheckId', $modelRell->id);
                                $criteria->addCondition("t.verificationSectionTypeId=2 OR t.verificationSectionTypeId=3");
                                $valVerification = VerificationSection::model()->findAll($criteria);

                                if($valVerification){
                                    foreach ($valVerification as $idVerification) {
                                        if($idVerification->verificationSectionTypeId==2){
                                            $detailEducation = DetailEducation::model()->findAllByAttributes(array('verificationSectionId' => $idVerification->id));
                                            if($detailEducation){
                                                $RegEducation=DetailEducation::automaticCompletionEd($detailEducation, $verificationSection->id);
                                            }
                                        }
                                        if($idVerification->verificationSectionTypeId==3){
                                            $detailJob = DetailJob::model()->findAllByAttributes(array('verificationSectionId' => $idVerification->id));
                                            if($detailJob){
                                                $RegJob=DetailJob::automaticCompletionJob($detailJob, $verificationSection->id);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        //Fin de la condicon
                    }

                    $fileArray = array();
                    for ($i = 1; $i <= 25; $i++) {
                        $filename = "";
                        $fieldDoc = "doc{$i}";
                        $docForm->$fieldDoc = CUploadedFile::getInstance($docForm, $fieldDoc);
                        //VALIDAR inclusión de php
                         if (isset($docForm->$fieldDoc) &&  $docForm->$fieldDoc != null) {
                            $pos = strpos($docForm->$fieldDoc->getName(), '.php');
                            if($pos!==false){
                              throw new CHttpException(400, 'El estudio fué solicitado pero no se logró enviar el archivo adjunto ya que es un tipo de archivo no permitido');
                            }
                        }

                        if (isset($docForm->$fieldDoc)) {
                            $baseName = basename($docForm->$fieldDoc->name);
                            $pathinfoOrig = pathinfo($baseName);
                            $filename = uniqid("svp_f_", true);
                            $docForm->$fieldDoc->saveAs(BackgroundCheck::getFullPath($filename));

                            $path = BackgroundCheck::getFullPath($filename);
                            $data = file_get_contents($path);
                            $base64 = base64_encode($data);

                            $fileArray[] = array('fileName' => $filename, 'baseName' => $baseName,
                                'base64' => $base64);
                        }
                        WebUser::logAccess("Se intenta adjuntar : " . $filename);
                        if ($filename != "" && file_exists(BackgroundCheck::getFullPath($filename))) {
                            WebUser::logAccess("Existe : " . $filename);
                            $document = new Document;
                            $document->backgroundCheckId = $backgroundCheck->id;
                            $pathinfo = pathinfo(BackgroundCheck::getFullPath($filename));
                            $document->name = $pathinfoOrig['filename'];
                            $document->description = 'Archivo enviado por el cliente en la solicitud';
                            $document->extension = strtolower($pathinfoOrig['extension']);
                            $document->size = filesize(BackgroundCheck::getFullPath($filename));
                            if ($document->save()) {
                                $document->checkAbsoluteDir();
                                $document->setUniqueFilename();
                                if (copy(BackgroundCheck::getFullPath($filename), $document->absolutePath) && $document->save()) {
                                    if ($document->isPdf) {
                                        $document->convertToStandardPDF();
                                    }
                                    $document->cryptFile();
                                }
                            } else {
                                throw new CHttpException(400, 'El estudio fué solicitado pero no se logró enviar el archivo adjunto. Por favor envielo por correo electrónico.');
                            }


                            //WebUser::logAccess("Contenido : " . $base64);
                        }
                    }

                    WebUser::logAccess("Número de archivos : " . sizeof($fileArray));

                    $backgroundCheck->assignDefaultUser();

                    if ($isCompanyStudy) {
                        $mailSubject = 'Petición de estudio de Empresa Ref: [' . $backgroundCheck->code . ']';
                    } else {
                        $mailSubject = 'Petición de estudio de Persona Ref: [' . $backgroundCheck->code . ']';
                    }

                    if (!Yii::app()->user->sendMailInBackground(
                    // SUBJECT
                        $mailSubject,

                        // BODY
                        $this->renderPartial('_confirmationEmail', array('model' => $backgroundCheck), true), //

                        // TO
                        array(
                            array(
                                "mail" => Yii::app()->params['serviceEmail']['principalEmail']['email'],
                                "name" => Yii::app()->params['serviceEmail']['principalEmail']['name']
                            )
                        ),

                        // CC
                        array(
                            array(
                                "mail" => Yii::app()->params['serviceEmail']['solicitud']['email'],
                                "name" => Yii::app()->params['serviceEmail']['solicitud']['name']
                            ),
                            array(
                                "mail" => Yii::app()->user->arUser->username,
                                "name" => Yii::app()->user->arUser->name
                            ),

                            array(
                                "mail" => Yii::app()->user->arUser->email2,
                                "name" => Yii::app()->user->arUser->name
                            ),
                            array(
                                "mail" => Yii::app()->user->arUser->email3,
                                "name" => Yii::app()->user->arUser->name
                            ),

                            /*
                            array(
                                "mail" => "dcubillos@sintecto.com",
                                "name" => "Diana Cubillos"
                            ),
                            */

                        ),

                        // BCC
                        array(
                            array(
                                "mail" => Yii::app()->user->arUser->username,
                                "name" => Yii::app()->user->arUser->name
                            ),
                        ),

                        /* old
                        array_merge(
                            array(
                                array(
                                    "mail" => Yii::app()->user->arUser->username,
                                    "name" => Yii::app()->user->arUser->name)
                                ),
                                $backgroundCheck->getResponsibleMail()
                        ), */

                        // FILE
                        $fileArray
                    )
                    ) {
                        Yii::app()->user->setFlash('error', "Hay problemas con el servidor de correo.");
                    }

                    // print_r(Yii::app()->user); die;

                    //proceso jeimy
                    //17/09/2021
                    $criteria = new CDbCriteria;
                    $criteria->compare('backgroundCheckId', $backgroundCheck->id);
                    $criteria->addCondition("verificationSectionTypeId=4 OR verificationSectionTypeId=24");
                    //$criteria->compare('verificationSectionTypeId', '4');
                    $seccionAdv = VerificationSection::model()->findAll($criteria);
                    if($seccionAdv && $backgroundCheck->customer->isRecover==0 && $backgroundCheck->customer->businessLine=="Integridad"){
                        $this->createTusDatosRegister($backgroundCheck);
                    }

                    $this->render('viewConfirmation', array(
                        'model' => $backgroundCheck,
                    ));
                    return;
                }
            }
        } else {
            $backgroundCheck->setDefaults();
            $backgroundCheck->customerId = Yii::app()->user->arUser->customerId;
            $backgroundCheck->customerUserId = Yii::app()->user->id;
        }

        $this->render('create', array(
            'backgroundCheck' => $backgroundCheck,
            'docForm' => $docForm,
            'isCompanyStudy' => $isCompanyStudy,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionLoadFile() {
        $backgroundCheck = new BackgroundCheck;
        $docForm = new DocForm;

        if (isset($_POST['BackgroundCheck'])) {

        } else {
            $backgroundCheck->setDefaults();
            $backgroundCheck->customerId = Yii::app()->user->arUser->customerId;
            $backgroundCheck->customerUserId = Yii::app()->user->id;
        }

        $this->render('loadFile', array(
            'backgroundCheck' => $backgroundCheck,
            'docForm' => $docForm,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->actionAdmin();
    }

    /**
     * Manages all models.
     */
    public function actionAdmin($t = null) {
        if (!Yii::app()->user->arUser->hasAccessToReports) {
            WebUser::logAccess("ERROR: el usuario no tiene permiso para ver el listado de reportes");
            $this->redirect('/site/logout');
            exit();
        }
        $model = GridViewFilter::getFilter('BackgroundCheck', 'search');

        $user = Yii::app()->user->arUser;

        if (isset($_GET['BackgroundCheck']))
            $model->attributes = $_GET['BackgroundCheck'];

        $this->render('admin', array(
            'model' => $model,
            'type' => $t,
            'user' => $user,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */

    /**
     * @return BackgroundCheck
     */
    public function loadModel($code) {
        $criteria = new CDbCriteria;

        if (Yii::app()->user->getIsGroupSupervisor()) {
            $customer = Customer::model()->findByPk(Yii::app()->user->arUser->customerId);
            $criteria->compare('customer.customerGroupId', $customer->customerGroupId);
            $criteria->with[] = 'customer';
        } elseif (Yii::app()->user->getIsSupervisor()) {
            $criteria->compare('customerId', Yii::app()->user->arUser->customerId);
        } else {
            $criteria->compare('customerId', Yii::app()->user->arUser->customerId);
            $criteria->compare('customerUserId', Yii::app()->user->id);
        }
        $model = BackgroundCheck::model()->findByAttributes(array('code' => $code), $criteria);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'background-check-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionCheckIdNumber() {

        if (isset($_POST['idNumber'])) {
            $ans = 0;

            $criteria = new CDbCriteria;

            $criteria->addCondition('t.created>= date_add(NOW(),INTERVAL -2 YEAR) ');

            $customerGroup =  CustomerGroup::model()->findByPk(['id'=>Yii::app()->user->arUser->customer->customerGroupId]);

            if($customerGroup){
                $alert=$customerGroup->alertGroupDoc;
            }
            
            if($alert==1){
                $criteria->addCondition('customer.customerGroupId=:customerGrpId');
                $criteria->addCondition('t.idNumber=:idNumber');
                $criteria->with=['customer.customerGroup'];
                $criteria->params=[':customerGrpId'=>Yii::app()->user->arUser->customer->customerGroupId, ':idNumber'=>CHtml::encode($_POST['idNumber'])];
            }else{
                $criteria->addCondition('t.customerId=:customerId');
                $criteria->addCondition('t.idNumber=:idNumber');
                $criteria->params=[':customerId'=>Yii::app()->user->arUser->customerId, ':idNumber'=>CHtml::encode($_POST['idNumber'])];
            }
        
            $model= BackgroundCheck::model()->findAll($criteria);
            /*if($alert==1){
                $value='customer.customerGroupId';
                $groupCus=Yii::app()->user->arUser->customer->customerGroupId;
            }else{
                $value='customerId';
                $groupCus=Yii::app()->user->arUser->customerId;
            }*/

            /*$model = BackgroundCheck::model()->findByAttributes(
                array('idNumber' => CHtml::encode($_POST['idNumber']),
                    $value => $groupCus,
                ), $criteria
            );*/
            if ($model) {
                $ans = 1;
            }
            WebUser::logAccess("Verifico ID: [" . CHtml::encode($_POST['idNumber']) . "] : " . ($ans == 1 ? "ID Repetido" : "ID Nuevo"));
            echo $ans;
        }
        return;
    }

    //natalia henao
    //30/09/2021 (funcion de ejemplo estudios individuales)
    public function actionUploadDocuments(){

        $model = new BackgroundCheck;
        $records = array();

        $code=CHtml::encode($_POST['code']);
        $bc=BackgroundCheck::findByCodeCus($code);

        if($bc && $bc->customerId==Yii::app()->user->arUser->customerId && $bc->backgroundCheckStatusId == BackgroundCheckStatus::REQUESTED || $bc->backgroundCheckStatusId == BackgroundCheckStatus::PROCESSING){

            $docForm = new DocForm;

            for ($i = 1; $i <= 5; $i++) {
                    $filename = "";
                    $fieldDoc = "doc{$i}";

                $docForm->$fieldDoc = CUploadedFile::getInstance($docForm, $fieldDoc);

                if (isset($docForm->$fieldDoc) &&  $docForm->$fieldDoc != null) {
                    $pos = strpos($docForm->$fieldDoc->getName(), '.php');
                    $pos2 = strpos($docForm->$fieldDoc->getName(), '.html');
                    if($pos!==false || $pos2!==false){
                        throw new CHttpException(400, 'No se logró enviar el archivo adjunto ya que es un tipo de archivo no permitido');
                    }
                }

                //es lo mismo que decir !=null
                if($docForm->$fieldDoc){
                    $baseName = basename($docForm->$fieldDoc->name);
                    $pathinfoOrig = pathinfo($baseName);
                    $filename = uniqid("svp_f_", true);
                    $docForm->$fieldDoc->saveAs(BackgroundCheck::getFullPath($filename));

                    $path = BackgroundCheck::getFullPath($filename);
                    $data = file_get_contents($path);
                    $base64 = base64_encode($data);

                    $fileArray[] = array('fileName' => $filename, 'baseName' => $baseName,
                        'base64' => $base64);
                }
                WebUser::logAccess("Se intenta adjuntar : " . $filename);
                if ($filename != "" && file_exists(BackgroundCheck::getFullPath($filename))) {
                    WebUser::logAccess("Existe : " . $filename);
                    $document = new Document;
                    $document->backgroundCheckId = $bc->id;
                    $pathinfo = pathinfo(BackgroundCheck::getFullPath($filename));
                    $document->name = $pathinfoOrig['filename'];
                    $document->description = 'Archivo enviado por el cliente en la solicitud';
                    $document->extension = strtolower($pathinfoOrig['extension']);
                    $document->size = filesize(BackgroundCheck::getFullPath($filename));
                    if ($document->save()) {
                        $document->checkAbsoluteDir();
                        $document->setUniqueFilename();
                        if (copy(BackgroundCheck::getFullPath($filename), $document->absolutePath) && $document->save()) {
                            if ($document->isPdf) {
                                $document->convertToStandardPDF();
                            }
                            $document->cryptFile();
                        }
                    } else {
                        throw new CHttpException(400, 'El estudio fué solicitado pero no se logró enviar el archivo adjunto. Por favor envielo por correo electrónico.');
                    }
                }
            }
            /*$this->render('uploadMultipleDocument', array(
                'model' => $model,
                'records' => $records,
            ));*/
            //$this->redirect('/vetting/loaddocuments');
        }
        $this->redirect('/vetting/loaddocuments');
    }

    //natalia henao
    //04/10/2021
    public function actionLoaddocuments(){

        $model = new BackgroundCheck;
        $records = array();

        $this->render('uploadDocumentsStudy', array(
            'model' => $model,
            'records' => $records,
        ));
    }

    //natalia henao
    //04/10/2021 (ejemplo código documentos svpold)
    public function actionDeleteDocumentsClient($id, $code) {

        $bc=BackgroundCheck::findByCodeCus($code);

        if ($bc->backgroundCheckStatusId == BackgroundCheckStatus::REQUESTED){
            
            $document = Document::model()->findByPK($id);
            // DELETE de file
            if ($document) {
                if ($document->id) {
                    WebUser::logAccess("Borro el archivo :{$document->name}.{$document->extension} [{$document->size}]", $document->backgroundCheck->code);
                    $document->delete();
                }
            } 
        }
        $this->redirect('/vetting/loaddocuments');
    }

    //natalia henao
    //04/10/2021 (ejemplo código documentos svpold)
    public function actionFile($id) {
        $types = Document::fileTypes();
        $document = Document::model()->findByPK($id);

        if ($document && isset($types[$document->extension])) {
            $filename = $document->absolutePath;
            header('Content-Type: ' . $types[$document->extension]);
            header('Content-Length: ' . filesize($filename));
            echo $document->getDecryptedFile();
            die();
        }
        
    }

    //proceso jeimy 
    //17/09/2021
    public function createTusDatosRegister($bgCheck){

        $criteria = new CDBCriteria();
        $criteria->compare('backgroundcheckId', $bgCheck->id);
        $models = TusDatosResponse::model()->findAll($criteria);

        if ($models != null && count($models)>0) {
            /*foreach($models as $tdRegister){
                $tdRegister->idNumber = $bgCheck->idNumber;
                $tdRegister->dateexp = $bgCheck->datexpedition;
                $tdRegister->idReport = $bgCheck->idNumber;
                $tdRegister->modified = new CDbExpression('NOW()');
                $tdRegister->status =TusDatosResponse::STATUS_PENDING;
                $tdRegister->save(false);
            }*/

        }else{

            $modelTusDatos = new TusDatosResponse();

            if(!empty($bgCheck)){

                $modelTusDatos->backgroundcheckId = $bgCheck->id;
                $modelTusDatos->idNumber = $bgCheck->idNumber;
                $modelTusDatos->dateexp = $bgCheck->datexpedition;
                $modelTusDatos->idReport = $bgCheck->idNumber;
                $modelTusDatos->created = new CDbExpression('NOW()');
                $modelTusDatos->status = TusDatosResponse::STATUS_PENDING;
                $modelTusDatos->save(false);
            }

        }
            
        
    }

    public function actionSelectNovd($ref){
        $this->renderPartial('_selectNovd', array(
            "bgkcode" => $ref,
        ));
    }

    public function actionInsertComents() {
 
        $id=CHtml::encode($_POST['idn']);
        $obs=CHtml::encode($_POST['obs']);
        $code=CHtml::encode($_POST['code']);

        $event = Event::model()->findByPK($id);
        
        if ($event) {
            WebUser::logAccess('', $event->backgroundCheck->code, $event->backgroundCheck->customerUserId);
            if (isset($obs)) {
                $insertcomentsEvents = $event->getInsertComentarios($id, $obs, $code);
                    $event->refresh();
                    WebUser::logAccess("Envio un comentario de la novedad creada:".$event->created, $event->backgroundCheck->code, $event->backgroundCheck->customerUserId);
                    if (!Yii::app()->user->sendMailInBackground(
                                    'El Estudio Ref [' . $event->backgroundCheck->code . '] tiene respuesta de novedad', //
                                    $this->renderPartial('/event/_mailAnswerClient', array('event' => $event), true), //
                                    array(array("mail" => Yii::app()->params['serviceEmail']['principalEmail']['email'], "name" => Yii::app()->params['serviceEmail']['principalEmail']['name'])), //
                                    array(), //
                                    array(), // 
                                    array()
                            )
                    ) {
                        Yii::app()->user->setFlash('error', "Hay problemas con el servidor de correo.");
                    }
            } 

            header('Content-type: application/json');
            echo CJSON::encode($insertcomentsEvents);    
            Yii::app()->end();
        }
    }

    //natalia henao
    //02/06/2022
    public function actionViewdocuments(){

        $model = new BackgroundCheck;
        $records = array();

        $this->render('viewDocumentsStudy', array(
            'model' => $model,
            'records' => $records,
        ));
    }

    public function actionFileSaveAs($id) {
        $types = Document::fileTypes();
        $document = Document::model()->findByPK($id);
        if ($document && isset($types[$document->extension])) {
            $file = $document->getDecryptedFile();
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Pragma: public");
            header('Content-Type: ' . $types[$document->extension]);
            header('Content-disposition: attachment; filename="' . $document->name . '.' . $document->extension . '"');
            header('Content-Length: ' . strlen($file));
            echo $file;
            die();
        }
    }

    public function actionExportEvent() {

        if(Yii::app()->user->arUser->isSupervisor==1 && Yii::app()->user->arUser->isGroupSupervisor==0){
            $customerId=Yii::app()->user->arUser->customerId;
            $exportEvent = CustomerUser::getDetailEventClient($customerId, $us=1);
        }else if(Yii::app()->user->arUser->isGroupSupervisor==1){
            $customergroupId=Yii::app()->user->arUser->customer->customerGroupId;
            $exportEvent = CustomerUser::getDetailEventClient($customergroupId, $us=2);
        }else{
            $customerUserId=Yii::app()->user->arUser->id;
            $exportEvent = CustomerUser::getDetailEventClient($customerUserId, $us=3);
        }
          
            /*echo var_dump($exportEvent);
            die();*/
            echo $this->renderPartial( '_csvEventExport'
                    , array(
                'exportEvent' => $exportEvent,
            ));
    }
    

}