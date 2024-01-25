<?php

/**
 * This is the model class for table "{{SdnType}}".
 *
 * The followings are the available columns in table '{{SdnType}}':
 * @property integer $id
 * @property string $name
 * 
 * @property SDN[] $sdns
 * @property SDN_Version[] $sdnVersions
 * 
 */
class SdnType extends CActiveRecord {

    const OFAC = 1;
    const UN_LIST = 2;
    const PEPS = 3;

    
    const UN_LIST_URL='https://scsanctions.un.org/resources/xml/en/consolidated.xml';
//    const UN_LIST_URL='https://scsanctions.un.org/resources/xml/en/consolidated.xml';

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{SdnType}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'length', 'max' => 45),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'sdnVersions' => array(self::HAS_MANY, 'SDN_Version', 'sdnTypeId'),
            'sdns' => array(self::HAS_MANY, 'SDN', 'sdnTypeId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Nombre De Lista',
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
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SdnType the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
