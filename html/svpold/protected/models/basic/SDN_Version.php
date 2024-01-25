<?php

/**
 * This is the model class for table "{{SDN_Version}}".
 *
 * The followings are the available columns in table '{{SDN_Version}}':
 * @property integer $id
 * @property string $downloaded
 * @property integer $isActive
 * 
 * @propery SdnType sdnType
 */
class SDN_Version extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SDN_Version the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{SDN_Version}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('downloaded, isActive, sdnTypeId', 'required'),
            array('isActive', 'boolean'),
            array('sdnTypeId', 'numerical'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, downloaded, isActive', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'sdnType' => array(self::BELONGS_TO, 'SdnType', 'sdnTypeId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'downloaded' => 'Descargada en',
            'isActive' => 'Esta Activa',
            'numRecords' => 'Número de Registros'
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
        $criteria->compare('downloaded', $this->downloaded, true);
        $criteria->compare('isActive', $this->isActive);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
