<?php

require_once Yii::app()->basePath . '/extensions/pdf2text/vendor/autoload.php';

class DocumentController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionDeleteDocument($id) {
        $document = Document::model()->findByPK($id);
// DELETE de file
        if ($document) {
            if ($document->id) {
                WebUser::logAccess("Borro el archivo :{$document->name}.{$document->extension} [{$document->size}]", $document->backgroundCheck->code);
                $code = $document->backgroundCheck->code;
                $document->delete();
            }
            $url = $this->createUrl('/backgroundCheck/update/', array('code' => $code, 'activeTab' => 'docs'));
        } else {
            $url = $this->createUrl('/backgroundCheck/admin/');
        }
        $this->redirect($url, true);
    }

    public function actionUpdate($code) {

        if (isset($_POST['documents'])) {
            $backgroundCheck = BackgroundCheck::model()->findByCode($code);
            WebUser::logAccess("Actualizo los archivos ", $backgroundCheck->code);
            foreach ($_POST['documents'] as $key => $detail) {
                if ($key == 'new') {
                    $document = new Document;
                    $document->attributes = $detail;
                    $document->backgroundCheckId = $backgroundCheck->id;
                    $document->doc = CUploadedFile::getInstanceByName('documents[new][doc]');

                    // 18-12-2017
                    // TODO: ARREGLO TEMPORAL PARA LA ARMADA
                    // GRUPO DE CLIENTE 239
                    // CAMBIAR PARA QUE NO SE HAGA SOLO PARA ESTE CLIENTE
                    /*if(isset($document->doc->type) && $document->doc->type == 'application/pdf'
                        && $backgroundCheck->customer->customerGroupId == 239){
                        $parser = new \Smalot\PdfParser\Parser();

                        try {
                            $pdf = $parser->parseFile($document->doc->tempName);
                            $output = $pdf->getText();
                            $document->pdfText = $output;    
                        } catch (Exception $e) {
                            Yii::app()->user->setFlash('documents', "Error extrayendo el texto del archivo PDF");
                            $document->pdfText = null;
                        }
                    }*/
                    // Se quita la funcionalidad 19/04/2018

                    if ($document->doc) {
                        $docSave = false;
                        try {
                            $docSave = $document->save();
                        } catch (CException $ex) {
                            WebUser::logAccess("Error en archivo:".$ex->getMessage(), $backgroundCheck->code);                            
                        }

                        if ($docSave) {
                            $document->checkAbsoluteDir();
                            $document->setUniqueFilename();
                            $pathinfo = pathinfo($document->doc->name);
                            if (trim($document->name) == "") {
                                $docnamess=str_replace(".","_",$pathinfo['filename']) ;

                                $document->name = $docnamess;
                            }
                           /* if (trim($document->name) == "") {
                                $document->name = $pathinfo['filename'];
                            }*/
                            $document->extension = strtolower($pathinfo['extension']);
                            $filename = $document->absolutePath;
                            $document->doc->saveAs($filename);
                            $document->size = filesize($filename);
                            if (!$document->save()) {
                                Yii::app()->user->setFlash('documents', "Error cargando el archivo");
                            }
                            if ($document->isPdf) {
                                
                                
                                $document->convertToStandardPDF();
                            }
                            $document->cryptFile();
                        } else {
// Error Saving
                            foreach ($document->errors as $errorField => $errors) {
                                foreach ($errors as $error) {
                                    Yii::app()->user->setFlash('documents', "Error {$errorField}:{$error}.");
                                }
                            }
                        }
                    }
                } else {
                    $document = Document::model()->findByPK($key);
                    if ($document) {
                        $document->attributes = $detail;
                        if (!$document->save()) {
                            Yii::app()->user->setFlash('documents', "Error Saving [{$key}] :" . serialize($document->errors));
                            WebUser::logAccess("Error cargando archivo:". serialize($document->errors), $backgroundCheck->code);                            
                        }
                    }
                }
            }
            $url = $this->createUrl('/backgroundCheck/update/', array('code' => $code, 'activeTab' => 'docs'));
            $this->redirect($url, true);
        }
    }

    public function actionFile($id) {
        $types = Document::fileTypes();
        $document = Document::model()->findByPK($id);
        if ($document && isset($types[$document->extension])) {
            $filename = $document->absolutePath;
            header('Content-Type: ' . $types[$document->extension]);
            header('Content-Length: ' . filesize($filename));
            echo $document->getDecryptedFile();
            die();
        }
    }

    public function actionFileSaveAs($id) {
        $types = Document::fileTypes();
        $document = Document::model()->findByPK($id);
        if ($document && isset($types[$document->extension])) {
            $file = $document->getDecryptedFile();
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Pragma: public");
            header('Content-Type: ' . $types[$document->extension]);
            header('Content-disposition: attachment; filename="' . $document->name . '.' . $document->extension . '"');
            header('Content-Length: ' . strlen($file));
            echo $file;
            die();
        }
    }

    public function actionCheckFilesWithoutLink() {
        if (Yii::app()->user->isSuperAdmin) {
            if (isset($_POST['File'])) {
                foreach ($_POST['File'] as $key => $val) {
                    $filenameToDelete = CHtml::encode($val);
                    Document::deleteFileWithoutLink($filenameToDelete);
                }
            }
            if (isset($_POST['Inf'])) {
                foreach ($_POST['Inf'] as $key => $val) {
                    $filenameToDelete = CHtml::encode($val);
                    BackgroundCheck::deleteFileWithoutLink($filenameToDelete);
                }
            }
            $this->render('checkFilesWithoutLink', array(
                'documents' => Document::getFilesWithoutLink(),
                'reports' => BackgroundCheck::getFilesWithoutLink(),));
        }
    }

}
