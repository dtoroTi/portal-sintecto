<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

  public $otp = "";
  public $user = null;

  public function __construct($user, $password, $otp) {
    parent::__construct($user, $password);
    $this->otp = $otp;
  }

  public function authenticate() {

    $user = CustomerUser::model()->findByAttributes(array('username' => $this->username));

    if ($user === null) {
      $this->errorCode = self::ERROR_USERNAME_INVALID;
    } else if (!$user->validateOtp($this->otp)|| !$user->validateOtpG($this->otp)) {
      $this->errorCode = self::ERROR_PASSWORD_INVALID;
    } else if (!$user->validatePassword($this->password)) {
      $this->errorCode = self::ERROR_PASSWORD_INVALID;
    } else if (!$user->isActive) {
      $this->errorCode = self::ERROR_PASSWORD_INVALID;
    } else {
      $this->user = $user;
      if (!$user->setlastLogin()) {
        $this->errorCode = self::ERROR_PASSWORD_INVALID;
      } else {
        $this->errorCode = self::ERROR_NONE;
      }
      Yii::app()->user->setState('sid', $user->sessionKey);
    }
    return !$this->errorCode;
  }

  public function getId() {
    return $this->user->id;
  }

}
