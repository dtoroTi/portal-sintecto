<?php

class DetailPersonController extends Controller {

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id) {
    $model = DetailPerson::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  public function actionDeletePerson($id) {
    $document = $this->loadModel($id);
    $section = $document->verificationSection;
    $document->delete();
    $section->save();
    $url = $this->createUrl('/backgroundCheck/update/', array('code' => $section->backgroundCheck->code)) . "#verificationSection_{$section->id}";
    $this->redirect($url, true);
  }

}
