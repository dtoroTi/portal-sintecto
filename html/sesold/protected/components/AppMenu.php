<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppMenu
 *
 * @author hzubieta
 */
class AppMenu {

    static function getMenu() {
        return
                array(
                    'items' => array(
                        //se condiciona el inicio para el dashboard de cumplimiento
                        array('label' => 'Inicio', 'url' => array('/site/formularioCompliance'), 'visible' => Yii::app()->user->termsAccepted and Yii::app()->user->arUser->compliance==1),
                        array('label' => 'Inicio', 'url' => array('/site/intro'), 'visible' => Yii::app()->user->termsAccepted and Yii::app()->user->arUser->compliance==0),
                        array('label' => 'Solicitud de Estudio', 'url' => array('/vetting/create'), 
                            'visible' => Yii::app()->user->termsAccepted && (Yii::app()->user->arUser &&
                                (Yii::app()->user->arUser->canRequestPersonReport ||
                                Yii::app()->user->arUser->canRequestCompanyReports)),
                            'items' => array(
                                array('label' => 'Estudio de Persona',
                                    'url' => array('/vetting/create'),
                                    'visible' => Yii::app()->user->arUser && Yii::app()->user->arUser->canRequestPersonReport,
                                ),

                                array('label' => 'Estudio de Empresa',
                                    'url' => array('/vetting/createCompany'),
                                    'visible' => Yii::app()->user->arUser && Yii::app()->user->arUser->canRequestCompanyReports),
                                // array('label' => 'Solicitud via Archivo', 'url' => array('/vetting/loadFile'), 'visible' => Yii::app()->user->termsAccepted),


                                //Creado por Jonathan Multiples estudios

                                array('label' => 'Solicitar multiples estudios Personas',
                                    'url' => array('/vetting/createMultiple'),
                                    'visible' => Yii::app()->user->arUser && Yii::app()->user->arUser->canRequestPersonReport
                                ),


                                array('label' => 'Solicitar multiples estudios Empresas',
                                    'url' => array('/vetting/createMultipleCompany'),
                                    'visible' => Yii::app()->user->arUser && Yii::app()->user->arUser->canRequestCompanyReports),

                                //Natalia Henao
                                //habilitar proceso cargue de documentos 06/09/2021
                                array('label' => 'Cargue de Documentos', 
                                      'url' => array('/vetting/loaddocuments')),

                                //Natalia Henao
                                //habilitar proceso visualizacion y descarga de documentos 03/06/2022
                                array('label' => 'Gestion Documental',
                                'url' => array('/vetting/viewdocuments'),
                                'visible' => Yii::app()->user->arUser && Yii::app()->user->arUser->accessToDocumentManagement==1),

                                )
                                //Creado por Jonathan Multiples estudios
                        ),

                        array('label' => 'Listado de Estudios', 'url' => array('/vetting/admin'),
                            'visible' => Yii::app()->user->termsAccepted && Yii::app()->user->arUser->hasAccessToReports,
                            'items' => array(
                                array('label' => 'Todos', 'url' => array('/vetting/admin')),
                                array('label' => 'Pendientes', 'url' => array('/vetting/admin', 't' => 1)),
                                array('label' => 'Terminados no descargados', 'url' => array('/vetting/admin', 't' => 2)),
                                array('label' => 'Terminados ya descargados', 'url' => array('/vetting/admin', 't' => 3)),
                            )
                        ),
                        //se condiciona el inicio para el reporte de alerta complimiento
                        array('label' => 'Reporte de Alerta', 'url' => array('compliance/admin'),
                            'visible' => Yii::app()->user->termsAccepted and Yii::app()->user->arUser->compliance==1 and  Yii::app()->user->arUser->customer->businessLine=="Ev.Terceros",
                            'items' => array(
                                array('label' => 'Ver Reportes', 'url' => array('compliance/admin')),
                                array('label' => 'Crear Reporte', 'url' => array('compliance/create')),
                            )
                        ),
                        array('label' => 'Consulta OFAC', 'url' => array('/SDN/query'),
                            'visible' => (Yii::app()->user->termsAccepted && Yii::app()->user->arUser->hasAccessToOfac)),
                        array('label' => 'Cambio de Clave', 'visible' => Yii::app()->user->termsAccepted, 'items' =>
                            array(
                                array('label' => 'Cambio de Clave de Usuario', 'url' => array('/site/changePassword')),
                                array('label' => 'Cambio de Clave de PDF', 'url' => array('/site/changePdfPassword')),
                            )
                        ),
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => Yii::app()->user->termsAccepted)
                    )
        );
    }

    //put your code here
}
