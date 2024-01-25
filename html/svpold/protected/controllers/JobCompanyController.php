<?php

class JobCompanyController extends Controller
{
	/**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
    public function actionView() {
        $JobCompany=$this->loadModel();
        $this->render('view',array(
            'model'=>$JobCompany,
        ));
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        if (Yii::app()->user->IsAdmin || Yii::app()->user->getIsByRole()) {
            $model=new JobCompany;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['JobCompany']))
            {
                $model->attributes=$_POST['JobCompany'];
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
	 * @param integer $id the ID of the model to be updated
	 */
    public function actionUpdate() {
        if (Yii::app()->user->IsAdmin || Yii::app()->user->getIsByRole()) {
            $model=$this->loadModel();
            if(isset($_POST['JobCompany'])) {

                $model->attributes=$_POST['JobCompany'];
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
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
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
        	$dataProvider=new CActiveDataProvider('JobCompany', array(
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['JobCompanysPerPage'],
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
        $model=new JobCompany('search');
        if(isset($_GET['JobCompany']))
            $model->attributes=$_GET['JobCompany'];
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
                $this->_model=JobCompany::model()->findByPk($_GET['id']);
            }
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
	/**
	 * Performs the AJAX validation.
	 * @param JobCompany $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='job-company-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
//coment