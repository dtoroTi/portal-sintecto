<?php

/**
 * This is the model class for table "{{Log}}".
 *
 * The followings are the available columns in table '{{Log}}':
 * @property integer $id
 * @property string $serverName
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property string $ip
 * @property string $comments
 * @property string $created
 * @property string $modified
 * @property string $userLogin 
 * @property string $customerUserLogin 
 * @property string $backgroundCheckCode 
 */
class Log extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{Log}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('backgroundCheckCode', 'length', 'max' => 20),
            array('serverName, module, controller, action, ip', 'length', 'max' => 45),
            array('userLogin, customerUserLogin', 'length', 'max' => 255),
            array('comments, created, modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, userLogin, customerUserLogin, backgroundCheckCode, serverName, module, controller, action, ip, comments, created, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', array('username' => 'userLogin')),
            'customerUser' => array(self::BELONGS_TO, 'CustomerUser', array('username' => 'customerUserLogin')),
            'backgroundCheck' => array(self::BELONGS_TO, 'BackgroundCheck', array('backgroundCheckCode' => 'code')),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'userId' => 'Usuario',
            'serverName' => 'Servidor',
            'module' => 'Módulo',
            'controller' => 'Controlador',
            'action' => 'Acción',
            'ip' => 'IP',
            'comments' => 'Comentarios',
            'created' => 'Creado',
            'modified' => 'Modificado',
            'userLogin' => 'Usuario',
            'backgroundCheckCode' => 'Código',
            'customerUserLogin' => 'Usuario Cliente',
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
        $criteria->compare('userLogin', $this->userLogin, true);
        $criteria->compare('customerUserLogin', $this->customerUserLogin, true);
        $criteria->compare('backgroundCheckCode', $this->backgroundCheckCode, true);
        $criteria->compare('serverName', $this->serverName, true);
        $criteria->compare('module', $this->module, true);
        $criteria->compare('controller', $this->controller, true);
        $criteria->compare('action', $this->action, true);
        $criteria->compare('ip', $this->ip, false);
        $criteria->compare('comments', $this->comments, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);

        GridViewFilter::setFilter($this, 'search');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,            
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
                'pageSize' => 20,
            ),
            'sort' => array(
                'defaultOrder' => 't.created DESC',
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Log the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'AutoTimestampBehavior' => array(
                'class' => 'application.components.AutoTimestampBehavior',
            //You can optionally set the field name options here
            )
        );
    }

}
