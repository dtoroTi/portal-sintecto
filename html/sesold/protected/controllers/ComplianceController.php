<?php

class ComplianceController extends Controller {



    public function actionForm() {

        $user2 = CustomerUser::model()->findByPK(Yii::app()->user->arUser->id);
        $model=CActiveRecord::model("Compliance")->findAll();

        $this->render('form',array("model"=>$model, "user2"=>$user2));
    }

    public function actionIndex() {

        $compliance=Compliance::model()->findAll();

        $this->render('index',array("compliance"=>$compliance));
    }


    public function actionCreate() {

            $user2 = CustomerUser::model()->findByPK(Yii::app()->user->arUser->id);
            $model = new Compliance();
            if(isset($_POST["Compliance"]))
            {


                $model->attributes=$_POST["Compliance"];

                if($model->save())
                {
                    $this->redirect(array("admin"));
                }
            }
            $this->render("create",array("model"=>$model,"user2"=>$user2));

        }

        public function actionUpdate($id)
        {
            $user2 = CustomerUser::model()->findByPK(Yii::app()->user->arUser->id);
            $model=Compliance::model()->findByPk($id);
            if(isset($_POST["Compliance"]))
            {
                $model->attributes=$_POST["Compliance"];
                if($model->save())
                {
                    $this->redirect(array("admin"));
                }
            }
            $this->render("update",array("model"=>$model, 'user2'=>$user2));

        }

        public function actionView($id)
        {
            $model=Compliance::model()->findByPk($id);

            $this->render("view",array("model"=>$model));
        }

    public function actionAdmin() {
        $model=new Compliance('search');
        if(isset($_GET['Compliance']))
            $model->attributes=$_GET['Compliance'];
        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    public function actionCompliance_CSV() {

        if (Yii::app()->user->arUser->compliance==1) {

            $empresa = Yii::app()->user->arUser->customerId;
            $model=CActiveRecord::model("Compliance")->findAll();

            $query_A = 'SELECT * FROM ses_Compliance Comp where customerid='.$empresa;' ;';
            $query = Yii::app()->db->createCommand($query_A)->queryall();

            echo $this->renderPartial( 'compliance_CSV',array(
                'model'=>$model,'query'=>$query));

        }
    }
}