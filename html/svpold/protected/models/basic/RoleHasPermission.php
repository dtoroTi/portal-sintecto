<?php

use RoleHasPermission as GlobalRoleHasPermission;

/**
 * This is the model class for table "{{RoleHasPermission}}".
 *
 * The followings are the available columns in table '{{RoleHasPermission}}':
 * @property integer $id
 * @property integer $roleId
 * @property integer $permissionId
 * 
 *
 * The followings are the available model relations:
 * @property Permission $permission
 * @property Role $role

 * 
 * 	public $customerBusinessLine=null;
 */
class RoleHasPermission extends CActiveRecord
{

	public $rolname=null;
	public $filterController=null;
	public $filterAction=null;
	public $filterPermission=null;
	public $filterDescription=null;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{RoleHasPermission}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('roleId, permissionId', 'required'),
			array('roleId, permissionId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('roleId, permissionId, rolname, filterController, filterAction, filterPermission, filterDescription', 'safe', 'on'=>'search'),
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
			'permission' => array(self::BELONGS_TO, 'Permission', 'permissionId'),
			'role' => array(self::BELONGS_TO, 'Role', 'roleId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'=>'ID',
			'roleId' => 'Roles',
			'permissionId' => 'Permisos',
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

		//$criteria->compare('t.id',$this->id);
		$criteria->compare('roleId',$this->roleId);
		//$criteria->compare('permissionId',$this->permissionId);
		$criteria->compare('role.name', $this->rolname,true);
		$criteria->compare('permission.controller', $this->filterController,true);
		$criteria->compare('permission.action', $this->filterAction,true);
		$criteria->compare('permission.permission', $this->filterPermission,true);
		$criteria->compare('permission.description', $this->filterDescription,true);

		$criteria->with=['role', 'permission'];

		GridViewFilter::setFilter($this, 'search');

		return New CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
                'pageSize' => 50,
            ),
            'sort' => array(
                'defaultOrder' => 'permission.controller, permission.action  DESC',
            ),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RoleHasPermission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave(){
		$rolHaspermission=RoleHasPermission::model()->findByAttributes(['roleId'=>$this->roleId, 'permissionId'=>$this->permissionId]);

		return ($rolHaspermission==null || $rolHaspermission->id==$this->id);
	}

	public function getCanDelete() {
        return (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole());
    }


	public function assingPermission($idRole, $idPerm){

		$RolehasPermission=new RoleHasPermission();
            
		$RolehasPermission->roleId=$idRole;
		$RolehasPermission->permissionId=$idPerm;
		$RolehasPermission->save();

		WebUser::logAccess("Adiciono Permisos al rol: ".$idRole.", id permiso: ".$idPerm);

    }
}
//comment