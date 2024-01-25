<?php

class SDNController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionQuery() {
        if (!Yii::app()->user->arUser->hasAccessToOfac) {
            $this->redirect('/');
            exit();
        }
        $query = new SDNSearchForm;
        $sdnVersions = SDN_Version::model()->findAll();

        if (count($sdnVersions) == 0) {
            $query->addError('', 'La base de datos esta bloqueada por actualización,  por favor intente más tarde.');
            $isActive = false;
        } else {
            $isActive = true;
        }
        foreach ($sdnVersions as $sdnVersion) {
            if (!$sdnVersion->isActive) {
                $query->addError('', 'La base de datos esta bloqueada por actualización,  por favor intente más tarde.');
                $isActive = false;
            }
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SDNSearchForm']) && $isActive) {
            // Search
            $query->attributes = $_POST['SDNSearchForm'];

            if ($query->validate()) {
                $error = false;
                $queries = array();
                $records = array('rows' => array(), 'matches' => array());
                $patterns = array();

                if ($query->firstname != '' || $query->lastname != '' || $query->remarks != '') {
                    $records = SDN::searchRecord(
                                    $query->firstname, $query->lastname, $query->remarks, $query->doNotIncludePrepositions, $query->oneFirstnameOneLastname, $query->allLastnames);

                    foreach ($records['matches'] as $match) {
                        $patterns[] = $match;
                    }
                }

                $queries[] = array(
                    'records' => $records['rows'],
                    'patterns' => $patterns,
                    'query' => $query,
                );

                if (!$error) {
                    $this->render('queryAnswer', array(
                        'queries' => $queries,
                        'sdnVersions' => $sdnVersions,
                        'query' => $query,
                        'isActive' => $isActive,
                    ));
                    return;
                }
            }
        }


        $this->render('query', array(
            'query' => $query,
            'sdnVersions' => $sdnVersions,
            'isActive' => $isActive,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = SDN::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sdn-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
