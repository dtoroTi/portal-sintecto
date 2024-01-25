<?php

class DetailRegisterController extends Controller {

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
  public function actionTestAPI(){

    Yii::import('application.extensions.TusDatos.*');
    $bckid=CHtml::encode($_GET['bckid']);

    $criteria = new CDBCriteria();
    $criteria->compare('backgroundcheckId', $bckid);
    $models = TusDatosResponse::model()->findAll($criteria);

    if ($models) {
      foreach($models as $modelsTD){
        $modelsTD->tusdatosRequestTime = new CDbExpression('NOW()');
        $modelsTD->save(false);
      }
    }

    $bgk=BackgroundCheck::model()->findByPk($bckid);
    WebUser::logAccess("Ejecuto el proceso de tus datos manualmente.", $bgk->code);
    
    $tusDatos = new TusDatos();
    $tusDatos->getTusDatosPending();
  }

  public function actionRefresh(){

      Yii::import('application.extensions.TusDatos.*');
      $id=CHtml::encode($_GET['id']);
      $type=CHtml::encode($_GET['typedoc']);
      $idnumber=CHtml::encode($_GET['idnumber']);
      $job=CHtml::encode($_GET['jobid']);
      $bckid=CHtml::encode($_GET['bckid']);

      //$id =isset($idReport)?$idReport:"";
      //$type =isset($type)?$type:"";

      $tusDatos = new TusDatos();
      $tusDatos->getTusDatosRetry($job, $id, $type, $idnumber, $bckid);
      /*$tusdatos= TusDatosResponse::model()->findByAttributes(array('backgroundcheckId' => $id));
      $tusdatos->status = TusDatosResponse::STATUS_PENDING;
      $tusdatos->update();*/
  }
  
  public function actionCreate() {
    $model = new DetailRegister;

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['DetailRegister'])) {
      $model->attributes = $_POST['DetailRegister'];
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

    if (isset($_POST['DetailRegister'])) {
      $model->attributes = $_POST['DetailRegister'];
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
  public function actionDelete($id) {
    if (Yii::app()->request->isPostRequest) {
      // we only allow deletion via POST request
      $this->loadModel($id)->delete();

      // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
      if (!isset($_GET['ajax']))
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  /**
   * Lists all models.
   */
  public function actionIndex() {
    $dataProvider = new CActiveDataProvider('DetailRegister');
    $this->render('index', array(
        'dataProvider' => $dataProvider,
    ));
  }

  /**
   * Manages all models.
   */
  public function actionAdmin() {
    $model = new DetailRegister('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['DetailRegister']))
      $model->attributes = $_GET['DetailRegister'];

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
    $model = DetailRegister::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'detail-register-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

  public function actionDeleteRegister($id) {
    $document = $this->loadModel($id);
    $section = $document->verificationSection;
    if (!$document->required) {
      $document->delete();
      $section->save();
    }
    $url = $this->createUrl('/backgroundCheck/update/', array('code' => $section->backgroundCheck->code)) . "#verificationSection_{$section->id}";
    $this->redirect($url, true);
  }

  public function ActionComentAdvs($idSection, $val){

    $adversos = new DetailRegister();
    $adversos->getComentAdvs($idSection, $val);
    
    $models = VerificationSection::model()->findByAttributes(['id'=>$idSection]);
    $url = $this->createUrl('/backgroundCheck/update/', array('code' => $models->backgroundCheck->code)) . "&activeTab={$idSection}";
    $this->redirect($url, true);

  }

  public function processSendMailAdv($bgcId, $code){

    $event = Event::model()->findByAttributes(['backgroundCheckId'=>$bgcId]);
    $backgroundCheck = BackgroundCheck::model()->findByPK($bgcId);

    //WebUser::logAccess("Notificó al cliente de la novedad creado en {$event->created}", $event->backgroundCheck->code);
    $event->informedToCustomerOn = new CDbExpression('NOW()');
    $event->customerAnswerCode = Event::getNewCode();
    if ($event->eventTypeId != EventType::DELAY) {
        $fecha = new DateTime($event->backgroundCheck->studyLimitOn);
        $event->newLimitDate = $fecha->format('Y-m-d');
    }
    $event->customerAnswerLimit = $event->nextValidPeriod->format('Y-m-d H:i:s');
    $event->approvedById = '1796';

    if (!$event->save()) {
			throw new CHttpException(500, 'Server Error.');
		}

    $message="🔄 El Estudio Ref [".$code."] tiene una novedad  -->Informativa<--";

    $body = "Estimado(a) ".$backgroundCheck->customer->name."</br><br>".
    "El Estudio con referencia [<b>".$code."</b>] tiene una novedad.<br/><br/>".

    "<b>Detalle del estudio:</b><br/><br/>" .
    "Empresa: ".$backgroundCheck->customer->name."<br/>" .
    "Usuario de Cliente: ".$backgroundCheck->customerUser->name."<br/>" .
    "Producto de Cliente: ".$backgroundCheck->customerProduct->name."<br/>" .
    "Ref.: ".$code."<br/>".
    "Nombres: ".$backgroundCheck->firstName."<br/>".
    "Apellidos: ".$backgroundCheck->lastName."<br/>".
    "No. ID *: ".$backgroundCheck->idNumber."<br/><br/>".

    "<b>Novedad creada en ".$event->created."</b><br/><br/>".

    $event->detail."<br/>".
    "Informativa<br/><br/>".

    "La fecha estimada para resolver ésta novedad es : ".$event->newLimitDate."<br/><br/>".

    "Si usted tiene algún comentario respecto a esta novedad por favor escribalo en el siguiente enlce:<br/>".
    "<a href=".Yii::app()->params['sesApp'].$event->customerAnswerCode.">".Yii::app()->params['sesApp'].$event->customerAnswerCode."</a><br/><br/>".

    "El anterior enlace será válido sólo por las siguientes 48 horas hábiles<br/><br/>".
    
    "Atentamente,<br/><br/><br/>".
    "Soluciones en Integridad y Cumplimiento, Sintecto Ltda.</p><br/>";
    
    $subject=$message;
    if (!SvpMail::sendMail(
      $subject,
      $body,
      array(array("mail" => $backgroundCheck->customerUser->username, "name" => $backgroundCheck->customerUser->username)),
      [],
      [],
      []
    )) {
        echo "Error: No se ha podido enviar el correo";
    }else{
      echo "envio el correo";
    }
  }

}
