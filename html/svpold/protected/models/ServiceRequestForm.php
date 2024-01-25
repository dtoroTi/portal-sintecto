<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ServiceRequestForm extends CFormModel {

  public $customerProductId;
  public $firstName;
  public $lastName;
  public $idNumber;
  public $city;
  public $applicantTel;
  public $customerField1;
  public $customerField2;
  public $customerField3;
  public $doc;
  public $comments;

  /**
   * Declares the validation rules.
   */
  public function rules() {
    return array(
        // name, email, subject and body are required

        array('customerProductId, firstName, lastName, idNumber, city, applicantTel', 'required'),
        // email has to be a valid email address
        array('customerField1, customerField2, customerField3,comments', 'safe'),
        // verifyCode needs to be entered correctly
        //			array('comments', 'safe'),

        array('doc',
            'file',
            'types' => 'jpg, gif, png, pdf, doc, docx',
            'maxSize' => 1024 * 1024 * 30, // 30MB
            'tooLarge' => 'El archivo es mide más de 30MB. Por favor utilice un archivo mas pequeño.',
            'allowEmpty' => true,
            'wrongType' => 'Los tipos de archivo permitidos son: doc,docx,pdf y jpg. Por favor utilice alguno de estos tipos',
        ),
    );
  }

  /**
   * Declares customized attribute labels.
   * If not declared here, an attribute would have a label that is
   * the same as its name with the first letter in upper case.
   */
  public function attributeLabels() {
    return array(
        'requestedEmail' => 'Requerido por (email)',
        'applicantType' => 'Tipo de Aspirante',
        'firstName' => 'Nombres del Aspirante',
        'lastName' => 'Appellidos del Aspirante',
        'applicantTel' => 'Teléfono del Aspirante',
        'idNumber' => 'Documento de Identidad del Aspirante',
        'customerField1'=> 'Campo de Cliente 1',
        'customerField2'=> 'Campo de Cliente 2',
        'customerField3'=> 'Campo de Cliente 3',
        'comments' => 'Comentarios y notas',
        'customerProductId'=> 'Tipo de Estudio',
        'doc' => 'Documento Relacionado',
        'city' => 'Ciudad',
    );
  }

}