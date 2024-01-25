<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class DocForm extends CFormModel {

    public $doc1;
    public $doc2;
    public $doc3;
    public $doc4;
    public $doc5;
    public $doc6;
    public $doc7;
    public $doc8;
    public $doc9;
    public $doc10;
    public $doc11;
    public $doc12;
    public $doc13;
    public $doc14;
    public $doc15;
    public $doc16;
    public $doc17;
    public $doc18;
    public $doc19;
    public $doc20;
    public $doc21;
    public $doc22;
    public $doc23;
    public $doc24;
    public $doc25;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // @TODO Fix the doc to doc Array
            array('doc1,doc2,doc3,doc4,doc5,doc6,doc7,doc8,doc9,doc10,'.
                'doc11,doc12,doc13,doc14,doc15,doc16,doc17,doc18,doc19,doc20,'.
                'doc21,doc22,doc23,doc24,doc25',
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
        $ans=array();
        for($i=1;$i<=25;$i++){
            $ans["doc{$i}"]="Doc. Relacionado {$i}";
        }
        return $ans;
    }

}
