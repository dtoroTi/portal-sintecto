<?php

class DetailFinancialController extends Controller
{
	/*public function actionIndex()
	{
		$this->render('index');
	}*/

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

	public function actionTransUnionIC(){

        Yii::import('application.extensions.TransUnion.*');
        $bckid=CHtml::encode($_GET['bckid']);
        $type=CHtml::encode($_GET['typedoc']);
        $idnumber=CHtml::encode($_GET['idnumber']);
        $motConsulta=CHtml::encode($_GET['motConsulta']);
        $codInfo=CHtml::encode($_GET['codInfo']);
  
		$backgroundCheck = BackgroundCheck::model()->findByPk($bckid);
  
        $transUnion = new TransUnion();
        $data=$transUnion->getInfoComercial($bckid, $type, $idnumber, $motConsulta, $codInfo);

		WebUser::logAccess("Genero el informe Comercial de TransUnion", $backgroundCheck->code);

        if(isset($data->Error)){
            echo "Error: ".$data->Error->MensajeError; 
        }else{
            $this->renderPartial('_pdfInfComercial', array(
                'dataTU' => $data,
                'bckid'=>$bckid)
            );
            echo "Informe Generado con Éxito."; 
        }
    }
}