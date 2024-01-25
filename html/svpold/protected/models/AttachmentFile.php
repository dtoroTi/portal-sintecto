<?php

/**
 * This is the model class for table "{{AttachmentFile}}".
 *
 * The followings are the available columns in table '{{AttachmentFile}}':
 * @property integer $id
 * @property string $name_doc
 * @property string $fileName
 * @property string $fileName1
 * @property string $fileName2
 * @property string $fileName3
 * @property string $fileName4
 * @property string $questionnaire
 * @property string $requirements
 * @property integer $idFDJson
 * 
 * 
 * @property DynamicFormJSON $idFDJson
 */
class AttachmentFile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{AttachmentFile}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_doc, fileName, fileName1, fileName2, fileName3, fileName4', 'length', 'max'=>255),
			array('questionnaire, requirements, idFDJson', 'safe'),
			array('name_doc, fileName, requirements, idFDJson', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name_doc, fileName, fileName1, fileName2, fileName3, fileName4', 'safe', 'on'=>'search'),
			array('fileName, fileName1, fileName2, fileName3, fileName4', 'file', 'types'=>'csv, xlsx, pdf, docx, doc', 'safe' => false,'allowEmpty'=>true, 'on'=>'update'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'dynamicFormJSON' => array(self::BELONGS_TO, 'DynamicFormJSON', 'idFDJson'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name_doc' => 'Nombre del Documento',
			'fileName' => 'Archivo Adjunto',
			'fileName1' => 'Archivo Adjunto',
			'fileName2' => 'Archivo Adjunto',
			'fileName3' => 'Archivo Adjunto',
			'fileName4' => 'Archivo Adjunto',
			'questionnaire'=>'Formato Formulario Dinámico',
			'requirements'=>'Documentos o Procesos Requeridos',
			'idFDJson'=>'Formato Formulario Dinámico'
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name_doc',$this->name_doc,true);
		$criteria->compare('fileName',$this->fileName,true);
		$criteria->compare('fileName1',$this->fileName1,true);
		$criteria->compare('fileName2',$this->fileName2,true);
		$criteria->compare('fileName3',$this->fileName3,true);
		$criteria->compare('fileName4',$this->fileName4,true);
		$criteria->compare('questionnaire',$this->questionnaire,true);
		$criteria->compare('requirements',$this->requirements,true);
		$criteria->compare('idFDJson',$this->idFDJson,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AttachmentFile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getAbsulotePath($value){
        
		$attachment = AttachmentFile::model()->findByPK($value);

		if ($attachment) {
			$fileName=$attachment->fileName;
			$fileName1=$attachment->fileName1;
			$fileName2=$attachment->fileName2;
			$fileName3=$attachment->fileName3;
			$fileName4=$attachment->fileName4;
			
			$files=[
				$fileName,
				$fileName1,
				$fileName2,
				$fileName3,
				$fileName4
			];
			
			return $files;
		}
	}

	public function getFullPath($filename){
		return Yii::app()->basePath.'/files/fileAttachment/'.$filename;
	}

	
}
