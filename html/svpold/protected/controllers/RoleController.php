<?php

class RoleController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {

        $model = $this->loadModel($id);

        $rolHasPermissionFilter = new RoleHasPermission('search');
		
		$rolHasPermissionFilter->unsetAttributes();  // clear any default values
		if(isset($_GET['RoleHasPermission'])){
			$rolHasPermissionFilter->attributes=$_GET['RoleHasPermission'];
		}
		
        $rolHasPermissionFilter->roleId = $model->id;

        $this->render('view', [
            'model' => $model,
            'rolHasPermissionFilter' => $rolHasPermissionFilter,
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Role;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Role'])) {
            $model->attributes = $_POST['Role'];
            if ($model->save()) {
                $this->redirect(['view', 'id' => $model->id]);
            }

        }

        $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Role'])) {
            $model->attributes = $_POST['Role'];
            if ($model->save()) {
                $this->redirect(['admin']);
            }

        }

        $this->render('update', [
            'model' => $model,
        ]);
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
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
        }

    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Role');
        $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Role('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Role'])) {
            $model->attributes = $_GET['Role'];
        }

        $this->render('admin', [
            'model' => $model,
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Role the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Role::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Role $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'role-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
//comment