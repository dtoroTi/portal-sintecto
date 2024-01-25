<?php

class QualityPorcController extends Controller
{

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            $model = QualityPorc::model()->findByPk($id);
            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
            return $model;
        }else{
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
	
    private function getDates(){
        
        $dateAct = new \DateTime(" "); //'first day of this Month'
        $FechaActual=$dateAct->format('Y-m-d');
        
        if (!empty($_POST["Desde"]) && !empty($_POST["Hasta"])) {
            $fromDate = (new \DateTime(CHtml::encode($_POST['Desde'])))->format('Y-m-d');
            $untilDate = (new \DateTime(CHtml::encode($_POST['Hasta'])))->format('Y-m-d');
        } else {

            //first Year, Month and day del año en curso
            //$year_start = strtotime('first day of January', time());
            $date1 = new \DateTime("first day of this Month");
            $fromDate=$date1->format('Y-m-d');

            $date2 = new \DateTime(" "); //'first day of this Month'
            $untilDate=$date2->format('Y-m-d');
        }
        return ['fromDate'=>$fromDate, 'untilDate'=>$untilDate, 'fechaActual'=>$FechaActual];
    }

	public function actionResultoperations()
	{
		if (Yii::app()->user->isValidUser) {
           
            WebUser::logAccess("Vio resultado del area de operaciones.");
            $dates=$this->getDates();

            if(!empty($_POST["idUser"])){
				$idUser=$_POST["idUser"];
			}else{
				$idUser=Yii::app()->user->arUser->id;  
			}

            $query =User::model()->findByPk($idUser);
            $nameUser=$query['username'];

            $productivityonTime=QualityPorc::getAllproductivityonTime($dates['fromDate'], $dates['untilDate'], $idUser);  
            $productivityOutofTime=QualityPorc::getAllproductivityOutofTime($dates['fromDate'], $dates['untilDate'], $idUser);
            $opportunityStudies=QualityPorc::getAllOpportunityStudies($dates['fromDate'], $dates['untilDate'], $idUser);
            $totalStudies=QualityPorc::getAllTotalStudies($dates['fromDate'], $dates['untilDate'], $idUser);  
            $qualityStudies=QualityPorc::getAllQualityStudies($dates['fromDate'], $dates['untilDate'], $idUser); 
            $qualityPorc=QualityPorc::getqualityPorc();
            $goaluser=QualityPorc::getgoalUser($idUser);

            $this->render('resultoperations', array(
                'Desde' => $dates['fromDate'], 'Hasta' => $dates['untilDate'], 'productivityonTime'=>$productivityonTime, 'productivityOutofTime'=>$productivityOutofTime, 'opportunityStudies'=>$opportunityStudies, 'totalStudies'=>$totalStudies, 'qualityStudies'=>$qualityStudies, 'qualityPorc'=>$qualityPorc, 'idUser'=>$idUser, 'nameUser'=>$nameUser, 'goaluser'=>$goaluser
            ));

        }
	}

	public function ActionUpdate(){
        WebUser::logAccess("Actualizo porcentajes de calidad.");    
		//if (isset($_POST['seccion'])) {
			$data = "UPDATE ses_QualityPorc SET valueSection='".$_POST['seccion']."', valuePQR='".$_POST['pqr']."', valuePNC='".$_POST['pnc']."' WHERE id='1';";
			$query = Yii::app()->db->createCommand($data)->execute();
		//}
		$this->redirect(array('resultoperations'));
	}

    public function actionExportoffTime() {

        WebUser::logAccess("Genero export de detalle fuera de tiempo.");

        $from=$_GET['from'];
        $until=$_GET['until'];
        $csvOffTime=QualityPorc::getcsvOffTime($from, $until); 

        $value=$_GET['_export'];
        echo $this->renderPartial('csvOffTime',array('_export'=>$value, 'csvOffTime' => $csvOffTime));
    }

    public function actionExportproductopport() {

        WebUser::logAccess("Genero export de productividad y oportunidad.");

        $from=$_GET['from'];
        $until=$_GET['until'];
        $csvProductOpports=QualityPorc::getcsvProductOpport($from, $until); 

        $value=$_GET['_export'];
        echo $this->renderPartial('csvProductOpport',array('_export'=>$value, 'csvProductOpports' => $csvProductOpports));
    }

    public function actionExportQuality() {
        WebUser::logAccess("Genero export de calidad.");

        $from=$_GET['from'];
        $until=$_GET['until'];
        $csvQualitys=QualityPorc::getcsvQuality($from, $until); 

        $value=$_GET['_export'];
        echo $this->renderPartial('csvQuality',array('_export'=>$value, 'csvQualitys' => $csvQualitys));
    }


    public function actionExportOperations() {
        WebUser::logAccess("Genero export de gestión de operaciones.");

        $from=$_GET['from'];
        $until=$_GET['until'];
        $csvOperations=QualityPorc::getcsvOperations($from, $until); 
        $qualityPorc=QualityPorc::getqualityPorc();

        $value=$_GET['_export'];
        echo $this->renderPartial('csvOperations',array('_export'=>$value, 'csvOperations' => $csvOperations, 'qualityPorc'=>$qualityPorc));
    }

    public function actionExportForUser() {
        WebUser::logAccess("Genero export de datos detallados por funcionario.");

        if(!empty($_GET["idUser"])){
            $idUser=$_GET["idUser"];
        }else{
            $idUser=Yii::app()->user->arUser->id;  
        }

        $from=$_GET['from'];
        $until=$_GET['until'];
        $csvForUser=QualityPorc::getcsvForUser($from, $until, $idUser); 

        $value=$_GET['_export'];
        echo $this->renderPartial('csvForUser',array('_export'=>$value, 'csvForUser' => $csvForUser));
    }

    public function actionDetailresultquality(){

        $id = CHtml::encode($_POST['id']);
        $from= CHtml::encode($_POST['from']);
        $until= CHtml::encode($_POST['until']);
        $idUser= CHtml::encode($_POST['idUser']);

        $detalleResultQuality =Yii::app()->user->arUser->getQualityResult($from, $until, $idUser, $id);

        header('Content-type: application/json');
        echo CJSON::encode($detalleResultQuality);    
        Yii::app()->end();
    }

    public function actionExportFinishProccess() {
        WebUser::logAccess("Genero export de procesos finalizados.");

        $from=$_GET['from'];
        $until=$_GET['until'];
        $csvFinishProccess=QualityPorc::getFinishProccess($from, $until); 
 
        $value=$_GET['_export'];
        echo $this->renderPartial('csvFinishProccess',array('_export'=>$value, 'csvFinishProccess' => $csvFinishProccess));
    }
}