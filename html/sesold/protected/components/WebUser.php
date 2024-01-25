<?php

// this file must be stored in:
// protected/components/WebUser.php

class WebUser extends CWebUser {

// Store model to not repeat query.
    private $_model;

// This is a function that checks the field 'role'
// in the User model to be equal to 1, that means it's admin
// access it by Yii::app()->user->isAdmin()
    public function getIsSupervisor($enforced = false, $log = false) {
        $ans = $this->isValidUser;
        if ($ans) {
            $customerUser = $this->arUser;
            $ans = ($customerUser->isSupervisor);
        }
        return $ans;
    }

// in the User model to be equal to 1, that means it's admin
// access it by Yii::app()->user->isAdmin()
    public function getIsGroupSupervisor($enforced = false, $log = false) {
        $ans = $this->isValidUser;
        if ($ans) {
            $customerUser = $this->arUser;
            $ans = ($customerUser->isSupervisor && $customerUser->isGroupSupervisor);
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
                        // No control of IP requested because the Load Balance connection have more than 1 ip
                        //($user->lastLoginIP == $_SERVER["REMOTE_ADDR"]) &&
                        ($user->isActive == TRUE)) {
                    if ($log) {
                        WebUser::logAccess();
                    }
                    $ans = true;
                } else {
                    if ($log) {
                        WebUser::logAccess("Invalid Access, logged out");
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
            if ($id !== null)
                $this->_model = CustomerUser::model()->findByPk($id);
        }
        return $this->_model;
    }

    public static function logAccess($comments = null, $backgroundCheckCode = null, $customerUserId = null) {
        static $_lineNumber = 0;
        static $_logId = null;


        if ((!Yii::app()->user->isGuest && Yii::app()->user->id > 0) || $customerUserId != null) {
            if ($_lineNumber === 1 && $_logId > 0) {
                $log = Log::model()->findByPk($_logId);
            } else {
                if (!$customerUserId) {
                    $customerUserLogin = Yii::app()->user->name;
                }else{
                    $customerUser= CustomerUser::model()->findByPk($customerUserId);
                    if ($customerUser){
                        $customerUserLogin=$customerUser->username;
                    }else{
                        $customerUserLogin='';
                        $comments.="Error with User:".$customerUserId;
                    }
                }
                $log = new Log();
                $log->serverName = $_SERVER['SERVER_NAME'];
                if (Yii::app()->controller->module) {
                    $log->module = Yii::app()->controller->module->id;
                }
                $log->controller = Yii::app()->controller->id;
                $log->action = Yii::app()->controller->action->id;
                $log->customerUserLogin = $customerUserLogin;
            }
            $log->comments = $log->comments . $comments;
            $log->ip = $_SERVER['REMOTE_ADDR'];
            $log->backgroundCheckCode = $backgroundCheckCode;

            try {
                if (!$log->save()) {
                    Yii::log(__FILE__ . "[" . __LINE__ . "]Error with Log:" . serialize($log->errors), "trace", "ZWF." . __CLASS__);
                }
                $_logId = $log->id;
                $_lineNumber = $_lineNumber + 1;
            } catch (Exception $e) {
                Yii::log(__FILE__ . "[" . __LINE__ . "]Error with Log:" . serialize($e), "error", "ZWF." . __CLASS__);
                Yii::app()->user->logout();
            }
        }
    }

    public static function setTermsAccepted() {
        Yii::app()->user->setState('termsAccepted', TRUE);
    }

    public static function getTermsAccepted() {
        return (Yii::app()->user->getState('termsAccepted', FALSE));
    }

    public function sendMailInBackground($subject, $body, $to, $cc = null, $bcc = null, $files = null) {
        $params = array(
            'subject' => $subject,
            'body' => $body,
            'to' => $to,
            'cc' => $cc,
            'bcc' => $bcc,
            'files' => $files,
        );

        $filename = uniqid("svp_m_", true) . ".dat";
        $filenameLog = BackgroundCheck::getFullPath("mail.log");

        file_put_contents(BackgroundCheck::getFullPath($filename), serialize($params));

        exec("/usr/bin/php " . Yii::app()->basePath . "/yiic svpmail {$filename}  >> {$filenameLog} 2>&1  &");

        return true;
    }

}
