<?php

/**
 * This is the model class for table "{{VerificationInProduct}}".
 *
 * The followings are the available columns in table '{{VerificationInProduct}}':
 * @property integer $id
 * @property integer $verificationSectionTypeId
 * @property integer $customerProductId
 * @property integer $weight
 * @property integer $showOrder
 * @property float   $cost
 * @property float   $price
 * @property string $comments
 *
 * The followings are the available model relations:
 * @property VerificationSectionType $verificationSectionType
 * @property CustomerProduct $customerProduct
 */
class VerificationInProduct extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return VerificationInProduct the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{VerificationInProduct}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionTypeId, customerProductId, showOrder', 'required'),
            array('verificationSectionTypeId, customerProductId, weight, showOrder', 'numerical', 'integerOnly' => true),
            array('cost,price','numerical'),
            array('comments','safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, verificationSectionTypeId, customerProductId, weight, showOrder,comments', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'verificationSectionType' => array(self::BELONGS_TO, 'VerificationSectionType', 'verificationSectionTypeId'),
            'customerProduct' => array(self::BELONGS_TO, 'CustomerProduct', 'customerProductId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'verificationSectionTypeId' => 'Verification Section Type',
            'customerProductId' => 'Customer Product',
            'weight' => 'Weight',
            'showOrder' => 'Show Order',
            'cost' => 'Costo de sección',
            'price' => 'Precio de sección',
            'comments'=> 'Comentarios',
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
        $criteria->compare('verificationSectionTypeId', $this->verificationSectionTypeId);
        $criteria->compare('customerProductId', $this->customerProductId);
        $criteria->compare('weight', $this->weight);
        $criteria->compare('showOrder', $this->showOrder);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
