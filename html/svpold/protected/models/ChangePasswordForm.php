<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ChangePasswordForm extends CFormModel {

    public $password;
    public $newPassword1;
    public $newPassword2;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('password,newPassword1,newPassword2', 'required'),
            // password needs to be authenticated
//			array('password', 'validate'),
            array('newPassword1', 'compare', 'compareAttribute' => 'newPassword2',
                'message' => 'La palabra clave nueva y la confirmación deben ser iguales'),
            array('newPassword1', 'PasswordStrength', 'strength' => 'strong', 'allowEmpty' => false),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'password' => 'Palabra clave actual',
            'newPassword1' => 'Nueva palabra clave',
            'newPassword2' => 'Confirmación de la nueva palabra clave',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function validate($attributes = NULL, $clearErrors = true) {
        parent::validate();
        if (!$this->hasErrors()) {  // we only want to authenticate when no input errors
            $user = User::model()->findByPk(Yii::app()->user->getId());
            if (!$user->validatePassword($this->password)) {
                $this->addError('password', 'Su password no coincide con el password actual.');
                return false;
            } else {
                return true;
            }
        }
    }

}
