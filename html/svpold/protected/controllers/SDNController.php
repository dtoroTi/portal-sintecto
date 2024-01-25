<?php

class SDNController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionQuery() {
        $query = new SDNSearchForm;
        $sdnVersions = SDN_Version::model()->findAll();

        if (count($sdnVersions) == 0) {
            $query->addError('', 'La base de datos esta bloqueada por actualización,  por favor intente más tarde.');
            $isActive = false;
        } else {
            $isActive = true;
        }
        foreach ($sdnVersions as $sdnVersion) {
            if (!$sdnVersion->isActive) {
                $query->addError('', 'La base de datos esta bloqueada por actualización,  por favor intente más tarde.');
                $isActive = false;
            }
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SDNSearchForm']) && $isActive) {
            // Search
            $query->attributes = $_POST['SDNSearchForm'];

            if ($query->validate()) {
                $error = false;
                $queries = array();

                $query->uploadedFile = CUploadedFile::getInstance($query, 'uploadedFile');
                if (isset($query->uploadedFile)) {
                    $baseName = basename($query->uploadedFile->name);
                    $fileName = Yii::app()->basePath . "/runtime/" . uniqid("uploaded_", true) . $baseName;
                    if (!$query->uploadedFile->saveAs($fileName)) {
                        $query->addError('uploadedFile', 'No se pudo cargar el archivo.');
                        $error = true;
                    }else if(mime_content_type($fileName)!="text/plain"){ 
                        $query->addError('uploadedFile', 'No se pudo cargar el archivo, su contenido no es valido.');
                        $error = true;
                    } else {

                        $file = fopen($fileName, "r");
                        if ($file) {
                            $lastRecord = false;
                            $numRecords = 0;

                            while (($row = fgets($file)) && !$error) {
                                $numRecords++;
                                if ($numRecords % 20 == 0) {
//                                    echo "{$numRecords}:".  memory_get_usage()."<br/>";
//                                    flush();
                                }

                                $sdnSearch = explode("\t", $row);

                                if (count($sdnSearch) == 1 && !$lastRecord) {
                                    // last Record
                                    $lastRecord = true;
                                } else if (count($sdnSearch) >= 1 && count($sdnSearch) <= 3) {
                                    if (strlen(trim($sdnSearch[0])) > 0 ||
                                            (count($sdnSearch) >= 2 && strlen(trim($sdnSearch[1])) > 0 ) ||
                                            (count($sdnSearch) == 3 && strlen(trim($sdnSearch[2])) > 0 )) {
                                        $rowQuery = new SDNSearchForm();
                                        if (count($sdnSearch) >= 1 && count(trim($sdnSearch[0])) > 0) {
                                            $rowQuery->lastname = trim($sdnSearch[0]);
                                        }
                                        if (count($sdnSearch) >= 2 && count(trim($sdnSearch[1])) > 0) {
                                            $rowQuery->firstname = trim($sdnSearch[1]);
                                        }
                                        if (count($sdnSearch) >= 3 && count(trim($sdnSearch[2])) > 0) {
                                            $rowQuery->remarks = trim($sdnSearch[2]);
                                        }

                                        unset($records);
                                        $records = SDN::searchRecord(
                                                        $rowQuery->firstname, $rowQuery->lastname, $rowQuery->remarks, $query->doNotIncludePrepositions, $query->oneFirstnameOneLastname, $query->allLastnames,$query->sdnTypeId);

                                        if (isset($paterns))
                                            unset($paterns);
                                        $patterns = array();
                                        if (count($records) > 0) {
                                            foreach ($records['matches'] as $match) {
                                                $patterns[] = $match;
                                            }
                                        }
                                        $verifiedRecords=SDN::getverifiedRecords($records);
                                        $queries[] = array(
                                            'records' => $records['rows'],
                                            'patterns' => $patterns,
                                            'query' => $rowQuery,
                                            'verifiedRecords' => $verifiedRecords,
                                        );
                                    }
                                } else {
                                    $query->addError('uploadedFile', 'Hay un registro muy grande [' . $row . ']');
                                    $error = true;
                                }
                            }

                            fclose($file);
                            unlink($fileName);
                        }
                    }
                } else {
                    $records = array('rows' => array(), 'matches' => array());
                    $patterns = array();

                    if ($query->firstname != '' || $query->lastname != '' || $query->remarks != '') {
                        $records = SDN::searchRecord(
                                        $query->firstname, $query->lastname, $query->remarks, $query->doNotIncludePrepositions, $query->oneFirstnameOneLastname, $query->allLastnames,$query->sdnTypeId);

                        foreach ($records['matches'] as $match) {
                            $patterns[] = $match;
                        }
                    }
                    $verifiedRecords=SDN::getverifiedRecords($records);
                    $queries[] = array(
                        'records' => $records['rows'],
                        'patterns' => $patterns,
                        'query' => $query,
                        'verifiedRecords' => $verifiedRecords,
                    );
                }
                if (!$error) {
                    $this->render('queryAnswer', array(
                        'queries' => $queries,
                        'sdnVersions' => $sdnVersions,
                        'query' => $query,
                        'isActive' => $isActive,
                    ));
                    return;
                }
            }
        }

        $this->render('query', array(
            'query' => $query,
            'sdnVersions' => $sdnVersions,
            'isActive' => $isActive,
        ));
    }

    //Creada por Jonathan Listas Peps
    public function actionUpdatePepsSdn() {
        $docForm = new DocForm;

        if (isset($_POST['uploadButton']) && $docForm->validate()) {
            $transaction = Yii::app()->db->beginTransaction();

            $docForm->doc = CUploadedFile::getInstance($docForm, 'doc2');
            if (isset($docForm->doc)) {
                $fileName = "";
                $baseName = basename($docForm->doc->name);
                $fileName = Yii::app()->getRuntimePath() . "/" . uniqid("_", true) . $baseName;
                $docForm->doc->saveAs($fileName);

                SDN::model()->deleteAllByAttributes(array('sdnTypeId' => SdnType::PEPS));
                $file = fopen($fileName, "r");
                if (!$file) {
                    Yii::app()->user->setFlash('error', "No se Pudo abrir el archivo {$fileName}.");
                    $error = true;
                }
                $lastRecord = false;
                $numRecords = 0;
                $error = false;
                while (($row = fgets($file)) && !$error) {
                    $numRecords++;
                    $row = str_replace("\"", "", $row);
                    $sdnData = explode(";", $row);

                    if (count($sdnData) == 1 && !$lastRecord) {
                        // last Record
                        $lastRecord = true;
                    } else if (count($sdnData) == 12) {
                        $sdn = new SDN;
                        $sdn->sdnTypeId = SdnType::PEPS;
                        $sdn->entNum = $sdnData[0];
                        $sdn->SDNName = $sdnData[1];
                        $sdn->SDNType = $sdnData[2];
                        $sdn->program = $sdnData[3];
                        $sdn->title = $sdnData[4];
                        $sdn->callSign = $sdnData[5];
                        $sdn->vessType = $sdnData[6];
                        $sdn->tonnage = $sdnData[7];
                        $sdn->GRT = $sdnData[8];
                        $sdn->vessFlag = $sdnData[9];
                        $sdn->vessOwner = $sdnData[10];
                        $sdn->remarks = $sdnData[11];

                        if (!$sdn->save()) {
                            Yii::app()->user->setFlash('error', 'Error importando: ' . $row);
                            $error = true;
                        }
                    } else {
                        Yii::app()->user->setFlash('error', "No se Pudo importar el archivo orige de Listas Peps. Hay un registro inconsistente [{$numRecords}]:[{$row}].");
                        $error = true;
                    }
                }
                fclose($file);
                if ($fileName != "" && file_exists($fileName)) {
                    unlink($fileName);
                }
            } else {
                Yii::app()->user->setFlash('error', "Error en la copia del archivo de Listas Peps.");
                $error=true;
            }
            if (!$error) {
                SDN_Version::model()->deleteAllByAttributes(array('sdnTypeId' => SdnType::PEPS));
                $sdnVersion = new SDN_Version;
                $sdnVersion->sdnTypeId = SdnType::PEPS;
                $sdnVersion->numRecords = $numRecords;
                $sdnVersion->downloaded = new CDbExpression('NOW()');
                $sdnVersion->isActive = true;
                if ($sdnVersion->save()) {
                    $transaction->commit();
                    Yii::app()->user->setFlash('notification', "Se actualizo la bases datos");
                } else {
                    Yii::app()->user->setFlash('error', serialize($sdnVersion->errors));
//          Yii::app()->user->setFlash('error', "No se Pudo actualizar la base de datos [{$numRecords}]:[{$row}].");
                    $error = true;
                    $transaction->rollBack();
                }
            } else {
                $transaction->rollBack();
            }
        }

        $sdnVersion = SDN_Version::model()->findByAttributes(array('sdnTypeId' => SdnType::PEPS));
        $this->render('updatePeps', array(
            'sdnVersion' => $sdnVersion,
            'docForm' => $docForm,
        ));
    }

    //Creada por Jonathan Listas Peps
    public function actionUpdateOfacSdn() {
        $docForm = new DocForm;

        if (isset($_POST['uploadButton']) && $docForm->validate()) {
            $transaction = Yii::app()->db->beginTransaction();

            $docForm->doc = CUploadedFile::getInstance($docForm, 'doc');
            if (isset($docForm->doc)) {
                $fileName = "";
                $baseName = basename($docForm->doc->name);
                $fileName = Yii::app()->getRuntimePath() . "/" . uniqid("_", true) . $baseName;
                $docForm->doc->saveAs($fileName);

                SDN::model()->deleteAllByAttributes(array('sdnTypeId' => SdnType::OFAC));
                $file = fopen($fileName, "r");
                if (!$file) {
                    Yii::app()->user->setFlash('error', "No se Pudo abrir el archivo {$fileName}.");
                    $error = true;
                }
                $lastRecord = false;
                $numRecords = 0;
                $error = false;
                while (($row = fgets($file)) && !$error) {
                    $numRecords++;
                    $row = str_replace("\"", "", $row);
                    $sdnData = explode("|", $row);

                    if (count($sdnData) == 1 && !$lastRecord) {
                        // last Record
                        $lastRecord = true;
                    } else if (count($sdnData) == 12) {
                        $sdn = new SDN;
                        $sdn->sdnTypeId = SdnType::OFAC;
                        $sdn->entNum = $sdnData[0];
                        $sdn->SDNName = $sdnData[1];
                        $sdn->SDNType = $sdnData[2];
                        $sdn->program = $sdnData[3];
                        $sdn->title = $sdnData[4];
                        $sdn->callSign = $sdnData[5];
                        $sdn->vessType = $sdnData[6];
                        $sdn->tonnage = $sdnData[7];
                        $sdn->GRT = $sdnData[8];
                        $sdn->vessFlag = $sdnData[9];
                        $sdn->vessOwner = $sdnData[10];
                        $sdn->remarks = $sdnData[11];

                        if (!$sdn->save()) {
                            Yii::app()->user->setFlash('error', 'Error importando: ' . $row);
                            $error = true;
                        }
                    } else {
                        Yii::app()->user->setFlash('error', "No se Pudo importar el archivo orige de OFAC. Hay un registro inconsistente [{$numRecords}]:[{$row}].");
                        $error = true;
                    }
                }
                fclose($file);
                if ($fileName != "" && file_exists($fileName)) {
                    unlink($fileName);
                }
            } else {
                Yii::app()->user->setFlash('error', "Error en la copia del archivo de OFAC.");
                $error=true;
            }
            if (!$error) {
                SDN_Version::model()->deleteAllByAttributes(array('sdnTypeId' => SdnType::OFAC));
                $sdnVersion = new SDN_Version;
                $sdnVersion->sdnTypeId = SdnType::OFAC;
                $sdnVersion->numRecords = $numRecords;
                $sdnVersion->downloaded = new CDbExpression('NOW()');
                $sdnVersion->isActive = true;
                if ($sdnVersion->save()) {
                    $transaction->commit();
                    Yii::app()->user->setFlash('notification', "Se actualizo la bases datos");
                } else {
                    Yii::app()->user->setFlash('error', serialize($sdnVersion->errors));
//          Yii::app()->user->setFlash('error', "No se Pudo actualizar la base de datos [{$numRecords}]:[{$row}].");
                    $error = true;
                    $transaction->rollBack();
                }
            } else {
                $transaction->rollBack();
            }
        }

        $sdnVersion = SDN_Version::model()->findByAttributes(array('sdnTypeId' => SdnType::OFAC));
        $this->render('updateOfac', array(
            'sdnVersion' => $sdnVersion,
            'docForm' => $docForm,
        ));
    }

    public function actionUpdateUn() {
        $docForm = new DocForm;

        if (isset($_POST['uploadButton'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $xmlData = simplexml_load_file(SdnType::UN_LIST_URL);

            if ($xmlData) {

                SDN_Version::model()->deleteAllByAttributes(array('sdnTypeId' => SdnType::UN_LIST));
                SDN::model()->deleteAllByAttributes(array('sdnTypeId' => SdnType::UN_LIST));
                $lastRecord = false;
                $numRecords = 0;
                $error = false;
                if (!$xmlData) {
                    Yii::app()->user->setFlash('error', "No se Pudo abrir el archivo {$fileName}.");
                    $error = true;
                } else {
                    foreach ($xmlData->INDIVIDUALS->INDIVIDUAL as $individual) {
                        $numRecords++;
                        $this->addUnIndividual($individual);
                    }
                    foreach ($xmlData->ENTITIES->ENTITY as $entity) {
                        $numRecords++;
                        $this->addUnEntity($entity);
                    }
                }
            } else {
                Yii::app()->user->setFlash('error', "Error en la copia del archivo de Naciones Unidas.");
            }
            if (!$error) {
                $sdnVersion = new SDN_Version;
                $sdnVersion->sdnTypeId = SdnType::UN_LIST;
                $sdnVersion->numRecords = $numRecords;
                $sdnVersion->downloaded = new CDbExpression('NOW()');
                $sdnVersion->isActive = true;
                $sdnVersion->isActive = true;
                if ($sdnVersion->save()) {
                    $transaction->commit();
                    Yii::app()->user->setFlash('notification', "Se actualizo la bases datos");
                } else {
                    Yii::app()->user->setFlash('error', serialize($sdnVersion->errors));
//          Yii::app()->user->setFlash('error', "No se Pudo actualizar la base de datos [{$numRecords}]:[{$row}].");
                    $error = true;
                    $transaction->rollBack();
                }
            } else {
                $transaction->rollBack();
            }
        }

        $sdnVersion = SDN_Version::model()->findByAttributes(array('sdnTypeId' => SdnType::UN_LIST));
        $this->render('updateUn', array(
            'sdnVersion' => $sdnVersion,
            'docForm' => $docForm,
        ));
    }

    private function addUnIndividual($individual) {

        $sdn = new SDN;
        $sdn->sdnTypeId = SdnType::UN_LIST;
        $sdn->callSign = '';
        $sdn->vessType = '';
        $sdn->tonnage = '';
        $sdn->GRT = '';
        $sdn->vessFlag = '';
        $sdn->vessOwner = '';
        $sdn->entNum = $individual->DATAID;
        $sdn->SDNName = trim($individual->FIRST_NAME);
        if ($individual->SECOND_NAME && strtolower($individual->SECOND_NAME) != 'n/a') {
            $sdn->SDNName .=' ' . trim($individual->SECOND_NAME);
        }
        if ($individual->THIRD_NAME && strtolower($individual->THIRD_NAME) != 'n/a') {
            $sdn->SDNName .=' ' . trim($individual->THIRD_NAME);
        }
        if ($individual->FOURTH_NAME && strtolower($individual->FOURTH_NAME) != 'n/a') {
            $sdn->SDNName .=' ' . trim($individual->FOURTH_NAME);
        }
        $sdn->SDNType = 'individual';
        $sdn->program = $individual->UN_LIST_TYPE;
        if ($individual->TITLE->VALUE) {
            $ans = array();
            foreach ($individual->TITLE->VALUE as $title) {
                $ans[] = (string) $title;
            }
            $sdn->title = implode(", ", $ans);
        } else {
            $sdn->title = '';
        }
        $remarks = array();
        if ($individual->INDIVIDUAL_ALIAS) {
            foreach ($individual->INDIVIDUAL_ALIAS as $alias) {
                $remarks[] = "a.k.a. '" . (string) $alias->ALIAS_NAME."'";
            }
        }
        if ($individual->INDIVIDUAL_DATE_OF_BIRTH->DATE) {
            $remarks[] = 'DOB ' . (string) $individual->INDIVIDUAL_DATE_OF_BIRTH->DATE;
        }
        if ($individual->INDIVIDUAL_PLACE_OF_BIRTH) {
            $remarks[] = 'POB ' . (string) $individual->INDIVIDUAL_PLACE_OF_BIRTH->CITY . " " . $individual->INDIVIDUAL_PLACE_OF_BIRTH->COUNTRY;
        }

        if ($individual->INDIVIDUAL_DOCUMENT) {
            $documentArr = array();
            foreach ($individual->INDIVIDUAL_DOCUMENT as $individualDoc) {
                $documentArr[] = trim(strtoupper((string) $individualDoc->TYPE_OF_DOCUMENT));
                $documentArr[] = trim((string) $individualDoc->NUMBER);
                if ($individualDoc->CITY_OF_ISSUE) {
                    $documentArr[] = 'CITY:' . trim((string) $individualDoc->CITY_OF_ISSUE);
                }
                if ($individualDoc->COUNTRY_OF_ISSUE) {
                    $documentArr[] = 'COUNTRY:' . trim((string) $individualDoc->COUNTRY_OF_ISSUE);
                }
                $remarks[] = 'DOCUMENT: ' . implode(' ', $documentArr);
            }
        }
        $sdn->remarks = implode(", ", $remarks) . '.';
        if (!$sdn->save()) {
            Yii::app()->user->setFlash('error', 'Error importando: ' . $individual->asXml());
            Yii::app()->user->setFlash('error', 'Error : ' . serialize($sdn->errors));
            exit;
        }
    }

    private function addUnEntity($entity) {
        $sdn = new SDN;
        $sdn->sdnTypeId = SdnType::UN_LIST;
        $sdn->callSign = '';
        $sdn->vessType = '';
        $sdn->tonnage = '';
        $sdn->GRT = '';
        $sdn->vessFlag = '';
        $sdn->vessOwner = '';
        $sdn->title = '';
        $sdn->entNum = $entity->DATAID;
        $sdn->SDNName = trim($entity->FIRST_NAME);
        $sdn->SDNType = 'entity';
        $sdn->program = $entity->UN_LIST_TYPE;
        $remarks = array();
        if ($entity->ENTITY_ALIAS) {
            foreach ($entity->ENTITY_ALIAS as $alias) {
                $remarks[] = 'A.K.A. ' . (string) $alias->ALIAS_NAME;
            }
        }
        $sdn->remarks = implode(", ", $remarks) . '.';
        if (!$sdn->save()) {
            Yii::app()->user->setFlash('error', 'Error importando: ' . $entity->asXml());
            Yii::app()->user->setFlash('error', 'Error : ' . serialize($sdn->errors));
            exit;
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new SDN('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SDN']))
            $model->attributes = $_GET['SDN'];

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
        $model = SDN::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sdn-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    //Proceso Consultas OFAC
    //Natalia Henao M 02/12/2021
    public function actionInsertRegOFAC(){

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $hashR=CHtml::encode($_POST['hashrecord']);
            $hashP=CHtml::encode($_POST['hashperson']);
            $verifiedRecord = VerifiedRecords::model()->findByAttributes(['hashrecord'=>$hashR, 'hashperson'=>$hashP]);

            if ($verifiedRecord) {
            }else{
                $user=Yii::app()->user->arUser->name;
            
                $dateReg = new \DateTime(" "); //'first day of this Month'
                $FechaReg=$dateReg->format('Y-m-d H:i:s');
    
                $data="INSERT INTO ses_VerifiedRecords (hashrecord, hashperson, user, fecha_reg)
                VALUES ('".$hashR."', '".$hashP."', '".$user."', '".$FechaReg."')";
                $query = Yii::app()->db->createCommand($data)->execute(); 
    
                WebUser::logAccess("Ingreso el registro del Hash en la tabla VerifiedRecords para OFAC.");
            }

        }
    }

    public function actionDeleteRegOFAC(){

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            $hashR=CHtml::encode($_POST['hashrecordd']);
            $verifiedRecord = VerifiedRecords::model()->findByAttributes(['hashrecord'=>$hashR]);
            $verifiedRecord->delete();

            WebUser::logAccess("Elimino el registro del Hash en la tabla VerifiedRecords para OFAC.");
        }
    }

    public function actionSendResult(){

        foreach ($_POST['recordsResult'] as $records) {

            $hashP=$records['hashP'];
            $hashR=$records['hashR'];
            
            if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
                $verifiedRecord = VerifiedRecords::model()->findByAttributes(['hashrecord'=>$hashR, 'hashperson'=>$hashP]);

                if ($verifiedRecord) {
                    
                }else{

                    $user=Yii::app()->user->arUser->name;
                
                    $dateReg = new \DateTime(" "); //'first day of this Month'
                    $FechaReg=$dateReg->format('Y-m-d H:i:s');
        
                    $data="INSERT INTO ses_VerifiedRecords (hashrecord, hashperson, user, fecha_reg)
                    VALUES ('".$hashR."', '".$hashP."', '".$user."', '".$FechaReg."')";
                    $query = Yii::app()->db->createCommand($data)->execute(); 
                }
               
            }
        }
        WebUser::logAccess("Ingreso el registro del Hash en la tabla VerifiedRecords para OFAC.");
    }

}
