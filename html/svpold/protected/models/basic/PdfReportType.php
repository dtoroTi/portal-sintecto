<?php

/**
 * This is the model class for table "{{PdfReportType}}".
 *
 * The followings are the available columns in table '{{PdfReportType}}':
 * @property integer $id
 * @property string $name
 * @property string $header
 * @property string $footer
 * @property string $body
 * @property double $topMargin
 * @property double $bottomMargin
 * @property double $leftMargin
 * @property double $rightMargin
 * @property double $headerMargin
 * @property double $footerMargin
 * @property integer $defaultFontSize
 * @property string $defaultFont
 * @property double $footerOffset  
 * @property double $markY
 * @property double $markX
 * @property int $isCertificate Is Certificate Report
 * @property int $islogSintecto Is logo Repsintecto
 *
 * The followings are the available model relations:
 * @property CustomerProduct[] $customerProducts
 */
class PdfReportType extends CActiveRecord {

    private $_pdf = null;
    private $_backgroundCheck = null;
    public static $fontTypes = array(
        'courier' => 'courier',
        'helvetica' => 'helvetica',
        'symbol' => 'symbol',
        'times' => 'times',
        'zapfdingbats' => 'zapfdingbats',
        'dejavusans' => 'dejavusans',
    );
    private static $_allowedVars = null;
    public static $allowedVars = array(
        'rep_fullName' => array(
            'name' => 'rep_fullName',
            'sample' => 'Nombre de Persona',
            'menu' => 'Nombre Completo',
            'description' => 'Nombre completo del Candidato',
            'value' => 'fullName',
            'sec' => 'Rep',
        ),
        'rep_code' => array(
            'name' => 'rep_code',
            'sample' => 'AA11AA22',
            'menu' => 'Código de Reporte',
            'description' => 'Código de Reporte',
            'value' => 'code',
            'sec' => 'Rep',
        ),
        'rep_customerFieldName1' => array(
            'name' => 'rep_customerFieldName1',
            'sample' => 'Campo Personalizado 1',
            'menu' => 'Campo Personalizado 1',
            'description' => 'Campo Personalizado 1',
            'value' => 'customer->field1',
            'sec' => 'Rep',
        ),
        'rep_customerField1' => array(
            'name' => 'rep_customerField1',
            'sample' => 'Valor Personalizado 1',
            'menu' => 'Valor Personalizado 1',
            'description' => 'Valor Personalizado 1',
            'value' => 'customerField1',
            'sec' => 'Rep',
        ),
        'rep_customerFieldName2' => array(
            'name' => 'rep_customerFieldName2',
            'sample' => 'Campo Personalizado 2',
            'menu' => 'Campo Personalizado 2',
            'description' => 'Campo Personalizado 2',
            'value' => 'customer->field2',
            'sec' => 'Rep',
        ),
        'rep_customerField2' => array(
            'name' => 'rep_customerField2',
            'sample' => 'Valor Personalizado 2',
            'menu' => 'Valor Personalizado 2',
            'description' => 'Valor Personalizado 2',
            'value' => 'customerField2',
            'sec' => 'Rep',
        ),
        'rep_customerFieldName3' => array(
            'name' => 'rep_customerFieldName3',
            'sample' => 'Campo Personalizado 3',
            'menu' => 'Campo Personalizado 3',
            'description' => 'Campo Personalizado 3',
            'value' => 'customer->field3',
            'sec' => 'Rep',
        ),
        'rep_customerField3' => array(
            'name' => 'rep_customerField3',
            'sample' => 'Valor Personalizado 3',
            'menu' => 'Valor Personalizado 3',
            'description' => 'Valor Personalizado 3',
            'value' => 'customerField3',
            'sec' => 'Rep',
        ),
        'rep_actualJob' => array(
            'name' => 'rep_actualJob',
            'sample' => 'Asistente',
            'menu' => 'Cargo Actual',
            'description' => 'Cargo Actual',
            'value' => 'actualJob',
            'sec' => 'Rep',
        ),
        'rep_applyToPosition' => array(
            'name' => 'rep_applyToPosition',
            'sample' => 'Supervisor',
            'menu' => 'Cargo al que aspira',
            'description' => 'Cargo al que aspira',
            'value' => 'applyToPosition',
            'sec' => 'Rep',
        ),
        'rep_birthday' => array(
            'name' => 'rep_birthday',
            'sample' => '1980-04-05',
            'menu' => 'Fecha de Nacimiento',
            'description' => 'Fecha de Nacimiento',
            'value' => 'birthday',
            'sec' => 'Rep',
        ),
        'rep_age' => array(
            'name' => 'rep_age',
            'sample' => '40',
            'menu' => 'Edad',
            'description' => 'Edad',
            'value' => 'age',
            'sec' => 'Rep',
        ),
        'rep_birthPlace' => array(
            'name' => 'rep_birthPlace',
            'sample' => 'Bogotá',
            'menu' => 'Lugar de Nacimiento',
            'description' => 'Lugar de Nacimiento',
            'value' => 'birthPlace',
            'sec' => 'Rep',
        ),
        'rep_tels' => array(
            'name' => 'rep_tels',
            'sample' => '2111000',
            'menu' => 'Teléfonos',
            'description' => 'Teléfonos',
            'value' => 'tels',
            'sec' => 'Rep',
        ),
        'rep_area' => array(
            'name' => 'rep_area',
            'sample' => 'Barrio',
            'menu' => 'Barrio',
            'description' => 'Barrio',
            'value' => 'area',
            'sec' => 'Rep',
        ),
        'rep_address' => array(
            'name' => 'rep_address',
            'sample' => 'Cr 10 No. 10 - 1',
            'menu' => 'Dirección',
            'description' => 'Dirección',
            'value' => 'address',
            'sec' => 'Rep',
        ),
        'rep_state' => array(
            'name' => 'rep_state',
            'sample' => 'Cundinamarca',
            'menu' => 'Departamento',
            'description' => 'Departamento',
            'value' => 'state',
            'sec' => 'Rep',
        ),
        'rep_city' => array(
            'name' => 'rep_city',
            'sample' => 'Cundinamarca',
            'menu' => 'Ciudad de Estudio',
            'description' => 'Ciudad de estudio',
            'value' => 'city',
            'sec' => 'Rep',
        ),
        'rep_relationshipStatusName' => array(
            'name' => 'rep_relationshipStatusName',
            'sample' => 'Soltero',
            'menu' => 'Estado Civil',
            'description' => 'Estado Civil',
            'value' => 'relationshipStatus->name',
            'sec' => 'Rep',
        ),
        'rep_customerName' => array(
            'name' => 'rep_customerName',
            'sample' => 'Empresa AAAA Ltda.',
            'menu' => 'Nombre de Cliente',
            'description' => 'Nombre de Cliente',
            'value' => 'customer->name',
            'sec' => 'Prod',
        ),
        'rep_customerUserEmail' => array(
            'name' => 'rep_customerUserEmail',
            'sample' => 'jperez@mail.com',
            'menu' => 'Correo del usuario del cliente',
            'description' => 'Correo del usuario del Cliente',
            'value' => 'customerUser->username',
            'sec' => 'Prod',
        ),
        'rep_formatedIdNumber' => array(
            'name' => 'rep_formatedIdNumber',
            'sample' => '70.111.333',
            'menu' => 'Número de Identidad',
            'description' => 'Número de Identidad',
            'value' => 'formatedIdNumber',
            'sec' => 'Rep',
        ),
        'rep_customerProductName' => array(
            'name' => 'rep_customerProductName',
            'sample' => 'Estudio Tipo A',
            'menu' => 'Nombre del Estudio',
            'description' => 'Nombre del Estudio',
            'value' => 'customerProduct->name',
            'sec' => 'Prod',
        ),
        'rep_backgroundCheckComponents' => array(
            'name' => 'rep_backgroundCheckComponents',
            'sample' => 'AV',
            'menu' => 'Componentes Del Estudio',
            'description' => 'Componentes Del Estudio',
            'value' => 'backgroundCheckComponents',
            'sec' => 'Prod',
        ),
        'rep_customerUserName' => array(
            'name' => 'rep_customerUserName',
            'sample' => 'Juan Pérez',
            'menu' => 'Usuario del Cliente',
            'description' => 'Usuario del Cliente que solicitó el estudio',
            'value' => 'customerUser->name',
            'sec' => 'Prod',
        ),
        'rep_result' => array(
            'name' => 'rep_result',
            'sample' => 'Sin Hallazgo',
            'menu' => 'Concepto',
            'description' => 'Conceopt',
            'value' => 'result->name',
            'sec' => 'Rep',
        ),
        'rep_approvedOnLongFormat' => array(
            'name' => 'rep_approvedOnLongFormat',
            'sample' => 'Fecha de Aprobación',
            'menu' => 'Fecha de Aprobación',
            'description' => 'Fecha de Aprobación',
            'value' => 'approvedOnLongFormat',
            'sec' => 'Rep',
        ),
        'rep_expirationOnLongFormat' => array(
            'name' => 'rep_expirationOnLongFormat',
            'sample' => 'Fecha de Expiración',
            'menu' => 'Fecha de Expiración',
            'description' => 'Fecha de Expiración',
            'value' => 'expirationOnLongFormat',
            'sec' => 'Rep',
        ),
        'rep_allHtmlSections' => array(
            'name' => 'rep_allHtmlSections',
            'sample' => '(( Todas las Secciones ))',
            'menu' => 'Todas las Secciones',
            'description' => 'Inserta todas las secciones del reporte',
            'value' => 'allHtmlSections',
            'sec' => 'Sec',
        ),
        'rep_allDelayEvents' => array(
            'name' => 'rep_allDelayEvents',
            'sample' => '(( Todos los Eventos de Retraso ))',
            'menu' => 'Eventos Retraso',
            'description' => 'Inserta todos los eventos de retraso',
            'value' => 'htmlAllDelayEvents',
            'sec' => 'Sec',
        ),
        'rep_allEvents' => array(
            'name' => 'rep_allEvents',
            'sample' => '(( Todos los Eventos ))',
            'menu' => 'Eventos',
            'description' => 'Inserta todos los eventos del reporte',
            'value' => 'htmlAllEvents',
            'sec' => 'Sec',
        ),
        'rep_htmlSignatures' => array(
            'name' => 'rep_htmlSignatures',
            'sample' => 'Firmas de Responsable y Aprobación',
            'menu' => 'Firmas de Resp. y Aprob.',
            'description' => 'Inserta las Firmas de Aprobación',
            'value' => 'htmlSignatures',
            'sec' => 'Rep',
        ),
        'rep_htmlApproveSignature' => array(
            'name' => 'rep_htmlApproveSignature',
            'sample' => 'Firma de Aprobación',
            'menu' => 'Firma de Aprobación',
            'description' => 'Inserta la Firma de Aprobación',
            'value' => 'htmlApproveSignature',
            'sec' => 'Rep',
        ),
        'rep_htmlPortraitImg' => array(
            'name' => 'rep_htmlPortraitImg',
            'sample' => 'Foto',
            'menu' => 'Foto',
            'description' => 'Inserta la foto del candidato',
            'value' => 'getHtmlFrontPageImage()',
            'sec' => 'Rep',
        ),

        'rep_evaluationResult' => array(
            'name' => 'rep_evaluationResult',
            'sample' => 'Resultado de la Evaluación',
            'menu' => 'E. Resultado',
            'description' => 'Resultado de la Evaluación',
            'value' => 'evaluationResult',
            'sec' => 'Rep',
        ),
        'rep_evaluationValue' => array(
            'name' => 'rep_evaluationValue',
            'sample' => 'Valor de la Evaluación',
            'menu' => 'E. Valor',
            'description' => 'Valor de la Evaluación',
            'value' => 'evaluationValue',
            'sec' => 'Rep',
        ),
    );

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{PdfReportType}}';
    }

    public function init() {
        parent::init();
        $this->topMargin = 27;
        $this->bottomMargin = 25;
        $this->leftMargin = 15;
        $this->rightMargin = 15;
        $this->headerMargin = 5;
        $this->footerMargin = 10;
        $this->defaultFontSize = 10;
        $this->defaultFont = 'helvetica';
        $this->footerOffset = -15;
        $this->markX = 0;
        $this->markY = 10;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('name,defaultFont,defaultFontSize', 'length', 'max' => 45),
            array('header, footer, body, isCertificate, islogSintecto', 'safe'),
            array('topMargin,bottomMargin,leftMargin,rightMargin,headerMargin,footerMargin,footerOffset,markX,markY', 'numerical'),
            array('isCertificate, islogSintecto', 'boolean'),
            array('defaultFontSize', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('id, name, header, footer, body, topMargin, bottomMargin, leftMargin,'
                . 'rightMargin, headerMargin, footerMargin, defaultFontSize, defaultFont, markOffset'
                , 'safe'
                , 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
        return array(
            'customerProducts' => array(self::HAS_MANY, 'CustomerProduct', 'pdfReportTypeId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Reporte Tipo',
            'header' => 'Encabezado',
            'footer' => 'Pie de página',
            'body' => 'Contenido',
            'topMargin' => 'Margen Superior',
            'bottomMargin' => 'Margen Inferior',
            'leftMargin' => 'Margen Izquierdo',
            'rightMargin' => 'Margen Derecho',
            'headerMargin' => 'Margen de Encabezado',
            'footerMargin' => 'Margen de Pie de Página',
            'defaultFont' => 'Letra por Defecto',
            'defaultFontSize' => 'Tamaño por Defecto',
            'footerOffset' => 'Desplazamiento del Pie de Pag.',
            'markX' => 'Disancia horizontal de la Marca',
            'markY' => 'Disancia Vertical de la Marca',
            'isCertificate' => 'Es Certificado',
            'islogSintecto' =>'Marca de Agua Sintecto',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
// @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('header', $this->header, true);
        $criteria->compare('footer', $this->footer, true);
        $criteria->compare('body', $this->body, true);
        $criteria->compare('isCertificate', $this->isCertificate);
        $criteria->compare('islogSintecto', $this->islogSintecto);

        GridViewFilter::setFilter($this, 'search');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
            ),
        ));
    }

    private function initPdf($backgroundCheck = null) {
        include_once(Yii::app()->basePath . '/components/SvpTcPdf.php');
        $pdf = new TcPdf\SvpTcPdf('P', 'mm', 'letter', true, 'UTF-8', false);
        $this->_backgroundCheck = $backgroundCheck;
        $pdf->header = $this->replaceVars($this->header);
        $pdf->footer = $this->replaceVars($this->footer);
        $pdf->footerOffset = $this->footerOffset;
// set document information
        $pdf->SetCreator('S&V');
        $pdf->SetAuthor('S&V');
        $pdf->SetTitle('--');
        $pdf->SetSubject('--');
        $pdf->SetKeywords('');

        $pdf->setHeaderFont(Array($this->defaultFont, '', $this->defaultFontSize));
        $pdf->setFooterFont(Array($this->defaultFont, '', $this->defaultFontSize));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->SetMargins($this->leftMargin, $this->topMargin, $this->rightMargin);
        $pdf->SetHeaderMargin($this->headerMargin);
        $pdf->SetFooterMargin($this->footerMargin);

        $pdf->SetAutoPageBreak(TRUE, $this->bottomMargin);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->SetFont($this->defaultFont, '', $this->defaultFontSize);
        $this->_pdf = $pdf;
        return $pdf;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PdfReportType the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getPdfReport($backgroundCheck = null) {

        $pdf = $this->initPdf($backgroundCheck);
        $pdf->AddPage();

        if($this->islogSintecto==1){
            $pdf->Brainwatermark();
        }

        $pdf->writeHTML($pdf->replaceVars($this->replaceVars($this->body)), true, false, true, false, '');
        $pdf->lastPage();

// TODO Publish Events
//        $this->renderPartial('/event/_eventsPDF', array(
//            'backgroundCheck' => $backgroundCheck,
//            'height' => '',
//            'pdf' => $pdf,
//                )
//        );
// TODO The Document section is having conflict with the previous version

//        if ($backgroundCheck) {
//            /* @var $document Document */
//            foreach ($backgroundCheck->documents as $document) {
//                $document->getPdfDocument($pdf);
//            }
//        }
        return $pdf;
    }

    public function replaceVars($var) {
        if ($this->_backgroundCheck) {
            return preg_replace_callback(array(
                '/<span name="((rep|sec)_[a-zA-Z0-9_]+)"([^>]+style=")background-color:#ADD8E6([^"]*")>([a-zA-Z0-9_áéíóúÁÉÍÓÚüÜñÑ\@\-\:\&\;\#\ \.\n\(\)]*)<\/span>/',
                    )
                    , array($this, 'callbackReplaceVar')
                    , $var);
        } else {
            return $var;
        }
    }

    private function callbackReplaceVar($matches) {
        $ans = $matches[0];
        if ($matches[2] == 'rep' && isset($this->fullAllowedVars[$matches[1]])) {
            $ans1 = '';
            eval('@$ans1=$this->_backgroundCheck->' . $this->fullAllowedVars[$matches[1]]['value'] . ';');
            $ans = '<span ' . $matches[3] . $matches[4] . '>' . $ans1 . '</span>';
        } else if ($matches[2] == 'sec' && isset($this->fullAllowedVars[$matches[1]])) {
            $ans1 = '';
            $function = $this->fullAllowedVars[$matches[1]]['value'] . ',"' . $matches[5] . '")';
            eval('@$ans1=$this->_backgroundCheck->' . $function . ';');
            $ans = '<span ' . $matches[3] . $matches[4] . '>' . $ans1 . '</span>';
        }

        return $ans;
    }

    static public function getFullAllowedVars() {

        if (PdfReportType::$_allowedVars == null) {
            $ans = PdfReportType::$allowedVars;
            $criteria = new CDbCriteria;
            $criteria->addCondition('htmlSection<>""');

            $verificationSectionTypes = VerificationSectionType::model()->findAll($criteria);

            foreach ($verificationSectionTypes as $verificationSectionType) {
                $varName = 'rep_section_' . $verificationSectionType->id;
                $ans[$varName] = array(
                    'name' => $varName,
                    'sample' => '((Sección : ' . $verificationSectionType->name . ' ))',
                    'menu' => 'Sec:' . $verificationSectionType->name,
                    'description' => 'Sec:' . $verificationSectionType->name,
                    'value' => 'getHtmlSection(' . $verificationSectionType->id . ')',
                    'sec' => 'Sec',
                );
                $varName = 'sec_sectionResult_' . $verificationSectionType->id;
                $ans[$varName] = array(
                    'name' => $varName,
                    'sample' => 'Resultado',
                    'menu' => 'Res:' . $verificationSectionType->name,
                    'description' => 'Res:' . $verificationSectionType->name,
                    'value' => 'getSectionAnswer(' . $verificationSectionType->id,
                    'sec' => 'Sec',
                );
                $varName = 'sec_sectionAnswer_' . $verificationSectionType->id;
                $ans[$varName] = array(
                    'name' => $varName,
                    'sample' => 'Variable',
                    'menu' => 'Var:' . $verificationSectionType->name,
                    'description' => 'Var:' . $verificationSectionType->name,
                    'value' => 'getSectionAnswer(' . $verificationSectionType->id,
                    'sec' => 'Sec',
                );
            }

            PdfReportType::$_allowedVars = $ans;
        }
        return PdfReportType::$_allowedVars;
    }

}
