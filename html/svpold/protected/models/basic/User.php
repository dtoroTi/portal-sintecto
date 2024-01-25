<?php

/**
 * This is the model class for table "{{User}}".
 *
 * The followings are the available columns in table '{{User}}':
 * @property integer $id
 * @property string $username
 * @property string $firstName
 * @property string $lastName
 * @property string $password
 * @property string $clearPassword1
 * @property string $clearPassword2
 * @property integer $userTypeId
 * @property string $created
 * @property string $modified
 * @property string $lastLogin
 * @property string $lastLoginIP
 * @property string $sessionValidUntil
 * @property string $sessionKey
 * @property integer $mustChangePassword
 * @property integer $isActive
 * @property integer $isInhouse
 * @property string $state
 * @property string $city
 * @property string $otpKey String
 * @property string $otp
 * @property integer $enfoceOtp Boolean default no
 * @property string $pdfPassword Readonly property 
 * @property string $pdfPassword property 
 * @property datetime $pdfPasswordChangedOn when was changed the password
 * @property integer $signatureId Id linked to the file of the signature
 * @property array $mailParam
 * @property string $csvSeparator
 * @property integer $enforceOtpG
 * @property string $otpGKey
 * @property string $temporalOtpGKey Otp Temporal
 * @property datetime $lastPasswordChange 
 * @property boolean $online
 * @property boolean $MailAssigned
 * @property boolean $Deallocated
 * @property boolean $MailCancelled
 * @property boolean $MailFinished
 * @property boolean $MailPublished
 * @property boolean $MailInformativeNews
 * @property boolean $MailTimeImpact
 * @property boolean $MailReturned
 * @property boolean $MailApprovedPric
 * @property boolean $MailStudyRequest
 * @property integer $goal
 * @property integer $area
 * @property boolean $callManager
 * 
 * @property integer $userSeniorId
 * @property boolean $userSeniorType
 * 
 * @property string $dateFrom
 * @property string $dateUntil
 *
 * The followings are the available model relations:
 * @property UserType $userType
 */
class User extends CActiveRecord {

    const SIGNATURE_WIDTH = 920;
    const SIGNATURE_HEIGHT = 240;
    const SVP_DOMAIN = 'securityandvision.com';

    public $clearPassword1;
    public $clearPassword2;
    public $otp;
    public $signatureFile;
    private $_isSafeDomain = null;
    public $online;

    //Fechas para search de asignación
    public $dateFrom=null;
    public $dateUntil=null;

    private $__permissionArray=null;

    public $roleId=null;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{User}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username,firstName, lastName,  userTypeId', 'required'),
            array('username', 'email'),
            array('userTypeId, goal, area', 'numerical', 'integerOnly' => true),
            array('firstName, lastName, password, lastLoginIP, sessionKey, seed,state,city', 'length', 'max' => 255),
            array('otp', 'length', 'max' => 50),
            array('csvSeparator', 'length', 'max' => 1),
            array('mustChangePassword, isInhouse,isActive, enforceOtp, enforceOtpG, MailAssigned, Deallocated, MailCancelled, MailFinished, MailPublished, MailInformativeNews, MailTimeImpact, MailReturned, MailApprovedPric, MailStudyRequest, callManager, userSeniorType', 'boolean'),
            array('modified, lastLogin, clearPassword1, clearPassword2 , otp, pdfPasswordChangedOn, signatureId, userSeniorId, dateFrom, dateUntil', 'safe'),
            array('username', 'unique'),
//        array('username', 'checkUserName'),
            array('pdfPassword, clearPassword1, clearPassword2', 'PasswordStrength', 'strength' => 'strong', 'allowEmpty' => true),
            array('clearPassword1', 'checkSamePassword'),
            array('otp', 'checkOtp'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('signatureFile',
                'file',
                'types' => 'jpg, gif, png',
                'maxSize' => 1024 * 1024 * 1, // 1MB
                'tooLarge' => 'El archivo es mide más de 1MB. Por favor utilice un archivo mas pequeño.',
                'allowEmpty' => true,
                'wrongType' => 'Los tipos de archivo permitidos son: jpg, gif y png. Por favor utilice alguno de estos tipos',
            ),
            array('id, username, firstName, lastName,password, userTypeId, created, ' .
                'modified, lastLogin, lastLoginIP, sessionValidUntil, sessionKey, ' .
                'mustChangePassword, isActive, isInhouse, state, city,enforceOtp, enforceOtpG, online,  goal, area, userSeniorId, userSeniorType, roleId', 'safe', 'on' => 'search'),

            array('id, username, firstName, lastName, isActive, state, city, userSeniorName', 'safe', 'on' => 'searchSenior'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userType' => array(self::BELONGS_TO, 'UserType', 'userTypeId'),
            'signature' => array(self::BELONGS_TO, 'File', 'signatureId'),
            'userSenior' => array(self::BELONGS_TO, 'User', 'userSeniorId'),
            'roles'=>[self::MANY_MANY,'Role', 'ses_UserHasRole(userId, roleId)'],
            'userHasRoles'=>[self::HAS_MANY, 'UserHasRole', 'userId'],
            'assignedUsers'=>[self::HAS_MANY,'User', 'userSeniorId'],
            /*'multRoles'=>[self::HAS_MANY, 'Role', ['roleId'=>'id'], 'through'=>'userHasRoles'],
            'rolPermissions2'=>[self::HAS_MANY, 'RoleHasPermission', ['id'=>'roleId1'], 'through'=>'multRoles'],*/
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Usuario/Email',
            'firstName' => 'Nombres',
            'lastName' => 'Apellidos',
            'password' => 'Clave',
            'userTypeId' => 'Tipo',
            'created' => 'Creado',
            'modified' => 'Modificado',
            'lastLogin' => 'Último Login',
            'lastLoginIP' => 'Última IP',
            'sessionValidUntil' => 'Session valida hasta',
            'sessionKey' => 'Llave de Session',
            'mustChangePassword' => 'Debe cambiar la Clave',
            'isActive' => 'Esta Activo?',
            'isInhouse' => 'Es Inhouse?',
            'callManager' => 'Responsable de Llamadas',
            'state' => 'Departamento',
            'city' => 'ciudad',
            'name' => 'Usuario',
            'otp' => 'Llave',
            'enforceOtp' => 'Llave obligatoria',
            'pdfPassword' => 'Clave del PDF',
            'goal'=>'Meta',
            'area'=>'Área',
            'pdfPasswordChangedOn' => 'Clave del PDF cambio en',
            'signatureId' => 'Firma',
            'signatureFile' => 'Firma',
            'csvSeparator' => 'Separador',
            'enforceOtpG' => 'OTP Google Obligatoria',
            'otpGKey' => 'Segunda Llave',
            'lastPasswordChange' => 'Ultimo cambio de PWD',
            'online' => 'Esta en línea',
            'MailAssigned' => 'Mail Asignado',
            'Deallocated' => 'Mail Des-asignado',
            'MailCancelled' => 'Mail Cancelado',
            'MailFinished' => 'Mail Finalizado',
            'MailPublished' => 'Mail Publicado',
            'MailInformativeNews' => 'Mail Nov.Infor',
            'MailTimeImpact' => 'Mail Impc.Tiemp',
            'MailReturned' => 'Mail Devuelto',
            'MailApprovedPric' => 'Mail Aprobado',
            'MailStudyRequest' => 'Mail Pet.(Svision)',
            'userSeniorType'=>'Es Senior',
            'userSeniorId'=>'Asignar Usuario Senior',
            'dateFrom' => 'Terminado desde',
            'dateUntil' => 'Terminado hasta',
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
        $criteria->compare('username', $this->username, true);
        $criteria->compare('firstName', $this->firstName, true);
        $criteria->compare('lastName', $this->lastName, true);
        $criteria->compare('password', $this->password, true);
//    $criteria->compare('customerId', $this->customerId);
        $criteria->compare('userTypeId', $this->userTypeId);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('lastLogin', $this->lastLogin, true);
        $criteria->compare('lastLoginIP', $this->lastLoginIP, true);
        $criteria->compare('sessionValidUntil', $this->sessionValidUntil, true);
        $criteria->compare('sessionKey', $this->sessionKey, true);
        $criteria->compare('mustChangePassword', $this->mustChangePassword);
        $criteria->compare('isActive', $this->isActive);
        $criteria->compare('isInhouse', $this->isInhouse);
        $criteria->compare('state', $this->state, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('enfocerOtp', $this->enforceOtp, true);
        $criteria->compare('goal', $this->goal, true);
        $criteria->compare('area', $this->area, true);
        $criteria->compare('callManager', $this->callManager);
        $criteria->compare('userSeniorType', $this->userSeniorType);  
        $criteria->compare('userSeniorId', $this->userSeniorId, true);  

        if ($this->online != NULL) {
            if ($this->online) {
                $criteria->addCondition('sessionValidUntil>=now()');
            } else {
                $criteria->addCondition('sessionValidUntil<now()');
            }
        }

        $criteria->compare('userHasRoles.roleId', $this->roleId, true);

		$criteria->with=['userHasRoles'];
		$criteria->together=true;

        GridViewFilter::setFilter($this, 'search');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
            ),
        ));
    }

    public function beforeSave() {
        $ans = true;
        if ($this->isNewRecord && ($this->clearPassword1 != "" && $this->clearPassword2 == $this->clearPassword1 )) {
            $this->setPassword($this->clearPassword1);
        }
        if (get_class(Yii::app()) == "CWebApplication" &&
                !(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'login')) {
            if (!Yii::app()->user->isValidUser) {
                // without login the user can not be changed
                Yii::log("Without login trying to change the user properties of " . $this->username, "error", "ZWF." . __CLASS__);
                $this->addError('username', 'Incorrect username.');
                $ans = false;
            } else if (Yii::app()->user->id != $this->id &&
                    ((!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()) || !UserType::userHasRightsOn($this->userTypeId))) {
                // The user is not allow to change the user properties
                Yii::log("The user (" . Yii::app()->user->name . ") is not allow to change the user properties of " . $this->username, "error", "ZWF." . __CLASS__);
                $this->addError('userTypeId', 'Tipo de Usuario Incorrecto.');
                $ans = false;
            }
        }
        return $ans && parent::beforeSave();
    }

    public function checkUserName($attribute, $params) {
        $ans = true;
        $this->username = strtolower(trim($this->username));
        if (get_class(Yii::app()) != "CConsoleApplication") {
            $username = explode("@", $this->username);

            if (count($username) != 2 || ( $username[1] == UserType::SES_DOMAIN &&
                    (!Yii::app()->user->isSesUser || !UserType::isSesUser($this->userTypeId)))) {
                $ans = false;
                Yii::log("The user (" . Yii::app()->user->name . ") is not allow to change the user properties of " . $this->username, "error", "ZWF." . __CLASS__);
                $this->addError('username', 'Incorrect username, please check.');
            }
        }
        return $ans;
    }

    public function checkSamePassword($attribute, $params) {
        $ans = true;
        if ($this->isNewRecord && $this->clearPassword1 == "") {
            $this->addError('clearPassword1', 'El Usuario debe tener Clave Incial.');
            $ans = false;
        }
        if (($this->clearPassword1 != "" || $this->clearPassword2 != "") &&
                ($this->clearPassword1 != $this->clearPassword2)) {
            $this->addError('clearPassword1', 'La clave y la clave de verificación deben ser iguales.');
            $this->addError('clearPassword2', 'La clave y la clave de verificación deben ser iguales.');
            $ans = false;
        }
//    if (($this->clearPassword1 != "" || $this->clearPassword2 != "")
//            && get_class(Yii::app()) != "CConsoleApplication"
//            &&
//            (strlen($this->clearPassword1) < 8
//            || preg_match('/[A-Z]/', $this->clearPassword1) == 0
//            || preg_match('/[0-9]/', $this->clearPassword1) == 0
//            )
//    ) {
//      $this->addError('clearPassword1', 'La clave debe ser de mínimo 8 caracteres, y debe incluir al menos 1 número, una mayuscula.');
//      $ans = false;
//    }
        return ($ans);
    }

//  public function checkStrongPassword($attribute, $params) {
//    if (!BackgroundCheck::isStrongPassword($this->$attribute)) {
//      $this->addError($attribute, 'La clave debe ser de mínimo 8 caracteres, y debe incluir al menos 1 número y una mayuscula.');
//    }
//  }

    public function checkOtp($attribute, $params) {
        $ans = true;
        if ($this->enforceOtp && trim($this->otp) != "" && !$this->validateOtp($this->otp)) {
            $this->addError('otp', 'La llave no es válida.');
            $ans = false;
        }
        return $ans;
    }

    public function validatePassword($password) {
        $ans = ($this->password == md5('*->*' . $password . '-' . $this->seed . '*->*'));
        return ($ans);
    }

    public function setPassword($password) {
        $this->seed = md5('*->*' . date('r') . trim(strtolower($this->username)) . '*->*');
        $this->password = md5('*->*' . $password . '-' . $this->seed . '*->*');
        $this->lastPasswordChange = new CDbExpression('NOW()');
    }

    public function setLastLogin() {
        $this->lastLogin = new CDbExpression('NOW()');
        $this->lastLoginIP = $_SERVER["REMOTE_ADDR"];
        $this->sessionKey = md5($this->lastLoginIP . date('r') . $this->username);
        $this->sessionValidUntil = new CDbExpression(' DATE_ADD( NOW( ) , INTERVAL ' .
                SES_SESSION_TIME_OUT . ' SECOND )');

        $ans = $this->save(false, array('lastLogin', 'lastLoginIP', 'sessionKey', 'sessionValidUntil'));
        $this->update();
        return ($ans);
    }

    public function behaviors() {
        return array(
            'AutoTimestampBehavior' => array(
                'class' => 'application.components.AutoTimestampBehavior',
            //You can optionally set the field name options here
            )
        );
    }

    static public function getUsersByActualUser() {
        return User::model()->findAll();
    }

    public function getDescription() {
        return "{$this->firstName} {$this->lastName} <{$this->username}>";
    }

    public static function getPermitedUsers() {
        return User::model()->findAll();
    }

    public function getName() {
        return "{$this->firstName} {$this->lastName}";
    }

    public function validateOnlineOtp($otp) {
        Yii::import('application.extensions.yubikey.*');
        $apiID = 14099;
        $signatureKey = "/Efe/hZReEaUeAtEj8wobp5hNrQ=";

        $token = new Yubikey($apiID, $signatureKey);

        $token->setCurlTimeout(20);
        $token->setTimestampTolerance(500);

        $ans = true;
        if (!$token->verify($otp)) {
//            Yii::log("Error in OTP\n" .
//                    "username: " . $this->username . " (" . $_SERVER['REMOTE_ADDR'] . ")\n" . $otp .
//                    "\nError:" . $token->getLastResponse(), "error", "ZWF." . __CLASS__);
            $ans = false;
        }
        return $ans;
    }

    public function validateOtpGKey($otp, $secretKey = null) {
        Yii::import('application.extensions.googleOtp.*');
        if ($secretKey) {
            $secret = $secretKey;
        } else {
            $secret = $this->otpGKey;
        }
        $g = new GoogleAuthenticator();
        return ($g->checkCode($secret, $otp));
    }

    public function getNewOtpGKey() {
        Yii::import('application.extensions.googleOtp.*');
        $g = new GoogleAuthenticator();
        return $g->getNewOtpGKey();
    }

    public function getOtpGQrTemporalImage() {
        Yii::import('application.extensions.googleOtp.*');
        $g = new GoogleAuthenticator();
        return ($g->getQrCodeHTMLImage($this->shortUsername, $this->userNameDomain, $this->temporalOtpGKey));
    }

    // function verifyOtp verify that key belongs to the user and the otp is valid
    public function validateOtp($otp) {
        $ans = false;
        if ($this->enforceOtp) {
            if ($this->getOtpKeyFromOtp($otp) == $this->otpKey) {
                $ans = $this->validateOnlineOtp($otp);
            }
        } else {
            $ans = true;
        }
        return $ans;
    }

    // function verifyOtp verify that key belongs to the user and the otp is valid
    public function validateOtpG($otp) {
        $ans = false;
        if ($this->enforceOtpG) {
            if ($this->otpGKey == '') {
                $ans = true;
            } else {
                $ans = $this->validateOtpGKey($otp);
            }
        } else {
            $ans = true;
        }
        return $ans;
    }

    private function getOtpKeyFromOtp($otp) {
        return substr($otp, 0, 12);
    }

    public function setOtpKey($otp) {
        $this->otpKey = $this->getOtpKeyFromOtp($otp);
    }

    static public function getUserAccessReport() {

        $thisMonthDate = new DateTime("now", timezone_open('America/Bogota'));
        $previewsMonthDate = clone $thisMonthDate;
        $previewsMonthDate->sub(new DateInterval('P1M'));

        $thisMonth = $thisMonthDate->format('Y-m');
        $previewsMonth = $previewsMonthDate->format('Y-m');

        $select = array(
            "count(if (date_format(log.created,'%Y-%m')='{$previewsMonth}',1,null)) as 'S_{$previewsMonth}'",
            "count(if (date_format(log.created,'%Y-%m')='{$thisMonth}',1,null)) as 'S_{$thisMonth}'",
        );


        $ans = Yii::app()->db->createCommand()
                ->select("customerUserLogin as 'Usuario', " . implode(",", $select))
                ->from('{{Log}} log')
                ->where('log.created >= :previewsMonth', array(':previewsMonth' => $previewsMonthDate->format('Y-m-01')))
        ;


        $ans = $ans->group('customerUserLogin')
                ->order('customerUserLogin')
                ->queryAll();

        return array(
            'from' => $previewsMonthDate->format("Y-m-d"),
            'to' => $thisMonthDate->format("Y-m-d"),
            'data' => $ans);
    }

    static public function getUserRoleReport() {

        $thisMonthDate = new DateTime("now", timezone_open('America/Bogota'));
        $previewsMonthDate = clone $thisMonthDate;
        $previewsMonthDate->sub(new DateInterval('P1M'));

        $thisMonth = $thisMonthDate->format('Y-m');
        $previewsMonth = $previewsMonthDate->format('Y-m');

        $results = UserRole::model()->findAll();

        $select = array();
        foreach ($results as $result) {
            $select[] = "count(if (backgroundCheck.resultId<>" . Result::PENDING . " and assignedUser.userRoleId=" . $result->id . ",1,null)) as '30D {$result->name}'";
        }
        foreach ($results as $result) {
            $select[] = "count(if (backgroundCheck.resultId=" . Result::PENDING . " and assignedUser.userRoleId=" . $result->id . ",1,null)) as 'Pend {$result->name}'";
        }


        $ans = Yii::app()->db->createCommand()
                ->select("user.id as id, user.username as 'Usuario', " . implode(",", $select))
                ->from('{{BackgroundCheck}} backgroundCheck')
                ->join('{{AssignedUser}} assignedUser', 'assignedUser.backgroundCheckId=backgroundCheck.id')
                ->join('{{User}} user', 'assignedUser.userId=user.id')
                ->where('backgroundCheck.studyStartedOn >= :previewsMonth or backgroundCheck.resultId=:resultId', array(':previewsMonth' => $previewsMonthDate->format('Y-m-01'),
            ':resultId' => Result::PENDING))

        ;


        $ans = $ans->group('user.id')
                ->order('user.username')
                ->queryAll();

        return array(
            'from' => $previewsMonthDate->format("Y-m-d"),
            'to' => $thisMonthDate->format("Y-m-d"),
            'data' => $ans);
    }

    public function getPendingStudies() {
        $ans = array('onTime' => 0, 'overdue' => 0);

        $criteria = new CDbCriteria;

        $criteria->addCondition('resultId=:resultId');
        $criteria->addCondition('assignedUsers.userId=:userId');
        $criteria->addCondition('assignedUsers.userRoleId=:userRoleId');
        $criteria->params = array(
            ':resultId' => Result::PENDING,
            ':userId' => $this->id,
            ':userRoleId' => UserRole::ASSIGNED);

        $criteria->with = array('assignedUsers');


        $studies = BackgroundCheck::model()->findAll($criteria);

        foreach ($studies as $study) {
            if ($study->isOverdue) {
                $ans['overdue']+=1;
            } else {
                $ans['onTime']+=1;
            }
        }

        return $ans;
    }

    public function deleteSignature() {
        if ($this->signature) {
            $signature = $this->signature;
            $this->signatureId = null;
            $this->save();
            $signature->delete();
        }
    }

    public function beforeDelete() {
        $this->deleteSignature();
        return parent::beforeDelete();
    }

    public function getSignatureImage() {
        if ($this->signature) {
            return $this->signature->getDecryptedFile();
        } else {
            return "";
        }
    }

    public function getShortUsername() {
        return substr($this->username, 0, strpos($this->username, '@'));
    }

    public function getUsernameDomain() {
        return substr($this->username, strpos($this->username, '@') + 1);
    }

    public function getImageType() {
        
    }

    public function getMailParam() {
        return array("mail" => $this->username, "name" => $this->name);
    }

    public function getIsAdmin() {
        return $this->userType->isAdmin;
    }
//Creada por Jonathan
    public function getIsIntermedio() {
        return $this->userType->isIntermedio;
    }

    //

    public function getIsSuperAdmin() {
        return $this->userType->isSuperAdmin;
    }

    public function getIsBilling() {
        return $this->userType->isBilling;
    }

    public function getIsUser() {
        return $this->userType->isUser;
    }

    public function getIsUserCustomer() {
        return $this->userType->isUserCustomer;
    }

    public function getIsSafeDomain() {
        if ($this->_isSafeDomain === null) {
            $this->_isSafeDomain = in_array($this->usernameDomain, array('svision.co', 'securityandvision.com'));
        }
        return $this->_isSafeDomain;
    }

    public function getIsManager() {
        $users = array(
            'lzubieta@svision.co', 'admin@svision.co');
        return (in_array($this->name, $users));
    }

    public function getPendingAssigments() {

        $criteria = new CDbCriteria;
        $criteria->with = array(
            'user',
            'backgroundCheck',
            'backgroundCheck.customer',
            'backgroundCheck.customer.customerGroup',
            'backgroundCheck.customerProduct',
            'backgroundCheck.result',
            'userRole',
            'verificationSection',
            'verificationSection.verificationSectionType',
        );


        $criteria->together = true;
        $criteria->addCondition('(backgroundCheck.approvedOn is Null or backgroundCheck.approvedOn="0000-00-00 00:00:00" '
                . 'or  backgroundCheck.deliveredToCustomerOn is null  '
                . 'or backgroundCheck.deliveredToCustomerOn ="0000-00-00 00:00:00") '
//                . 'and customerGroup.id<>:svpId '
                . 'and backgroundCheck.backgroundCheckStatusId not in (:cancel,:partialCancel)'
                . 'and t.userId=:userId');

        $criteria->params = array(
            ':cancel' => BackgroundCheckStatus::CANCELLED,
            ':partialCancel' => BackgroundCheckStatus::PARTIAL_CANCELLED,
//            ':svpId' => CustomerGroup::SAV_ID,
            ':userId' => Yii::app()->user->arUser->id,
        );


        $criteria->order = 'IFNULL(t.limitAt,backgroundCheck.studyLimitOn) ASC, customer.name ASC';

        $reports = AssignedUser::model()->findAll($criteria);

        return $reports;
    }

    public function getPendingUrgents() {

        $criteria = new CDbCriteria;       

        $criteria->addCondition('(t.approvedOn is Null or t.approvedOn="0000-00-00 00:00:00" '
        . 'or  t.deliveredToCustomerOn is null  '
        . 'or t.deliveredToCustomerOn ="0000-00-00 00:00:00") '
        . 'and t.observationToCustomer is not Null '
        . 'and t.backgroundCheckStatusId not in (:cancel,:partialCancel)'
       
    );
    $criteria->params = array(
        ':cancel' => BackgroundCheckStatus::CANCELLED,
        ':partialCancel' => BackgroundCheckStatus::PARTIAL_CANCELLED,
    );

        $criteria->with=['customer', 'customerProduct'];
        $studies = BackgroundCheck::model()->findAll($criteria);        
        return $studies;
    }

    public function getIsOnline() {
        $now = new DateTime('now', timezone_open('America/Bogota'));
        $validUntil = new DateTime($this->sessionValidUntil, timezone_open('America/Bogota'));
        return ($now < $validUntil);
    }

    public function getSummaryLine() {
        return (!$this->isActive ? "***" : "") . "{$this->name} : {$this->username} ";
    }

    //Inicio consultas para estadistica interna funcionarios operaciones
    //Natalia Henao
    //21-03-2022
    //productividad a tiempo
    public function getproductivityonTime($from, $until,  $idUser) {

        $criteria = new CDbCriteria;

        $criteria->join='JOIN ses_Customer ct ON ct.id=t.customerId
            JOIN ses_AssignedUser ass ON ass.backgroundCheckId=t.id
            JOIN ses_User us ON us.id=ass.userId
            JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
            JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId';
        $criteria->addCondition('us.id=:userId AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") <= DATE_FORMAT(t.dateLimitQuality,"%Y-%m-%d") AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") between :from and :until AND vfst.id!="24" AND vfst.id!="8" AND vfst.id!="91"');
        $criteria->params=[':from'=>$from, ':until'=>$until, ':userId'=>$idUser];

        $AllproductivityonTime= BackgroundCheck::model()->count($criteria);
 
        $productivityonTime=[];
        $productivityonTime[]=[
            'CantProducTiempo'=>$AllproductivityonTime
        ];

        return $productivityonTime;
    }

    //Natalia Henao
    //21-03-2022
    //productividad fuera de tiempo por funcionario
    public function getproductivityOutofTime($from, $until,  $idUser) {
        
        $criteria = new CDbCriteria;

        $criteria->join='JOIN ses_Customer ct ON ct.id=t.customerId
            JOIN ses_AssignedUser ass ON ass.backgroundCheckId=t.id
            JOIN ses_User us ON us.id=ass.userId
            JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
            JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId';
        $criteria->addCondition('us.id=:userId AND (DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") > DATE_FORMAT(t.dateLimitQuality,"%Y-%m-%d")  OR DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") IS NULL) AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") between :from and :until AND vfst.id!="24" AND vfst.id!="8" AND vfst.id!="91"');
        $criteria->params=[':from'=>$from, ':until'=>$until, ':userId'=>$idUser];

        $AllproductivityOutofTime= BackgroundCheck::model()->count($criteria);
 
        $productivityOutofTime=[];
        $productivityOutofTime[]=[
            'CantProducFueradeTiempo'=>$AllproductivityOutofTime
        ];
        return $productivityOutofTime;
    }
    
    //Natalia Henao
    //21-03-2022
    //oportunidad por funcionario
    public function getOpportunityStudies($from, $until,  $idUser) {

        $criteria = new CDbCriteria;

        $criteria->join='JOIN ses_Customer ct ON ct.id=t.customerId
            JOIN ses_AssignedUser ass ON ass.backgroundCheckId=t.id
            JOIN ses_User us ON us.id=ass.userId
            JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
            JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId';
        $criteria->addCondition('us.id=:userId AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") < DATE_FORMAT(t.dateLimitQuality,"%Y-%m-%d") AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") between :from and :until AND vfst.id!="24" AND vfst.id!="8"  AND vfst.id!="91"');
        $criteria->params=[':from'=>$from, ':until'=>$until, ':userId'=>$idUser];

        $AllopportunityStudies= BackgroundCheck::model()->count($criteria);
 
        $opportunityStudies=[];
        $opportunityStudies[]=[
            'CantEstOportunidad'=>$AllopportunityStudies
        ];
        return $opportunityStudies;
    }

    //Natalia Henao
    //21-03-2022
    //total estudios por funcionario
    public function getTotalStudies($from, $until,  $idUser) {

        $criteria = new CDbCriteria;

        $criteria->join='JOIN ses_Customer ct ON ct.id=t.customerId
            JOIN ses_AssignedUser ass ON ass.backgroundCheckId=t.id
            JOIN ses_User us ON us.id=ass.userId
            JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
            JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId';
        $criteria->addCondition('us.id=:userId AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") between :from and :until AND vfst.id!="24" AND vfst.id!="8" AND vfst.id!="91"');
        $criteria->params=[':from'=>$from, ':until'=>$until, ':userId'=>$idUser];

        $AllStudies= BackgroundCheck::model()->count($criteria);
 
        $totalStudies=[];
        $totalStudies[]=[
            'CantidadEstudios'=>$AllStudies
        ];
        return $totalStudies;
    }

    //Natalia Henao
    //21-03-2022
    //Calidad por funcionario
    public function getQualityStudies($from, $until,  $idUser) {
        
        $query_A = 'SELECT us.id, ct.name AS nombre, us.username AS Usuario,  COUNT(DISTINCT bc.code) AS CantEstudios,
        SUM(IF(bc.qualityLaboral=1 AND vfst.NAME="Laboral", "1","0")) AS Laboral, SUM(IF(bc.qualityLaboralPQR=1 AND vfst.NAME="Laboral", "1","0")) AS LaboralPQR, 
        SUM(IF(bc.qualityLaboralPNC=1 AND vfst.NAME="Laboral", "1","0")) AS LaboralPNC,
        SUM(IF(bc.qualityEducation=1 AND vfst.NAME="Académico", "1","0")) AS Academico, SUM(IF(bc.qualityEducationPQR=1 AND vfst.NAME="Académico", "1","0")) AS AcademicoPQR, 
        SUM(IF(bc.qualityEducationPNC=1 AND vfst.NAME="Académico", "1","0")) AS AcademicoPNC,
        SUM(IF(bc.qualityFinanlcial=1 AND vfst.NAME="Financiero", "1","0")) AS Financiero, SUM(IF(bc.qualityFinanlcialPQR=1 AND vfst.NAME="Financiero", "1","0")) AS FinancieroPQR, 
        SUM(IF(bc.qualityFinanlcialPNC=1 AND vfst.NAME="Financiero", "1","0")) AS FinancieroPNC,
        SUM(IF(bc.qualityAdverse=1 AND vfst.NAME="Adversos", "1","0")) AS Adversos, SUM(IF(bc.qualityAdversePQR=1 AND vfst.NAME="Adversos", "1","0")) AS AdversosPQR, 
        SUM(IF(bc.qualityAdversePNC=1 AND vfst.NAME="Adversos", "1","0")) AS AdversosPNC,
        SUM(IF(bc.qualityVisit=1 AND vfst.NAME="Personas en la Vivienda", "1","0")) AS Visita, SUM(IF(bc.qualityVisitPQR=1 AND vfst.NAME="Personas en la Vivienda", "1","0")) AS VisitaPQR, 
        SUM(IF(bc.qualityVisitPNC=1 AND vfst.NAME="Personas en la Vivienda", "1","0"))  AS VisitaPNC, 
        SUM(IF(bc.qualityPolygraph=1 AND vfst.NAME="Polígrafo", "1","0")) AS Poligrafo, SUM(IF(bc.qualityPolygraphPQR=1 AND vfst.NAME="Polígrafo", "1","0")) AS PoligrafoPQR, 
        SUM(IF(bc.qualityPolygraphPNC=1 AND vfst.NAME="Polígrafo", "1","0")) AS PoligrafoPNC,
        SUM(IF(bc.qualityTest=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0")) AS Pruebas_Psicotecnicas, SUM(IF(bc.qualityTestPQR=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0")) AS PruebaPQR, 
        SUM(IF(bc.qualityTestPNC=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0")) AS PruebaPNC,
        SUM(IF(bc.qualityReference=1 AND vfst.NAME="Referencias", "1","0")) AS Reference, SUM(IF(bc.qualityReferencePQR=1 AND vfst.NAME="PReferencias", "1","0")) AS ReferencePQR,
        SUM(IF(bc.qualityReferencePNC=1 AND vfst.NAME="Referencias", "1","0")) AS ReferencePNC
        FROM ses_BackgroundCheck bc
        JOIN ses_Customer ct ON ct.id=bc.customerId
        JOIN ses_AssignedUser ass ON ass.backgroundCheckId=bc.id
        JOIN ses_User us ON us.id=ass.userId
        JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
        JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId
        WHERE us.id="'.$idUser.'" AND ((bc.qualityEducation=1 AND vfst.NAME="Académico")
        OR (bc.qualityLaboral=1 AND vfst.NAME="Laboral")
        OR (bc.qualityFinanlcial=1 AND vfst.NAME="Financiero")
        OR (bc.qualityAdverse=1 AND vfst.NAME="Adversos")
        OR (bc.qualityVisit=1 AND vfst.NAME="Personas en la Vivienda")
        OR (bc.qualityPolygraph=1 AND vfst.NAME="Polígrafo")
        OR (bc.qualityTest=1 AND vfst.NAME="Pruebas Psicotécnicas")
        OR (bc.qualityReference=1 AND vfst.NAME="Referencias"))
        AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>="'.$from.'" AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<="'.$until.'"
        GROUP BY us.username';
        $qualityStudies = Yii::app()->db->createCommand($query_A)->queryAll();
        return $qualityStudies;
    }
    
    //Natalia Henao
    //21-03-2022
    //consulta porcentajes de resultados calidad
    public function getqualityPorc(){
        $query_A='SELECT * FROM ses_QualityPorc qp';
        $qualityPorc = Yii::app()->db->createCommand($query_A)->queryAll();
        return $qualityPorc;
    }

    //Natalia Henao
    //07-04-2022
    //consulta meta por funcionario
    public function getgoalUser($idUser) {
        $goaluser = User::model()->findByPk($idUser);
        return $goaluser->goal;
    }

    //Natalia Henao
    //18/05/2022
    //Consulta detallado de cada sección de calidad
    public function getQualityResult($from, $until,  $idUser, $name){

        $query_A='SELECT ct.name AS nombre, bc.code,
        IF(bc.qualityLaboral=1 AND vfst.NAME="Laboral", "1","0") AS Laboral, IF(bc.qualityLaboralPQR=1 AND vfst.NAME="Laboral", "1","0") AS LaboralPQR, IF(bc.qualityLaboralPNC=1 AND vfst.NAME="Laboral", "1","0") AS LaboralPNC, bc.qualitytextLaboral,
        IF(bc.qualityEducation=1 AND vfst.NAME="Académico", "1","0") AS Academico,IF(bc.qualityEducationPQR=1 AND vfst.NAME="Académico", "1","0") AS AcademicoPQR, IF(bc.qualityEducationPNC=1 AND vfst.NAME="Académico", "1","0") AS AcademicoPNC, bc.qualitytextEducation,
        IF(bc.qualityFinanlcial=1 AND vfst.NAME="Financiero", "1","0") AS Financiero, IF(bc.qualityFinanlcialPQR=1 AND vfst.NAME="Financiero", "1","0") AS FinancieroPQR,IF(bc.qualityFinanlcialPNC=1 AND vfst.NAME="Financiero", "1","0") AS FinancieroPNC, bc.qualitytextFinancial, 
        IF(bc.qualityAdverse=1 AND vfst.NAME="Adversos", "1","0") AS Adversos, IF(bc.qualityAdversePQR=1 AND vfst.NAME="Adversos", "1","0") AS AdversosPQR,
        IF(bc.qualityAdversePNC=1 AND vfst.NAME="Adversos", "1","0") AS AdversosPNC, bc.qualitytextAdverse,
		  IF(bc.qualityVisit=1 AND vfst.NAME="Personas en la Vivienda", "1","0") AS Visita, IF(bc.qualityVisitPQR=1 AND vfst.NAME="Personas en la Vivienda", "1","0") AS VisitaPQR, IF(bc.qualityVisitPNC=1 AND vfst.NAME="Personas en la Vivienda", "1","0") AS VisitaPNC, bc.qualitytextVisit,
		  IF(bc.qualityPolygraph=1 AND vfst.NAME="Polígrafo", "1","0") AS Poligrafo, IF(bc.qualityPolygraphPQR=1 AND vfst.NAME="Polígrafo", "1","0") AS PoligrafoPQR, IF(bc.qualityPolygraphPNC=1 AND vfst.NAME="Polígrafo", "1","0") AS PoligrafoPNC,  bc.qualitytextPolygraph,
        IF(bc.qualityTest=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0") AS Pruebas_Psicotecnicas, IF(bc.qualityTestPQR=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0") AS PruebaPQR, IF(bc.qualityTestPNC=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0") AS PruebaPNC, bc.qualitytextTest,
        IF(bc.qualityReference=1 AND vfst.NAME="Referencias", "1","0") AS Reference, IF(bc.qualityReferencePQR=1 AND vfst.NAME="Referencias", "1","0") AS ReferencePQR, IF(bc.qualityReferencePNC=1 AND vfst.NAME="Referencias", "1","0") AS ReferencePNC, bc.qualitytextReference
        FROM ses_BackgroundCheck bc 
        JOIN ses_Customer ct ON ct.id=bc.customerId 
        JOIN ses_AssignedUser ass ON ass.backgroundCheckId=bc.id 
        JOIN ses_User us ON us.id=ass.userId 
        JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId 
        JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId 
        WHERE us.id="'.$idUser.'"
        AND ((bc.qualityEducation=1 AND vfst.NAME="Académico") OR (bc.qualityLaboral=1 AND vfst.NAME="Laboral") OR (bc.qualityFinanlcial=1 AND vfst.NAME="Financiero") OR (bc.qualityAdverse=1 AND vfst.NAME="Adversos") OR (bc.qualityVisit=1 AND vfst.NAME="Personas en la Vivienda") OR (bc.qualityPolygraph=1 AND vfst.NAME="Polígrafo") OR (bc.qualityTest=1 AND vfst.NAME="Pruebas Psicotécnicas") OR (bc.qualityReference=1 AND vfst.NAME="Referencias")) AND 
        DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>="'.$from.'" AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<="'.$until.'"
        AND vfst.name="'.$name.'"';
        $qualitySectionDetail = Yii::app()->db->createCommand($query_A)->queryAll();
        return $qualitySectionDetail;
    }
    //Fin

    public function searchSenior($pagesize=30) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        //$dateFrom="";
        //$dateUntil="";

        $criteria->compare('id', $this->id, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('firstName', $this->firstName, true);
        $criteria->compare('lastName', $this->lastName, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('userTypeId', $this->userTypeId);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('lastLogin', $this->lastLogin, true);
        $criteria->compare('lastLoginIP', $this->lastLoginIP, true);
        $criteria->compare('sessionValidUntil', $this->sessionValidUntil, true);
        $criteria->compare('sessionKey', $this->sessionKey, true);
        $criteria->compare('mustChangePassword', $this->mustChangePassword);
        $criteria->compare('isActive', $this->isActive);
        $criteria->compare('isInhouse', $this->isInhouse);
        $criteria->compare('state', $this->state, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('goal', $this->goal, true);
        $criteria->compare('area', $this->area, true);
        $criteria->compare('callManager', $this->callManager);    
        $criteria->compare('userSeniorType', $this->userSeniorType);  
        $criteria->compare('userSeniorId', $this->userSeniorId, true);  

       // $criteria->compare('assignedUsersSearch.userId', $this->id, true);

        $criteria->addCondition('userSeniorType=0');

        if(Yii::app()->user->id!=215){
            $criteriaSen = new CDbCriteria;
            $criteriaSen->addCondition('userSeniorId='.Yii::app()->user->id);
            $isSenior= User::model()->findAll($criteriaSen);
            if ($isSenior) {
                $criteria->addCondition('userSeniorId="'.Yii::app()->user->id.'"');
            }
        }
       
        GridViewFilter::setFilter($this, 'searchSenior');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('searchSenior'),
				'pageSize' => $pagesize,
            ),
            'sort' => array(
                'defaultOrder' => 'id ASC',
            ),
        ));
    }

    public function getProcessSeniorFinal($from, $until, $id) {

        if ($from=="") {
            $date1 = new \DateTime("first day of this Month");
            $from=$date1->format('Y-m-d H:i:s');
        } else {
            $from = (new \DateTime(CHtml::encode($from)))->format('Y-m-d H:i:s');
        }

        if ($until=="") {
            $date2 = new \DateTime(" "); //'first day of this Month'
            $until=$date2->format('Y-m-d H:i:s');
        } else {
            $until = (new \DateTime(CHtml::encode($until)))->format('Y-m-d H:i:s');
        }

        $criteria = new CDbCriteria;
        $criteria->addCondition('t.userId=:userId AND t.finishedAt between :from and :until AND t.finishedAt IS NOT NULL');
        $criteria->addCondition("verificationSection.verificationSectionTypeId!=8 AND verificationSection.verificationSectionTypeId!=24");
        $criteria->with=['verificationSection'];
        $criteria->params=[':from'=>$from, ':until'=>$until, ':userId'=>$id];
        $AllAssing= AssignedUser::model()->count($criteria);
        
        return $AllAssing;
        
    }


    public function getProcessSeniorExport($from, $until, $idSenior) {
        
        $query_A='SELECT CONCAT(us.firstName," ",us.lastName) AS Analista, Sum(if((ass.finishedAt IS NOT NULL), 1, 0)) as processFina, us.goal, us.userSeniorId
        FROM ses_AssignedUser ass 
        JOIN ses_User us ON ass.userId=us.id 
        JOIN ses_VerificationSection vs ON vs.id=ass.verificationSectionId
        WHERE ass.finishedAt BETWEEN "'.$from.'" AND "'.$until.'" AND us.userSeniorId="'.$idSenior.'" AND vs.verificationSectionTypeId!="24" AND vs.verificationSectionTypeId!="8"
        GROUP BY us.id ORDER BY us.userSeniorId ASC';
        $qualitySeniorFinal = Yii::app()->db->createCommand($query_A)->queryAll();
        return $qualitySeniorFinal;
    }

    public function getArrayPermission(){
        /*array('allow', // allow all users to perform 'index' and 'view' actions
        'users' => array('@'),
        'controllers' => array('mobile'),
        'actions' => array('pending', 'upload', 'download', 'login'),
        ),*/
        $controller=Yii::app()->controller->id;
        $action=Yii::app()->controller->action->id;
        //echo "controller: ".$controller." ";
        //echo "Action: ".$action." ";

        $permission=$this->getHasPermissionTo($controller, $action, null, true);
        //echo "permission: ".$permission." ";
        //echo $this->username;

        return [
            ($permission?'allow':'deny'),
            'users'=>[$this->username],
            'controllers'=>[$controller],
            'actions' =>[$action]
        ];

    }

    public function getPermissionsArray(){
        if(!$this->__permissionArray){
            $this->__permissionArray=[];
            //$this->permissions es Funcion getPermissions
            foreach($this->permissions as $perm){
                if(!isset($this->__permissionArray[md5($perm->controller).md5($perm->action)])){
                    $this->__permissionArray[md5($perm->controller).md5($perm->action)]=[];
                }
                if($perm->permission!=null){
                    $this->__permissionArray[md5($perm->controller).md5($perm->action)][$perm->permission]=true;
                }
            }
        }
        return $this->__permissionArray;
       
    }

    public function getHasPermissionTo($controller, $action, $permission=null, $log=false){
        $_permissions=$this->getPermissionsArray();
        $key=md5($controller).md5($action);
        if((($permission==null) && isset($_permissions[$key])) 
        || (isset($_permissions[$key][$permission]) && $_permissions[$key][$permission]=true)){
            return true;
        }else{
            if($log){
                WebUser::logAccess("ERROR, NO TIENE ACCESO: {$controller},{$action},".($permission==null?'ND':$permission)); 
            }
            return false;
        }
    }

    public function getPermissions(){

        $criteria = new CDbCriteria;

        $criteria->addCondition('users.id=:userId');
        $criteria->params = [':userId'=>$this->id];
        $criteria->with=['roles.users'];

        $permissions=Permission::model()->findAll($criteria);

        return $permissions;

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
        foreach ($this->userHasRoles as $userhasrole){
            if(array_key_exists($userhasrole->roleId, $newRoleIds)){
                //Borrar registro de un array con unset
                unset($newRoleIds[$userhasrole->roleId]);
            }else{
                $deleteRoles[]=$userhasrole->role->name;
                $userhasrole->delete();
            }
        }

        if(count($deleteRoles)>0){
            WebUser::logAccess("Elimino roles de usuario: ".$this->username.", Roles: ".implode(',',$deleteRoles));
        }

        $addRoles=[];
        foreach($newRoleIds as $newRoleId=>$val){
            $userHasRole=new UserHasRole();
            
            $userHasRole->userId=$this->id;
            $userHasRole->roleId=$newRoleId;
            $userHasRole->save();
            $userHasRole->refresh();
            $addRoles[]=$userHasRole->role->name;
        }
        
        if(count($addRoles)>0){
            WebUser::logAccess("Adiciono roles de usuario: ".$this->username.", Roles: ".implode(',',$addRoles));
        }
    }

    public function getRolesListstr(){
		return implode(', ', CHtml::listData($this->roles, 'id', 'name'));
	}

    public function getIsByRole(){
        return $this->userTypeId==UserType::SES_BY_ROLL;
    }

}
//comment
