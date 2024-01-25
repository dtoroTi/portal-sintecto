<?php

/**
 * This is the model class for table "{{AssignedUser}}".
 *
 * The followings are the available columns in table '{{AssignedUser}}':
 * @property integer $id
 * @property integer $userRoleId
 * @property integer $backgroundCheckId
 * @property integer $userId
 * @property integer $verificationSectionId
 * @property datetime $limitAt Limit to finish the assigment
 *
 * The followings are the available model relations:
 * @property User $user
 * @property BackgroundCheck $backgroundCheck
 * @property UserRole $userRole
 * @property VerificationSection $verificationSection
 * 
 * @property DateTime $limit
 * @property DateTime $finishedAt
 */
class AssignedUser extends CActiveRecord {

    public $backgroundCheckSearch;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{AssignedUser}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('userRoleId, backgroundCheckId, userId', 'required'),
            array('userRoleId, backgroundCheckId, userId', 'numerical', 'integerOnly' => true),
            array('verificationSectionId', 'numerical', 'integerOnly' => true, 'allowEmpty' => true),
            array('assignedAt,limitAt', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, userRoleId, backgroundCheckId, assignedAt, userId', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'userId'),
            'backgroundCheck' => array(self::BELONGS_TO, 'BackgroundCheck', 'backgroundCheckId'),
            'userRole' => array(self::BELONGS_TO, 'UserRole', 'userRoleId'),
            'verificationSection' => array(self::BELONGS_TO, 'VerificationSection', 'verificationSectionId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'userRoleId' => 'Role de Usuario',
            'backgroundCheckId' => 'Background Check',
            'userId' => 'Usuario',
            'assignedAt' => 'Asignado En',
            'verificationSectionId' => 'Sección',
            'limitAt' => 'Limite',
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
        $criteria->compare('userRoleId', $this->userRoleId);
        $criteria->compare('backgroundCheckId', $this->backgroundCheckId);
        $criteria->compare('userId', $this->userId);
        $criteria->compare('verificationSEctionId', $this->verificationSectionId, true);
        $criteria->compare('limitAt', $this->limitAt);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchWithBackgroundCheck($rows) {

        $bsSearch=$this->backgroundCheckSearch;
        $criteria = new CDbCriteria;

        $criteria->compare('backgroundCheck.customerId', $bsSearch->customerId);
        $criteria->compare('backgroundCheck.backgroundCheckStatusId', $bsSearch->backgroundCheckStatusId);
        $criteria->compare('backgroundCheck.firstName', $bsSearch->firstName, true);
        $criteria->compare('backgroundCheck.lastName', $bsSearch->lastName, true);
        $criteria->compare('backgroundCheck.idNumber', $bsSearch->idNumber, true);
        $criteria->compare('backgroundCheck.city', $bsSearch->city, true);
        $criteria->compare('backgroundCheck.idNumber', $bsSearch->idNumber, true);
        $criteria->compare('backgroundCheck.studyStartedOn', $bsSearch->studyStartedOn, true);
        $criteria->compare('backgroundCheck.created', '>=' . $bsSearch->createdOnFrom, false, 'and', true);
        $criteria->compare('backgroundCheck.created', '<=' . $bsSearch->createdOnUntil, false, 'and', true);
        $criteria->compare('backgroundCheck.studyStartedOn', '>=' . $bsSearch->studyStartedOnFrom, false, 'and', true);
        $criteria->compare('backgroundCheck.studyStartedOn', '<=' . $bsSearch->studyStartedOnUntil, false, 'and', true);
        $criteria->compare('backgroundCheck.studyLimitOn', $bsSearch->studyLimitOn, true);
        $criteria->compare('backgroundCheck.studyLimitOn', '>=' . $bsSearch->studyLimitOnFrom, false, 'and', true);
        $criteria->compare('backgroundCheck.studyLimitOn', '<=' . $bsSearch->studyLimitOnUntil, false, 'and', true);
        $criteria->compare('backgroundCheck.approvedOn', '>=' . $bsSearch->approvedOnFrom, false, 'and', true);
        $criteria->compare('backgroundCheck.approvedOn', '<=' . $bsSearch->approvedOnUntil, false, 'and', true);
        $criteria->compare('backgroundCheck.deliveredToCustomerOn', '>=' . $bsSearch->deliveredToCustomerOnFrom, false, 'and', true);
        $criteria->compare('backgroundCheck.deliveredToCustomerOn', '<=' . $bsSearch->deliveredToCustomerOnUntil, false, 'and', true);
        $criteria->compare('backgroundCheck.deliveredToCustomerOn',  $bsSearch->deliveredToCustomerOn, true);
        $criteria->compare('backgroundCheck.approvedOn', $bsSearch->approvedOn, true);
        $criteria->compare('backgroundCheck.code', $bsSearch->code, true);

        $criteria->with[]='backgroundCheck';
        $criteria->with[]='user';
        $criteria->with[]='userRole';
        $criteria->with[]='verificationSection.verificationSectionType';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
           'pagination' => array(
                'pageSize' => 400,
            ),
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AssignedUser the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->assignedAt = new CDbExpression('NOW()');
        }
        if ($this->userRoleId == UserRole::ASSIGNED) {
            $this->verificationSectionId = null;
        }

        if ($this->limitAt > $this->backgroundCheck->studyLimitOn || $this->limitAt < $this->backgroundCheck->studyStartedOn) {
            $this->limitAt = $this->backgroundCheck->studyLimitOn;
        }
        return parent::beforeSave();
    }

    public function getLimit() {
        if (!empty($this->limitAt)) {
            $ans = $this->limitAt;
        } else {
            $ans = $this->backgroundCheck->studyLimitOn;
        }
        return $ans;
    }

    public function getTimeLeft() {

        $ans = '';
        if ($this->backgroundCheck->result->isPending()) {
            if (empty($this->limit)) {
                $until = new DateTime($this->limit, timezone_open('America/Bogota'));
            } else {
                //$until = new DateTime($this->backgroundCheck->studyLimitOn . " 23:59:59", timezone_open('America/Bogota'));
                $until = new DateTime($this->backgroundCheck->studyLimitOn, timezone_open('America/Bogota'));
            }
            $from = new DateTime('now', timezone_open('America/Bogota'));

            $interval = $from->diff($until);
            $ans = $interval->format('%R%a:%H');
        }

        return $ans;
    }

    public function getIsDelayed() {
        $ans = false;
        if ($this->backgroundCheck->result->isPending()) {
            $now = new DateTime('now', timezone_open('America/Bogota'));
            $until = new DateTime($this->limit, timezone_open('America/Bogota'));
            if ($now > $until) {
                $ans = true;
            }
        }
        return $ans;
    }

}
