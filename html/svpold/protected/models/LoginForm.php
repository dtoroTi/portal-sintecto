<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel {

    public $username;
    public $password;
    public $otp;
    public $verifyCode;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('username, password, verifyCode', 'required'),
            array('password', 'authenticate'),
            array('otp', 'safe'),
            //validar captcha
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'message'=>'El valor es incorrecto'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'username' => 'Usuario (email)',
            'password' => 'Palabra Clave',
            'verifyCode'=>'Código de Verificación'
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->password, $this->otp);
            $usuario=str_replace("'","%",$this->username ) ;
            if (!$this->_identity->authenticate())
            {

                $activelog = "SELECT isActive FROM ses_User WHERE  username='".$usuario."';";
                $activelog = Yii::app()->db->createCommand($activelog)->queryScalar();

                $query = "SELECT loggingattempts FROM ses_User WHERE  username='".$usuario."';";
                $query = Yii::app()->db->createCommand($query)->queryScalar();

              $cant = $query+1;
                if($query<4 && $activelog==1)
                {
               $query = "UPDATE ses_User SET loggingattempts='".$cant."' WHERE  username='".$usuario."';";
               $query = Yii::app()->db->createCommand($query)->execute();

                    if($cant==1){
                        $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                        $this->addError('password', 'Recuerda que luego de 5 intentos errados tu cuenta será bloqueada.');}
                    elseif ($cant==2){
                        $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                        $this->addError('password', 'Recuerda que luego de 5 intentos errados tu cuenta será bloqueada.');}
                    elseif ($cant==3){
                        $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                        $this->addError('password', 'Recuerda que luego de 5 intentos errados tu cuenta será bloqueada.');}
                    elseif ($cant==4){
                        $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                        $this->addError('password', 'Recuerda que luego de 5 intentos errados tu cuenta será bloqueada.');}

                }
                else{
                    $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                    $this->addError('password', 'Recuerda que luego de 5 intentos errados tu cuenta será bloqueada.');

                    $query = "UPDATE ses_User SET isActive=0 WHERE  username='".$usuario."';";
                    $query = Yii::app()->db->createCommand($query)->execute();
                    $query = "UPDATE ses_User SET loggingattempts=0 WHERE  username='".$usuario."';";
                    $query = Yii::app()->db->createCommand($query)->execute();
                }

                /*
                $failedCount = Yii::app()->user->hasState('loginFailed') ?  Yii::app()->user->getState('loginFailed') : 0;
                $failedCount++;
                Yii::app()->user->setState('loginFailed',$failedCount);

      //echo $this->username;
                if($failedCount==1){
                    $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                    $this->addError('password', 'Te quedan 4 Intentos para que tu cuenta sea bloqueada.');}
                elseif ($failedCount==2){
                    $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                    $this->addError('password', 'Te quedan 3 Intentos para que tu cuenta sea bloqueada.');}
                elseif ($failedCount==3){
                    $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                    $this->addError('password', 'Te quedan 2 Intentos para que tu cuenta sea bloqueada.');}
                elseif ($failedCount==4){
                    $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                    $this->addError('password', 'Te quedan 1 Intentos para que tu cuenta sea bloqueada.');}
                elseif ($failedCount>4){
                    $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                    $this->addError('password', 'SU CUENTA FUE BLOQUEADA POR FAVOR COMINICARSE CON UN ADMINISTRADOR.');

                    $query = "UPDATE ses_User SET isActive=0 WHERE  username='".$this->username."';";
                    $query = Yii::app()->db->createCommand($query)->execute();

                }
      /*
                switch ($failedCount){

                    case 1:
                        $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                        $this->addError('password', 'Te quedan 4 Intentos para que tu cuenta sea bloqueada.');
                        break;

                    case 2:
                        $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                        $this->addError('password', 'Te quedan 3 Intentos para que tu cuenta sea bloqueada.');
                        break;

                    case 3:
                        $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                        $this->addError('password', 'Te quedan 2 Intentos para que tu cuenta sea bloqueada.');
                        break;

                    case 4:
                        $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                        $this->addError('password', 'Te quedan 1 Intentos para que tu cuenta sea bloqueada.');
                        break;

                    default:
                        $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                        $this->addError('password', 'SU CUENTA FUE BLOQUEADA POR FAVOR COMINICARSE CON UN ADMINISTRADOR.');

                        break;

                }
      */

            }

            else
            {
                $query = "UPDATE ses_User SET loggingattempts=0 WHERE  username='".$usuario."';";
                $query = Yii::app()->db->createCommand($query)->execute();
            }
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {

        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password,$this->otp);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
//      $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days

            Yii::app()->user->login($this->_identity, 0);
            return true;
        }
        else
            return false;
    }

}
