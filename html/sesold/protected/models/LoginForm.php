<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
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
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, verifyCode', 'required'),
			// rememberMe needs to be a boolean
            array('otp','safe'),
			// password needs to be authenticated
			array('password', 'authenticate'),

              //validar captcha
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'message'=>'El valor es incorrecto'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
            'verifyCode'=>'Código de Verificación'
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */

	/*
	public function authenticate($attribute,$params)
	{



		if(!$this->hasErrors())		{
			$this->_identity=new UserIdentity($this->username,$this->password,$this->otp);
			if(!$this->_identity->authenticate())
				$this->addError('password','Usuario, Palabra clave o Llave equivocadas.');
		}
	}
*/

    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->password, $this->otp);
            $usuario=str_replace("'","%",$this->username ) ;

            if (!$this->_identity->authenticate())
            {
                $user = CustomerUser::model()->findByAttributes(array('username' => $usuario));

                if($user && $user->loggingattempts<4 && $user->isActive==1)
                {
                    $user->loggingattempts++;
                    $user->save();
                }elseif($user){
                    $user->isActive=0;
                    $user->loggingattempts=0;
                    $user->save();
                }

                $this->addError('password', 'Usuario, Palabra clave o llave incorrecta.');
                $this->addError('password', 'Recuerda que luego de 5 intentos errados tu cuenta será bloqueada.');
            }

            else
            {
                $this->_identity->user->loggingattempts=0;
                $this->_identity->user->save();
                /*$query = "UPDATE ses_CustomerUser SET loggingattempts=0 WHERE  username='".$usuario."';";
                $query = Yii::app()->db->createCommand($query)->execute();*/
            }
        }
    }

    /**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password, $this->password,$this->otp);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			//$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,0);
			return true;
		}
		else
			return false;
	}
}
