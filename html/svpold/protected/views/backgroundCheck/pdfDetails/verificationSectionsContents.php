<?php
    
    // SECCIONES DE XML
    $query_A = 'SELECT vs.verificationSectionTypeId, xl.answer FROM ses_XmlSection xl
    INNER JOIN ses_VerificationSection vs ON xl.verificationSectionId = vs.id
    WHERE backgroundCheckId = "'.$backgroundCheck->id.'"
    AND xl.answer != ""
    ORDER BY vs.verificationSectionTypeId ASC;';

    $query = Yii::app()->db->createCommand($query_A)->queryAll();
    $XMLQuestionResult = array();
    foreach($query as $answer){
        $result =  unserialize($answer['answer']) ;
        $XMLQuestionResult = array_merge($XMLQuestionResult, $result);
    };

    if (!isset($XMLQuestionResult['taxrenttype'])) { $XMLQuestionResult['taxrenttype'] = ""; }
    if (!isset($XMLQuestionResult['icacity'])) { $XMLQuestionResult['icacity'] = ""; }
    if (!isset($XMLQuestionResult['taxivatype'])) { $XMLQuestionResult['taxivatype'] = ""; }
    if (!isset($XMLQuestionResult['taxicatype'])) { $XMLQuestionResult['taxicatype'] = ""; }
    if (!isset($XMLQuestionResult['icacvalue'])) { $XMLQuestionResult['icacvalue'] = ""; }
    if (!isset($XMLQuestionResult['bankname'])) { $XMLQuestionResult['bankname'] = ""; }
    if (!isset($XMLQuestionResult['bankaccountholder'])) { $XMLQuestionResult['bankaccountholder'] = ""; }
    if (!isset($XMLQuestionResult['bankaccounttype'])) { $XMLQuestionResult['bankaccounttype'] = ""; }
    if (!isset($XMLQuestionResult['bankaccount'])) { $XMLQuestionResult['bankaccount'] = ""; }
    if (!isset($XMLQuestionResult['certification_1'])) { $XMLQuestionResult['certification_1'] = ""; }
    if (!isset($XMLQuestionResult['certification_2'])) { $XMLQuestionResult['certification_2'] = ""; }
    if (!isset($XMLQuestionResult['certification_3'])) { $XMLQuestionResult['certification_3'] = ""; }
    if (!isset($XMLQuestionResult['certification_4'])) { $XMLQuestionResult['certification_4'] = ""; }
    if (!isset($XMLQuestionResult['certification_5'])) { $XMLQuestionResult['certification_5'] = ""; }
    if (!isset($XMLQuestionResult['certification_6'])) { $XMLQuestionResult['certification_6'] = ""; }
    if (!isset($XMLQuestionResult['certification_8'])) { $XMLQuestionResult['certification_8'] = ""; }
    if (!isset($XMLQuestionResult['certification_7'])) { $XMLQuestionResult['certification_7'] = ""; }
    if (!isset($XMLQuestionResult['certification_9'])) { $XMLQuestionResult['certification_9'] = ""; }
    if (!isset($XMLQuestionResult['certification_10'])) { $XMLQuestionResult['certification_10'] = ""; }
    if (!isset($XMLQuestionResult['certification_11'])) { $XMLQuestionResult['certification_11'] = ""; }
    if (!isset($XMLQuestionResult['certification_12'])) { $XMLQuestionResult['certification_12'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_1'])) { $XMLQuestionResult['rrhh_1'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_2'])) { $XMLQuestionResult['rrhh_2'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_3'])) { $XMLQuestionResult['rrhh_3'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_4'])) { $XMLQuestionResult['rrhh_4'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_5'])) { $XMLQuestionResult['rrhh_5'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_6'])) { $XMLQuestionResult['rrhh_6'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_7'])) { $XMLQuestionResult['rrhh_7'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_8'])) { $XMLQuestionResult['rrhh_8'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_9'])) { $XMLQuestionResult['rrhh_9'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_10'])) { $XMLQuestionResult['rrhh_10'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_11'])) { $XMLQuestionResult['rrhh_11'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_12'])) { $XMLQuestionResult['rrhh_12'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_13'])) { $XMLQuestionResult['rrhh_13'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_14'])) { $XMLQuestionResult['rrhh_14'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_15'])) { $XMLQuestionResult['rrhh_15'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_16'])) { $XMLQuestionResult['rrhh_16'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_17'])) { $XMLQuestionResult['rrhh_17'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_18'])) { $XMLQuestionResult['rrhh_18'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_19'])) { $XMLQuestionResult['rrhh_19'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_20'])) { $XMLQuestionResult['rrhh_20'] = ""; }
    if (!isset($XMLQuestionResult['rrhh_21'])) { $XMLQuestionResult['rrhh_21'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_1'])) { $XMLQuestionResult['sgssst_1'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_2'])) { $XMLQuestionResult['sgssst_2'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_3'])) { $XMLQuestionResult['sgssst_3'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_4'])) { $XMLQuestionResult['sgssst_4'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_5'])) { $XMLQuestionResult['sgssst_5'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_6'])) { $XMLQuestionResult['sgssst_6'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_7'])) { $XMLQuestionResult['sgssst_7'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_8'])) { $XMLQuestionResult['sgssst_8'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_9'])) { $XMLQuestionResult['sgssst_9'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_10'])) { $XMLQuestionResult['sgssst_10'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_11'])) { $XMLQuestionResult['sgssst_11'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_12'])) { $XMLQuestionResult['sgssst_12'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_13'])) { $XMLQuestionResult['sgssst_13'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_14'])) { $XMLQuestionResult['sgssst_14'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_15'])) { $XMLQuestionResult['sgssst_15'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_16'])) { $XMLQuestionResult['sgssst_16'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_17'])) { $XMLQuestionResult['sgssst_17'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_18'])) { $XMLQuestionResult['sgssst_18'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_19'])) { $XMLQuestionResult['sgssst_19'] = ""; }

    if (!isset($XMLQuestionResult['sgssst_10_comment'])) { $XMLQuestionResult['sgssst_10_comment'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_11_comment'])) { $XMLQuestionResult['sgssst_11_comment'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_13_comment'])) { $XMLQuestionResult['sgssst_13_comment'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_15_comment'])) { $XMLQuestionResult['sgssst_15_comment'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_16_comment'])) { $XMLQuestionResult['sgssst_16_comment'] = ""; }
    if (!isset($XMLQuestionResult['sgssst_18_comment'])) { $XMLQuestionResult['sgssst_18_comment'] = ""; }

    if (!isset($XMLQuestionResult['OfacYOnu'])) { $XMLQuestionResult['OfacYOnu'] = ""; }
    if (!isset($XMLQuestionResult['Boe'])) { $XMLQuestionResult['Boe'] = ""; }
    if (!isset($XMLQuestionResult['entControl'])) { $XMLQuestionResult['entControl'] = ""; }
    if (!isset($XMLQuestionResult['entPoliciales'])) { $XMLQuestionResult['entPoliciales'] = ""; }
    if (!isset($XMLQuestionResult['otrosBoletines'])) { $XMLQuestionResult['otrosBoletines'] = ""; }
    if (!isset($XMLQuestionResult['empresasFicticias'])) { $XMLQuestionResult['empresasFicticias'] = ""; }
    if (!isset($XMLQuestionResult['paraisosFiscales'])) { $XMLQuestionResult['paraisosFiscales'] = ""; }
    if (!isset($XMLQuestionResult['boletinesDeudoresMorosos'])) { $XMLQuestionResult['boletinesDeudoresMorosos'] = ""; }
    if (!isset($XMLQuestionResult['registrosRamaJudicial'])) { $XMLQuestionResult['registrosRamaJudicial'] = ""; }
    if (!isset($XMLQuestionResult['demandas'])) { $XMLQuestionResult['demandas'] = ""; }
    if (!isset($XMLQuestionResult['sinNovedad'])) { $XMLQuestionResult['sinNovedad'] = ""; }
    if (!isset($XMLQuestionResult['sinNovedadDet'])) { $XMLQuestionResult['sinNovedadDet'] = ""; }
    if (!isset($XMLQuestionResult['complianceAlerta'])) { $XMLQuestionResult['complianceAlerta'] = ""; }
    if (!isset($XMLQuestionResult['compliaceAlertaDet'])) { $XMLQuestionResult['compliaceAlertaDet'] = ""; }
    if (!isset($XMLQuestionResult['alertaLaFt'])) { $XMLQuestionResult['alertaLaFt'] = ""; }
    if (!isset($XMLQuestionResult['alertaLaFtDet'])) { $XMLQuestionResult['alertaLaFtDet'] = ""; }
    if (!isset($XMLQuestionResult['paraisosFiscales'])) { $XMLQuestionResult['paraisosFiscales'] = ""; }
    if (!isset($XMLQuestionResult['infraestructuraFisica'])) { $XMLQuestionResult['infraestructuraFisica'] = ""; }
    if (!isset($XMLQuestionResult['infraestructuraInformatica'])) { $XMLQuestionResult['infraestructuraInformatica'] = ""; }
    if (!isset($XMLQuestionResult['infraestructuraEquipos'])) { $XMLQuestionResult['infraestructuraEquipos'] = ""; }
    if (!isset($XMLQuestionResult['proveedorNacionalBasic_1'])) { $XMLQuestionResult['proveedorNacionalBasic_1'] = ""; }
    if (!isset($XMLQuestionResult['proveedorNacionalBasic_2'])) { $XMLQuestionResult['proveedorNacionalBasic_2'] = ""; }
    if (!isset($XMLQuestionResult['proveedorNacionalBasic_3'])) { $XMLQuestionResult['proveedorNacionalBasic_3'] = ""; }
    if (!isset($XMLQuestionResult['proveedorNacionalBasic_4'])) { $XMLQuestionResult['proveedorNacionalBasic_4'] = ""; }
    if (!isset($XMLQuestionResult['proveedorNacionalBasic_5'])) { $XMLQuestionResult['proveedorNacionalBasic_5'] = ""; }
    if (!isset($XMLQuestionResult['proveedorNacionalBasic_6'])) { $XMLQuestionResult['proveedorNacionalBasic_6'] = ""; }
    if (!isset($XMLQuestionResult['proveedorNacionalBasic_7'])) { $XMLQuestionResult['proveedorNacionalBasic_7'] = ""; }
    if (!isset($XMLQuestionResult['proveedorNacionalBasic_8'])) { $XMLQuestionResult['proveedorNacionalBasic_8'] = ""; }
    if (!isset($XMLQuestionResult['proveedorNacionalBasic_9'])) { $XMLQuestionResult['proveedorNacionalBasic_9'] = ""; }
    if (!isset($XMLQuestionResult['proveedorInternacionalBasic_1'])) { $XMLQuestionResult['proveedorInternacionalBasic_1'] = ""; }
    if (!isset($XMLQuestionResult['proveedorInternacionalBasic_2'])) { $XMLQuestionResult['proveedorInternacionalBasic_2'] = ""; }
    if (!isset($XMLQuestionResult['proveedorInternacionalBasic_3'])) { $XMLQuestionResult['proveedorInternacionalBasic_3'] = ""; }
    if (!isset($XMLQuestionResult['proveedorInternacionalBasic_4'])) { $XMLQuestionResult['proveedorInternacionalBasic_4'] = ""; }
    if (!isset($XMLQuestionResult['proveedorInternacionalBasic_5'])) { $XMLQuestionResult['proveedorInternacionalBasic_5'] = ""; }
    if (!isset($XMLQuestionResult['proveedorInternacionalBasic_6'])) { $XMLQuestionResult['proveedorInternacionalBasic_6'] = ""; }
    if (!isset($XMLQuestionResult['proveedorInternacionalBasic_7'])) { $XMLQuestionResult['proveedorInternacionalBasic_7'] = ""; }

    if (!isset($XMLQuestionResult['plusNacNegProdeco_1'])) { $XMLQuestionResult['plusNacNegProdeco_1'] = ""; }
    if (!isset($XMLQuestionResult['plusNacNegProdeco_2'])) { $XMLQuestionResult['plusNacNegProdeco_2'] = ""; }
    if (!isset($XMLQuestionResult['plusNacNegProdeco_3'])) { $XMLQuestionResult['plusNacNegProdeco_3'] = ""; }
    if (!isset($XMLQuestionResult['plusNacNegProdeco_4'])) { $XMLQuestionResult['plusNacNegProdeco_4'] = ""; }
    if (!isset($XMLQuestionResult['plusNacNegProdeco_5'])) { $XMLQuestionResult['plusNacNegProdeco_5'] = ""; }
    if (!isset($XMLQuestionResult['plusNacNegProdeco_6'])) { $XMLQuestionResult['plusNacNegProdeco_6'] = ""; }
    if (!isset($XMLQuestionResult['plusNacNegProdeco_7'])) { $XMLQuestionResult['plusNacNegProdeco_7'] = ""; }
    if (!isset($XMLQuestionResult['plusNacNegProdeco_8'])) { $XMLQuestionResult['plusNacNegProdeco_8'] = ""; }
    if (!isset($XMLQuestionResult['plusNacNegProdeco_9'])) { $XMLQuestionResult['plusNacNegProdeco_9'] = ""; }
    
    if (!isset($XMLQuestionResult['plusNacPosProdeco_1'])) { $XMLQuestionResult['plusNacPosProdeco_1'] = ""; }
    if (!isset($XMLQuestionResult['plusNacPosProdeco_2'])) { $XMLQuestionResult['plusNacPosProdeco_2'] = ""; }
    if (!isset($XMLQuestionResult['plusNacPosProdeco_3'])) { $XMLQuestionResult['plusNacPosProdeco_3'] = ""; }
    if (!isset($XMLQuestionResult['plusNacPosProdeco_4'])) { $XMLQuestionResult['plusNacPosProdeco_4'] = ""; }

    if (!isset($XMLQuestionResult['plusIntNegProdeco_1'])) { $XMLQuestionResult['plusIntNegProdeco_1'] = ""; }
    if (!isset($XMLQuestionResult['plusIntNegProdeco_2'])) { $XMLQuestionResult['plusIntNegProdeco_2'] = ""; }
    if (!isset($XMLQuestionResult['plusIntNegProdeco_3'])) { $XMLQuestionResult['plusIntNegProdeco_3'] = ""; }
    if (!isset($XMLQuestionResult['plusIntPosProdeco_1'])) { $XMLQuestionResult['plusIntPosProdeco_1'] = ""; }
    if (!isset($XMLQuestionResult['plusIntPosProdeco_2'])) { $XMLQuestionResult['plusIntPosProdeco_2'] = ""; }

    if (!isset($XMLQuestionResult['valDocCID_1'])) { $XMLQuestionResult['valDocCID_1'] = ""; }
    if (!isset($XMLQuestionResult['valDocCID_2'])) { $XMLQuestionResult['valDocCID_2'] = ""; }
    if (!isset($XMLQuestionResult['valDocCID_3'])) { $XMLQuestionResult['valDocCID_3'] = ""; }
    if (!isset($XMLQuestionResult['valDocCID_4'])) { $XMLQuestionResult['valDocCID_4'] = ""; }
    if (!isset($XMLQuestionResult['valDocCID_5'])) { $XMLQuestionResult['valDocCID_5'] = ""; }
    if (!isset($XMLQuestionResult['valDocCID_6'])) { $XMLQuestionResult['valDocCID_6'] = ""; }
    if (!isset($XMLQuestionResult['valDocCID_7'])) { $XMLQuestionResult['valDocCID_7'] = ""; }
    if (!isset($XMLQuestionResult['valDocCID_8'])) { $XMLQuestionResult['valDocCID_8'] = ""; }
    if (!isset($XMLQuestionResult['valDocCID_9'])) { $XMLQuestionResult['valDocCID_9'] = ""; }
    if (!isset($XMLQuestionResult['valDocCID_10'])) { $XMLQuestionResult['valDocCID_10'] = ""; }
    if (!isset($XMLQuestionResult['valDocCID_11'])) { $XMLQuestionResult['valDocCID_11'] = ""; }    
    if (!isset($XMLQuestionResult['valDocCID_12'])) { $XMLQuestionResult['valDocCID_12'] = ""; }    
    if (!isset($XMLQuestionResult['valDocCID_13'])) { $XMLQuestionResult['valDocCID_13'] = ""; }    
    if (!isset($XMLQuestionResult['valDocCID_14'])) { $XMLQuestionResult['valDocCID_14'] = ""; }    
    if (!isset($XMLQuestionResult['valDocCID_15'])) { $XMLQuestionResult['valDocCID_15'] = ""; }    
    if (!isset($XMLQuestionResult['valDocCID_16'])) { $XMLQuestionResult['valDocCID_16'] = ""; }    
    if (!isset($XMLQuestionResult['valDocCID_17'])) { $XMLQuestionResult['valDocCID_17'] = ""; }    
    if (!isset($XMLQuestionResult['valDocCID_18'])) { $XMLQuestionResult['valDocCID_18'] = ""; }    
    if (!isset($XMLQuestionResult['valDocCID_19'])) { $XMLQuestionResult['valDocCID_19'] = ""; }    
    if (!isset($XMLQuestionResult['valDocCID_20'])) { $XMLQuestionResult['valDocCID_20'] = ""; }    
    if (!isset($XMLQuestionResult['valDocCID_21'])) { $XMLQuestionResult['valDocCID_21'] = ""; }    
    if (!isset($XMLQuestionResult['valDocCID_22'])) { $XMLQuestionResult['valDocCID_22'] = ""; }    
    if (!isset($XMLQuestionResult['valDocCID_23'])) { $XMLQuestionResult['valDocCID_23'] = ""; }
    if (!isset($XMLQuestionResult['valDocCID_24'])) { $XMLQuestionResult['valDocCID_24'] = ""; }
    
    if (!isset($XMLQuestionResult['valDocConmutacion_1'])) { $XMLQuestionResult['valDocConmutacion_1'] = ""; }
    if (!isset($XMLQuestionResult['valDocConmutacion_2'])) { $XMLQuestionResult['valDocConmutacion_2'] = ""; }
    if (!isset($XMLQuestionResult['valDocConmutacion_3'])) { $XMLQuestionResult['valDocConmutacion_3'] = ""; }
    if (!isset($XMLQuestionResult['valDocConmutacion_4'])) { $XMLQuestionResult['valDocConmutacion_4'] = ""; }
    if (!isset($XMLQuestionResult['valDocConmutacion_5'])) { $XMLQuestionResult['valDocConmutacion_5'] = ""; }
    if (!isset($XMLQuestionResult['valDocConmutacion_6'])) { $XMLQuestionResult['valDocConmutacion_6'] = ""; }
    if (!isset($XMLQuestionResult['valDocConmutacion_7'])) { $XMLQuestionResult['valDocConmutacion_7'] = ""; }
    if (!isset($XMLQuestionResult['valDocConmutacion_8'])) { $XMLQuestionResult['valDocConmutacion_8'] = ""; }
    if (!isset($XMLQuestionResult['valDocConmutacion_9'])) { $XMLQuestionResult['valDocConmutacion_9'] = ""; }
    if (!isset($XMLQuestionResult['valDocConmutacion_10'])) { $XMLQuestionResult['valDocConmutacion_10'] = ""; }
    if (!isset($XMLQuestionResult['valDocConmutacion_11'])) { $XMLQuestionResult['valDocConmutacion_11'] = ""; }    
    if (!isset($XMLQuestionResult['valDocConmutacion_12'])) { $XMLQuestionResult['valDocConmutacion_12'] = ""; }    
    if (!isset($XMLQuestionResult['valDocConmutacion_13'])) { $XMLQuestionResult['valDocConmutacion_13'] = ""; }    
    if (!isset($XMLQuestionResult['valDocConmutacion_14'])) { $XMLQuestionResult['valDocConmutacion_14'] = ""; }    
    if (!isset($XMLQuestionResult['valDocConmutacion_15'])) { $XMLQuestionResult['valDocConmutacion_15'] = ""; }    
    if (!isset($XMLQuestionResult['valDocConmutacion_16'])) { $XMLQuestionResult['valDocConmutacion_16'] = ""; }    
    if (!isset($XMLQuestionResult['valDocConmutacion_17'])) { $XMLQuestionResult['valDocConmutacion_17'] = ""; }    
    if (!isset($XMLQuestionResult['valDocConmutacion_18'])) { $XMLQuestionResult['valDocConmutacion_18'] = ""; }    
    if (!isset($XMLQuestionResult['valDocConmutacion_19'])) { $XMLQuestionResult['valDocConmutacion_19'] = ""; }    
    if (!isset($XMLQuestionResult['valDocConmutacion_20'])) { $XMLQuestionResult['valDocConmutacion_20'] = ""; } 
    
    if (!isset($XMLQuestionResult['commercialVisit_1'])) { $XMLQuestionResult['commercialVisit_1'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_2'])) { $XMLQuestionResult['commercialVisit_2'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_3'])) { $XMLQuestionResult['commercialVisit_3'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_4'])) { $XMLQuestionResult['commercialVisit_4'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_5'])) { $XMLQuestionResult['commercialVisit_5'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_6'])) { $XMLQuestionResult['commercialVisit_6'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_7'])) { $XMLQuestionResult['commercialVisit_7'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_8'])) { $XMLQuestionResult['commercialVisit_8'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_9'])) { $XMLQuestionResult['commercialVisit_9'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_10'])) { $XMLQuestionResult['commercialVisit_10'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_11'])) { $XMLQuestionResult['commercialVisit_11'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_12'])) { $XMLQuestionResult['commercialVisit_12'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_13'])) { $XMLQuestionResult['commercialVisit_13'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_14'])) { $XMLQuestionResult['commercialVisit_14'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisit_15'])) { $XMLQuestionResult['commercialVisit_15'] = ""; }
    if (!isset($XMLQuestionResult['commercialVisit_16'])) { $XMLQuestionResult['commercialVisit_16'] = ""; }
    if (!isset($XMLQuestionResult['commercialVisit_17'])) { $XMLQuestionResult['commercialVisit_17'] = ""; }

    if (!isset($XMLQuestionResult['commercialVisitCity_1'])) { $XMLQuestionResult['commercialVisitCity_1'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisitCity_2'])) { $XMLQuestionResult['commercialVisitCity_2'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisitCity_3'])) { $XMLQuestionResult['commercialVisitCity_3'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisitCity_4'])) { $XMLQuestionResult['commercialVisitCity_4'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisitCity_5'])) { $XMLQuestionResult['commercialVisitCity_5'] = ""; } 

    if (!isset($XMLQuestionResult['commercialVisitCityLoc_1'])) { $XMLQuestionResult['commercialVisitCityLoc_1'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisitCityLoc_2'])) { $XMLQuestionResult['commercialVisitCityLoc_2'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisitCityLoc_3'])) { $XMLQuestionResult['commercialVisitCityLoc_3'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisitCityLoc_4'])) { $XMLQuestionResult['commercialVisitCityLoc_4'] = ""; } 
    if (!isset($XMLQuestionResult['commercialVisitCityLoc_5'])) { $XMLQuestionResult['commercialVisitCityLoc_5'] = ""; } 
    
    
    if (!isset($XMLQuestionResult['adicionalClaro_1'])) { $XMLQuestionResult['adicionalClaro_1'] = ""; } 
    if (!isset($XMLQuestionResult['adicionalClaro_2'])) { $XMLQuestionResult['adicionalClaro_2'] = ""; } 
    if (!isset($XMLQuestionResult['adicionalClaro_3'])) { $XMLQuestionResult['adicionalClaro_3'] = ""; } 
    if (!isset($XMLQuestionResult['adicionalClaro_4'])) { $XMLQuestionResult['adicionalClaro_4'] = ""; } 
    if (!isset($XMLQuestionResult['adicionalClaro_5'])) { $XMLQuestionResult['adicionalClaro_5'] = ""; } 
    if (!isset($XMLQuestionResult['adicionalClaro_6'])) { $XMLQuestionResult['adicionalClaro_6'] = ""; } 
    if (!isset($XMLQuestionResult['adicionalClaro_7'])) { $XMLQuestionResult['adicionalClaro_7'] = ""; } 
    if (!isset($XMLQuestionResult['adicionalClaro_8'])) { $XMLQuestionResult['adicionalClaro_8'] = ""; } 
    if (!isset($XMLQuestionResult['adicionalClaro_9'])) { $XMLQuestionResult['adicionalClaro_9'] = ""; } 
    if (!isset($XMLQuestionResult['adicionalClaro_10'])) { $XMLQuestionResult['adicionalClaro_10'] = ""; } 
    if (!isset($XMLQuestionResult['adicionalClaro_end'])) { $XMLQuestionResult['adicionalClaro_end'] = ""; } 
    
    if (!isset($XMLQuestionResult['adicionalClaro_1_comment'])) { $XMLQuestionResult['adicionalClaro_1_comment'] = ""; } 
    if (!isset($XMLQuestionResult['adicionalClaro_2_comment'])) { $XMLQuestionResult['adicionalClaro_2_comment'] = ""; } 
    if (!isset($XMLQuestionResult['adicionalClaro_3_comment'])) { $XMLQuestionResult['adicionalClaro_3_comment'] = ""; } 
    if (!isset($XMLQuestionResult['adicionalClaro_5_comment'])) { $XMLQuestionResult['adicionalClaro_5_comment'] = ""; } 
    
    if (!isset($XMLQuestionResult['listaResctrictiva_1'])) { $XMLQuestionResult['listaResctrictiva_1'] = ""; } 
    if (!isset($XMLQuestionResult['listaResctrictiva_2'])) { $XMLQuestionResult['listaResctrictiva_2'] = ""; } 
    if (!isset($XMLQuestionResult['listaResctrictiva_3'])) { $XMLQuestionResult['listaResctrictiva_3'] = ""; } 
    if (!isset($XMLQuestionResult['listaResctrictiva_4'])) { $XMLQuestionResult['listaResctrictiva_4'] = ""; } 
    if (!isset($XMLQuestionResult['listaResctrictiva_5'])) { $XMLQuestionResult['listaResctrictiva_5'] = ""; } 
    if (!isset($XMLQuestionResult['listaResctrictiva_6'])) { $XMLQuestionResult['listaResctrictiva_6'] = ""; } 
    if (!isset($XMLQuestionResult['listaResctrictiva_7'])) { $XMLQuestionResult['listaResctrictiva_7'] = ""; } 
    if (!isset($XMLQuestionResult['listaResctrictiva_8'])) { $XMLQuestionResult['listaResctrictiva_8'] = ""; } 
    if (!isset($XMLQuestionResult['listaResctrictiva_9'])) { $XMLQuestionResult['listaResctrictiva_9'] = ""; } 
    if (!isset($XMLQuestionResult['listaResctrictiva_10'])) { $XMLQuestionResult['listaResctrictiva_10'] = ""; } 


    if (!isset($XMLQuestionResult['comercioInt_1'])) { $XMLQuestionResult['comercioInt_1'] = ""; } 
    if (!isset($XMLQuestionResult['comercioInt_2'])) { $XMLQuestionResult['comercioInt_2'] = ""; } 
    if (!isset($XMLQuestionResult['comercioInt_3'])) { $XMLQuestionResult['comercioInt_3'] = ""; } 
    
    if (!isset($XMLQuestionResult['gcBasesDatos'])) { $XMLQuestionResult['gcBasesDatos'] = ""; } 
    if (!isset($XMLQuestionResult['gcEvaluacionPeriodica'])) { $XMLQuestionResult['gcEvaluacionPeriodica'] = ""; } 
    if (!isset($XMLQuestionResult['gcEjecutivoCuenta'])) { $XMLQuestionResult['gcEjecutivoCuenta'] = ""; } 
    if (!isset($XMLQuestionResult['gcSedeAtencionCliente'])) { $XMLQuestionResult['gcSedeAtencionCliente'] = ""; } 
    if (!isset($XMLQuestionResult['gcPostVenta'])) { $XMLQuestionResult['gcPostVenta'] = ""; } 
    if (!isset($XMLQuestionResult['gcGarantias'])) { $XMLQuestionResult['gcGarantias'] = ""; } 
    if (!isset($XMLQuestionResult['gcServicioTecnico'])) { $XMLQuestionResult['gcServicioTecnico'] = ""; } 
    if (!isset($XMLQuestionResult['gcPolizaSeguro'])) { $XMLQuestionResult['gcPolizaSeguro'] = ""; } 


    if (!isset($XMLQuestionResult['sectionImpact_1'])) { $XMLQuestionResult['sectionImpact_1'] = ""; } 
    if (!isset($XMLQuestionResult['sectionImpact_2'])) { $XMLQuestionResult['sectionImpact_2'] = ""; } 
    if (!isset($XMLQuestionResult['sectionImpact_3'])) { $XMLQuestionResult['sectionImpact_3'] = ""; } 
    if (!isset($XMLQuestionResult['sectionImpact_4'])) { $XMLQuestionResult['sectionImpact_4'] = ""; } 
    if (!isset($XMLQuestionResult['sectionImpact_5'])) { $XMLQuestionResult['sectionImpact_5'] = ""; } 
    if (!isset($XMLQuestionResult['sectionImpact_6'])) { $XMLQuestionResult['sectionImpact_6'] = ""; } 
    if (!isset($XMLQuestionResult['sectionImpact_7'])) { $XMLQuestionResult['sectionImpact_7'] = ""; } 
    if (!isset($XMLQuestionResult['sectionImpact_8'])) { $XMLQuestionResult['sectionImpact_8'] = ""; } 
    if (!isset($XMLQuestionResult['sectionImpact_9'])) { $XMLQuestionResult['sectionImpact_9'] = ""; }


    if (!isset($XMLQuestionResult['Pol_Calidad'])) { $XMLQuestionResult['Pol_Calidad'] = ""; }
    if (!isset($XMLQuestionResult['Politica_1'])) { $XMLQuestionResult['Politica_1'] = ""; }
    if (!isset($XMLQuestionResult['Politica_2'])) { $XMLQuestionResult['Politica_2'] = ""; }
    if (!isset($XMLQuestionResult['Politica_3'])) { $XMLQuestionResult['Politica_3'] = ""; }
    if (!isset($XMLQuestionResult['Politica_4'])) { $XMLQuestionResult['Politica_4'] = ""; }
    if (!isset($XMLQuestionResult['Politica_5'])) { $XMLQuestionResult['Politica_5'] = ""; }
    if (!isset($XMLQuestionResult['Politica_6'])) { $XMLQuestionResult['Politica_6'] = ""; }
    if (!isset($XMLQuestionResult['Politica_7'])) { $XMLQuestionResult['Politica_7'] = ""; }
    if (!isset($XMLQuestionResult['Politica_8'])) { $XMLQuestionResult['Politica_8'] = ""; }

    if (!isset($XMLQuestionResult['Tipoasociado_1'])) { $XMLQuestionResult['Tipoasociado_1'] = ""; }
    if (!isset($XMLQuestionResult['Tipoasociado_2'])) { $XMLQuestionResult['Tipoasociado_2'] = ""; }
    if (!isset($XMLQuestionResult['AccesoInfor_1'])) { $XMLQuestionResult['AccesoInfor_1'] = ""; }
    if (!isset($XMLQuestionResult['AccesoInfor_2'])) { $XMLQuestionResult['AccesoInfor_2'] = ""; }
    if (!isset($XMLQuestionResult['Trayectoria_1'])) { $XMLQuestionResult['Trayectoria_1'] = ""; }
    if (!isset($XMLQuestionResult['Experiencia_1'])) { $XMLQuestionResult['Experiencia_1'] = ""; }
    if (!isset($XMLQuestionResult['Certificaciones_1'])) { $XMLQuestionResult['Certificaciones_1'] = ""; }
    if (!isset($XMLQuestionResult['Certificaciones_2'])) { $XMLQuestionResult['Certificaciones_2'] = ""; }

    // HALLAZGO EN LISTA DE EMPRESA
    if(
        ($XMLQuestionResult['OfacYOnu'] == "NO" || $XMLQuestionResult['OfacYOnu'] == "N/A") &&
        ($XMLQuestionResult['Boe'] == "NO" || $XMLQuestionResult['Boe'] == "N/A") &&
        ($XMLQuestionResult['entControl'] == "NO" || $XMLQuestionResult['entControl'] == "N/A") &&
        ($XMLQuestionResult['entPoliciales'] == "NO" || $XMLQuestionResult['entPoliciales'] == "N/A") &&
        ($XMLQuestionResult['otrosBoletines'] == "NO" || $XMLQuestionResult['otrosBoletines'] == "N/A") &&
        ($XMLQuestionResult['empresasFicticias'] == "NO" || $XMLQuestionResult['empresasFicticias'] == "N/A") &&
        ($XMLQuestionResult['paraisosFiscales'] == "NO" || $XMLQuestionResult['paraisosFiscales'] == "N/A") &&
        ($XMLQuestionResult['boletinesDeudoresMorosos'] == "NO" || $XMLQuestionResult['boletinesDeudoresMorosos'] == "N/A") &&
        ($XMLQuestionResult['registrosRamaJudicial'] == "NO" || $XMLQuestionResult['registrosRamaJudicial'] == "N/A") &&
        ($XMLQuestionResult['demandas'] == "NO" || $XMLQuestionResult['demandas'] == "N/A" )
    ){
        $listasEmpresasResult = "SH";
    } else {
        $listasEmpresasResult = "CH";
    }
    
    // SIN DEUDORES
    if(
        ($XMLQuestionResult['OfacYOnu'] == "NO" || $XMLQuestionResult['OfacYOnu'] == "N/A" ) &&
        ($XMLQuestionResult['Boe'] == "NO" || $XMLQuestionResult['Boe'] == "N/A" ) &&
        ($XMLQuestionResult['entControl'] == "NO" || $XMLQuestionResult['entControl'] == "N/A" ) &&
        ($XMLQuestionResult['entPoliciales'] == "NO" || $XMLQuestionResult['entPoliciales'] == "N/A" ) &&
        ($XMLQuestionResult['otrosBoletines'] == "NO" || $XMLQuestionResult['otrosBoletines'] == "N/A" ) &&
        ($XMLQuestionResult['empresasFicticias'] == "NO" || $XMLQuestionResult['empresasFicticias'] == "N/A" ) &&
        ($XMLQuestionResult['paraisosFiscales'] == "NO" || $XMLQuestionResult['paraisosFiscales'] == "N/A" ) &&
        ($XMLQuestionResult['registrosRamaJudicial'] == "NO" || $XMLQuestionResult['registrosRamaJudicial'] == "N/A" ) &&
        ($XMLQuestionResult['demandas'] == "NO" || $XMLQuestionResult['demandas'] == "N/A") 
    ){
        $listasEmpresasResult_SM = "SH";
    } else {
        $listasEmpresasResult_SM = "CH";
    }



    
    // HALLAZGO EN LISTA DE SOCIOS
    $listasSociosResult = "";
    $shareholdersSection = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER);
    if (isset($shareholdersSection)) {
        $listasSociosResult = "SH";
        $bdmResult = "SH";
        foreach ($shareholdersSection->detailShareholder as $shareholder) {
            if(
                ($shareholder->appearsInClintonsList == 0 || $shareholder->appearsInClintonsList == 2) &&
                ($shareholder->hasAdverseReference == 0 || $shareholder->hasAdverseReference == 2) &&
                ($shareholder->OfacYOnu == 0 || $shareholder->OfacYOnu == 2) &&
                ($shareholder->Boe == 0 || $shareholder->Boe == 2) &&
                ($shareholder->entControl == 0 || $shareholder->entControl == 2) &&
                ($shareholder->entPoliciales == 0 || $shareholder->entPoliciales == 2) &&
                ($shareholder->otrosBoletines == 0 || $shareholder->otrosBoletines == 2) &&
                ($shareholder->empresasFicticias == 0 || $shareholder->empresasFicticias == 2) &&
                $listasSociosResult == "SH"
                
            ){
                $listasSociosResult = "SH";
                
            } else {
                $listasSociosResult = "CH";
                
            }

            if(
                $shareholder->bDeudoresMorosos == 0 &&
                $bdmResult == "SH"
            ){
                $bdmResult = "SH";
                
            } else {
                $bdmResult = "CH";
                
            }
        }
    }
    
    // RESULTADO DE LISTAS DE SOCIOS Y EMPRESAS
    if ($listasEmpresasResult == "SH" && $listasSociosResult == "SH"){
        $listasResult = "SH";
    } else {
        $listasResult = "CH";
    }

    $commercialVisitCityLocTotal= $XMLQuestionResult['commercialVisitCityLoc_1'] + $XMLQuestionResult['commercialVisitCityLoc_2'] +$XMLQuestionResult['commercialVisitCityLoc_3'] + $XMLQuestionResult['commercialVisitCityLoc_4'] + $XMLQuestionResult['commercialVisitCityLoc_5'];

    // RESULTADO DE LA EVALUACIÓN
    $resultString = "CLASIFICA / BUENO";
    $resultValueString = 100;

    // GUARDAR RESULTADO DE LA EVALUACIÓN
    $evaluationValue = $resultValueString;
    $query = "UPDATE ses_BackgroundCheck SET evaluationResult='".$resultString."', evaluationValue='".$resultValueString."' WHERE  id=".$backgroundCheck->id.";";
    Yii::app()->db->createCommand($query)->execute();

    if (is_numeric($resultValueString)) {
        $resultValueString = $resultValueString . "%";
    }

    // TIPO  DE SOCIEDAD
    if ($backgroundCheck->shareholderType == 0)
        $shareholderType = "Privada";
    else if ($backgroundCheck->shareholderType == 1)
        $shareholderType = "Pública";
    else if ($backgroundCheck->shareholderType == 2)
        $shareholderType = "Mixta";

    
    $resultAntiguedad = "SH";
    $resultFinanciero = "CH";
    $resultCalidad = "SH";
    $resultSgsst = "CH";
    $resultCompras = "SH";
    $resultServicios = "CH";
    $resultReferencias = "SH";
    $resultProveedores = "SH";
    $resultRrhh = "CH";
    $resultInfraestructura = "CH";
    $resultCobertura = "SH";
    $resultLegal = "CH";

    
    

    if (isset($sectionCompanyFinance)) {
        if ($sectionCompanyFinance->valorTotal_0 != "" && $sectionCompanyFinance->valorTotal_0 != 0) { $valorTotal_0 = number_format($sectionCompanyFinance->valorTotal_0, 2, ",", "."); } else { $valorTotal_0 = ""; }
        if ($sectionCompanyFinance->valorMora_0 != "" && $sectionCompanyFinance->valorMora_0 != 0) { $valorMora_0 = number_format($sectionCompanyFinance->valorMora_0, 2, ",", "."); } else { $valorMora_0 = ""; }
        if ($sectionCompanyFinance->valorTotal_30 != "" && $sectionCompanyFinance->valorTotal_30 != 0) { $valorTotal_30 = number_format($sectionCompanyFinance->valorTotal_30, 2, ",", "."); } else { $valorTotal_30 = ""; }
        if ($sectionCompanyFinance->valorMora_30 != "" && $sectionCompanyFinance->valorMora_30 != 0) { $valorMora_30 = number_format($sectionCompanyFinance->valorMora_30, 2, ",", "."); } else { $valorMora_30 = ""; }
        if ($sectionCompanyFinance->valorTotal_60 != "" && $sectionCompanyFinance->valorTotal_60 != 0) { $valorTotal_60 = number_format($sectionCompanyFinance->valorTotal_60, 2, ",", "."); } else { $valorTotal_60 = ""; }
        if ($sectionCompanyFinance->valorMora_60 != "" && $sectionCompanyFinance->valorMora_60 != 0) { $valorMora_60 = number_format($sectionCompanyFinance->valorMora_60, 2, ",", "."); } else { $valorMora_60 = ""; }
        if ($sectionCompanyFinance->valorTotal_90 != "" && $sectionCompanyFinance->valorTotal_90 != 0) { $valorTotal_90 = number_format($sectionCompanyFinance->valorTotal_90, 2, ",", "."); } else { $valorTotal_90 = ""; }
        if ($sectionCompanyFinance->valorMora_90 != "" && $sectionCompanyFinance->valorMora_90 != 0) { $valorMora_90 = number_format($sectionCompanyFinance->valorMora_90, 2, ",", "."); } else { $valorMora_90 = ""; }
        if ($sectionCompanyFinance->valorTotal_120 != "" && $sectionCompanyFinance->valorTotal_120 != 0) { $valorTotal_120 = number_format($sectionCompanyFinance->valorTotal_120, 2, ",", "."); } else { $valorTotal_120 = ""; }
        if ($sectionCompanyFinance->valorMora_120 != "" && $sectionCompanyFinance->valorMora_120 != 0) { $valorMora_120 = number_format($sectionCompanyFinance->valorMora_120, 2, ",", "."); } else { $valorMora_120 = ""; }
        if ($sectionCompanyFinance->valorTotal_more120 != "" && $sectionCompanyFinance->valorTotal_more120 != 0) { $valorTotal_more120 = number_format($sectionCompanyFinance->valorTotal_more120, 2, ",", "."); } else { $valorTotal_more120 = ""; }
        if ($sectionCompanyFinance->valorMora_more120 != "" && $sectionCompanyFinance->valorMora_more120 != 0) { $valorMora_more120 = number_format($sectionCompanyFinance->valorMora_more120, 2, ",", "."); } else { $valorMora_more120 = ""; }
        if ($sectionCompanyFinance->valorTotal_more120 != "" && $sectionCompanyFinance->valorTotal_more120 != 0) { $valorTotal_more120 = number_format($sectionCompanyFinance->valorTotal_more120, 2, ",", "."); } else { $valorTotal_more120 = ""; }
        if ($sectionCompanyFinance->valorMora_more120 != "" && $sectionCompanyFinance->valorMora_more120 != 0) { $valorMora_more120 = number_format($sectionCompanyFinance->valorMora_more120, 2, ",", "."); } else { $valorMora_more120 = ""; }
        if ($sectionCompanyFinance->valorTotal_castigada != "" && $sectionCompanyFinance->valorTotal_castigada != 0) { $valorTotal_castigada = number_format($sectionCompanyFinance->valorTotal_castigada, 2, ",", "."); } else { $valorTotal_castigada = ""; }
        if ($sectionCompanyFinance->valorMora_castigada != "" && $sectionCompanyFinance->valorMora_castigada != 0) { $valorMora_castigada = number_format($sectionCompanyFinance->valorMora_castigada, 2, ",", "."); } else { $valorMora_castigada = ""; }
    };


    // REFERENCIAS DE SOCIOS
    if(isset($sectionCompanyCustomer)){
        $i = 0;
        $j = 0;
        $k = 0;
        $l = 0;
        $deliveryCompliance = 0;
        $productsQuality = 0;
        $postSalesService = 0;
        $prices = 0;
        $clienteQualification = array(
            0 => "N/A",
            1 => "MALO",
            2 => "REGULAR",
            3 => "BUENO",
            4 => "MUY BUENO",
            5 => "EXCELENTE",
        );
        /*
        foreach ($sectionCompanyCustomer as $customer) {
            $deliveryCompliance = $deliveryCompliance + $customer->deliveryCompliance;
            $productsQuality = $productsQuality + $customer->productsQuality;
            $postSalesService = $postSalesService + $customer->postSalesService;
            $prices = $prices + $customer->prices;
            $i++;
        }
        if($i > 0){
            $deliveryCompliance = round( $deliveryCompliance / $i ) ;
            $productsQuality = round( $productsQuality / $i ) ;
            $postSalesService = round( $postSalesService / $i ) ;
            $prices = round( $prices / $i ) ;
            // echo $clienteQualification[$deliveryCompliance]; die;
            // echo $productsQuality; die;
        }
    }
        */
        foreach ($sectionCompanyCustomer as $customer) {
            if ($customer->deliveryCompliance != 0) {
                $i++;
                $deliveryCompliance = $deliveryCompliance + $customer->deliveryCompliance;
            }
            if($customer->productsQuality != 0){
                $j++;
                $productsQuality = $productsQuality + $customer->productsQuality;
            }

            if($customer->postSalesService != 0){
                $k++;
                $postSalesService = $postSalesService + $customer->postSalesService;
            }

            if($customer->prices != 0){
                $l++;
                $prices = $prices + $customer->prices;
            }


        }

        if($i > 0) {
            $deliveryCompliance = round($deliveryCompliance / $i);
        }

        if($j > 0) {
            $productsQuality = round( $productsQuality / $i ) ;
        }

        if($k > 0) {
            $postSalesService = round( $postSalesService / $i ) ;
        }
        if($l > 0) {
            $prices = round( $prices / $i ) ;
        }


    }
