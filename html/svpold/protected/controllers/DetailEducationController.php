<?php

class DetailEducationController extends Controller {

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
    $model = new DetailEducation;

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['DetailEducation'])) {
      $model->attributes = $_POST['DetailEducation'];
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

    if (isset($_POST['DetailEducation'])) {
      $model->attributes = $_POST['DetailEducation'];
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
    $dataProvider = new CActiveDataProvider('DetailEducation');
    $this->render('index', array(
        'dataProvider' => $dataProvider,
    ));
  }

  /**
   * Manages all models.
   */
  public function actionAdmin() {
    $model = new DetailEducation('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['DetailEducation']))
      $model->attributes = $_GET['DetailEducation'];

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
      return DetailEducation::model()->findByPk($id);
    }else{
        $model = DetailEducation::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
  }

  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'detail-education-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

  public function actionDeleteStudy($id) {
    $document = $this->loadModel($id);
    $section = $document->verificationSection;
    $document->delete();
    $section->save();
    $url = $this->createUrl('/backgroundCheck/update/', array('code' => $section->backgroundCheck->code)) . "#verificationSection_{$section->id}";
    $this->redirect($url, true);
  }

  public function actionListContEduct(){

    $institution = CHtml::encode($_POST['institution']);

    $detallelistJob = DetailEducation::model()->getDateEduInstitute($institution);

    header('Content-type: application/json');
    echo CJSON::encode($detallelistJob);    
    Yii::app()->end();
  }

  public function ActionSendEmail($verificationSection){

    $verifSection = VerificationSection::model()->findByAttributes(['id'=>$verificationSection]);
    $backgroundCheck = BackgroundCheck::model()->findByPk($verifSection->backgroundCheckId);

    $modelsVs = DetailEducation::model()->findAllByAttributes(['verificationSectionId'=>$verificationSection]);
    foreach($modelsVs as $detailEdu){

      $body = $this->renderPartial('_mailAcademicVerification', array(
        'backgroundCheck' => $backgroundCheck,
        'detailEdu' => $detailEdu,
      ), true);

      if(false!==strpos($detailEdu->email, "@") && false!==strpos($detailEdu->email, ".")){
        if (Yii::app()->user->sendMailInBackground(
          "❗⏰ Verificación Académica ❗⏰",
          $body,
          [["mail" => $detailEdu->email, "name" => $detailEdu->email]],
          [],
          [],
          [],
          2
          )) {
              WebUser::logAccess("Se envío un correo, a la institucion [".$detailEdu->institution."]", $backgroundCheck->code);
          }
      }
    }

    $url = $this->createUrl('/backgroundCheck/update/', array('code' => $backgroundCheck->code)) . "&activeTab={$verificationSection}";
    $this->redirect($url, true);

  }

}
//coment
