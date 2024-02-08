<?php

class DetailPolygraphController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
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
	public function ActionComentAdvs($idSection, $val){

		$adversos = new DetailPolygraph();
		$adversos->getComentAdvs($idSection, $val);
		
		$models = VerificationSection::model()->findByAttributes(['id'=>$idSection]);
		$url = $this->createUrl('/backgroundCheck/update/', array('code' => $models->backgroundCheck->code)) . "&activeTab={$idSection}";
		$this->redirect($url, true);
	
	}
}