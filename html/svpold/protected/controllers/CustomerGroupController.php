<?php

class CustomerGroupController extends Controller {

    public $defaultAction = 'admin';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionReport($customerGroupId) {


        $customerGroup = $this->loadModel($customerGroupId);
        $from = new DateTime(Yii::app()->request->getQuery('report_fromDate'));
        $until = new DateTime(Yii::app()->request->getQuery('report_untilDate').' 23:59:59');

        if ($customerGroup && $from && $until && $from < $until) {
            $now = new DateTime($from->format('Y-m') . '-01');
            $periods = array();
            $interval = new DateInterval('P1M');
            $i=0;
            while ($now < $until && $i<12) {
                $periods[] = $now->format('y-m');
                $now->add($interval);
                $i++;
            }
            if ($i==12 && $now<$until){
                $until=$now->sub(new DateInterval('P1D'));
            }
            
            $this->renderPartial('_reportPdf', array(
                'customerGroup' => $customerGroup,
                'periods' => $periods,
                'from' => $from,
                'until' => $until,
            ));
        } else {
            $this->redirect('admin');
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new CustomerGroup;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CustomerGroup'])) {
            $model->attributes = $_POST['CustomerGroup'];
            if ($model->save())
                $this->redirect(array(
                    'admin'
                ));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CustomerGroup'])) {
            $model->attributes = $_POST['CustomerGroup'];
            if ($model->save())
                $this->redirect(array(
                    'admin'
                ));
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
                        'admin'
            ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {

        $model = GridViewFilter::getFilter('CustomerGroup', 'search');


        // clear any default values
        if (isset($_GET['CustomerGroup']))
            $model->attributes = $_GET['CustomerGroup'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return CustomerGroup the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = null;
        if (Yii::app()->user->getIsByRole()) {
			return  CustomerGroup::model()->findByPk($id);
		}else if (Yii::app()->user->isAdmin) {
            $model = CustomerGroup::model()->findByPk($id);
            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }else {
            throw new CHttpException(401, 'Unauthorized.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CustomerGroup $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'customer-group-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDynamicNextInvoice() {
        $ans = array();
        $ans['from'] = Yii::app()->db->createCommand('select now();')->queryScalar();
        $ans['until'] = Yii::app()->db->createCommand('select now();')->queryScalar();
        $ans['invoiceDate'] = Yii::app()->db->createCommand('select now();')->queryScalar();
        $ans['dueOn'] = Yii::app()->db->createCommand('select now();')->queryScalar();

        $ans['prevInvoice'] = array(
            'from' => '',
            'until' => '',
            'invoiceDate' => '',
            'dueOn' => '',
            'number' => '',
        );

        if (Yii::app()->user->isBilling) {
            if (isset($_GET['customerGroupId'])) {
                $customerGroupId = (int) $_GET['customerGroupId'];
            } elseif (isset($_POST['Invoice']['customerGroupId'])) {
                $customerGroupId = (int) $_POST['Invoice']['customerGroupId'];
            } else {
                $customerGroupId = 0;
            }


            if ($customerGroupId > 0) {
                $lastInvoice = Invoice::model()->findByAttributes(
                        array('customerGroupId' => $customerGroupId), array('order' => 'until desc,number desc'));
                if ($lastInvoice) {


                    $newInvoice = Invoice::getNextInvoice($customerGroupId);
                    $ans['from'] = $newInvoice->from;
                    $ans['until'] = $newInvoice->until;
                    $ans['invoiceDate'] = $newInvoice->invoiceDate;
                    $ans['dueOn'] = $newInvoice->dueOn;

                    $ans['prevInvoice'] = array(
                        'from' => $lastInvoice->from,
                        'until' => $lastInvoice->until,
                        'invoiceDate' => $lastInvoice->invoiceDate,
                        'dueOn' => $lastInvoice->dueOn,
                        'number' => $lastInvoice->number,
                    );
                }
            }
        }
        echo CJavaScript::jsonEncode($ans);
        Yii::app()->end();
    }

}
