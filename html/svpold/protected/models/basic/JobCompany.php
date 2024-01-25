<?php

/**
 * This is the model class for table "{{JobCompany}}".
 *
 * The followings are the available columns in table '{{JobCompany}}':
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $city
 * @property string $country
 * @property string $email
 * @property string $contact
 * @property string $dateCreated
 */
class JobCompany extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{JobCompany}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, city', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>45),
			array('country, contact', 'length', 'max'=>128),
			array('email', 'length', 'max'=>64),
			array('dateCreated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, phone, city, country, email, contact, dateCreated', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Nombre',
			'phone' => 'Teléfono',
			'city' => 'Ciudad',
			'country' => 'Pais',
			'email' => 'Email',
			'contact' => 'Contacto',
			'dateCreated' => 'Fecha',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('dateCreated',$this->dateCreated,true);

		GridViewFilter::setFilter($this, 'search');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
				'pageSize' => 30,
            ),
            'sort' => array(
                'defaultOrder' => 'name ASC',
            ),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JobCompany the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
//coment
