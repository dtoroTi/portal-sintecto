<?php
        include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/prodecoNacPlusPond2.php');

                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(170, 0, "RESUMEN DE EVALUACIÓN"  , 0, 'C', 1, 1, '', '', true);
                $pdf->SetTextColor(0,0,0);
                $pdf->Cell('', '', '', '', 1, 'L');

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(50, 0, '' , 0, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(70, 0, "EVALUACIÓN FINAL PLUS"  , 1, 'C', 1, 0, '', '', true);
                $pdf->Cell('', '', '', '', 1, 'L');
                $pdf->SetTextColor(0,0,0);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->MultiCell(50, 0, '' , 0, 'L', 0, 0, '', '', true);

                if ($resultString == "APTO") {
                    $pdf->SetTextColor(0,152,0);
                } else {
                    $pdf->SetTextColor(255,0,0);
                };

                $pdf->MultiCell(70, 0, $resultString , 1, 'C', 0, 0, '', '', true);
                $pdf->Cell('', '', '', '', 1, 'L');
                $pdf->MultiCell(50, 0, '' , 0, 'L', 0, 0, '', '', true);
                $pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(70, 0, $evalResulCal . "%" , 1, 'C', 0, 0, '', '', true);
                $pdf->Cell('', '', '', '', 1, 'L');
                $pdf->Cell('', '', '', '', 1, 'L');


                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(34, 0, "ANTIGÜEDAD"  , 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, "ACTIVOS"  , 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, "CALIDAD"  , 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, "REFERENCIAS"  , 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, "CIFIN"  , 1, 'C', 1, 0, '', '', true);
                $pdf->Cell('', '', '', '', 1, 'L');

                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0,0,0);


                $pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(34, 0, $yearsOfActivityCal . "%", 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, $companySizeByActivesCal . "%", 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, $Pol_CalCalidad . "%", 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, $referenciaCal . "%", 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, $refCIFINCal . "%", 1, 'C', 1, 0, '', '', true);
                $pdf->Cell('', '', '', '', 1, 'L');
                $pdf->Cell('', '', '', '', 1, 'L');

                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(34, 0, "FINANCIERA"  , 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, "LABORAL"  , 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, "SEGURIDAD"  , 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, "ASPECTOS -"  , 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, "ASPECTOS +"  , 1, 'C', 1, 0, '', '', true);
                $pdf->Cell('', '', '', '', 1, 'L');

                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0,0,0);


                $pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(34, 0, $financieraCal . "%", 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, $laboralCal . "%", 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, $PoliticaCal . "%", 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, $plusNacNegProdecoCal . "%", 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(34, 0, $plusNacPosProdecoCal . "%", 1, 'C', 1, 0, '', '', true);


                $pdf->Cell('', '', '', '', 1, 'L');
                $pdf->Cell('', '', '', '', 1, 'L');

                // RESUMEN LAFT Y SOCIOS
                include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/_pdfProdecoResumenLAFT.php');

                // Plan de Seguridad Vial

           // $pdf->Cell('', '', '', '', 1, 'L');
            $pdf->Cell('', '', '', '', 1, 'L');
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->MultiCell(170, 0, "PLAN DE SEGURIDAD VIAL"  , 0, 'C', 1, 1, '', '', true);
            $pdf->SetTextColor(0,0,0);
           // $pdf->Cell('', '', '', '', 1, 'L');

            $pdf->SetTextColor(0); $pdf->SetFillColor(220);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->MultiCell(120, 0, "Cuenta con plan de seguridad Vial"  , 1, 'L', 1, 0, '', '', true);
            $pdf->SetFont('Arial', 'B', 10);

        if (isset($XMLQuestionResult['SecurtyVial'])) {
            if ($XMLQuestionResult['SecurtyVial'] == "SI" || $XMLQuestionResult['SecurtyVial'] == "N/A") {
                $pdf->SetTextColor(0, 152, 0);
            } else {
                $pdf->SetTextColor(255, 0, 0);
            };
            $pdf->MultiCell(50, 5, $XMLQuestionResult['SecurtyVial'], 1, 'C', 0, 1, '', '', true);
        }
            // OEA

            $pdf->Cell('', '', '', '', 1, 'L');
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetFillColor(0,66,109);
            $pdf->SetTextColor(255,255,255);
            $pdf->MultiCell(35, 0, '' , 0, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(100, 0, "OPERADOR ECONOMICO AUTORIZADO (OEA)"  , 0, 'C', 1, 1, '', '', true);
            $pdf->SetTextColor(0,0,0);
            // $pdf->Cell('', '', '', '', 1, 'L');
            if(isset($resultOEAScore)){
                if($resultOEAScore =='BAJO'){
                    $pdf->MultiCell(35, 0, '' , 0, 'L', 0, 0, '', '', true);
                    $pdf->SetFillColor(23,184,84);
                    $pdf->MultiCell(100, 5, $resultOEAScore , 1, 'C', 1, 1, '', '', true);
                    $pdf->MultiCell(35, 0, '' , 0, 'L', 0, 0, '', '', true);
                    $pdf->MultiCell(100, 5, $TotalScore. ' Puntos' , 1, 'C', 0, 1, '', '', true);
                }elseif ($resultOEAScore =='MEDIO'){
                    $pdf->MultiCell(35, 0, '' , 0, 'L', 0, 0, '', '', true);
                    $pdf->SetFillColor(210,213,24);
                    $pdf->MultiCell(100, 5, $resultOEAScore , 1, 'C', 1, 1, '', '', true);
                    $pdf->MultiCell(35, 0, '' , 0, 'L', 0, 0, '', '', true);
                    $pdf->MultiCell(100, 5, $TotalScore. ' Puntos' , 1, 'C', 0, 1, '', '', true);

                }elseif ($resultOEAScore =='ALTO'){
                    $pdf->MultiCell(35, 0, '' , 0, 'L', 0, 0, '', '', true);
                    $pdf->SetFillColor(255,0,0);
                    $pdf->MultiCell(100, 5, $resultOEAScore , 1, 'C', 1, 1, '', '', true);
                    $pdf->MultiCell(35, 0, '' , 0, 'L', 0, 0, '', '', true);
                    $pdf->MultiCell(100, 5, $TotalScore. ' Puntos' , 1, 'C', 0, 1, '', '', true);

                }
            }


                // AGREGAR BÁSICO NACIONAL
                // if ($resultString == 'NO APTO') {
                $pdf->AddPage();
                $pdf->SetY(30);
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(170, 0, "EVALUACIÓN BÁSICA NACIONAL"  , 1, 'C', 1, 1, '', '', true);
                $pdf->Cell('', '', '', '', 1, 'L');

                $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(170, 5, "Análisis de la calificación" , 1, 'L', 1, 1, '', '', true);
                $pdf->MultiCell(170, 5, "La compañía muestra los siguientes resultados de acuerdo a los criterios de evaluación detallados a continuación" , 1, 'L', 1, 1, '', '', true);

                $pdf->SetFillColor(150,150,150);
                $pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(170, 5, "Items de calificación" , 1, 'L', 1, 1, '', '', true);

                $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(170, 5, "1. Información general" , 1, 'L', 1, 1, '', '', true);
                $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(120, 5, "1.1 ¿Cuenta con documento de identidad del representante legal?" , 1, 'L', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                if ($XMLQuestionResult['proveedorNacionalBasic_1'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_1'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
                $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_1'] , 1, 'C', 0, 1, '', '', true);
                $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(120, 5, "1.2 ¿La sociedad se encuentra vigente?" , 1, 'L', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                if ($XMLQuestionResult['proveedorNacionalBasic_2'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_2'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
                $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_2'] , 1, 'C', 0, 1, '', '', true);
                //2
                $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(170, 5, "2. Aspectos legales" , 1, 'L', 1, 1, '', '', true);
                $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(120, 5, "2.1 ¿Cuenta con certificado de existencia y representación legal?" , 1, 'L', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                if ($XMLQuestionResult['proveedorNacionalBasic_3'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_3'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
                $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_3'] , 1, 'C', 0, 1, '', '', true);
                $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(120, 5, "2.2 ¿Cuenta con RUT?" , 1, 'L', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                if ($XMLQuestionResult['proveedorNacionalBasic_4'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_4'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
                $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_4'] , 1, 'C', 0, 1, '', '', true);
                $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(120, 5, "2.3 ¿Cuenta con certificación bancaria no mayor a 30 dias?" , 1, 'L', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                if ($XMLQuestionResult['proveedorNacionalBasic_5'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_5'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
                $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_5'] , 1, 'C', 0, 1, '', '', true);
                //3
                $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(170, 5, "3. Formatos G.Prodeco" , 1, 'L', 1, 1, '', '', true);
                $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(120, 5, "3.1 ¿Cuenta con autorización para el tratamiento de datos personales?" , 1, 'L', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                if ($XMLQuestionResult['proveedorNacionalBasic_6'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_6'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
                $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_6'] , 1, 'C', 0, 1, '', '', true);
                $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(120, 5, "3.2 ¿Cuenta con carta de aceptación de términos y condiciones?" , 1, 'L', 1, 0, '', '', true);
                $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
                $pdf->SetFillColor(255,255,255);
                if ($XMLQuestionResult['proveedorNacionalBasic_7'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_7'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
                $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_7'] , 1, 'C', 0, 1, '', '', true);
                $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(120, 5, "3.3 ¿Cuenta con carta certificación de origen de recursos - SARLAFT?" , 1, 'L', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                if ($XMLQuestionResult['proveedorNacionalBasic_8'] == "Si Cumple" || $XMLQuestionResult['proveedorNacionalBasic_8'] == "N/A") { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
                $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_8'] , 1, 'C', 0, 1, '', '', true);

                $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(170, 5, "4. Validación en Listas Restrictivas" , 1, 'L', 1, 1, '', '', true);
                $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(120, 5, "4.1 ¿Presenta coincidencia?" , 1, 'L', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                if ($XMLQuestionResult['proveedorNacionalBasic_9'] == "No presenta coincidencia" && $listasEmpresasResult_SM == "SH") {
                    $pdf->SetTextColor(0,152,0);
                    $XMLQuestionResult['proveedorNacionalBasic_9'] = "No presenta coincidencia";
                    $proveedorNacionalBasic_9 = "No presenta coincidencia";
                } else {
                    $pdf->SetTextColor(255,0,0);
                    $XMLQuestionResult['proveedorNacionalBasic_9'] = "Presenta coincidencia";
                    $proveedorNacionalBasic_9 =  "Presenta coincidencia";
                };

                $pdf->MultiCell(50, 5, $XMLQuestionResult['proveedorNacionalBasic_9'] , 1, 'C', 0, 1, '', '', true);
                $pdf->MultiCell(170, 5, " " , 0, 'L', 0, 1, '', '', true);

                $pdf->SetFillColor(0,66,109);
                $pdf->SetTextColor(255,255,255);
                $pdf->MultiCell(120, 5, "Resultado Obtenido Básico" , 1, 'C', 1, 0, '', '', true);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0,0,0);

                if (
                    ($XMLQuestionResult['proveedorNacionalBasic_1'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_1'] == 'N/A') &&
                    ($XMLQuestionResult['proveedorNacionalBasic_2'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_2'] == 'N/A') &&
                    ($XMLQuestionResult['proveedorNacionalBasic_3'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_3'] == 'N/A') &&
                    ($XMLQuestionResult['proveedorNacionalBasic_4'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_4'] == 'N/A') &&
                    ($XMLQuestionResult['proveedorNacionalBasic_5'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_5'] == 'N/A') &&
                    ($XMLQuestionResult['proveedorNacionalBasic_6'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_6'] == 'N/A') &&
                    ($XMLQuestionResult['proveedorNacionalBasic_7'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_7'] == 'N/A') &&
                    ($XMLQuestionResult['proveedorNacionalBasic_8'] == 'Si Cumple' || $XMLQuestionResult['proveedorNacionalBasic_8'] == 'N/A') &&
                    $proveedorNacionalBasic_9 == 'No presenta coincidencia'
                ) {
                    $proveedorNacionalBasicResult = "APTO";
                } else{
                    $proveedorNacionalBasicResult = "NO APTO";
                }

                $pdf->SetFont('Arial', 'B', 10);
                if ($proveedorNacionalBasicResult == "APTO" ) { $pdf->SetTextColor(0,152,0);} else{ $pdf->SetTextColor(255,0,0);};
                $pdf->MultiCell(50, 5, $proveedorNacionalBasicResult , 1, 'C', 1, 1, '', '', true);
                $pdf->SetTextColor(0,0,0);

                // GUARDAR RESULTADO DE LA EVALUACIÓN

                // $evaluationResult = $proveedorNacionalBasicResult;
                // $evaluationValue = "";
                // $query = "UPDATE ses_BackgroundCheck SET evaluationResult='".$evaluationResult."', evaluationValue='".$evaluationValue."' WHERE  id=".$backgroundCheck->id.";";
                // Yii::app()->db->createCommand($query)->execute();

                //}


                if (
                    $backgroundCheck->getVerificationSection(52)->percentCompleted >= 100 &&
                    $backgroundCheck->getVerificationSection(56)->percentCompleted >= 100 &&
                    $backgroundCheck->getVerificationSection(13)->percentCompleted >= 100 &&
                    $backgroundCheck->getVerificationSection(15)->percentCompleted >= 100 &&
                    $backgroundCheck->getVerificationSection(16)->percentCompleted >= 100 &&
                    $backgroundCheck->getVerificationSection(18)->percentCompleted >= 100 &&
                    $backgroundCheck->getVerificationSection(50)->percentCompleted >= 100 &&
                    $backgroundCheck->getVerificationSection(102)->percentCompleted >= 100 &&
                    // $backgroundCheck->getVerificationSection(67)->percentCompleted >= 100 &&
                    $backgroundCheck->getVerificationSection(59)->percentCompleted >= 100 &&
                    $backgroundCheck->getVerificationSection(24)->percentCompleted >= 100
                )
                {
                    $pdf->AddPage();
                    $pdf->SetY(30);
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->SetFillColor(0,66,109);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->MultiCell(170, 0, "RESUMEN CALIFICACIÓN OBTENIDA"  , 0, 'C', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Cell('', '', '', '', 1, 'L');
                    $pdf->Cell('', '', '', '', 1, 'L');

                    $pdf->SetFont('Arial', '', 10);
                    $pdf->SetFillColor(0,66,109);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->MultiCell(80, 0, "COMPONENTES"  , 0, 'C', 1, 0, '', '', true);
                    $pdf->SetFillColor(0,66,109);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->MultiCell(30, 0, "P. Obtenido"  , 0, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, "P. Posible"  , 0, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, "Calificación"  , 0, 'C', 1, 1, '', '', true);


                    $pdf->SetFillColor(220,220,220);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->MultiCell(80, 0, "1. Años de Actividad"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $yearsOfActivityCal  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 4  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $yearsOfActivityCal . "%"  , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFillColor(220,220,220);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(80, 0, "2. Tamaño Por Escala de Activos Totales"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $companySizeByActivesCal  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 8  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $companySizeByActivesCal . "%"  , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "3. Política de Calidad"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Pol_CalCalidadP , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 1  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Pol_CalCalidadP . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFillColor(255,255,255);
                    $pdf->SetTextColor(0,0,0);

                    $pdf->MultiCell(80, 0, "¿Cuenta con Política de Calidad?"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Pol_CalCalidad  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 1  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Pol_CalCalidad ."%"  , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFillColor(220,220,220);
                    $pdf->MultiCell(80, 0, "4. Referencias Comerciales Clientes"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $referenciaCal  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 39  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $referenciaCal . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFillColor(255,255,255);
                    $pdf->MultiCell(80, 0, "Antigüedad como proveedor"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $relationAgeCal  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 11  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $relationAgeCal . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Servicio al Cliente"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $customerServiceCal  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 14  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $customerServiceCal . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Servicio Post-Venta"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $postSalesServiceCal  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 14  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $postSalesServiceCal . "%", 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFillColor(220,220,220);
                    $pdf->MultiCell(80, 0, "5. Referencias Bancarias (CIFIN)"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $refCIFINCal  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 7  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $refCIFINCal ."%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "6. Información Financiera"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $financieraCal  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 18  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $financieraCal ."%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFillColor(255,255,255);
                    $pdf->MultiCell(80, 0, "Razón Corriente"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $razonCorrienteCal_0  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 5.4  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $razonCorrienteCal_0 ."%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Prueba Acida"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $pruebaAcidaCal_0  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 1.8  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $pruebaAcidaCal_0 ."%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Razón de Endeudamiento"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $nivelDeEndeudamientoCal_0  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 5.4  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $nivelDeEndeudamientoCal_0 . "%"  , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Razón Pasivo Capital"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $leverageCal_0  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 3.6  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $leverageCal_0 . "%"  , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Margen Bruto"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $margenBrutoCal_0  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 1.8  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $margenBrutoCal_0 . "%"  , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFillColor(220,220,220);
                    $pdf->MultiCell(80, 0, "7. Información Laboral"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $laboralCal  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 10  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $laboralCal . "%"  , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFillColor(255,255,255);
                    $pdf->MultiCell(80, 0, "Número de Empleados"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $totalEmpleadosCal  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 7  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $totalEmpleadosCal . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Pago de parafiscales"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $rrhhCal_8  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 3  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $rrhhCal_8 ."%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFillColor(220,220,220);
                    $pdf->MultiCell(80, 0, "8. Seguridad, Salud y Medio Ambiente"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $PoliticaCal  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 13  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $PoliticaCal . "%"  , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFillColor(255,255,255);
                    $pdf->MultiCell(80, 0, "Cuenta con la Política HSE"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_1  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 1  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_1 ."%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Cuenta con la Política de Alcohol y Drogas"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_2  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 1  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_2 ."%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Cuenta con un Programa de Seguridad Industrial, Salud Ocupacional e Higiene Industrial"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_3  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 3  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_3 . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Cuenta con COPASST/Vigía Ocupacional (Vigente)"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_4  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 0.5  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_4 ."%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Cuenta con Matriz de Peligros y Riesgos"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_5  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 1  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_5 . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Cuenta con Certificado de Auditoría HSE"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_6  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 1.5  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_6 ."%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Organigrama con responsables HSE"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_7  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 1.5  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_7 . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Certificado ARL accidentalidad (3 años)"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_8  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 3.5  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $Politica_8 ."%" , 1, 'C', 1, 1, '', '', true);


                    $pdf->AddPage();
                    $pdf->SetY(30);
                    $pdf->SetFillColor(220,220,220);
                    $pdf->MultiCell(80, 0, "9. Información Adicional Negativa"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, "-"  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal  , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFillColor(255,255,255);
                    $pdf->MultiCell(80, 0, "Liquidación Voluntaria u Obligatoria"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_1  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, -100  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_1 ."%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Registra embargos"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_2  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, -50  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_2 . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Ley 1116 en Ejecución y menos de 5 años en Proceso"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_3  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, -50  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_3 . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Concordato en Ejecución y menos de 5 años en Proceso"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_4  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, -50  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_4 . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Ley 1116 en Trámite (Mayor de 5 años)"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_5  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, -30  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_5 ."%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Concordato en Trámite"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_6  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, -30  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_6 . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Embargo en cuentas corrientes"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_7  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, -20  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_7 . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Embargo del Establecimiento de Comercio"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_8  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, -20  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_8 ."%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->MultiCell(80, 0, "Embargo de las Cuotas Sociales"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_9  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, -20  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacNegProdecoCal_9 . "%"  , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFillColor(220,220,220);
                    $pdf->MultiCell(80, 0, "10. Información Adicional Positiva"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacPosProdecoCal  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, "-"  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacPosProdecoCal . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFillColor(255,255,255);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->MultiCell(80, 0, "Proveedor en: Becerril, El Paso, La Jagua, Ciénaga."  , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(30, 0, $plusNacPosProdecoCal_1  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 25  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacPosProdecoCal_1 . "%"  , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFont('Arial', '', 8);
                    $pdf->MultiCell(80, 0, "Tiene contratado más del 50% de su personal de la zona Becerril, El Paso, La Jagua, Ciénaga."  , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(30, 0, $plusNacPosProdecoCal_2  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 15  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacPosProdecoCal_2 . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFont('Arial', '', 8);
                    $pdf->MultiCell(80, 0, "Pertenece a un Grupo Empresarial"  , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(30, 0, $plusNacPosProdecoCal_3  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 10  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacPosProdecoCal_3 . "%" , 1, 'C', 1, 1, '', '', true);

                    $pdf->SetFont('Arial', '', 8);
                    $pdf->MultiCell(80, 0, "Posee Fundaciones o programas de Apoyo Social en la zona "  , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(30, 0, $plusNacPosProdecoCal_4  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, 15  , 1, 'C', 1, 0, '', '', true);
                    $pdf->MultiCell(30, 0, $plusNacPosProdecoCal_4 . "%" , 1, 'C', 1, 1, '', '', true);


                    $pdf->AddPage();
                    $pdf->SetY(30);
                    $pdf->SetFillColor(0,66,109);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->MultiCell(170, 0, "DETALLE DE LA EVALUACIÓN" , 1, 'C', 1, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');

                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(170, 0, "1. Años de Actividad" , 1, 'L', 1, 1, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(170, 0, $backgroundCheck->yearsOfActivity . " años", 1, 'L', 0, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(170, 0, "2. Tamaño Por Escala de Activos Totales" , 1, 'L', 1, 1, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(170, 0, $backgroundCheck->companySizeByActives . " SMMLV", 1, 'L', 0, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');

                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(170, 0, "3. Política de Calidad" , 1, 'L', 1, 1, '', '', true);

                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "Cuenta con Política de Calidad" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['Pol_Calidad'] , 1, 'C', 0, 1, '', '', true);


                   $ansComments = $backgroundCheck->getVerificationSection(102)->comments;
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
                    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
                    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', 'I', 9);
                    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');

                    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(170, 0, "4. Referencias Comerciales Clientes" , 1, 'L', 1, 1, '', '', true);

                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "Antigüedad como proveedor" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $relationAge . " años" , 1, 'C', 0, 1, '', '', true);

                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "Servicio al Cliente" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $customerService , 1, 'C', 0, 1, '', '', true);

                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "Servicio Post-Venta" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $postSalesService , 1, 'C', 0, 1, '', '', true);

                    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->comments;
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
                    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
                    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', 'I', 9);
                    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');

                    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(170, 0, "5. Referencias Bancarias (CIFIN)" , 1, 'L', 1, 1, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(170, 0, $refCIFIN, 1, 'L', 0, 1, '', '', true);

                    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE)->comments;
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
                    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
                    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', 'I', 9);
                    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');

                   // $pdf->AddPage();
                   // $pdf->SetY(30);


                    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(170, 0, "6. Información Financiera" , 1, 'L', 1, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "Razón Corriente" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, number_format($razonCorriente_0, 2, '.', '') . " veces" , 1, 'C', 0, 1, '', '', true);

                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "Prueba Acida" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, number_format($pruebaAcida_0, 2, '.', '') . " veces" , 1, 'C', 0, 1, '', '', true);

                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "Razón de Endeudamiento" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, number_format($nivelDeEndeudamiento_0 *100, 2, '.', '') . "%" , 1, 'C', 0, 1, '', '', true);

                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "Razón Pasivo Capital" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, number_format($leverage_0, 2, '.', '') . " veces" , 1, 'C', 0, 1, '', '', true);

                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "Margen Bruto" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, number_format($margenBruto_0, 2, '.', '') . " veces" , 1, 'C', 0, 1, '', '', true);

                    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANTIAL_ANALYS)->comments;
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
                    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
                    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', 'I', 9);
                    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');




                   // $pdf->AddPage();
                   // $pdf->SetY(25);
                    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(170, 0, "7. Información Laboral" , 1, 'L', 1, 1, '', '', true);

                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "Número de Empleados" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $totalEmpleados , 1, 'C', 0, 1, '', '', true);

                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "Pago de parafiscales" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['rrhh_8'] , 1, 'C', 0, 1, '', '', true);

                    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_EMPLOYEE)->comments;
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
                    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
                    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', 'I', 9);
                    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');


                    $pdf->AddPage();
                    $pdf->SetY(25);
                    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(170, 0, "8. Seguridad, Salud y Medio Ambiente" , 1, 'L', 1, 1, '', '', true);

                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "Cuenta con la Política HSE" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['Politica_1'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);

                    $pdf->MultiCell(120, 0, "Cuenta con la Política de Alcohol y Drogas" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['Politica_2'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);

                    $pdf->MultiCell(120, 0, "Cuenta con un Programa de Seguridad Industrial, Salud Ocupacional e Higiene Industrial" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['Politica_3'] , 1, 'C', 0, 1, '', '', true);

                    $pdf->MultiCell(120, 0, "Cuenta con COPASST/Vigía Ocupacional (Vigente)" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['Politica_4'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "Cuenta con Matriz de Peligros y Riesgos" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['Politica_5'] , 1, 'C', 0, 1, '', '', true);

                    $pdf->MultiCell(120, 0, "Cuenta con Certificado de Auditoría HSE" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['Politica_6'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 0, "El organigrama de la compañía cuenta con una estructura y responsables asignados al área de HSE" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['Politica_7'] , 1, 'C', 0, 1, '', '', true);

                    $pdf->MultiCell(120, 0, "Cuenta con Certificado de accidentalidad de los últimos 3 años emitido por la ARL de la empresa" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['Politica_8'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);


                    if ( isset($backgroundCheck->getVerificationSection(103)->comments ) ){
                        $ansComments = $backgroundCheck->getVerificationSection(103)->comments;
                    } else{
                    //    $ansComments = $backgroundCheck->getVerificationSection(58)->comments;
                    }
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
                    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
                    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', 'I', 9);
                    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');

                    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(170, 0, "9. Información Adicional Negativa" , 1, 'L', 1, 1, '', '', true);

                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);

                    $pdf->MultiCell(120, 0, "Liquidación Voluntaria u Obligatoria" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusNacNegProdeco_1'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);

                    $pdf->MultiCell(120, 0, "Registra embargos" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusNacNegProdeco_2'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);

                    $pdf->MultiCell(120, 0, "Ley 1116 en Ejecución y menos de 5 años en Proceso" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusNacNegProdeco_3'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);

                    $pdf->MultiCell(120, 0, "Concordato en Ejecución y menos de 5 años en Proceso" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusNacNegProdeco_4'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);

                    $pdf->MultiCell(120, 0, "Ley 1116 en Trámite (Mayor de 5 años)" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusNacNegProdeco_5'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);

                    $pdf->MultiCell(120, 0, "Concordato en Trámite" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusNacNegProdeco_6'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);

                    $pdf->MultiCell(120, 0, "Embargo en cuentas corrientes" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusNacNegProdeco_7'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);

                    $pdf->MultiCell(120, 0, "Embargo del Establecimiento de Comercio" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusNacNegProdeco_8'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);

                    $pdf->MultiCell(120, 0, "Embargo de las Cuotas Sociales" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusNacNegProdeco_9'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell('', '', '', '', 1, 'L');

                    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(170, 0, "10. Información Adicional Positiva" , 1, 'L', 1, 1, '', '', true);

                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', '', 10);

                    $pdf->MultiCell(120, 0, "Proveedor de la  Zona, ubicados en la Zona: Becerril, El Paso, La Jagua, Ciénaga" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusNacPosProdeco_1'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);

                    $pdf->MultiCell(120, 0, "Proveedor que aunque no es de la zona tiene contratado más del 50% de su personal de la zona: Becerril, El Paso, La Jagua, Ciénaga" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusNacPosProdeco_2'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);

                    $pdf->MultiCell(120, 0, "Pertenece a un Grupo Empresarial." , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusNacPosProdeco_3'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);

                    $pdf->MultiCell(120, 0, "Posee Fundaciones o programas de Apoyo Social en la zona " , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(50, 0, $XMLQuestionResult['plusNacPosProdeco_4'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);

                    $ansComments = $backgroundCheck->getVerificationSection(56)->comments;
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
                    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
                    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', 'I', 9);
                    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');
                }
                // PESTAÑA OEA
                if ($backgroundCheck->getVerificationSection(101) != null){
                    $pdf->AddPage();
                    $pdf->SetY(30);
                    $pdf->SetFillColor(0,66,109);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->MultiCell(170, 0, "OPERADOR ECONOMICO AUTORIZADO" , 1, 'C', 1, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');
                    $pdf->SetFont('Arial', '', 10); $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(140, 0, "El proveedor prestará a prodeco alguno de los siguientes servicios: Servicios informáticos relacionado con cadena de suministro (excluye hardware)" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);

                    $pdf->Cell(30,10,$XMLQuestionResult['Tipoasociado_1'] ,1,1,'C');
                   // $pdf->MultiCell(30, 0, $XMLQuestionResult['Tipoasociado_1'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);

                    $pdf->MultiCell(140, 0, "El proveedor prestará a prodeco alguno de los siguientes servicios: Empresa de Seguridad, Suministro de personal temporal, Servicio de investigación, visitas domiciliarias, asesorías de seguridad, Operador Portuario, Agencia de Aduanas, Transportador, Evaluación de asociados de negocio para los procesos de contratación. (Limitado) " , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Cell(30,20,$XMLQuestionResult['Tipoasociado_2'] ,1,1,'C');
                   // $pdf->MultiCell(30, 0, $XMLQuestionResult['Tipoasociado_2'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);

                    $pdf->MultiCell(140, 0, "Los proceso logisticos se realizarán a traves del consolidador internacional (Bertling)" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(30, 0, $XMLQuestionResult['AccesoInfor_1'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);

                    $pdf->MultiCell(140, 0, "El proveedor en los proceso logisticos internos del Grupo Prodeco tendrá acceso a la carga con destino de exportación" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                   // $pdf->MultiCell(30, 0, $XMLQuestionResult['AccesoInfor_2'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->Cell(30,10,$XMLQuestionResult['AccesoInfor_2'] ,1,1,'C');
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);

                    $pdf->MultiCell(140, 0, "Según RUT o Fecha de Constituacion la empresa tiene constituida" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(30, 0, $XMLQuestionResult['Trayectoria_1'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);

                    $pdf->MultiCell(140, 0, "Los servicios a prestar a las empresas del Grupo Prodeco, se encuentra definidos en el objeto social del proveedor" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Cell(30,10,$XMLQuestionResult['Experiencia_1'] ,1,1,'C');
                   // $pdf->MultiCell(30, 0, $XMLQuestionResult['Experiencia_1'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);

                    $pdf->MultiCell(140, 0, "El proveedor cuenta con certificacion OEA (Operador Econonomico Autorizado). Si la respuesta es si, por favor adjuntar" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Cell(30,10,$XMLQuestionResult['Certificaciones_1'] ,1,1,'C');
                    // $pdf->MultiCell(30, 0, $XMLQuestionResult['Certificaciones_1'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);

                    $pdf->MultiCell(140, 0, "El proveedor cuenta con certificacion BASC, ISO28000, PVP u otro programa de cadena de suministro. Si la respuesta es si, por favor adjuntar" , 1, 'L', 1, 0, '', '', true);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Cell(30,10,$XMLQuestionResult['Certificaciones_2'] ,1,1,'C');
                  //  $pdf->MultiCell(30, 0, $XMLQuestionResult['Certificaciones_2'] , 1, 'C', 0, 1, '', '', true);
                    $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0,0,0);
                    
                    $ansComments = $backgroundCheck->getVerificationSection(101)->comments;
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
                    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
                    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', 'I', 9);
                    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');
                }
                // VALIDACIÓN EN LISTAS RESTRICTIVAS
                include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfValidacionListasRestrictivas.php');

                include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfLAFT.php');
                include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/_pdfCompanyFinantialAnalys.php');

                if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->percentCompleted >=100 ) {
                    $pdf->AddPage();
                    $pdf->SetY(25);
                    $pdf->SetFillColor(0,66,109);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->MultiCell(170, 0, "INFORMACIÓN COMERCIAL" , 1, 'C', 1, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(170, 0, "Referencias Comerciales de Clientes" , 0, 'L', 0, 1, '', '', true);
                    $pdf->SetFont('Arial', '', 10);
                    foreach ($sectionCompanyCustomer as $customer) {
                        $pdf->MultiCell(40, 0, "Razón Social" , 1, 'L', 1, 0, '', '', true);
                        $pdf->MultiCell(130, 0, $customer->companyName , 1, 'L', 1, 1, '', '', true);
                        $pdf->MultiCell(40, 0, "Contacto" , 1, 'L', 1, 0, '', '', true);
                        $pdf->MultiCell(130, 0, $customer->contactName , 1, 'L', 1, 1, '', '', true);
                        $pdf->MultiCell(40, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
                        $pdf->MultiCell(130, 0, $customer->tel , 1, 'L', 1, 1, '', '', true);
                        $pdf->MultiCell(40, 0, "Servicios Productos" , 1, 'L', 1, 0, '', '', true);
                        $pdf->MultiCell(130, 0, $customer->services , 1, 'L', 1, 1, '', '', true);
                        $pdf->Cell('', '', '', '', 1, 'L');

                    }

                    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_CUSTOMER)->comments;
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
                    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
                    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial', 'I', 9);
                    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
                    $pdf->Cell('', '', '', '', 1, 'L');

                }
