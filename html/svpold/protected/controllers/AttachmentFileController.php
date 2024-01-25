<?php
require_once(Yii::app()->basePath . '/components/SvpTcPdf.php');
class AttachmentFileController extends Controller
{

    public $defaultAction = 'admin';


    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

	public function actionCreate()
	{
		$model=new AttachmentFile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['AttachmentFile'])){
            $rnd = rand(0,9999);
            $model->attributes = $_POST['AttachmentFile'];
            
            $uploadedFile=CUploadedFile::getInstance($model,'fileName');
            $uploadedFile1=CUploadedFile::getInstance($model,'fileName1');
            $uploadedFile2=CUploadedFile::getInstance($model,'fileName2');
            $uploadedFile3=CUploadedFile::getInstance($model,'fileName3');
            $uploadedFile4=CUploadedFile::getInstance($model,'fileName4');

            if(isset($uploadedFile) && $uploadedFile != null){
                $pos = strpos($uploadedFile->getName(), '.php');
                if($pos!==false){
                    $model->addError('fileName', "Error el archivo contiene una extensión no permitida");
                    $errors = $model->errors;
                    $this->render('update', array(
                        'model' => $model,
                        'errors'=> $errors
                    ));
                    return;
                }
            }    
            if(isset($uploadedFile) && $uploadedFile != null){
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->fileName = $fileName;
            }

            if(isset($uploadedFile1) && $uploadedFile1 != null){
                $pos = strpos($uploadedFile1->getName(), '.php');
                if($pos!==false){
                    $model->addError('fileName1', "Error el archivo contiene una extensión no permitida");
                    $errors = $model->errors;
                    $this->render('update', array(
                        'model' => $model,
                        'errors'=> $errors
                    ));
                    return;
                }
            }  
            if(isset($uploadedFile1) && $uploadedFile1 != null){
                $fileName1 = "{$rnd}-{$uploadedFile1}";  // random number + file name
                $model->fileName1 = $fileName1;
            }

            if(isset($uploadedFile2) && $uploadedFile2 != null){
                $pos = strpos($uploadedFile2->getName(), '.php');
                if($pos!==false){
                    $model->addError('fileName2', "Error el archivo contiene una extensión no permitida");
                    $errors = $model->errors;
                    $this->render('update', array(
                        'model' => $model,
                        'errors'=> $errors
                    ));
                    return;
                }
            }  
            if(isset($uploadedFile2) && $uploadedFile2 != null){
                $fileName2 = "{$rnd}-{$uploadedFile2}";  // random number + file name
                $model->fileName2 = $fileName2;
            }

            if(isset($uploadedFile3) && $uploadedFile3 != null){
                $pos = strpos($uploadedFile3->getName(), '.php');
                if($pos!==false){
                    $model->addError('fileName3', "Error el archivo contiene una extensión no permitida");
                    $errors = $model->errors;
                    $this->render('update', array(
                        'model' => $model,
                        'errors'=> $errors
                    ));
                    return;
                }
            }  
            if(isset($uploadedFile3) && $uploadedFile3 != null){
                $fileName3 = "{$rnd}-{$uploadedFile3}";  // random number + file name
                $model->fileName3 = $fileName3;
            }

            if(isset($uploadedFile4) && $uploadedFile4 != null){
                $pos = strpos($uploadedFile4->getName(), '.php');
                if($pos!==false){
                    $model->addError('fileName4', "Error el archivo contiene una extensión no permitida");
                    $errors = $model->errors;
                    $this->render('update', array(
                        'model' => $model,
                        'errors'=> $errors
                    ));
                    return;
                }
            }  
            if(isset($uploadedFile4) && $uploadedFile4 != null){
                $fileName4 = "{$rnd}-{$uploadedFile4}";  // random number + file name
                $model->fileName4 = $fileName4;
            }

            if ($model->save()) {
                if(isset($uploadedFile) && $uploadedFile != null){
                    $uploadedFile->saveAs(Yii::app()->basePath.'/files/fileAttachment/'.$fileName);         
                }
                
                if(isset($uploadedFile1) && $uploadedFile1 != null){
                    $uploadedFile1->saveAs(Yii::app()->basePath.'/files/fileAttachment/'.$fileName1);         
                }

                if(isset($uploadedFile2) && $uploadedFile2 != null){
                    $uploadedFile2->saveAs(Yii::app()->basePath.'/files/fileAttachment/'.$fileName2);         
                }

                if(isset($uploadedFile3) && $uploadedFile3 != null){
                    $uploadedFile3->saveAs(Yii::app()->basePath.'/files/fileAttachment/'.$fileName3);         
                }

                if(isset($uploadedFile4) && $uploadedFile4 != null){
                    $uploadedFile4->saveAs(Yii::app()->basePath.'/files/fileAttachment/'.$fileName4);         
                }

                WebUser::logAccess("Creo el archivo :" . $model->name_doc);
                $this->redirect(array('admin'));
            }
        }

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if (isset($_POST['AttachmentFile'])) {

            /*if($model->fileName!="" || ){
                $_POST['AttachmentFile']['fileName'] = $model->fileName;
                $_POST['AttachmentFile']['fileName1'] = $model->fileName1;
                //$model->logo=$_POST['Customer']['logo'];
            }
            else {*/
                $rnd = $model->id;
                $uploadedFile=CUploadedFile::getInstance($model,'fileName');
                $uploadedFile1=CUploadedFile::getInstance($model,'fileName1');
                $uploadedFile2=CUploadedFile::getInstance($model,'fileName2');
                $uploadedFile3=CUploadedFile::getInstance($model,'fileName3');
                $uploadedFile4=CUploadedFile::getInstance($model,'fileName4');

               if(isset($uploadedFile) && $uploadedFile != null){

                    $pos = strpos($uploadedFile->getName(), '.php');
                    if($pos!==false){
                       
                        $model->addError('fileName', "Error el archivo contiene una extensión no permitida");

                        $errors = $model->errors;
                        $this->render('update', array(
                            'model' => $model,
                            'errors'=> $errors
                        ));
                        return;
                    }

                }
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                if(isset($uploadedFile) && $uploadedFile != null)
                {
                    $model->fileName = $fileName;
                }


                if(isset($uploadedFile1) && $uploadedFile1 != null){

                    $pos = strpos($uploadedFile1->getName(), '.php');
                    if($pos!==false){
                       
                        $model->addError('fileName1', "Error el archivo contiene una extensión no permitida");

                        $errors = $model->errors;
                        $this->render('update', array(
                            'model' => $model,
                            'errors'=> $errors
                        ));
                        return;
                    }

                }
                $fileName1 = "{$rnd}-{$uploadedFile1}";  // random number + file name
                if(isset($uploadedFile1) && $uploadedFile1 != null)
                {
                    $model->fileName1 = $fileName1;
                }

                if(isset($uploadedFile2) && $uploadedFile2 != null){

                    $pos = strpos($uploadedFile2->getName(), '.php');
                    if($pos!==false){
                       
                        $model->addError('fileName2', "Error el archivo contiene una extensión no permitida");

                        $errors = $model->errors;
                        $this->render('update', array(
                            'model' => $model,
                            'errors'=> $errors
                        ));
                        return;
                    }

                }
                $fileName2 = "{$rnd}-{$uploadedFile2}";  // random number + file name
                if(isset($uploadedFile2) && $uploadedFile2 != null)
                {
                    $model->fileName2 = $fileName2;
                }

                if(isset($uploadedFile3) && $uploadedFile3 != null){

                    $pos = strpos($uploadedFile3->getName(), '.php');
                    if($pos!==false){
                       
                        $model->addError('fileName3', "Error el archivo contiene una extensión no permitida");

                        $errors = $model->errors;
                        $this->render('update', array(
                            'model' => $model,
                            'errors'=> $errors
                        ));
                        return;
                    }

                }
                $fileName3 = "{$rnd}-{$uploadedFile3}";  // random number + file name
                if(isset($uploadedFile3) && $uploadedFile3 != null)
                {
                    $model->fileName3 = $fileName3;
                }

                if(isset($uploadedFile4) && $uploadedFile4 != null){

                    $pos = strpos($uploadedFile4->getName(), '.php');
                    if($pos!==false){
                       
                        $model->addError('fileName4', "Error el archivo contiene una extensión no permitida");

                        $errors = $model->errors;
                        $this->render('update', array(
                            'model' => $model,
                            'errors'=> $errors
                        ));
                        return;
                    }

                }
                $fileName4 = "{$rnd}-{$uploadedFile4}";  // random number + file name
                if(isset($uploadedFile4) && $uploadedFile4 != null)
                {
                    $model->fileName4 = $fileName4;
                }

            //}
            $modelOld=$model->getAttributes(true);

            $model->attributes = $_POST['AttachmentFile'];

            $modelNew=$model->getAttributes(true);

            WebUser::logRecordChange("Cambio el archivo: {$model->name_doc}", null, get_class($model), $modelNew, $modelOld);
            
            if ($model->save()){
                //if(!empty($uploadedFile))  // check if uploaded file is set or not
                if(isset($uploadedFile) && $uploadedFile != null){
                    $uploadedFile->saveAs(Yii::app()->basePath.'/files/fileAttachment/'.$fileName);
                }

                if(isset($uploadedFile1) && $uploadedFile1 != null){
                    $uploadedFile1->saveAs(Yii::app()->basePath.'/files/fileAttachment/'.$fileName1);
                }

                if(isset($uploadedFile2) && $uploadedFile2 != null){
                    $uploadedFile2->saveAs(Yii::app()->basePath.'/files/fileAttachment/'.$fileName2);
                }

                if(isset($uploadedFile3) && $uploadedFile3 != null){
                    $uploadedFile3->saveAs(Yii::app()->basePath.'/files/fileAttachment/'.$fileName3);
                }

                if(isset($uploadedFile4) && $uploadedFile4 != null){
                    $uploadedFile4->saveAs(Yii::app()->basePath.'/files/fileAttachment/'.$fileName4);
                }


                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
	}


	public function actionIndex()
	{
    $this->actionAdmin();
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AttachmentFile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AttachmentFile']))
			$model->attributes=$_GET['AttachmentFile'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
        if (Yii::app()->user->getIsByRole()) {
			return AttachmentFile::model()->findByPk($id);
		}else if (Yii::app()->user->isAdmin) {
            $model=AttachmentFile::model()->findByPk($id);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }else{
            throw new CHttpException(404, 'The requested page does not exist.');
        }
	}


    public function actionDelete($id) {

            if (Yii::app()->user->isAdmin) {

                if (Yii::app()->request->isPostRequest) {
                    // we only allow deletion via POST request
                    $model=$this->loadModel($id);
                    if ($model) {
                        $modelName = $model->name_doc;
                        WebUser::logAccess("Borro el documento :" . $modelName);
                        $model->delete();
    
                        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                        if (!isset($_GET['ajax'])) {
                            Yii::app()->user->setFlash('notice', "Se ha borrado el documento : " . $modelName);
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                        }
                    }
                } else{
                    throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
                }
            }    
    }
}