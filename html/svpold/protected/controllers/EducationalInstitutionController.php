<?php


class EducationalInstitutionController extends Controller
{
    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;
    /**
     * Displays a particular model.
     */
    public function actionView() {
        $EducationalInstitution=$this->loadModel();
        $this->render('view',array(
            'model'=>$EducationalInstitution,
        ));
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        if (Yii::app()->user->IsAdmin || Yii::app()->user->getIsByRole()) {
            $model=new EducationalInstitution;
            if(isset($_POST['EducationalInstitution'])) {
                $model->attributes=$_POST['EducationalInstitution'];
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }
            $this->render('create',array(
                'model'=>$model,
            ));
        }
        else
            throw new CHttpException(400,'Alerta, Usted no tiene permisos para generar esta acción.');
    }
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate() {
        if (Yii::app()->user->IsAdmin || Yii::app()->user->getIsByRole()) {
            $model=$this->loadModel();
            if(isset($_POST['EducationalInstitution'])) {

                $model->attributes=$_POST['EducationalInstitution'];
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }

            $this->render('update',array(
                'model'=>$model,
            ));

        }
        else{
            if(!isset($_GET['ajax']))
                $this->redirect(array('admin'));

        }

    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete() {
        if (Yii::app()->user->IsAdmin || Yii::app()->user->getIsByRole()) {

            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via EducationalInstitution request
                $this->loadModel()->delete();
                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(array('index'));
            }
        }
        else
            throw new CHttpException('Alerta','Usted no tiene permisos para generar esta acción.');
    }
    /**
     * Lists all models.
     */
    public function actionIndex() {
        $criteria=new CDbCriteria(array(
            'order'=>'name DESC',
        ));
        if(isset($_GET['tag']))
            $criteria->addSearchCondition('tags',$_GET['tag']);
        $dataProvider=new CActiveDataProvider('EducationalInstitution', array(
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['EducationalInstitutionsPerPage'],
            ),
            'criteria'=>$criteria,
        ));
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }
    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model=new EducationalInstitution('search');
        if(isset($_GET['EducationalInstitution']))
            $model->attributes=$_GET['EducationalInstitution'];
        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if($this->_model===null)
        {
            if(isset($_GET['id']))
            {
                $this->_model=EducationalInstitution::model()->findByPk($_GET['id']);
            }
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

}