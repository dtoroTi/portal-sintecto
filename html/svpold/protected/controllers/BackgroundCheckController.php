<?php

class BackgroundCheckController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $defaultAction = 'admin';
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

    const MINIMUN_PRICE = 3000;

    /**
     * Displays a particular model.
     * @param string $code the ID of the model to be displayed
     */

    public function actionFormdataDoc() {


        $this->render( 'formdataDoc');

    }



    public function actionDatadoc() {

        // $fromDate = $_POST['Desde'];
       // $untilDate = $_POST['Hasta'];
        $fromDate ='1990-01-01';
        $untilDate ='2017-12-31';
        $empresaId = $_POST['codcustomer'];


        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $studies2 = Yii::app()->db->createCommand()
                ->select('doc.id, doc.filename,bck.code, ctm.name')
                ->from('ses_Document doc')
                ->join('ses_BackgroundCheck bck', 'bck.id=doc.backgroundCheckId')
                ->join('ses_Customer ctm', 'ctm.id=bck.customerId')
                ->join('ses_CustomerGroup ctmg', 'ctmg.id=ctm.customerGroupId')
                // ->where('doc.backgroundCheckId=109')
                ->where('bck.customerId=:empresaId')
                ->andWhere('bck.created>=:fromDate')
                ->andWhere('bck.created<=:untilDate')

                ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate,"empresaId"=>$empresaId));


            $this->render( 'datadoc',array("studies2"=>$studies2,"fromDate"=>$fromDate,"untilDate"=>$untilDate,"empresaId"=>$empresaId));


        }
    }
    public function actionDatadocDelete() {
        $fromDateDelete = '1990-01-01';
        $untilDateDelete = '2017-12-31';

        #$fromDateDelete = $_POST['DesdeEliminar'];
        #$untilDateDelete = $_POST['HastaEliminar'];
        $empresaIdDelete = $_POST['codcustomerEliminar'];


        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $studies3 = Yii::app()->db->createCommand()
                ->select('doc.id, doc.filename,bck.code, ctm.name')
                ->from('ses_Document doc')
                ->join('ses_BackgroundCheck bck', 'bck.id=doc.backgroundCheckId')
                ->join('ses_Customer ctm', 'ctm.id=bck.customerId')
                ->join('ses_CustomerGroup ctmg', 'ctmg.id=ctm.customerGroupId')
                // ->where('doc.backgroundCheckId=109')
                ->where('bck.customerId=:empresaIdDelete')
                ->andWhere('bck.created>=:fromDateDelete')
                ->andWhere('bck.created<=:untilDateDelete')

                ->queryAll(TRUE, array(':fromDateDelete' => $fromDateDelete, ':untilDateDelete' => $untilDateDelete,"empresaIdDelete"=>$empresaIdDelete));


            $this->render( 'datadocDelete',array("studies3"=>$studies3,"fromDateDelete"=>$fromDateDelete,"untilDateDelete"=>$untilDateDelete,"empresaIdDelete"=>$empresaIdDelete));


        }
    }

    public function actionV($code) {
        $backgroundCheck = $this->loadModel($code);
        if (!$backgroundCheck) {
// Not Available Model;
            $this->redirect(array('admin'));
            return;
        }
        $event = new Event;

        if (isset($_POST['Event'])) {
            $event->attributes = $_POST['Event'];
            $event->backgroundCheckId = $backgroundCheck->id;

            if ($event->save()) {
                
            }
        }

        $contact = new Contact();

        if (isset($_POST['Event'])) {
            $contact->attributes = $_POST['Contact'];
            $contact->backgroundCheckId = $backgroundCheck->id;

            if ($contact->save()) {
            }
        }

        $this->render('view', array(
            'model' => $backgroundCheck,
            'event' => $event,
            'contact' => $contact,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    private function createRecord($attributes, $isCompanySurvey = FALSE, $redirect = TRUE, $sendMail = TRUE) {
        $user = User::model()->findByPk(Yii::app()->user->getId());

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
                if ($model->customerUser->notifyByMail==1){
                    if ($sendMail){
                        $customerMailParam = array ("mail" => $model->customerUser->username, "name" => $model->customerUser->name);
                        $body = $this->renderPartial('_mailCreate', array(
                            'backgroundCheck' => $model,
                        ), true);
                        //Creado por Jonathan
                        if ($user->MailStudyRequest > 0) {
                            Yii::app()->user->sendMailInBackground(
                                'Petición de Estudio de Seguridad [Ref:' . $model->code . '] (SVision)', //
                                $body, //
                                array(Yii::app()->user->arUser->mailParam,), // Desactivar
                                array(Yii::app()->user->arUser->mailParam, $customerMailParam), //
                                array(Yii::app()->params['serviceEmail']['solicitud'],), //
                                ($model->responsible ? $model->getResponsibleMail() : null)
                            );
                        }
                    }
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

    public function actionCreateCompanySurvey() {
        $param = null;
        if (isset($_POST['BackgroundCheck'])) {
            $param = $_POST['BackgroundCheck'];
        }

        $model = $this->createRecord($param, TRUE);

        $this->render('create', array(
            'model' => $model,
            'activeTab' => 0,
            'pc' => 0,
            'companySurvey' => true,
        ));
    }

    public function actionCreate($pc = false) {
        $param = null;
        if (isset($_POST['BackgroundCheck'])) {
            $param = $_POST['BackgroundCheck'];
        }

        $model = $this->createRecord($param, FALSE);

        $this->render('create', array(
            'model' => $model,
            'activeTab' => 0,
            'pc' => $pc,
            'companySurvey' => false,
        ));
    }

    function mb_punctuation_trim($string) {
        $ans = str_replace(array(chr(0xff) . chr(0xfe), chr(0x00)), '', $string);
        return $ans;
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
                        $prevRecord = BackgroundCheck::model()->findByAttributes(
                                array(
                                    'idNumber' => $row['idNumber'],
                                    'customerId' => $model->customerId,
                        ));
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

    // actionCreateMultipleCompany
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
                        $prevRecord = BackgroundCheck::model()->findByAttributes(
                                array(
                                    'idNumber' => $row['idNumber'],
                                    'customerId' => $model->customerId,
                        ));
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

    function getCsvData($file){
        $csv = array_map('str_getcsv', file($file));

        /*echo "<pre>";
        foreach ($csv as $i => $valor) {
            print_r(count($valor));
            if (count($valor) !== 105) {
                print_r($i);
                print_r($valor);
                print_r($csv[$i+1]);
                print_r("\n Error de valor, array mal\n ***************");
            }
            print_r("\n");
        }        
        //print_r($csv);
        exit;//*/
        array_walk($csv, function(&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });
        array_shift($csv); # remove column header

        return $csv;
    }

    function makeArrayData($dataExplode){
        foreach ($dataExplode as $c => $datos) {
            $campos = preg_split("/[,:]+/", $datos);
            for ($i=0; $i <= count($campos)-1; $i+=2) { 
                $dato[trim($campos[$i])] = trim($campos[$i+1]);
            }
            $dataExplode[$c] = $dato;
        }
        return $dataExplode;
    }

    function getMultipleFields($data){
        foreach ($data as $i => $row) {
            $infoFamiliaJson = json_decode($row['Agregue la información mínimo de 5 personas, 1 de las 5 que no viva con usted']);
            $infoReferenciaJson = json_decode($row['Agregue la información mínimo de 2 personas']);

            $data[$i]['Agregue la información mínimo de 5 personas, 1 de las 5 que no viva con usted'] = $infoFamiliaJson;
            $data[$i]['Agregue la información mínimo de 2 personas'] = $infoReferenciaJson;

            //Si el campo esta dividido por pipes, comas y dos puntos, descomentar esta parte y comentar
            //la de procesamiento del Json
            /*foreach ($row as $key => $valor) {
                $dataExplode = explode("|", $valor);
                if (count($dataExplode) != 1) {
                    $dataExplode = $this->makeArrayData($dataExplode);
                    $data[$i][$key] = $dataExplode;
                }->${'Tel Fijo'}
            }//*/
        }

        return $data;
    }

    function createMultipleStudiesArmada($data){
        foreach ($data as $key => $datos) {
            $fechaActual = new DateTime('now', timezone_open('America/Bogota'));
            $fechaLimite = new DateTime('now', timezone_open('America/Bogota'));
            $fechaLimite->add(new DateInterval('P4D'));
            $newStudy = array(
                'customerId' => 286,
                'customerProductId' => 1565,
                'customerUserId' => '884',
                'firstName' => $datos['NOMBRE'],
                'lastName' => $datos['APELLIDO'],
                'idNumber' => $datos['Numero de cedula o documento de identidad'],
                'idFrom' => "",
                'birthday' => $datos['Fecha de nacimiento'],
                'birthPlace' => $datos['Lugar de nacimiento'],
                'relationshipStatusId' => '',
                'state' => '',
                'city' => $datos['Ciudad de residencia'],
                'address' => $datos['Direccion donde reside'],
                'area' => '',
                'tels' => $datos['Celular']." ".$datos['Telefono fijo con indicativo 03X'],
                'actualJob' => $datos['Cargo en la ultima empresa'],
                'applyToPosition' => 'Cargo',
                'studyStartedOn' => $fechaActual->format('Y-m-d'),
                'backgroundCheckStatusId' => 1,
                'requestSystemId' => 1,
                'studyLimitOn' => $fechaLimite->format('Y-m-d'),
                'findingLaboralHistory' => FALSE,
                'findingSocioeconomic' => FALSE,
                'findingVisit' => FALSE,
                'findingReturn' => FALSE,
                'findingStudy' => FALSE,
                'findingPolygraph' => FALSE,
                'findingOther' => FALSE,
                'resultId' => 1,
                'comments' => '',
            );

            $model = $this->createRecord($newStudy, FALSE , FALSE);
            //$model = BackgroundCheck::model()->findByPk(131459);

            $this->crearPersonasArmada($datos,$model);
            $this->crearReferenciasArmada($datos,$model);
            $this->crearTrabajosArmada($datos,$model);
            $this->crearAcademicosArmada($datos,$model);
            /*echo "<pre>";
            print_r("Registro creado y asociado con trabajos\n");
            print_r($model[$key]->attributes);
            exit;//*/
            $model = null;
            unset($model);
        }

        $url = $this->createUrl('/backgroundCheck/admin');

        $this->redirect($url, true);
    }

    function getNivelAcademicoId($nivel){
        switch ($nivel) {
            case 'Universitario':
                return array(
                    'Graduado' => 1,
                    'id' => 4,
                );
                break;
            case 'Bachiller':
                return array(
                    'Graduado' => 1,
                    'id' => 2,
                );
                break;
            case 'Tecnólogo':
                return array(
                    'Graduado' => 1,
                    'id' => 3,
                );
                break;
            case 'Bachiller Incompleto':
                return array(
                    'Graduado' => 0,
                    'id' => 2,
                );
                break;
            case 'Postgrado':
                return array(
                    'Graduado' => 1,
                    'id' => 6,
                );
                break;
            case 'Postgrado incompleto':
                return array(
                    'Graduado' => 0,
                    'id' => 5,
                );
                break;
            case 'Universitario incompleto':
                return array(
                    'Graduado' => 0,
                    'id' => 2,
                );
                break;
            case 'PhD ':
                return array(
                    'Graduado' => 1,
                    'id' => 7,
                );
                break;
            case 'PhD incompleto':
                return array(
                    'Graduado' => 0,
                    'id' => 7,
                );
                break;
            case 'Tecnólogo incompleto':
                return array(
                    'Graduado' => 0,
                    'id' => 3,
                );
                break;
            case 'Técnico':
                return array(
                    'Graduado' => 1,
                    'id' => 3,
                );
                break;
            case 'Técnico Incompleto':
                return array(
                    'Graduado' => 0,
                    'id' => 3,
                );
                break;
            case 'Maestria incompleto':
                return array(
                    'Graduado' => 0,
                    'id' => 6,
                );
                break;
            case 'Maestria':
                return array(
                    'Graduado' => 1,
                    'id' => 6,
                );
                break;
            default:
                $criteria = new CDBCriteria;
                $criteria->compare('name',$nivel);
                echo "<pre>";
                print_r($nivel);
                exit;
                break;
                $nivelAcademico = EducationType::model()->findAll($criteria);
                return array(
                    'Graduado' => 0,
                    'id' => $nivelAcademico->id,
                );;
                break;
        }
    }

    function crearAcademicosArmada($datos,$model){
        //Variables generales
        $codigoEstudio = $model->code;
        $idEstudio = $model->id;

        //Sección para lo académico de la persona
        $criteria = new CDbCriteria;
        $criteria->compare('backgroundCheckId',$idEstudio);
        $criteria->compare('verificationSectionTypeId','2');

        $seccionAcademico = VerificationSection::model()->findAll($criteria);
        $seccionAcademicoId = $seccionAcademico[0]->id;

        if ($datos['Nivel académico máximo 1']) {
            //Último nivel académico
            
            $nivelAcademicoId = $this->getNivelAcademicoId($datos['Nivel académico máximo 1']);

            $fechaGrado = new DateTime($datos['Fecha de grado 1'], timezone_open('America/Bogota'));
            $graduacionAno = $fechaGrado->format('Y');

            $ultimoNivelAcademico = array(
                'verificationSectionId' => $seccionAcademicoId,
                'verificationResultId' => 2,
                'educationTypeId' => $nivelAcademicoId['id'],
                'institution' => $datos['Establecimiento 1'],
                'tel' => '',
                'city' => '',
                'country' => '',
                'startedOn' => '',
                'finishedOn' => '',
                'title' => $datos['Titulo obtenido 1'],
                'stillStuding' => $datos['Fecha de grado 1'] ? 0 : 1,
                'didObtainDiploma' => $nivelAcademicoId['Graduado'] ? 1 : 0,
                'comments' => '',
                'verifiedOn' => '',
                'contact' => '',
                'graduationYear' => $graduacionAno,
                'registry' => '',
                'folio' => '',
                'book' => '',
                'minute' => $datos['No acta 1 O'],
            );
            $objUltimoNivelAcademico = new DetailEducation;
            $objUltimoNivelAcademico->attributes = $ultimoNivelAcademico;
            $objUltimoNivelAcademico->save();

            $nivelAcademicoId = null;
            unset($nivelAcademicoId);
            $fechaGrado = null;
            unset($fechaGrado);
            $graduacionAno = null;
            unset($graduacionAno);
            $ultimoNivelAcademico = null;
            unset($ultimoNivelAcademico);
            $objUltimoNivelAcademico = null;
            unset($objUltimoNivelAcademico);
        }

        //Anterior nivel académico
        if ($datos['Nivel académico 2']) {

            $nivelAcademicoId = $this->getNivelAcademicoId($datos['Nivel académico 2']);

            $fechaGrado = new DateTime($datos['Fecha de grado 2'], timezone_open('America/Bogota'));
            $graduacionAno = $fechaGrado->format('Y');

            $nivelAcademico = array(
                'verificationSectionId' => $seccionAcademicoId,
                'verificationResultId' => 2,
                'educationTypeId' => $nivelAcademicoId['id'],
                'institution' => $datos['Establecimiento 2'],
                'tel' => '',
                'city' => '',
                'country' => '',
                'startedOn' => '',
                'finishedOn' => '',
                'title' => $datos['Titulo obtenido 2'],
                'stillStuding' => $datos['Fecha de grado 2'] ? 0 : 1,
                'didObtainDiploma' => $nivelAcademicoId['Graduado'] ? 1 : 0,
                'comments' => '',
                'verifiedOn' => '',
                'contact' => '',
                'graduationYear' => $graduacionAno,
                'registry' => '',
                'folio' => '',
                'book' => '',
                'minute' => $datos['No acta 2 O'],
            );
            $objNivelAcademico = new DetailEducation;
            $objNivelAcademico->attributes = $nivelAcademico;
            $objNivelAcademico->save();

            $nivelAcademicoId = null;
            unset($nivelAcademicoId);
            $fechaGrado = null;
            unset($fechaGrado);
            $graduacionAno = null;
            unset($graduacionAno);
            $nivelAcademico = null;
            unset($nivelAcademico);
            $objNivelAcademico = null;
            unset($objNivelAcademico);
        }

        $codigoEstudio = null;
        unset($codigoEstudio);
        $idEstudio = null;
        unset($idEstudio);
        $criteria = null;
        unset($criteria);
        $seccionAcademico = null;
        unset($seccionAcademico);
        $seccionAcademicoId = null;
        unset($seccionAcademicoId);
    }

    function crearTrabajosArmada($datos,$model){
        //Variables generales
        $codigoEstudio = $model->code;
        $idEstudio = $model->id;

        //Sección para los empleos de la persona
        $criteria = new CDbCriteria;
        $criteria->compare('backgroundCheckId',$idEstudio);
        $criteria->compare('verificationSectionTypeId','3');

        $seccionTrabajos = VerificationSection::model()->findAll($criteria);
        $seccionTrabajosId = $seccionTrabajos[0]->id;

        if ($datos['Nombre de la ultima empresa']) {
            $ultimoEmpleo = array(
                'verificationSectionId' => $seccionTrabajosId,
                'verificationResultId' => 2,
                'company' => $datos['Nombre de la ultima empresa'],
                'city' => '',
                'country' => '',
                'tel' => $datos['Telefono ultima empresa'],
                'startedOn' => $datos['Fecha de ingreso ultima empresa'],
                'finishedOn' => $datos['Fecha de retiro ultima empresa'],
                'stillWorking' => $datos['Labora actualmente aqui?'] == 'Si' ? 1 : 0,
                'lastPosition' => $datos['Cargo en la ultima empresa'],
                'firstPosition' => $datos['Cargo en la ultima empresa'],
                'comments' => '',
                'verifiedOn' => '',
                'nameOfContact' => '',
                'retireReason' => $datos['Causal de retiro ultima empresa'],
                'workDetail' => '',
                'contractType' => $datos['Tipo de contrato ultima empresa'],
                'strenghts' => '',
                'weaknesses' => '',
                'wouldYouContractAgain' => '',
                'wouldYouRecomend' => '',
                'contactPosition' => '',
                'immediateBoss' => $datos['Nombre jefe inmediato ultima empresa '],
                'immediateBossContact' => $datos['Telefono jefe inmediato ultima empresa'],
            );

            $objUltimoEmpleo = new DetailJob;
            $objUltimoEmpleo->attributes = $ultimoEmpleo;
            $objUltimoEmpleo->save();

            $ultimoEmpleo = null;
            unset($ultimoEmpleo);
            $objUltimoEmpleo = null;
            unset($objUltimoEmpleo);
        }

        if ($datos['Nombre de la penultima empresa']) {
            $penultimoEmpleo = array(
                'verificationSectionId' => $seccionTrabajosId,
                'verificationResultId' => 2,
                'company' => $datos['Nombre de la penultima empresa'],
                'city' => '',
                'country' => '',
                'tel' => $datos['Telefono penultima empresa'],
                'startedOn' => $datos['Fecha de ingreso penultima empresa'],
                'finishedOn' => $datos['Fecha de retiro penultima empresa'],
                'stillWorking' => 0,
                'lastPosition' => $datos['Cargo en la penultima empresa'],
                'firstPosition' => $datos['Cargo en la penultima empresa'],
                'comments' => '',
                'verifiedOn' => '',
                'nameOfContact' => '',
                'retireReason' => $datos['Causal de retiro penultima empresa'],
                'workDetail' => '',
                'contractType' => $datos['Tipo de contrato penultima empresa'],
                'strenghts' => '',
                'weaknesses' => '',
                'wouldYouContractAgain' => '',
                'wouldYouRecomend' => '',
                'contactPosition' => '',
                'immediateBoss' => $datos['Nombre jefe inmediato penultima empresa '],
                'immediateBossContact' => $datos['Telefono jefe inmediato penultima empresa'],
            );

            $objPenultimoEmpleo = new DetailJob;
            $objPenultimoEmpleo->attributes = $penultimoEmpleo;
            $objPenultimoEmpleo->save();

            $penultimoEmpleo = null;
            unset($penultimoEmpleo);
            $objPenultimoEmpleo = null;
            unset($objPenultimoEmpleo);
        }

        if ($datos['Nombre de la antepenultima empresa']) {
            $antepenultimoEmpleo = array(
                'verificationSectionId' => $seccionTrabajosId,
                'verificationResultId' => 2,
                'company' => $datos['Nombre de la antepenultima empresa'],
                'city' => '',
                'country' => '',
                'tel' => $datos['Telefono antepenultima empresa'],
                'startedOn' => $datos['Fecha de ingreso antepenultima empresa'],
                'finishedOn' => $datos['Fecha de retiro antepenultima empresa'],
                'stillWorking' => 0,
                'lastPosition' => $datos['Cargo en la antepenultima empresa'],
                'firstPosition' => $datos['Cargo en la antepenultima empresa'],
                'comments' => '',
                'verifiedOn' => '',
                'nameOfContact' => '',
                'retireReason' => $datos['Causal de retiro antepenultima empresa'],
                'workDetail' => '',
                'contractType' => $datos['Tipo de contrato antepenultima empresa'],
                'strenghts' => '',
                'weaknesses' => '',
                'wouldYouContractAgain' => '',
                'wouldYouRecomend' => '',
                'contactPosition' => '',
                'immediateBoss' => $datos['Nombre jefe inmediato antepenultima empresa'],
                'immediateBossContact' => $datos['Telefono jefe inmediato antepenultima empresa'],
            );

            $objAntepenultimoEmpleo = new DetailJob;
            $objAntepenultimoEmpleo->attributes = $antepenultimoEmpleo;
            $objAntepenultimoEmpleo->save();

            $antepenultimoEmpleo = null;
            unset($antepenultimoEmpleo);
            $objAntepenultimoEmpleo = null;
            unset($objAntepenultimoEmpleo);
        }

        $codigoEstudio = null;
        unset($codigoEstudio);
        $idEstudio = null;
        unset($idEstudio);
        $criteria = null;
        unset($criteria);
        $seccionTrabajos = null;
        unset($seccionTrabajos);
        $seccionTrabajosId = null;
        unset($seccionTrabajosId);
    }

    function crearReferenciasArmada($datos,$model){

        if ($datos['Agregue la información mínimo de 2 personas']) {
            //Variables generales
            $codigoEstudio = $model->code;
            $idEstudio = $model->id;
            $referencias = $datos['Agregue la información mínimo de 2 personas'];

            //Sección para las referencias de la persona
            $criteria = new CDbCriteria;
            $criteria->compare('backgroundCheckId',$idEstudio);
            $criteria->compare('verificationSectionTypeId','8');

            $seccionReferencias = VerificationSection::model()->findAll($criteria);
            $seccionReferenciasId = $seccionReferencias[0]->id;

            foreach ($referencias as $key => $referencia) {
                $newDetailPerson = new DetailPerson;
                $newDetailPerson->verificationSectionId = $seccionReferenciasId;
                $newDetailPerson->verificationResultId = 2;
                $newDetailPerson->name = $referencia->Nombre;
                $newDetailPerson->tel = $referencia->Celular." ".$referencia->{'Tel Fijo'};
                $newDetailPerson->relation = $referencia->{'Relacion y/o Actividad'};
                $newDetailPerson->workingAt = $referencia->Ocupacion;
                $newDetailPerson->howLongKnowEachOther = $referencia->{'Tiempo de conocidos'};

                $newDetailPerson->save();
            }

            $codigoEstudio = null;
            unset($codigoEstudio);
            $idEstudio = null;
            unset($idEstudio);
            $referencia = null;
            unset($referencia);
            $criteria = null;
            unset($criteria);
            $seccionReferencias = null;
            unset($seccionReferencias);
            $seccionReferenciasId = null;
            unset($seccionReferenciasId);
        }
    }

    function crearPersonasArmada($datos,$model){

        if ($datos['Agregue la información mínimo de 5 personas, 1 de las 5 que no viva con usted']) {
            //Variables generales
            $codigoEstudio = $model->code;
            $idEstudio = $model->id;
            $personas = $datos['Agregue la información mínimo de 5 personas, 1 de las 5 que no viva con usted'];

            /*
            print_r($data[0]['Agregue la información mínimo de 5 personas, 1 de las 5 que no viva con usted'][0]->{'Nombre'});//*/

            $viviendaSi = null;
            $viviendaNo = null;
            foreach ($personas as $persona) {
                if ($persona->{'Vive con usted?'} == 'Si') {
                    $viviendaSi[] = $persona;
                }elseif($persona->{'Vive con usted?'} == 'No'){
                    $viviendaNo[] = $persona;
                }
            }

            //Sección para los que viven con la persona
            $criteria = new CDbCriteria;
            $criteria->compare('backgroundCheckId',$idEstudio);
            $criteria->compare('verificationSectionTypeId','6');

            $viviendaSeccion = VerificationSection::model()->findAll($criteria);
            $seccionViviendaId = $viviendaSeccion[0]->id;

            //Sección para los que no viven con la persona
            $criteria = new CDbCriteria;
            $criteria->compare('backgroundCheckId',$idEstudio);
            $criteria->compare('verificationSectionTypeId','7');

            $familiaSeccion = VerificationSection::model()->findAll($criteria);
            $seccionFamiliaId = $familiaSeccion[0]->id;

            if (count($viviendaSi) > 0) {
                //Creando y guardando los familiares que viven con la persona
                foreach ($viviendaSi as $key => $persona) {
                    $newDetailPerson = new DetailPerson;
                    $newDetailPerson->verificationSectionId = $seccionViviendaId;
                    $newDetailPerson->verificationResultId = 2;
                    $newDetailPerson->name = $persona->Nombre;
                    $newDetailPerson->tel = $persona->Celular." ".$persona->{'Tel Fijo'};
                    $newDetailPerson->relation = $persona->Parentesco;
                    $newDetailPerson->workingAt = $persona->Ocupacion;

                    $newDetailPerson->save();
                }
            }

            if (count($viviendaNo) > 0) {
                //Creando y guardando los familiares que no viven con la persona
                foreach ($viviendaNo as $key => $persona) {
                    $newDetailPerson = new DetailPerson;
                    $newDetailPerson->verificationSectionId = $seccionFamiliaId;
                    $newDetailPerson->verificationResultId = 2;
                    $newDetailPerson->name = $persona->Nombre;
                    $newDetailPerson->tel = $persona->Celular." ".$persona->{'Tel Fijo'};
                    $newDetailPerson->relation = $persona->Parentesco;
                    $newDetailPerson->workingAt = $persona->Ocupacion;

                    $newDetailPerson->save();
                }
            }
        }
    }

    public function actionRevisarArchivosZip(){
        //Ruta de almacenamiento de los archivos ZIP
        //$docDir = Yii::app()->params['docsDir'];
        $docDir = Yii::app()->getRuntimePath();

        $filehandle = opendir($docDir);
         
        //Busca los Zip para poder obtener las rutas de los archivos válidos
        $archivosValidos = null;
        while ($file = readdir($filehandle)) {
            if ($file != "." && $file != "..") {
                
                $ruta = $docDir.'/'.$file;
                $pedazos = explode(".", $file);
                $pedazosLength = count($pedazos) - 1;
                $extension = $pedazos[$pedazosLength];
                if ($extension == 'zip') {
                    $archivosValidos[$pedazos[0]] = $ruta;
                }
            }
        }
        
        closedir($filehandle);

        foreach ($archivosValidos as $cedula => $rutaArchivo) {

            $criteria = new CDBCriteria;
            $criteria->compare('idNumber',$cedula);
            $models = BackgroundCheck::model()->findAll($criteria);
            if ($models !== null) {
                $this->relacionarArchivos($cedula,$models,$rutaArchivo);
            }
        }
    }

    function relacionarArchivos($cedula,$models,$rutaArchivo){
        $nombresFichZIP = array();
        $zip = new ZipArchive;
        //Cambiar la ruta de descrompesión!!!
        $rutaExtracion = Yii::app()->getRuntimePath().'/'.$cedula.'/';
         
        //Se obtienen los nombres de los archivos que se encuentran dentro del ZIP
        if ($zip->open($rutaArchivo) === TRUE)
        {
           for($i = 0; $i < $zip->numFiles; $i++)
           {
            //Nombres de los archivos
            $nombresFichZIP[] = $zip->getNameIndex($i);
           }         
           //Se descomprime el zip
           $zip->extractTo($rutaExtracion);
           $zip->close();
        }

        foreach ($models as $i => $estudio) {
            foreach ($nombresFichZIP as $c => $nombreArchivoN) {

                //ruta del archivo
                $filename = $rutaExtracion.$nombreArchivoN;
                
                //Información del archivo
                $pathinfoOrig = pathinfo($filename);

                //Pregunta si el archivo existe
                if ($filename != "" && file_exists($filename)) {

                    //Crea el nuevo modelo para asignar el nuevo documento
                    $document = new Document;
                    //Se asignan los atributos al nuevo modelo
                    $document->backgroundCheckId = $estudio->id;
                    $document->name = $pathinfoOrig['filename'];
                    $document->description = 'Archivo agregado automáticamente';
                    $document->extension = strtolower($pathinfoOrig['extension']);
                    $document->size = filesize($filename);
                    //Salvar el archivo
                    if ($document->save()) {
                        //Crear nuevo nombre y obtener ruta absoluta del archivo
                        $document->checkAbsoluteDir();
                        $document->setUniqueFilename();

                        //Copia el archivo a la posición establecida
                        if (copy($filename, $document->absolutePath) && $document->save()) {
                            if ($document->isPdf) {
                                $document->convertToStandardPDF();
                            }
                            //Encripta los archivos
                            $document->cryptFile();
                        }
                    } else {
                        throw new CHttpException(400, 'El estudio fue solicitado pero no se logró enviar el archivo adjunto. Por favor envielo por correo electrónico.');
                    }
                }
            }
        }
        //Elimina la carpeta temporal donde se extrajeron los archivos
        foreach ($nombresFichZIP as $i => $archivo) {
            unlink($rutaExtracion.$archivo);
        }
        rmdir($rutaExtracion);

        $url = $this->createUrl('/backgroundCheck/admin');

        $this->redirect($url, true);
    }

    public function actionCreateMultipleStudies() {
        $user = User::model()->findByPk(Yii::app()->user->getId());
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
            if ($user->MailStudyRequest > 0) {
                Yii::app()->user->sendMailInBackground(
                    'Petición de Estudios de Seguridad [Ref:' . $model->code . '] (SVision)', //
                    $body, //
                    array(Yii::app()->user->arUser->mailParam,), //
                    array(Yii::app()->params['serviceEmail']['solicitud'],)
                );
            }
            Yii::app()->user->setFlash('notification', "Se crearon los registros.");
        } else {
            Yii::app()->user->setFlash('error', "Error en archivo de cargas múltiples.");
        }
        $this->render('createMultipleConfirm', array(
            'model' => $model,
            'records' => $records,
        ));
    }
    
    // actionCreateMultipleCompanyStudies
    public function actionCreateMultipleCompanyStudies() {
        $user = User::model()->findByPk(Yii::app()->user->getId());
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
            if ($user->MailStudyRequest > 0) {
                Yii::app()->user->sendMailInBackground(
                    'Petición de Estudios de Seguridad [Ref:' . $model->code . '] (SVision)', //
                    $body, //
                    array(Yii::app()->user->arUser->mailParam,), //
                    array(Yii::app()->params['serviceEmail']['solicitud'],)
                );
            }
            Yii::app()->user->setFlash('notification', "Se crearon los registros.");
        } else {
            Yii::app()->user->setFlash('error', "Error en archivo de cargas múltiples.");
        }
        $this->render('createMultipleCompanyConfirm', array(
            'model' => $model,
            'records' => $records,
        ));
    }

    public function actionChangeReportType($code, $customerProductId, $pc = false) {
        $backgroundCheck = $this->loadModel($code);
        $customerProdValideFD = CustomerProduct::model()->findByPk((int) $customerProductId);

        if($backgroundCheck->ooidFD!='' && $backgroundCheck->statusFD==0 && $customerProdValideFD->viewDynamicForm==0){
                Yii::app()->user->setFlash('error', "¡¡ Este estudio cuenta con registro de formulario dinámico, por favor traer datos del formulario para que pueda cambiar el Producto de Cliente. !!");
        }else{

            if ($backgroundCheck && $customerProductId && $backgroundCheck->canUpdate && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())) {
                $customerProduct = CustomerProduct::model()->findByPk((int) $customerProductId);
                if ($customerProduct && $customerProduct->customerId == $backgroundCheck->customerId) {
                    $backgroundCheck->customerProductId = $customerProduct->id;
                    $backgroundCheck->price = $customerProduct->price;
                    $backgroundCheck->cost = $customerProduct->cost;
                    if ($backgroundCheck->save()) {
                        $newVerificationInProducts = array();
                        foreach ($backgroundCheck->customerProduct->verificationsInProduct as $verificationInProduct) {
                            $newVerificationInProducts[$verificationInProduct->verificationSectionTypeId] = $verificationInProduct;
                        }

                        foreach ($backgroundCheck->verificationSections as $verificationSection) {
                            /* @var $verificationSection VerificationSection */
                            if (isset($newVerificationInProducts[$verificationSection->verificationSectionTypeId])) {
                                $verificationSection->showOrder = $newVerificationInProducts[$verificationSection->verificationSectionTypeId]->showOrder;
                                if (!$verificationSection->save()) {
                                    Yii::app()->user->setFlash('error', implode(", ", $verificationSection->errors));
                                }
                                unset($newVerificationInProducts[$verificationSection->verificationSectionTypeId]);
                            } else {
                                $verificationSection->delete();
                            }
                        }

                        foreach ($newVerificationInProducts as $verificationInProduct) {
                            $verificationSection = new VerificationSection;
                            $verificationSection->backgroundCheckId = $backgroundCheck->id;
                            $verificationSection->verificationSectionTypeId = $verificationInProduct->verificationSectionTypeId;
                            $verificationSection->showOrder = $verificationInProduct->showOrder;
                            if (!$verificationSection->save()) {
                                Yii::app()->user->setFlash('error', implode(", ", $verificationSection->errors));
                            } else {
                                $verificationSection->createBasicRecords();
                            }
                        }
                        WebUser::logAccess("Cambio el tipo de reporte a : {$customerProduct->name}", $backgroundCheck->code);
                    }
                }
            } else {
                WebUser::logAccess("Cambio el tipo de estudio", $backgroundCheck->code);
            }
        }
        $this->redirect(array('/backgroundCheck/update/', 'code' => $code, 'pc' => $pc));
    }

    public function actionUpdating($code) {
        $model = $this->loadModel($code);
        if ($model) {
            $keys = 0;
            if (isset($_POST['keys'])) {
                $keys = (int) $_POST['keys'];
            }
            WebUser::logAccess("Editando el estudio. Presionó " . (int) $keys . " teclas.", $model->code);
        }
        return;
    }

    public function actionStudyStart($code) {

        $model = $this->loadModel($code);

        if($model->startStudy==0)
        {
            $model->getStartStudy($code); 
            $this->createTusDatosRegister($model);
        }

        $this->redirect(array('/backgroundCheck/update', 'code' => $model->code));
    }
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $code the ID of the model to be updated
     */
    public function actionUpdate($code, $pc = false) {
        if(!Yii::app()->user->isValidUser && (!Yii::app()->user->isAdmin || !Yii::app()->user->getIsByRole())){
            $this->redirect('/noallowed.html');
        }
        $model = $this->loadModel($code);

        //proceso jeimy
        //17/09/2021
        $oldIdNumber = $model->idNumber;
        $oldDateExp = $model->datexpedition;

        $bgcRegisterOld=$model->getAttributes(true);

        if (isset($_POST['BackgroundCheck']) && $model->canUpdate) {
            $previewsStatusId = $model->backgroundCheckStatusId;
            $model->attributes = $_POST['BackgroundCheck'];

            if ($model->backgroundCheckStatusId == BackgroundCheckStatus::REQUESTED) {
                $model->backgroundCheckStatusId = BackgroundCheckStatus::PROCESSING;
            }
            $model->scenario = 'extraCheck';
            if($model->ooidFD!='' && $model->statusFD==0 && ($model->backgroundCheckStatusId==BackgroundCheckStatus::FINISHED || $model->backgroundCheckStatusId==BackgroundCheckStatus::CANCELLED)){
                if($model->backgroundCheckStatusId==BackgroundCheckStatus::FINISHED){
                    Yii::app()->user->setFlash('error', "¡¡ Este estudio cuenta con registro de formulario dinámico, por favor traer datos del formulario para que pueda finalizar el estudio. !!");
                }else{
                    Yii::app()->user->setFlash('error', "¡¡ Este estudio cuenta con registro de formulario dinámico, por favor traer datos del formulario para que pueda cancelar el estudio. !!");
                }
                $this->redirect(array('/backgroundCheck/update', 'code' => $model->code));
            }else if ($model->checkCustomerFields() && $model->save()) {

                $bgcRegisterNew=$model->getAttributes(true);

                //proceso Jeimy
                //17/09/2021
                /*$criteria = new CDbCriteria;
                $criteria->compare('backgroundCheckId', $model->id);
                $criteria->compare('verificationSectionTypeId', '4');
                $seccionAdv = VerificationSection::model()->findAll($criteria);
                if($seccionAdv){
                    if($oldIdNumber != $model->idNumber ||
                    $oldDateExp != $model->datexpedition) {
                        $this->createTusDatosRegister($model);
                    }
                }*/

                WebUser::logRecordChange("Guardo cambios: ", $model->code, get_class($model), $bgcRegisterNew, $bgcRegisterOld);

                //WebUser::logAccess("Guardo cambios", $model->code);
                if ($model->backgroundCheckStatusId == BackgroundCheckStatus::FINISHED && $model->backgroundCheckStatusId != $previewsStatusId) {
                    $model->finishAssignedUsers();
                    $body = $this->renderPartial('_mailStatusChangedToFinished', array(
                        'backgroundCheck' => $model,
                    ), true);
                    //Creada Jonathan
                    $user = User::model()->findByPk(Yii::app()->user->getId());
                    if ( $user->MailFinished > 0) {
                        Yii::app()->user->sendMailInBackground(
                            "Estudio Ref [" . $model->code . "] ha sido finalizado", //
                            $body, //
                            array(Yii::app()->params['serviceEmail']['aprobacion'],), //
                            array(Yii::app()->user->arUser->mailParam,) //
                        );
                    }
                    $model = $model = $this->loadModel($code);
                } elseif (($model->backgroundCheckStatusId == BackgroundCheckStatus::CANCELLED ||
                        $model->backgroundCheckStatusId == BackgroundCheckStatus::PARTIAL_CANCELLED) &&
                    $model->backgroundCheckStatusId != $previewsStatusId) {
                    $model->setPartialCostAndPrice();
                    $model->save();

                    //Eliminar registro de estudio en la tabla TusDatosResponse, si el estudio es cancelado.
                    //Natalia Henao--07/01/2022
                    //$tusDatos = new TusDatosResponse();
                    $tusDatos=TusDatosResponse::model()->findByAttributes(['backgroundcheckId' => $model->id]);
                    if($tusDatos){
                        $tusDatos->deleteRegTD($model->id);
                    }
                    
                    $body = $this->renderPartial('_mailStatusChangedToCancelled', array(
                        'backgroundCheck' => $model,
                    ), true);
                    // creado por Jonathan
                    $user = User::model()->findByPk(Yii::app()->user->getId());
                    if ( $user->MailCancelled > 0) {
                        Yii::app()->user->sendMailInBackground(
                            "Estudio Ref [" . $model->code . "] ha sido cancelado", //
                            $body, //
                            array(Yii::app()->params['serviceEmail']['aprobacion'],), //
                            array(Yii::app()->user->arUser->mailParam,) //
                        );
                    }
                }
            }
        } else {
            WebUser::logAccess("Vio estudio", $model->code);
        }

        if (isset($_POST['backToListButton'])) {
            if ($pc) {
                $this->redirect('/backgroundCheck/pcAdmin');
            } else {
                $this->redirect('/backgroundCheck/admin');
            }
        } else {
            $this->render('update', array(
                'model' => $model,
                'activeTab' => (isset($_GET['activeTab']) ? $_GET['activeTab'] : 0),
                'pc' => $pc
            ));
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $code the ID of the model to be deleted
     */
    public function actionDelete($code) {
        if (Yii::app()->request->isPostRequest && (Yii::app()->user->isSuperAdmin || Yii::app()->user->getIsByRole())) {
// we only allow deletion via POST request
            $model = $this->loadModel($code);
            if ($model) {
                WebUser::logAccess("Borro el estudio de : [" . $model->code . '] ' . $model->fullName, $model->code);
                $model->delete();
            }
// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
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
    public function actionAdmin() {
        $model = GridViewFilter::getFilter('BackgroundCheck', 'search');
        if (isset($_GET['BackgroundCheck']))
            $model->attributes = $_GET['BackgroundCheck'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionPcAdmin() {

        //creado export seguimiento
        if (isset($_GET['exportna'])) {
            echo $this->renderPartial( 'ExportNata');
        }
//creado export seguimiento

        $model = GridViewFilter::getFilter('BackgroundCheck', 'search');

        if (isset($_GET['BackgroundCheck']))
            $model->attributes = $_GET['BackgroundCheck'];

        if (isset($_GET['_export']) && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())) {
            set_time_limit(300);
            $this->renderPartial('_csvPcAdmin', array(
                'model' => $model,
                'withEvents' => false,
            ));
        } elseif (isset($_GET['_exportWithEvents']) && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())) {
            set_time_limit(300);
            $this->renderPartial('_csvPcAdmin', array(
                'model' => $model,
                'withEvents' => true,
            ));
        } elseif (isset($_GET['_exportDetail']) && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())) {
            $this->renderPartial('_csvPcAdminDetail', array(
                'backgroundCheck' => $model,
            ));
        } elseif (isset($_GET['_export_full'])) {
            if (Yii::app()->user->isSuperAdmin && (Yii::app()->user->isRegisteredIp || Yii::app()->user->getIsByRole())) {
                header('Content-type: text/html; charset=utf-8');
                $dp = $model->search(6000);
                $models = $dp->getData();
                $i = 0;
                foreach ($models as $backgroundCheck) {
                    if ($backgroundCheck && $backgroundCheck->reportAvailable && file_exists($backgroundCheck->absolutePath)) {
                        $i++;
                        $pdfFile = Yii::app()->basePath . "/runtime/reports/informe_" . $backgroundCheck->idNumber . '_' . $backgroundCheck->code . ".pdf";
                        if (!file_exists($pdfFile)) {
                            //WebUser::logAccess("Descargo el archivo Final PDF del estudio", $backgroundCheck->code);
                            $pdfData = $backgroundCheck->getBackgroundCheckReport(Yii::app()->user->arUser->pdfPassword, (Yii::app()->user->isAdmin || Yii::app()->user->IsRegisteredIP || Yii::app()->user->arUser->isInhouse  || Yii::app()->user->getIsByRole()), Yii::app()->user->name);
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

    public function actionApprove($code, $pc) {
        $user = User::model()->findByPk(Yii::app()->user->getId());
        if(!Yii::app()->user->isValidUser && !Yii::app()->user->isAdmin &&  !Yii::app()->user->getIsByRole()){
            $this->redirect('/noallowed.html');
        }
        $backgroundCheck = $this->loadModel($code);
        if ($backgroundCheck && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) && $backgroundCheck->resultId != Result::PENDING && !$backgroundCheck->isApproved) {
            WebUser::logAccess("Aprobó el estudio.", $backgroundCheck->code);
            $backgroundCheck->approvedBy = Yii::app()->user->id;
            $backgroundCheck->approvedOn = new CDbExpression('NOW()');

            if (!$backgroundCheck->responsible) {
                $assignedUser = new AssignedUser;
                $assignedUser->backgroundCheckId = $backgroundCheck->id;
                $assignedUser->userId = Yii::app()->user->id;
                $assignedUser->userRoleId = UserRole::ASSIGNED;
                if (!$assignedUser->save()) {
                    WebUser::logAccess("Error guardando el estudio", $backgroundCheck->code);
                    $this->redirect(array('/backgroundCheck/admin'));
                }
            }
            $backgroundCheck->finishAssignedUsers();
            if ($backgroundCheck->save()) {
                $tempFilename = tempnam(null, '');
                /*
                $this->renderPartial('_pdfView', array(
                    'backgroundCheck' => $backgroundCheck,
                    'filename' => $tempFilename,
                ));
                */
                $backgroundCheck->saveBackgroundCheckReport($tempFilename);
                unlink($tempFilename);
                Yii::app()->user->setFlash('backgroundCheck', "Aprobado");
                if ($backgroundCheck->price < BackgroundCheckController::MINIMUN_PRICE || $backgroundCheck->price != $backgroundCheck->customerProduct->price) {
                    WebUser::logAccess("Aprobado precio inferior al mínimo", $backgroundCheck->code);
                    $body = $this->renderPartial('_mailApprovedLowPrice', array(
                        'backgroundCheck' => $backgroundCheck,
                    ), true);
                    //Creado Por Jonathan  MailApprovedPric
                    if ($user->MailApprovedPric > 0) {
                        Yii::app()->user->sendMailInBackground(
                            "Estudio Ref [" . $backgroundCheck->code . "] ha sido aprobado con precio mínimo", //
                            $body, //
                            Yii::app()->params['serviceEmail']['priceCero']
                        );
                    }
                }
            } else {
                Yii::app()->user->setFlash('backgroundCheck', "Error");
            }
            // FECHA DE VENCIMIENTO
            $query = 'SELECT expirationInterval FROM ses_CustomerProduct cp WHERE id = "'.$backgroundCheck->customerProduct->id.'"';
            $query = Yii::app()->db->createCommand($query)->queryAll();

            if ($query[0]['expirationInterval'] == "P3M" ) {
                $fechaVencimiento = strtotime ( '+3 month' , strtotime ( date('Y-m-d') ) ) ;
                $fechaVencimiento = date('Y-m-d',$fechaVencimiento);
            } else if ($query[0]['expirationInterval'] == "P6M" ) {
                $fechaVencimiento = strtotime ( '+6 month' , strtotime ( date('Y-m-d') ) ) ;
                $fechaVencimiento = date('Y-m-d',$fechaVencimiento);
            } else if ($query[0]['expirationInterval'] == "P1Y" ) {
                $fechaVencimiento = strtotime ( '+1 year' , strtotime ( date('Y-m-d') ) ) ;
                $fechaVencimiento = date('Y-m-d',$fechaVencimiento);
            } else if ($query[0]['expirationInterval'] == "P2Y" ) {
                $fechaVencimiento = strtotime ( '+1 year' , strtotime ( date('Y-m-d') ) ) ;
                $fechaVencimiento = date('Y-m-d',$fechaVencimiento);
            } else if ($query[0]['expirationInterval'] == "P3Y" ) {
                $fechaVencimiento = strtotime ( '+1 year' , strtotime ( date('Y-m-d') ) ) ;
                $fechaVencimiento = date('Y-m-d',$fechaVencimiento);
            } else{
                $fechaVencimiento = "" ;
            }
            $query = "UPDATE ses_BackgroundCheck SET expireIn='".$fechaVencimiento."' WHERE  code='".$backgroundCheck->code."';";
            if( Yii::app()->db->createCommand($query)->execute() ){
                $this->redirect(array('/backgroundCheck/update', 'code' => $code, 'pc' => $pc));
            } else {
                Yii::app()->db->createCommand($query)->execute();
                $this->redirect(array('/backgroundCheck/update', 'code' => $code, 'pc' => $pc));
            }
            //FIN FECHA DE VENCIMIENTOS
        }
    }

    public function actionDisapprove($code, $pc) {
        $backgroundCheck = $this->loadModel($code);
        if ($backgroundCheck && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) && $backgroundCheck->isApproved && !$backgroundCheck->invoice) {
            $backgroundCheck->approvedOn = new CDbExpression('NULL');
            $backgroundCheck->reportAvailable = false;
            $backgroundCheck->approvedBy = '';
            $backgroundCheck->temporalReportAvailable = false;
            $backgroundCheck->certificateAvailable = false;
            $backgroundCheck->inAmendment = false;
            $backgroundCheck->deliveredToCustomerOn = new CDbExpression('NULL');
            if ($backgroundCheck->save()) {
                WebUser::logAccess("Desaprobo el estudio.", $backgroundCheck->code);
                $backgroundCheck->deleteReportPdf();
                Yii::app()->user->setFlash('backgroundCheck', "Cancelada la aprobación!!");
            } else {
                Yii::app()->user->setFlash('backgroundCheck', "Error");
            }
            $this->redirect(array('/backgroundCheck/update', 'code' => $code, 'pc' => $pc));
        } else {
            $this->redirect(array('/backgroundCheck/admin'));
        }
    }

    public function actionDeleteTemporalReport($code, $pc) {
        $backgroundCheck = $this->loadModel($code);
        if ($backgroundCheck && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())) {
            $backgroundCheck->approvedBy = '';
            $backgroundCheck->approvedOn = new CDbExpression('NULL');
            $backgroundCheck->reportAvailable = false;
            $backgroundCheck->temporalReportAvailable = false;
            $backgroundCheck->deliveredToCustomerOn = new CDbExpression('NULL');
            if ($backgroundCheck->save()) {
                $backgroundCheck->deleteReportPdf();
                WebUser::logAccess("Borro el reporte temporal.", $backgroundCheck->code);
                Yii::app()->user->setFlash('backgroundCheck', "Reporte Temporal Borrado!!");
            } else {
                Yii::app()->user->setFlash('backgroundCheck', "Error");
            }
            $this->redirect(array('/backgroundCheck/update', 'code' => $code, 'pc' => $pc));
        } else {
            $this->redirect(array('/backgroundCheck/admin'));
        }
    }

    public function actionInitAmendment($code, $pc = false) {
        /* @var $backgroundCheck BackgroundCheck */
        $backgroundCheck = $this->loadModelForAmendment($code);
        if ($backgroundCheck && !$backgroundCheck->inAmendment && Yii::app()->user->isManager) {
            WebUser::logAccess("Abrio enmienda", $backgroundCheck->code);
            $backgroundCheck->inAmendment = TRUE;
            $backgroundCheck->save();
        }
        $this->redirect(array('backgroundCheck/update', 'code' => $code));
    }

    public function actionFinishAmendment($code, $pc = false) {
        /* @var $backgroundCheck BackgroundCheck */
        $backgroundCheck = $this->loadModelForAmendment($code);

        if ($backgroundCheck && $backgroundCheck->inAmendment && Yii::app()->user->isManager) {
            WebUser::logAccess("Cerro enmienda", $backgroundCheck->code);
            $backgroundCheck->inAmendment = FALSE;
            $backgroundCheck->save();
            $this->publishReport($backgroundCheck, TRUE);
        }
        $this->redirect(array('backgroundCheck/update', 'code' => $code, 'pc' => $pc));
    }

    public function loadModelForAmendment($code) {
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            $model = BackgroundCheck::model()->findByAttributes(array('code' => $code));
        } else {
            $model = null;
        }

        if ($model === null) {
            WebUser::logAccess("ERROR: Intento acceder el estudio " . CHtml::encode($code));
            $this->redirect(array('admin'));
//            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function publishReport($backgroundCheck, $isAmendment = false) {
        $user = User::model()->findByPk(Yii::app()->user->getId());
        $backgroundCheck->reportAvailable = TRUE;
        $backgroundCheck->temporalReportAvailable = TRUE;
        $backgroundCheck->certificateAvailable = FALSE;
        if (!$isAmendment) {
            //$backgroundCheck->deliveredToCustomerOn = new CDbExpression('NOW()');
            $backgroundCheck->deliveredToCustomerOn = Yii::app()->db->createCommand('select now()')->queryScalar();
        }
        if (!$backgroundCheck->invoice) {
            $backgroundCheck->assignInvoice();
        }

        if ($backgroundCheck->save()) {
            WebUser::logAccess("Publico el estudio.", $backgroundCheck->code);
            $tempFilename = tempnam(null, '');
            $this->renderPartial('_pdfView', array(
                'backgroundCheck' => $backgroundCheck,
                'filename' => $tempFilename,
            ));
            $backgroundCheck->saveBackgroundCheckReport($tempFilename);
            unlink($tempFilename);
            if (
                $backgroundCheck->backgroundCheckStatusId == BackgroundCheckStatus::FINISHED &&
                ($backgroundCheck->customerProduct->pdfCertificateType ||
                    !$backgroundCheck->isCompanySurvey)) {
                WebUser::logAccess("Publico el certificado.", $backgroundCheck->code);
                $tempFilenameCert = tempnam(null, '');
                $this->renderPartial('_pdfViewCertificate', array(
                    'backgroundCheck' => $backgroundCheck,
                    'filename' => $tempFilenameCert,
                ));
                $backgroundCheck->saveBackgroundCheckCert($tempFilenameCert);
                unlink($tempFilenameCert);
                $backgroundCheck->certificateAvailable = TRUE;
                $backgroundCheck->save();
            }
            $body = $this->renderPartial('_mailPublished', array(
                'backgroundCheck' => $backgroundCheck,
            ), true);

            //proceso para enviar certificado de finalización de estudio al cliente
            //Natalia Henao
            //14/06/2022
            if ($backgroundCheck && $backgroundCheck->certificateAvailable && file_exists($backgroundCheck->absolutePathCert)) {
                if($backgroundCheck->customer->certificateKey==1){
                    $passwordCertif=$backgroundCheck->idNumber;
                }else{
                    $passwordCertif=null;
                }
                
                $pdfData = $backgroundCheck->getBackgroundCheckReportCert($passwordCertif, (Yii::app()->user->isAdmin || Yii::app()->user->IsRegisteredIP || Yii::app()->user->arUser->isInhouse  || Yii::app()->user->getIsByRole()), Yii::app()->user->name, 0, 255);
                $filenamePath = Yii::app()->basePath . "/runtime/" . uniqid("Cert_", true) . ".pdf";
                file_put_contents($filenamePath, $pdfData);

                $data = file_get_contents($filenamePath);
                $base64 = base64_encode($data);
            
                if($backgroundCheck->customer->sendToCertificate==1){
                    $fileArray[] = array('fileName' => "Cert_".$backgroundCheck->code.".pdf", 
                        'baseName' => "Cert_".$backgroundCheck->code.".pdf", 
                        'base64' => $base64
                    );
                }else{
                    $fileArray=[];
                }
            }else{
                $fileArray=[];
            }

            if (!$isAmendment && $backgroundCheck->notifyCustomerByMail) {

                Yii::app()->user->sendMailInBackground(
                    "💯 Estudio Ref [" . $backgroundCheck->code . "] ha sido publicado", //
                    $body, //
                    $backgroundCheck->customerUser->mailsParam, 
                    //Editado Jonathan
                    //array($backgroundCheck->customerUser->mailParam,),
                    [],
                    [],
                    $fileArray
                );
            }
            //Creado por Jonathan
            if ( $user->MailPublished > 0) {
                Yii::app()->user->sendMailInBackground(
                    "💯 Estudio Ref [" . $backgroundCheck->code . "] ha sido publicado", //
                    $body, //
                    array(Yii::app()->params['serviceEmail']['aprobacion'],),
                    [],
                    [],
                    $fileArray
                );
            }

            if ($backgroundCheck && $backgroundCheck->certificateAvailable && file_exists($backgroundCheck->absolutePathCert)) {
                unlink($filenamePath);
            }

            $requestsSAC = RequestsSAC::model()->findByAttributes(array('backgroundcheckId' => $backgroundCheck->id));
            if($requestsSAC){

                $date1 = new DateTime($requestsSAC->dateRequest);
				$date2 = new DateTime($backgroundCheck->approvedOn);
				$diff = $date1->diff($date2);

                $requestsSAC->dateAnswer=$backgroundCheck->approvedOn;
                $requestsSAC->status="Entregado";
                $requestsSAC->deliveryDays=$diff->days;
                $requestsSAC->update();
            }

            Yii::app()->user->setFlash('backgroundCheck', "El reporte está disponible para el cliente!!");
        } else {
            Yii::app()->user->setFlash('backgroundCheck', "Error");
        }
    }


    public function publishReportNow($backgroundCheck) {
        $backgroundCheck->reportAvailable = TRUE;
        $backgroundCheck->temporalReportAvailable = TRUE;
        $backgroundCheck->certificateAvailable = FALSE;
        
        if (!$backgroundCheck->invoice) {
            $backgroundCheck->assignInvoice();
        }

        if ($backgroundCheck->save()) {
            WebUser::logAccess("Publico el estudio.", $backgroundCheck->code);
            $tempFilename = tempnam(null, '');
            $this->renderPartial('_pdfView', array(
                'backgroundCheck' => $backgroundCheck,
                'filename' => $tempFilename,
            ));
            $backgroundCheck->saveBackgroundCheckReport($tempFilename);
            unlink($tempFilename);
            if (
                    $backgroundCheck->backgroundCheckStatusId == BackgroundCheckStatus::FINISHED &&
                    ($backgroundCheck->customerProduct->pdfCertificateType ||
                    !$backgroundCheck->isCompanySurvey)) {
                WebUser::logAccess("Publico el certificado.", $backgroundCheck->code);
                $tempFilenameCert = tempnam(null, '');
                $this->renderPartial('_pdfViewCertificate', array(
                    'backgroundCheck' => $backgroundCheck,
                    'filename' => $tempFilenameCert,
                ));
                $backgroundCheck->saveBackgroundCheckCert($tempFilenameCert);
                unlink($tempFilenameCert);
                $backgroundCheck->certificateAvailable = TRUE;
                $backgroundCheck->save();
            }
            


            //Yii::app()->user->setFlash('backgroundCheck', "El reporte está disponible para el cliente!!");
        } else {
            Yii::app()->user->setFlash('backgroundCheck', "Error");
        }
    }

    public function actionPublishReport($code, $pc) {
        $backgroundCheck = $this->loadModel($code);
        if ($backgroundCheck && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) && $backgroundCheck->isApproved && $backgroundCheck->getCanBePublished()) {
            $this->publishReport($backgroundCheck, false);
            $this->redirect(array('/backgroundCheck/update', 'code' => $code, 'pc' => $pc));
        }
    }

    public function actionPublishReportNow($code) {
        $backgroundCheck = $this->loadModel($code);
        $this->publishReportNow($backgroundCheck);
    }

    public function actionPublishTemporalReport($code, $pc) {
        $backgroundCheck = $this->loadModel($code);
        $user = User::model()->findByPk(Yii::app()->user->getId());
        if ($backgroundCheck && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) && !$backgroundCheck->isApproved) {
            $backgroundCheck->temporalReportAvailable = TRUE;
            $backgroundCheck->tempdateRep = date('Y-m-d H:i:s'); 
            if ($backgroundCheck->save()) {
                WebUser::logAccess("Publico el estudio temporal.", $backgroundCheck->code);
                $tempFilename = tempnam(null, '');
                $this->renderPartial('_pdfView', array(
                    'backgroundCheck' => $backgroundCheck,
                    'filename' => $tempFilename,
                ));
                $backgroundCheck->saveBackgroundCheckReport($tempFilename);
                unlink($tempFilename);
                $body = $this->renderPartial('_mailTemporalPublished', array(
                    'backgroundCheck' => $backgroundCheck,
                ), true);
                if ($backgroundCheck->notifyCustomerByMail) {
                    Yii::app()->user->sendMailInBackground(
                        "Estudio Temporal Ref [" . $backgroundCheck->code . "] ha sido publicado", //
                        $body, //
                        $backgroundCheck->customerUser->mailsParam
                        //Editado Jonathan
                        ///array($backgroundCheck->customerUser->mailParam,)
                    );
                }
                //Creado por Jonathan
                if ( $user->MailPublished > 0) {
                    Yii::app()->user->sendMailInBackground(
                        "Estudio Temporal Ref [" . $backgroundCheck->code . "] ha sido publicado", //
                        $body, //
                        array(Yii::app()->params['serviceEmail']['aprobacion'],)
                    );

                }
                Yii::app()->user->setFlash('backgroundCheck', "El reporte temporal está disponible para el cliente!!");
            } else {
                Yii::app()->user->setFlash('backgroundCheck', "Error");
            }
            $this->redirect(array('/backgroundCheck/update', 'code' => $code, 'pc' => $pc));
        }
    }

    public function actionDeleteEvent($code) {
        $event = Event::model()->findByPk($code);

        if ($event) {
            $backgroundCheck = $this->loadModel($event->backgroundCheck->code);
            if ($backgroundCheck && !$backgroundCheck->approved) {
                $event->delete();
                $this->redirect(array('/backgroundCheck/update', 'code' => $backgroundCheck->code));
            } else {
                $this->redirect(array('admin'));
            }
        } else {
            $this->redirect(array('admin'));
        }
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
        $model=BackgroundCheck::findByCode($code);
        if ($model === null) {
            //Ya esta registrado el error en el findByCode.
            $this->redirect(array('admin'));
        }
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

    public function actionViewPdf($code) {
        $backgroundCheck = $this->loadModel($code);
        WebUser::logAccess("Entrando a actionViewPdf reportAvailable: " . 
            $backgroundCheck->reportAvailable . " inAmendment " . 
            $backgroundCheck->inAmendment, $backgroundCheck->code);

        if ($backgroundCheck) {
            if (!$backgroundCheck->reportAvailable || $backgroundCheck->inAmendment) {
                WebUser::logAccess("Descargo el archivo Temporal PDF del estudio de :" . $backgroundCheck->fullName, $backgroundCheck->code);
                $this->echoTemporalCryptedPdf(
                        $backgroundCheck
                        , $this->renderPartial('_pdfView'
                                , array(
                            'backgroundCheck' => $backgroundCheck,
                            'filename' => null,
                                )
                                , true)
                );
            } else {
                $this->redirect(array('reportPdf', 'code' => $code));
            }
        } else {
// Not Available Model;
            $this->redirect(array('admin'));
        }
        return;
    }

    //proceso jonathan y natalia
    //17/08/2021
    public function actionViewPdfSindoc($code) {
        $backgroundCheck = $this->loadModel($code);
        WebUser::logAccess("Entrando a actionViewPdf reportAvailable: " . 
            $backgroundCheck->reportAvailable . " inAmendment " . 
            $backgroundCheck->inAmendment, $backgroundCheck->code);

        if ($backgroundCheck) {
                WebUser::logAccess("Descargo el archivo Temporal PDF sin documentos del estudio de :" . $backgroundCheck->fullName, $backgroundCheck->code);
                $this->echoTemporalCryptedPdf(
                        $backgroundCheck
                        , $this->renderPartial('_pdfView'
                                , array(
                            'backgroundCheck' => $backgroundCheck,
                            'filename' => null,
                                )
                                , true)
                );
        } else {
// Not Available Model;
            $this->redirect(array('admin'));
        }
        return;
    }

    private function echoTemporalCryptedPdf($backgroundCheck, $pdfString, $markX = null, $markY = null) {
        $cryptedData = $backgroundCheck->getCryptedPdf(
                $pdfString
                , ($backgroundCheck->isApproved ? Yii::app()->user->arUser->pdfPassword : null)
                , (Yii::app()->user->isAdmin || Yii::app()->user->IsRegisteredIP  || Yii::app()->user->getIsByRole())
                , ($backgroundCheck->isApproved ? Yii::app()->user->name : "Borrador  Borrador  Borrador  Borrador")
                , $markX
                , $markY);

        header('Content-type: application/pdf');
        // 12-05-2017 
        // Se cambia el nombre del archivo
        header('Content-Disposition: inline; filename="' . $backgroundCheck->lastName . ' ' . $backgroundCheck->firstName . '-' . $backgroundCheck->idNumber . '.pdf"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($cryptedData));
        echo $cryptedData;
        exit();
    }

    public function actionViewCertPdf($code) {
        /* @var $backgroundCheck BackgroundCheck */
        $backgroundCheck = $this->loadModel($code);
        WebUser::logAccess("Entrando a actionViewCertPdf reportAvailable: " . 
            $backgroundCheck->reportAvailable, $backgroundCheck->code);
        if ($backgroundCheck) {
            if (!$backgroundCheck->reportAvailable) {
                WebUser::logAccess("Descargo el archivo certificado temporal PDF del estudio de :" . $backgroundCheck->fullName, $backgroundCheck->code);
                $this->echoTemporalCryptedPdf($backgroundCheck
                        , $this->renderPartial('_pdfViewCertificate', array(
                            'backgroundCheck' => $backgroundCheck,
                            'filename' => null,
                                )
                                , true
                        )
                        , ($backgroundCheck->customerProduct->pdfCertificateType ? $backgroundCheck->customerProduct->pdfCertificateType->markX : 0)
                        , ($backgroundCheck->customerProduct->pdfCertificateType ? $backgroundCheck->customerProduct->pdfCertificateType->markY : 255)
                );
            } else {
                $this->redirect(array('reportCertPdf', 'code' => $code));
            }
        } else {
// Not Available Model;
            $this->redirect(array('admin'));
        }
        return;
    }

    public function actionReportPdf($code) {
        $backgroundCheck = $this->loadModel($code);
        WebUser::logAccess("Entrando a actionReportPdf reportAvailable: " . 
            $backgroundCheck->reportAvailable . " temporalReportAvailable " . 
            $backgroundCheck->temporalReportAvailable . " file exists " .
            file_exists($backgroundCheck->absolutePath) . " absolutePath ".
            $backgroundCheck->absolutePath, $backgroundCheck->code);

        if ($backgroundCheck && ($backgroundCheck->reportAvailable || $backgroundCheck->temporalReportAvailable ) && file_exists($backgroundCheck->absolutePath)) {
            WebUser::logAccess("Descargo el archivo Final PDF del estudio", $backgroundCheck->code);
            $pdfData = $backgroundCheck->getBackgroundCheckReport(Yii::app()->user->arUser->pdfPassword, (Yii::app()->user->isAdmin || Yii::app()->user->IsRegisteredIP || Yii::app()->user->arUser->isInhouse  || Yii::app()->user->getIsByRole()), Yii::app()->user->name);
            header('Content-type: application/pdf');
            // 12-05-2017 
            // Se cambia el nombre del archivo
            header('Content-Disposition: inline; filename="' . $backgroundCheck->lastName . ' ' . $backgroundCheck->firstName . '-' . $backgroundCheck->idNumber . '.pdf"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . strlen($pdfData));

            echo $pdfData;
            exit();
        } else {
// Not Available Model;
            $this->redirect(array('admin'));
        }
        return;
    }

    public function actionReportCertPdf($code) {
        $backgroundCheck = $this->loadModel($code);
        WebUser::logAccess("Entrando a actionReportCertPdf reportAvailable: " . 
            $backgroundCheck->reportAvailable . " temporalReportAvailable " . 
            $backgroundCheck->temporalReportAvailable . " file exists " .
            file_exists($backgroundCheck->absolutePath) . " absolutePath ".
            $backgroundCheck->absolutePath, $backgroundCheck->code);

        if ($backgroundCheck && $backgroundCheck->certificateAvailable && file_exists($backgroundCheck->absolutePathCert)) {
            WebUser::logAccess("Descargo la certificación Final PDF del estudio", $backgroundCheck->code);
            $pdfData = $backgroundCheck->getBackgroundCheckReportCert(Yii::app()->user->arUser->pdfPassword, (Yii::app()->user->isAdmin || Yii::app()->user->IsRegisteredIP || Yii::app()->user->arUser->isInhouse || Yii::app()->user->getIsByRole()), Yii::app()->user->name, 0, 255);
            header('Content-type: application/pdf');
            // 12-05-2017 
            // Se cambia el nombre del archivo
            header('Content-Disposition: inline; filename="' . $backgroundCheck->lastName . ' ' . $backgroundCheck->firstName . '-' . $backgroundCheck->idNumber . '.pdf"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . strlen($pdfData));

            echo $pdfData;
            exit();
        } else {
// Not Available Model;
            $this->redirect(array('admin'));
        }
        return;
    }

    public function actionPublishCert($code, $pc) {
        $backgroundCheck = $this->loadModel($code);
        WebUser::logAccess("Entrando a actionReportCertPdf certificateAvailable: " . 
            $backgroundCheck->certificateAvailable, $backgroundCheck->code);

        if ($backgroundCheck && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) && !$backgroundCheck->certificateAvailable) {
            WebUser::logAccess("Publico la certificación Final del estudio", $backgroundCheck->code);
            $tempFilenameCert = tempnam(null, '');
            $this->renderPartial('_pdfViewCertificatePerson', array(
                'backgroundCheck' => $backgroundCheck,
                'filename' => $tempFilenameCert,
            ));
            $backgroundCheck->saveBackgroundCheckCert($tempFilenameCert);
            unlink($tempFilenameCert);
            $backgroundCheck->certificateAvailable = true;
            $backgroundCheck->save();
            $this->redirect(array('/backgroundCheck/update', 'code' => $code, 'pc' => $pc));
        } else {
// Not Available Model;
            $this->redirect(array('admin'));
        }
        return;
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateAssignedUsers($code) {
        $backgroundCheck = $this->loadModel($code);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($section);

        if ($backgroundCheck && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())) {
            if (isset($_POST['assignedUsers'])) {
                $assignedUsers = array();
                foreach ($backgroundCheck->assignedUsers as $assignedUser) {
                    $assignedUsers[$assignedUser->userId] = true;
                }
                WebUser::logAccess("Asigno usuarios", $backgroundCheck->code);
                foreach ($_POST['assignedUsers'] as $key => $detail) {
                    if ($key != 'new') {
                        $assignedUser = AssignedUser::model()->findByPK($key);
                        $assignedUser->attributes = $_POST['assignedUsers'][$key];
                    } else {
                        $assignedUser = new AssignedUser;
                        $assignedUser->attributes = $_POST['assignedUsers'][$key];
                    }
                    $assignedUser->backgroundCheckId = $backgroundCheck->id;
                    if ($assignedUser->userId > 0) {
                        if (!$assignedUser->save()) {
                            Yii::app()->user->setFlash('assignedUser', serialize($assignedUser->getErrors()));
                        } else {
// Sending the mail
                            if ($key == 'new') {
                                if (!isset($assignedUsers[$assignedUser->userId])) {
                                    $user = $assignedUser->user;
                                    $body = $this->renderPartial('_mailAssigned', array(
                                        'backgroundCheck' => $backgroundCheck,
                                        'assignedUser' => $assignedUser,
                                    ), true);
                                    // creado por Jonathan
                                    if ($user->MailAssigned > 0) {

                                        Yii::app()->user->sendMailInBackground(
                                            "Estudio Ref [" . $backgroundCheck->code . "] asignado", //
                                            $body, //
                                            array($user->mailParam));
                                    }
                                }
                                // Update the first assigned Time
                                if ($assignedUser->userRoleId == UserRole::ASSIGNED) {
                                    $backgroundCheck->assignedOn = new CDbExpression('NOW()');
                                    $backgroundCheck->save();
                                }
                            }
                        }
                    }
                }
            }
            $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'assignedUsers'));
        } else {
            $url = $this->createUrl('/backgroundCheck/admin/');
        }
        $this->redirect($url, true);
    }

    public function actionAssignUserToSections($code) {
        $backgroundCheck = $this->loadModel($code);

        if ($backgroundCheck) {
            if (isset($_POST['assignUserSections']) &&
                isset($_POST['assignUserSections']['username']) &&
                isset($_POST['assignUserSections']['userRoleId'])
            ) {
                $assignUserSection = $_POST['assignUserSections'];
                $user = User::model()->findByAttributes(array('username' => $assignUserSection['username']));
                $userRole = UserRole::model()->findByPk($assignUserSection['userRoleId']);
                if ($user && $userRole) {
                    /* @var $assignedUser AssignedUser */
                    $basicRecord = array(
                        'backgroundCheckId' => $backgroundCheck->id,
                        'userId' => $user->id,
                        'userRoleId' => $userRole->id,
                        'limitAt' => $assignUserSection['limitAt'],
                    );

                    if (isset($assignUserSection['verificationSectionId']) &&
                        is_array($assignUserSection['verificationSectionId']) &&
                        $userRole->id != UserRole::ASSIGNED) {
                        foreach ($assignUserSection['verificationSectionId'] as $verificationSectionId) {
                            $assignedUser = AssignedUser::model()->findByAttributes(array(
                                'backgroundCheckId' => $backgroundCheck->id,
                                'userId' => $user->id,
                                'verificationSectionId' => $verificationSectionId,
                            ));
                            if (!$assignedUser) {
                                $assignedUser = new AssignedUser;
                                $assignedUser->attributes = $basicRecord;
                                $assignedUser->verificationSectionId = $verificationSectionId;
                                $assignedUser->save();
                            }
                        }
                    } else if (isset($assignUserSection['verificationSectionGroupId']) &&
                        is_array($assignUserSection['verificationSectionGroupId']) &&
                        $userRole->id != UserRole::ASSIGNED) {
                        foreach ($assignUserSection['verificationSectionGroupId'] as $verificationSectionGroupId) {
                            $criteria = new CDbCriteria;
                            $criteria->compare('backgroundCheckId', $backgroundCheck->id);
                            $criteria->compare('verificationSectionType.verificationSectionGroupId', $verificationSectionGroupId);
                            $criteria->with[] = 'verificationSectionType';

                            $verificationSections = VerificationSection::model()->findAll($criteria);

                            foreach ($verificationSections as $verificationSection) {
                                $assignedUser = AssignedUser::model()->findByAttributes(array(
                                    'backgroundCheckId' => $backgroundCheck->id,
                                    'userId' => $user->id,
                                    'verificationSectionId' => $verificationSection->id,
                                ));
                                if (!$assignedUser) {
                                    $assignedUser = new AssignedUser;
                                    $assignedUser->attributes = $basicRecord;
                                    $assignedUser->verificationSectionId = $verificationSection->id;
                                    $assignedUser->save();
                                }
                            }
                        }
                    } else {
                        $assignedUser = new AssignedUser;
                        $assignedUser->attributes = $basicRecord;
                        $assignedUser->save();
                    }


                    $body = $this->renderPartial('_mailAssigned', array(
                        'backgroundCheck' => $backgroundCheck,
                        'assignedUser' => $assignedUser,
                    ), true);
                    // creado por Jonathan
                    if ($user->MailAssigned >0) {
                        Yii::app()->user->sendMailInBackground(
                            "Estudio Ref [" . $backgroundCheck->code . "] asignado", //
                            $body, //
                            array($user->mailParam));
                    }
                    if (!$backgroundCheck->assignedOn) {
                        $backgroundCheck->assignedOn = new CDbExpression('NOW()');
                        $backgroundCheck->save();
                    }

                    //Envio Correo al canditato notificando asignación de visitador en estudio de seguridad.
                    if($userRole->id==3){
                        if(($backgroundCheck->email=='' || $backgroundCheck->email==null) && ($backgroundCheck->mobile=='' || $backgroundCheck->mobile==null)){
                            Yii::app()->user->setFlash('assignedUser', 'Error, el candidato, no cuenta con correo ni celular registrado.');
                        }else{
                            if($backgroundCheck->email!='' || $backgroundCheck->email!=null){
                                $user = User::model()->findByPK($user->id);
                                $body = $this->renderPartial('_mailSendAssing', array(
                                    'backgroundCheck' => $backgroundCheck,
                                    'user'=>$user
                                ), true);                      
                        
                                if (Yii::app()->user->sendMailInBackground(
                                    "❗⏰ Asignación Visitador - [" . $backgroundCheck->code . "]❗⏰",
                                    $body,
                                    array(array("mail" => $backgroundCheck->email, "name" => $backgroundCheck->firstName)),
                                    [],
                                    []
                                )) {
                                    WebUser::logAccess("Se envío a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "] un correo notificando la asignación del visitador.", $backgroundCheck->code);
                                }
                            }else{
                                Yii::app()->user->setFlash('assignedUser', 'Error el candidato, no cuenta con correo registrado.');
                            }
    
                            if($backgroundCheck->mobile!='' || $backgroundCheck->mobile!=null){
                                $backgroundCheck->getSendSMSAssing($user->id);
                                 
                                WebUser::logAccess("Se envío a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "] un SMS notificando la asignación del visitador.", $backgroundCheck->code);
                            }else{
                                Yii::app()->user->setFlash('assignedUser', 'Error el candidato, no cuenta con celular registrado.');
                            }
                        }
                    }

                } else {
                    Yii::app()->user->setFlash('assignedUser', 'Error en el asignación de Grupo en Usuario o Role');
                }
            }
            $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'assignedUsers'));
        } else {
            $url = $this->createUrl('/backgroundCheck/admin/');
        }
        $this->redirect($url, true);
    }

    public function actionDeleteAssignedUser($id) {
        $assignedUser = AssignedUser::model()->findByPK($id);
        if ($assignedUser && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())) {
            $backgroundCheck = $this->loadModel($assignedUser->backgroundCheck->code);
            if ($backgroundCheck && $backgroundCheck->canUpdate) {
                WebUser::logAccess("Borro usuario assignado", $backgroundCheck->code);
                $user = $assignedUser->user;
                $body = $this->renderPartial('_mailDeleteAssigned', array(
                    'backgroundCheck' => $backgroundCheck,
                    'assignedUser' => $assignedUser,
                ), true);
                $assignedUser->delete();
// Sending the mail

                // creado por Jonathan
                if ($user->Deallocated >0) {
                    Yii::app()->user->sendMailInBackground(
                        "Estudio Ref [" . $backgroundCheck->code . "] desasignado", //
                        $body, //
                        array($user->mailParam));
                    Yii::app()->user->setFlash('notice', "Se ha enviado el correo notificando borrar asignación.");
                }
                $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'assignedUsers'));
                $this->redirect($url, true);
            }
        } else {
            $url = $this->createUrl('/backgroundCheck/admin/');
        }
    }

    public function actionClearFinishedOfAssignedUser($id) {
        $assignedUser = AssignedUser::model()->findByPK($id);
        if ($assignedUser && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())) {
            $backgroundCheck = $this->loadModel($assignedUser->backgroundCheck->code);
            if ($backgroundCheck && !$backgroundCheck->approved) {
                WebUser::logAccess("Borro la fecha de finalización del usuario assignado : " . $assignedUser->user->name
                    . '[' . ($assignedUser->verificationSection ? $assignedUser->verificationSection->sectionName : '') . ']'
                    , $backgroundCheck->code);
                $user = $assignedUser->user;
                $body = $this->renderPartial('_mailAssigned', array(
                    'backgroundCheck' => $backgroundCheck,
                    'assignedUser' => $assignedUser,
                ), true);
                $assignedUser->finishedAt = new CDbExpression('NULL');
                $assignedUser->save();
// Sending the mail
                //creado por jonathan MailReturned
                if ($user->MailReturned > 0) {
                    Yii::app()->user->sendMailInBackground(
                        "Estudio Ref [" . $backgroundCheck->code . "] devuelto", //
                        $body, //
                        array($user->mailParam));
                    Yii::app()->user->setFlash('notice', "Se ha enviado el correo notificando borrar asignación.");
                }
            }
            $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'assignedUsers'));
            $this->redirect($url, true);
        } else {
            $url = $this->createUrl('/backgroundCheck/admin/');
        }
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

    function actionUpdateXmlQuestion($code) {
        $model = $this->loadModel($code);

        if (isset($_POST['xmlQuestion']) && $model->canUpdate) {
            $xmlAns = array();
            foreach ($_POST['xmlQuestion'] as $key => $val) {
                $xmlAns[CHtml::encode($key)] = CHtml::encode($val);
            }
            $model->xmlAnswer = serialize($xmlAns);
            $model->save();
        }

        $url = $this->createUrl('/backgroundCheck/update/', array('code' => $code, 'activeTab' => 'xmlQuestion'));
        $this->redirect($url, true);
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

    //Proceso para ver envío masivo de correos, SMS y voz
    //10/11/2021 Natalia Henao
    public function actionSendMassiveContacts()
    {
        /* @var $model BackgroundCheck */
        $model = GridViewFilter::getFilter('BackgroundCheck', 'search');
        if (isset($_GET['BackgroundCheck']))
            $model->attributes = $_GET['BackgroundCheck'];
            
        $model->customerProductviewDynamicForm=1; 
        $model->backgroundCheckStatusId = BackgroundCheckStatus::PROCESSING; 
        //$model->backgroundCheckStatusId = BackgroundCheckStatus::REQUESTED;

        $this->render('sendMassivetoContacs', array(
            'model' => $model,
        ));
    }

    //Proceso para ver envío masivo de pára peticion de soportes de pago y documentos
    //15/05/2023 Natalia Henao
    public function actionSendMassiveRecover()
    {
        /* @var $model BackgroundCheck */
        $model = GridViewFilter::getFilter('BackgroundCheck', 'search');
        if (isset($_GET['BackgroundCheck']))
            $model->attributes = $_GET['BackgroundCheck'];
            
        //$model->customer->isRecover=1; 
        $model->resultId = 1; 
        //$model->backgroundCheckStatusId = BackgroundCheckStatus::REQUESTED;

        $this->render('sendMassiveRecover', array(
            'model' => $model,
        ));
    }

    public function actionSelectForAssign() {
        /* @var $model BackgroundCheck */
        $model = GridViewFilter::getFilter('BackgroundCheck', 'search');
        if (isset($_GET['BackgroundCheck']))
            $model->attributes = $_GET['BackgroundCheck'];

        //$model->backgroundCheckStatusId = BackgroundCheckStatus::PROCESSING;
        $model->resultId=1;

        $this->render('assignMultipleStudies', array(
            'model' => $model,
        ));
    }

    public function actionOpenModal($ref, $num){
        $this->renderPartial('_assingMultiplestudisForm', array(
            "bgkcode" => $ref,
            "numStudies"=>$num
        ));
    }

    public function actionAssignUserToMultipleStudies() {
        $ans = array('error' => '', 'ans' => '');
		
		if (
			(Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) &&
			isset($_POST['assignUserSections']) &&
			isset($_POST['assignUserSections']['selectedStudiesCodes']) &&
			isset($_POST['assignUserSections']['username']) &&
			isset($_POST['assignUserSections']['userRoleId']) //&& 
            /*(isset($_POST['assignUserSections']['verificationSectionId']) || isset($_POST['assignUserSections']['verificationSectionGroupId']))*/
		) {
			
			$user = User::model()->findByAttributes(array('id' => $_POST['assignUserSections']['username']));
			$userRole = UserRole::model()->findByPk((int) $_POST['assignUserSections']['userRoleId']);
			/*/$verificationSectionGroups = array();
			foreach ($_POST['assignUserSections']['verificationSectionGroupId'] as $verificationSectionGroupId) {
				$verificationSectionGroup = VerificationSectionGroup::model()->findByPk($verificationSectionGroupId);
				if ($verificationSectionGroup) {
					$verificationSectionGroups[] = $verificationSectionGroup;
				}
			}*/
			$backgroundChecks = array();
			$selectedStudiesCodesArray = explode(',', $_POST['assignUserSections']['selectedStudiesCodes']);
			foreach ($selectedStudiesCodesArray as $code) {
				$backgroundCheck = BackgroundCheck::findByCode($code);
				if ($backgroundCheck) {
					$backgroundChecks[] = $backgroundCheck;
				}
			}
			
				if ($user && $userRole && count($backgroundChecks) > 0) {
					// Pass all validations
                    $assignedBackgroundChecks = array();
					/* @var $backgroundChecks BackgroundCheck[] */
					foreach ($backgroundChecks as $backgroundCheck) {
						if ($backgroundCheck->getCanUpdate()) {
                            $assignedFirst = false;
							if (
							isset($_POST['assignUserSections']['verificationSectionId']) &&
							is_array($_POST['assignUserSections']['verificationSectionId']) &&
							$userRole->id != UserRole::ASSIGNED
							) {
								foreach ($_POST['assignUserSections']['verificationSectionId'] as $verificationSectionId) {

                                    $criteria = new CDbCriteria;
									$criteria->compare('backgroundCheckId', $backgroundCheck->id);
									$criteria->compare('verificationSectionTypeId', $verificationSectionId);
									$verificationSections = VerificationSection::model()->findAll($criteria);

									foreach ($verificationSections as $verificationSection) {
                                        $assignedUser = AssignedUser::model()->findByAttributes(array(
                                            'backgroundCheckId' => $backgroundCheck->id,
                                            //'userId' => $user->id,
                                            'verificationSectionId' => $verificationSection->id,
                                        ));
                                        if (!$assignedUser) {
                                            $assignedUser = new AssignedUser;
                                            $assignedUser->userRoleId = $userRole->id;
                                            $assignedUser->backgroundCheckId = $backgroundCheck->id;
                                            $assignedUser->userId = $user->id;
                                            $assignedUser->verificationSectionId = $verificationSection->id;
                                            $assignedUser->limitAt = $backgroundCheck->oneDayBeforeLimit;
                                            $assignedUser->save();
                                            $assignedFirst = true;
                                            $assignedSecond=false;
                                        }else{

                                            $assignedUserDelete[]=["mail" => $assignedUser->user->username,
                                            "name" => $assignedUser->user->name];

                                            $assignedUser->userRoleId = $userRole->id;
                                            $assignedUser->backgroundCheckId = $backgroundCheck->id;
                                            $assignedUser->userId = $user->id;
                                            $assignedUser->verificationSectionId = $verificationSection->id;
                                            $assignedUser->limitAt = $backgroundCheck->oneDayBeforeLimit;
                                            $assignedUser->update();
                                            $assignedFirst = true;
                                            $assignedSecond=true;

                                        }
                                    }
                                    WebUser::logAccess("Registro Secciones de forma masiva", $backgroundCheck->code);
								}
							} else if (
                                isset($_POST['assignUserSections']['verificationSectionGroupId']) &&
                                is_array($_POST['assignUserSections']['verificationSectionGroupId']) &&
								$userRole->id != UserRole::ASSIGNED
							) {
								foreach ($_POST['assignUserSections']['verificationSectionGroupId'] as $verificationSectionGroupId) {

									$criteria = new CDbCriteria;
									$criteria->compare('backgroundCheckId', $backgroundCheck->id);
									$criteria->compare('verificationSectionType.verificationSectionGroupId', $verificationSectionGroupId);
									$criteria->with[] = 'verificationSectionType';

									$verificationSections = VerificationSection::model()->findAll($criteria);

									foreach ($verificationSections as $verificationSection) {
										$assignedUser = AssignedUser::model()->findByAttributes(array(
											'backgroundCheckId' => $backgroundCheck->id,
											//'userId' => $user->id,
											'verificationSectionId' => $verificationSection->id,
										));
										if (!$assignedUser) { 
											$assignedUser = new AssignedUser;
                                            $assignedUser->userRoleId = $userRole->id;
                                            $assignedUser->backgroundCheckId = $backgroundCheck->id;
                                            $assignedUser->userId = $user->id;
											$assignedUser->verificationSectionId = $verificationSection->id;
                                            $assignedUser->limitAt = $backgroundCheck->oneDayBeforeLimit;
											$assignedUser->save();
											$assignedFirst = true;
                                            $assignedSecond=false;
										}else{

                                            $assignedUserDelete[]=["mail" => $assignedUser->user->username,
                                            "name" => $assignedUser->user->name];

                                            $assignedUser->userRoleId = $userRole->id;
                                            $assignedUser->backgroundCheckId = $backgroundCheck->id;
                                            $assignedUser->userId = $user->id;
                                            $assignedUser->verificationSectionId = $verificationSection->id;
                                            $assignedUser->limitAt = $backgroundCheck->oneDayBeforeLimit;
                                            $assignedUser->update();
                                            $assignedFirst = true;
                                            $assignedSecond=true;
                                        }
                                        
									}
                                    WebUser::logAccess("Registro grupo de secciones de forma masiva", $backgroundCheck->code);
								}
							} else {
                                $assignedUser = AssignedUser::model()->findByAttributes(array(
                                    'backgroundCheckId' => $backgroundCheck->id,
                                ));
                                if (!$assignedUser) { 
                                    $assignedUser = new AssignedUser;
                                    $assignedUser->userRoleId = $userRole->id;
                                    $assignedUser->backgroundCheckId = $backgroundCheck->id;
                                    $assignedUser->userId = $user->id;
                                    $assignedUser->verificationSectionId = null;
                                    $assignedUser->limitAt = $backgroundCheck->oneDayBeforeLimit;
                                    $assignedUser->save();
                                    $assignedFirst = true;
                                    $assignedSecond=false;
                                }else{

                                    $assignedUserDelete[]=["mail" => $assignedUser->user->username,
                                    "name" => $assignedUser->user->name];

                                    $assignedUser->userRoleId = $userRole->id;
                                    $assignedUser->userId = $user->id;
                                    $assignedUser->limitAt = $backgroundCheck->oneDayBeforeLimit;
                                    $assignedUser->update();
                                    $assignedFirst = true;
                                    $assignedSecond=true;
                                }
                                WebUser::logAccess("Registro responsable de estudio de forma masiva", $backgroundCheck->code);
                            }
						if ($backgroundCheck->backgroundCheckStatusId == BackgroundCheckStatus::REQUESTED) {
							$backgroundCheck->backgroundCheckStatusId = BackgroundCheckStatus::PROCESSING;
							$backgroundCheck->save();
						}
						if ($assignedFirst) {
							$body = $this->renderPartial('_mailAssignedMasive', array(
								'backgroundCheck' => $backgroundCheck,
								'assignedUser' => $assignedUser,
                                'user'=>$user,
							), true);

							if ($user->MailAssigned > 0) {
								Yii::app()->user->sendMailInBackground(
									"Estudio Ref [" . $backgroundCheck->code . "] asignado", //
									$body, //
									array($user->mailParam)
								);
							}

							if (!$backgroundCheck->assignedOn) {
								$backgroundCheck->assignedOn = new CDbExpression('NOW()');
								$backgroundCheck->save();
							}
							$assignedBackgroundChecks[] = $backgroundCheck->code;
						}

                        if($assignedSecond){

                            foreach ($assignedUserDelete as $userDelete) {
                                $userDlt = User::model()->findByAttributes(array('username' => $userDelete['mail']));
                                $userDeleteEmail= $userDelete['mail'];
                                $userDeleteName= $userDelete['name'];
                            }
                            
                            $bodyDelt = $this->renderPartial('_mailDeleteAssigned', array(
                                'backgroundCheck' => $backgroundCheck,
                                'assignedUser' => $assignedUser,
                            ), true);

                            if ($userDlt->Deallocated > 0) {
                                Yii::app()->user->sendMailInBackground(
                                    "Estudio Ref [" . $backgroundCheck->code . "] desasignado", //
                                    $bodyDelt, //
                                    [["mail" => $userDeleteEmail,
                                    "name" => $userDeleteName]]
                                );
                            }
                        }
					}
				}   
					$ans['ans'] = 'Se asignaron :' . implode(',', $assignedBackgroundChecks) . ' a :' . $user->username;
				} else {
                    $ans['error'] = 'No se hizo la asignación, por favor complete los parámetros';
				}

		} else {
            echo $ans['error'] = 'No se hizo la asignación, por favor complete los parámetros';
		}

        echo CJavaScript::jsonEncode($ans);
        Yii::app()->end();
    }

    public function actionMainteinance() {

        $counted = false;
        $saved = false;
        if (Yii::app()->user->isManager) {
            $model = new BackgroundCheck();
            $model->unsetAttributes();

            if (isset($_REQUEST['BackgroundCheck']['studyStartedOnFrom']) &&
                    isset($_REQUEST['BackgroundCheck']['studyStartedOnUntil'])
            ) {
                $model->attributes = $_REQUEST['BackgroundCheck'];
                $from = new DateTime($model->studyStartedOnFrom);
                $until = new DateTime($model->studyStartedOnUntil);
                if (trim(Yii::app()->user->arUser->pdfPassword) != '') {
                    set_time_limit(1800);

                    if (isset($_POST['log']) && isset($_POST['clearLog'])) {
                        $criteria1 = new CDbCriteria;
                        $criteria1->addCondition('created < "' . $until->format('Y-m-d') . '"');
                        OldLog::model()->deleteAll($criteria1);
                        Log::model()->deleteAll($criteria1);
                        Yii::app()->user->setFlash('notification', 'Se libero el espacio del log hasta ' . $until->format('Y-m-d'));
                    }

                    $criteria = new CDbCriteria;
                    $criteria->addCondition('t.studyStartedOn >= "' . $from->format('Y-m-d') . '"');
                    $criteria->addCondition('t.studyStartedOn <= "' . $until->format('Y-m-d') . '"');
                    $criteria->compare('t.customerId', $model->customerId);
                    $criteria->compare('customerProduct.name', $model->customerProductName, true);
                    $criteria->with[] = 'customer';
                    $criteria->with[] = 'customerProduct';
                    $models = BackgroundCheck::model()->findAll($criteria);
                    if (isset($_POST['calculate'])) {
                        Yii::app()->user->setFlash('notification', 'Se seleccionaron ' . count($models) .
                                ' desde ' . $from->format('Y-m-d') . ' hasta ' . $until->format('Y-m-d'));
                        $counted = true;
                    } else if (isset($_POST['discharge']) || isset($_POST['save'])) {
                        if (count($models) <= 1000) {
                            foreach ($models as $backgroundCheck) {
                                if (isset($_POST['save'])) {
                                    $this->saveReport($backgroundCheck);
                                    $saved = true;
                                    $counted = true;
                                }
                                if (isset($_POST['discharge'])) {
                                    $backgroundCheck->delete();
                                }
                            }
                            $path = Yii::app()->basePath . "/../../docs/000/*";
                            exec("rmdir " . $path);
                            $path = Yii::app()->basePath . "/../../sesdocs/000/*";
                            exec("rmdir " . $path);

                            if (isset($_POST['discharge'])) {
                                Yii::app()->user->setFlash('notification', 'Se eliminaron ' . count($models) .
                                        ' desde ' . $from->format('Y-m-d') . ' hasta ' . $until->format('Y-m-d'));
                            } else {
                                Yii::app()->user->setFlash('notification', 'Se descargaron ' . count($models) .
                                        ' desde ' . $from->format('Y-m-d') . ' hasta ' . $until->format('Y-m-d'));
                            }
                        } else {
                            Yii::app()->user->setFlash('notification', 'Se seleccionaron muchos resgistros ' . count($models) .
                                    ' desde ' . $from->format('Y-m-d') . ' hasta ' . $until->format('Y-m-d') . ' ' .
                                    'Por favor seleccione menos registros.');
                        }
                    }
                } else {
                    if (trim(Yii::app()->user->arUser->pdfPassword) == '') {
                        Yii::app()->user->setFlash('notification', 'El usuario tiene que tener password PDF para continuar.');
                    } else {
                        Yii::app()->user->setFlash('notification', 'No se puede liberar información inferior a 6 meses.');
                    }
                }
            }

            //Codigo Anterior
/*
            if (isset($_REQUEST['BackgroundCheck']['customerId']) && isset($_POST['recover']))
            {
                
                $studies = Yii::app()->db->createCommand()
                    ->select('id, code, seed')
                    ->from('ses_BackgroundCheck bkg')
                    // Desactivar para generar documentos de cliente especifico
                    ->where('bkg.customerId = :id and bkg.reportAvailable = 1', array(':id' => $_REQUEST['BackgroundCheck']['customerId']))
                    // Activar para generar documentos de cliente especifico
                    // ->where('bkg.customerId = :id and bkg.id in (142071,142136,142367,142743,143277,143591,143795,144754,145025,145213,145746,145849,145945,145955,146007,146024,146056,146478,146624,146626,146632,146793,147006,147283,147506,147605,147708,147711,147751,147754,147776,147782,147843,147928,148264,148293,148294,148493,148603,149643,149801,149813,149819,149822,149920,150830,151057,151083,151089,151091,151172,151729,152152,152304,152377,152419,152823,153276,153277,153278,153279,153280,153281,153282,153340,153879,154063,154109,154110,154129,154231,154232,154233,154234,154235,154236,154237,154238,154239,154284,154420,154422,154426,154448,154536,154539,154540,154541,154542,154543,154544,154545,154600,154602,154606,154609,154619,154661,154711,154720,154750,154796,154842,154843,154844,155155,155156,155175,155179,155283,155523,155692,155876,155886,155913,155945,156154,156155,156156,156157,156158,156255,156262,156370,156521,156613,156649,157089,157094,157145,157237,157376,157393,157485,157490,157530,157970,158004,158138,158142,158536,158577,158673,158677,158683,158800,158828,159321,159781,160066,160174,160175,160190,160501,160674,160693,160810,160969,161014,161092,161135,161136,161138,161142,161143,161146,161148,161151,161624,161702,161704,161716,161717,161993,162042,162125,162276,162281,162287,162491,162598,162747,163211,163460,163509,163513,163518,163519,163522,163523,163524,163588,163780,163803,164222,164303,164494,164503,164682,164698,164700,165001,165003,165047,165133,165135,165203,165446,165448,165449,165450,165451,165491,165786,165916,165955,165956,165957,165958,166001,166004,166005,166114,166228,166257,166278,166492,166690,166734,166735,166903,166909,167176,167532,168541,168542,168543,168984,169338,169340,169400,169591,169594,169623,169679,169683,170479,170512,170677,170819,170848,171150,171284,171428,171455,171461,171538,171540,171548,171549,171555,171657,171773,171867,172042,172101,172133,172175,172178,172304,172320,172321,172348,172351,172353,172355,172496,172505,172692,172742,172763,172776,172788,172814,172846,173052,173092,173127,173172,173183,173674,173695,173804,173909,174232,174401,174484,174578,174612,174638,174778,174821,174830,174875,174893,175098,175143,175200,175201,175206,175207,175307,175677,175799,175800,175858,175920,176102,176354,176357,176422,176443,176448,176458,176522,176535,177009,177314,177433,178080,178888,179076,179077,179839,179937,180368,180891,180894,180895,181116,181221,181300,181556,181569,181588,181594,181648,181670,181676,181711,181805,181862,181947,182012,182200,182201,182202,182205,182206,182207,182208,182209,182210,182212,182214,182215,182217,182218,182269,182270,182272,182273,182276,182281,182284,182285,182286,182553,182711,182717,182825,182826,182827,182837,183420,183485,183490,183496,183500,183645,183665,183667,184095,184156,185035,185036,185037,185039,185041,185042,185043,185044,185048,185124,185260,185318,185353,185373,185401,185408,185420,185437,185499,185501,185551,185562,185569,185580,185583,185678,185697,185699,185701,185702,185804,186064,186135,186138,186140,186163,186254,186368,186427,186478,186498,186501,186504,186506,186507,186512,186536,186537,186538,186539,186549,186553,186623,186624,186724,186737,186811,186815,186856,186858,186860,186863,186867,186946,186948,186969,187116,187449,189103,189104,189114,189272,189709,189765,189795,190197,190441,190594,191001,191015,191191,191262,191669,191670,191671,191672,191673,191674,191743,191744,191745,191815,191968)  and bkg.reportAvailable = 1', array(':id' => $_REQUEST['BackgroundCheck']['customerId']))
                    //->where('bkg.customerId = :id and bkg.id in (78959,79324,79896,79898,80968,81626,81643,81653,81701,81702,81703,81758,81937,82287,82289,82291,82479,82481,82583,82881,82884,82888,82894,83229,83668,83669,83670,83671,83672,83673,84593,84899,84902,84905,85008,85252,85322,85609,85912,85916,86047,86419,86820,87133,87390,87623,87634,87756,88069,88132,88133,88134,88135,88136,88137,88138,88139,88583,88595,88725,88728,88803,89069,89091,89103,89104,89931,89933,89954,89959,89960,89961,89962,89963,89964,89965,89966,89967,89968,89969,90337,90450,90734,90901,91060,91064,91276,91541,91551,91584,91585,91586,91612,91613,91614,91615,91616,91617,92121,92172,92407,93729,93781,93929,93931,94476,94527,94600,94691,94692,94704,94926,94928,95604,95697,95699,95703,95731,95735,95736,95737,95745,95748,95762,95907,95909,95920,96116,96643,96650,96785,96786,96789,96790,96791,96793,96794,96795,96797,97005,97006,97325,97578,97756,97757,97758,97852,97880,98034,98035,98036,98037,98038,98039,98040,98041,98042,98043,98044,98045,98081,98084,98087,98099,98594,98596,98599,98600,98601,98604,98605,98609,98611,98613,98615,98616,99015,99032,99490,99491,99492,99493,99506,99508,99522,99572,100355,100401,100905,100916,101054,101056,101384,101395,101412,102066,102069,102977,103067,103068,103069,103070,103370,103575,103576,103625,103827,103828,103830,104330,104499,104505,104744,104745,104838,104840,104841,104842,104843,104991,104992,105214,105397,105398,105458,105459,105460,105461,105663,105677,105678,105684,105954,106002,106050,106134,106308,106311,106313,106315,106338,106491,106492,106717,106777,107008,107009,107010,107052,107089,107093,107100,107101,107102,107135,107151,107335,107482,107484,107485,107493,107641,107826,107853,107854,107855,107856,107857,107858,107859,107860,108015,108310,108314,108586,108668,108670,108861,109155,109178,109552,109553,109555,109645,110172,110346,110672,111390,111534,111565,111684,111685,111686,111688,111690,111691,112958,113132,113199,113418,113646,113782,113808,115352,115788,115822,116768,116937,116981,117310,117395,117396,117398,117402,117601,117738,117973,117974,118255,118528,118566,118577,118578,118581,118803,118804,118970,119028,119053,119355,119727,119737,119843,120141,120166,120341,120805,120806,120809,120810,120812,121397,121431,121432,121599,123686,123778,124100,124505,124513,125498,125802,126037,127319,127320,127321,127697,127982,127985,128909,128945,128946,128947,129311,129412,129994,130087,130119,130397,131546,131645,131994,132013,132121,132392,132394,132398,132533,132883,132884,133494,133815,133823,133824,133826,133827,133990,134032,134253,134428,134430,134826,134827,134978,135133,135134,135228,135231,135251,135385,135523,135524,135585,135587,135728,135738,135784,135787,135854,135884,135886,136248,136464,136677,136759,136942,137232,137265,137298,137302,137304,137308,137310,137313,137316,137319,137324,137328,137333,137335,137338,137352,137353,137402,137450,137453,137483,137708,137709,137934,137946,138238,138239,138554,138619,138620,138621,138772,138773,138775,138776,138778,138779,138852,138853,139000,139001,139003,139014,139020,139023,139270,139272,139273,139275,139276,139277,139321,139324,139646,139647,139648,139659,139660,139664,139904,139974,140123,140338,140353,140423,140425,140473,140858,140935,141260,141263,141267,141284,141358,141399,141734,141735,141736,141738,141739,141740,141741,141742,142580,142778,142790,142792,143141,143186,143193,143203,143220,143413,143415,143482,143663,143764,144221,144289,144311,145043,145188,145190,145352,145993,145994,146059,146094,146160,146702,146944,146973,146983,146984,146985,147031,147032,147038,147181,147192,147218,147458,147493,147495,147499,147509,147558,147559,147618,147740,147763,147879,147881,147933,147934,147935,148164,148262,148473,148587,148588,148602,148852,149492,149493,149494,149586,149664,149703,149887,149888,150105,150159,150864,151164,151209,151210,151346,151350,152247,152327,152332,153691,153693,153729,153761,153762,153763,153764,153771,154373,154665,155308,155619,155704,155705,155707,156030,156057,156070,156120,156711,156874,156876,156879,156898,156899,156900,157034,157036,157037,157351,157525,157759,157772,158088,158089,158109,158110,158115,158118,158119,158178,158416,158432,158433,158602,158605,158608,158609,158879,159343,159344,159964,160008,160013,160048,160154,160156,160162,160518,160539,160627,160648,160934,161112,161691,161692,161694,161695,161696,161697,161698,161699,161703,161705,161816,161905,162106,162133,162148,162310,162358,162362,162398,162405,162416,162497,162562,162564,162742,163105,163204,163294,164202,164399,164771,164788,165195,165215,165241,165274,165275,165463,166171,166336,166337,166555,166556,167123,167125,167126,167127,167136,167145,167149,167183,167312,167346,167354,167356,167387,167439,167449,168157,168158,168395,168588,168707,169826,170086,170203,170204,170323,170363,170755,170971,170972,170978,171557,171558,171559,171562,171563,171577,171584,171585,171587,171588,171960,172022,172111,172119,172122,172124,172130,172274,172280,172283,172286,172288,172289,172588,172589,172590,172591,172592,172593,172594,172595,172596,172597,172598,172599,172600,172601,172602,172603,172604,172605,172606,172607,172608,173682,173687,173836,174100,174119,174130,174164,174251,174337,174339,174340,175007,175185,175186,175760,176343,176865,176875,177152,177279,177307,177337,177445,177612,177617,177644,177645,177646,178213,178214,178215,178216,178217,178218,178219,178220,178221,178758,178878,179428,179752,181655,181658,181952,182093,182271,182274,182280,182759,182844,183298,183303,183328,183519,183520,183522,183523,184132,184242,184267,185539,185571,185604,185605,185606,185607,185608,185609,185610,185611,185612,185613,185715,186437,186598,186603,186722,186739,186748,186894,186895,186896,186897,189395,189396,189458,189629,190050,190052,190070,190071,190332,191628,191822,192080,192081,192083,192086,192087,193296,193447,193452,193454,193455,193674,193789,195079,195546,195549,195688,196023,196024,196486,196487,196488,196924,197531,197541,197947,197951,199301,200001,200008,200027,200379,200973,201001,201298,201663,201963,202448,202802,203557,203917,203934,204762,204763,204962,205075,206059,206218,206255,206551,206716,206722,207016,207056,207105,207107,207108,207109,207239,207241,207257,207571)  and bkg.reportAvailable = 1', array(':id' => $_REQUEST['BackgroundCheck']['customerId']))
                    ->queryAll();

                foreach ($studies as $key => $study) {
                    //echo "id: " . $study["id"]. "<br>";
                    // Se exportan los reportes
                    $iv = substr(md5($study["id"] . $study["code"], true), 0, 8);      
                    $key = substr(md5($study["seed"], true), 0, 24);

                    $opts = array('iv' => $iv, 'key' => $key);

                    $subdir = '';
                    $nameFile = '';
                    if ($study["id"] > 0 && $study["id"] <= 99999){
                        $subdir = '0'.substr($study["id"], 0, 2);
                        $nameFile = '/0000' . $study["id"];
                    }else if($study["id"] > 99999 && $study["id"] <= 999999){
                        $subdir = substr($study["id"], 0, 3);
                        $nameFile = '/000' . $study["id"];
                    }

                    $absdir = Yii::app()->params['reportsDir'] . '/000/' . $subdir . $nameFile .  '.enc';

                    if ( file_exists($absdir) ) 
                    {
                        $fp = fopen($absdir, 'rb');
                        stream_filter_append($fp, 'mdecrypt.tripledes', STREAM_FILTER_READ, $opts);
                        $data = stream_get_contents($fp);
                        
                        fclose($fp);

                        if (!file_exists('/data/client_docs/' . $study["id"])) {
							mkdir('/data/client_docs/' . $study["id"], 0777, true);
                        }
                        $filenameIn = '/data/client_docs/' . $study["id"] . '/' . $study["code"] . '.pdf';
                        file_put_contents($filenameIn, $data);
                    } */
            //Codigo Anterior

            //Codigo Jonathan Nuevo

            if (isset($_REQUEST['BackgroundCheck']['customerId']) && isset($_POST['recover']))
            {
                $studies = Yii::app()->db->createCommand()
                    ->select('id, code, seed, idNumber')
                    ->from('ses_BackgroundCheck bkg')
                    // Desactivar para generar documentos de cliente especifico
                    // and bkg.created > "2020-09-09"
                    ->where('bkg.customerId = :id and bkg.reportAvailable = 1 and bkg.created >= :creadoFrom and bkg.created <= :createdUntil', array(':id' => $_REQUEST['BackgroundCheck']['customerId'],':creadoFrom' => $_POST['createdOnFrom'],':createdUntil' => $_POST['createdOnUntil']))
                    // Activar para generar documentos de cliente especifico
                    // ->where('bkg.customerId = :id and bkg.id in (142071,142136,142367,142743,143277,143591,143795,144754,145025,145213,145746,145849,145945,145955,146007,146024,146056,146478,146624,146626,146632,146793,147006,147283,147506,147605,147708,147711,147751,147754,147776,147782,147843,147928,148264,148293,148294,148493,148603,149643,149801,149813,149819,149822,149920,150830,151057,151083,151089,151091,151172,151729,152152,152304,152377,152419,152823,153276,153277,153278,153279,153280,153281,153282,153340,153879,154063,154109,154110,154129,154231,154232,154233,154234,154235,154236,154237,154238,154239,154284,154420,154422,154426,154448,154536,154539,154540,154541,154542,154543,154544,154545,154600,154602,154606,154609,154619,154661,154711,154720,154750,154796,154842,154843,154844,155155,155156,155175,155179,155283,155523,155692,155876,155886,155913,155945,156154,156155,156156,156157,156158,156255,156262,156370,156521,156613,156649,157089,157094,157145,157237,157376,157393,157485,157490,157530,157970,158004,158138,158142,158536,158577,158673,158677,158683,158800,158828,159321,159781,160066,160174,160175,160190,160501,160674,160693,160810,160969,161014,161092,161135,161136,161138,161142,161143,161146,161148,161151,161624,161702,161704,161716,161717,161993,162042,162125,162276,162281,162287,162491,162598,162747,163211,163460,163509,163513,163518,163519,163522,163523,163524,163588,163780,163803,164222,164303,164494,164503,164682,164698,164700,165001,165003,165047,165133,165135,165203,165446,165448,165449,165450,165451,165491,165786,165916,165955,165956,165957,165958,166001,166004,166005,166114,166228,166257,166278,166492,166690,166734,166735,166903,166909,167176,167532,168541,168542,168543,168984,169338,169340,169400,169591,169594,169623,169679,169683,170479,170512,170677,170819,170848,171150,171284,171428,171455,171461,171538,171540,171548,171549,171555,171657,171773,171867,172042,172101,172133,172175,172178,172304,172320,172321,172348,172351,172353,172355,172496,172505,172692,172742,172763,172776,172788,172814,172846,173052,173092,173127,173172,173183,173674,173695,173804,173909,174232,174401,174484,174578,174612,174638,174778,174821,174830,174875,174893,175098,175143,175200,175201,175206,175207,175307,175677,175799,175800,175858,175920,176102,176354,176357,176422,176443,176448,176458,176522,176535,177009,177314,177433,178080,178888,179076,179077,179839,179937,180368,180891,180894,180895,181116,181221,181300,181556,181569,181588,181594,181648,181670,181676,181711,181805,181862,181947,182012,182200,182201,182202,182205,182206,182207,182208,182209,182210,182212,182214,182215,182217,182218,182269,182270,182272,182273,182276,182281,182284,182285,182286,182553,182711,182717,182825,182826,182827,182837,183420,183485,183490,183496,183500,183645,183665,183667,184095,184156,185035,185036,185037,185039,185041,185042,185043,185044,185048,185124,185260,185318,185353,185373,185401,185408,185420,185437,185499,185501,185551,185562,185569,185580,185583,185678,185697,185699,185701,185702,185804,186064,186135,186138,186140,186163,186254,186368,186427,186478,186498,186501,186504,186506,186507,186512,186536,186537,186538,186539,186549,186553,186623,186624,186724,186737,186811,186815,186856,186858,186860,186863,186867,186946,186948,186969,187116,187449,189103,189104,189114,189272,189709,189765,189795,190197,190441,190594,191001,191015,191191,191262,191669,191670,191671,191672,191673,191674,191743,191744,191745,191815,191968)  and bkg.reportAvailable = 1', array(':id' => $_REQUEST['BackgroundCheck']['customerId']))
                    //->where('bkg.customerId = :id and bkg.id in (78959,79324,79896,79898,80968,81626,81643,81653,81701,81702,81703,81758,81937,82287,82289,82291,82479,82481,82583,82881,82884,82888,82894,83229,83668,83669,83670,83671,83672,83673,84593,84899,84902,84905,85008,85252,85322,85609,85912,85916,86047,86419,86820,87133,87390,87623,87634,87756,88069,88132,88133,88134,88135,88136,88137,88138,88139,88583,88595,88725,88728,88803,89069,89091,89103,89104,89931,89933,89954,89959,89960,89961,89962,89963,89964,89965,89966,89967,89968,89969,90337,90450,90734,90901,91060,91064,91276,91541,91551,91584,91585,91586,91612,91613,91614,91615,91616,91617,92121,92172,92407,93729,93781,93929,93931,94476,94527,94600,94691,94692,94704,94926,94928,95604,95697,95699,95703,95731,95735,95736,95737,95745,95748,95762,95907,95909,95920,96116,96643,96650,96785,96786,96789,96790,96791,96793,96794,96795,96797,97005,97006,97325,97578,97756,97757,97758,97852,97880,98034,98035,98036,98037,98038,98039,98040,98041,98042,98043,98044,98045,98081,98084,98087,98099,98594,98596,98599,98600,98601,98604,98605,98609,98611,98613,98615,98616,99015,99032,99490,99491,99492,99493,99506,99508,99522,99572,100355,100401,100905,100916,101054,101056,101384,101395,101412,102066,102069,102977,103067,103068,103069,103070,103370,103575,103576,103625,103827,103828,103830,104330,104499,104505,104744,104745,104838,104840,104841,104842,104843,104991,104992,105214,105397,105398,105458,105459,105460,105461,105663,105677,105678,105684,105954,106002,106050,106134,106308,106311,106313,106315,106338,106491,106492,106717,106777,107008,107009,107010,107052,107089,107093,107100,107101,107102,107135,107151,107335,107482,107484,107485,107493,107641,107826,107853,107854,107855,107856,107857,107858,107859,107860,108015,108310,108314,108586,108668,108670,108861,109155,109178,109552,109553,109555,109645,110172,110346,110672,111390,111534,111565,111684,111685,111686,111688,111690,111691,112958,113132,113199,113418,113646,113782,113808,115352,115788,115822,116768,116937,116981,117310,117395,117396,117398,117402,117601,117738,117973,117974,118255,118528,118566,118577,118578,118581,118803,118804,118970,119028,119053,119355,119727,119737,119843,120141,120166,120341,120805,120806,120809,120810,120812,121397,121431,121432,121599,123686,123778,124100,124505,124513,125498,125802,126037,127319,127320,127321,127697,127982,127985,128909,128945,128946,128947,129311,129412,129994,130087,130119,130397,131546,131645,131994,132013,132121,132392,132394,132398,132533,132883,132884,133494,133815,133823,133824,133826,133827,133990,134032,134253,134428,134430,134826,134827,134978,135133,135134,135228,135231,135251,135385,135523,135524,135585,135587,135728,135738,135784,135787,135854,135884,135886,136248,136464,136677,136759,136942,137232,137265,137298,137302,137304,137308,137310,137313,137316,137319,137324,137328,137333,137335,137338,137352,137353,137402,137450,137453,137483,137708,137709,137934,137946,138238,138239,138554,138619,138620,138621,138772,138773,138775,138776,138778,138779,138852,138853,139000,139001,139003,139014,139020,139023,139270,139272,139273,139275,139276,139277,139321,139324,139646,139647,139648,139659,139660,139664,139904,139974,140123,140338,140353,140423,140425,140473,140858,140935,141260,141263,141267,141284,141358,141399,141734,141735,141736,141738,141739,141740,141741,141742,142580,142778,142790,142792,143141,143186,143193,143203,143220,143413,143415,143482,143663,143764,144221,144289,144311,145043,145188,145190,145352,145993,145994,146059,146094,146160,146702,146944,146973,146983,146984,146985,147031,147032,147038,147181,147192,147218,147458,147493,147495,147499,147509,147558,147559,147618,147740,147763,147879,147881,147933,147934,147935,148164,148262,148473,148587,148588,148602,148852,149492,149493,149494,149586,149664,149703,149887,149888,150105,150159,150864,151164,151209,151210,151346,151350,152247,152327,152332,153691,153693,153729,153761,153762,153763,153764,153771,154373,154665,155308,155619,155704,155705,155707,156030,156057,156070,156120,156711,156874,156876,156879,156898,156899,156900,157034,157036,157037,157351,157525,157759,157772,158088,158089,158109,158110,158115,158118,158119,158178,158416,158432,158433,158602,158605,158608,158609,158879,159343,159344,159964,160008,160013,160048,160154,160156,160162,160518,160539,160627,160648,160934,161112,161691,161692,161694,161695,161696,161697,161698,161699,161703,161705,161816,161905,162106,162133,162148,162310,162358,162362,162398,162405,162416,162497,162562,162564,162742,163105,163204,163294,164202,164399,164771,164788,165195,165215,165241,165274,165275,165463,166171,166336,166337,166555,166556,167123,167125,167126,167127,167136,167145,167149,167183,167312,167346,167354,167356,167387,167439,167449,168157,168158,168395,168588,168707,169826,170086,170203,170204,170323,170363,170755,170971,170972,170978,171557,171558,171559,171562,171563,171577,171584,171585,171587,171588,171960,172022,172111,172119,172122,172124,172130,172274,172280,172283,172286,172288,172289,172588,172589,172590,172591,172592,172593,172594,172595,172596,172597,172598,172599,172600,172601,172602,172603,172604,172605,172606,172607,172608,173682,173687,173836,174100,174119,174130,174164,174251,174337,174339,174340,175007,175185,175186,175760,176343,176865,176875,177152,177279,177307,177337,177445,177612,177617,177644,177645,177646,178213,178214,178215,178216,178217,178218,178219,178220,178221,178758,178878,179428,179752,181655,181658,181952,182093,182271,182274,182280,182759,182844,183298,183303,183328,183519,183520,183522,183523,184132,184242,184267,185539,185571,185604,185605,185606,185607,185608,185609,185610,185611,185612,185613,185715,186437,186598,186603,186722,186739,186748,186894,186895,186896,186897,189395,189396,189458,189629,190050,190052,190070,190071,190332,191628,191822,192080,192081,192083,192086,192087,193296,193447,193452,193454,193455,193674,193789,195079,195546,195549,195688,196023,196024,196486,196487,196488,196924,197531,197541,197947,197951,199301,200001,200008,200027,200379,200973,201001,201298,201663,201963,202448,202802,203557,203917,203934,204762,204763,204962,205075,206059,206218,206255,206551,206716,206722,207016,207056,207105,207107,207108,207109,207239,207241,207257,207571)  and bkg.reportAvailable = 1', array(':id' => $_REQUEST['BackgroundCheck']['customerId']))
                    ->queryAll();

                foreach ($studies as $key => $study) {
                    //echo "id: " . $study["id"]. "<br>";
                    // Se exportan los reportes
                    $iv = substr(md5($study["id"] . $study["code"], true), 0, 8);
                    $key = substr(md5($study["seed"], true), 0, 24);

                    $opts = array('iv' => $iv, 'key' => $key);

                    $subdir = '';
                    $nameFile = '';
                    if ($study["id"] > 0 && $study["id"] <= 99999){
                        $subdir = '0'.substr($study["id"], 0, 2);
                        $nameFile = '/0000' . $study["id"];
                    }else if($study["id"] > 99999 && $study["id"] <= 999999){
                        $subdir = substr($study["id"], 0, 3);
                        $nameFile = '/000' . $study["id"];
                    }

                    $absdir = Yii::app()->params['reportsDir'] . '/000/' . $subdir . $nameFile .  '.enc';

                    if ( file_exists($absdir) )
                    {
                        $fp = fopen($absdir, 'rb');
                        stream_filter_append($fp, 'mdecrypt.tripledes', STREAM_FILTER_READ, $opts);
                        $data = stream_get_contents($fp);

                        fclose($fp);

                        if (!file_exists('/data/client_docs/' . $study["idNumber"])) {
                            mkdir('/data/client_docs/' . $study["idNumber"], 0777, true);
                        }
                        $filenameIn = '/data/client_docs/' . $study["idNumber"] . '/' . $study["code"] . '.pdf';
                        file_put_contents($filenameIn, $data);


                    }
                    // Se exportan los documentos
                    $studies2 = Yii::app()->db->createCommand()
                        ->select('id, filename, seed, extension, name')
                        ->from('ses_Document doc')
                        ->where('doc.backgroundCheckId = :bkgid', array(':bkgid' => $study["id"]))
                        ->queryAll();

                    foreach ($studies2 as $key => $study2) {
                        $iv = substr(md5($study["seed"], true), 0, 8);
                        $key = substr(md5($study2["seed"], true), 0, 24);
                        $opts = array('iv' => $iv, 'key' => $key);
                        $subdir = substr($study2["id"], 0, 3);
                        $absdir2 = Yii::app()->params['docsDir'] . '/000/' . $subdir . '/' . $study2["filename"];
                        if(file_exists($absdir2))
                        {
                            $fp2 = fopen($absdir2, 'rb');
                            stream_filter_append($fp2, 'mdecrypt.tripledes', STREAM_FILTER_READ, $opts);
                            $data2 = stream_get_contents($fp2);
                            
                            fclose($fp2);

                            // La ruta donde se almacenan los archivos queda estática.

                            if (!file_exists('/data/client_docs/' . $study["id"] . '/docs')) {
                                 mkdir('/data/client_docs/' . $study["id"] . '/docs', 0777, true);                                
                            }
                            $filenameIn2 = '/data/client_docs/' . $study["id"]. '/docs/' . $study["code"] . ' - ' . $study2["name"] . '.' . $study2["extension"];

                            // file_put_contents($filenameIn2, $data2);
                            if (!file_put_contents($filenameIn2, $data2)){
                                echo "Fallo la creacion del archivo " . $filenameIn2;
                            };
                        }
                    }
                }



                Yii::app()->user->setFlash('notification', 'Se recuperó la información para el cliente ' . $_REQUEST['BackgroundCheck']['customerId'] . '.');
            }

            
            if (isset($_REQUEST['BackgroundCheck']['customerId']) && isset($_POST['recoverCertf']))
            {
                $studies = Yii::app()->db->createCommand()
                    ->select('id, code, seed, idNumber')
                    ->from('ses_BackgroundCheck bkg')
                    // Desactivar para generar documentos de cliente especifico
                    // and bkg.created > "2020-09-09"
                    ->where('bkg.customerId = :id and bkg.reportAvailable = 1 and bkg.created >= :creadoFrom and bkg.created <= :createdUntil', array(':id' => $_REQUEST['BackgroundCheck']['customerId'],':creadoFrom' => $_POST['createdOnFrom'],':createdUntil' => $_POST['createdOnUntil']))
                    ->queryAll();

                foreach ($studies as $key => $study) {
                    //echo "id: " . $study["id"]. "<br>";
                    // Se exportan los reportes
                    $iv = substr(md5($study["id"] . $study["code"], true), 0, 8);
                    $key = substr(md5($study["seed"], true), 0, 24);

                    $opts = array('iv' => $iv, 'key' => $key);

                    $subdir = '';
                    $nameFile = '';
                    if ($study["id"] > 0 && $study["id"] <= 99999){
                        $subdir = '0'.substr($study["id"], 0, 2);
                        $nameFile = '/0000' . $study["id"];
                    }else if($study["id"] > 99999 && $study["id"] <= 999999){
                        $subdir = substr($study["id"], 0, 3);
                        $nameFile = '/000' . $study["id"];
                    }

                    $absdir = Yii::app()->params['reportsDir'] . '/000/' . $subdir . $nameFile .  '_c.enc';

                    if ( file_exists($absdir) )
                    {
                        $fp = fopen($absdir, 'rb');
                        stream_filter_append($fp, 'mdecrypt.tripledes', STREAM_FILTER_READ, $opts);
                        $data = stream_get_contents($fp);

                        fclose($fp);

                        if (!file_exists('/data/client_docs_certf/' . $study["idNumber"])) {
                            mkdir('/data/client_docs_certf/' . $study["idNumber"], 0777, true);
                        }
                        $filenameIn = '/data/client_docs_certf/' . $study["idNumber"] . '/' . $study["code"] . '.pdf';
                        file_put_contents($filenameIn, $data);


                    }
                }

                Yii::app()->user->setFlash('notification', 'Se recuperó la información de certificados para el cliente ' . $_REQUEST['BackgroundCheck']['customerId'] . '.');
            }

            $this->render('maintenance', array(
                'model' => $model,
                'counted' => $counted,
                'saved' => $saved,
            ));
        } else {
            $this->redirect('/backgroundCheck/admin');
        }
    }

    /**
     * @param BackgroundCheck $backgroundCheck
     */
    private function saveReport($backgroundCheck) {
        $ans = false;
        $directory = Yii::app()->params['downloadDir'] .
                substr($backgroundCheck->studyStartedOn, 0, 4) . '/' .
                substr($backgroundCheck->studyStartedOn, 5, 2) . '/' .
                substr($backgroundCheck->studyStartedOn, 8, 2) . '/' .
                $backgroundCheck->code.'/';
        if (!file_exists($directory)) {
            umask(0000);
            mkdir($directory, 0770, true);
            umask(0007);
        }
        $filename = $directory . 
                str_replace(array(',', '.', ' '), array('', '', ''), $backgroundCheck->idNumber) .
                '_' . str_replace(array('&', '%', '/', '\\', ' '), '_', strtoupper(iconv('UTF-8', 'ASCII//TRANSLIT', $backgroundCheck->fullname)));
        if ($backgroundCheck->reportAvailable && file_exists($backgroundCheck->absolutePath)) {
            $pdfData = $backgroundCheck->getBackgroundCheckReport(
                    Yii::app()->user->arUser->pdfPassword, true
                    , Yii::app()->user->name);
            $ans = file_put_contents($filename . '_rep.pdf', $pdfData);
        } else {
            $cryptedData = $backgroundCheck->getCryptedPdf(
                    $this->renderPartial('_pdfView'
                            , array(
                        'backgroundCheck' => $backgroundCheck,
                        'filename' => null,
                            )
                            , true)
                    , Yii::app()->user->arUser->pdfPassword
                    , true
                    , ($backgroundCheck->isApproved ? Yii::app()->user->name : "Borrador  Borrador  Borrador  Borrador")
                    , null
                    , null);


            $ans = file_put_contents($filename . '_rep_temp.pdf', $cryptedData);
        }
        if ($ans && $backgroundCheck && $backgroundCheck->certificateAvailable && file_exists($backgroundCheck->absolutePathCert)) {
            $pdfData = $backgroundCheck->getBackgroundCheckReport(
                    Yii::app()->user->arUser->pdfPassword, true
                    , Yii::app()->user->name);
            $ans = file_put_contents($filename . '_cert.pdf', $pdfData);
        }
        return $ans;
    }

    //Natalia Henao
    //workflow Integration con Zona franca 
    //14/09/2021
    /**
     * @param BackgroundCheck $backgroundCheck
    */
    public function actionNewWorflow($code, $pc) {
    
        $backgroundCheck = $this->loadModel($code);
        $model = BackgroundCheck::model()->findByAttributes(array('code' => $code));

        // Server domain or server ip
        $server = "zfb.softexpert.com";

        //Local WSDL File (in this sample we are using SE Administration WebService)
        //$wsdl = "adm_ws.wsdl";
        //URL to download a remote WSDL
        $wsdl = "https://$server/se/ws/wf_ws.php?wsdl";

        //endpoint to connect
        $location = "https://$server/apigateway/se/ws/wf_ws.php";

        $context = array(
        'http' => array(
        'header' => 'Authorization: eyJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MjY1NDEzMTMsImV4cCI6MTc2NzIyNTU0MCwiaWRsb2dpbiI6IkludGVncmFkb3IiLCJyYXRlbGltaXQiOjEyMCwicXVvdGFsaW1pdCI6MTAwMDAwfQ.XpXvo-3VP8JVqIwYQvcC6C9cIdgTMzfrxyUyjKf4H2E'
        ));   

        try{
          $client = new SoapClient($wsdl,array(
              "trace" => 1, // enable trace
              "exceptions" => 1, // enable exceptions
              "stream_context" => stream_context_create($context),
              "location" => $location
          ));

          $criteria = new CDbCriteria;
  
          $criteria->addCondition('backgroundCheckId=:id');
          $criteria->addCondition('xmlSection.answer != ""');
          $criteria->addCondition("verificationSectionTypeId=107");
          $criteria->with=['xmlSection'];
          $criteria->params=[':id'=>$backgroundCheck->id];
          $xmlSection= VerificationSection::model()->findAll($criteria);

          $RiesgoSarlaft=[];
      
          foreach ($xmlSection AS $xmlsec){
              $RiesgoSarlaft[]=[
                  'verificationSectionTypeId'=>$xmlsec->verificationSectionTypeId,
                  'answer'=>$xmlsec->xmlSection->answer
              ];
          }

          $XMLQuestionResult = array();
          foreach($RiesgoSarlaft as $answer){
              $result =  unserialize($answer['answer']) ;
              $XMLQuestionResult = array_merge($XMLQuestionResult, $result);   
              if($XMLQuestionResult['sectionImpact_1']=="ALTO" || $XMLQuestionResult['sectionImpact_1']=="MEDIO"){
                  $rjudicial=1;
              }else if($XMLQuestionResult['sectionImpact_1']=="BAJO" || $XMLQuestionResult['sectionImpact_1']=="NO APLICA"){
                  $rjudicial=0;
              } 

              if($XMLQuestionResult['sectionImpact_2']=="ALTO" || $XMLQuestionResult['sectionImpact_2']=="MEDIO"){
                  $rsagrilaft=1;
              }else if($XMLQuestionResult['sectionImpact_2']=="BAJO" || $XMLQuestionResult['sectionImpact_2']=="NO APLICA"){
                  $rsagrilaft=0;
              } 

              if($XMLQuestionResult['sectionImpact_3']=="ALTO" || $XMLQuestionResult['sectionImpact_3']=="MEDIO"){
                  $rfinanciero=1;
              }else if($XMLQuestionResult['sectionImpact_3']=="BAJO" || $XMLQuestionResult['sectionImpact_3']=="NO APLICA"){
                  $rfinanciero=0;
              } 

              if($XMLQuestionResult['sectionImpact_4']=="ALTO" || $XMLQuestionResult['sectionImpact_4']=="MEDIO"){
                  $rreputacional=1;
              }else if($XMLQuestionResult['sectionImpact_4']=="BAJO" || $XMLQuestionResult['sectionImpact_4']=="NO APLICA"){
                  $rreputacional=0;
              } 

              if($XMLQuestionResult['sectionImpact_5']=="ALTO" || $XMLQuestionResult['sectionImpact_5']=="MEDIO"){
                  $rlegal=1;
              }else if($XMLQuestionResult['sectionImpact_5']=="BAJO" || $XMLQuestionResult['sectionImpact_5']=="NO APLICA"){
                  $rlegal=0;
              } 

              $nohallazgo=$rjudicial+$rsagrilaft+$rfinanciero+$rreputacional+$rlegal;
              if($nohallazgo==0){
                  $nohayhallazgo=1;  
                  $resul='Sin Hallazgo';
              }else{
                  $nohayhallazgo=0;
                  $resul='Con Hallazgo';
              }
          }
    
          if($model->customerProductId=='3642'){
              $tipConsulta='Tipo A - Consulta individual de terceros';
          }else if($model->customerProductId=='3644'){
              $tipConsulta='Tipo C - Debida Diligencia Intensificada';
          }

          $titulo=CHtml::encode($model->customerField1).'-'.CHtml::encode($model->lastName).'-'.$tipConsulta.'-'.$resul;

          $conect = $client->newWorkflow(
              [
                  'ProcessID' => "OC-001",
                  'WorkflowTitle' =>$titulo,
                  'UserID' => "",
              ]);

          $returnconet=json_decode(json_encode($conect),true);
          //echo $returnconet['RecordID'].'<br><br><br>';
          
          $data = "UPDATE ses_BackgroundCheck SET WorkflowID='".$returnconet['RecordID']."' WHERE code='".$code."';";
          $query = Yii::app()->db->createCommand($data)->execute();

          if($model->shareholderType==0){
              $tipoId='Nit';
          }else if($model->shareholderType==1){
              $tipoId='Cédula';
          }

          if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER))
              $shareholdersSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER);
          
          $nrepresentante="";
          $idrepresentante="";
          foreach ($shareholdersSection->detailShareholder as $shareholder) {    
              $nrepresentante=$shareholder->firstName." ".$shareholder->lastName;
              $idrepresentante=$shareholder->idNumber;
              break 1;
          }

          $data =$client->editEntityRecord(
              [
              'WorkflowID' => $returnconet['RecordID'],
              'EntityID' => "sagrilaft",
              'EntityAttributeList'=>[
                  [
                      'EntityAttributeID' => 'razonsocial',
                      'EntityAttributeValue' =>$model->lastName,
                  ], 
                  [
                      'EntityAttributeID' => 'tipoidan',
                      'EntityAttributeValue' => $tipoId, 
                  ], 
                  [
                      'EntityAttributeID' => 'nidentificacion',
                      'EntityAttributeValue' => $model->idNumber,
                  ],  
                  [
                      'EntityAttributeID' => 'dirprincipal',
                      'EntityAttributeValue' =>$model->address,
                  ],  
                  [
                      'EntityAttributeID' => 'nmreplegal',
                      'EntityAttributeValue' => $nrepresentante,
                  ],  
                  [
                      'EntityAttributeID' => 'nidenreplegal',
                      'EntityAttributeValue' => $idrepresentante,
                  ],  
                  [
                      'EntityAttributeID' => 'telefono',
                      'EntityAttributeValue' => $model->tels,
                  ],  
                  [
                      'EntityAttributeID' => 'nmcontacto',
                      'EntityAttributeValue' => $model->contactPerson,
                  ],  
                  [
                      'EntityAttributeID' => 'cargocontacto',
                      'EntityAttributeValue' => '', //no lo tenemos y no es necesario 
                  ],  
                  [
                      'EntityAttributeID' => 'cecontacto',
                      'EntityAttributeValue' => $model->email,
                  ],  
                  [
                      'EntityAttributeID' => 'telcontacto',
                      'EntityAttributeValue' => $model->tels,
                  ],  
                  [
                      'EntityAttributeID' => 'nohayhallazgo',
                      'EntityAttributeValue' => $nohayhallazgo,
                  ],  
                  [
                      'EntityAttributeID' => 'rjudicial',
                      'EntityAttributeValue' => $rjudicial,
                  ],  
                  [
                      'EntityAttributeID' => 'rsagrilaft',
                      'EntityAttributeValue' => $rsagrilaft,
                  ],  
                  [
                      'EntityAttributeID' => 'rfinanciero',
                      'EntityAttributeValue' => $rfinanciero,
                  ],  
                  [
                      'EntityAttributeID' => 'rreputacional',
                      'EntityAttributeValue' => $rreputacional,
                  ],  
                  [
                      'EntityAttributeID' => 'rlegal',
                      'EntityAttributeValue' => $rlegal,
                  ],  
                  [
                      'EntityAttributeID' => 'fechaiproceso',
                      'EntityAttributeValue' => date("Y-m-d", strtotime($backgroundCheck->studyStartedOn)), //$backgroundCheck->assignedOn
                  ],
                  [
                      'EntityAttributeID' => 'fhcargue',
                      'EntityAttributeValue' => strftime("%Y-%m-%d"), // fecha envío //$backgroundCheck->assignedOn
                  ],
                  ],
                  'RelationshipList'=>[
                      [
                          'RelationshipID' =>'rempresagrupo',
                          'RelationshipAttribute'=>[
                              'RelationshipAttributeID' => 'nmempresagrupo',
                              'RelationshipAttributeValue' => $model->customerField3,
                          ]
                      ],
                      [
                          'RelationshipID' => 'rtconsulta',
                          'RelationshipAttribute'=>[
                              'RelationshipAttributeID' => 'tconsulta',
                              'RelationshipAttributeValue' =>  $tipConsulta,
                          ]
                      ],
                      [
                          'RelationshipID' => 'rlcategoria',
                          'RelationshipAttribute'=>[
                              'RelationshipAttributeID' => 'categoria',
                              'RelationshipAttributeValue' => $model->customerField1,
                          ]
                      ],
                      [
                          'RelationshipID' => 'rtproceso',
                          'RelationshipAttribute'=>[
                              'RelationshipAttributeID' => 'tproceso',
                              'RelationshipAttributeValue' => $model->customerField4,
                          ]
                      ]
                  ]
                
              ]);
 
          $returndata=json_decode(json_encode($data),true);
          $Detalled=$returndata['Detail'];

          //enviar documento en pdf
          $pdfData = $backgroundCheck->getBackgroundCheckReport(Yii::app()->user->arUser->pdfPassword, 
          (Yii::app()->user->isAdmin || Yii::app()->user->IsRegisteredIP || Yii::app()->user->arUser->isInhouse || Yii::app()->user->getIsByRole()), Yii::app()->user->name, null, null, 50, true);

          //$pdfData=$this->decryptDocuments($code);

          //borrar el archivo
          //unlink;
          $year_start = strftime("%Y"); 
          $ident=$model->idNumber.'-'.$year_start.'.pdf';

          $documents = $client->newAttachment(
          [
              'WorkflowID' => $returnconet['RecordID'],
              'ActivityID' => "SAG01",
              'FileName' => $ident, 
              'FileContent' => $pdfData,
              'UserID'=> "",
              'AttachmentID'=> "",
              'AttachmentName'=> "",
              'Summary'=> "",
          ]);
    
          $returndocuments=json_decode(json_encode($documents),true);
          $detalle=$returndocuments['Detail'];    

          $ExecActivity = $client->executeActivity(
          [
              'WorkflowID' => $returnconet['RecordID'],
              'ActivityID' => "SAG01",
              'ActionSequence' =>1, 
              'UserID'=> "",
              'ActivityOrder'=>"",
          ]);
        
          $returnExecActivity=json_decode(json_encode($ExecActivity),true);
          $detalleexec=$returnExecActivity['Detail']; 

          WebUser::logAccess("Envío el estudio: ".$backgroundCheck->code." a GZF.");
          Yii::app()->user->setFlash('backgroundCheck', 'RESPUESTA GZF <br>'.$Detalled.'!!<br>'.$detalle.'!!<br>'.$detalleexec.'!!');
          
          $this->redirect(array('/backgroundCheck/update', 'code' => $code, 'pc' => $pc));
          
      }catch(Exception $e){
          //echo $e->getMessage("fallo el envío del documento");
          Yii::app()->user->setFlash('backgroundCheck', 'RESPUESTA GZF <br>'.$Detalled.'!!<br>No pudo adjuntar el documento del estudio y la actividad no pudo ser ejecutada!!');
          $this->redirect(array('/backgroundCheck/update', 'code' => $code, 'pc' => $pc));
      }
  }

    //proceso jeimy 
    //17/09/2021
    public function createTusDatosRegister($bgCheck){

        $criteria = new CDBCriteria();
        $criteria->compare('backgroundcheckId', $bgCheck->id);
        $models = TusDatosResponse::model()->findAll($criteria);

        if ($models != null && count($models)>0) {
            //echo 'models not null '.count($models);
            /*foreach($models as $tdRegister){

                //echo 'tus datos idNumber'. $tdRegister->idNumber;
                $tdRegister->idNumber = $bgCheck->idNumber;
                $tdRegister->dateexp = $bgCheck->datexpedition;
                $tdRegister->idReport = $bgCheck->idNumber;
                $tdRegister->modified = new CDbExpression('NOW()');
                $tdRegister->status =TusDatosResponse::STATUS_PENDING;
                $tdRegister->save(false);
                //echo 'after save tusDatos';
                //echo 'tus datos idNumber after'. $tdRegister->idNumber;

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

    //26-01-2022 Consumo servicio de formulario Dinamico desde el boton (Formulario Dinamico)
    //Natalia Henao M
    public function actionAnswersDynamicForm($code, $pc, $prt, $val){
        
		/*Yii::import('application.extensions.DynamicForm.*');

        $validSections=['basicInformation','Laboral','Referencias','Académico','documents', 'Socios y Representantes Legales','Clientes','Proveedores'];*/

        $backgroundCheck = BackgroundCheck::model()->findByCode($code);
        if($val==1){
            $ooid=$backgroundCheck->ooidFD;
        }else{
            $ooid=$backgroundCheck->reciptFileooid;
        }

        if($backgroundCheck->backgroundCheckStatusId!=BackgroundCheckStatus::REQUESTED && $backgroundCheck->backgroundCheckStatusId!=BackgroundCheckStatus::PROCESSING){
            Yii::app()->user->setFlash('backgroundCheck', 'Error, El estado del estudio no es solicitado.'); 
        }else if($ooid=="" || is_null($ooid)){
            Yii::app()->user->setFlash('backgroundCheck', 'Error, No se ha enviado un correo a la persona asociada a este estudio.'); 
        }else if($backgroundCheck->statusFD==1 && $val==1){
            Yii::app()->user->setFlash('backgroundCheck', 'Error, El formulario dinámico SP ya fue enviado a sintecto, por favor verifique la información.'); 
        }else if($backgroundCheck->reciptFileStatus==1 && $val==2){
            Yii::app()->user->setFlash('backgroundCheck', 'Error, El formulario dinámico Doc. ya fue enviado a sintecto, por favor verifique la información.'); 
        }else{

            WebUser::logAccess("Selecciono el boton [Traer datos Formulario Dinámico].", $backgroundCheck->code);

            $backgroundCheck->logDynamicFormAut($ooid, $val);
            $dateresponse=$backgroundCheck->answerDynamicForm($ooid, $prt, $val);

            $body = $this->renderPartial('/contact/_mailFinishDynamicForm', array(
                            'backgroundCheck' => $backgroundCheck,
                        ), true);

            if (Yii::app()->user->sendMailInBackground(
                "❗🚨 Notificación Formulario Dinámico – Número de estudio: [" . $backgroundCheck->code . "]❗🚨",
                $body,
                $backgroundCheck->mailsParamContact,
                [],
                [],
                []
            )) {
                WebUser::logAccess("Se envío a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "] un correo indicando el bloqueo del formulario dinámico", $backgroundCheck->code);
            }

            Yii::app()->user->setFlash('backgroundCheck', $dateresponse);

            /*if(!empty($dateresponse['error']) || empty($dateresponse['sections']) || !is_array($dateresponse['sections']) && $prt==0){
                Yii::app()->user->setFlash('backgroundCheck','Error, El Formulario Dinámico no ha sido envíado o no existe, para almacenar la información.');
            }*/
        }
        $this->redirect(array('/backgroundCheck/update', 'code' => $code, 'pc' => $pc));
    }

    public function actionExportAssingSection() {

        if(Yii::app()->user->getIsByRole()){
            $exportAssingSection = BackgroundCheck::getExportAssingSection();
            echo $this->renderPartial( '_csvAssingSectionMasive'
                    , array(
                'exportAssingSectionMasive' => $exportAssingSection,
            ));
        }else if (Yii::app()->user->isAdmin) {
            $exportAssingSection = BackgroundCheck::getExportAssingSection();
            echo $this->renderPartial( '_csvAssingSectionMasive'
                    , array(
                'exportAssingSectionMasive' => $exportAssingSection,
            ));
        }
    }

    public function actionExportNotAssingSection() {

        if(Yii::app()->user->getIsByRole()){
            $exportNotAssingSection = BackgroundCheck::getExportNotAssingSection();
            echo $this->renderPartial( '_csvNotAssingSectionMasive'
                    , array(
                'exportNotAssingSectionMasive' => $exportNotAssingSection,
            ));
        }else if (Yii::app()->user->isAdmin) {
            $exportNotAssingSection = BackgroundCheck::getExportNotAssingSection();
            echo $this->renderPartial( '_csvNotAssingSectionMasive'
                    , array(
                'exportNotAssingSectionMasive' => $exportNotAssingSection,
            ));
        }
    }

    public function actionAdmintoPiloto()
	{
        /* @var $model BackgroundCheck */
        $model = GridViewFilter::getFilter('BackgroundCheck', 'search');
        if (isset($_GET['BackgroundCheck']))
            $model->attributes = $_GET['BackgroundCheck'];

        $model->backgroundCheckStatusId = BackgroundCheckStatus::FINISHED;
        
        $this->render('adminPiloto', array(
            'model' => $model,
        ));
	}

    public function actionAdminPilot() {
        
        WebUser::logAccess("Genero datos clientes piloto por fechas.");
        
        $from = CHtml::encode($_GET['from']);
        $until=CHtml::encode($_GET['until']);

        $exportCustomerPilot= BackgroundCheck::getExportCustomerPilot($from, $until);
        
        echo $this->renderPartial('_csvCustomerPilot',array('from'=>$from, 'until'=>$until, 'exportCustomerPilot'=>$exportCustomerPilot));
    }

    public function actionDateRecover()
	{
		$model = GridViewFilter::getFilter('BackgroundCheck', 'searchRecover');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BackgroundCheck']))
			$model->attributes=$_GET['BackgroundCheck'];

            $model->resultId = 1;

		if (isset($_GET['_exportTocharge'])){
			set_time_limit(300);
			$this->renderPartial('_csvTochargeRecover', array(
				'model' => $model,
				//'withEvents' => true,
			));
		}
	}
}
//comment
