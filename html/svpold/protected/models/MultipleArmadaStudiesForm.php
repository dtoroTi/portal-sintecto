<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class MultipleArmadaStudiesForm extends CFormModel
{

    public $doc;
    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(

            array('doc', 
                'file',
                'types' => 'csv',
                'allowEmpty' => false,
                'wrongType'=>'El archivo debe ser una hoja de cálculo de Excel',
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