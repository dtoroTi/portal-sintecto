<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        if (!Yii::app()->user->isGuest) {
            WebUser::logAccess("");

            if (Yii::app()->user->arUser->mustChangePassword &&
                    !(
                    (Yii::app()->controller->id == 'site' && (
                    Yii::app()->controller->action->id == 'changePassword' ||
                    Yii::app()->controller->action->id == 'logout')
                    )
                    )
            ) {
                WebUser::logAccess("El usuario es obligado a cambiar el password    ");
                $this->redirect(array('/site/changePassword'));
            }
            if (!Yii::app()->user->arUser->isActive &&
                    !(Yii::app()->controller->id == 'site' &&
                    Yii::app()->controller->action->id == 'logout')) {
                WebUser::logAccess("Por estar No Activo el usuario, se cerro la sesion.");
                $this->redirect(array('/site/logout'));
            }

            if ((!Yii::app()->user->arUser->enforceOtp && Yii::app()->user->arUser->enforceOtpG && Yii::app()->user->arUser->otpGKey == '') &&
                    !(Yii::app()->controller->id == 'site' && (
                    Yii::app()->controller->action->id == 'changeOtp' ||
                    Yii::app()->controller->action->id == 'logout')

                    )) {
                WebUser::logAccess("El usuario es obligado a crear un OPTG");
                $this->redirect(array('/site/changeOtp'));
            }
        }

        if(Yii::app()->user->getIsByRole()){


            $permission=[
                ['allow', // allow all users to perform 'index' and 'view' actions
                    'users' => ['*'],
                    'controllers' => ['site'],
                    'actions' => ['login', 'logout', 'error', 'captcha'],
                ],
                /*[
                    'allow', // allow all users to perform 'index' and 'view' actions
                    'users' => ['nhenao@sintecto.com'],
                    'controllers' => ['site'],
                    'actions' => ['index'],
                ],*/
                Yii::app()->user->arUser->getArrayPermission(),
                    [
                        'deny', // deny all users
                        'users' => ['*'],
                    ],
                ];
            return $permission;
        }else{
            return array(
                array('allow', // allow all users to perform 'index' and 'view' actions
                    'users' => array('*'),
                    'controllers' => array('site'),
                    'actions' => array('login', 'logout', 'error', 'captcha'),
                ),
                array('allow', // allow all users to perform 'index' and 'view' actions
                    'users' => array('@'),
                    'controllers' => array('mobile'),
                    'actions' => array('pending', 'upload', 'download', 'login'),
                ),
                array('allow', // allow all users to perform 'index' and 'view' actions
                    'users' => array('@'),
                    'controllers' => array(
                        'backgroundCheck', 'backgroundCheckStatus', 'customerController',
                        'customer', 'customerProduct', 'customerUser', 'detailDocument',
                        'detailEducation', 'detailJob', 'detailPerson', 'detailRegister',
                        'educationType', 'eventController', 'contactController', 'holiday', 'report', 'SDN',
                        'site', 'user', 'log', 'verificationInProduct',
                        'verificationSection', 'verificationSectionType',
                        'document', 'sectionTypeQuestion', 'activityType', 'event', 'contact',
                        'customerGroup', 'invoice', 'detailCompany',
                        'detailShareholder', 'product','pdfReportType','verificationSectionGroup','serviceResponse', 'attachmentFile', 'sendmassivecont', 'updateRegOFAC', 'sendResult','testAPI', 'qualityPorc', 'surveyLink', 'requestsSAC', 'candidateCalls', 'visitInvoiceDate', 'invoiceVisitCost', 'invoiceVisit', 'invoiceVisitDetail', 'notAssignmassive', 'userSenior', 'seniorAssignment', 'assignSeniorExport', 'miPlanilla','dynamicFormJSON','sendMassiveRecover','updateValiduntilFDRecover', 'sendmassiveRecover', 'studyStart', 'svpFile', 'fileAttachment',
                        'detailFinancial', 'agreements', 'sendEmail', 'role', 'permission', 'roleHasPermission'
                    ),
                ),
                array('deny', // deny all users
                    'users' => array('*'),
                ),
            );

        }
       
    }

    static public $optionsRecover= array(
        0 => 'Pendiente',
        1 => 'Enviado',
    );
    static public $optionsYesNo = array(
        0 => 'No',
        1 => 'Si',
    );
    static public function stringYesNo($opt) {
        if ($opt == 0 || $opt == 1) {
            $vec = Controller::$optionsYesNoNull;
            $ans = $vec[$opt];
        } else {
            $ans = "";
        }
        return $ans;
    }

    static public $optionsYesNoNull = array(
        '' => '--',
        0 => 'No',
        1 => 'Si',
    );

    static public $optionsCalificationCuantitative = array(
        0 => '0',
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
    );

    static public $optionsYesNoNA = array(
        0 => 'No',
        1 => 'Si',
        2 => 'NA',
    );

    static public $optionsYesNoNANull = array(
        '' => '--',
        'No' => 'No',
        'Si' => 'Si',
        'NA' => 'NA',
    );

    static public $optionsPercent = array(
        '' => '--',
        0 => '0',
        10 => '10',
        20 => '20',
        30 => '30',
        40 => '40',
        50 => '50',
        60 => '60',
        70 => '70',
        80 => '80',
        90 => '90',
        100 => '100',
    );

    static public $optionsshareholderType = array(
        0 => 'Privada',
        1 => 'Pública',
        2 => 'Mixta',
    );

    static public $optionsBusinessRelationShip = array(
        '' => '--',
        'Contrato' => 'Contrato',
        'Oferta mercantil' => 'Oferta mercantil',
        'Propuesta comercial' => 'Propuesta comercial',
        'Orden de compra' => 'Orden de compra',
        'Otro' => 'Otro',
    );

    static public $optionsInputChannel = array(
        '' => '--',
        'Cliente actual' => 'Cliente actual',
        'Atracción' => 'Atracción',
        'Atención' => 'Atención',       
    );

    static public $optionsBussinesLineClient = array(
        'Integridad' => 'Integridad',
        'Ev.Terceros' => 'Ev.Terceros',        
    );

    static public $optionsBussinesLineSeccion = array(
        'Integridad' => 'Integridad',
        'Ev.Terceros' => 'Ev.Terceros',
        'Mixto' => 'Mixto',
        'Exclusivo PRODECO' =>'Exclusivo PRODECO',
    );
    
    static public $optionsTrackingProcStatus = array(
        0 => 'Pagado',
        1 => 'Pago en trámite',
        2 => 'Pendiente confirmación de Pago',
        3 => 'Documentos completos',
        4 => 'Documentos incompletos',
        5 => 'Subsanación completa',
        6 => 'Subsanación incompleta',
        7 => 'No realiza subsanación',
        8 => 'Se envía invitación',
        9 => 'Cancelado',
        10 => 'Desiste del proceso'
    );
    static public $optionsTrackingContactStatus = array(
        'No contesta' => 'No Contesta',
        'Efectivo' => 'Efectivo',
        'No Efectivo' => 'No Efectivo',
        'Programado' => 'Programado',
        'Pendiente Visita ' => 'Pendiente Visita ',
        'Visita Virtual' => 'Visita Virtual',
        'Cargue de documentos' => 'Cargue de documentos',
    );
    static public $optionsSupplierClassificationType = array(
        0 => 'Persona Jurídica',
        1 => 'Persona Natural',
    );
    static public $optionsAssumedBy = array(
        0 => 'Proveedor',
        1 => 'Cliente',
    );

    static public $optionQualification = array (
        0 => 'No Aplica',
        1 => 'Malo / No Apto',
        2 => 'Regular',
        3 => 'Bueno',
        4 => 'Excelente',
    );

//Creado por Jonathan

    static public $optionsfindingPolygraph = array (
        0 => 'No Aplica',
        1 => 'Admisiones',
        2 => 'Reacción',

    );

    static public $optionfindingBackground = array (
        0 => 'No Aplica',
        1 => 'Simit',
        2 => 'Policia',
        3 => 'Rama Judicial',
        4 => 'Contaduría',
        5 => 'Procuraduría',
        6 => 'Libreta Militar',
        7 => 'TYBA',
        8 => 'Listas Restrictivas',
        9 => 'INPEC',
        10 => 'Rama Judicial Unificada',
        11 => 'Simur',
        12 => 'Fiscalia',
        13 => 'Contraloria',
        14 => 'Vehiculos Inmovilizados',
        15 => 'Word Compliance',
        16 => 'Noticiass Reputacionales',
        17 => 'RNCM',
        18 => 'Inhabilidades - Delitos Sexuales',
    );

    static public $optionfindingrestricList = array (
        0 => 'No Aplica',
        1 => 'Listas Restric',
        2 => 'Nit',
        3 => 'Socios y Rep Leg',

    );

    static public $optionfindingDoc = array (
        0 => 'No Aplica',
        1 => 'Alteración',
        2 => 'No entrega Doc',
       
    );

//Creado por Jonathan

    static public $optionCIFIN = array (
        0 => 'Excelente',
        1 => 'Aceptable',
        2 => 'Regular',
        3 => 'Negativo',
        4 => 'No Reporta Información de Créditos',
        5 => 'No registra información con sector financiero',

    );
    static public $optionColpensionesType = array (
        0 => 'COOPERATIVAS DE AHORRO Y CREDITO Y MULTIACTIVAS DE AHORRO Y CREDITO',
        1 => 'FONDOS DE EMPLEADOS',
        2 => 'ASOC. MUTUALES',
        3 => 'CAJAS DE COMPENSACIÓN FAMILIAR',
    );

    //Array para dropdownList de devoluciones en informacion general del estudio
    //Natalia Henao 27/10/2021
    static public $optionDevoluciones = array (
        0 => '-',
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7',
        8 => '8',
        9 => '9',
        10 => '10',
    );

    //Array con tipo de areas
    //Natalia Henao 06/04/2022
    static public $areatype = array (
        0 => '-',
        1 => 'Gerencia',
        2 => 'Gestion Humana',
        3 => 'Tecnología e Infraestructura',
        4 => 'Operaciones',
        5 => 'Publicación',
        6 => 'Comercial',
        7 => 'Servicio al Cliente',
        8 => 'Calidad',
        9 => 'Servicios Compartidos',
    );

    /**
    * Return data to browser as JSON and end application.
    * @param array $data
    */
    protected function renderJSON($data)
    {
        header('Content-type: application/json');
        echo CJSON::encode($data);

        foreach (Yii::app()->log->routes as $route) {
            if($route instanceof CWebLogRoute) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
        Yii::app()->end();
    }

    public static function jsonToDebug($jsonText = '')
    {
        $arr = json_decode($jsonText, true);
        $html = "";
        if ($arr && is_array($arr)) {
            $html .= self::_arrayToHtmlTableRecursive($arr);
        }
        return $html;
    }

    private static function _arrayToHtmlTableRecursive($arr) {
        $str = "<table><tbody>";
        $i=0;
        foreach ($arr as $key => $val) {
            $clase=$i++%2==0?'even':'odd';
            $str .= "<tr class='$clase'>";
            $clasefont = "";
            if(stripos($key,'Response')!==false)
                $clasefont = ' style="font-size:0px;"';
            $str .= "<td $clasefont>".preg_replace('/(?<!\ )[A-Z]/', ' $0', $key)."</td>";
            $str .= "<td>";
            if (is_array($val)) {
                if (!empty($val)) {
                    $str .= self::_arrayToHtmlTableRecursive($val);
                }
            } else {
                $str .= "<strong>$val</strong>";
            }
            $str .= "</td></tr>";
        }
        $str .= "</tbody></table>";

        return $str;
    }

    public static function jsonToPdf($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        self::_arrayToPdfTableRecursive($arr, $pdf);   
    }

    private static function _arrayToPdfTableRecursive($arr, &$pdf) {
        //$i=0;
        foreach ($arr as $key => $val) {
            /*$clase=$i++%2==0?'even':'odd';
            $linea = 1;
            if($clase == 'even')
                $linea = 0;*/
            
            if(stripos($key,'Response')===false)
            {
                if(is_numeric($key))
                {
                    $pdf->SetFillColor(150, 150, 150);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(196, '', 'Registro ' . ($key + 1), 1, 1, 'C', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->SetFont('Arial', 'B', 14);
                    $pdf->SetFillColor(220); 
                } 
                else 
                {
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(196, '', preg_replace('/(?<!\ )[A-Z]/', ' $0', $key), 1, 1, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->SetFont('Arial', 'B', 14);
                    $pdf->SetFillColor(220);     
                }
                
            } else {
                $pdf->SetFillColor(8, 112, 138);
                $pdf->SetFont('Arial', 'B', 10);
                $nuevoKey = str_replace('Response', '', $key);
                $pdf->Cell(196, '', preg_replace('/(?<!\ )[A-Z]/', ' $0', $nuevoKey), 1, 1, 'C', 1);
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->SetFillColor(220);  
            }
            
            
            if (is_array($val)) {
                if (!empty($val)) {
                    self::_arrayToPdfTableRecursive($val, $pdf);
                }
            } else {
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(196, '', $val, 1, 1, 'L');
            }

        }
    }
}
//comment
