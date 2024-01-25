<?php

class RequestsSACController extends Controller
{

	public $defaultAction = 'admin';


    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

	public function actionCreate()
	{
		$model=new RequestsSAC();

		if (isset($_POST['RequestsSAC'])) {
			$model->attributes = $_POST['RequestsSAC'];

			if ($model->save())
				WebUser::logAccess("Creo una solicitud SAC con id: " . $model->id, $model->backgroundcheck->code);
			  	$this->redirect(array('view', 'id' => $model->id));
		}
	  
		$this->render('create', array(
			'model' => $model,
		));
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['RequestsSAC'])) {
		$model->attributes = $_POST['RequestsSAC'];

		if($model->dateUpdate==null && $_POST['RequestsSAC']['status']!="Pendiente"){ // && 
			$dateAct = new DateTime();  
			$date = $dateAct->format("Y-m-d h:i:s");
			$model->dateUpdate = $date;
		}
		
		if ($model->save())
			WebUser::logAccess("Actualizo la solicitud SAC con id: " . $model->id, $model->backgroundcheck->code);
			$this->redirect(array('view', 'id' => $model->id));
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
		//$model=new RequestsSAC('search');
		$model = GridViewFilter::getFilter('RequestsSAC', 'search');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RequestsSAC']))
			$model->attributes=$_GET['RequestsSAC'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		if (Yii::app()->user->getIsByRole()) {
			return RequestsSAC::model()->findByPk($id);
		}else if (Yii::app()->user->isAdmin) {
			$model=RequestsSAC::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
        }else{
            throw new CHttpException(404, 'The requested page does not exist.');
        }
	}

    /*public function actionDelete($id) {
		if (Yii::app()->user->isAdmin) {
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
			  $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            
        }
    }*/

	public function actionDelete($id) {
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                $requestSAC = $this->loadModel($id);
                if ($requestSAC) {
                    $requestSACId = $requestSAC->id;
                    WebUser::logAccess("Borro la solicitud SAC Número:" . $requestSACId);
                    $requestSAC->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if (!isset($_GET['ajax'])) {
                        Yii::app()->user->setFlash('notice', "Se ha borrado la solicitud SAC Número: " . $requestSACId);
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                    }
                }
            } else
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

	public function actionAutocompleteAllActiveCode() {
        $request = trim($_GET['term']);
        if ($request != '') {
            $criteria = new CDbCriteria;
            $criteria->addCondition(
                    'code like :term1 '
            );
            $criteria->addCondition('backgroundCheckStatusId='.BackgroundCheckStatus::REQUESTED.' or backgroundCheckStatusId='.BackgroundCheckStatus::PROCESSING);
            $criteria->params = array(
                ':term1' => "%" . $request . "%",
            );


            $model = BackgroundCheck::model()->findAll($criteria);
            $data = array();
            foreach ($model as $get) {
                $data[] = array(
                    'label' => "{$get->code} : {$get->firstName} {$get->lastName}",
                    'value' => $get->code,
					'id' => $get->id);
            }
            $this->layout = 'empty';
            echo json_encode($data);
        }
    }

	public function actionDateRequestsSAC() {

        $id = CHtml::encode($_POST['backgroundId']);
        
        $dateRequestsSAC = RequestsSAC::getDateBackground($id);

        header('Content-type: application/json');
        echo CJSON::encode($dateRequestsSAC);    
        Yii::app()->end();

		//return $datebackground;
	}

	public function actionExportRequestsSAC() {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $exportRequestsReports = RequestsSAC::getExportRequestsSAC();

            echo $this->renderPartial( 'exportRequestsSACCSV'
                    , array(
                'exportRequestsReports' => $exportRequestsReports,
            ));
        }
    }

}