<?php

class ContactController extends Controller
{

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }


    public function actionCreate()
    {

        $model = new Contact;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Contact'])) {
            $model->attributes = $_POST['Contact'];
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
    public function actionUpdate($code, $pc)
    {

        //$user = User::model()->findByPk(Yii::app()->user->getId());
        if (isset($_POST['contacts'])) {
            $backgroundCheck = BackgroundCheck::model()->findByCode($code);
            WebUser::logAccess("Actualizo los contactos ", $backgroundCheck->code);

            foreach ($_POST['contacts'] as $key => $comments) {
                if ($key == 'new') {
                    if (trim($comments['comments']) != "") {
                        $contact = new contact;
                        $contact->attributes = $comments;
                        $contact->modified = date('Y-m-d H:i:s', time());
                        $contact->backgroundCheckId = $backgroundCheck->id;
                        $contact->createdById = Yii::app()->user->id;

                        if (!$contact->save()) {
                            Yii::app()->user->setFlash('contacts', "Error Saving [{$key}] :" . serialize($contact->errors));
                        }
                    }
                } else {
                    $contact = $this->loadModel($key);
                    if ($contact) {
                        $contact->attributes = $comments;
                        $contact->modified = date('Y-m-d H:i:s', time());
                        //WebUser::logAccess("Se Registro un comentario en la opción contacto: " . CHtml::encode($contact->comments), $backgroundCheck->code);
                        if (!$contact->save()) {
                            Yii::app()->user->setFlash('contacts', "Error Saving new records[{$key}] :" . serialize($contact->errors));
                        }
                    }
                }
            }
            $url = $this->createUrl('/backgroundCheck/update/', array('code' => $code, 'activeTab' => 'contacts', 'pc' => $pc));
            $this->redirect($url, true);
        }
    }

    public function actionContactCustomer($id, $pc)
    {
        
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            $backgroundCheck = BackgroundCheck::model()->findByPK($id);
            if ($backgroundCheck) {
                $value = $backgroundCheck->customerProduct->attachmentFileId;
                $dateContact=Contact::getCountContactType($id);
                
                foreach ($dateContact as $Key=>$countC) {
                    if($countC['Type']=="Correo" && $countC['statusContact']=="Enviado"){
                        $allmail=$countC['consultas'];
                    }
                }

                if(isset($allmail)){
                }else{
                    $allmail=0;
                }

                if ($allmail>=3) {
                    Yii::app()->user->setFlash('datelimit', "El máximo de 3 envíos fue superado, No puede enviar más correos al candidato.");
                }else if (!$value || $value == null) {
                    Yii::app()->user->setFlash('error', "Debe Asociar un Archivo al producto del Cliente, para enviar el correo electrónico.");
                }else if($backgroundCheck->statusFD==1){
                    Yii::app()->user->setFlash('datelimit', "No se envia correo al candidato, porque el formulario dinámico ya fue enviado a sintecto, por favor verifique la información."); 
                } else {
                    Contact::idDinamicForm($backgroundCheck);

                    $filename = $backgroundCheck->customerProduct->attachmentFile->getAbsulotePath($value);

                    $i=0;
		            foreach ($filename as $archivos) {

                        if($filename[$i]){
                            $path = $backgroundCheck->customerProduct->attachmentFile->getFullPath($filename[$i]);
                            $data = file_get_contents($path);
                            $base64 = base64_encode($data);
               
                            $fileArray[] = array('fileName' => $filename[$i], 
                                        'baseName' => $filename[$i],
                                        'base64' => $base64
                                );
                        }
                      
                    $i++;
                    }
                    if($backgroundCheck->customer->businessLine=="Integridad"){
                        $body = $this->renderPartial('_mailNewForContacto', array(
                            'backgroundCheck' => $backgroundCheck,
                        ), true);
                    }else if($backgroundCheck->customer->businessLine=="Ev.Terceros"){
                        $body = $this->renderPartial('_mailNewForContactCompany', array(
                            'backgroundCheck' => $backgroundCheck,
                        ), true);
                    }
                    

                    if (Yii::app()->user->sendMailInBackground(
                        "❗⏰ Solicitud Documentos – Número de estudio: [" . $backgroundCheck->code . "]❗⏰",
                        $body,
                        $backgroundCheck->mailsParamContact,
                        [],
                        [],
                        $fileArray
                    )) {
                        $contact = Contact::insertContactMail($id);
                        WebUser::logAccess("Se envío a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "] un correo con documentos adjuntos.", $backgroundCheck->code);
                    }
                }
                $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'contacts', 'pc' => $pc));
                $this->redirect($url, true);
            }
        }
    }
    //Funcion para enviar correo a visitadores
   public function actionContactCustomerVisit($id, $pc)
   {
       
       if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
           $backgroundCheck = BackgroundCheck::model()->findByPK($id);
           $assignedUser= AssignedUser::model()->findByAttributes(['backgroundCheckId'=>$id,'userRoleId'=>'3']);
           $usermailchi= User::model()->findByAttributes(['id'=>$assignedUser->userId]);
           if ($backgroundCheck) {
               $value = $backgroundCheck->customerProduct->attachmentFileId;           

               if(isset($allmail)){
               }else{
                   $allmail=0;
               }
             
               if (!$value || $value == null) {
                   Yii::app()->user->setFlash('error', "Debe Asociar un Archivo al producto del Cliente, para enviar el correo electrónico.");
               }else {                

                   $filename = $backgroundCheck->customerProduct->attachmentFile->getAbsulotePath($value);

                   $i=0;
                   foreach ($filename as $archivos) {

                       if($filename[$i]){
                           $path = $backgroundCheck->customerProduct->attachmentFile->getFullPath($filename[$i]);
                           $data = file_get_contents($path);
                           $base64 = base64_encode($data);
              
                           $fileArray[] = array('fileName' => $filename[$i], 
                                       'baseName' => $filename[$i],
                                       'base64' => $base64
                               );
                       }
                     
                   $i++;
                   }
                   $body = $this->renderPartial('_mailNewForVisit', array(
                           'backgroundCheck' => $backgroundCheck,
                       ), true);                      

                   if (Yii::app()->user->sendMailInBackground(
                       "❗⏰ Formatos Visita - [" . $backgroundCheck->code . "]❗⏰",
                       $body,
                       array(array("mail" => $usermailchi->username, "name" => $usermailchi->firstName)),
                       [],
                       [],
                       $fileArray
                   )) {
                      
                       WebUser::logAccess("Se envío a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "] un correo con documentos adjuntos.", $backgroundCheck->code);
                   }
               }
               $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'contacts', 'pc' => $pc));
               $this->redirect($url, true);
           }
       }
   }


    public function actionSendTextMessage($id, $pc)
    {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            $backgroundCheck = BackgroundCheck::model()->findByPK($id);
            
            if ($backgroundCheck) {
                WebUser::logAccess("Se genero petición de envío mensaje de texto en aldeamo para el estudio No:" . $backgroundCheck->code, $backgroundCheck->code);

                $dateContact=Contact::getCountContactType($id);

                foreach ($dateContact as $Key=>$countC) {
                    if($countC['Type']=="SMS"){
                        $allSMS=$countC['consultas'];
                    }
                }

                if(isset($allSMS)){
                }else{
                    $allSMS=0;
                }

                if ($allSMS>=3) {
                    Yii::app()->user->setFlash('datelimit', "El máximo de 3 envíos fue superado, No puede enviar más SMS al candidato.");
                }else if ($allSMS<=3) {
                    $dateresponse = Contact::sendTextMessage($id);
                    if ($dateresponse['status'] == 1) {
                        if ($dateresponse['result']->totalFailed == 0) {
                            $IdBackgroundCheck = $backgroundCheck->id;
                            $statusContact = $dateresponse['result']->receivedRequests[0]->status . '. ' . $dateresponse['result']->receivedRequests[0]->reason;
                            $Created = $dateresponse['result']->dateToSend;
                            $idtransaction = $dateresponse['result']->receivedRequests[0]->transactionId;
                        } else {
                            $IdBackgroundCheck = $backgroundCheck->id;
                            $statusContact = $dateresponse['result']->failedRequests[0]->status . '. ' . $dateresponse['result']->failedRequests[0]->reason;
                            $Created = $dateresponse['result']->dateToSend;
                            $idtransaction = $dateresponse['result']->failedRequests[0]->transactionId;
                        }

                        $contact = Contact::insertTextMessage($IdBackgroundCheck, $statusContact, $Created, $idtransaction);
                        WebUser::logAccess("Se envío un mensaje de texto a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "], al número de celular: {$backgroundCheck->tels}", $backgroundCheck->code);
                    }else {
                        Yii::app()->user->setFlash('error', "Solicitud Incorrecta.");
                    }
                }
                $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'contacts', 'pc' => $pc));
                $this->redirect($url, true);
            }
        }
    }

    public function actionSendToCallInd($id, $pc)
    {
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $backgroundCheck = BackgroundCheck::model()->findByPK($id);
            
            if ($backgroundCheck) {
                WebUser::logAccess("Se genero petición de llamada en aldeamo para el estudio No:" . $backgroundCheck->code, $backgroundCheck->code);

                $dateContact=Contact::getCountContactType($id);

                foreach ($dateContact as $Key=>$countC) {
                    if($countC['Type']=="Voz"){
                        $allCall=$countC['consultas'];
                    }
                }

                if(isset($allCall)){
                }else{
                    $allCall=0;
                }

                if ($allCall>=3) {
                    Yii::app()->user->setFlash('datelimit', "El máximo de 3 envíos fue superado, No puede enviar la Llamada al candidato.");
                }else if ($allCall<=3) {
                    $dateresponse = Contact::sendToCall($id);
                    if(!empty($dateresponse)){
                        if ($dateresponse['status'] == "SUCCESS") {
                            if ($dateresponse['data']->totalFailed == 0) {
                                $IdBackgroundCheck = $backgroundCheck->id;
                                $statusContact = $dateresponse['data']->receivedRequests[0]->status . '. ' . $dateresponse['data']->receivedRequests[0]->reason;
                                $Created = $dateresponse['data']->dateToSend;
                                $idtransaction = $dateresponse['data']->receivedRequests[0]->transactionId;
                            } else {
                                $IdBackgroundCheck = $backgroundCheck->id;
                                $statusContact = $dateresponse['data']->failedRequests[0]->status . '. ' . $dateresponse['data']->failedRequests[0]->reason;
                                $Created = $dateresponse['data']->dateToSend;
                                $idtransaction = $dateresponse['data']->failedRequests[0]->transactionId;
                            }

                            $contact = Contact::insertToCall($IdBackgroundCheck, $statusContact, $Created, $idtransaction);
                            WebUser::logAccess("Se realizo una llamada a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "], al número de celular: {$backgroundCheck->tels}", $backgroundCheck->code);
                        } else {
                            Yii::app()->user->setFlash('error', "Solicitud Incorrecta.");
                        }
                    }else {
                        Yii::app()->user->setFlash('error', "Sin respuesta del Servicio, llamada no disponible.");
                    } 
                }
                $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'contacts', 'pc' => $pc));
                $this->redirect($url, true);
            }
        }
    }

    public function actionSendmassivecont()
    {
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            foreach ($_POST['ids'] as $id) {
                $backgroundCheck = BackgroundCheck::model()->findByPK($id);
                if ($backgroundCheck) {
                    $value = $backgroundCheck->customerProduct->attachmentFileId;
                    if (!$value || $value == null) {
                        Yii::app()->user->setFlash('errorcontact', "Debe Asociar un Archivo al producto del Cliente, para enviar el correo electrónico {$backgroundCheck->code}.");
                    }else if($backgroundCheck->statusFD==1){
                        Yii::app()->user->setFlash('errorcontact', "No se envia correo al candidato, porque el formulario dinámico ya fue enviado a sintecto, por favor verifique la información {$backgroundCheck->code}."); 
                    } else {
                    
                        Contact::idDinamicForm($backgroundCheck);
                        $filename = $backgroundCheck->customerProduct->attachmentFile->getAbsulotePath($value);

                        $i=0;
                        $fileArray=[];
                        
                        foreach ($filename as $archivos) {
                            if($filename[$i]){
                                $path = $backgroundCheck->customerProduct->attachmentFile->getFullPath($filename[$i]);
                                $data = file_get_contents($path);
                                $base64 = base64_encode($data);
                
                                $fileArray[] = array('fileName' => $filename[$i], 
                                            'baseName' => $filename[$i],
                                            'base64' => $base64
                                    );
                            }
                        $i++;
                        }

                        $body = $this->renderPartial('/contact/_mailNewForContacto', array(
                            'backgroundCheck' => $backgroundCheck,
                        ), true);

                        if (Yii::app()->user->sendMailInBackground(
                            "❗⏰ Docuemto adjunto para su debida diligencia, con estudio de Ref. [" . $backgroundCheck->code . "]❗⏰",
                            $body,
                            $backgroundCheck->mailsParamContact,
                            [],
                            [],
                            $fileArray
                        )) {
                            $contact = Contact::insertContactMail($id);
                            WebUser::logAccess("Se envío a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "] un correo con un documento adjunto: {$backgroundCheck->customerProduct->attachmentFile->fileName}", $backgroundCheck->code);
                        }
                    }
                }
            }
        }
    }

    public function actionSendmassiveSMS()
    {
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            foreach ($_POST['ids'] as $id) {
                $backgroundCheck = BackgroundCheck::model()->findByPK($id);

                if ($backgroundCheck) {

                    WebUser::logAccess("Se genero petición de envío mensaje de texto en aldeamo para el estudio No:" . $backgroundCheck->code, $backgroundCheck->code);

                    $dateresponse = Contact::sendTextMessage($id);

                    if ($dateresponse['status'] == 1) {
                        if ($dateresponse['result']->totalFailed == 0) {
                            $IdBackgroundCheck = $backgroundCheck->id;
                            $statusContact = $dateresponse['result']->receivedRequests[0]->status . '. ' . $dateresponse['result']->receivedRequests[0]->reason;
                            $Created = $dateresponse['result']->dateToSend;
                            $idtransaction = $dateresponse['result']->receivedRequests[0]->transactionId;
                        } else {
                            $IdBackgroundCheck = $backgroundCheck->id;
                            $statusContact = $dateresponse['result']->failedRequests[0]->status . '. ' . $dateresponse['result']->failedRequests[0]->reason;
                            $Created = $dateresponse['result']->dateToSend;
                            $idtransaction = $dateresponse['result']->failedRequests[0]->transactionId;
                        }

                        $contact = Contact::insertTextMessage($IdBackgroundCheck, $statusContact, $Created, $idtransaction);
                        WebUser::logAccess("Se envío un mensaje de texto a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "], al número de celular: {$backgroundCheck->tels}", $backgroundCheck->code);
                    } else {
                        Yii::app()->user->setFlash('error', "Solicitud Incorrecta.");
                    }
                }
            }
        }
    }

    public function actionSendmassiveToCall()
    {
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            foreach ($_POST['ids'] as $id) {
                $backgroundCheck = BackgroundCheck::model()->findByPK($id);

                if ($backgroundCheck) {

                    WebUser::logAccess("Se genero petición de llamada en aldeamo para el estudio No:" . $backgroundCheck->code, $backgroundCheck->code);

                    $dateresponse = Contact::sendToCall($id);
                    if(!empty($dateresponse)){
                        if ($dateresponse['status'] == "SUCCESS") {
                            if ($dateresponse['data']->totalFailed == 0) {
                                $IdBackgroundCheck = $backgroundCheck->id;
                                $statusContact = $dateresponse['data']->receivedRequests[0]->status . '. ' . $dateresponse['data']->receivedRequests[0]->reason;
                                $Created = $dateresponse['data']->dateToSend;
                                $idtransaction = $dateresponse['data']->receivedRequests[0]->transactionId;
                            } else {
                                $IdBackgroundCheck = $backgroundCheck->id;
                                $statusContact = $dateresponse['data']->failedRequests[0]->status . '. ' . $dateresponse['data']->failedRequests[0]->reason;
                                $Created = $dateresponse['data']->dateToSend;
                                $idtransaction = $dateresponse['data']->failedRequests[0]->transactionId;
                            }

                            $contact = Contact::insertToCall($IdBackgroundCheck, $statusContact, $Created, $idtransaction);
                            WebUser::logAccess("Se realizo una llamada a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "], al número de celular: {$backgroundCheck->tels}", $backgroundCheck->code);
                        } else {
                            Yii::app()->user->setFlash('error', "Solicitud Incorrecta.");
                        }
                    }else {
                        Yii::app()->user->setFlash('error', "Sin respuesta del Servicio, llamada no disponible.");
                    } 
                }
            }
        }
    }

    //15-02-2022 Natalia H.
    //Actualizar log en la tabla ses_LogDynamicForm para almacenar registros de acceso al formulario dinamico
    public function actionLogDinamycForm($id, $pc){

		Yii::import('application.extensions.DynamicForm.*');

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $backgroundCheck = BackgroundCheck::model()->findByPK($id);

            $dynamicForm = new DynamicForm();
            $dateresponse=$dynamicForm->dynamicgetlog($backgroundCheck->ooidFD);

            if(!empty($dateresponse)){
                Contact::insertToLogDynamicF($dateresponse, $id);
                WebUser::logAccess("Actualizo el log del formulario dinámico.", $backgroundCheck->code);
            }else{
                Yii::app()->user->setFlash('contactsError', "No existe log de formulario dinámico para este estudio.");
            }
        }
        $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'contacts', 'pc' => $pc));
        $this->redirect($url, true);
	}

    //15-02-2022 Natalia H.
    //Actualizar limite de fecha desde la pestaña contacto y enviando al consumo del servicio de formulario dinamico
    public function actionUpdateValiduntilFD($id, $pc, $datetime){
        Yii::import('application.extensions.DynamicForm.*');

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $backgroundCheck = BackgroundCheck::model()->findByPK($id);

            $dynamicForm = new DynamicForm();
            $dateresponse=$dynamicForm->updatevaliduntil($backgroundCheck->ooidFD, $datetime);

            if($backgroundCheck->statusFD==1){
                Yii::app()->user->setFlash('datelimit', "No se puede actualizar la fecha del formulario dinámico porque la información ya fue enviada a sintecto, por favor verifique."); 
            }else if(!empty($dateresponse)){
                $backgroundCheck->validuntilFD=$datetime;
				$backgroundCheck->update();
                WebUser::logAccess("Actualizo la fecha limite del formulario dinámico.", $backgroundCheck->code);
                Yii::app()->user->setFlash('datelimitsucces', "Actualizo la fecha limite del formulario dinámico.");
            }else{
                Yii::app()->user->setFlash('datelimit', "No existe el formulario dinámico.");
            }
        }
        $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'contacts', 'pc' => $pc));
        $this->redirect($url, true);
    }

    //22-03-2022 Natalia H.
    //Restablecer el password del formulario dinamico en caso de que el candidato olvide la clave que ingreso.
    public function actionRestorepassword($id, $pc){
        Yii::import('application.extensions.DynamicForm.*');

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            
            $backgroundCheck = BackgroundCheck::model()->findByPK($id);

            $dynamicForm = new DynamicForm();
            $dateresponse=$dynamicForm->restorePassword($backgroundCheck->ooidFD);

            if(!empty($dateresponse)){
                WebUser::logAccess("Restableció la clave del candidato en el formulario dinámico.", $backgroundCheck->code);
                Yii::app()->user->setFlash('contacts', "Se restableció la clave del candidato en el formulario dinámico.");
            }else{
                Yii::app()->user->setFlash('contactsError', "No se restableció la clave del candidato, porque el formulario dinámico ya no existe.");
            }
        }

        $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'contacts', 'pc' => $pc));
        $this->redirect($url, true);
    }


    //29-03-2022 Natalia H.
    //Eliminar todo lo del formulario dinamico.
    public function actionDeleteDynamicForm($id, $pc){
        Yii::import('application.extensions.DynamicForm.*');

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            
            $backgroundCheck = BackgroundCheck::model()->findByPK($id);

            $dynamicForm = new DynamicForm();
            $dateresponse=$dynamicForm->deleteDynamicForm($backgroundCheck->ooidFD);

            if(!empty($dateresponse)){
                WebUser::logAccess("Elimino el formulario dinámico en verificacion.co", $backgroundCheck->code);
                Yii::app()->user->setFlash('contacts', "Se elimino el formulario dinámico de manera exitosa.");
            }else{
                Yii::app()->user->setFlash('contactsError', "El formulario dinámico ya fue eliminado.");  
            }
        }

      
      

        $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'contacts', 'pc' => $pc));
        $this->redirect($url, true);
    }
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Contact('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Contact']))
            $model->attributes = $_GET['Contact'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }


    public function actionIndex()
    {

        /**
         * Lists all models.
         */
        $dataProvider = new CActiveDataProvider('Contact');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Contact::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contact-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }


    // Uncomment the following methods and override them if needed
    /*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/

    public function actionSendmassiveRecover()
    {
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            foreach ($_POST['ids'] as $id) {
            $backgroundCheck = BackgroundCheck::model()->findByPK($id);
            if ($backgroundCheck) {
                $val=$_POST['val'];
                if($val==1){
                    $value = $backgroundCheck->customerProduct->attachmentFileId;
                }else{
                    $value = $backgroundCheck->customerProduct->attachmentFileId2;
                }
               
                    if (!$value || $value == null) {
                        echo "Debe Asociar un Archivo al producto del Cliente, para enviar el correo electrónico {$backgroundCheck->code}."."\n";
                    }else if($backgroundCheck->statusFD==1 && $val==1){
                        echo "No se envia correo de soporte de pago al candidato, porque el formulario dinámico ya fue enviado a sintecto, por favor verifique la información {$backgroundCheck->code}."."\n"; 
                    }else if($backgroundCheck->reciptFileStatus==1 && $val==2){
                        echo "No se envia correo de Documento al candidato, porque el formulario dinámico ya fue enviado a sintecto, por favor verifique la información {$backgroundCheck->code}."."\n"; 
                    }else {
                        Contact::idDinamicFormRecover($backgroundCheck, $val);
                        if($val==1){
                            $filename = $backgroundCheck->customerProduct->attachmentFile->getAbsulotePath($value);
                        }else{
                            $filename = $backgroundCheck->customerProduct->attachmentFile2->getAbsulotePath($value);
                        }
                        

                        $i=0;
                        $fileArray=[];
                        
                        foreach ($filename as $archivos) {
                            if($filename[$i]){
                                if($val==1){
                                    $path = $backgroundCheck->customerProduct->attachmentFile->getFullPath($filename[$i]);
                                }else{
                                    $path = $backgroundCheck->customerProduct->attachmentFile2->getFullPath($filename[$i]);
                                }
                                $data = file_get_contents($path);
                                $base64 = base64_encode($data);
                
                                $fileArray[] = array('fileName' => $filename[$i], 
                                            'baseName' => $filename[$i],
                                            'base64' => $base64
                                    );
                            }
                        $i++;
                        }
                        if($val==1){
                            $body = $this->renderPartial('/contact/_mailNewForContactoSP', array(
                                'backgroundCheck' => $backgroundCheck,
                            ), true);
                            if (Yii::app()->user->sendMailInBackground(
                                "❗⏰ ".$backgroundCheck->customer->name."-Solicitud documento soporte de pago estudio de seguridad, Ref. [" . $backgroundCheck->code . "]❗⏰",
                                $body,
                                $backgroundCheck->mailsParamContact,
                                [],
                                [],
                                $fileArray
                            )) {
                                $contact = Contact::insertContactMailRecover($id);
                                WebUser::logAccess("Se envío a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "] un correo con un documento adjunto: {$backgroundCheck->customerProduct->attachmentFile->fileName}", $backgroundCheck->code);
                                echo "Se realizo el envío de correos electrónicos del soporte de pago con éxito  {$backgroundCheck->code}."."\n";
                            }
                        }else{
                            $body = $this->renderPartial('/contact/_mailNewForContactoDoc', array(
                                'backgroundCheck' => $backgroundCheck,
                            ), true);
                            if (Yii::app()->user->sendMailInBackground(
                                "❗⏰ ".$backgroundCheck->customer->name."-Solicitud documentos estudio de seguridad, Ref. [" . $backgroundCheck->code . "]❗⏰",
                                $body,
                                $backgroundCheck->mailsParamContact,
                                [],
                                [],
                                $fileArray
                            )) {
                                $contact = Contact::insertContactMailRecoverDoc($id);
                                WebUser::logAccess("Se envío a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "] un correo con un documento adjunto: {$backgroundCheck->customerProduct->attachmentFile2->fileName}", $backgroundCheck->code);
                                echo "Se realizo el envío de correos electrónicos del Documento con éxito {$backgroundCheck->code}."."\n";
                            }

                        }
                       
                    }
                }
            }
        }
    }

    //18-05-2023 Natalia H.
    //Actualizar limite de fecha desde el proceso masivo recaudo y enviando al consumo del servicio de formulario dinamico
    public function actionUpdateValiduntilFDRecover(){
        Yii::import('application.extensions.DynamicForm.*');


        //if (Yii::app()->user->isAdmin) {
            //$SeniorAssing = array();
            //$selectedIdArray = explode(',', $_POST['ids']);
            foreach ($_POST['ids'] as $idRecover) {
                
                $backgroundCheck = BackgroundCheck::model()->findByPk($idRecover);

                $dynamicForm = new DynamicForm();

                if($_POST['val']==1){
                    $dateresponse=$dynamicForm->updatevaliduntil($backgroundCheck->ooidFD, $_POST['datetime']);
  
                }else{
                    $dateresponse=$dynamicForm->updatevaliduntil($backgroundCheck->reciptFileooid, $_POST['datetime']);
                }

                if($_POST['val']==1){
                    if($backgroundCheck->statusFD==1){
                        echo "No se puede actualizar la fecha del formulario dinámico porque la información ya fue enviada a sintecto, por favor verifique."."\n"; 
                    }else if(!empty($dateresponse)){
                        $backgroundCheck->validuntilFD=$_POST['datetime'];
                        $backgroundCheck->update();
                        WebUser::logAccess("Actualizo la fecha limite del formulario dinámico SP.", $backgroundCheck->code);
                        echo "Actualizo la fecha limite del formulario dinámico SP. {$backgroundCheck->code}."."\n";
                    }else{
                        echo "No existe el formulario dinámico SP. {$backgroundCheck->code}."."\n";
                    }
                }else{
                    if($backgroundCheck->reciptFileStatus==1){
                        echo "No se puede actualizar la fecha del formulario dinámico porque la información ya fue enviada a sintecto, por favor verifique."."\n"; 
                    }else if(!empty($dateresponse)){
                        $backgroundCheck->reciptExpiration=$_POST['datetime'];
                        $backgroundCheck->update();
                        WebUser::logAccess("Actualizo la fecha limite del formulario dinámico Doc.", $backgroundCheck->code);
                        echo "Actualizo la fecha limite del formulario dinámico Doc. {$backgroundCheck->code}."."\n";
                    }else{
                        echo "No existe el formulario dinámico Doc. {$backgroundCheck->code}."."\n";
                    }
                }
               
            }
        //}
        //$url = $this->createUrl('/backgroundCheck/sendMassiveRecover/');
        //$this->redirect($url, true);
    }

    public function actionContactCustomerRecover($id, $pc, $val)
    {
        
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            $backgroundCheck = BackgroundCheck::model()->findByPK($id);
            if ($backgroundCheck) {
                if($val==1){
                    $value = $backgroundCheck->customerProduct->attachmentFileId;
                }else{
                    $value = $backgroundCheck->customerProduct->attachmentFileId2;
                }
                $dateContact=Contact::getCountContactType($id);

                foreach ($dateContact as $Key=>$countC) {
                    if($countC['Type']=="Correo"){
                        $allmail=$countC['consultas'];
                    }
                }

                if(isset($allmail)){
                }else{
                    $allmail=0;
                }

                /*if ($allmail>=8) {
                    Yii::app()->user->setFlash('datelimit', "El máximo de envíos fue superado, No puede enviar más correos al candidato.");
                }else*/ if (!$value || $value == null) {
                    Yii::app()->user->setFlash('error', "Debe Asociar un Archivo al producto del Cliente, para enviar el correo electrónico.");
                }else if($backgroundCheck->statusFD==1 && $val==1){
                    echo "No se envia correo de soporte de pago al candidato, porque el formulario dinámico ya fue enviado a sintecto, por favor verifique la información {$backgroundCheck->code}."."\n"; 
                }else if($backgroundCheck->reciptFileStatus==1 && $val==2){
                    echo "No se envia correo de Documento al candidato, porque el formulario dinámico ya fue enviado a sintecto, por favor verifique la información {$backgroundCheck->code}."."\n"; 
                } else {
                    Contact::idDinamicFormRecover($backgroundCheck, $val);

                    if($val==1){
                        $filename = $backgroundCheck->customerProduct->attachmentFile->getAbsulotePath($value);
                    }else{
                        $filename = $backgroundCheck->customerProduct->attachmentFile2->getAbsulotePath($value);
                    }

                    $i=0;
		            foreach ($filename as $archivos) {

                        if($filename[$i]){
                            if($val==1){
                                $path = $backgroundCheck->customerProduct->attachmentFile->getFullPath($filename[$i]);
                            }else{
                                $path = $backgroundCheck->customerProduct->attachmentFile2->getFullPath($filename[$i]);
                            }
                            $data = file_get_contents($path);
                            $base64 = base64_encode($data);
               
                            $fileArray[] = array('fileName' => $filename[$i], 
                                        'baseName' => $filename[$i],
                                        'base64' => $base64
                                );
                        }
                      
                    $i++;
                    }
                    if($val==1){
                        $body = $this->renderPartial('/contact/_mailNewForContactoSP', array(
                            'backgroundCheck' => $backgroundCheck,
                        ), true);
                        if (Yii::app()->user->sendMailInBackground(
                            "❗⏰ ".$backgroundCheck->customer->name."-Solicitud documento soporte de pago estudio de seguridad, Ref. [" . $backgroundCheck->code . "]❗⏰",
                            $body,
                            $backgroundCheck->mailsParamContact,
                            [],
                            [],
                            $fileArray
                        )) {
                            $contact = Contact::insertContactMailRecover($id);
                            WebUser::logAccess("Se envío a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "] un correo con un documento adjunto: {$backgroundCheck->customerProduct->attachmentFile->fileName}", $backgroundCheck->code);
                            echo "Se realizo el envío de correos electrónicos del soporte de pago con éxito  {$backgroundCheck->code}."."\n";
                        }
                    }else{
                        $body = $this->renderPartial('/contact/_mailNewForContactoDoc', array(
                            'backgroundCheck' => $backgroundCheck,
                        ), true);
                        if (Yii::app()->user->sendMailInBackground(
                            "❗⏰ ".$backgroundCheck->customer->name."-Solicitud documentos estudio de seguridad, Ref. [" . $backgroundCheck->code . "]❗⏰",
                            $body,
                            $backgroundCheck->mailsParamContact,
                            [],
                            [],
                            $fileArray
                        )) {
                            $contact = Contact::insertContactMailRecoverDoc($id);
                            WebUser::logAccess("Se envío a [" . $backgroundCheck->firstName . " " . $backgroundCheck->lastName . "] un correo con un documento adjunto: {$backgroundCheck->customerProduct->attachmentFile2->fileName}", $backgroundCheck->code);
                            echo "Se realizo el envío de correos electrónicos del Documento con éxito {$backgroundCheck->code}."."\n";
                        }

                    }
                }
                $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'contacts', 'pc' => $pc));
                $this->redirect($url, true);
            }
        }
    }

    public function actionUpdateValiduntilFDDoc($id, $pc, $datetime){
        Yii::import('application.extensions.DynamicForm.*');

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $backgroundCheck = BackgroundCheck::model()->findByPK($id);

            $dynamicForm = new DynamicForm();
            $dateresponse=$dynamicForm->updatevaliduntil($backgroundCheck->reciptFileooid, $datetime);

            if($backgroundCheck->reciptFileStatus==1){
                Yii::app()->user->setFlash('datelimit', "No se puede actualizar la fecha del formulario dinámico porque la información ya fue enviada a sintecto, por favor verifique."); 
            }else if(!empty($dateresponse)){
                $backgroundCheck->reciptExpiration=$datetime;
				$backgroundCheck->update();
                WebUser::logAccess("Actualizo la fecha limite del formulario dinámico.", $backgroundCheck->code);
                Yii::app()->user->setFlash('datelimitsucces', "Actualizo la fecha limite del formulario dinámico.");
            }else{
                Yii::app()->user->setFlash('datelimit', "No existe el formulario dinámico.");
            }
        }
        $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code, 'activeTab' => 'contacts', 'pc' => $pc));
        $this->redirect($url, true);
    }

    public function processSendMail()
	{
        set_time_limit(900);

        $criteria = new CDbCriteria();
        $criteria->addCondition("t.statusFD=0 AND customerProduct.viewDynamicForm=1 AND customer.isRecover=0 AND t.resultId=1 AND (t.backgroundCheckStatusId=1 OR t.backgroundCheckStatusId=5) AND (contacts.contactType=3 OR contacts.contactType=4)
        AND (customer.id!=10 AND customer.id!=34 AND customer.id!=14 AND customer.id!=800 AND customer.id!=925 AND customer.id!=918 AND customer.id!=11 AND customer.id!=944 AND customer.id!=669 AND customer.id!=1136 AND customer.id!=1138 AND customer.id!=297 AND customer.id!=803 AND customer.id!=1040 AND customer.id!=789) AND customerProduct.attachmentFileId IS NOT NULL"); 
        $criteria->with=['customerProduct','customer','contacts'];
        $criteria->group = 't.id';
	    $models = BackgroundCheck::model()->findAll($criteria);

		if (!empty($models)) {
            foreach ($models as $fdRegister) {
                $value = $fdRegister->customerProduct->attachmentFileId;

                Contact::idDinamicFormMasive($fdRegister->id);

                $filename = $fdRegister->customerProduct->attachmentFile->getAbsulotePath($value);

                $i=0;
                $fileArray=[];
                foreach ($filename as $archivos) {
                    if($filename[$i]){
                        $path = $fdRegister->customerProduct->attachmentFile->getFullPath($filename[$i]);
                        $data = file_get_contents($path);
                        $base64 = base64_encode($data);

                        $fileArray[] = array('fileName' => $filename[$i], 
                                    'baseName' => $filename[$i],
                                    'base64' => $base64
                            );
                    }
                    $i++;
                }
                

                if($fdRegister->customer->businessLine=="Integridad"){
                    $body = $this->renderInternal(Yii::app()->basePath . '/views/contact/_mailNewForContactoMasive.php', array(
                        'bgcId' => $fdRegister->id,
                    ), true);
                }else if($fdRegister->customer->businessLine=="Ev.Terceros"){
                    $body = $this->renderInternal(Yii::app()->basePath . '/views/contact/_mailNewForContactCompanyMasive.php', array(
                        'bgcId' => $fdRegister->id,
                    ), true);
                }

                if(false!==strpos($fdRegister->email, "@") && false!==strpos($fdRegister->email, ".")){
                    if($fdRegister->mailsParamContact){
                        if (!SvpMail::sendMail(
                            "❗⏰ Solicitud Documentos – Número de estudio: [" . $fdRegister->code . "]❗⏰",
                            $body,
                            $fdRegister->mailsParamContact,
                            [],
                            [],
                            $fileArray
                        )) {
                            echo "Error: No se ha podido enviar el correo";
                        }else{
                            $contact = Contact::insertContactMailMasive($fdRegister->id);
                        }
                    }
                }   
            }
		} else {
			echo 'No se encontraron registros pendientes\n';
		}
	}
}
