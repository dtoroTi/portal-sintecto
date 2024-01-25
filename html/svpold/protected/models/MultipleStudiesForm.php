<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class MultipleStudiesForm extends CFormModel
{

    public $doc;
    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(

            array('doc', 
                'file',
                'types' => 'txt,csv',
                'maxSize' => 1024 * 100, // 100KB
                'tooLarge' => 'El archivo es mide más de 100KB. Por favor utilice un archivo mas pequeño.',
                'allowEmpty' => true,
                'wrongType'=>'El archivo debe ser terminado en .txt',
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
            'doc' => 'Archivo',
        );
    }
 }