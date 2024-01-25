<?php

class SvpFileController extends Controller
{


    public function actionShow($filename)
    {

        $filename = Yii::app()->basePath . '/files/instructivos/' . CHtml::encode($filename);

        if (!strstr('/',$filename) && substr($filename,-4)=='.pdf' && file_exists($filename)) {

            header('Content-type: application/pdf');
            header('Content-transfer-encoding: binary');
            header('Content-length: ' . filesize($filename));
            readfile($filename);
            Yii::app()->end();
        } else {
            
            throw new CHttpException(404, 'The specified post cannot be found.');
        }
    }
}
