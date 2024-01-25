<?php

use Permission as GlobalPermission;

/**
 * This is the model class for table "{{Permission}}".
 *
 * The followings are the available columns in table '{{Permission}}':
 * @property integer $id
 * @property string $controller
 * @property string $action
 * @property string $permission
 * @property string $description
 *
 * The followings are the available model relations:
 * @property RoleHasPermission[] $roleHasPermissions
 */
class Permission extends CActiveRecord
{
	const ESTUDIO_SENIOR='Estudios Senior';
	const ESTUDIOS_ANALISTA='Estudios Analista';
	const ALL_ESTUDIOS='Todos los Estudios';
	const TO_ASSING='Asignaciones';

	public $roleId=null; //variable para busqueda del admin

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{Permission}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('controller, action', 'required'),
			array('controller, action, permission', 'length', 'max'=>50),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, controller, action, permission, description, roleId', 'safe', 'on'=>'search'),
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
			'roleHasPermissions' => array(self::HAS_MANY, 'RoleHasPermission', 'permissionId'),
			'roles'=>[self::MANY_MANY,'Role', 'ses_RoleHasPermission(roleId, permissionId)']
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'controller' => 'Controlador',
			'action' => 'Acción',
			'permission' => 'Permiso',
			'description' => 'Descripción',
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
		$criteria->compare('controller',$this->controller,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('permission',$this->permission,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('roleHasPermissions.roleId', $this->roleId, true);

		$criteria->with=['roleHasPermissions'];
		if($this->roleId!=''){
			$criteria->together=true;
		}

		GridViewFilter::setFilter($this, 'search');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
				'pageSize' => 50,
            ),
            'sort' => array(
                'defaultOrder' => 't.id ASC',
            ),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Permission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getRolesListstr(){
		return implode(', ', CHtml::listData($this->roles, 'id', 'name'));
	}

	public static function getDatePermission($id)
	{
		$criteria = new CDbCriteria;

        $criteria->addCondition("t.id=:id");
        $criteria->params=[':id'=>$id,];
        $datePermission= Permission::model()->findAll($criteria);
        
        $datePermissionRequests=[];
  
        foreach ($datePermission as $date){
            $datePermissionRequests[]=[
				'id'=>$date->id,
                'controller'=>$date->controller,
                'action'=>$date->action,
                'permission'=>$date->permission,
                'description'=>$date->description
            ];
        }
        
		return $datePermissionRequests;
	}

	public function getRoleIds(){
        $ans=[];

        foreach($this->roles as $rol){
            $ans[]=$rol->id;
        }
        return $ans;
    }

    public function assingRoles($roleIds){

        $newRoleIds=[];

        if($roleIds!=null && is_array($roleIds)){
            foreach ($roleIds as $rolId){
                $newRoleIds[intval($rolId)]=true;
            }
        }

        $deleteRoles=[];
        foreach ($this->roleHasPermissions as $permissionhasrole){
            if(array_key_exists($permissionhasrole->roleId, $newRoleIds)){
                //Borrar registro de un array con unset
                unset($newRoleIds[$permissionhasrole->roleId]);
            }else{
                $deleteRoles[]=$permissionhasrole->role->name;
                $permissionhasrole->delete();
            }
        }

        if(count($deleteRoles)>0){
            WebUser::logAccess("Elimino roles de permiso: ".$this->controller.', '.$this->action.", Roles: ".implode(',',$deleteRoles));
        }

        $addRoles=[];
        foreach($newRoleIds as $newRoleId=>$val){
            $roleHasPermission=new RoleHasPermission();
            
            $roleHasPermission->permissionId=$this->id;
            $roleHasPermission->roleId=$newRoleId;
            $roleHasPermission->save();
            $roleHasPermission->refresh();
            $addRoles[]=$roleHasPermission->role->name;
        }
        
        if(count($addRoles)>0){
            WebUser::logAccess("Adiciono roles de de permiso: ".$this->controller.', '.$this->action.", Roles: ".implode(',',$addRoles));
        }
    }
}
//comment