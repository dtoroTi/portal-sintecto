<?php
//prueba de ajustes.
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of AppMenu
 *
 * @author hzubieta
 */
class AppMenu
{
    public static function getMenu()
    {
        $menu = [
            'items' => [
                [
                    'label' => 'Configuración',
                    'visible' => Yii::app()->user->isValidUser,
                    'items' => [
                        ['label' => 'Cambio de Clave de Usuario', 'url' => ['site/changePassword']],
                        ['label' => 'Cambio de Clave de PDF', 'url' => ['site/changePdfPassword']],
                        ['label' => 'Cerrar Sesión', 'url' => ['/site/logout']],
                    ],
                ],
                [
                    'label' => 'S&V Estudios',
                    'visible' => Yii::app()->user->isSesUser,
                    'url' => ['backgroundCheck/admin'],
                    'visible' => (Yii::app()->user->isValidUser),
                    'items' => [
                        [
                            'label' => 'Estudios',
                            'url' => ['backgroundCheck/admin'],
                            'visible' => (Yii::app()->user->isValidUser),
                            'items' => [
                                ['label' => 'VCSP', 'url' => ['backgroundCheck/admin']],
                                ['label' => 'Estudios Pendientes', 'url' => ['user/myPendingReports']],
                                [
                                    'label' => 'Solicitar estudio',
                                    'url' => ['backgroundCheck/create', 'pc' => false],
                                    'visible' => Yii::app()->user->isAdmin],
                                [
                                    'label' => 'Solicitar estudio de empresa',
                                    'url' => ['backgroundCheck/createCompanySurvey', 'pc' => false],
                                    'visible' => Yii::app()->user->isAdmin],
                                [
                                    'label' => 'Solicitar multiples estudios',
                                    'url' => ['backgroundCheck/createMultiple', 'pc' => false],
                                    'visible' => Yii::app()->user->isAdmin],
                                [
                                    'label' => 'Solicitar multiples estudios de empresa',
                                    'url' => ['backgroundCheck/createMultipleCompany', 'pc' => false],
                                    'visible' => Yii::app()->user->isAdmin],

                            ],
                        ],
                        [
                            'label' => 'Reportes',
                            'visible' => Yii::app()->user->isAdmin,
                            'items' => [
                                ['label' => 'Resultados', 'url' => ['report/pieStudiesResult']],
                                ['label' => 'Mes', 'url' => ['report/barStudiesResult']],
                                ['label' => 'Cliente', 'url' => ['report/barStudiesResultByCustomer']],
                                ['label' => 'Cliente y Producto', 'url' => ['report/studiesResultByCustomerReportType']],
                                ['label' => 'Pendientes a hoy',
                                    'url' => ['backgroundCheckReport/pendingReportsUntilToday'],
                                    'visible' => Yii::app()->user->isAdmin],
                                ['label' => 'Pendientes CSV',
                                    'url' => ['backgroundCheckReport/pendingReportsCSV'],
                                    'visible' => Yii::app()->user->isAdmin],
                                ['label' => 'Export Estudios Movidos',
                                    'url' => ['backgroundCheckReport/studymove'],
                                    'visible' => Yii::app()->user->isManager],
                                ['label' => 'Plan de Trabajo Diario CSV',
                                    'url' => ['backgroundCheckReport/exportworkplanCSV'],
                                    'visible' => Yii::app()->user->isAdmin],
                                ['label' => 'Export novedades reportadas a SAC',
                                    'url' => ['event/exportEventSACCSV'],
                                    'visible' => Yii::app()->user->isAdmin],
                                [
                                    'label' => 'Export Clientes SAC',
                                    'url' => ['backgroundCheckReport/clientsSacCSV', 'pc' => false],
                                    'visible' => Yii::app()->user->isAdmin],
                            ],
                        ],
                        [
                            'label' => 'Consulta OFAC-PEPS',
                            'visible' => Yii::app()->user->isValidUser,
                            'items' => [
                                [
                                    'label' => 'Actualizar Listas Peps',
                                    'url' => ['sDN/updatePepsSdn'],
                                    'visible' => Yii::app()->user->isAdmin],
                                [
                                    'label' => 'Actualizar Lista de OFAC',
                                    'url' => ['sDN/updateOfacSdn'],
                                    'visible' => Yii::app()->user->isAdmin],
                                [
                                    'label' => 'Actualizar Lista de ONU',
                                    'url' => ['sDN/updateUn'],
                                    'visible' => Yii::app()->user->isAdmin],
                                ['label' => 'Consulta', 'url' => ['sDN/query']],
                                ['label' => 'Listado', 'url' => ['sDN/admin']],
                            ],
                        ],
                        ['label' => 'Consulta Contactos',
                            'items' => [
                                ['label' => 'Listado de Contactos Académico', 'url' => ['educationalInstitution/admin']],
                                ['label' => 'Listado de Contactos Laboral', 'url' => ['jobCompany/admin']],
                                //array('label' => 'Crear Contacto', 'url' => array('educationalInstitution/create')),
                            ]],
                    ],
                ],
                [
                    'label' => 'Control de Estudios',
                    'visible' => /* Yii::app()->user->isValidUser */Yii::app()->user->isAdmin,
                    'items' => [
                        ['label' => 'Listado de Estudios', 'url' => ['backgroundCheck/pcAdmin']],
                        ['label' => 'Crear Estudio', 'url' => ['backgroundCheck/create', $pc = true]],
                        ['label' => 'Asignar Masiva Estudios', 'url' => ['backgroundCheck/selectForAssign'], 'visible' => Yii::app()->user->isAdmin],
                        ['label' => 'Envíos Masivos Contacto', 'url' => ['backgroundCheck/sendMassiveContacts'], 'visible' => Yii::app()->user->isAdmin],
                        ['label' => 'Envíos Masivos Recaudo', 'url' => ['backgroundCheck/sendMassiveRecover'], 'visible' => Yii::app()->user->isAdmin],
                        [
                            'label' => 'Exports Coface',
                            'visible' => Yii::app()->user->isAdmin,
                            'items' => [
                                ['label' => 'Importaciones', 'url' => ['verificationSection/csvImportCoface']],
                                ['label' => 'Exportaciones', 'url' => ['verificationSection/csvExportCoface']],
                                ['label' => 'Compañia', 'url' => ['verificationSection/csvCompanyCoface']],
                                ['label' => 'Persona de Contacto', 'url' => ['verificationSection/csvContactPersonCoface']],
                                ['label' => 'Accionistas', 'url' => ['verificationSection/csvShareHoldersCoface']],
                                ['label' => 'Direccíon', 'url' => ['verificationSection/csvAddressCoface']],
                                ['label' => 'Comentarios', 'url' => ['verificationSection/csvCommentsCoface']],
                                ['label' => 'Analisis Financiero', 'url' => ['verificationSection/csvFinantialAnalysCoface']],
                                ['label' => 'Seguimiento', 'url' => ['verificationSection/csvTrakingCoface']],
                                ['label' => 'Referencias Comerciales', 'url' => ['verificationSection/csvCommercialRefCoface']],
                            ],
                        ],
                    ],
                ],
                [
                    'label' => 'Bases Operaciones',
                    'visible' => Yii::app()->user->isAdmin,
                    'items' => [
                        [
                            'label' => 'Solicitudes SAC',
                            'visible' => Yii::app()->user->isRequestsSAC,
                            'items' => [
                                ['label' => 'Listado de Solicitudes SAC', 'url' => ['requestsSAC/admin']],
                                ['label' => 'Crear Solicitud SAC', 'url' => ['requestsSAC/create', $pc = true]],
                            ],
                        ],
                        [
                            'label' => 'Programación Integridad',
                            'visible' => Yii::app()->user->isAdmin,
                            'items' => [
                                ['label' => 'Asignar Llamadas', 'url' => ['candidateCalls/admintoAssign']],
                                ['label' => 'Llamadas a Cargo', 'url' => ['candidateCalls/admintoManager', $pc = true]],
                                ['label' => 'Todas las Llamadas', 'url' => ['candidateCalls/admin', $pc = true]],
                            ],
                        ],
                        [
                            'label' => 'Indicadores Senior',
                            'visible' => Yii::app()->user->isAdmin,
                            'items' => [
                                ['label' => 'Asignación Analistas', 'url' => ['user/adminSenior']],
                            ],
                        ],
                        [
                            'label' => 'Piloto',
                            'visible' => Yii::app()->user->isAdmin,
                            'items' => [
                                ['label' => 'Clientes Piloto', 'url' => ['backgroundCheck/admintoPiloto']],
                            ],
                        ],
                        [
                            'label' => 'Acuerdos',
                            'visible' => Yii::app()->user->isAdmin,
                            'items' => [
                                ['label' => 'Listado de Acuerdos', 'url' => ['agreements/admin']],
                                ['label' => 'Crear Acuerdo', 'url' => ['agreements/create', $pc = true],
                                 'visible' => Yii::app()->user->isAgreements ],
                            ],
                        ],
                    ],
                ],
                [
                    'label' => 'Facturación Visitas',
                    'visible' => Yii::app()->user->isValidUser, //Yii::app()->user->isAdmin,
                    'items' => [
                        [
                            'label' => 'Corte',
                            'visible' => Yii::app()->user->isAdmin,
                            'items' => [
                                ['label' => 'Corte Facturación Visitas', 'url' => ['visitInvoiceDate/admin']],
                                ['label' => 'Crear Corte Facturación', 'url' => ['visitInvoiceDate/create', $pc = true]],
                            ],
                        ],
                        [
                            'label' => 'Costos Visitas',
                            'visible' => Yii::app()->user->isAdmin,
                            'items' => [
                                ['label' => 'Crear Costo Visita', 'url' => ['invoiceVisitCost/create', $pc = true]],
                                ['label' => 'Lista de Costos Visita', 'url' => ['invoiceVisitCost/admin']],
                            ],
                        ],
                        [
                            'label' => 'Facturación por Visitador',
                            'url' => ['invoiceVisit/admin'],
                            //'visible' =>'',
                        ],
                    ],
                ],
                [
                    'label' => 'Admin',
                    'visible' => Yii::app()->user->isAdmin,
                    'items' => [
                        ['label' => 'Clientes',
                            'items' => [
                                ['label' => 'Listado de Clientes', 'url' => ['customer/admin']],
                                ['label' => 'Crear Cliente', 'url' => ['customer/create']],
                            ],
                        ],
                        ['label' => 'Productos de Cliente',
                            'items' => [
                                ['label' => 'Productos', 'url' => ['customerProduct/admin']],
                                ['label' => 'Crear Producto', 'url' => ['customerProduct/create']],
                                ['label' => 'Archivos', 'url' => ['attachmentFile/admin']],
                                ['label' => 'Agregar Archivo', 'url' => ['attachmentFile/create']],
                            ],
                        ],
                        ['label' => 'Usuarios de Cliente',
                            'items' => [
                                ['label' => 'Usuarios de Cliente', 'url' => ['customerUser/admin']],
                                ['label' => 'Crear Usuario de Cli.', 'url' => ['customerUser/create']],
                            ],
                        ],
                        ['label' => 'Grupos de Clientes',
                            'items' => [
                                ['label' => 'Listado de Grupos', 'url' => ['customerGroup/admin']],
                                ['label' => 'Crear Grupo', 'url' => ['customerGroup/create']],
                            ],
                        ],
                        ['label' => 'Facturas de Clientes',
                            'items' => [
                                ['label' => 'Listado de Facturas', 'url' => ['invoice/admin']],
                                ['label' => 'Crear factura', 'url' => ['invoice/create']],
                                ['label' => 'Reporte Productividad', 'url' => ['backgroundCheckReport/productionReport']],
                                ['label' => 'Reporte Productividad Cant.', 'url' => ['backgroundCheckReport/productionReportQty']],
                                ['label' => 'Reporte Productividad CSV', 'url' => ['backgroundCheckReport/productionReportCSV']],
                            ],
                            'visible' => Yii::app()->user->isBilling,
                        ],
                        ['label' => 'Productos',
                            'items' => [
                                ['label' => 'Listado de Productos', 'url' => ['product/admin']],
                                ['label' => 'Crear Producto', 'url' => ['product/create']],
                            ],
                            'visible' => Yii::app()->user->isBilling,
                        ],
                        ['label' => 'Export Usuarios Cliente',
                            'url' => ['backgroundCheckReport/listclientsActive'],
                            'visible' => Yii::app()->user->isManager || Yii::app()->user->name == 'jcuellar@sintecto.com'],
                    ],
                ],
                ['label' => '<b>SYS Admin</b>',
                    'visible' => Yii::app()->user->isSuperAdmin,
                    'items' => [
                        ['label' => 'Usuarios',
                            'items' => [
                                ['label' => 'Log del Sistema', 'url' => ['log/admin']],
                                ['label' => 'Usuarios', 'url' => ['user/admin']],
                                ['label' => 'Crear Usuario', 'url' => ['user/create']],
                                ['label' => 'Log de Ingreso', 'url' => ['backgroundCheckReport/logEntry'],
                                    'visible' => Yii::app()->user->name == 'jcocoma@sintecto.com' || Yii::app()->user->name == 'jmontero@sintecto.com'],
                            ]],
                        ['label' => 'Configuración Permisos',
                        'items' => [
                           ['label' => 'Lista de Roles', 'url' =>['role/admin']],
                           ['label' => 'Crear Rol', 'url' =>['role/create']],
                           ['label' => 'Lista de Permisos', 'url' =>['permission/admin']],
                           ['label' => 'Crear Permiso', 'url' =>['permission/create']],
                            //array('label' => 'Permisos por Roles', 'url' =>['roleHasPermission/admin']],
                            //array('label' => 'Crear Permisos por Roles', 'url' =>['roleHasPermission/create']],
                        ]],
                        ['label' => 'Festivos',
                            'items' => [
                                ['label' => 'Listado de Festivos', 'url' => ['holiday/admin']],
                                ['label' => 'Creación de Festivo', 'url' => ['holiday/create']],
                            ]],
                        ['label' => 'Secciones',
                            'items' => [
                                ['label' => 'Listado de Secciones', 'url' => ['verificationSectionType/admin']],
                                ['label' => 'Nueva Sección XML', 'url' => ['verificationSectionType/create']],
                                ['label' => 'Nueva Sección HTML', 'url' => ['verificationSectionType/createHtml']],
                            ]],
                        ['label' => 'Preguntas de Sección',
                            'items' => [
                                ['label' => 'Preguntas de Sección', 'url' => ['sectionTypeQuestion/admin']],
                                ['label' => 'Nueva Pregunta de Sección', 'url' => ['sectionTypeQuestion/create']],
                            ]],
                        ['label' => 'Plantillas de Reporte',
                            'items' => [
                                ['label' => 'Plantillas de Reporte', 'url' => ['pdfReportType/admin']],
                                ['label' => 'Crear Plantilla de Reporte', 'url' => ['pdfReportType/create']],
                            ],
                            'visible' => Yii::app()->user->isSuperAdmin,
                        ],
                        ['label' => 'Estados de VCSP', 'url' => ['backgroundCheckStatus/admin']],
                        ['label' => 'Tipos de actividad', 'url' => ['activityType/admin']],
                        ['label' => 'Grupos de Secciones',
                            'items' => [
                                ['label' => 'Listado de Groups', 'url' => ['verificationSectionGroup/admin']],
                                ['label' => 'Crear Grupo', 'url' => ['verificationSectionGroup/create']],
                            ],
                        ],
                        [
                            'label' => 'Resultados Area Operaciones', 'url' => ['qualityPorc/resultoperations'],
                            'visible' => Yii::app()->user->isResultOperation,
                        ],
                        ['label' => 'Visitadores',
                            'items' => [
                                ['label' => 'Link de Encuesta', 'url' => ['surveyLink/admin']],
                                ['label' => 'Crear Link', 'url' => ['surveyLink/create']],
                            ],
                        ],
                        ['label' => 'JSON Formularios Dinámico',
                            'items' => [
                                ['label' => 'Lista de FD', 'url' => ['dynamicFormJSON/admin']],
                                ['label' => 'Crear JSON FD', 'url' => ['dynamicFormJSON/create']],
                            ],
                        ],

                        ['label' => 'Sistema',
                            'items' => [
                                ['label' => 'Mantenimiento', 'url' => ['backgroundCheck/mainteinance']],
                                ['label' => 'Depuracion Documentos', 'url' => ['backgroundCheck/formdataDoc'], 'visible' => Yii::app()->user->isManager],
                            ]],
                    ],
                ],
                [
                    'label' => 'Quejas PQR',
                    'visible' => Yii::app()->user->isSuperAdmin,
                    'items' => [
                        [
                            'label' => 'Quejas y Reclamos',
                            'items' => [
                                ['label' => 'Listado de quejas y reclamos', 'url' => ['tablaPqr/admin']],
                                ['label' => 'Crear queja y reclamo', 'url' => ['tablaPqr/create']],
                            ],
                        ],
                        [
                            'label' => 'Tipos de Quejas y Reclamos',
                            'items' => [
                                ['label' => 'Listado tipos de quejas y reclamos', 'url' => ['tipoPqr/admin']],
                                ['label' => 'Crear tipo de queja y reclamo', 'url' => ['tipoPqr/create']],
                            ],
                        ],     
                    ],
                ],
                ['label' => 'Inicio', 'url' => ['site/login'], 'visible' => Yii::app()->user->isGuest],
                ['label' => 'Cerrar Sesión', 'url' => ['/site/logout'], 'visible' => Yii::app()->user->isValidUser],
                ['label' => 'Ayuda',
                    'items' => [
                        ['label' => 'Ayuda', 'url' => ['/site/help'], 'visible' => Yii::app()->user->isValidUser],
                        ['label' => 'Instructivos', 'url' => ['/site/instructive'], 'visible' => Yii::app()->user->isValidUser],
                    ]],
            ],
        ];
        if(Yii::app()->user->getIsByRole()){
            AppMenu::validatePermission($menu);
        }
        return $menu;
    }
    //put your code here
    private static function validatePermission(&$menu)
    {
        if (isset($menu['items']) && is_array($menu['items'])) {
            $keys = array_keys($menu['items']);
            foreach ($keys as $key) {
                if (isset($menu['items'][$key]['url']) && is_array($menu['items'][$key]['url'])) {
                    $url = $menu['items'][$key]['url'][0];
                    if ($url[0] == '/') {
                        $url = substr($url, 1);
                    }
                    $urlArray = explode('/', $url);
                    if (Yii::app()->user->getHasPermissionToControllerAction($urlArray[0], $urlArray[1])) {
                        //echo "menus controller: {$urlArray[0]} menu action: {$urlArray[1]}<br/>";
                        //print("Menu items: {$menu['items'][$key]['url'][0]}<br/>");
                        $menu['items'][$key]['visible'] = true;
                        AppMenu::validatePermission($menu['items'][$key]);
                    } else {
                        //Borrar registro de un array con unset
                        unset($menu['items'][$key]);
                    }
                } else {
                    //print("Menu items: {$menu['items'][$key]['label']}<br/>");
                    $menu['items'][$key]['visible'] = true;
                    AppMenu::validatePermission($menu['items'][$key]);
                    if (isset($menu['items'][$key]['items']) && count($menu['items'][$key]['items']) == 0) {
                        unset($menu['items'][$key]);
                    }
                }
            }
        }
    }
}
