<?php


/**
 *  // Claro Nacional
 * 2673 // PRODECO Nacional Básico
 * 2674 // PRODECO Internacional Básico
 * 2679 // PRODECO Nacional Plus
 * 3353 // PRODECO Nacional Plus.
 * 2681 // PRODECO Internacional Plus
 * 2675 // PRODECO Validación Reputacional
 * 2632 // COLPENSIONES ASIGNACIÓN DE CÓDIGO INTERNO
 * 2680 // UNIANDES
 * 2697 // CLARO PROVEEDORES NACIONALES
 * 2698 // CLARO PROVEEDORES INTERNACIONALES
 */

// PRODECO Nacional Básico
if ($backgroundCheck->customerProductId == 2673 ) {
    $prodecoNacBasic = TRUE;
};

// PRODECO Nacional Básico.
if ($backgroundCheck->customerProductId == 3354 ) {
    $prodecoNacBasic = TRUE;
};
// PRODECO Internacional Básico
if ($backgroundCheck->customerProductId == 2674 ) {
    $prodecoIntBasic = TRUE;
};
// PRODECO Validación Reputacional
if ($backgroundCheck->customerProductId == 2675 ) {
    $prodecoValidacionReputacional = TRUE;
}
// PRODECO Nacional Plus
if ($backgroundCheck->customerProductId == 2679 ) {
    $prodecoNacPlus = TRUE;
}
// PRODECO Nacional Plus.
if ($backgroundCheck->customerProductId == 3353 ) {
    $prodecoNacPlus2 = TRUE;
}
// PRODECO Internacional Plus
if ($backgroundCheck->customerProductId == 2681 ) {
    $prodecoIntPlus = TRUE;
}

// COLPENSIONES ASIGNACIÓN DE CÓDIGO INTERNO
if ($backgroundCheck->customerProductId == 2632 ) {
    $colpensionesAsignacionCodigoInterno = TRUE;
    // VISITA A EMPRESAS
   $sectionCompanyVisit = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_VISIT)->detailCompanyVisit;
   // SOCIOS Y REPRESENTANTES LEGALES
   $shareholdersSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER);
   // EMPLEADOS
   $sectionCompanyEmployee = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE)->detailCompanyEmployee;
   // CLIENTES
   $sectionCompanyCustomer = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->detailCompanyCustomer;
   // ANÁLISIS FINANCIERO
   $sectionCompanyFinantialAnalys = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->detailCompanyFinantialAnalys;
}

// COLPENSIONES ASIGNACIÓN DE CÓDIGO INTERNO DESCUENTO COMPLETO

if ($backgroundCheck->customerProductId == 3157 ) {
    $colpensionesAsignacionCodigoInterno = TRUE;
    // VISITA A EMPRESAS
    $sectionCompanyVisit = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_VISIT)->detailCompanyVisit;
    // SOCIOS Y REPRESENTANTES LEGALES
    $shareholdersSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER);
    // EMPLEADOS
    $sectionCompanyEmployee = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE)->detailCompanyEmployee;
    // CLIENTES
    $sectionCompanyCustomer = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->detailCompanyCustomer;
    // ANÁLISIS FINANCIERO
    $sectionCompanyFinantialAnalys = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->detailCompanyFinantialAnalys;
}
// COLPENSIONES ASIGNACIÓN DE CÓDIGO INTERNO DESCUENTO PARCIAL

if ($backgroundCheck->customerProductId == 3096 ) {
    $colpensionesAsignacionCodigoInterno = TRUE;
    // VISITA A EMPRESAS
    $sectionCompanyVisit = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_VISIT)->detailCompanyVisit;
    // SOCIOS Y REPRESENTANTES LEGALES
    $shareholdersSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER);
    // EMPLEADOS
    $sectionCompanyEmployee = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE)->detailCompanyEmployee;
    // CLIENTES
    $sectionCompanyCustomer = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->detailCompanyCustomer;
    // ANÁLISIS FINANCIERO
    $sectionCompanyFinantialAnalys = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->detailCompanyFinantialAnalys;
}
// COLPENSIONES ASIGNACIÓN DE CÓDIGO INTERNO ENTREVISTA VIRTUAL

if ($backgroundCheck->customerProductId == 3159 ) {
    $colpensionesAsignacionCodigoInterno = TRUE;
    // VISITA A EMPRESAS
    $sectionCompanyVisit = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_VISIT)->detailCompanyVisit;
    // SOCIOS Y REPRESENTANTES LEGALES
    $shareholdersSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER);
    // EMPLEADOS
    $sectionCompanyEmployee = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE)->detailCompanyEmployee;
    // CLIENTES
    $sectionCompanyCustomer = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->detailCompanyCustomer;
    // ANÁLISIS FINANCIERO
    $sectionCompanyFinantialAnalys = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->detailCompanyFinantialAnalys;
}

// COLPENSIONES CONMUTACION PENSIONAL
if ($backgroundCheck->customerProductId == 2646 ) {
    $colpensionesConmutacionPensional = TRUE;
    // VISITA A EMPRESAS
   $sectionCompanyVisit = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_VISIT)->detailCompanyVisit;
   // SOCIOS Y REPRESENTANTES LEGALES
   $shareholdersSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER);
   // EMPLEADOS
   $sectionCompanyEmployee = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE)->detailCompanyEmployee;
}
// CLARO NACIONAL
if ($backgroundCheck->customerProductId == 2697 ) {

    $claroProveedoresNacionales = TRUE;

   // VISITA A EMPRESAS
   $sectionCompanyVisit = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_VISIT)->detailCompanyVisit;
   // SOCIOS Y REPRESENTANTES LEGALES
   $shareholdersSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER);
   // EMPLEADOS
   $sectionCompanyEmployee = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE)->detailCompanyEmployee;
   // CLIENTES
   $sectionCompanyCustomer = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->detailCompanyCustomer;
   // PROVEEDORES
   $sectionCompanyProvider = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_PROVIDER)->detailCompanyProvider;
   // ANÁLISIS FINANCIERO
   $sectionCompanyFinantialAnalys = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->detailCompanyFinantialAnalys;
   // CENTRALES  DE RIESGO
   $sectionCompanyFinance = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE)->detailCompanyFinance;
   
   // HALLAZGO AUDITORIA
   $sectionAudit = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_AUDIT);
   
   // ASISTENCIA AUDITORIA
   $sectionAuditAttendance = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_AUDIT_ATTENDANCE);

   $claroNacResult = TRUE;

};
// CLARO INTERNACIONAL
if ($backgroundCheck->customerProductId == 2698 ) {

    $claroProveedoresNacionales = TRUE;
   // VISITA A EMPRESAS
   $sectionCompanyVisit = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_VISIT)->detailCompanyVisit;
   // SOCIOS Y REPRESENTANTES LEGALES
   $shareholdersSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER);
   // EMPLEADOS
   $sectionCompanyEmployee = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE)->detailCompanyEmployee;
   // CLIENTES
   $sectionCompanyCustomer = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->detailCompanyCustomer;
   // PROVEEDORES
   $sectionCompanyProvider = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_PROVIDER)->detailCompanyProvider;
   // ANÁLISIS FINANCIERO
   $sectionCompanyFinantialAnalys = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->detailCompanyFinantialAnalys;
   // CENTRALES  DE RIESGO
   $sectionCompanyFinance = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE)->detailCompanyFinance;

   $claroIntResult = TRUE;

};
// PRODECO NACIONAL PLUS
if ($backgroundCheck->customerProductId == 2679 ) {
    // CLIENTES
    $sectionCompanyCustomer = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->detailCompanyCustomer;
    // ANÁLISIS FINANCIERO
    $sectionCompanyFinantialAnalys = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->detailCompanyFinantialAnalys;
    // CENTRALES  DE RIESGO
    $sectionCompanyFinance = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE)->detailCompanyFinance;
    // EMPLEADOS
   $sectionCompanyEmployee = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE)->detailCompanyEmployee;
    
    $prodecoNacPlus = TRUE;
};

// PRODECO NACIONAL PLUS.
if ($backgroundCheck->customerProductId == 3353 ) {
    // CLIENTES
    $sectionCompanyCustomer = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->detailCompanyCustomer;
    // ANÁLISIS FINANCIERO
    $sectionCompanyFinantialAnalys = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->detailCompanyFinantialAnalys;
    // CENTRALES  DE RIESGO
    $sectionCompanyFinance = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE)->detailCompanyFinance;
    // EMPLEADOS
    $sectionCompanyEmployee = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE)->detailCompanyEmployee;

    $prodecoNacPlus2 = TRUE;
};

// PRODECO Internacional Plus
if ($backgroundCheck->customerProductId == 2681 ) {
    // ANÁLISIS FINANCIERO
    $sectionCompanyFinantialAnalys = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->detailCompanyFinantialAnalys;
    // EMPLEADOS
   $sectionCompanyEmployee = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE)->detailCompanyEmployee;
    $prodecoIntPlus = TRUE;
    // CLIENTES
    $sectionCompanyCustomer = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->detailCompanyCustomer;


}

// UNIANDES
if ($backgroundCheck->customerProductId == 2680 ) {
    
    // SOCIOS Y REPRESENTANTES LEGALES
    $shareholdersSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER);
    // CLIENTES
    $sectionCompanyCustomer = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->detailCompanyCustomer;
    // PROVEEDORES
    $sectionCompanyProvider = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_PROVIDER)->detailCompanyProvider;
    // ANÁLISIS FINANCIERO
    $sectionCompanyFinantialAnalys = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->detailCompanyFinantialAnalys;
    // CENTRALES  DE RIESGO
    $sectionCompanyFinance = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE)->detailCompanyFinance;
    
    $uniandes = TRUE;

}


//styles

    $bgGray = 220; $bgWhite = 255;
    $txBlack = 0; $txWhite = 255;