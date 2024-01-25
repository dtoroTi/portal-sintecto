<?php

/**
 * This is the model class for table "{{Items}}".
 *
 * The followings are the available columns in table '{{Items}}':
 * @property integer $id
 * @property string $value
 * @property string $description
 * @property integer $parentId
 * @property string $listId
 * @property integer $sort
 * @property string $status
 *
 * The followings are the available model relations:
 * @property CustomerProduct[] $typeProductId
 */
class Items extends CActiveRecord{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Items the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{Items}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('value', 'length', 'max' => 100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, value,description,parentId,listId,sort,status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'typeProductId' => array(self::HAS_MANY, 'CustomerProduct', 'typeProductId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'value' => 'Valor',
            'description' => 'Descripcion',
            'parentId' => 'Item padre',
            'listId' => 'Lista dynamica',
            'sort' => 'Orden',
            'status' => 'Estado'
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
        $criteria->compare('value', $this->value, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('parentId', $this->parentId);
        $criteria->compare('listId', $this->listId);
        $criteria->compare('sort', $this->sort);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


}