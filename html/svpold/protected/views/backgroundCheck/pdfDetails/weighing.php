<?php
    $pondNationalRisk = array(
        "antiguedad"=> array(
            "weight" => 4,
            "value" => 4,
            "añosdeActividad" => array(
                "3" =>   1,
                "8" =>   2,
                "15" =>  3,
                "+16" => 4,
            ),
        ),
        "financiero" => array(
            "weight" => 35,
            "value" => 14,
            "capitalDeTrabajo" => array(
                "positivo" => 1,
                "negativo" => 0,
            ),
            "razonCorriente" => array(
                ">= a 1,0" => 2,
                "De 0,81 a 1,0" => 1,
                "< 0,80" => 0,
            ),
            "nivelDeEndeudamiento" => array(
                "< a 0,60" => 2,
                "De 0,61 a 0,80" => 1,
                "> 0,80" => 0,
            ),
            "endeudamientoFinanciero" => array(
                "Menor o igual a 0.8" => 1,
                "Mayor a 0.8" => 0,
            ),
            "apalancamientoCortoPlazo" => array(), // VACIO
            "rentabilidadPatrimonioROE" => array(), // VACIO
            "margenEBITDA" => array(
                ">= 0,16" => 1,
                "De 0,08 a 0,159" => 1,
                "< a 0,08" => 0,
            ),
            "endeudamientoVentas" => array(), // VACIO
            "coberturadeGastosNoOperacionales" => array(
                ">= 2,5" => 1,
                "< a 2,5" => 0,
            ),
        ),
        "calidad" => array(
            "weight" => 10,
            "value" => 18,
            "certificacionISO9001" => array(
                "Sí" => 6,
                "No" => 0,
                "En Proceso" => 3,
                "N/A" => 6,
            ),
            "certificacionISO14001" => array(
                "Sí" => 4,
                "No" => 0,
                "En Proceso" => 2,
                "N/A" => 4,
            ),
            "certificacionOHSAS18000" => array(
                "Sí" => 4,
                "No" => 0,
                "En Proceso" => 2,
                "N/A" => 4,
            ),
            "certificacionISO27001" => array(
                "Sí" => 4,
                "No" => 0,
                "En Proceso" => 2,
                "N/A" => 4,
            ),
            //compañias no certificadas
            "manualCalidadDocumentado" => array(
                "Sí" => 2,
                "No" => 0,
                "N/A" => 2,  
            ),
            "politicaCalidadDeclarada" => array(
                "Sí" => 1,
                "No" => 0,
                "N/A" => 1,  
            ),
            "mapaProcesos" => array(
                "Sí" => 1,
                "No" => 0,
                "N/A" => 1,  
            ),
            "caracterizaciondeProcesos" => array(
                "Sí" => 1.5,
                "No" => 0,
                "N/A" => 1.5,  
            ),
            "manualesProcedimientosDocumentados" => array(
                "Sí" => 2,
                "No" => 0,
                "N/A" => 2,  
            ),
            "organigramaDeCompañia" => array(
                "Sí" => 1,
                "No" => 0,
                "N/A" => 1,  
            ),
            "planeacionEstrategica" => array(
                "Sí" => 1,
                "No" => 0,
                "N/A" => 1,  
            ),
        ),
        "sgsst" =>  array(
            "weight" => 10,
            "value" => 49,
            "sistemaGestionySeguridadEnElTrabajoDeclarado" => array(
                "Sí" => 10,
                "No" => 0,
                "No, pero cuenta con politica de SST" => 3,
                "En proceso de implementacion" => 5,
                "N/A" => 10, 
            ),
            "COPASST" => array(
                "Sí" => 6,
                "No" => 0,
                "N/A" => 6,  
            ),
            "planEmergenciasDeclarado" => array(
                "Sí" => 7,
                "No" => 0,
                "N/A" => 7,  
            ),
            "esquemaManejoIncidentesDefinido" => array(
                "Sí" => 4,
                "No" => 0,
                "N/A" => 4,  
            ),
            "matrizPeligros" => array(
                "Sí" => 4,
                "No" => 0,
                "N/A" => 4,  
            ),
            "reglamentoInternoTrabajoDefinidoyPublicado" => array(
                "Sí" => 4,
                "No" => 0,
                "N/A" => 4,  
            ),
            "reglamentoHigieneySeguridadIndustrialDefinidoyPublicado" => array(
                "Sí" => 4,
                "No" => 0,
                "N/A" => 4,  
            ),
            "entregaDotacionyEPPs" => array(
                "Sí" => 6,
                "No" => 0,
                "N/A" => 6,  
            ),
            "fichasTecnicasEPPs" => array(
                "Sí" => 4,
                "No" => 0,
                "N/A" => 4,  
            ),
        ),
        "compras" =>  array(
            "weight" => 5,
            "value" => 4,
            "baseDatosdeProveedores" => array(
                "Sí" => 2,
                "No" => 0,
                "N/A" => 2,  
            ),
            "evaluacionPeriodicaProveedores" => array(
                "Sí" => 2,
                "No" => 0,
                "N/A" => 2,  
            ),
        ),
        "servicios" =>  array(
            "weight" => 5,
            "value" => 12,
            "asignacionEjecutivodeCuenta" => array(
                "Sí" => 2,
                "No" => 0,
                "N/A" => 2,  
            ),
            "cuentanConSedeATC" => array(
                "Sí" => 2,
                "No" => 0,
                "N/A" => 2,  
            ),
            "servicioPostVenta" => array(
                "Sí" => 2,
                "No" => 0,
                "N/A" => 2,  
            ),
            "garantiaEnProductosyServicios" => array(
                "Sí" => 2,
                "No" => 0,
                "N/A" => 2,  
            ),
            "serviciodeMantenimientoTecnico" => array(
                "Sí" => 2,
                "No" => 0,
                "N/A" => 2,  
            ),
            "polizasdeSeguros" => array(
                "Sí" => 2,
                "No" => 0,
                "N/A" => 2,  
            ),
        ),
        "referencias" =>  array(
            "weight" => 10,
            "value" => 20,
            "puntualidadEnTiemposdeEntrega" => array(
                "Excelente" => 4,
                "Muy Bueno" => 3,
                "Bueno" => 2,
                "Regular" => 1,
                "Malo" => 0,
                "No Aplica" => 4,  
            ),
            "calidadDelProductoServicio" => array(
                "Excelente" => 4,
                "Muy Bueno" => 3,
                "Bueno" => 2,
                "Regular" => 1,
                "Malo" => 0,
                "No Aplica" => 4,  
            ),
            "atencionAlCliente" => array(
                "Excelente" => 4,
                "Muy Bueno" => 3,
                "Bueno" => 2,
                "Regular" => 1,
                "Malo" => 0,
                "No Aplica" => 4,  
            ),
            "rapidezParaAtenderQuejasyReclamos" => array(
                "Excelente" => 4,
                "Muy Bueno" => 3,
                "Bueno" => 2,
                "Regular" => 1,
                "Malo" => 0,
                "No Aplica" => 4,  
            ),
            "precioFrenteLaCompetencia" => array(
                "Excelente" => 4,
                "Muy Bueno" => 3,
                "Bueno" => 2,
                "Regular" => 1,
                "Malo" => 0,
                "No Aplica" => 4,  
            ),
        ),
        "proveedores" =>  array(
            "weight" => 5,
            "value" => 6,
            "deudasConProvedoresReferidos" => array(
                "Sí" => 0,
                "No" => 2,
                "N/A" => 2,  
            ),
            "calificaciondeProveedoresComoCliente" => array(
                "Excelente" => 4,
                "Muy Bueno" => 3,
                "Bueno" => 2,
                "Regular" => 1,
                "Malo" => 0,
                "No Aplica" => 4,  
            ),
        ),
        "rrhh" =>  array(
            "weight" => 6,
            "value" => 17,
            "revisionAntecedentesJudicialesaEmpleados" => array(
                "Sí" => 3,
                "No" => 0,
                "N/A" => 3,  
            ),
            "comitedeConvivencia" => array(
                "Sí" => 3,
                "No" => 0,
                "N/A" => 3,  
            ),
            "cronogramadeCapacitacionDocumentado" => array(
                "Sí" => 2,
                "No" => 0,
                "N/A" => 2,  
            ),
            "mediciondeDesempeñoaEmpleados" => array(
                "Sí" => 3,
                "No" => 0,
                "N/A" => 3,  
            ),
            "manualFuncionesPerfilCargo" => array(
                "Sí" => 2,
                "No" => 0,
                "N/A" => 2,  
            ),
            "pagoSeguridadSocial" => array(
                "Sí" => 4,
                "No" => 0,
                "N/A" => 4,  
            ),
            "coberturaLocal" => array(
                "Sí" => 2,
                "No" => 0,  
            ),
        ),
        "infraestructura" =>  array(
            "weight" => 5,
            "value" => 12,
            "infraestructuraFisica" => array(
                "Cumple" => 4,
                "No Cumple" => 0,
                "No aplica" => 4,  
            ),
            "infraestructuraInformaticayComunicaciones" => array(
                "Cumple" => 4,
                "No Cumple" => 0,
                "No aplica" => 4,  
            ),
            "maquinariayEquipo" => array(
                "Cumple" => 4,
                "No Cumple" => 0,
                "No aplica" => 4,  
            ),
        ),
        "cobertura" =>  array(
            "weight" => 5,
            "value" => 8,
            "coberturaLocal" => array(
                "Sí" => 2,
                "No" => 0,
                "N/A" => 2,  
            ),
            "coberturaNacional" => array(
                "Sí" => 3,
                "No" => 0,
                "N/A" => 3,   
            ),
            "coberturaInternacional" => array(
                "Sí" => 4,
                "No" => 0,
                "N/A" => 4,                
            ),   
        ),
        "legal" =>  array(
            "Clinton" => array(
                "Sí" => "No Apto",
                "No" => "Apto",
                "N/A" => "Apto",                
            ),
            "ONU" => array(
                "Sí" => "No Apto",
                "No" => "Apto",
                "N/A" => "Apto",                
            ),  
            "Interpol" => array(
                "Sí" => "No Apto",
                "No" => "Apto",
                "N/A" => "Apto",                
            ),
            "reinoUnido" => array(
                "Sí" => "No Apto",
                "No" => "Apto",
                "N/A" => "Apto",                
            ),
            "unionEuropea" => array(
                "Sí" => "No Apto",
                "No" => "Apto",
                "N/A" => "Apto",                
            ),
            "proveedoresFicticios" => array(
                "Sí" => "No Apto",
                "No" => "Apto",
                "N/A" => "Apto",                
            ),
            "procuraduria" => array(
                "Sí" => "No Apto",
                "No" => "Apto",
                "N/A" => "Apto",                
            ),
            "contraloria" => array(
                "Sí" => "No Apto",
                "No" => "Apto",
                "N/A" => "Apto",                
            ),
            "pasadoJudicial" => array(
                "Sí" => "No Apto",
                "No" => "Apto",
                "N/A" => "Apto",                
            ),
            "matriculaMercantilRenovada" => array(
                "Sí" => "No Apto",
                "No" => "Apto",
                "N/A" => "Apto",                
            ),
            "novedadCentralDeRiesgo" => array(
                "Sí" => "No Apto",
                "No" => "Apto",
                "N/A" => "Apto",                
            ),
            "reorganizacionEmpresarial" => array(
                "No presenta novedad" =>  0,
                "Faltan mas de 3 años" =>  -20,
                "Faltan 2 años" =>  -10,
                "Falta 1 año" =>  -5,
            ),
        ),
    );