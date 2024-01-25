<?php

class FileAttachmentController extends Controller
{


    public function actionShow($filename)
    {

        $filename = Yii::app()->basePath . '/files/fileAttachment/' . CHtml::encode($filename);

        if (!strstr('/',$filename) && (substr($filename,-4)=='.pdf' || substr($filename,-4)=='.csv' || substr($filename,-5)=='.xlsx' || substr($filename,-5)=='.docx' || substr($filename,-4)=='.doc') && file_exists($filename)) {
        if(substr($filename,-5)=='.xlsx' || substr($filename,-5)=='.docx'){
            $typeDoc=substr($filename,-4);
        }else{
            $typeDoc=substr($filename,-3);
        }
            header('Content-type: application/'.$typeDoc);
            header('Content-transfer-encoding: binary');
            header('Content-length: ' . filesize($filename));
            readfile($filename);
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'The specified post cannot be found.');
        }
    }
}
