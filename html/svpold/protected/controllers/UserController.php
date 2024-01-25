<?php

class UserController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $defaultAction = 'myPendingReports';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

//    public function actionViewRest($id) {
//        $model = $this->loadModel($id);
//        if ($model) {
//            $ans = array('ind' => 'prueba', 'attr2' => 'hola', 'ar' => array('a1' => 'Val', 'a2' => 'Val2'));
//            //throw new CHttpException(201, CJSON::encode($ans));
//            header('HTTP/1.1 400 OK');
//            echo CJSON::encode($ans);
//        } else {
////            throw new CHttpException(404, 'The requested page does not exist.');
////            $this->sendResponse(200, sprintf('No items where found for model <b>%s</b>', $_GET['model']));
//        }
//        Yii::app()->end();
//    }
//
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {

            $model->attributes = $_POST['User'];
            $model->setPassword($model->clearPassword1);
            if (trim($model->otp) != "") {
                $model->setOtpKey($model->otp);
            }
            if ($model->save()) {
                $model->assingRoles($_POST['User']['roleIds']);
                WebUser::logAccess("Se creo el usuario : " . $model->username);
                Yii::app()->user->setFlash('notification', 'Se ha creado el usuario correctamente!');
                $this->redirect(array('view', 'id' => $model->id));
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
        if(Yii::app()->user->getIsByRole()){
            if(Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS)){
                
                $model = $this->loadModel($id);
                if ($model){

                    // Uncomment the following line if AJAX validation is needed
                    // $this->performAjaxValidation($model);

                    if (isset($_POST['User'])) {
                        $model->attributes = $_POST['User'];
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
                                WebUser::logAccess("Se cambio el usuario : " . $model->username.' a Rol: '.$model->userType->name);
                            if ($passwordChanged) {
                                Yii::app()->user->setFlash('notification', 'Se ha cambiado la clave del usuario!');
                                WebUser::logAccess("Cambio la clave de : " . $model->username);
                            }
                            if (trim($model->otp) != "") {
                                Yii::app()->user->setFlash('notification', 'Se ha cambiado la llave del usuario!');
                                WebUser::logAccess("Cambio la llave OTP de : " . $model->username);
                            }

                            $model->assingRoles($_POST['User']['roleIds']);

                            $model->signatureFile = CUploadedFile::getInstance($model, 'signatureFile');
                            if ($model->signatureFile != null) {
                                $file = new File();
                                $file->name = "Firma de " . $model->username;
                                $file->description = "Firma de " . $model->username;
                                $file->fileTypeId = FileType::SIGNATURE;
                                if ($file->save()) {
                                    $file->checkAbsoluteDir();
                                    $file->setUniqueFilename();
                                    $pathinfo = pathinfo($model->signatureFile->name);
                                    $file->extension = strtolower($pathinfo['extension']);
                                    $filename = $file->absolutePath;
                                    $model->signatureFile->saveAs($filename);
                                    $file->setSizeUncriptedFilename(User::SIGNATURE_WIDTH, User::SIGNATURE_HEIGHT);
                                    // Change to PNG file
                                    $file->extension = 'png';
                                    $file->size = filesize($filename);
                                    if ($file->save()) {
                                        $model->deleteSignature();
                                        $model->signatureId = $file->id;
                                        if ($model->save()) {
                                            Yii::app()->user->setFlash('Signature', "Se cargo la firma");
                                            WebUser::logAccess("Se agrego la firma de : " . $model->username);
                                        };
                                    }
                                    $file->cryptFile();
                                }
                            }

                            $this->redirect(array('view', 'id' => $model->id));
                        }
                    }

                    $this->render('update', array(
                        'model' => $model,
                    ));
                } else {
                    $this->redirect('/', array(
                        'model' => $model,
                    ));
                }
            }
        }else if (Yii::app()->user->isSuperAdmin) {

            $model = $this->loadModel($id);
            if ($model &&(Yii::app()->user->isManager || !Yii::app()->user->isInManagerList($model->username)) ){

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if (isset($_POST['User'])) {
                    $model->attributes = $_POST['User'];
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
                            WebUser::logAccess("Se cambio el usuario : " . $model->username.' a Rol: '.$model->userType->name);
                        if ($passwordChanged) {
                            Yii::app()->user->setFlash('notification', 'Se ha cambiado la clave del usuario!');
                            WebUser::logAccess("Cambio la clave de : " . $model->username);
                        }
                        if (trim($model->otp) != "") {
                            Yii::app()->user->setFlash('notification', 'Se ha cambiado la llave del usuario!');
                            WebUser::logAccess("Cambio la llave OTP de : " . $model->username);
                        }

                        $model->assingRoles($_POST['User']['roleIds']);

                        $model->signatureFile = CUploadedFile::getInstance($model, 'signatureFile');
                        if ($model->signatureFile != null) {
                            $file = new File();
                            $file->name = "Firma de " . $model->username;
                            $file->description = "Firma de " . $model->username;
                            $file->fileTypeId = FileType::SIGNATURE;
                            if ($file->save()) {
                                $file->checkAbsoluteDir();
                                $file->setUniqueFilename();
                                $pathinfo = pathinfo($model->signatureFile->name);
                                $file->extension = strtolower($pathinfo['extension']);
                                $filename = $file->absolutePath;
                                $model->signatureFile->saveAs($filename);
                                $file->setSizeUncriptedFilename(User::SIGNATURE_WIDTH, User::SIGNATURE_HEIGHT);
                                // Change to PNG file
                                $file->extension = 'png';
                                $file->size = filesize($filename);
                                if ($file->save()) {
                                    $model->deleteSignature();
                                    $model->signatureId = $file->id;
                                    if ($model->save()) {
                                        Yii::app()->user->setFlash('Signature', "Se cargo la firma");
                                        WebUser::logAccess("Se agrego la firma de : " . $model->username);
                                    };
                                }
                                $file->cryptFile();
                            }
                        }

                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }

                $this->render('update', array(
                    'model' => $model,
                ));
            } else {
                $this->redirect('/', array(
                    'model' => $model,
                ));
            }
        } else {
            $this->redirect('/', array(
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
        if ((Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) && Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
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
        $model = GridViewFilter::getFilter('User', 'search');
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

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
        if (Yii::app()->user->getIsByRole()) {
			return User::model()->findByPk($id);
		}else if (Yii::app()->user->isAdmin) {
            $model = User::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSignature($id) {
//TODO:secure the signature       
        if (Yii::app()->user->isSuperAdmin) {
            $model = User::model()->findByPk($id);


            if ($model) {
                header("Content-type: " . $model->signature->extension);
                echo $model->signatureImage;
            } else {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
        } else {

            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    public function actionDeleteSignature() {
        if (Yii::app()->user->isSuperAdmin && $_POST['id'] && $_POST['id'] > 0) {
            $id = (int) $_POST['id'];
            $model = User::model()->findByPk($id);
            if ($model) {
                $model->deleteSignature();
                $this->redirect(array('/user/update/', 'id' => $model->id));
            }
            $this->redirect('/user/admin/');
        } else {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
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
            $date1 = new \DateTime("first day of this Month");
            $fromDate=$date1->format('Y-m-d');

            $date2 = new \DateTime(" "); //'first day of this Month'
            $untilDate=$date2->format('Y-m-d');
        }
        return ['fromDate'=>$fromDate, 'untilDate'=>$untilDate, 'fechaActual'=>$FechaActual];
    }

    public function actionMyPendingReports() {

            if (Yii::app()->user->isValidUser) {
                $pendingAssigments = Yii::app()->user->arUser->getPendingAssigments();

            if(Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()){
                $pendingUrgents = Yii::app()->user->arUser->getPendingUrgents();
            }else{
                $pendingUrgents=null;
            }
           
//          $individualPendingReports = $this->getReportsByResponsible($pendingReports);

            $dates=$this->getDates();

            $idUser=Yii::app()->user->arUser->id;

            /*$this->render('myPendingReports', array(
                'pendingAssigments' => $pendingAssigments, 'pendingUrgents' => $pendingUrgents
            ));*/

            $productivityonTime=Yii::app()->user->arUser->getproductivityonTime($dates['fromDate'], $dates['untilDate'], $idUser);  
            $productivityOutofTime=Yii::app()->user->arUser->getproductivityOutofTime($dates['fromDate'], $dates['untilDate'], $idUser);
            $opportunityStudies=Yii::app()->user->arUser->getOpportunityStudies($dates['fromDate'], $dates['untilDate'], $idUser);
            $totalStudies=Yii::app()->user->arUser->getTotalStudies($dates['fromDate'], $dates['untilDate'], $idUser);  
            $qualityStudies=Yii::app()->user->arUser->getQualityStudies($dates['fromDate'], $dates['untilDate'], $idUser); 
            $qualityPorc=Yii::app()->user->arUser->getqualityPorc();
            $goaluser=Yii::app()->user->arUser->getgoalUser($idUser);

            $this->render('myPendingReports', array(
                'pendingAssigments' => $pendingAssigments, 'pendingUrgents' => $pendingUrgents, 'Desde' => $dates['fromDate'], 'Hasta' => $dates['untilDate'], 'productivityonTime'=>$productivityonTime, 'productivityOutofTime'=>$productivityOutofTime, 'opportunityStudies'=>$opportunityStudies, 'totalStudies'=>$totalStudies, 'qualityStudies'=>$qualityStudies, 'qualityPorc'=>$qualityPorc, 'goaluser'=>$goaluser
            ));

//            foreach ($individualPendingReports as $userId => $pendingReports) {
//                $date = new DateTime('now', timezone_open('America/Bogota'));
//                $user = User::model()->findByPk($userId);
//
//                $pendingReportsReport = $this->getPendingReportsBody($pendingReports, null, false, $user, $firstPage);
//                $firstPage = false;
//                if ($user) {
//                    echo $this->render(
//                            Yii::app()->basePath . '/views/backgroundCheckReport/pendingReportsPrint.php'
//                            , array(
//                        'body' => $pendingReportsReport,
//                            ), true);
//                }
//            }
        }
    }

    public function actionAutocompleteAllActiveUsers() {
        $request = trim($_GET['term']);
        if ($request != '') {
            $criteria = new CDbCriteria;
            $criteria->addCondition(
                    'username like :term1 '
                    . 'or firstName like :term2 '
                    . 'or lastName like :term3 '
            );
            $criteria->addCondition('isActive=1');
            $criteria->params = array(
                ':term1' => "%" . $request . "%",
                ':term2' => "%" . $request . "%",
                ':term3' => "%" . $request . "%",
            );


            $model = User::model()->findAll($criteria);
            $data = array();
            foreach ($model as $get) {
                $data[] = array(
                    'label' => "{$get->username} : {$get->name}" . ($get->city ? "[{$get->city}]" : ""),
                    'value' => $get->username);
            }
            $this->layout = 'empty';
            echo json_encode($data);
        }
    }

    public function actionSendTestMail($id) {
        $user = $this->loadModel($id);
        if ($user && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())) {
            $date = new DateTime();
            Yii::app()->user->sendMailInBackground(
                    'Correo de Prueba (' . $date->format('Y-m-d H:i:s') . ')', //
                    'Este es un correo de prueba enviado desde el sistema.', //
                    array($user->mailParam, Yii::app()->user->arUser->mailParam, ) //
            );
        }
        echo json_encode(null);
    }

    public function actionDetailresultquality(){
        
        $id = CHtml::encode($_POST['id']);
        $from= CHtml::encode($_POST['from']);
        $until= CHtml::encode($_POST['until']);

        $idUser=Yii::app()->user->arUser->id;
        //$customerUs = Yii::app()->user->arUser;
        $detalleResultQuality =Yii::app()->user->arUser->getQualityResult($from, $until, $idUser, $id);

        header('Content-type: application/json');
        echo CJSON::encode($detalleResultQuality);    
        Yii::app()->end();
    }

     /**
    * Manages all models.
    */
    public function actionAdminSenior() {
        $model = GridViewFilter::getFilter('User', 'searchSenior'); 
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        //$date = $model->dateFrom; 
        //$d = DateTime::createFromFormat('Y-m-d H:i:s', $date); 
        //if ($d && $d->format('Y-m-d H:i:s') == $date) { 
            if ($model->dateFrom=="") {
                $date1 = new \DateTime("first day of this Month");
                $model->dateFrom=$date1->format('Y-m-d H:i:s');
            } else {
                $model->dateFrom = (new \DateTime(CHtml::encode($model->dateFrom)))->format('Y-m-d H:i:s');
            }
        /*} 
        else { 
            echo "fecha invalida";
        }*/

        //$date2 = $model->dateUntil; 
        //$d2 = DateTime::createFromFormat('Y-m-d H:i:s', $date2); 
        //if ($d2 && $d2->format('Y-m-d H:i:s') == $date2) { 
            if ($model->dateUntil=="") {
                $date2 = new \DateTime(" "); //'first day of this Month'
                $model->dateUntil=$date2->format('Y-m-d H:i:s');
            } else {
                $model->dateUntil = (new \DateTime(CHtml::encode($model->dateUntil)))->format('Y-m-d H:i:s');
            }
        /*} 
        else { 
            echo "fecha invalida";
        }*/

        $this->render('adminSenior', array(
            'model' => $model,
            'from'=>$model->dateFrom,
            'until'=>$model->dateUntil,
        ));
    }

    public function actionUpdateSenior($idAnalist)
	{
		$model=$this->loadModel($idAnalist);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->modified= new CDbExpression('NOW()');
            //$model->userSeniorId= $model->userSeniorId;
			if($model->save())
				WebUser::logAccess("Se modifico el usuario senior al analista: " . $model->username);
				Yii::app()->user->setFlash('notification', 'Se ha modificado el usuario correctamente!');
                $this->redirect(array("user/adminSenior"));
		}

		$this->render('update',array(
			'model'=>$model,
            'usrSenior'=>1,
		));
	}

    public function actionAssignSeniorAnalyst()
    {
        $ans = array('error' => '', 'ans' => '');

        if (
            (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) &&
            isset($_POST['seniorAssignment']) &&
            isset($_POST['seniorAssignment']['usernameSenior'])
        ) {

            $user=User::model()->findByAttributes(array('username' => $_POST['seniorAssignment']['usernameSenior']));
          
            $SeniorAssing = array();
            $selectedseniorIdArray = explode(',', $_POST['seniorAssignment']['selectedId']);
				foreach ($selectedseniorIdArray as $idanalyst) {
					$SeniorAssing = User::model()->findByAttributes(array('id' => $idanalyst));
					if($user ){
						$SeniorAssing->userSeniorId = $user->id;
						$SeniorAssing->modified = new CDbExpression('NOW()');
						$SeniorAssing->save();
					}
					$assignedSeniorAnalyst[] = $idanalyst;
				}

				$ans['ans'] = 'Se asignaron los analistas con ID: ' . implode(',', $assignedSeniorAnalyst) . ' a el senior: ' . $user->username;
		}else {
            $ans['error'] = 'No se hizo la asignación, por favor complete los parámetros';
        }

        echo CJavaScript::jsonEncode($ans);
        Yii::app()->end();
    }

    public function actionAutocompleteUserSeniorAsing() {
		$request = trim($_GET['term']);
        if ($request != '') {
            $criteria = new CDbCriteria;
            $criteria->addCondition(
                    'username like :term1 '
                    . 'or firstName like :term2 '
                    . 'or lastName like :term3 '
            );
            $criteria->addCondition('isActive=1 AND userSeniorType=1');
            $criteria->params = array(
                ':term1' => "%" . $request . "%",
                ':term2' => "%" . $request . "%",
                ':term3' => "%" . $request . "%",
            );


            $model = User::model()->findAll($criteria);
            $data = array();
            foreach ($model as $get) {
                $data[] = array(
                    'label' => "{$get->username} : {$get->name}" . ($get->city ? "[{$get->city}]" : ""),
                    'value' => $get->username,
					'id' => $get->id
				);
            }
            $this->layout = 'empty';
            echo json_encode($data);
        }
    }

    public function actionAssignSeniorExport() {
        
        WebUser::logAccess("Genero indicadores senior por fechas.");
        
        //$from = CHtml::encode($_POST['from']);
        //$until = CHtml::encode($_POST['until']);
        
        $from = CHtml::encode($_GET['from']);
        $until=CHtml::encode($_GET['until']);

        //$detailAnalystSenior =Yii::app()->user->arUser->getProcessSeniorExport($from, $until);

        echo $this->renderPartial('_exportIndSenior',array('from'=>$from, 'until'=>$until));
    }

}
// var_dump( Yii::app()->user->arUser->mailParam);

/*
Agregar usuarios de Prueba
array ("mail" => "pereirawe@gmail.com", "name" => "William Enrique Pereira"),

*/
//comment