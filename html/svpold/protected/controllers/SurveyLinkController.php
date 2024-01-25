<?php

class SurveyLinkController extends Controller
{
	public $defaultAction = 'admin';


    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

	public function actionCreate()
	{
		$model=new SurveyLink();

		// Uncomment the following line if AJAX validation is needed
		// $this->SurveyLink($model);
		if(isset($_POST['SurveyLink'])){
            $rnd = rand(0,9999);
            $model->attributes = $_POST['SurveyLink'];
            if ($model->save()) {
                WebUser::logAccess("Se creo el registro del link :" . $model->name);
                $this->redirect(array('admin'));
            }
        }

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if (isset($_POST['SurveyLink'])) {

            $modelOld=$model->getAttributes(true);

            $model->attributes = $_POST['SurveyLink'];

            $modelNew=$model->getAttributes(true);

            WebUser::logRecordChange("Cambio el link: {$model->link}", null, get_class($model), $modelNew, $modelOld);
            
            if ($model->save()){
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
	}

	public function actionIndex()
	{
    $this->actionAdmin();
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SurveyLink('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SurveyLink']))
			$model->attributes=$_GET['SurveyLink'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		if (Yii::app()->user->getIsByRole()) {
			return SurveyLink::model()->findByPk($id);
		}else if (Yii::app()->user->isAdmin) {
			$model=SurveyLink::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
        }else{
            throw new CHttpException(404, 'The requested page does not exist.');
        }
	}
}