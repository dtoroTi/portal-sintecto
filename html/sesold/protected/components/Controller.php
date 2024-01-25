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

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        if (!Yii::app()->user->isGuest) {
            WebUser::logAccess("");
            if (!(Yii::app()->controller->id == 'site' &&
                    Yii::app()->controller->action->id == 'logout')) {

                if (!Yii::app()->user->arUser->isActive &&
                        !(Yii::app()->controller->id == 'site' &&
                        Yii::app()->controller->action->id == 'logout')) {
                    WebUser::logAccess("Por estar No Activo el usuario, se cerro la sesion.");
                    $this->redirect(array('/site/logout'));
                }

                if (!(Yii::app()->controller->id == 'site' &&
                        Yii::app()->controller->action->id == 'terms')) {

                    if (!Yii::app()->user->termsAccepted) {
                        $this->redirect(array('/site/terms'));
                    }
                    if (Yii::app()->user->arUser->mustChangePassword &&
                            !(Yii::app()->controller->id == 'site' &&
                            Yii::app()->controller->action->id == 'changePassword')) {
                        WebUser::logAccess("El usuario es obligado a cambiar el password    ");
                        $this->redirect(array('/site/changePassword'));
                    }
                    if ((!Yii::app()->user->arUser->enforceOtp 
                            && Yii::app()->user->arUser->enforceOtpG 
                            && Yii::app()->user->arUser->otpGKey == '') 
                            && !(Yii::app()->controller->id == 'site' 
                                    && ( Yii::app()->controller->action->id == 'changeOtp' 
                                    ||  Yii::app()->controller->action->id == 'logout')

                            )) {
                        WebUser::logAccess("El usuario es obligado a crear un OPTG");
                        $this->redirect(array('/site/changeOtp'));
                    }
                }
            }
        }


        if (Yii::app()->user->termsAccepted) {
            $access = array(
                array('allow',
                    'controllers' => array('site'),
                    'actions' => array('login', 'logout', 'error', 'event'),
                ),
                array('allow',
                    'users' => array('*'),
                    'controllers' => array('event'),
                    'actions' => array('answerEvent'),
                ),
                array('allow',
                    'users' => array('@'),
                    'controllers' => array('vetting', 'SDN'),
                ),
                array('allow',
                    'users' => array('@'),
                    'controllers' => array('site'),
                    'actions' => array('intro', 'changePassword', 'terms', 'changePdfPassword','changeOtp'),
                ),
                array('allow',
                    'users' => array('@'),
                    'controllers' => array('site'),
                    'actions' => array('formularioCompliance', 'detailStudy', 'detailNotifications', 'detailSections', 'detailresultStudy', 'detailProductsStudydays', 'insertObsv', 'novedadStudy','detailNotificationsIn','exportEvent'),  // Render Nuevo Formulario Compliance inclue .php creado
                ),

                array('allow',
                    'users' => array('@'),
                    'controllers' => array('site'),
                    'actions' => array('descargaPDF'),  // Render Nuevo Archivo Descargar Compliance inclue .php creado

                ),

                array('allow',
                    'users' => array('@'),
                    'controllers' => array('site'),
                    'actions' => array('csvTusDatos'), // Render Nuevo Archivo Descargar Compliance inclue .php creado //TUS DATOS
                ),
                
                array('allow',
                    'users' => array('@'),
                    'controllers' => array('site'),
                    'actions' => array('csvSeccionesCH', 'csvStudyperiod', 'refresh'), // Render Nuevo Archivo Descargar Compliance inclue .php creado //DESCARGA SECCIONES 
                ),
                
                array('allow',
                    'users' => array('@'),
                    'controllers' => array('compliance'),
                   // 'actions' => array('form'),  // Render Nuevo reporte de alerta reportalert.php
                ),

                array('allow',
                    'users' => array('@'),
                    'controllers' => array('vetting'),
                    'actions' => array('uploadDocuments','loadDocuments', 'deleteDocumentsClient','file','fileSaveAs', 'viewdocuments'), 
                ),

                array('deny',
                    'users' => array('@'),
                ),
                array('deny',
                    'users' => array('*'),
                ),
            );
        } else {
            $access = array(
                array('allow',
                    'controllers' => array('site'),
                    'actions' => array('login', 'logout', 'error', 'captcha'),
                ),
                array('allow',
                    'users' => array('*'),
                    'controllers' => array('event'),
                    'actions' => array('answerEvent'),
                ),
                array('allow',
                    'users' => array('@'),
                    'controllers' => array('site'),
                    'actions' => array('terms'),
                ),
                array('deny',
                    'users' => array('@'),
                ),
                array('deny',
                    'users' => array('*'),
                ),
            );
        }

        return $access;
    }

}
