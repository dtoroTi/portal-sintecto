<?php

/**
 * This is the model class for table "{{Pqr}}".
 *
 * The followings are the available columns in table '{{Pqr}}':
 * @property integer $id
 * @property integer $nombreId
 * @property integer $tipoReclamoId
 * @property string $nota
 * @property string $descripcion
 * @property datetime $fechaReclamo
 * @property datetime $estadoReclamo
 * @property string $fechaRespuesta
 */
class TablaPqr extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{Pqr}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombreId, nota', 'length', 'max'=>100),
			array('tipoReclamoId', 'length', 'max'=>100),
			array('descripcion', 'length', 'max'=>200),
			array('estadoReclamo', 'length', 'max'=>10),
			array('fechaReclamo, fechaRespuesta', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombreId, tipoReclamoId, nota, descripcion, fechaReclamo, estadoReclamo, fechaRespuesta', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'nombreId'),
			'tipoPqr' => array(self::BELONGS_TO, 'TipoPqr', 'tipoReclamoId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreId' => 'nombre Cliente',
			'tipoReclamoId' => 'Tipo Reclamo',
			'nota' => 'Nota',
			'descripcion' => 'Descripcion',
			'fechaReclamo' => 'Fecha y Hora del Reclamo',
			'estadoReclamo' => 'Estado Reclamo',
			'fechaRespuesta' => 'Fecha y hora de Respuesta',
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
		$criteria->compare('nombreId',$this->nombreId,true);
		$criteria->compare('tipoReclamoId',$this->tipoReclamoId,true);
		$criteria->compare('nota',$this->nota,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('fechaReclamo',$this->fechaReclamo,true);
		$criteria->compare('estadoReclamo',$this->estadoReclamo,true);
		$criteria->compare('fechaRespuesta',$this->fechaRespuesta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TablaPqr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
