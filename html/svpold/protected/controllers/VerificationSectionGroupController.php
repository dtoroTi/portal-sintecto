<?php

class VerificationSectionGroupController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
        public $defaultAction='admin';


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new VerificationSectionGroup;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VerificationSectionGroup']))
		{
			$model->attributes=$_POST['VerificationSectionGroup'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VerificationSectionGroup']))
		{
			$model->attributes=$_POST['VerificationSectionGroup'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new VerificationSectionGroup('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['VerificationSectionGroup']))
			$model->attributes=$_GET['VerificationSectionGroup'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return VerificationSectionGroup the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
			$model=VerificationSectionGroup::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
        }else{
            throw new CHttpException(404, 'The requested page does not exist.');
        }
	}

	/**
	 * Performs the AJAX validation.
	 * @param VerificationSectionGroup $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='verification-section-group-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
