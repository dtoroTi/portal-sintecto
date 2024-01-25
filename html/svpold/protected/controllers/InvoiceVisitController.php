<?php

class InvoiceVisitController extends Controller
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
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
		$model=new InvoiceVisit;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['InvoiceVisit']))
		{
			$model->attributes=$_POST['InvoiceVisit'];
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['InvoiceVisit']))
		{
			$model->attributes=$_POST['InvoiceVisit'];
			if($model->save())
				WebUser::logAccess("Actualizo los datos de la factura visitadores # ".$model->id);
				$this->redirect(array('view','id'=>$model->id));
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('InvoiceVisit');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = GridViewFilter::getFilter('InvoiceVisit', 'search');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['InvoiceVisit']))
			$model->attributes=$_GET['InvoiceVisit'];
		
		if (isset($_GET['_exporttoFactureVis'])){
			set_time_limit(300);
			$this->renderPartial('_csvFactureVis', array(
				'model' => $model,
			));
		}else{
			$this->render('admin',array(
				'model'=>$model,
			));
		}

	}


	public function actionGetPreInvoiceVisit($id) {
        $invoiceVisit = $this->loadModel($id);
        if ($invoiceVisit) {
			$exportInvoicePreFac= InvoiceVisit::getInvoicePreFactura($id);
			WebUser::logAccess("Genero prefactura # ".$id);
            $this->renderPartial('_preInvoiceVisit', array(
                'invoiceVisit' => $invoiceVisit,
				'exportInvoicePreFac'=>$exportInvoicePreFac
            ));
            Yii::app()->end();
        } else {
            $this->redirect(array("admin"));
        }
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return InvoiceVisit the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=InvoiceVisit::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
		/*if (Yii::app()->user->isAdmin) {
			$model=InvoiceVisit::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
        }else{
            throw new CHttpException(404, 'The requested page does not exist.');
        }*/
	}

	/**
	 * Performs the AJAX validation.
	 * @param InvoiceVisit $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoice-visit-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
