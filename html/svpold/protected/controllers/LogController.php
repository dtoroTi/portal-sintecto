<?php

class LogController extends Controller {

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
     * Manages all models.
     */
    public function actionAdmin($code = null, $customerUserLogin=null, $userLogin=null,$ip=null) {
        if(Yii::app()->user->getIsByRole()){
            $model = GridViewFilter::getFilter('Log', 'search');

            $model2 = GridViewFilter::getFilter('OldLog', 'search','adminOld');

            $model->customerUserLogin=$model2->customerUserLogin;
            $model->userLogin=$model2->userLogin;
            $model->ip=$model2->ip;
            $model->serverName=$model2->serverName;
            $model->controller=$model2->controller;
            $model->action=$model2->action;
            $model->backgroundCheckCode=$model2->backgroundCheckCode;
            $model->comments=$model2->comments;
            $model->created=$model2->created;
            

//            Yii::log("Model:".serialize($model), "trace", "ZWF." . __CLASS__);


            if ($ip) {
                $model->unsetAttributes();
                $model->ip = $ip;
            }
            if ($customerUserLogin) {
                $model->unsetAttributes();
                $model->customerUserLogin = $customerUserLogin;
            }
            if ($userLogin) {
                $model->unsetAttributes();
                $model->userLogin = $userLogin;
            }
            if ($code) {
                $model->unsetAttributes();
                $model->backgroundCheckCode = $code;
            }
            //$model = new Log('search');
            //$model->unsetAttributes();  // clear any default values
            if (isset($_GET['Log']))
                $model->attributes = $_GET['Log'];

            $this->render('admin', array(
                'model' => $model,
            ));
        }else if (Yii::app()->user->isSuperAdmin) {

            $model = GridViewFilter::getFilter('Log', 'search');

            $model2 = GridViewFilter::getFilter('OldLog', 'search','adminOld');

            $model->customerUserLogin=$model2->customerUserLogin;
            $model->userLogin=$model2->userLogin;
            $model->ip=$model2->ip;
            $model->serverName=$model2->serverName;
            $model->controller=$model2->controller;
            $model->action=$model2->action;
            $model->backgroundCheckCode=$model2->backgroundCheckCode;
            $model->comments=$model2->comments;
            $model->created=$model2->created;
            

//            Yii::log("Model:".serialize($model), "trace", "ZWF." . __CLASS__);


            if ($ip) {
                $model->unsetAttributes();
                $model->ip = $ip;
            }
            if ($customerUserLogin) {
                $model->unsetAttributes();
                $model->customerUserLogin = $customerUserLogin;
            }
            if ($userLogin) {
                $model->unsetAttributes();
                $model->userLogin = $userLogin;
            }
            if ($code) {
                $model->unsetAttributes();
                $model->backgroundCheckCode = $code;
            }
            //$model = new Log('search');
            //$model->unsetAttributes();  // clear any default values
            if (isset($_GET['Log']))
                $model->attributes = $_GET['Log'];

            $this->render('admin', array(
                'model' => $model,
            ));
        }else {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdminOld($code = null) {

        if (Yii::app()->user->isSuperAdmin || Yii::app()->user->getIsByRole()) {

            $model = GridViewFilter::getFilter('OldLog', 'search');
            $model2 = GridViewFilter::getFilter('Log', 'search','admin');

            $model->customerUserLogin=$model2->customerUserLogin;
            $model->userLogin=$model2->userLogin;
            $model->ip=$model2->ip;
            $model->serverName=$model2->serverName;
            $model->controller=$model2->controller;
            $model->action=$model2->action;
            $model->backgroundCheckCode=$model2->backgroundCheckCode;
            $model->comments=$model2->comments;
            $model->created=$model2->created;
            

//            Yii::log("Model:".serialize($model), "trace", "ZWF." . __CLASS__);



            if ($code) {
                $model->unsetAttributes();
                $model->backgroundCheckCode = $code;
            }
            //$model = new Log('search');
            //$model->unsetAttributes();  // clear any default values
            if (isset($_GET['OldLog']))
                $model->attributes = $_GET['OldLog'];

            $this->render('adminOld', array(
                'model' => $model,
            ));
        }else {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Log the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Log::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Log $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'log-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
//comment