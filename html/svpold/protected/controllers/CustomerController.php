<?php

class CustomerController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

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
        $model = new Customer;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Customer'])) {
            $rnd = rand(0,9999);
            $model->attributes = $_POST['Customer'];
            $uploadedFile=CUploadedFile::getInstance($model,'logo');
            

            if(isset($uploadedFile) && $uploadedFile != null){
                
                $pos = strpos($uploadedFile->getType(), 'image');
                if($pos === false){
               
                    $model->addError('logo', 'Error el tipo de archivo no es imagen');

                    $errors = $model->errors;

                    $this->render('update', array(
                        'model' => $model,
                        'errors'=> $errors
                    ));
                    return;
                }
                $pos = strpos($uploadedFile->getName(), '.php');
                if($pos!==false){
                   
                    $model->addError('logo', "Error el archivo contiene una extensión no permitida");

                    $errors = $model->errors;
                    $this->render('update', array(
                        'model' => $model,
                        'errors'=> $errors
                    ));
                    return;
                }
            
            }    
            

            if(isset($uploadedFile) && $uploadedFile != null){
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->logo = $fileName;
            }

            if ($model->save()) {
                if(isset($uploadedFile) && $uploadedFile != null){
                    $uploadedFile->saveAs(Yii::app()->basePath.'/../files/logo/'.$fileName);    
                }
                
                WebUser::logAccess("Creo el cliente :" . $model->name);
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

        if (isset($_POST['Customer'])) {

            if($model->logo!=""){
                $_POST['Customer']['logo'] = $model->logo;
                //$model->logo=$_POST['Customer']['logo'];
            }
            else {
                $rnd = $model->id;
                $uploadedFile=CUploadedFile::getInstance($model,'logo');

               if(isset($uploadedFile) && $uploadedFile != null){

                    $pos = strpos($uploadedFile->getType(), 'image');
                    if($pos === false){
                   
                        $model->addError('logo', 'Error el tipo de archivo no es imagen');

                        $errors = $model->errors;

                        $this->render('update', array(
                            'model' => $model,
                            'errors'=> $errors
                        ));
                        return;
                    }
                    $pos = strpos($uploadedFile->getName(), '.php');
                    if($pos!==false){
                       
                        $model->addError('logo', "Error el archivo contiene una extensión no permitida");

                        $errors = $model->errors;
                        $this->render('update', array(
                            'model' => $model,
                            'errors'=> $errors
                        ));
                        return;
                    }

                }
                

                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                if(isset($uploadedFile) && $uploadedFile != null)
                {
                    $model->logo = $fileName;
                }
            }
            $modelOld=$model->getAttributes(true);

            $model->attributes = $_POST['Customer'];

            $modelNew=$model->getAttributes(true);

            $uploadedFile=CUploadedFile::getInstance($model,'logo');

            if(isset($uploadedFile) && $uploadedFile != null){
                $pos = strpos($uploadedFile->getType(), 'image');
                if($pos === false){
                   
                    $model->addError('logo', 'Error el tipo de archivo no es imagen');

                    $errors = $model->errors;

                    $this->render('update', array(
                        'model' => $model,
                        'errors'=> $errors
                    ));
                    return;
                }


                $pos = strpos($uploadedFile->getName(), '.php');
                if($pos!==false){
                   
                    $model->addError('logo', "Error el archivo contiene una extensión no permitida");

                    $errors = $model->errors;
                    $this->render('update', array(
                        'model' => $model,
                        'errors'=> $errors
                    ));
                    return;
                }
            }

            if($modelOld['isActive']!=$modelNew['isActive']){
                if($modelNew['isActive']==0){
                    $status="Inactivo";
                }else{
                    $status="Activo";
                }
                $this->actionSendStatus($status, $model);
            }
            WebUser::logRecordChange("Cambio Cliente: {$model->name}", null, get_class($model), $modelNew, $modelOld);
            
            if ($model->save()){
                //if(!empty($uploadedFile))  // check if uploaded file is set or not
                if(isset($uploadedFile) && $uploadedFile != null)
                {
                    $uploadedFile->saveAs(Yii::app()->basePath.'/../files/logo/'.$model->logo);
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

            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                $customer = $this->loadModel($id);
                if ($customer) {
                    $customerName = $customer->name;
                    WebUser::logAccess("Borro el cliente :" . $customerName);
                    $customer->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if (!isset($_GET['ajax'])) {
                        Yii::app()->user->setFlash('notice', "Se ha borrado el cliente : " . $customerName);
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                    }
                }
            } else
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
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
        $model = GridViewFilter::getFilter('Customer', 'search');
        if (isset($_GET['Customer']))
            $model->attributes = $_GET['Customer'];

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
            return Customer::model()->findByPk($id);
        }else{
            if (Yii::app()->user->isAdmin) {
                $model = Customer::model()->findByPk($id);
                if ($model === null)
                    throw new CHttpException(404, 'The requested page does not exist.');
                return $model;
            }else{
                throw new CHttpException(404, 'The requested page does not exist.');
            }
        }
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'customer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
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
//FUNCION PARA MOSTRAR LISTA DE ACTIVOS : Crear un Estudio de Seguridad - Producto de Cliente Activos
    public function actionDynamicActiveCustomerProducts($companySurvey) {
        $ans = '';
        if (!isset($_POST['BackgroundCheck']['customerId'])) {
            $customerId = 0;
        } else {
            $customerId = (int) $_POST['BackgroundCheck']['customerId'];
        }
        $customer = Customer::model()->findByPk($customerId);

        if ($customer) {
            $ans = array('customerUsers' => '', 'customerProducts' => '');
            foreach ($customer->customerActiveProducts as $customerProduct) {
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

    public function actionSendStatus($status, $model){

        $message="Se registra un cambio generado por: ".Yii::app()->user->name.", en el estado del cliente: ".$model->name." a ".$status.".";

        $body = "</p>" . "<pre>" . $message . "</pre><br/>";
        
        $timeZone = new DateTimeZone('America/Bogota');
        $now = new DateTime('now', $timeZone);
        $subject='❗⏰ Cambio estado de Cliente (' . $now->format('Y-m-d H:i:s') . ') ❗⏰';
        Yii::app()->user->sendMailInBackground($subject, $body, array(array('mail' => 'activacionclientes@sintecto.com', 'name' => 'activacionclientes@sintecto.com')));
    }

}
//comment