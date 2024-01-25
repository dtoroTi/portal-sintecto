<?php

class RoleHasPermissionController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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

        if (isset($_POST['RoleHasPermission'])) {
            $model->attributes = $_POST['RoleHasPermission'];
            if ($model->save()) {
                $this->redirect(['role/admin']);
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
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return RoleHasPermission the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = RoleHasPermission::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param RoleHasPermission $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'role-has-permission-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAutocompletepermission()
    {
        $request = trim($_GET['term']);
        if ($request != '') {
            $criteria = new CDbCriteria;

            if (!strstr($request, ' ')) {
                $criteria->compare('controller', $request, true, 'OR');
                $criteria->compare('action', $request, true, 'OR');
                $criteria->compare('permission', $request, true, 'OR');
            } else {
                $params = explode(' ', $request);
                $criteria->compare('controller', $params[0], true);
                $criteria->compare('action', $params[1], true);
                if (count($params) > 2) {
                    $criteria->compare('permission', $params[2], true);
                }
            }

            $model = Permission::model()->findAll($criteria);
            $data = [];
            foreach ($model as $get) {
                $data[] = [
                    'label' => "{$get->id}: {$get->controller}, {$get->action}, {$get->permission}",
                    'value' => $get->id . ',' . $get->controller . ',' . $get->action,
                    'id' => $get->id];
            }
            $this->layout = 'empty';
            echo json_encode($data);
        }
    }

    public function actionInsertHasPermission()
    {

        //if (Yii::app()->user->isAdmin) {

            $idPermstr = CHtml::encode($_POST['permissionId']);
            $idRole = CHtml::encode($_POST['roleId']);

            $idPerm = explode(",", $idPermstr);

            $verifiedPermission = RoleHasPermission::model()->findByAttributes(['roleId' => $idRole, 'permissionId' => $idPerm[0]]);

            if ($verifiedPermission) {
                Yii::app()->user->setFlash('error', "Ya se encuentra registrado");
            } else {

                $verifiedPermission = RoleHasPermission::model()->assingPermission($idRole, $idPerm[0]);
            }

        //}
    }

}
//comment