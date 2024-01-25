<?php

/**
 * This is the model class for table "{{File}}".
 *
 * The followings are the available columns in table '{{File}}':
 * @property integer $id
 * @property string $filename
 * @property string $extension
 * @property string $name
 * @property string $description
 * @property string $seed
 * @property string $created
 * @property string $modified
 * @property integer $size
 * @property integer $fileTypeId
 *
 * The followings are the available model relations:
 * @property FileType $FileType
 * @property User[] $users
 */
class File extends CActiveRecord {

    public $file;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{File}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created, fileTypeId', 'required'),
            array('size, fileTypeId', 'numerical', 'integerOnly' => true),
            array('filename, description, seed', 'length', 'max' => 255),
            array('extension, name', 'length', 'max' => 45),
            array('modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, filename, extension, name, description, seed, created, modified, size, fileTypeId', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'fileType' => array(self::BELONGS_TO, 'FileType', 'fileTypeId'),
            'userSignature' => array(self::HAS_ONE, 'User', 'signatureId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'filename' => 'Filename',
            'extension' => 'Extension',
            'name' => 'Name',
            'description' => 'Description',
            'seed' => 'Seed',
            'created' => 'Created',
            'modified' => 'Modified',
            'size' => 'Size',
            'fileTypeId' => 'Ses File Type',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('filename', $this->filename, true);
        $criteria->compare('extension', $this->extension, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('seed', $this->seed, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('size', $this->size);
        $criteria->compare('fileTypeId', $this->fileTypeId);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return File the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'AutoTimestampBehavior' => array(
                'class' => 'application.components.AutoTimestampBehavior',
            )
        );
    }

    public function getNewSeed() {
        return MD5('SEED' . date('r') . rand() . 'Security');
    }

    public function getAbsolutePath() {
        return $this->getAbsoluteDir() . "/" . $this->filename;
    }

    public function getAbsoluteDir() {
        $idStr = sprintf("%09d", $this->id);
        $dir = Yii::app()->params['docsDir'] . "/svp/" . substr($idStr, 0, 3) . "/" . substr($idStr, 3, 3);
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

    public function beforeDelete() {
        if (file_exists($this->getAbsolutePath()) && is_file($this->getAbsolutePath())) {
            unlink($this->getAbsolutePath());
        }
        return parent::beforeDelete();
    }

    public function cryptFile() {
        $iv = substr(md5($this->id, true), 0, 8);
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
        $iv = substr(md5($this->id, true), 0, 8);
        $key = substr(md5($this->seed, true), 0, 24);

        $opts = array('iv' => $iv, 'key' => $key);

        if (!file_exists($this->absolutePath)) {
            Yii::log("The file [{$this->absolutePath}] has a problem", "error", "ZWF." . __CLASS__);
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

    public function getImageFileSized($maxWidth, $maxHeight,$extension="png") {
        $data = $this->getDecryptedFile();
        $filenameIn = Yii::app()->basePath . "/runtime/" . uniqid("fl_i_", true) . "." . CHtml::encode($this->extension);
        $filenameOut = Yii::app()->basePath . "/runtime/" . uniqid("fl_o_", true) . ".".$extension;
        file_put_contents($filenameIn, $data);
        exec("convert {$filenameIn} -resize {$maxWidth}x{$maxHeight} {$filenameOut}");
        unlink($filenameIn);
        return $filenameOut;
    }

    public function getImageFile() {
        $data = $this->getDecryptedFile();
        $filenameIn = Yii::app()->basePath . "/runtime/" . uniqid("fl_i_", true) . "." . CHtml::encode($this->extension);
        file_put_contents($filenameIn, $data);
        return $filenameIn;
    }

    public function setSizeUncriptedFilename($maxWidth, $maxHeight) {

        if (file_exists($this->absolutePath)) {
            $filenameIn = $this->absolutePath;
            $filenameOut = Yii::app()->basePath . "/runtime/" . uniqid("fl_o_", true) . ".png";
        }
        exec("convert {$filenameIn} -resize {$maxWidth}x{$maxHeight} {$filenameOut}");
        unlink($this->absolutePath);
        rename($filenameOut,$this->absolutePath);
        return $filenameOut;
    }

}
