<?php

class InvoiceVisitDetailController extends Controller
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		//$invoiceDetail = $this->loadModel($id);
		$invoiceDetail=InvoiceVisitDetail::model()->findByAttributes(['invoiceVisitId'=>$id]);
        if ($invoiceDetail) {
            $invoiceDetalVs= GridViewFilter::getFilter('InvoiceVisitDetail', 'search');
            if (!empty($initial)) {
                $invoiceDetalVs->invoiceSelection = Invoice::ONLY_INVOICE;
            }

            if (isset($_GET['InvoiceVisitDetail'])) {
                $invoiceDetalVs->attributes = $_GET['InvoiceVisitDetail'];
            }

			$invoiceVisit=InvoiceVisit::model()->findByPk($id);
            $invoiceDetalVs->invoiceVisitId = $id;
			
            $this->render('view', array(
                'model' => $invoiceDetail,
                'invoiceDetalVs' => $invoiceDetalVs,
				'modelinvoiceVisit'=>$invoiceVisit,
            ));
        } else {
            //$this->redirect(array("admin"));
			$this->redirect(array("invoiceVisit/admin"));
        }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new InvoiceVisitDetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['InvoiceVisitDetail']))
		{
			$model->attributes=$_POST['InvoiceVisitDetail'];
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
		if(isset($_POST['InvoiceVisitDetail']))
		{
			$model->attributes=$_POST['InvoiceVisitDetail'];

			if(isset($_POST['InvoiceVisitDetail']['isApprovedOP'])){
				if($_POST['InvoiceVisitDetail']['isApprovedOP']!='')
				{
					$model->isApprovedOP=$_POST['InvoiceVisitDetail']['isApprovedOP'];
					$model->ApprovedOPId=Yii::app()->user->id;
					$model->DateApprovedOP=new CDbExpression('NOW()');
				}else{
					$model->isApprovedOP=NULL;
					$model->ApprovedOPId=NULL;
					$model->DateApprovedOP=NULL;
				}
			}
			
			
			if($model->save())
				$model->getupdateTotaladd($model->invoiceVisitId);  
				WebUser::logAccess("Actualizo registro de factura # ".$model->invoiceVisitId." visitador.", $model->background->code); 
				$this->redirect(array('view','id'=>$model->invoiceVisitId));
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
		$model=$this->loadModel($id);
		$model->delete();
		$model->getDeleteRegister($model->invoiceVisitId, $model->backgroundId);
		WebUser::logAccess("Elimino registro de factura # ".$model->invoiceVisitId." visitador.", $model->background->code); 

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('InvoiceVisitDetail');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = GridViewFilter::getFilter('InvoiceVisitDetail', 'search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['InvoiceVisitDetail']))
			$model->attributes=$_GET['InvoiceVisitDetail'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionExport($id) {
		$exportInvoiceDetail= InvoiceVisitDetail::getExportInvoiceDetail($id);
        if ($exportInvoiceDetail) {
            $this->renderPartial('_csvInvoiceVisit', array(
                'invoiceVisit' => $exportInvoiceDetail,
            ));
        } else {
            $this->redirect(array('admin'));
        }
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return InvoiceVisitDetail the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{

		$model=InvoiceVisitDetail::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;

		/*if (Yii::app()->user->isAdmin) {
			$model=InvoiceVisitDetail::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
        }else{
            throw new CHttpException(404, 'The requested page does not exist.');
        }*/
	}

	/**
	 * Performs the AJAX validation.
	 * @param InvoiceVisitDetail $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoice-visit-detail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAprovedFac(){
		if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            foreach ($_POST['ids'] as $id) {
                $invoiceDetailFac = InvoiceVisitDetail::model()->findByPK($id);
                if ($invoiceDetailFac) {
					$invoiceDetailFac->getUptaproveFac($id);
				}
			}
		}
	}

	public function actionNotAprovedFac(){
		if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            foreach ($_POST['ids'] as $id) {
                $invoiceDetailFac = InvoiceVisitDetail::model()->findByPK($id);
                if ($invoiceDetailFac) {
					$invoiceDetailFac->getUptNotaproveFac($id);
				}
			}
		}
	}
}
