<?php

/**
 * This is the model class for table "{{Document}}".
 *
 * The followings are the available columns in table '{{Document}}':
 * @property integer $id
 * @property integer $backgroundCheckId
 * @property integer $verificationSectionId
 * @property string $filename
 * @property string $extension
 * @property string $name
 * @property string $description
 * @property string $seed
 * @property string $created
 * @property string $modified
 * @property string $pdfText
 *
 * The followings are the available model relations:
 * @property VerificationSection $verificationSection
 * @property BackgroundCheck $backgroundCheck
 */
class Document extends CActiveRecord {

    var $doc;
    var $dpi = 144;

    public static function getResolutionList() {
       return array(144=>'Normal',360=>'Alta',72=>'baja');    
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Document the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{Document}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('backgroundCheckId, created', 'required'),
            array('backgroundCheckId, verificationSectionId, size, showOrder', 'numerical', 'integerOnly' => true),
            array('filename, description, seed', 'length', 'max' => 255),
            array('extension, name', 'length', 'max' => 255),
            array('modified, imageSizeId,dpi', 'safe'),
            array('doc',
                'file',
                'types' => 'jpg, gif, png, pdf, xls, xlsx, doc, docx, rtf, cvs, txt, mp3',
                'maxSize' => 1024 * 1024 * 30, // 30MB
                'tooLarge' => 'El archivo es mide más de 30MB. Por favor utilice un archivo mas pequeño.',
                'allowEmpty' => true,
                'wrongType' => 'Los tipos de archivo permitidos son: doc,docx,pdf y jpg. Por favor utilice alguno de estos tipos',
            ),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, backgroundCheckId, verificationSectionId, filename, extension, name, description, seed, created, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'verificationSection' => array(self::BELONGS_TO, 'VerificationSection', 'verificationSectionId'),
            'backgroundCheck' => array(self::BELONGS_TO, 'BackgroundCheck', 'backgroundCheckId'),
            'imageSize' => array(self::BELONGS_TO, 'ImageSize', 'imageSizeId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'backgroundCheckId' => 'Background Check',
            'verificationSectionId' => 'Verification Section',
            'filename' => 'Filename',
            'extension' => 'Extension',
            'name' => 'Name',
            'description' => 'Description',
            'seed' => 'Seed',
            'created' => 'Created',
            'modified' => 'Modified',
            'doc' => 'Documento',
            'imageSizeId' => 'Tamaño de Imágen',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('backgroundCheckId', $this->backgroundCheckId);
        $criteria->compare('verificationSectionId', $this->verificationSectionId);
        $criteria->compare('filename', $this->filename, true);
        $criteria->compare('extension', $this->extension, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('seed', $this->seed, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('showOrder', $this->showOrder, true);
        $criteria->compare('imageSizeId', $this->imageSizeId);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array(
            'AutoTimestampBehavior' => array(
                'class' => 'application.components.AutoTimestampBehavior',
            )
        );
    }

    public function getAbsolutePath() {
        return $this->getAbsoluteDir() . "/" . $this->filename;
    }

    public function getAbsoluteDir() {
        $idStr = sprintf("%09d", $this->id);
        $dir = Yii::app()->params['docsDir'] . "/" . substr($idStr, 0, 3) . "/" . substr($idStr, 3, 3);
        return $dir;
    }

    public function checkAbsoluteDir() {
        $dir = $this->getAbsoluteDir();
        if (!file_exists($dir)) {
            mkdir($dir, 0770, true);
        }
    }

    public function setUniqueFilename() {
        $idStr = sprintf("%09d", $this->id);
        $this->filename = $idStr . "_" . uniqid();
    }

    protected function beforeDelete() {
        if (file_exists($this->getAbsolutePath()) && is_file($this->getAbsolutePath())) {
            unlink($this->getAbsolutePath());
        }
        return parent::beforeDelete();
    }

    static public function fileTypes() {
        return array(
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'gif' => 'image/jpeg',
            'pdf' => 'application/pdf',
            'txt' => 'application/txt',
            'rtf' => 'application/txt',
            'csv' => 'application/txt',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'doc' => 'application/msword',
            'docx' => 'application/msword',
        );
    }

    public function convertToStandardPDF() {
        // add Compression to 36pdi
        //exec("/usr/bin/pdf2ps -r36 '{$this->absolutePath}' '{$this->absolutePath}.ps' ");
        exec("/usr/bin/pdf2ps -r" . (int) $this->dpi . " '{$this->absolutePath}' '{$this->absolutePath}.ps' ");
        exec("/usr/bin/ps2pdf '{$this->absolutePath}.ps' '{$this->absolutePath}' ");
        unlink($this->absolutePath . ".ps");
        $this->size = filesize($this->absolutePath);
        $this->save();
    }

    public function cryptFile() {
        $iv = substr(md5($this->backgroundCheck->seed, true), 0, 8);
        $key = substr(md5($this->seed, true), 0, 24);

        $opts = array('iv' => $iv, 'key' => $key);
        $fp = fopen($this->absolutePath . ".enc", 'wb');
        stream_filter_append($fp, 'mcrypt.tripledes', STREAM_FILTER_WRITE, $opts);
        fwrite($fp, file_get_contents($this->absolutePath));
        fclose($fp);
        unlink($this->absolutePath);
        $this->filename.=".enc";
        $this->size = filesize($this->absolutePath);
        $this->save();
    }

    public function getDecryptedFile() {
        $iv = substr(md5($this->backgroundCheck->seed, true), 0, 8);
        $key = substr(md5($this->seed, true), 0, 24);

        $opts = array('iv' => $iv, 'key' => $key);

        if (!file_exists($this->absolutePath)) {
            Yii::log("The file [{$this->absolutePath}] of Study code {$this->backgroundCheck->code} has a problem", "error", "ZWF." . __CLASS__);
            throw new Exception("File  does not exists.");
        }

        $fp = fopen($this->absolutePath, 'rb');
        stream_filter_append($fp, 'mdecrypt.tripledes', STREAM_FILTER_READ, $opts);
        $data = stream_get_contents($fp);
        fclose($fp);
        return $data;
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->seed = $this->getNewSeed();
        }
        return parent::beforeSave();
    }

    public function getNewSeed() {
        return MD5('SEED' . date('r') . rand() . 'Security');
    }

    public function getTemporalSizedImage() {
        return $this->getTemporalSizedImageWithSize();
    }

    public function getTemporalSizedImageWithSize($maxWidth = 0, $maxHeight = 0) {
        $data = $this->getDecryptedFile();
        $filenameIn = Yii::app()->basePath . "/runtime/" . uniqid("fl_i_", true) . "." . CHtml::encode($this->extension);
        $filenameOut = Yii::app()->basePath . "/runtime/" . uniqid("fl_o_", true) . ".jpg";
        file_put_contents($filenameIn, $data);
        if ((int) $maxWidth == 0 || (int) $maxHeight == 0) {
            $maxWidth = $this->imageSize->maxWidth;
            $maxHeight = $this->imageSize->maxHeight;
        }
        exec("convert {$filenameIn} -resize {$maxWidth}x{$maxHeight} {$filenameOut}");
        unlink($filenameIn);
        return $filenameOut;
    }

    public function getTemporalRawFile() {
        $data = $this->getDecryptedFile();
        $filenameIn = Yii::app()->basePath . "/runtime/" . uniqid("fl_i_", true) . "." . CHtml::encode($this->extension);
        file_put_contents($filenameIn, $data);
        return $filenameIn;
    }

    public function getIsImage() {
        return in_array(strtolower($this->extension), array('jpg', 'png', 'gif'));
    }

    public function getIsPDF() {
        return in_array(strtolower($this->extension), array('pdf'));
    }

    static private function checkFilesWithoutLinkInDir($baseDir, $dir) {
        $files = array();
        if (is_dir($baseDir . "/" . $dir)) {
            $dh = opendir($baseDir . "/" . $dir);
            if ($dh) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != "." && $file != "..") {
                        if (substr($dir, 0, 5) != "/svp/") {
                            if (filetype($baseDir . "/" . $dir . "/" . $file) == 'dir') {
                                $files = array_merge($files, Document::checkFilesWithoutLinkInDir($baseDir, $dir . "/" . $file));
                            } else {
                                $document = Document::model()->findByAttributes(array('filename' => $file));
                                if (!$document) {
                                    $files[] = array(
                                        'filename' => $file,
                                        'dir' => $dir,
                                        'size' => filesize($baseDir . "/" . $dir . "/" . $file),
                                        'time' => filemtime($baseDir . "/" . $dir . "/" . $file));
                                }
                            }
                        } else {
                            // TODO: Check Signatures
                        }
                    }
                }
                closedir($dh);
            }
        }
        return $files;
    }

    static public function getFilesWithoutLink() {
        $files = Document::checkFilesWithoutLinkInDir(Yii::app()->params['docsDir'], null);
        return $files;
    }

    static public function deleteFileWithoutLink($deleteFilename) {
        if (Yii::app()->user->isAdmin) {
            $deleteFilename = preg_replace(
                    array('/\.\./', '/\/\./'), array('_', '_'), $deleteFilename);
            $document = Document::model()->findByAttributes(array('filename' => basename($deleteFilename)));
            if (!$document) {
                $filename = Yii::app()->params['docsDir'] . $deleteFilename;
                if (file_exists($filename)) {
                    WebUser::logAccess("Borro el archivo sin enlace : {$filename}");
                    unlink($filename);
                }
            }
        }
    }

    // This function uses the TCPDF library
    public function getPdfDocument(&$pdf) {
        $previewsType = NULL;
        $margins = $pdf->getMargins();
        $numberOfImageInRow = 0;
        $headerHeight = 20;
        $pageMaxWidth = $pdf->getPageWidth() - $margins['left'] - $margins['right'];
        /* @var $pdf TcPdf\SvpTcpdf */
        if ($this->isImage && $this->imageSizeId && $this->imageSizeId != ImageSize::FRONT_PAGE) {
            if ($previewsType != $this->imageSizeId) {
                $orientation = $this->imageSize->landscape == 1 ? 'L' : 'P';
                $pdf->addPage($orientation);
                $pageMaxWidth = $pdf->getPageWidth() - $margins['left'] - $margins['right'];
            }
            $previewsType = $this->imageSizeId;
            $imageFile = $this->temporalSizedImage;
            $imageSize = getimagesize($imageFile);
            $x = $pdf->getX();
            $y = $pdf->getY();
            if ($this->imageSize->imagesPerRow == 1) {
                if ($imageSize[0] < $this->imageSize->maxWidth) {
                    $x = $pdf->getX() + round(($pageMaxWidth - $imageSize[0]) / 2 / $this->imageSize->maxWidth * $pageMaxWidth);
                } else {
                    $x = $pdf->getX();
                }
                if ($y > 200) {
                    $pdf->addPage($orientation);
                    $y = $headerHeight;
                }
                $pdf->Image($imageFile, $x, $y, $pageMaxWidth);
                $y = $y + ($this->imageSize->maxHeight + 30 ) * 196 / $pageMaxWidth;
                $numberOfImageInRow = 0;
            } else if ($this->imageSize->imagesPerRow > 1) {
                $x = $numberOfImageInRow * ($this->imageSize->maxWidth + ($this->imageSize->maxWidth - $imageSize[0]) / 2 + 100) * 260 / $pageMaxWidth + 22;
                if ($y > 120) {
                    $pdf->addPage($orientation);
                    $y = $headerHeight;
                }
                $pdf->Image($imageFile, $x, $y);
                $numberOfImageInRow++;
                if ($numberOfImageInRow >= $this->imageSize->imagesPerRow) {
                    $numberOfImageInRow = 0;
                    $x = 0;
                    $y = $y + ($this->imageSize->maxHeight + 30 ) * 196 / $pageMaxWidth;
                }
            }
            $pdf->SetX($x);
            $pdf->SetY($y);
            unlink($imageFile);
        } else if ($this->isPDF) {
            $pdfFile = $this->temporalRawFile;
            if (file_exists($pdfFile)) {
                $pagecount = $pdf->setSourceFile($pdfFile);
                for ($i = 1; $i <= $pagecount; $i++) {
                    $tplidx = $pdf->importPage($i, '/MediaBox');
                    $pdf->addPage();
                    $pdf->useTemplate($tplidx, $margins['left'], $margins['top'], $pageMaxWidth
                    );
                }
                unlink($pdfFile);
            }
            $pdf->SetX(40);
            $pdf->SetY(210);
        }
    }

    //PARA TUS DATOS
    static public function findByTusDatosFile($backgroundCheckId,$filename) {
       
            $document = Document::model()->findByAttributes(array('name' => $filename,'backgroundCheckId' => $backgroundCheckId));
            return $document;
        
    }

    //02-02-2022 Almacenar documentos de Formulario dinamico
    //Natalia Henao M
    public function updateFromJson($dateresponse, $idbackground){

        $ans=substr($dateresponse['file'], 2);
        $docBase64 = rtrim($ans, "'");

        $pathname = $dateresponse['filename'];
        $namedoc = pathinfo($pathname, PATHINFO_FILENAME);
        //$namedoc = explode(".", $dateresponse['filename']);

        $path = $dateresponse['filename'];
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        //$extension = explode(".", $namedoc[1]);

        $base64=$docBase64;
        $data = base64_decode($base64);

        $path=tempnam(Yii::app()->getRuntimePath(), 'fd_');;
        $archivo = $path;

        if($extension=='pdf'){
            $pdf=fopen($archivo,"w");
            fwrite ($pdf,$data);
            fclose ($pdf);
        }

        if($extension=='png' || $extension=='jpg'){
            $img=fopen($archivo,"wb");
            fwrite ($img,$data);
            fclose( $img ); 
        }
        
        chmod($archivo, 0775);

        if ($archivo != "" && file_exists($archivo)) {

            $this->backgroundCheckId=$idbackground;
            $this->name=$namedoc;
            $this->extension=$extension;
            $this->description = 'Archivo agregado desde el Formulario Dinámico';
            $this->size = filesize($archivo);

            //Salvar el archivo
            if ($this->save()) {

                //Crear nuevo nombre y obtener ruta absoluta del archivo
                $this->checkAbsoluteDir();
                $this->setUniqueFilename();

                //Copia el archivo a la posición establecida
                    if (copy($archivo, $this->absolutePath) && $this->save()) {
                        //echo "Se pudo guardar\n";
                        if ($this->isPdf) {
                            //$this->dpi=360;
                            //$this->convertToStandardPDF();
                        }
                        //Encripta los archivos
                        $this->cryptFile();
                        unlink($archivo);
                    }else{
                        echo "Se creo registro. No se pudo guardar";
                    }
                //return "Archivo guardado";
            }else {
                throw new CHttpException(400, 'No se logró guardar el archivo adjunto. Por favor cárguelo manualmente.');
            }  
        }
    }

    public function documentStudyChannel($nombredoc, $extension, $docBase64, $backgroundcheckid)
    {
        $data = base64_decode($docBase64);
        $path=tempnam(Yii::app()->getRuntimePath(), 'mp_');
        $archivo = $path;

        if($extension=='pdf'){
            $pdf=fopen($archivo,"w");
            fwrite ($pdf,$data);
            fclose ($pdf);
        }
        if($extension=='png' || $extension=='jpg'){
            $img=fopen($archivo,"wb");
            fwrite ($img,$data);
            fclose( $img ); 
        }

        chmod($archivo, 0775);
        if ($archivo != "" && file_exists($archivo)) {

            $this->backgroundCheckId=$backgroundcheckid;
            $this->name=$nombredoc;
            $this->extension=$extension;
            $this->description = 'Archivo agregado desde el canal de mi planilla';
            $this->size = filesize($archivo);

            //Salvar el archivo
            if ($this->save()) {

                //Crear nuevo nombre y obtener ruta absoluta del archivo
                $this->checkAbsoluteDir();
                $this->setUniqueFilename();

                //Copia el archivo a la posición establecida	
                if (copy($archivo, $this->absolutePath) && $this->save()) {
                    
                    if ($this->isPdf) {
                        //$this->dpi=360;
                        $this->convertToStandardPDF();
                    }

                    //Encripta los archivos
                    $this->cryptFile();
                    unlink($archivo);
                }else{
                    echo "Se creo registro. No se pudo guardar";
                }
            }else {
                throw new CHttpException(400, 'No se logró guardar el archivo adjunto. Por favor cárguelo manualmente.');
            } 
        }
    }   

}
