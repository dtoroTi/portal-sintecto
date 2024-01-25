<?php

class CandidateCallsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */

	public $defaultAction = 'admin';
	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CandidateCalls;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CandidateCalls']))
		{
			$model->attributes=$_POST['CandidateCalls'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
	public function actionUpdate($id, $pc)
	{

		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['CandidateCalls'])) {
		$model->attributes = $_POST['CandidateCalls'];

		if ($model->save())

			if($model->responsibleVisitId!=" " || $model->responsibleVisitId!=null){
				$models=$model->getAssingVisit($model->backgroundcheckId, $model->responsibleVisitId, $model->backgroundcheck->studyLimitOn, $model->backgroundcheck->code);
			}

			if($model->typeEvent=="Visita"){
				$models=$model->getDateEventsVisit($model->backgroundcheckId, $model->visitProgramdate, $model->formVisit, $model->backgroundcheck->code, $model->backgroundcheck->studyLimitOn);
			}else if($model->typeEvent=="Documentos"){
				$models=$model->getDateEventsDocument($model->backgroundcheckId, $model->backgroundcheck->email, $model->backgroundcheck->code, $model->backgroundcheck->studyLimitOn);
			}else if($model->typeEvent=="Visita-Documentos"){
				$models=$model->getDateEventsVisit($model->backgroundcheckId, $model->visitProgramdate, $model->formVisit, $model->backgroundcheck->code, $model->backgroundcheck->studyLimitOn);

				$models=$model->getDateEventsDocument($model->backgroundcheckId, $model->backgroundcheck->email, $model->backgroundcheck->code, $model->backgroundcheck->studyLimitOn);
			}
		
			WebUser::logAccess("Actualizo el registro de llamada: " . $model->id, $model->backgroundcheck->code);
			$this->redirect(array('view', 'id' => $model->id));
		}

		$this->render('update', array(
			'model' => $model,
			'pc'=>$pc
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CandidateCalls');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionCallstoAssign(){
		
		$model = new CandidateCalls();
		$model=$model->getAlltoAssignStudys();

		$url = $this->createUrl('/candidateCalls/admintoAssign/', array());
        $this->redirect($url, true);
	}
	/**
	 * Manages all models.
	 */
	//Llamadas Asignadas
	public function actionAdmintoAssign()
	{
		$model = GridViewFilter::getFilter('CandidateCalls', 'searchcallManager');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CandidateCalls']))
			$model->attributes=$_GET['CandidateCalls'];

		if (isset($_GET['_exporttoAssing'])) {
			 set_time_limit(300);
			 $this->renderPartial('_csvtoAssing', array(
				 'model' => $model,
				 //'withEvents' => false,
			 ));
		}else{
			$this->render('admincallManager',array(
				'model'=>$model,
			));
		}
	}

	//llamadas a cargo
	public function actionAdmintoManager()
	{
		$model = GridViewFilter::getFilter('CandidateCalls', 'searchCallstoManager');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CandidateCalls']))
			$model->attributes=$_GET['CandidateCalls'];

		if (isset($_GET['_exportTocharge'])){
			set_time_limit(300);
			$this->renderPartial('_csvTocharge', array(
				'model' => $model,
				//'withEvents' => true,
			));
		}elseif (isset($_GET['_exportAssingSection'])) {
            set_time_limit(300);
            $this->renderPartial('_csvAssingSection', array(
                'model' => $model,
				'admin'=>false,
                //'withEvents' => true,
            ));
        }else{
			$this->render('adminAllToManager',array(
				'model'=>$model,
			));
		}	
	}

	//todas las llamadas a cargo por funcionario responsable
	public function actionAdmin()
	{
		$model = GridViewFilter::getFilter('CandidateCalls', 'searchallCalls');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CandidateCalls']))
			$model->attributes=$_GET['CandidateCalls'];

		if (isset($_GET['_exportAllCalls'])){
			set_time_limit(300);
			$this->renderPartial('_csvAllCalls', array(
				'model' => $model,
			));
		}elseif (isset($_GET['_exporttoProgram'])) {
            set_time_limit(300);
            $this->renderPartial('_csvDateVisit', array(
                'model' => $model,
                //'withEvents' => true,
            ));
        }elseif (isset($_GET['_exportAssingSection'])) {
            set_time_limit(300);
            $this->renderPartial('_csvAssingSection', array(
                'model' => $model,
				'admin'=>true,
                //'withEvents' => true,
            ));
        }else{
			$this->render('admin',array(
				'model'=>$model,
			));
		}
	}

	public function actionAutocompleteUserResp() {
		$request = trim($_GET['term']);
        if ($request != '') {
            $criteria = new CDbCriteria;
            $criteria->addCondition(
                    'username like :term1 '
                    . 'or firstName like :term2 '
                    . 'or lastName like :term3 '
            );
            $criteria->addCondition('isActive=1');
            $criteria->params = array(
                ':term1' => "%" . $request . "%",
                ':term2' => "%" . $request . "%",
                ':term3' => "%" . $request . "%",
            );


            $model = User::model()->findAll($criteria);
            $data = array();
            foreach ($model as $get) {
                $data[] = array(
                    'label' => "{$get->username} : {$get->name}" . ($get->city ? "[{$get->city}]" : ""),
                    'value' => $get->username,
					'id' => $get->id
				);
            }
            $this->layout = 'empty';
            echo json_encode($data);
        }
    }

	public function actionNotAssignmassive(){
		if (Yii::app()->user->getIsByRole()) {
			foreach ($_POST['ids'] as $id) {
                $candidatecalls = CandidateCalls::model()->findByPK($id);
                if ($candidatecalls) {
					$candidatecalls->getUptNotAssignmassive($id);
				}
			}
		}else if (Yii::app()->user->isAdmin) {
            foreach ($_POST['ids'] as $id) {
                $candidatecalls = CandidateCalls::model()->findByPK($id);
                if ($candidatecalls) {
					$candidatecalls->getUptNotAssignmassive($id);
				}
			}
		}
	}

	public function actionNotCV(){
		if (Yii::app()->user->getIsByRole()) {
			foreach ($_POST['ids'] as $id) {
                $candidatecalls = CandidateCalls::model()->findByPK($id);
                if ($candidatecalls) {
					$candidatecalls->getUptNotCV($id);
				}
			}
		}else if (Yii::app()->user->isAdmin) {
            foreach ($_POST['ids'] as $id) {
                $candidatecalls = CandidateCalls::model()->findByPK($id);
                if ($candidatecalls) {
					$candidatecalls->getUptNotCV($id);
				}
			}
		}
	}

	public function actionPresencialNac(){
		if (Yii::app()->user->getIsByRole()) {
			foreach ($_POST['ids'] as $id) {
                $candidatecalls = CandidateCalls::model()->findByPK($id);
                if ($candidatecalls) {
					$candidatecalls->getUptPresencialNac($id);
				}
			}
		}else if (Yii::app()->user->isAdmin) {
            foreach ($_POST['ids'] as $id) {
                $candidatecalls = CandidateCalls::model()->findByPK($id);
                if ($candidatecalls) {
					$candidatecalls->getUptPresencialNac($id);
				}
			}
		}
	}

	public function actionPresencial(){
		if (Yii::app()->user->getIsByRole()) {
			foreach ($_POST['ids'] as $id) {
                $candidatecalls = CandidateCalls::model()->findByPK($id);
                if ($candidatecalls) {
					$candidatecalls->getUptPresencial($id);
				}
			}
		}else if (Yii::app()->user->isAdmin) {
            foreach ($_POST['ids'] as $id) {
                $candidatecalls = CandidateCalls::model()->findByPK($id);
                if ($candidatecalls) {
					$candidatecalls->getUptPresencial($id);
				}
			}
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CandidateCalls the loaded model
	 */
	public function loadModel($id)
	{
		if (Yii::app()->user->getIsByRole()) {
			return CandidateCalls::model()->findByPk($id);
		}else if (Yii::app()->user->isAdmin) {
			$model=CandidateCalls::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
        }else{
            throw new CHttpException(404, 'The requested page does not exist.');
        }
	}

	/**
	 * Performs the AJAX validation.
	 * @param CandidateCalls $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='candidate-calls-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	
	public function actionReassignUserCalls()
    {
        $ans = array('error' => '', 'ans' => '');

        if (
            (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) &&
            isset($_POST['reAssignment']) &&
            isset($_POST['reAssignment']['username'])
        ) {

            $user=User::model()->findByAttributes(array('id' => $_POST['reAssignment']['username']));
          
            $reAssingUserCalls = array();
            $selectedIdCallsArray = explode(',', $_POST['reAssignment']['selectedId']);
				foreach ($selectedIdCallsArray as $idcalls) {
					$reAssingUserCalls = CandidateCalls::model()->findByAttributes(array('id' => $idcalls));
					if($reAssingUserCalls){
						$reAssingUserCalls->callManagerId = $user->id;
						$reAssingUserCalls->statusVisit="PENDIENTE";
						$reAssingUserCalls->save();
					}
					$assignedUserCalls[] = $idcalls;
				}

				$ans['ans'] = 'Se asignaron las Llamadas con ID: ' . implode(',', $assignedUserCalls) . ' al usuario: ' . $user->username.' responsable de llamadas.';
		}else {
            $ans['error'] = 'No se hizo la reasignación, por favor complete los parámetros';
        }

        echo CJavaScript::jsonEncode($ans);
        Yii::app()->end();
    }
}
