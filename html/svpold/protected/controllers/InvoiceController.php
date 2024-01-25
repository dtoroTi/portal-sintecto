<?php

class InvoiceController extends Controller {

    public $defaultAction = 'admin';

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Invoice;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Invoice'])) {
            $model->attributes = $_POST['Invoice'];
            if ($model->save())
                $this->redirect(array('admin'));
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

        if (isset($_POST['Invoice'])) {

            $modelOld=$model->getAttributes(true);

            $model->attributes = $_POST['Invoice'];

            $modelNew=$model->getAttributes(true);

            WebUser::logRecordChange("Cambio Facturación: {$model->id}: {$model->customerGroup->name}: ", null, get_class($model), $modelNew, $modelOld);
            
            if ($model->save())
                $this->redirect(array('/invoice/view', 'id' => $model->id));
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
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id, $initial = NULL) {
        $invoice = $this->loadModel($id);
        if ($invoice) {
            $backgroundCheck = GridViewFilter::getFilter('BackgroundCheck', 'searchForInvoice');
            if (!empty($initial)) {
                $backgroundCheck->invoiceSelection = Invoice::ONLY_INVOICE;
            }

            if (isset($_GET['BackgroundCheck'])) {
                $backgroundCheck->attributes = $_GET['BackgroundCheck'];
            }
            $backgroundCheck->invoiceId = $id;
            $this->render('view', array(
                'model' => $invoice,
                'backgroundCheck' => $backgroundCheck,
            ));
        } else {
            $this->redirect(array("admin"));
        }
    }
    
        /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionGetPreInvoice($id) {
        $invoice = $this->loadModel($id);
        if ($invoice) {
            $this->renderPartial('_preInvoice', array(
                'invoice' => $invoice,
            ));
            Yii::app()->end();
        } else {
            $this->redirect(array("admin"));
        }
    }


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionUpdateProducts($id) {
        $invoice = $this->loadModel($id);

        if ($invoice) {
            WebUser::logAccess("Guardo detalle de factura :" . $invoice->number);

            if (isset($_POST['invoiceDetails'])) {
                foreach ($_POST['invoiceDetails'] as $key => $detail) {
                    if ($key != 'new') {
                        $invoiceDetail = InvoiceDetail::model()->findByPk((int) $key);
                        if (($invoiceDetail) && ($invoiceDetail->qty > 0 || $invoiceDetail->description != '')) {
                            $invoiceDetail->attributes = $_POST['invoiceDetails'][$key];
                            if (!$invoiceDetail->save()) {
                                Yii::app()->user->setFlash('invoiceDetails', HtmlHelper::modelErrorsStr($invoiceDetail));
                            }
                        }
                    } else {
                        $invoiceDetail = new InvoiceDetail();
                        $invoiceDetail->attributes = $_POST['invoiceDetails'][$key];
                        $invoiceDetail->invoiceId = $invoice->id;
                        if ($invoiceDetail->qty > 0 || $invoiceDetail->description != '') {
                            if (!$invoiceDetail->save()) {
                                Yii::app()->user->setFlash('invoiceDetails', HtmlHelper::modelErrorsStr($invoiceDetail));
                            }
                        }
                    }
                }
            }
            $this->render('invoiceDetails', array(
                'model' => $invoice,
            ));
        } else {
            $this->redirect('/invoice/admin');
        }
    }

    public function actionDeleteInvoiceDetail($invoiceDetailId) {
        if ((Yii::app()->user->isBilling || Yii::app()->user->getIsByRole())) {
            $invoiceDetail = InvoiceDetail::model()->findByPk($invoiceDetailId);
            if ($invoiceDetail) {
                $invoice = $invoiceDetail->invoice;
                $invoiceDetail->delete();
                $this->redirect('/invoice/updateProducts', array('id' => $invoice->id));
            } else {
                $this->redirect('/invoce/admin');
            }
        } else {
            $this->redirect('/invoice/admin');
        }
    }

    public function actionAssignInvoiceToSelectedStudies($id, $assignSelected = 0) {
        $invoice = $this->loadModel($id);
        if ($invoice && !$invoice->closed) {
            $backgroundCheck = GridViewFilter::getFilter('BackgroundCheck', 'searchForInvoice', 'view');
            $backgroundCheck->invoiceId = $id;

            if ($assignSelected > 0) {
                $dataProvider = $backgroundCheck->searchForInvoice($invoice, 20);
                $studies = BackgroundCheck::model()->findAll($dataProvider->criteria);
                $i = 0;
                foreach ($studies as $study) {
                    if ($assignSelected == 1 && empty($study->invoiceId)) {
                        $study->invoiceId = $invoice->id;
                        if ($study->save()) {
                            $i++;
                        }
                    }
                    if ($assignSelected == 2 && !empty($study->invoiceId)) {
                        $study->invoiceId = new CDbExpression('NULL');
                        if ($study->save()) {
                            $i++;
                        }
                    }
                }
                print($i);
            }
        } else {
            
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionAssignInvoice($id, $code, $add) {
        $invoice = $this->loadModel($id);
        if ($invoice && !$invoice->closed) {
            $backgroundCheck = BackgroundCheck::model()->findByCode($code);
            if ($backgroundCheck) {
                if ($add == 1 && empty($backgroundCheck->invoiceId)) {
                    $backgroundCheck->invoiceId = $id;
                } else if ($add == 0 && $backgroundCheck->invoiceId == $id) {
                    $backgroundCheck->invoiceId = new CDbExpression('NULL');
                }
                $backgroundCheck->save();
            }
        }
    }

    public function actionExport($id) {
        $invoice = $this->loadModel($id);
        if ($invoice) {
            $this->renderPartial('_csvInvoice', array(
                'invoice' => $invoice,
            ));
        } else {
            $this->redirect(array('admin'));
        }
    }

    public function actionExportv2($id) {
        $invoice = $this->loadModel($id);
        if ($invoice) {
            $this->renderPartial('_csvInvoicev2', array(
                'invoice' => $invoice,
            ));
        } else {
            $this->redirect(array('admin'));
        }
    }

    public function actionExportInvoices() {
        $model = GridViewFilter::getFilter('Invoice', 'search');
        if ((Yii::app()->user->isBilling  || Yii::app()->user->getIsByRole()) && Yii::app()->user->isRegisteredIp) {
            $this->renderPartial('_csvInvoices', array(
                'model' => $model,
            ));
        } else {
            $this->redirect(array('admin'));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = GridViewFilter::getFilter('Invoice', 'search');
        //$model->unsetAttributes();  // clear any default values
        if (isset($_GET['Invoice'])) {
            $model->attributes = $_GET['Invoice'];
        }

        $this->render('admin', array(
            'model' => $model,
            'sort' => array(
                'defaultOrder' => '`until` DESC',
            )
        ));
    }

    public function actionDynamicNextInvoiceDates($customerGroupId) {
        $ans = array(
            'From' => '',
            'Until' => '',
            'invoiceDate' => '',
            'dueOn' => '',
        );

        $criteria = new CDbCriteria();
        $criteria->compare('customerGroupId', $this->customerGroupId);
        $criteria->order('t.invoiceDate DESC');
        $invoice = Invoice::model()->find($criteria);

        if ($invoice) {
            $ans['from'] = $invoice->from;
            $ans['until'] = $invoice->until;
            $ans['invoiceDate'] = $invoice->invoiceDate;
            $ans['dueOn'] = $invoice->dueOn;
        }

        echo CJavaScript::jsonEncode($ans);
        Yii::app()->end();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Invoice the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Invoice::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionUpdatePrice($code, $id) {
        /* @var $backgroundCheck BackgroundCheck */
        $invoice = Invoice::model()->findByPk($id);
        $backgrounCheck = BackgroundCheck::findByCode($code);

        if ($invoice && $backgrounCheck && (Yii::app()->user->isBilling || Yii::app()->user->getIsByRole())) {

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['BackgroundCheck'])) {

                $backgroundld=$backgrounCheck->getAttributes(true);

                $backgrounCheck->price = (int) $_POST['BackgroundCheck']['price'];
                $backgrounCheck->additionalPrice = (int) $_POST['BackgroundCheck']['additionalPrice'];
                $backgrounCheck->additionalPriceComment = $_POST['BackgroundCheck']['additionalPriceComment'];

                $backgroundlNew=$backgrounCheck->getAttributes(true);
    
                WebUser::logRecordChange("Cambio Valor Factura: {$backgrounCheck->id}: {$backgrounCheck->customer->customerGroup->name}: ", $backgrounCheck->code, get_class($backgrounCheck), $backgroundlNew, $backgroundld);
                
                if ($backgrounCheck->save()) {
                    $this->redirect(array('/invoice/view', 'id' => $id));
                }
            }

            $this->render('updatePrice', array(
                'backgroundCheck' => $backgrounCheck,
                'invoice' => $invoice,
            ));
        } else {
            $this->redirect('invoice/admin');
        }
    }

    /**
     * Performs the AJAX validation.
     * @param Invoice $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'invoice-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetInvoiceData($id) {
        $model = $this->loadModel($id);
        $ans = null;
        if ($model && (Yii::app()->user->isBilling || Yii::app()->user->getIsByRole())) {
            $ans = array();
            $ans['total'] = $model->total;
            $ans['totalStudies'] = $model->totalStudies;
            $ans['numStudies'] = $model->numStudies;
        }
        echo CJavaScript::jsonEncode($ans);
        Yii::app()->end();
    }

}
