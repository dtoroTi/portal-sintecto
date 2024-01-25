<?php

// this file must be stored in:
// protected/components/WebUser.php

class WebUser extends CWebUser {

// Store model to not repeat query.
    private $_model;
    
  

// This is a function that checks the field 'role'
// in the User model to be equal to 1, that means it's admin
// access it by Yii::app()->user->isAdmin()
    function getIsSuperAdmin($enforced = false, $log = false) {
        $ans = false;
        if ($this->isValidUser) {
            $user = $this->loadUser(Yii::app()->user->id);
            if ($user) {
                if ($user->isSuperAdmin) {
                    if ($log) {
                        WebUser::logAccess();
                    }
                    $ans = true;
                } else {
// Redirect the page to Login
                    if ($log) {
                        WebUser::logAccess("Invalid ADMIN Access, logged out");
                    }
                    $ans = false;
                    if ($enforced) {
                        Yii::app()->user->logout();
                        Yii::app()->request->redirect('/site/logout');
                    }
                }
            } else {
                $ans = false;
            }
        }
        return $ans;
    }

    function getIsBilling($enforced = false, $log = false) {
        $ans = false;
        if ($this->isValidUser) {
            $user = $this->loadUser(Yii::app()->user->id);
            if ($user) {
                if ($user->isBilling) {
                    if ($log) {
                        WebUser::logAccess();
                    }
                    $ans = true;
                } else {
// Redirect the page to Login
                    if ($log) {
                        WebUser::logAccess("Invalid ADMIN Access, logged out");
                    }
                    $ans = false;
                    if ($enforced) {
                        Yii::app()->user->logout();
                    }
                }
            }
        }
        return $ans;
    }

    function isInManagerList($user){
        $_manger_users = array(
            'lzubieta@sintecto.com','admin@svision.co', 'ngonzalez@sintecto.com','jcocoma@sintecto.com','pvargas@sintecto.com',
             'wlugo@svision.co', 'wlugo@sintecto.com', 'fperez@sintecto.com','nhenao@sintecto.com','hgutierrez@sintecto.com',
              'mflorez@sintecto.com', 'srodriguez@sintecto.com', 'nbarrera@sintecto.com', 'acastellanos@sintecto.com',
               'ygonzalez@sintecto.com', 'jsantana@sintecto.com','ilara@sintecto.com','jcuellar@sintecto.com', 'mpaez@sintecto.com',
                'jmontero@sintecto.com', 'mguzman@sintecto.com', 'mgonzalez@sintecto.com', 'emadrigal@sintecto.com');
        return in_array($user, $_manger_users);
    }
    
    function getIsManager($enforced = false, $log = false) {
        return (($this->getIsSuperAdmin($enforced, $log) || Yii::app()->user->getIsByRole()) && $this->isInManagerList($this->name));
    }

    //Inicio Funciones Proceso para validar que usuarios pueden modificar la fecha de calidad en la informacion del estudio
    function isItList($user){
        $_manger_users = array(
           'jcocoma@sintecto.com', 'nhenao@sintecto.com', 'ngonzalez@sintecto.com');
        return in_array($user, $_manger_users);
    }
    function getIsIt($enforced = false, $log = false) {
        return (($this->getIsSuperAdmin($enforced, $log) || Yii::app()->user->getIsByRole()) && $this->isItList($this->name));
    }
    //Fin funciones

    function getIsReportManager($enforced = false, $log = false) {
        $users = array(
            'lzubieta@sintecto.com','admin@svision.co','ngonzalez@sintecto.com','sduarte@svision.co','jcocoma@sintecto.com',
            'pvargas@sintecto.com','nhenao@sintecto.com','hgutierrez@sintecto.com', 'mpaez@sintecto.com');
        return ( in_array($this->name, $users));
    }

    //Inificio Funciones Proceso para validar que usuarios pueden modificar la fecha de calidad en la informacion del estudio
    function isQualityDateList($user){
        $_manger_users = array('acastellanos@sintecto.com','jsantana@sintecto.com','wlugo@svision.co', 'wlugo@sintecto.com',
        'nhenao@sintecto.com','jcocoma@sintecto.com','ngonzalez@sintecto.com','ygonzalez@sintecto.com','ilara@sintecto.com',
        'nbarrera@sintecto.com','hgutierrez@sintecto.com');
        return in_array($user, $_manger_users);
    }
    function getIsQualityDate($enforced = false, $log = false) {
        return (($this->getIsSuperAdmin($enforced, $log) || Yii::app()->user->getIsByRole()) && $this->isQualityDateList($this->name));
    }
    //Fin fuinciones

    //Inicio funcion que permite verificar que usuarios pueden ver las solicitudes SAC 
    function isRequestsSAC($user){

        $_manger_users = array(
            'jcocoma@sintecto.com', 'wlugo@svision.co','wlugo@sintecto.com','acastellanos@sintecto.com', 'nbarrera@sintecto.com',
             'ygonzalez@sintecto.com', 'dmoreno@sintecto.com', 'ilara@sintecto.com', 'jsantana@sintecto.com', 'lvelasco@sintecto.com',
              'jcuellar@sintecto.com', 'nhenao@sintecto.com','ngonzalez@sintecto.com', 'sromero@sintecto.com', 'dduarte@sintecto.com',
               'mpaez@sintecto.com', 'ediaz@sintecto.com','lhenao@sintecto.com', 'fvargas@sintecto.com', 'pvargas@sintecto.com');
        return in_array($user, $_manger_users);
    }
    function getIsRequestsSAC($enforced = false, $log = false) {
        return (($this->getIsSuperAdmin($enforced, $log) || Yii::app()->user->getIsByRole()) && $this->isRequestsSAC($this->name));
    }
    //Fin funciones

    //Inicio funcion que permite verificar que usuarios pueden ver los resultados de operaciones 
    function isResultOperation($user){

    $_manger_users = array(
        'jcocoma@sintecto.com','nhenao@sintecto.com','ngonzalez@sintecto.com','wlugo@svision.co','wlugo@sintecto.com', 'mgomez@sintecto.com',
        'acastellanos@sintecto.com','jsantana@sintecto.com','ilara@sintecto.com', 'ygonzalez@sintecto.com', 'mquintero@sintecto.com',
         'nbarrera@sintecto.com','mflorez@sintecto.com', 'jtabarez@sintecto.com', 'dgonzalez@sintecto.com');
    return in_array($user, $_manger_users);
    }
    function getIsResultOperation($enforced = false, $log = false) {
        return (($this->getIsSuperAdmin($enforced, $log) || Yii::app()->user->getIsByRole()) && $this->isResultOperation($this->name));
    }
    //Fin funciones

    //Inicio funcion que permite iniciar estudios con recaudo 
    function isRecoverStudy($user){

    $_manger_users = array(
        'jcocoma@sintecto.com','nhenao@sintecto.com','ngonzalez@sintecto.com','hgutierrez@sintecto.com','cbarrera@svision.co');
    return in_array($user, $_manger_users);
    }
    function getIsRecoverStudy($enforced = false, $log = false) {
        return (($this->getIsSuperAdmin($enforced, $log) || Yii::app()->user->getIsByRole()) && $this->isRecoverStudy($this->name));
    }
    //Fin funciones

    //Inicio Funciones Proceso para validar que usuarios de SAC pueden modificar la plantilla Desc de la opcion producto
    function isSacList($user){
        $_manger_users = array('lvelasco@sintecto.com', 'dduarte@sintecto.com', 'mpaez@sintecto.com', 'jcuellar@sintecto.com',
         'ediaz@sintecto.com');
        return in_array($user, $_manger_users);
    }
    function getIsSac($enforced = false, $log = false) {
        return (($this->getIsSuperAdmin($enforced, $log) || Yii::app()->user->getIsByRole()) && $this->isSacList($this->name));
    }
    //Fin funciones

    
    //Inicio funcion que permite accesos a procesos de acuerdos
    function isAgreements($user){
        $_manger_users = array(
            'jcocoma@sintecto.com','nhenao@sintecto.com', 'ngonzalez@sintecto.com','jcuellar@sintecto.com','pvargas@sintecto.com');
        return in_array($user, $_manger_users);
        }
        function getIsAgreements($enforced = false, $log = false) {
            return (($this->getIsSuperAdmin($enforced, $log) || Yii::app()->user->getIsByRole()) && $this->isAgreements($this->name));
        }
    //Fin funciones
    
    //Inicio Funciones Proceso para validar que usuarios pueden ver el proceso de nuevos instructivos
    function isDescription($user){
        $_manger_users = array(
           'jcocoma@sintecto.com','nhenao@sintecto.com', 'wlugo@sintecto.com','acastellanos@sintecto.com', 'ygonzalez@sintecto.com',
            'mquintero@sintecto.com', 'squintero@sintecto.com', 'jsantana@sintecto.com', 'ccruz@sintecto.com', 'mguzman@sintecto.com',
            'nbarrera@sintecto.com','ngonzalez@sintecto.com', 'jayala@sintecto.com');
        return in_array($user, $_manger_users);
    }
    function getIsDescription($enforced = false, $log = false) {
        return (($this->getIsSuperAdmin($enforced, $log) || Yii::app()->user->getIsByRole()) && $this->isDescription($this->name));
    }
    //Fin funciones

    function getIsCustomerPriceYearAnt(){
        if(Yii::app()->user->name == 'jcocoma@sintecto.com' || Yii::app()->user->name == 'ngonzalez@sintecto.com' || Yii::app()->user->name == 'nhenao@sintecto.com'){
            return $disabled='';
        }else{
            return $disabled='disabled';
        }
    }

    function getIsAdmin($enforced = false, $log = false) {
        $ans = false;
        if ($this->isValidUser) {
            $user = $this->loadUser(Yii::app()->user->id);
            if ($user) {
                if ($user->isAdmin) {
                    $ans = true;
                    if ($log) {
                        WebUser::logAccess();
                    }
                } else {
                    $ans = false;
                    if ($log) {
                        WebUser::logAccess("Invalid ADMIN Access, logged out");
                    }
                    if ($enforced) {
                        Yii::app()->user->logout();
                    }
                }
            }
        }
        return $ans;
    }

    function getIsSesUser($enforced = false, $log = false) {
        $ans = false;
        if ($this->isValidUser) {
            if (UserType::isSesUser($this->arUser->userTypeId)) {
                $ans = true;
            } else {
                if ($log) {
                    WebUser::logAccess("Invalid ADMIN Access, logged out");
                }
                $ans = false;
                if ($enforced) {
                    Yii::app()->user->logout();
                }
            }
        }
        return $ans;
    }

    function getIsUser($enforced = false, $log = false) {
        $ans = false;
        if ($this->isValidUser) {
            $user = $this->loadUser(Yii::app()->user->id);
            if ($user) {
                if ($user->isUser) {
                    $ans = true;
                    if ($log) {
                        WebUser::logAccess();
                    }
                } else {
                    $ans = false;
                    if ($log) {
                        WebUser::logAccess("Invalid ADMIN Access, logged out");
                    }
                    if ($enforced) {
                        Yii::app()->user->logout();
                    }
                }
            }
        }
        return $ans;
    }

    function getIsUserCustomer($enforced = false, $log = false) {
        $ans = false;
        if ($this->isValidUser) {
            $user = $this->loadUser(Yii::app()->user->id);
            if ($user) {
                if ($user->isUserCustomer) {
                    $ans = true;
                    if ($log) {
                        WebUser::logAccess();
                    }
                } else {
                    $ans = false;
                    if ($log) {
                        WebUser::logAccess("Invalid ADMIN Access, logged out");
                    }
                    if ($enforced) {
                        Yii::app()->user->logout();
                    }
                }
            }
        }
        return $ans;
    }

// This is a function that checks the field 'role'
// in the User model to be equal to 1, that means it's admin
// access it by Yii::app()->user->isAdmin()
    function getIsValidUser($log = false) {
        $ans = false;
        if (!Yii::app()->user->isGuest) {
            $user = $this->loadUser(Yii::app()->user->id);
            if ($user) {
                if (($user->sessionKey == Yii::app()->user->sid) &&
                        // This has to be removed because the load balance that company has.
                        //($user->lastLoginIP == $_SERVER["REMOTE_ADDR"]) && 
                        ($user->isActive == TRUE)) {
                    if ($log) {
                        WebUser::logAccess();
                    }
                    $ans = true;
                } else {
                    if ($log) {
                        WebUser::logAccess("Invalid Access, logged out. [" . $user->sessionKey . "][" . Yii::app()->user->sid . "]");
                    }
                    $ans = false;
                    Yii::app()->user->logout();
                    Yii::app()->request->redirect('/site/logout');
                }
            }
        }
        return $ans;
    }

    function getArUser() {
        return $this->loadUser(Yii::app()->user->id);
    }

// Load user model.
    protected function loadUser($id = null) {
        if ($this->_model === null) {
            if ($id !== null){
                $this->_model = User::model()->findByPk($id);
            }
        }
        return $this->_model;
    }

    //proceso para almacenar log de secciones Herman, Jonathan y Natalia 
    //18/08/2021
    public static function logRecordChange($comments, $backgroundCheckCode, $class, $arrA, $arrB){
        
        $answer=array_diff_assoc($arrA, $arrB);

        if(count($answer)>0){
            $obj= new $class();
            foreach($answer as $key=>$val){
                $detail='';
                if($key=='resultId'){
                    $val=Result::model()->findByPk($val)->name;
                    $detail="={$val}";
                }
                $label=$obj->getAttributeLabel($key);
                $comments .="[{$label}{$detail}],";
            }
            WebUser::logAccess($comments, $backgroundCheckCode, true);
        }
    }

    public static function logAccess($comments = null, $backgroundCheckCode = null, $force = FALSE, $user=null) {
        static $_lineNumber = 0;
        static $_logId = null;


        if ((!Yii::app()->user->isGuest && Yii::app()->user->id > 0) || $force) {
            if ($_lineNumber === 1 && $_logId > 0) {
                $log = Log::model()->findByPk($_logId);
            } else {
                if (!Yii::app()->user->isGuest) {
                    $username = Yii::app()->user->name;
                } else {
                    $username = ($user==null?'':$user);
                }
                $log = new Log();
                $log->serverName = $_SERVER['SERVER_NAME'];
                if (Yii::app()->controller->module) {
                    $log->module = Yii::app()->controller->module->id;
                }
                $log->controller = Yii::app()->controller->id;
                $log->action = Yii::app()->controller->action->id;
                $log->userLogin = $username;
                $log->ip = $_SERVER['REMOTE_ADDR'];
            }
            $log->comments = $log->comments . $comments;
            $log->backgroundCheckCode = $backgroundCheckCode;

            try {
                if (!$log->save()) {
                    Yii::log("Error with Log:" . serialize($log->errors), "error", "ZWF." . __CLASS__);
                }
                $_logId = $log->id;
                $_lineNumber = $_lineNumber + 1;
            } catch (Exception $e) {
                Yii::log(__FILE__ . "[" . __LINE__ . "]Error with Log:" . serialize($e), "error", "ZWF." . __CLASS__);
                Yii::app()->user->logout();
            }
        }
    }

    public function sendMailInBackground($subject, $body, $to, $cc = null, $bcc = null, $filename=null, $sender=null) {

        $params = array(
            'subject' => $subject,
            'body' => $body,
            'to' => $to,
            'cc' => $cc,
            'bcc' => $bcc,
            'files'=>$filename,
            'sender'=>$sender,
        );

        $filename = Yii::app()->basePath . "/runtime/" . uniqid("svp_m_", true) . ".dat";
        $filenameLog = Yii::app()->basePath . "/runtime/mail.log";

        file_put_contents($filename, serialize($params));


        //$dato="/usr/bin/php " . Yii::app()->basePath . "/yiic svpmail {$filename}  >> {$filenameLog} 2>&1  &";
        exec("/usr/bin/php " . Yii::app()->basePath . "/yiic svpmail {$filename}  >> {$filenameLog} 2>&1  &");

        return true;
    }


    public function getIsRegisteredIP() {
        return (in_array($_SERVER['REMOTE_ADDR'], Yii::app()->params['registeredIp'], TRUE));
    }

    function getIsByRole() {
        return $this->arUser && $this->arUser->getIsByRole();
    } 

    public function getHasPermissionToControllerAction($controller, $action, $permission=null){
        return $this->arUser && $this->arUser->getHasPermissionTo($controller, $action, $permission);
    }

    public function getHasPermissionTo($permission=null){
        return $this->getHasPermissionToControllerAction(Yii::app()->controller->id, Yii::app()->controller->action->id, $permission);
    }

    public function getHasGlobalPermissionTo($permission=null){
        return $this->getHasPermissionToControllerAction('___', '___', $permission);
    }

    public function getHasPermissionInControllerTo($permission=null){
        return $this->getHasPermissionToControllerAction(Yii::app()->controller->id, '___', $permission);
    }

}
//comment
