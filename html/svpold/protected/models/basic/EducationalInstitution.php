<?php

/**
 * This is the model class for table "{{EducationalInstitution}}".
 *
 * The followings are the available columns in table '{{EducationalInstitution}}':
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $city
 * @property string $country
 * @property string $email
 * @property string $contact
 * @property string $dateCreated
 *
 * The followings are the available model relations:
 * @property VerificationSection $verificationSection
 * @property BackgroundCheck $backgroundCheck
 */
class EducationalInstitution extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return EducationalInstitution the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{EducationalInstitution}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, phone', 'required'),
            array('name, phone, city, country, email, contact', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, phone, city, country, email, contact, dateCreated', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Nombre',
            'phone' => 'Teléfono',
            'city' => 'Ciudad',
            'country' => 'País',
            'email' => 'Email',
            'contact' => 'Contacto',
            'dateCreated'=>'Fecha'
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('country', $this->country, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('contact', $this->contact, true);
        $criteria->compare('dateCreated', $this->dateCreated, true);
        
        GridViewFilter::setFilter($this, 'search');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
                'pageSize' => 20,
            ),
        ));
    }

}
