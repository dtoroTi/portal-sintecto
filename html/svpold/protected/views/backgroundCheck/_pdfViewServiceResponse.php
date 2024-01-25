<?php
//Inicio Cod

    /*public static function formatearDatosBasicos($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);       
        $datos = $arr['buscarDatosBasicosResult'];

      
        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'INFORMACIÓN GENERAL', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, '', 'Nombre', 0, 0, 'L', 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(116, '', $datos['Denominacion'], 0, 0, 'L', 1);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, '', 'Cédula Ciudadanía', 0, 0, 'L', 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(116, '', '', 0, 0, 'L', 1);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, '', 'Validación de Cédula', 0, 0, 'L', 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(116, '', $datos['EstadoCedula'], 0, 0, 'L', 1);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);

    }

    public static function formatearPeps($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarPepsResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'Listas Restrictivas - PEPs', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);

        if($datos['Status'] == 1) // Hay datos
        {

        
            foreach ($datos['Registros'] as $key => $value_peps) {
                if(isset($value_peps['Coincidencia']))
                {
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Porcentaje de Coincidencia', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['PorcentajeCoincidencia'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Tipo de Identificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['ListasTipoIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Número de Identificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['ListasNroIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Nombre', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['ListasNombre'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Lista', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['NombreLista'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'País de Origen de la lista', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['OrigenLista'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);


                    $description = $value_peps['RelacionadoCon'];
                    $column_width = 116;
                    $total_string_width = $pdf->GetStringWidth($description);
                    $number_of_lines = $total_string_width / ($column_width - 1);
                    $number_of_lines = ceil( $number_of_lines );  // Round it up.
                    $line_height = 5;                             // Whatever your line height is.
                    $height_of_cell = $number_of_lines * $line_height; 
                    $height_of_cell = ceil( $height_of_cell );    // Round it up.

                    if($height_of_cell == 0)
                        $height_of_cell = 5;
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, $height_of_cell, '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, $height_of_cell, 'Relacionado Con', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Multicell(116, $height_of_cell, $value_peps['RelacionadoCon'], 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, $height_of_cell, '', 'R', 1, 'C', 1);

                    //$pdf->Ln();
                    //$pdf->Ln();
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Fecha', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['FechaUpdate'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Conclusión', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['Conclusion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'PedidoTipoId', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['PedidoTipoId'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'PedidoNroIdentificacion', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['PedidoNroIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'NroIdentificacionValido', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['NroIdentificacionValido'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'NroNombreValidos', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['NroNombreValidos'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Actividad', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['Actividad'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'EstadoPersonaNatural', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_peps['EstadoPersonaNatural'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
              }
              else
              {
                foreach ($value_peps as $key => $value_interno_peps) {
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Porcentaje de Coincidencia', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['PorcentajeCoincidencia'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Tipo de Identificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['ListasTipoIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Número de Identificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['ListasNroIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Nombre', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['ListasNombre'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Lista', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['NombreLista'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'País de Origen de la lista', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['OrigenLista'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $description = $value_interno_peps['RelacionadoCon'];
                    $column_width = 116;
                    $total_string_width = $pdf->GetStringWidth($description);
                    $number_of_lines = $total_string_width / ($column_width - 1);
                    $number_of_lines = ceil( $number_of_lines );  // Round it up.
                    $line_height = 5;                             // Whatever your line height is.
                    $height_of_cell = $number_of_lines * $line_height; 
                    $height_of_cell = ceil( $height_of_cell );    // Round it up.

                    if($height_of_cell == 0)
                        $height_of_cell = 5;
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, $height_of_cell, '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, $height_of_cell, 'Relacionado Con', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Multicell(116, $height_of_cell, $value_interno_peps['RelacionadoCon'], 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, $height_of_cell, '', 'R', 1, 'C', 1);
                
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Fecha', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['FechaUpdate'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Conclusión', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['Conclusion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'PedidoTipoId', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['PedidoTipoId'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'PedidoNroIdentificacion', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['PedidoNroIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'NroIdentificacionValido', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['NroIdentificacionValido'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'NroNombreValidos', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['NroNombreValidos'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Actividad', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['Actividad'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'EstadoPersonaNatural', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_interno_peps['EstadoPersonaNatural'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                }
              }

            }
        }
        else
        {
            $fecha = date("d/m/Y");

            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(186, '', 'Por medio de la presente y, dando cumplimiento a las normativas UIAF...', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);

            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(186, '', 'Según registros en ONU, OFAC, HISTORICO OFAC, BOLETIN CONTRALORIA...', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
        }
      
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);

    }


    public static function formatearContaduria($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarContaduriaResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'Contaduría', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);


        if($datos['Status'] == 1) // Hay datos
        {

            if(!isset($datos['Deudas']['DeudasResponse']))
            {
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                $pdf->SetTextColor(0, 200, 0);
                $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetTextColor(255);
            }
            else
            {
          
                foreach ($datos['Deudas'] as $key => $value_deudas) {
                    if(isset($value_deudas['EntidadReportante']))
                    {
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número de identificación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_deudas['NroIdentificacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);


                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre Reportado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_deudas['NombreReportado'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Entidad Reportante', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_deudas['EntidadReportante'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número de Obligación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_deudas['NroObligacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_deudas['Estado'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha de Corte', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_deudas['FechaCorte'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Es incumplimiento pago', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_deudas['EsIncumplimientoPago'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    }
                    else
                    {
                        foreach ($value_deudas as $key => $value_deudas_interno) {

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Número de identificación', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', $value_deudas_interno['NroIdentificacion'], 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Nombre Reportado', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', $value_deudas_interno['NombreReportado'], 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Entidad Reportante', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', $value_deudas_interno['EntidadReportante'], 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Número de Obligación', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', $value_deudas_interno['NroObligacion'], 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Estado', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', $value_deudas_interno['Estado'], 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Fecha de Corte', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', $value_deudas_interno['FechaCorte'], 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Es incumplimiento pago', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', $value_deudas_interno['EsIncumplimientoPago'], 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                        }
                    }

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                }
            }

        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);
        
        }
      

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);
    }


    public static function formatearProcuraduria($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarProcuraduriaResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'Procuraduría', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);


        if($datos['Status'] == 1) // Hay datos
        {
            if(!isset($datos['Antecedentes']['AntecedentesResponse'])
                && !isset($datos['Inhabilidades']['InhabilidadesResponse']))
            {
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                $pdf->SetTextColor(0, 200, 0);
                $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetTextColor(255);
            }
            else
            {
          
                foreach ($datos['Antecedentes'] as $key => $value_antecedentes) {
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Tipo de antecedente', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', (isset($value_antecedentes['TipoAntecedente']) ? $value_antecedentes['TipoAntecedente'] : ''), 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);



                    if(isset($value_antecedentes['Sanciones']['SancionesResponse']))
                    {
                        foreach ($value_antecedentes['Sanciones']['SancionesResponse'] as $key => $value_sanciones) {
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Sanción', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', $value_sanciones, 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                        }
                    }

                    if(isset($value_antecedentes['Delitos']['DelitoResponse']))
                    {
                        foreach ($value_antecedentes['Delitos']['DelitoResponse'] as $key => $value_delitos) {
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Sanción', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', $value_delitos, 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                        }
                    }

                    if(isset($value_antecedentes['ProfesionesLiberales']['ProfesionesLiberalesResponse']))
                    {
                        foreach ($value_antecedentes['ProfesionesLiberales']['ProfesionesLiberalesResponse'] as $key => $value_profesiones) {
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Profesiones Liberales', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', $value_profesiones, 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                        }
                    }

                    if(isset($value_antecedentes['Instancias']['InstanciasResponse']))
                    {
                        foreach ($value_antecedentes['Instancias']['InstanciasResponse'] as $key => $value_instancias) {
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Instancia', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', $value_instancias, 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                        }
                    }

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                }    

                foreach ($datos['Inhabilidades'] as $key => $value_inhabilidades) {
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Número Siri', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_inhabilidades['NroSiri'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Módulo', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_inhabilidades['Modulo'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Inhabilitadad', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_inhabilidades['Inhabilitadad'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Fecha Inicio', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_inhabilidades['FechaInicio'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Fecha Fin', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_inhabilidades['FechaFin'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                }
            }
        }

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);

    }

    public static function formatearContraloria($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarContraloriaResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'Contraloría', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);


        if($datos['Status'] == 1) // Hay datos
        {
            if(!isset($datos['Fallos']['ContraloriaFalloResponse']))
            {
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                $pdf->SetTextColor(0, 200, 0);
                $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetTextColor(255);   
            }
            else
            {
                foreach ($datos['Fallos'] as $key => $value_fallos) {
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Número del fallo', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', (($value_fallos['NroFallo'] != '') ? $value_fallos['NroFallo'] : 'Sin información'), 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Fecha del fallo', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', (($value_fallos['FechaFallo'] != '') ? $value_fallos['FechaFallo'] : 'Sin información'), 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Cuantía', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', (($value_fallos['Cuantia'] != '') ? $value_fallos['Cuantia'] : 'Sin información'), 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Entidad Afectada', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', (($value_fallos['EntidadAfectada'] != '') ? $value_fallos['EntidadAfectada'] : 'Sin información'), 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Reportante', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', (($value_fallos['Reportante'] != '') ? $value_fallos['Reportante'] : 'Sin información'), 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Departamento', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', (($value_fallos['Departamento'] != '') ? $value_fallos['Departamento'] : 'Sin información'), 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Municipio', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', (($value_fallos['Municipio'] != '') ? $value_fallos['Municipio'] : 'Sin información'), 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Tipo de responsabilidad', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', (($value_fallos['TipoResponsabilidad'] != '') ? $value_fallos['TipoResponsabilidad'] : 'Sin información'), 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Código de verificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', (($value_fallos['CodigoVerificacion'] != '') ? $value_fallos['CodigoVerificacion'] : 'Sin información'), 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                }         
            }
        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);  
        }
        
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);
    }


    public static function formatearNovedadesCamara($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarNovedadesCamaraResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'Novedades de Cámara', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);


        if($datos['Status'] == 1) // Hay datos
        {

            if(!isset($datos['Novedades']['NovedadCamaraResponse']))
            {
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                $pdf->SetTextColor(0, 200, 0);
                $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetTextColor(255); 
            }
            else
            {
                foreach ($datos['Novedades'] as $key => $value_fallos) {

                    if(isset($value_fallos['CodCamara']))
                    {
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Código Cámara', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['CodCamara'] != '') ? $value_fallos['CodCamara'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número del fallo', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['NroFallo'] != '') ? $value_fallos['NroFallo'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Matrícula Mercantil', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['MatriculaMercantil'] != '') ? $value_fallos['MatriculaMercantil'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nit', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['Nit'] != '') ? $value_fallos['Nit'] . '-' . $value_fallos['DigitoVerificacion'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['Denominacion'] != '') ? $value_fallos['Denominacion'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Tipo de documento', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['TipoDocumento'] != '') ? $value_fallos['TipoDocumento'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Descripción', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['Descripcion'] != '') ? $value_fallos['Descripcion'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha de radicación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['FechaRadicacion'] != '') ? $value_fallos['FechaRadicacion'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Monto', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['Monto'] != '') ? $value_fallos['Monto'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    }
                    else
                    {
                        foreach ($value_fallos as $key => $value_interno_fallos) {
                          
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Código Cámara', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['CodCamara'] != '') ? $value_interno_fallos['CodCamara'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Número del fallo', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['NroFallo'] != '') ? $value_interno_fallos['NroFallo'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Matrícula Mercantil', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['MatriculaMercantil'] != '') ? $value_interno_fallos['MatriculaMercantil'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Nit', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['Nit'] != '') ? $value_interno_fallos['Nit'] . '-' . $value_interno_fallos['DigitoVerificacion'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Nombre', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['Denominacion'] != '') ? $value_interno_fallos['Denominacion'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Tipo de documento', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['TipoDocumento'] != '') ? $value_interno_fallos['TipoDocumento'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Descripción', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['Descripcion'] != '') ? $value_interno_fallos['Descripcion'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Fecha de radicación', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['FechaRadicacion'] != '') ? $value_interno_fallos['FechaRadicacion'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Monto', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['Monto'] != '') ? $value_interno_fallos['Monto'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                        }
                    } 
                }  
            }
        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);
        }

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);
    }

    public static function formatearDemandas($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarDemandasResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'Demandas', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
      
        if($datos['Status'] == 1) // Hay datos
        {

            if(!isset($datos['Demandas']['DemandaInfo']))
            {
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                $pdf->SetTextColor(0, 200, 0);
                $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetTextColor(255);
            }
            else
            {
                foreach ($datos['Demandas'] as $key => $value_fallos) {

                    if(isset($value_fallos['Departamento']))
                    {
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Departamento', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['Departamento'] != '') ? $value_fallos['Departamento'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado del proceso', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['EstadoProceso'] != '') ? $value_fallos['EstadoProceso'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Expediente', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['Expediente'] != '') ? $value_fallos['Expediente'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha de inicio del proceso', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['FechaInicioProceso'] != '') ? $value_fallos['FechaInicioProceso'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Juzgado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['Juzgado'] != '') ? $value_fallos['Juzgado'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Localidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['Localidad'] != '') ? $value_fallos['Localidad'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre de los demandados', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['NombreDemandados'] != '') ? $value_fallos['NombreDemandados'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre de los demandantes', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['NombreDemandantes'] != '') ? $value_fallos['NombreDemandantes'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número identificación demandados', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['NroIdDemandados'] != '') ? $value_fallos['NroIdDemandados'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número identificación demandantes', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['NroIdDemandantes'] != '') ? $value_fallos['NroIdDemandantes'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Tipo Causa', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['TipoCausa'] != '') ? $value_fallos['TipoCausa'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Tipo Juzgado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_fallos['TipoJuzgado'] != '') ? $value_fallos['TipoJuzgado'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                    }
                    else
                    {
                        foreach ($value_fallos as $key => $value_interno_fallos) {
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Departamento', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['Departamento'] != '') ? $value_interno_fallos['Departamento'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Estado del proceso', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['EstadoProceso'] != '') ? $value_interno_fallos['EstadoProceso'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Expediente', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['Expediente'] != '') ? $value_interno_fallos['Expediente'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Fecha de inicio del proceso', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['FechaInicioProceso'] != '') ? $value_interno_fallos['FechaInicioProceso'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Juzgado', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['Juzgado'] != '') ? $value_interno_fallos['Juzgado'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Localidad', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['Localidad'] != '') ? $value_interno_fallos['Localidad'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Nombre de los demandados', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['NombreDemandados'] != '') ? $value_interno_fallos['NombreDemandados'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Nombre de los demandantes', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['NombreDemandantes'] != '') ? $value_interno_fallos['NombreDemandantes'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Número identificación demandados', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['NroIdDemandados'] != '') ? $value_interno_fallos['NroIdDemandados'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Número identificación demandantes', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['NroIdDemandantes'] != '') ? $value_interno_fallos['NroIdDemandantes'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Tipo Causa', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['TipoCausa'] != '') ? $value_interno_fallos['TipoCausa'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Tipo Juzgado', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_fallos['TipoJuzgado'] != '') ? $value_interno_fallos['TipoJuzgado'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                        }
                    }
                }         
            }
        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);
        }

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);
    }


    public static function formatearSisben($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarSisbenResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'SISBEN', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);


        if($datos['Status'] == 1) // Hay datos
        {

            if(!isset($datos['Registros']['SisbenResponseInfo']))
            {
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                $pdf->SetTextColor(0, 200, 0);
                $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetTextColor(255);
            }
            else
            {
                foreach ($datos['Registros'] as $key => $value_registros) {

                    if(isset($value_registros['Nombres']))
                    {
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombres', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_registros['Nombres'] != '') ? $value_registros['Nombres'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Apellidos', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_registros['Apellidos'] != '') ? $value_registros['Apellidos'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Departamento', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_registros['Departamento'] != '') ? $value_registros['Departamento'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Municipio', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_registros['Municipio'] != '') ? $value_registros['Municipio'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número área', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_registros['NroArea'] != '') ? $value_registros['NroArea'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Ficha', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_registros['Ficha'] != '') ? $value_registros['Ficha'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Puntaje', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_registros['Puntaje'] != '') ? $value_registros['Puntaje'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha de modificación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_registros['FechaModificacion'] != '') ? $value_registros['FechaModificacion'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_registros['Estado'] != '') ? $value_registros['Estado'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Corte Base', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_registros['FechaCorteBase'] != '') ? $value_registros['FechaCorteBase'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    }
                    else
                    {
                        foreach ($value_registros as $key => $value_interno_registros) {
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Nombres', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_registros['Nombres'] != '') ? $value_interno_registros['Nombres'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Apellidos', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_registros['Apellidos'] != '') ? $value_interno_registros['Apellidos'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Departamento', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_registros['Departamento'] != '') ? $value_interno_registros['Departamento'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Municipio', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_registros['Municipio'] != '') ? $value_interno_registros['Municipio'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Número área', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_registros['NroArea'] != '') ? $value_interno_registros['NroArea'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Ficha', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_registros['Ficha'] != '') ? $value_interno_registros['Ficha'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Puntaje', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_registros['Puntaje'] != '') ? $value_interno_registros['Puntaje'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Fecha de modificación', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_registros['FechaModificacion'] != '') ? $value_interno_registros['FechaModificacion'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Estado', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_registros['Estado'] != '') ? $value_interno_registros['Estado'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->SetFillColor(255);
                            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                            $pdf->SetTextColor(0);
                            $pdf->SetFont('Arial', 'B', 10);
                            $pdf->Cell(70, '', 'Fecha Corte Base', 0, 0, 'L', 1);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(116, '', (($value_interno_registros['FechaCorteBase'] != '') ? $value_interno_registros['FechaCorteBase'] : 'Sin información'), 0, 0, 'L', 1);
                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                            $pdf->SetDrawColor(46, 117, 181);
                            $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                        }
                    }
                }         
            }
        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);
        }

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);
    }

    public static function formatearDian($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarDianResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'DIAN', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);


        if($datos['Status'] == 1) // Hay datos
        {
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Nombre', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Denominacion'] != '') ? $datos['Denominacion'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Estado', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['EstatusNit'] != '') ? $datos['EstatusNit'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Dígito Verificador', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['DigitoVerificador'] != '') ? $datos['DigitoVerificador'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);
        }
      
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);
    }

    public static function formatearListas($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarListasResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'Listas Restrictivas', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);


        if($datos['Status'] == 1) // Hay datos
        {

            foreach ($datos['Registros'] as $key => $value_listas) {

                if(isset($value_listas['Coincidencia']))
                {
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Porcentaje de Coincidencia', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['PorcentajeCoincidencia'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Tipo de Identificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['ListasTipoIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Número de Identificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['ListasNroIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Nombre', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['ListasNombre'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Alias', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Alias'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Nacionalidad de la lista', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['NacionalidadListas'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Lista', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['NombreLista'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'País de Origen de la lista', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['OrigenLista'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Hecho', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Hecho'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Delito', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Delito'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);


                    $description = $value_listas['RelacionadoCon'];
                    $column_width = 116;
                    $total_string_width = $pdf->GetStringWidth($description);
                    $number_of_lines = $total_string_width / ($column_width - 1);
                    $number_of_lines = ceil( $number_of_lines );  // Round it up.
                    $line_height = 5;                             // Whatever your line height is.
                    $height_of_cell = $number_of_lines * $line_height; 
                    $height_of_cell = ceil( $height_of_cell );    // Round it up.

                    if($height_of_cell == 0)
                        $height_of_cell = 5;
                    
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, $height_of_cell, '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, $height_of_cell, 'Relacionado Con', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Multicell(116, $height_of_cell, $value_listas['RelacionadoCon'], 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, $height_of_cell, '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Última Fecha Boletín', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['UltFechaBoletin'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Conclusión', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Conclusion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Riesgo', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Riesgo'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Pedido Tipo Identificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['PedidoTipoId'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Pedido Número Identificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['PedidoNroIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Pedido Nombre', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['PedidoNombre'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Nombre Base', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['NombreBase'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Número Identificación Válido', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['NroIdentificacionValido'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Número Nombre Válidos', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['NroNombreValidos'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Actividad', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Actividad'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Estado Persona Natural', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['EstadoPersonaNatural'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Nacionalidad', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Nacionalidad'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Estado Matrícula', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['EstadoMatricula'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Estado Nit Persona Jurídica', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['EstadoNitPersonaJuridica'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Texto Largo', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['TextoLargo'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Link', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Link'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                }
                else
                {

                    foreach ($value_listas as $key => $value_interno_listas) {

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Porcentaje de Coincidencia', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['PorcentajeCoincidencia'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Tipo de Identificación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['ListasTipoIdentificacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número de Identificación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['ListasNroIdentificacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['ListasNombre'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Alias', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Alias'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nacionalidad de la lista', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['NacionalidadListas'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Lista', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['NombreLista'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'País de Origen de la lista', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['OrigenLista'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Hecho', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Hecho'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Delito', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Delito'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $description = $value_interno_listas['RelacionadoCon'];
                        $column_width = 116;
                        $total_string_width = $pdf->GetStringWidth($description);
                        $number_of_lines = $total_string_width / ($column_width - 1);
                        $number_of_lines = ceil( $number_of_lines );  // Round it up.
                        $line_height = 5;                             // Whatever your line height is.
                        $height_of_cell = $number_of_lines * $line_height; 
                        $height_of_cell = ceil( $height_of_cell );    // Round it up.

                        if($height_of_cell == 0)
                            $height_of_cell = 5;
                        
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, $height_of_cell, '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, $height_of_cell, 'Relacionado Con', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Multicell(116, $height_of_cell, $value_interno_listas['RelacionadoCon'], 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, $height_of_cell, '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Última Fecha Boletín', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['UltFechaBoletin'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Conclusión', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Conclusion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Riesgo', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Riesgo'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Pedido Tipo Identificación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['PedidoTipoId'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Pedido Número Identificación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['PedidoNroIdentificacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Pedido Nombre', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['PedidoNombre'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre Base', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['NombreBase'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Identificación Válido', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['NroIdentificacionValido'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Nombre Válidos', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['NroNombreValidos'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Actividad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Actividad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado Persona Natural', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['EstadoPersonaNatural'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nacionalidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Nacionalidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado Matrícula', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['EstadoMatricula'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado Nit Persona Jurídica', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['EstadoNitPersonaJuridica'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Texto Largo', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['TextoLargo'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Link', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Link'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                    }
                }
            }
        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);
        }

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);
    }


    public static function formatearNoticias($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarNoticiasResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'Noticias', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
      

        if($datos['Status'] == 1) // Hay datos
        {

            foreach ($datos['Registros'] as $key => $value_listas) {

                if(isset($value_listas['PrimerNombre']))
                {
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Primer Nombre', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['PrimerNombre'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Segundo Nombre', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['SegundoNombre'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Primer Apellido', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['PrimerApellido'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Segundo Apellido', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['SegundoApellido'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Alias', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Alias'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Municipio', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Municipio'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'País', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Pais'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Número de Identificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['NroIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Lugar Expedición', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['LugarExpedicion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Fecha', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Fecha'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Medio Fuente', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['MedioFuente'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Medio Sección', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['MedioSeccion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Título Noticia', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['TituloNoticia'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Tipo de delito', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['TipoDelito'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Edad', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Edad'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Implicado o Relacionado', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['ImplicadooRelacionado'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                }
                else
                {

                    foreach ($value_listas as $key => $value_interno_listas) {
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Primer Nombre', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['PrimerNombre'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Segundo Nombre', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['SegundoNombre'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Primer Apellido', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['PrimerApellido'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Segundo Apellido', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['SegundoApellido'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Alias', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Alias'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Municipio', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Municipio'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'País', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Pais'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número de Identificación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['NroIdentificacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Lugar Expedición', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['LugarExpedicion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Fecha'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Medio Fuente', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['MedioFuente'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Medio Sección', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['MedioSeccion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Título Noticia', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['TituloNoticia'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Tipo de delito', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['TipoDelito'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Edad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Edad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Implicado o Relacionado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['ImplicadooRelacionado'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                    }
                }
            }
        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);
        }

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);
    }


    public static function formatearSimit($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarSimitResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'SIMIT', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
      

        if($datos['Status'] == 1) // Hay datos
        {

            foreach ($datos['Resoluciones'] as $key => $value_listas) {

                if(isset($value_listas['Resolucion']))
                {
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Resolución', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Resolucion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Comparendo', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Comparendo'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Fecha Comparendo', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['FechaComparendo'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Secretaría', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Secretaria'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Nombre Infractor', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['NombreInfractor'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Estado', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Estado'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Multa Descripción', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['MultaDesc'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Valor Multa', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['ValorMulta'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Interés Mora', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['InteresMora'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Valor adicional', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['ValorAdicional'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Valor a Pagar', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['ValorAPagar'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                }
                else
                {

                    foreach ($value_listas as $key => $value_interno_listas) {

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Resolución', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Resolucion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Comparendo', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Comparendo'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Comparendo', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['FechaComparendo'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Secretaría', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Secretaria'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre Infractor', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['NombreInfractor'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Estado'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Multa Descripción', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['MultaDesc'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Valor Multa', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['ValorMulta'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Interés Mora', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['InteresMora'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Valor adicional', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['ValorAdicional'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Valor a Pagar', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['ValorAPagar'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                    }
                }
            }
        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);
        }

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);
    }

    public static function formatearEsal($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarEsalResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'ESAL', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
      

        if($datos['Status'] == 1) // Hay datos
        {
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Razón Social', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['RazonSocial'] != '') ? $datos['RazonSocial'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Nombre Cámara', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['CamaraNombre'] != '') ? $datos['CamaraNombre'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Matrícula', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Matricula'] != '') ? $datos['Matricula'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Último Año Renovado', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['UltimoAnioRenovado'] != '') ? $datos['UltimoAnioRenovado'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Fecha Matrícula', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['FechaMatricula'] != '') ? $datos['FechaMatricula'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Estado Matrícula', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['EstadoMatriculaDesc'] != '') ? $datos['EstadoMatriculaDesc'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Cantidad Empleados', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['CantidadEmpleados'] != '') ? $datos['CantidadEmpleados'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Tipo de Sociedad', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['TipoSociedad'] != '') ? $datos['TipoSociedad'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Descripción Tipo Organización', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['TipoOrganizacionDesc'] != '') ? $datos['TipoOrganizacionDesc'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Descripción Categoría Matrícula', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['CategoriaMatriculaDesc'] != '') ? $datos['CategoriaMatriculaDesc'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Afiliado', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Afiliado'] != '') ? $datos['Afiliado'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            foreach ($datos['Actividades']['string'] as $key => $value_actividad) {
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                $pdf->SetTextColor(0);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(70, '', 'Actividad', 0, 0, 'L', 1);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(116, '', $value_actividad, 0, 0, 'L', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
            }  
        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);
        }

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);
    }

    public static function formatearRnt($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarRntResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'RNT', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
      

        if($datos['Status'] == 1) // Hay datos
        {
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Rnt', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Rnt'] != '') ? $datos['Rnt'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Nombre', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Nombre'] != '') ? $datos['Nombre'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Estado', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Estado'] != '') ? $datos['Estado'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Último Año Actualizado', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['UltimoAnioActualizado'] != '') ? $datos['UltimoAnioActualizado'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Categoría', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Categoria'] != '') ? $datos['Categoria'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'SubCategoría', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['SubCategoria'] != '') ? $datos['SubCategoria'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Departamento', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Departamento'] != '') ? $datos['Departamento'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Municipio', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Municipio'] != '') ? $datos['Municipio'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Dirección Comercial', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['DireccionComercial'] != '') ? $datos['DireccionComercial'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Teléfono', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Telefono'] != '') ? $datos['Telefono'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Celular', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Celular'] != '') ? $datos['Celular'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Email', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Email'] != '') ? $datos['Email'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Total Empleados', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['TotalEmpleados'] != '') ? $datos['TotalEmpleados'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Razón Social', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['RazonSocial'] != '') ? $datos['RazonSocial'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Nit', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Nit'] != '') ? $datos['Nit'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Representante Legal', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['RepresentanteLegal'] != '') ? $datos['RepresentanteLegal'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Clase Id', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['ClaseId'] != '') ? $datos['ClaseId'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Número Id', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['NumId'] != '') ? $datos['NumId'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Email Prestador', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['EmailPrestador'] != '') ? $datos['EmailPrestador'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Teléfono Prestador', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['TelefonoPrestador'] != '') ? $datos['TelefonoPrestador'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Cámara', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', (($datos['Camara'] != '') ? $datos['Camara'] : 'Sin información'), 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            foreach ($datos['Actividades']['string'] as $key => $value_actividad) {
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                $pdf->SetTextColor(0);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(70, '', 'Actividad', 0, 0, 'L', 1);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(116, '', $value_actividad, 0, 0, 'L', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
            }
        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);
        }

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);
    }

    public static function formatearRup($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarRupResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'RUP', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
      

        if($datos['Status'] == 1) // Hay datos
        {

            foreach ($datos['Proponentes'] as $key => $value_listas) {

                if(!isset($value_listas['ProponenteResponse']))
                {

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Código Cámara', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['CodCamara'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Razón Social', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['RazonSocial'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Id Tipo Identificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['IdTipoIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Número Identificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['NroIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Dígito Verificador', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['DigitoVerificador'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Número Inscripción', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['NroInscripcion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Fecha Renovación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['FechaRenovacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Fecha Inscripción', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['FechaInscripcion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Estado Proponente', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['EstadoProponente'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Sigla', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Sigla'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Fecha Cancelación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['FechaCancelacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    foreach ($value_listas['Multas'] as $key => $value_multas) {
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Contrato', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NroContrato'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nit Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NitEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NombreEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                        
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Municipio Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['MunicipioEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Seccional Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['SeccionalEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['Estado'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                             
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Administrativo', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NroActoAdministrativo'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Administrativo', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['FechaActoAdministrativo'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Ejecutoria', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['FechaEjecutoria'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Valor Multa', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['ValorMulta'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Valor Pagado Multa', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['ValorPagadoMulta'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Suspensión', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NroActoSuspension'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Suspensión', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['FechaActoSuspension'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Confirmación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NroActoConfirmacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Confirmación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['FechaActoConfirmacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Revocación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NroActoRevocacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Revocación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['FechaActoRevocacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Observaciones', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['Observaciones'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                    }

                    foreach ($value_listas['Noticias']['NoticiasRupResponse'] as $key => $value_noticias) {

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Acto', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_noticias['Acto'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Noticia', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_noticias['Noticia'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_noticias['Fecha'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                        
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                    }

                    foreach ($value_listas['Contratos']['ContratosResponse'] as $key => $value_contratos) {   
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Contrato', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['NroContrato'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nit Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['NitEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['NombreEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Municipio Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['MunicipioEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Seccional Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['SeccionalEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Adjudicación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['FechaAdjudicacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Perfeccionamiento', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['FechaPerfeccionamiento'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Inicio', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['FechaInicio'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Terminación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['FechaTerminacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Liquidación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['FechaLiquidacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Valor Contrato', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['ValorContrato'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Valor Pagado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['ValorPagado'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado Contrato', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['EstadoContrato'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Tipo Contratista', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['TipoContratista'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Terminación Anticipada', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['FechaTerminacionAnticipada'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Motivo Terminación Anticipada', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['MotivoTerminacionAnticipada'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Clasificación Ley 1464', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['ClasificacionLey1464'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Clasificacion Ciiu', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['ClasificacionCiiu'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                        
                    }

                    foreach ($value_listas['Sanciones'] as $key => $value_sanciones) {
                        // falta if SancionesResponse
                        
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Contrato', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NroContrato'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nit Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NitEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NombreEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Municipio Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['MunicipioEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Seccional Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['SeccionalEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['Estado'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Administrativo', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NroActoAdministrativo'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Administrativo', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['FechaActoAdministrativo'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Ejecutoria', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['FechaEjecutoria'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Condición Incumplimiento', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['CondicionIncumplimiento'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Descripción Sanción', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['DescripcionSancion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Suspensión', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NroActoSuspension'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Suspensión', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['FechaActoSuspension'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Confirmación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NroActoConfirmacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Confirmación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['FechaActoConfirmacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Revocación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NroActoRevocacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Revocación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['FechaActoRevocacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Vigencia Sanción', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['VigenciaSancion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                                            
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Observaciones', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['Observaciones'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);

                    }
                }
                else
                {

                    foreach ($value_listas as $key => $value_interno_listas) {
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Código Cámara', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['CodCamara'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                    }
                }
            }
        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);
        }

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);
    }

    public static function formatearRue($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['buscarRueResult'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'RUE', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);


        if($datos['Status'] == 1) // Hay datos
        {

            foreach ($datos['Matriculas'] as $key => $value_listas) {

                if(isset($value_listas['Denominacion']))
                {

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Razón Social', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Denominacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Id Tipo Identificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['IdTipoIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Número Identificación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['NroIdentificacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Dígito Verificador', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['DigitoVerificador'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Número Inscripción', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['NroInscripcion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Fecha Renovación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['FechaRenovacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Fecha Inscripción', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['FechaInscripcion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Estado Proponente', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['EstadoProponente'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Sigla', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['Sigla'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->SetFillColor(255);
                    $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(70, '', 'Fecha Cancelación', 0, 0, 'L', 1);
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(116, '', $value_listas['FechaCancelacion'], 0, 0, 'L', 1);
                    $pdf->SetDrawColor(46, 117, 181);
                    $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                    
                    foreach ($value_listas['Multas'] as $key => $value_multas) {

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Contrato', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NroContrato'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nit Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NitEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NombreEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Municipio Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['MunicipioEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Seccional Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['SeccionalEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['Estado'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Administrativo', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NroActoAdministrativo'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Administrativo', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['FechaActoAdministrativo'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Ejecutoria', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['FechaEjecutoria'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Valor Multa', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['ValorMulta'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Valor Pagado Multa', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['ValorPagadoMulta'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Suspensión', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NroActoSuspension'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Suspensión', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['FechaActoSuspension'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Confirmación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NroActoConfirmacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Confirmación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['FechaActoConfirmacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Revocación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['NroActoRevocacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Revocación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['FechaActoRevocacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Observaciones', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_multas['Observaciones'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);


                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                    }

                    foreach ($value_listas['Noticias']['NoticiasRupResponse'] as $key => $value_noticias) {
                    
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Acto', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_noticias['Acto'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Noticia', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_noticias['Noticia'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_noticias['Fecha'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                    }

                    foreach ($value_listas['Contratos']['ContratosResponse'] as $key => $value_contratos) {

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Contrato', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['NroContrato'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nit Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['NitEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['NombreEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Municipio Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['MunicipioEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Seccional Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['SeccionalEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Adjudicación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['FechaAdjudicacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Perfeccionamiento', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['FechaPerfeccionamiento'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Inicio', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['FechaInicio'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Terminación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['FechaTerminacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Liquidación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['FechaLiquidacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Valor Contrato', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['ValorContrato'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Valor Pagado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['ValorPagado'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado Contrato', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['EstadoContrato'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Tipo Contratista', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['TipoContratista'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Terminación Anticipada', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['FechaTerminacionAnticipada'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Motivo Terminación Anticipada', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['MotivoTerminacionAnticipada'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Clasificación Ley 1464', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['ClasificacionLey1464'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Clasificacion Ciiu', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_contratos['ClasificacionCiiu'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                    }


                    foreach ($value_listas['Sanciones'] as $key => $value_sanciones) {
                        // falta if SancionesResponse

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Contrato', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NroContrato'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nit Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NitEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NombreEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Municipio Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['MunicipioEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Seccional Entidad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['SeccionalEntidad'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['Estado'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Administrativo', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NroActoAdministrativo'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Administrativo', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['FechaActoAdministrativo'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Ejecutoria', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['FechaEjecutoria'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Condición Incumplimiento', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['CondicionIncumplimiento'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Descripción Sanción', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['DescripcionSancion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Suspensión', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NroActoSuspension'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Suspensión', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['FechaActoSuspension'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Confirmación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NroActoConfirmacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Confirmación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['FechaActoConfirmacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Acto Revocación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['NroActoRevocacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Acto Revocación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['FechaActoRevocacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Vigencia Sanción', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['VigenciaSancion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Observaciones', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_sanciones['Observaciones'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);
                    }

                }
                else
                {

                    foreach ($value_listas as $key => $value_interno_listas) {

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Razón Social', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Denominacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Tipo Identificación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['TipoIdentificacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Número Identificación', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['NroIdentificacion'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Cámara', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Camara'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Matrícula', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', $value_interno_listas['Matricula'], 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Nombre Cámara', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_interno_listas['CamaraNombre'] != '') ? $value_interno_listas['CamaraNombre'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Matrícula', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_interno_listas['Matricula'] != '') ? $value_interno_listas['Matricula'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Último Año Renovado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_interno_listas['UltimoAnioRenovado'] != '') ? $value_interno_listas['UltimoAnioRenovado'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Fecha Matrícula', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_interno_listas['FechaMatricula'] != '') ? $value_interno_listas['FechaMatricula'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Estado Matrícula', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_interno_listas['EstadoMatriculaDesc'] != '') ? $value_interno_listas['EstadoMatriculaDesc'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Cantidad Empleados', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_interno_listas['CantidadEmpleados'] != '') ? $value_interno_listas['CantidadEmpleados'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Tipo de Sociedad', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_interno_listas['TipoSociedad'] != '') ? $value_interno_listas['TipoSociedad'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Descripción Tipo Organización', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_interno_listas['TipoOrganizacionDesc'] != '') ? $value_interno_listas['TipoOrganizacionDesc'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Descripción Categoría Matrícula', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_interno_listas['CategoriaMatriculaDesc'] != '') ? $value_interno_listas['CategoriaMatriculaDesc'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->SetFillColor(255);
                        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
                        $pdf->SetTextColor(0);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(70, '', 'Afiliado', 0, 0, 'L', 1);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(116, '', (($value_interno_listas['Afiliado'] != '') ? $value_interno_listas['Afiliado'] : 'Sin información'), 0, 0, 'L', 1);
                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

                        $pdf->SetDrawColor(46, 117, 181);
                        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);

                    }
                }
            }
        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);
        }

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
        $pdf->SetFillColor(220);
    }

    public static function formatearTransUnion($jsonText = '', &$pdf)
    {
        $arr = json_decode($jsonText, true);
        $datos = $arr['CIFIN']['Tercero'];

        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'Información Comercial', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);


        if(isset($datos)) // Hay datos
        {
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Tipo de Identificación', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', $datos['TipoIdentificacion'], 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Número de Identificación', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', $datos['NumeroIdentificacion'], 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Nombres Apellidos - Razón Social', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', $datos['NombreTitular'], 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Actividad económica - CIIU', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', $datos['NombreCiiu'], 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Estado documento', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', $datos['Estado'], 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Fecha expedición', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', $datos['FechaExpedicion'], 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Lugar expedición', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', $datos['LugarExpedicion'], 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Rango edad probable', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', $datos['RangoEdad'], 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Fecha', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', $datos['Fecha'], 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Hora', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', $datos['Hora'], 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Usuario', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', $datos['Entidad'], 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, '', 'Número informe', 0, 0, 'L', 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(116, '', $datos['NumeroInforme'], 0, 0, 'L', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFillColor(255);
            $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);
            

            
            $pdf->Cell(196, '', '', 'T', 1, 'C', 1);


            //Resumen endeudamiento
            $pdf->SetFillColor(46, 117, 181);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(196, '', 'RESUMEN DE OBLIGACIONES (COMO PRINCIPAL)', 1, 1, 'C', 1);
            $pdf->SetFillColor(255, 255, 255);
            
            $pdf->SetFillColor(16, 179, 195);
            $pdf->SetDrawColor(255);
            $pdf->SetFont('Arial', 'B', 6);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(49, '', 'OBLIGACIONES', 0, 0, 'L', 1);
            $pdf->Cell(49, '', 'TOTALES', 1, 0, 'L', 1);
            $pdf->Cell(49, '', 'OBLIGACIONES AL DÍA', 1, 0, 'L', 1);
            $pdf->Cell(49, '', 'OBLIGACIONES EN MORA', 1, 1, 'L', 1);

            $pdf->Cell(49, '', '', 0, 0, 'L', 1);
            $pdf->Cell(10, '', 'CANT', 1, 0, 'L', 1);
            $pdf->Cell(24, '', 'SALDO TOTAL', 1, 0, 'L', 1);
            $pdf->Cell(15, '', 'PADE', 1, 0, 'L', 1);
            $pdf->Cell(10, '', 'CANT', 1, 0, 'L', 1);
            $pdf->Cell(24, '', 'SALDO TOTAL', 1, 0, 'L', 1);
            $pdf->Cell(15, '', 'CUOTA', 1, 0, 'L', 1);
            $pdf->Cell(10, '', 'CANT', 1, 0, 'L', 1);
            $pdf->Cell(14, '', 'SALDO TOTAL', 1, 0, 'L', 1);
            $pdf->Cell(10, '', 'CUOTA', 1, 0, 'L', 1);
            $pdf->Cell(15, '', 'VALOR EN MORA', 1, 1, 'L', 1);
            

            $pdf->SetFillColor(240);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetTextColor(50);

            foreach ($datos['Consolidado']['ResumenPrincipal']['Registro'] as $key => $value_registro) {
                if($value_registro === end($datos['Consolidado']['ResumenPrincipal']['Registro']))
                {
                    $pdf->SetFillColor(100);
                    $pdf->SetTextColor(255);
                }
                
                $pdf->Cell(49, '', $value_registro['PaqueteInformacion'], 1, 0, 'L', 1);
                $pdf->Cell(10, '', $value_registro['NumeroObligaciones'], 1, 0, 'L', 1);
                $pdf->Cell(24, '', $value_registro['TotalSaldo'], 1, 0, 'L', 1);
                $pdf->Cell(15, '', $value_registro['ParticipacionDeuda'], 1, 0, 'L', 1);
                $pdf->Cell(10, '', $value_registro['NumeroObligacionesDia'], 1, 0, 'L', 1);
                $pdf->Cell(24, '', $value_registro['SaldoObligacionesDia'], 1, 0, 'L', 1);
                $pdf->Cell(15, '', $value_registro['CuotaObligacionesDia'], 1, 0, 'L', 1);
                $pdf->Cell(10, '', $value_registro['CantidadObligacionesMora'], 1, 0, 'L', 1);
                $pdf->Cell(14, '', $value_registro['SaldoObligacionesMora'], 1, 0, 'L', 1);
                $pdf->Cell(10, '', $value_registro['CuotaObligacionesMora'], 1, 0, 'L', 1);
                $pdf->Cell(15, '', $value_registro['ValorMora'], 1, 1, 'L', 1);
            }

            $pdf->SetFillColor(255);
            $pdf->Cell(196, '', '', 'T', 1, 'C', 1);

            $pdf->SetFillColor(46, 117, 181);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(196, '', 'RESUMEN TOTAL DE OBLIGACIONES', 1, 1, 'C', 1);
            $pdf->SetFillColor(255, 255, 255);

            $pdf->SetFillColor(100);
            $pdf->SetTextColor(255);

            $pdf->Cell(49, '', $datos['Consolidado']['Registro']['PaqueteInformacion'], 1, 0, 'L', 1);
            $pdf->Cell(10, '', $datos['Consolidado']['Registro']['NumeroObligaciones'], 1, 0, 'L', 1);
            $pdf->Cell(24, '', $datos['Consolidado']['Registro']['TotalSaldo'], 1, 0, 'L', 1);
            $pdf->Cell(15, '', $datos['Consolidado']['Registro']['ParticipacionDeuda'], 1, 0, 'L', 1);
            $pdf->Cell(10, '', $datos['Consolidado']['Registro']['NumeroObligacionesDia'], 1, 0, 'L', 1);
            $pdf->Cell(24, '', $datos['Consolidado']['Registro']['SaldoObligacionesDia'], 1, 0, 'L', 1);
            $pdf->Cell(15, '', $datos['Consolidado']['Registro']['CuotaObligacionesDia'], 1, 0, 'L', 1);
            $pdf->Cell(10, '', $datos['Consolidado']['Registro']['CantidadObligacionesMora'], 1, 0, 'L', 1);
            $pdf->Cell(14, '', $datos['Consolidado']['Registro']['SaldoObligacionesMora'], 1, 0, 'L', 1);
            $pdf->Cell(10, '', $datos['Consolidado']['Registro']['CuotaObligacionesMora'], 1, 0, 'L', 1);
            $pdf->Cell(15, '', $datos['Consolidado']['Registro']['ValorMora'], 1, 1, 'L', 1);
            
            $pdf->SetFillColor(255);
            $pdf->Cell(196, '', '', 'T', 1, 'C', 1);
            $pdf->Cell(196, '', '', '', 1, 'C', 1);
            

            //Informe detallado 
            if(isset($datos['CuentasVigentes']))
            {
                $pdf->SetFillColor(46, 117, 181);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->Cell(196, '', 'INFORMACIÓN DE CUENTAS', 1, 1, 'C', 1);
                $pdf->SetFillColor(255, 255, 255);

                $pdf->SetFillColor(16, 179, 195);
                $pdf->SetDrawColor(255);
                $pdf->SetFont('Arial', 'B', 6);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->Multicell(10, "", "\nFECHA\nCORTE\n\n", 1, "L", 1);
                $pdf->Multicell(10, "", "TIPO CONTRATO", 1, "L", 1);
                $pdf->Multicell(10, "", "No CUENTA", 1, "L", 1);
                $pdf->Multicell(15, "", "ESTADO\r\n", 1, "L", 1);
                $pdf->Multicell(10, "", "TIPO ENT", 1, "L", 1);
                $pdf->Multicell(15, "", "ENTIDAD\n", 1, "L", 1);
                $pdf->Multicell(15, "", "CIUDAD\n", 1, "L", 1);
                $pdf->Multicell(15, "", "SUCURSAL\n", 1, "L", 1);
                $pdf->Multicell(15, "", "FECHA APERTURA", 1, "L", 1);
                $pdf->Multicell(15, "", "CUPO SOBREGIRO", 1, "L", 1);
                $pdf->Multicell(15, "", "DIAS AUTOR", 1, "L", 1);
                $pdf->Multicell(15, "", "FECHA PERMANENCIA", 1, "L", 1);
                $pdf->Multicell(30, "", "CHEQ DEVUELTOS ÚLTIMO MES", 1, 1, "L", 1);


                $pdf->Cell(49, '', $datos['Consolidado']['Registro']['PaqueteInformacion'], 1, 0, 'L', 1);
                $pdf->Cell(10, '', $datos['Consolidado']['Registro']['NumeroObligaciones'], 1, 0, 'L', 1);
                $pdf->Cell(24, '', $datos['Consolidado']['Registro']['TotalSaldo'], 1, 0, 'L', 1);
                $pdf->Cell(15, '', $datos['Consolidado']['Registro']['ParticipacionDeuda'], 1, 0, 'L', 1);
                $pdf->Cell(10, '', $datos['Consolidado']['Registro']['NumeroObligacionesDia'], 1, 0, 'L', 1);
                $pdf->Cell(24, '', $datos['Consolidado']['Registro']['SaldoObligacionesDia'], 1, 0, 'L', 1);
                $pdf->Cell(15, '', $datos['Consolidado']['Registro']['CuotaObligacionesDia'], 1, 0, 'L', 1);
                $pdf->Cell(10, '', $datos['Consolidado']['Registro']['CantidadObligacionesMora'], 1, 0, 'L', 1);
                $pdf->Cell(14, '', $datos['Consolidado']['Registro']['SaldoObligacionesMora'], 1, 0, 'L', 1);
                $pdf->Cell(10, '', $datos['Consolidado']['Registro']['CuotaObligacionesMora'], 1, 0, 'L', 1);
                $pdf->Cell(15, '', $datos['Consolidado']['Registro']['ValorMora'], 1, 1, 'L', 1);

            }

            $pdf->SetFillColor(255);
            $pdf->Cell(196, '', '', '', 1, 'C', 1);
            $pdf->Cell(196, '', '', '', 1, 'C', 1);


            $pdf->SetFillColor(46, 117, 181);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(196, '', 'INFORMACIÓN ENDEUDAMIENTO EN SECTOR FINANCIERO', 1, 1, 'C', 1);
            $pdf->SetFillColor(255, 255, 255);

            $pdf->SetFillColor(16, 179, 195);
            $pdf->SetDrawColor(255);
            $pdf->SetFont('Arial', 'B', 6);
            $pdf->SetTextColor(255, 255, 255);

            //Primera fila 
            $pdf->Multicell(10, '', "\nFECHA\nCORTE", 0, 'L', 1);
            $pdf->Multicell(10, '', "TIPO CONT.", 1, "L", 1);
            $pdf->Multicell(10, "", "No. OBLIG.", 1, "L", 1);
            $pdf->Multicell(20, "", "NOMBRE ENTIDAD\n", 1, "L", 1);
            $pdf->Multicell(15, "", "CIUDAD\n\n", 1, "L", 1);
            $pdf->Multicell(13, "", "CALD\n\n", 1, "L", 1);
            $pdf->Multicell(9, "", "VIG\n\n", 1, "L", 1);
            $pdf->Multicell(10, "", "CLA\nPER\n", 1, "L", 1);
            $pdf->Multicell(15, "", "F. INICIO\n\n", 1, "L", 1);
            $pdf->Multicell(8, "", "CUOT PAC.", 1, "L", 1);
            $pdf->Multicell(8, "", "CUOT PAG.", 1, "L", 1);
            $pdf->Multicell(8, "", "CUOT MOR.", 1, "L", 1);
            $pdf->Multicell(10, "", "CUPO APROB INIC.", 1, "L", 1);
            $pdf->Multicell(10, "", "PAGO MINIM CUOTA", 1, "L", 1);
            $pdf->Multicell(10, "", "SIT. OBLIG.", 1, "L", 1);
            $pdf->Multicell(8, "", "TIP. PAG.", 1, "L", 1);
            $pdf->Multicell(10, "", "REF.\n\n", 1, "L", 1);
            $pdf->Multicell(12, "", "F PAGO F EXTIN.", 1, "L", 1);

            $pdf->Ln();
            $pdf->Ln();

            //Segunda fila 
            $pdf->Cell(10, '', '', 0, 0, 'L', 1);
            $pdf->Multicell(10, "", "CATE LCRE", 1, "L", 1);
            $pdf->Multicell(10, "", "EST. CONTR", 1, "L", 1);
            $pdf->Multicell(20, "", "TIPO EMPR\n\n", 1, "L", 1);
            $pdf->Multicell(15, "", "SUCURSAL\n\n", 1, "L", 1);
            $pdf->Multicell(13, "", "EST TITU\n\n", 1, "L", 1);
            $pdf->Multicell(9, "", "MES\n\n", 1, "L", 1);
            $pdf->Multicell(10, "", "", 0, "L", 1);
            $pdf->Multicell(15, "", "F. TERM\n\n", 1, "L", 1);
            $pdf->Multicell(8, "", "PER\n\n", 1, "L", 1);
            $pdf->Multicell(16, "", "", 1, "L", 1);
            $pdf->Multicell(10, "", "CUPO UTIL CORT", 1, "L", 1);
            $pdf->Multicell(10, "", "VALOR CARGO FIJO", 1, "L", 1);
            $pdf->Multicell(10, "", "VALOR MORA", 1, "L", 1);
            $pdf->Multicell(8, "", "MOD EXT", 1, "L", 1);
            $pdf->Multicell(10, "", "MOR MAX", 1, "L", 1);
            $pdf->Multicell(12, "", "F PERMAN", 1, "L", 1);

            $pdf->Ln();
            $pdf->Ln();


            if(isset($datos['SectorFinancieroAlDia']))
            {
                $pdf->SetFillColor(200);
                $pdf->SetDrawColor(255);
                $pdf->SetTextColor(100);

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(100, '', 'FINANCIERO AL DÍA', 0, 1, 'L', 1);
                $pdf->SetFont('Arial', 'B', 6);

                foreach ($datos['SectorFinancieroAlDia'] as $key => $value_financiero_dia) {

                    //Primera fila 
                    $pdf->Cell(10, '', (isset($value_financiero_dia['FechaCorte']) ? $value_financiero_dia['FechaCorte'] : ''), 0, 0, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_financiero_dia['TipoContrato']) ? $value_financiero_dia['TipoContrato'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_financiero_dia['NumeroObligacion']) ? $value_financiero_dia['NumeroObligacion'] : ''), 1, 'L', 1);
                    $pdf->Cell(20, '', (isset($value_financiero_dia['NombreEntidad']) ? $value_financiero_dia['NombreEntidad'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(15, '', (isset($value_financiero_dia['Ciudad']) ? $value_financiero_dia['Ciudad'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(13, '', (isset($value_financiero_dia['Calidad']) ? $value_financiero_dia['Calidad'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(9, '', (isset($value_financiero_dia['Vigencia']) ? $value_financiero_dia['Vigencia'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(10, '', (isset($value_financiero_dia['ClausulaPermanencia']) ? $value_financiero_dia['ClausulaPermanencia'] : ''), 0, 0, 'L', 1);
                    $pdf->Cell(15, '', (isset($value_financiero_dia['FechaApertura']) ? $value_financiero_dia['FechaApertura'] : ''), 1, 0, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_financiero_dia['NumeroCuotasPactadas']) ? $value_financiero_dia['NumeroCuotasPactadas'] : ''), 1, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_financiero_dia['CuotasCanceladas']) ? $value_financiero_dia['CuotasCanceladas'] : ''), 1, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_financiero_dia['NumeroCuotasMora']) ? $value_financiero_dia['NumeroCuotasMora'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_financiero_dia['ValorInicial']) ? $value_financiero_dia['ValorInicial'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_financiero_dia['ValorCuota']) ? $value_financiero_dia['ValorCuota'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_financiero_dia['EstadoObligacion']) ? $value_financiero_dia['EstadoObligacion'] : ''), 1, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_financiero_dia['TipoPago']) ? $value_financiero_dia['TipoPago'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', '?', 1, 'L', 1);
                    $pdf->Multicell(12, '', (isset($value_financiero_dia['FechaPago']) ? $value_financiero_dia['FechaPago'] : ''), 1, 'L', 1);

                    $pdf->Ln();

                    //Segunda fila 
                    $pdf->Cell(10, '', '', 0, 0, 'L', 1);
                    $pdf->Multicell(10, '', '?', 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_financiero_dia['EstadoContrato']) ? $value_financiero_dia['EstadoContrato'] : ''), 1, 'L', 1);
                    $pdf->Cell(20, '', (isset($value_financiero_dia['TipoEntidad']) ? $value_financiero_dia['TipoEntidad'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(15, '', (isset($value_financiero_dia['Sucursal']) ? $value_financiero_dia['Sucursal'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(13, '', (isset($value_financiero_dia['EstadoTitular']) ? $value_financiero_dia['EstadoTitular'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(9, '', '?', 1, 0, 'L', 1);
                    $pdf->Cell(10, '', '', 0, 0, 'L', 1);
                    $pdf->Cell(15, '', '?', 1, 0, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_financiero_dia['Periodicidad']) ? $value_financiero_dia['Periodicidad'] : ''), 1, 'L', 1);
                    $pdf->Multicell(16, '', '', 'L', 1);
                    $pdf->Multicell(10, '', '?', 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_financiero_dia['ValorCargoFijo']) ? $value_financiero_dia['ValorCargoFijo'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_financiero_dia['ValorMora']) ? $value_financiero_dia['ValorMora'] : ''), 1, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_financiero_dia['ModoExtincion']) ? $value_financiero_dia['ModoExtincion'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_financiero_dia['MoraMaxima']) ? $value_financiero_dia['MoraMaxima'] : ''), 1, 'L', 1);
                    $pdf->Multicell(12, '', (isset($value_financiero_dia['FechaPermanencia']) ? $value_financiero_dia['FechaPermanencia'] : ''), 1, 'L', 1);

                    $pdf->Ln();
                    $pdf->Ln();
                }
            }

            $pdf->SetFillColor(255);
            $pdf->Cell(196, '', '', '', 1, 'C', 1);
            $pdf->Cell(196, '', '', '', 1, 'C', 1);
            

            $pdf->SetFillColor(46, 117, 181);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(196, '', 'INFORMACIÓN ENDEUDAMIENTO EN SECTOR REAL', 1, 1, 'C', 1);
            $pdf->SetFillColor(255, 255, 255);

            $pdf->SetFillColor(16, 179, 195);
            $pdf->SetDrawColor(255);
            $pdf->SetFont('Arial', 'B', 6);
            $pdf->SetTextColor(255, 255, 255);

            //Primera fila 
            $pdf->Multicell(10, '', "FECHA\nCORTE", 1, 'L', 1);
            $pdf->Multicell(10, '', "TIPO CONT.", 1, "L", 1);
            $pdf->Multicell(10, "", "No. OBLIG.", 1, "L", 1);
            $pdf->Multicell(20, "", "NOMBRE ENTIDAD\n", 1, "L", 1);
            $pdf->Multicell(15, "", "CIUDAD\n\n", 1, "L", 1);
            $pdf->Multicell(13, "", "CALD\n\n", 1, "L", 1);
            $pdf->Multicell(9, "", "VIG\n\n", 1, "L", 1);
            $pdf->Multicell(10, "", "CLA\nPER\n", 1, "L", 1);
            $pdf->Multicell(15, "", "F. INICIO\n\n", 1, "L", 1);
            $pdf->Multicell(8, "", "CUOT PAC.", 1, "L", 1);
            $pdf->Multicell(8, "", "CUOT PAG.", 1, "L", 1);
            $pdf->Multicell(8, "", "CUOT MOR.", 1, "L", 1);
            $pdf->Multicell(10, "", "CUPO APROB", 1, "L", 1);
            $pdf->Multicell(10, "", "PAGO MINIM", 1, "L", 1);
            $pdf->Multicell(10, "", "SIT. OBLIG.", 1, "L", 1);
            $pdf->Multicell(8, "", "TIP. PAG.", 1, "L", 1);
            $pdf->Multicell(10, "", "REF.\n\n", 1, "L", 1);
            $pdf->Multicell(12, "", "F PAGO F EXTIN.", 1, "L", 1);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();


            //Segunda fila 
            $pdf->Cell(10, '', '', 0, 0, 'L', 1);
            $pdf->Multicell(10, "", "CATE LCRE", 1, "L", 1);
            $pdf->Multicell(10, "", "EST. CONTR", 1, "L", 1);
            $pdf->Multicell(20, "", "TIPO EMPR\n\n", 1, "L", 1);
            $pdf->Multicell(15, "", "SUCURSAL\n\n", 1, "L", 1);
            $pdf->Multicell(13, "", "EST TITU\n\n", 1, "L", 1);
            $pdf->Multicell(9, "", "MES\n\n", 1, "L", 1);
            $pdf->Multicell(10, "", "", 0, "L", 1);
            $pdf->Multicell(15, "", "F. TERM\n\n", 1, "L", 1);
            $pdf->Multicell(8, "", "PER\n\n", 1, "L", 1);
            $pdf->Multicell(16, "", "", 1, "L", 1);
            $pdf->Multicell(10, "", "CUPO UTIL CORT", 1, "L", 1);
            $pdf->Multicell(10, "", "VALOR CARGO FIJO", 1, "L", 1);
            $pdf->Multicell(10, "", "VALOR MORA", 1, "L", 1);
            $pdf->Multicell(8, "", "MOD EXT", 1, "L", 1);
            $pdf->Multicell(10, "", "MOR MAX", 1, "L", 1);
            $pdf->Multicell(12, "", "F PERMAN", 1, "L", 1);

            $pdf->Ln();
            $pdf->Ln();
            

            if(isset($datos['SectorRealAlDia']))
            {
                $pdf->SetFillColor(200);
                $pdf->SetDrawColor(255);
                $pdf->SetTextColor(100);

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(100, '', 'SECTOR REAL AL DÍA', 0, 1, 'L', 1);
                $pdf->SetFont('Arial', 'B', 6);

                foreach ($datos['SectorRealAlDia'] as $key => $value_real_dia) {
                    //Primera fila 
                    $pdf->Cell(10, '', (isset($value_real_dia['FechaCorte']) ? $value_real_dia['FechaCorte'] : ''), 0, 0, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_dia['TipoContrato']) ? $value_real_dia['TipoContrato'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_dia['NumeroObligacion']) ? $value_real_dia['NumeroObligacion'] : ''), 1, 'L', 1);
                    $pdf->Cell(20, '', (isset($value_real_dia['NombreEntidad']) ? $value_real_dia['NombreEntidad'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(15, '', (isset($value_real_dia['Ciudad']) ? $value_real_dia['Ciudad'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(13, '', (isset($value_real_dia['Calidad']) ? $value_real_dia['Calidad'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(9, '', (isset($value_real_dia['Vigencia']) ? $value_real_dia['Vigencia'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(10, '', (isset($value_real_dia['ClausulaPermanencia']) ? $value_real_dia['ClausulaPermanencia'] : ''), 0, 0, 'L', 1);
                    $pdf->Cell(15, '', (isset($value_real_dia['FechaApertura']) ? $value_real_dia['FechaApertura'] : ''), 1, 0, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_real_dia['NumeroCuotasPactadas']) ? $value_real_dia['NumeroCuotasPactadas'] : ''), 1, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_real_dia['CuotasCanceladas']) ? $value_real_dia['CuotasCanceladas'] : ''), 1, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_real_dia['NumeroCuotasMora']) ? $value_real_dia['NumeroCuotasMora'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_dia['ValorInicial']) ? $value_real_dia['ValorInicial'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_dia['ValorCuota']) ? $value_real_dia['ValorCuota'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_dia['EstadoObligacion']) ? $value_real_dia['EstadoObligacion'] : ''), 1, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_real_dia['TipoPago']) ? $value_real_dia['TipoPago'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', '?', 1, 'L', 1);
                    $pdf->Multicell(12, '', (isset($value_real_dia['FechaPago']) ? $value_real_dia['FechaPago'] : ''), 1, 'L', 1);

                    
                    $pdf->Ln();

                    //Segunda fila 
                    $pdf->Cell(10, '', '', 0, 0, 'L', 1);
                    $pdf->Multicell(10, '', '?', 1, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_real_dia['EstadoContrato']) ? $value_real_dia['EstadoContrato'] : ''), 1, 'L', 1);
                    $pdf->Cell(20, '', (isset($value_real_dia['TipoEntidad']) ? $value_real_dia['TipoEntidad'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(15, '', (isset($value_real_dia['Sucursal']) ? $value_real_dia['Sucursal'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(15, '', (isset($value_real_dia['EstadoTitular']) ? $value_real_dia['EstadoTitular'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(9, '', '?', 1, 0, 'L', 1);
                    $pdf->Cell(10, '', '', 0, 0, 'L', 1);
                    $pdf->Cell(15, '', '?', 1, 0, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_real_dia['Periodicidad']) ? $value_real_dia['Periodicidad'] : ''), 1, 'L', 1);
                    $pdf->Multicell(16, '', '', 'L', 1);
                    $pdf->Multicell(10, '', '?', 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_dia['ValorCargoFijo']) ? $value_real_dia['ValorCargoFijo'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_dia['ValorMora']) ? $value_real_dia['ValorMora'] : ''), 1, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_real_dia['ModoExtincion']) ? $value_real_dia['ModoExtincion'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_dia['MoraMaxima']) ? $value_real_dia['MoraMaxima'] : ''), 1, 'L', 1);
                    $pdf->Multicell(12, '', (isset($value_real_dia['FechaPermanencia']) ? $value_real_dia['FechaPermanencia'] : ''), 1, 'L', 1);

                    $pdf->Ln();
                    $pdf->Ln();
                }
            }

            $pdf->SetFillColor(255);
            $pdf->Cell(196, '', '', '', 1, 'C', 1);
            

            if(isset($datos['SectorRealExtinguidas']))
            {
                $pdf->SetFillColor(200);
                $pdf->SetDrawColor(255);
                $pdf->SetTextColor(100);

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(100, '', 'SECTOR REAL EXTINGUIDAS', 0, 1, 'L', 1);
                $pdf->SetFont('Arial', 'B', 6);

                foreach ($datos['SectorRealExtinguidas'] as $key => $value_real_exting) {
                    //Primera fila 
                    $pdf->Cell(10, '', (isset($value_real_exting['FechaCorte']) ? $value_real_exting['FechaCorte'] : ''), 0, 0, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_exting['TipoContrato']) ? $value_real_exting['TipoContrato'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_exting['NumeroObligacion']) ? $value_real_exting['NumeroObligacion'] : ''), 1, 'L', 1);
                    $pdf->Cell(20, '', (isset($value_real_exting['NombreEntidad']) ? $value_real_exting['NombreEntidad'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(15, '', (isset($value_real_exting['Ciudad']) ? $value_real_exting['Ciudad'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(13, '', (isset($value_real_exting['Calidad']) ? $value_real_exting['Calidad'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(9, '', (isset($value_real_exting['Vigencia']) ? $value_real_exting['Vigencia'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(10, '', (isset($value_real_exting['ClausulaPermanencia']) ? $value_real_exting['ClausulaPermanencia'] : ''), 0, 0, 'L', 1);
                    $pdf->Cell(15, '', (isset($value_real_exting['FechaApertura']) ? $value_real_exting['FechaApertura'] : ''), 1, 0, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_real_exting['NumeroCuotasPactadas']) ? $value_real_exting['NumeroCuotasPactadas'] : ''), 1, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_real_exting['CuotasCanceladas']) ? $value_real_exting['CuotasCanceladas'] : ''), 1, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_real_exting['NumeroCuotasMora']) ? $value_real_exting['NumeroCuotasMora'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_exting['ValorInicial']) ? $value_real_exting['ValorInicial'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_exting['ValorCuota']) ? $value_real_exting['ValorCuota'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_exting['EstadoObligacion']) ? $value_real_exting['EstadoObligacion'] : ''), 1, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_real_exting['TipoPago']) ? $value_real_exting['TipoPago'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', '?', 1, 'L', 1);
                    $pdf->Multicell(12, '', (isset($value_real_exting['FechaPago']) ? $value_real_exting['FechaPago'] : ''), 1, 'L', 1);

                    
                    $pdf->Ln();

                    //Segunda fila 
                    $pdf->Cell(10, '', '', 0, 0, 'L', 1);
                    $pdf->Multicell(10, '', '?', 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_exting['EstadoContrato']) ? $value_real_exting['EstadoContrato'] : ''), 1, 'L', 1);
                    $pdf->Cell(20, '', (isset($value_real_exting['TipoEntidad']) ? $value_real_exting['TipoEntidad'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(15, '', (isset($value_real_exting['Sucursal']) ? $value_real_exting['Sucursal'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(13, '', (isset($value_real_exting['EstadoTitular']) ? $value_real_exting['EstadoTitular'] : ''), 1, 0, 'L', 1);
                    $pdf->Cell(9, '', '?', 1, 0, 'L', 1);
                    $pdf->Cell(10, '', '', 0, 0, 'L', 1);
                    $pdf->Cell(15, '', '?', 1, 0, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_real_exting['Periodicidad']) ? $value_real_exting['Periodicidad'] : ''), 1, 'L', 1);
                    $pdf->Multicell(16, '', '', 'L', 1);
                    $pdf->Multicell(10, '', '?', 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_exting['ValorCargoFijo']) ? $value_real_exting['ValorCargoFijo'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_exting['ValorMora']) ? $value_real_exting['ValorMora'] : ''), 1, 'L', 1);
                    $pdf->Multicell(8, '', (isset($value_real_exting['ModoExtincion']) ? $value_real_exting['ModoExtincion'] : ''), 1, 'L', 1);
                    $pdf->Multicell(10, '', (isset($value_real_exting['MoraMaxima']) ? $value_real_exting['MoraMaxima'] : ''), 1, 'L', 1);
                    $pdf->Multicell(12, '', (isset($value_real_exting['FechaPermanencia']) ? $value_real_exting['FechaPermanencia'] : ''), 1, 'L', 1);

                    $pdf->Ln();
                    $pdf->Ln();
                }
            }
        }
        else
        {
            $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
            $pdf->SetTextColor(0, 200, 0);
            $pdf->Cell(186, '', 'NO REGISTRA ANTECEDENTES', 0, 0, 'C', 1);
            $pdf->SetDrawColor(46, 117, 181);
            $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
            $pdf->SetTextColor(255);
        }

    }*/

//Fin Cod

$servicios = ServiceResponse::model()->findAll("code='$model->code'");
    if(count($servicios)!=0)
    {
        $pdf->SetFillColor(255);
        $pdf->Cell(196, '', '', 0, 1, 'L', 1);
        $pdf->Cell(196, '', '', 0, 1, 'L', 1);
        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, '', 'INFORMACIÓN VERIFICADA', 1, 1, 'L', 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LR', 1, 'C', 1);

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(5, '', '', 'L', 0, 'C', 1);
        $pdf->SetFillColor(220);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(86, '', 'Requerimientos', 0, 0, 'C', 1);
        $pdf->Cell(40, '', 'Basic', 0, 0, 'C', 1);
        $pdf->Cell(30, '', 'Level 1', 0, 0, 'C', 1);
        $pdf->Cell(30, '', 'Level 2', 0, 0, 'C', 1);

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255);
        $pdf->Cell(5, '', '', 'R', 1, 'C', 1);

        $pdf->SetTextColor(0, 0, 0);

        
        /* Resumen */
        foreach($servicios as $servicio) {
            $resultado = json_decode($servicio->response);
            $servicioInterno = $servicio->tipo == 'consultaTransUnion' ? 'CIFIN' : $servicio->tipo."Result";
            $resultado_json = $resultado->{$servicioInterno};
            
            if($servicio->tipo=='buscarDemandas') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'Demandas', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if($resultado_json->Status == 1) {
                    $pdf->SetFillColor(205, 79, 57);
                    $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            } else if($servicio->tipo=='buscarContaduria') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'Contaduría', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if($resultado_json->Status == 1) {
                    $pdf->SetFillColor(205, 79, 57);
                    $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            } else if($servicio->tipo=='buscarProcuraduria') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'Procuraduría', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if($resultado_json->Status == 1) {
                    if(isset($resultado_json->Antecedentes->AntecedentesResponse) && 
                        isset($resultado_json->Inhabilidades->InhabilidadesResponse))
                    {
                        $pdf->SetFillColor(205, 79, 57);
                        $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                        $pdf->SetFillColor(255);
                    }
                    else
                    {
                        $pdf->SetFillColor(14, 214, 68);
                        $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                        $pdf->SetFillColor(255);
                    }

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            } else if($servicio->tipo=='buscarContraloria') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'Contraloría', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if($resultado_json->Status == 1) {
                    $pdf->SetFillColor(205, 79, 57);
                    $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            } else if($servicio->tipo=='buscarPeps') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'PEPS', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if($resultado_json->Status == 1) {
                    $pdf->SetFillColor(205, 79, 57);
                    $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            } else if($servicio->tipo=='buscarListas') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'Listas restrictivas', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if($resultado_json->Status == 1) {
                    $pdf->SetFillColor(205, 79, 57);
                    $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            } else if($servicio->tipo=='buscarNovedadesCamara') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'Novedades Cámara', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if($resultado_json->Status == 1) {
                    $pdf->SetFillColor(205, 79, 57);
                    $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            } else if($servicio->tipo=='buscarDemandas') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'Demandas', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if($resultado_json->Status == 1) {
                    $pdf->SetFillColor(205, 79, 57);
                    $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            } else if($servicio->tipo=='buscarSisben') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'SISBEN', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if($resultado_json->Status == 1) {
                    $pdf->SetFillColor(205, 79, 57);
                    $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            } else if($servicio->tipo=='buscarDian') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'DIAN', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if($resultado_json->Status == 1) {
                    $pdf->SetFillColor(205, 79, 57);
                    $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            } else if($servicio->tipo=='buscarNoticias') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'Noticias', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if($resultado_json->Status == 1) {
                    $pdf->SetFillColor(205, 79, 57);
                    $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            } else if($servicio->tipo=='buscarSimit') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'SIMIT', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if($resultado_json->Status == 1) {
                    $pdf->SetFillColor(205, 79, 57);
                    $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            } else if($servicio->tipo=='buscarEsal') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'ESAL', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if($resultado_json->Status == 1) {
                    $pdf->SetFillColor(205, 79, 57);
                    $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            } else if($servicio->tipo=='consultaTransUnion') {

                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'L', 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(86, '', 'Verificación financiera', 0, 0, 'C', 1);

                $pdf->SetFillColor(255);
                $pdf->SetFont('Arial', '', 10);
                if(isset($resultado_json->Tercero)) {
                    $pdf->SetFillColor(205, 79, 57);
                    $pdf->Cell(40, '', 'Antecedentes reportados', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                } else {
                    $pdf->SetFillColor(14, 214, 68);
                    $pdf->Cell(40, '', 'NO registra antecedentes', 0, 0, 'C', 1);
                    $pdf->SetFillColor(255);

                }
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->Cell(30, '', '', 0, 0, 'C', 1);
                $pdf->SetDrawColor(46, 117, 181);
                $pdf->SetFillColor(255);
                $pdf->Cell(5, '', '', 'R', 1, 'C', 1);
                $pdf->SetFillColor(220);

            }
        }

        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(196, '', '', 'LRB', 1, 'C', 1);

        $pdf->Cell(196, '', '', 0, 1, 'L');
        $pdf->Cell(196, '', '', 0, 1, 'L');

        /* Despliegues */

        foreach($servicios as $servicio) {

            if($servicio->tipo=='buscarDatosBasicos'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearDatosBasicos($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarPeps'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearPeps($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarContaduria'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearContaduria($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarProcuraduria'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearProcuraduria($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarContraloria'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearContraloria($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarNovedadesCamara'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearNovedadesCamara($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarDemandas'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearDemandas($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarSisben'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearSisben($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarDian'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearDian($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarListas'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearListas($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarNoticias'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearNoticias($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarSimit'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearSimit($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarEsal'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearEsal($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarRnt'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearRnt($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarRup'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearRup($servicio->response, $pdf);
            }

            if($servicio->tipo=='buscarRue'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearRue($servicio->response, $pdf);
            }

            if($servicio->tipo=='consultaTransUnion'){
                $pdf->Cell(196, '', '', 0, 1, 'L');
                Controller::formatearTransUnion($servicio->response, $pdf);
            }

            

        }

        //$pdf->AddPage();
        $pdf->SetFont('Arial','',12);


        $pdf->Output();
    }

