<?php

/**
 * This is the model class for table "{{UserType}}".
 *
 * The followings are the available columns in table '{{UserType}}':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property User[] $users
 */
class UserType extends CActiveRecord {

  const SES_DOMAIN = "svision.co";
  
  const SES_SUPERADMIN = 1;
  const SES_ADMIN = 2;
  const SES_USER = 3;
  const SES_BILLING = 6;
  const CUSTOMER_MANAGER = 4;
  const CUSTOMER_USER = 5;
  const SES_BY_ROLL=7;

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return UserType the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{UserType}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('name', 'required'),
        array('name', 'length', 'max' => 255),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
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
        'users' => array(self::HAS_MANY, 'User', 'userTypeId'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'name' => 'Tipo de Usuario',
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

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

  public static function isSesUser($id) {
    $ans = in_array($id, array(
        UserType::SES_ADMIN,
        UserType::SES_BILLING,
        UserType::SES_SUPERADMIN,
        UserType::SES_USER,
        UserType::SES_BY_ROLL));
    return ($ans);
  }

  public static function userHasRightsOn($userTypeId) {
    $ans = (Yii::app()->user->isSuperAdmin || Yii::app()->user->arUser->userType->id <= $userTypeId || Yii::app()->user->getIsByRole());
    return $ans;
  }

  public static function getUserTypes() {
    $criteria = new CDbCriteria();
    if (Yii::app()->user->getIsByRole()) {
      if(Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS)){
        $criteria->order = 't.name';
        $ans = UserType::model()->findAll($criteria);
      }else{
        $criteria->addCondition('id > ' . (int) Yii::app()->user->arUser->userType->id);
      }
    }else if (!Yii::app()->user->isSuperAdmin) {
      $criteria->addCondition('id > ' . (int) Yii::app()->user->arUser->userType->id);
    }else{
      $criteria->order = 't.name';
      $ans = UserType::model()->findAll($criteria);
    }
    return $ans;
  }

    public function getIsAdmin(){
        return (in_array($this->id, array(UserType::SES_ADMIN,UserType::SES_BILLING,UserType::SES_SUPERADMIN)));
        //,UserType::SES_BY_ROLL
    }

    public function getIsSuperAdmin(){
        return $this->id==UserType::SES_SUPERADMIN;
        //return (in_array($this->id, array(UserType::SES_SUPERADMIN,UserType::SES_BY_ROLL)));

    }

    public function getIsBilling(){
        return (in_array($this->id, array(UserType::SES_SUPERADMIN,UserType::SES_BILLING)));
    }

    public function getIsUser(){
        return $this->id==UserType::SES_USER;
    }

    public function getIsUserCustomer(){
        return (in_array($this->id, array(UserType::CUSTOMER_MANAGER,UserType::CUSTOMER_USER)));
    }

}
//comment