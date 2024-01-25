<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class SDNSearchForm extends CFormModel {

  public $lastname;
  public $firstname;
  public $remarks;
  public $doNotIncludePrepositions = true;
  public $oneFirstnameOneLastname = true;
  public $allLastnames = true;
  public $uploadedFile;
  public $sdnTypeId;


  /**
   * Declares the validation rules.
   * The rules state that username and password are required,
   * and password needs to be authenticated.
   */
  public function rules() {
    return array(
        array('firstname, lastname, remarks', 'checkPlainEnglish'),
        array('firstname, lastname, remarks, sdnTypeId', 'length', 'max' => 350),
        array('doNotIncludePrepositions, oneFirstnameOneLastname, allLastnames', 'boolean'),
        array(
            'uploadedFile',
            'file',
            'types' => 'txt',
            'maxSize' => 1024 * 1024 * 4, // 3MB 
            'tooLarge' => 'El archivo es mide más de 1MB. Por favor utilice un archivo mas pequeño.',
            'allowEmpty' => true,
            'wrongType' => 'Los tipos de archivo permitidos son: txt. Por favor utilice alguno de estos tipos',
        ),
        array('uploadedFile', 'safe'),
    );
  }

  /**
   * Declares attribute labels.
   */
  public function attributeLabels() {
    return array(
        'lastname' => 'Apellidos',
        'firstname' => 'Nombres',
        'remarks' => 'Identificación/Otros',
        'doNotIncludePrepositions' => 'No Incluya:"de","y"',
        'oneFirstnameOneLastname' => 'Un Nombre y un Apellido',
        'allLastnames' => 'Todos los apellidos',
        'sdnTypeId' => 'Tipo SDN'
    );
  }

  public function checkPlainEnglish($attribute, $params) {
    $this->$attribute = SDN::plainEnglish($this->$attribute);
    return true;
  }

}

