<?php

//PROCESO PARA EL CALCULO Y LA VISUALIZACIÓN DE LA CALIFICACIÓN DE RIESGOS
$alto=0;
$bajo=0;
$medio=0;
$XMLQuestionResult = array();
foreach($RiesgoSarlaft as $answer){
        $result =  unserialize($answer['answer']) ;
        $XMLQuestionResult = array_merge($XMLQuestionResult, $result);   

        if($XMLQuestionResult['sectionImpact_2']=="ALTO"){
            $alto+= count($XMLQuestionResult['sectionImpact_2']);
        }

        if($XMLQuestionResult['sectionImpact_2']=="MEDIO"){
            $medio+=count($XMLQuestionResult['sectionImpact_2']);
        }

        if($XMLQuestionResult['sectionImpact_2']=="BAJO"){
            $bajo+=count($XMLQuestionResult['sectionImpact_2']);
        } 
}
$riesgo = [
    ['Riesgo' => 'Bajo', 'cantidad' => $bajo],
    ['Riesgo' => 'Medio', 'cantidad' => $medio],
    ['Riesgo' => 'Alto', 'cantidad' => $alto],
];


$bajoV=$bajo*0;
$medioV=$medio*50;
$altoV=$alto*100;


$mriesgo=$bajo+$medio+$alto;
$TotalRiesgo= $mriesgo;

if($TotalRiesgo>0){
    $Promedio=($bajoV+$medioV+$altoV)/$TotalRiesgo;
    $riesgoPromedio= round($Promedio, 1);
}else{
    $Promedio=0;
    $riesgoPromedio=0;
}

if($bajo>$medio && $bajo>$alto){
    $titulo="BAJO";
}else if ($medio>$bajo && $medio>$alto){
    $titulo="MEDIO";
}else{
    $titulo="ALTO";
}

//CAPTURAR EL TOTAL DE NOVEDADES EXISTENTES
foreach ($totalNot as $r) {
    foreach ( $r as $v ) {
        $totalNot=$v;
    }
}

//CAPTURAR EL TOTAL DE LAS SECCIONES CON HALLAZGO
foreach ($totalSecciones as $r) {
    foreach ( $r as $v ) {
        $TotalSecc=$v;
    }
}

?>
<!-- INICIO HTML-->
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- LIBRERIAS Bootstrap CSS && ChartJS -->
        <link rel="stylesheet" href="../../css/Chart.css">
        <link rel="stylesheet" href="../../css/Bootstrap.css">
        <link rel="stylesheet" href="../../css/datatables.min.css">
    </head>
    <!-- INICIO CUERPO DE LA VISTA HTML-->
    <body>
        <form method="POST" action="formularioCompliance" class="">
            <div style="padding-top: 2px;" class="information" style="display:none;">
                
                <!-- DIV PERIODO Y BOTONES DE NOTIFICACION Y DESCARGA-->
                <div class="card">
                    <div class="card-body">
                        <label><center><b>Periodo</b></center></label> 
                        <div class="row">
                            <div class="col-lg-2" style="padding-left: 10px;">
                                <input type="date" name="Desde" id="Desde" class="form-control" id="inputEmail1" placeholder="Fecha" value="<?= $Desde ?>" max="9999-12-31">
                            </div>
                            <div class="col-lg-2" style="padding-left: 30px;">
                                <input type="date" name="Hasta" id="Hasta" class="form-control" id="inputEmail1" placeholder="Fecha" value="<?= $Hasta ?>" max="9999-12-31">
                            </div>
                            <div style="padding-left: 22px;">
                                <label form=""> </label>
                                <button class="btn btn-primary" id="enviar">ENVIAR</button>
                            </div> 

                            <div style="padding-left: 410px;">
                                <label form=""> </label>
                                <center>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#staticBackdropObservation" id="sec_observation"><img src="../../mantenimiento/images/comentario.png"/></button>
                                </center> 
                            </div> 

                            <div style="padding-left: 30px;">
                                <label form=""> </label>
                                <center>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#staticBackdropNot" id="sec_notificaciones">
                                        <img src="../../mantenimiento/images/notificacion.png"/><span class="badge badge-light"><?php echo $totalNot; ?></span>
                                    </button>
                                </center> 
                            </div> 

                            <div style="padding-left: 5px;">
                                <label form=""> </label>
                                <center><button type="button" media="print" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#staticBackdropDesc"><img src="../../mantenimiento/images/downloadDas.png"/></button></center>
                            </div> 

                            <div style="padding-left: 5px;">
                                <label form=""> </label>
                                <center><button type="button" media="print" class="btn btn-primary btn-sm" id="btnCapturar2"><img src="../../mantenimiento/images/captura.png"/></button></center>
                            </div>  

                        </div>
                    </div>
                </div>  
            </div>
                <!-- DIV ESTUDIOS EN ESTE PERIODO Y CALIFICACIÓN DE RIESGOS-->
            <div>
                <div class="card" >
                    <div class="card-body">
                        <div class="row g-2">    
                            <div style="padding-left:10px;" class="col-md-3">
                            <label><center><b>RESULTADO DE ESTUDIOS EN ESTE PERIODO</b></center></label><br>
                                <canvas id="Graficodoughnutresultstudy" width="450" height="320"></canvas> 
                            </div>

                            <div style="padding-left:5px;" class="col-lg-3">  
                                <br><br><br>
                                <table id="resultstudy" border="1" class="table-striped">
                                    <thead class="table-primary"> 
                                        <th>Id</th> 
                                        <th>Resultado</th> 
                                        <th><center>Cantidad Estudios</center></th> 
                                    </thead> 
                                    <tbody>
                                        <?php 
                                        foreach ($resultforstudy as $datos ) {

                                        ?>
                                            <tr>
                                                <td id="id"><?php echo  $datos['id'] ?></td>
                                                <td id="result"><?php echo $datos['name'] ?></td>
                                                <td form="" style='text-decoration: underline' id="<?php echo $datos['id'].'. '.$datos['name'].' ('.$datos['resultado'].')' ?>" data-toggle="modal" data-target="#staticBackdropresult" class="secc_resultstudy" data-descr="<?php echo htmlentities($datos['id']); ?>"><center><font color ="#0277BC"><b><?php echo $datos['resultado'] ?><b></font></center></td>
                                            </tr>
                                        <?php       
                                        }
                                        ?> 
                                    </tbody> 
                                </table>   
                                <?php       
                                    echo CHtml::button('Exportar', array(
                                        'id' => 'export-button',
                                        'class' => 'btn btn-primary btn-sm',
                                        'onClick' => "window.open('" . Yii::app()->controller->createUrl('/site/CsvStudyperiod', array(
                                                '_export' => true,
                                                'from' => $Desde,
                                                'until' => $Hasta,      
                                            )) . "','_blank');"
                                    ));
                                ?> 
                            </div>
                            
                            <div style="padding-left:30px;" class="col-lg-2">
                                <br><br>
                                <canvas id="Graficodoughnutcolaboradores" width="400" height="400"></canvas><br> 
                                <center><label  form=""  form="" data-toggle="modal" data-target="#staticBackdropCO" class="secc_estudiosperiodos"><b>COLABORADORES ></b></label></center>
                            </div>
     

                            <div class="col-lg-3">
                                <center><label  form=""><b>CALIFICACIÓN DE RIESGO</b></label></center>
                                <canvas id="GraficodoughnutRiesgo" width="430" height="260"></canvas> 
                                <center ><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Más información</button></center>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
                
            <div style="padding-top: 5px;">
                <div class="card">
                <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="card">
                                    <label style="padding-top:10px; padding-left:10px;" form=""><b>NOVEDADES</b></label>
                                    <div class="card-body"> 
                                        <div class="row">
                                            <div>
                                                <div class="form-floating">
                                                    <div class="card text-dark bg-light mx-3" style="max-width: 10rem;">
                                                        <div class="card-body">
                                                            <p class="card-text"><center><b><h3><?php echo $TotalSecc; ?></h3>TOTAL<br> (Secciones con Hallazgo)</b></center></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div>
                                                <div>
                                                    <label><b>Secciones por Estudio, con Hallazgo</b></label><br>
                                                        <?php 
                                                        $i=0;
                                                        
                                                        foreach ($totalTipoSecciones as $datos) {
                                                        $i++;
                                                        ?>
                                                            <label class="badge bg-light text-dark" form=""><b><?php echo $i.'. ' ?></b></label>
                                                            <label form="" id="<?php echo $i.'. '.$datos['Secciones'].' ('.$datos['Total_Secciones'].')' ?>" data-toggle="modal" data-target="#staticBackdropC1" class="secc_producto" data-descr="<?php echo htmlentities($datos['id_seccion']); ?>"><h7><?php echo $datos['Secciones'].' ('.$datos['Total_Secciones'].')' ?> ></h7></label><br>
                                                        <?php        
                                                        }
                                                        echo CHtml::button('Exportar', array(
                                                            'id' => 'export-button',
                                                            'class' => 'btn btn-primary btn-sm',
                                                            'onClick' => "window.open('" . Yii::app()->controller->createUrl('/site/CsvSeccionesCH', array(
                                                                    '_export' => true,
                                                                    'from' => $Desde,
                                                                    'until' => $Hasta,      
                                                                )) . "','_blank');"
                                                        ));
                                                        
                                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-7">
                                <div class="card">
                                  <div class="card-body">
                                        <label class="card-title"><b>RESUMEN DE ÚLTIMOS ESTUDIOS</b></label><br>
                                        <div class="row g-2"  style="padding-left: 15px;">
                                            <div>
                                                <select class="form-control-sel" id="criterio" name="criterio">
                                                    <option selected>seleccionar Criterio</option>
                                                    <option value="BackgroundCheck[lastName]">Apellido</option>
                                                    <option value="BackgroundCheck[firstName]">Nombre</option>
                                                    <option value="BackgroundCheck[code]">Referencia</option>
                                                    <option value="BackgroundCheck[idNumber]">Número ID</option>
                                                </select>
                                            </div>
                                            <div style="padding-left: 8px;">
                                                <input class="form-control-sel" type="text" id="dato" name="dato">
                                            </div>
                                            <div style="padding-left: 8px;">
                                                <label form=""> </label>
                                                <button class="btn btn-primary btn-sm" name="buscar"><a class="btn btn-primary btn-sm" href="javascript:redirigir('/vetting/admin?')">BUSCAR</a></button>
                                            </div>
                                        </div>   
                                  </div>
                                </div>

                                <div style="padding-left:2px;">  
                                <br>
                                <label class="card-title"><b>TIEMPO DE RESPUESTA POR TIPO DE ESTUDIO CON ESTADO FINALIZADO</b></label><br>
                                <table id="resultstudy" border="1" class="table-striped">
                                    <thead class="table-primary"> 
                                        <th>Producto</th> 
                                        <th><center>Limite de Días</center></th> 
                                        <th><center>TOTAL FUERA DE TIEMPO</center></th>
                                        <th><center>% Fuera de Tiempo</center></th> 
                                        <th><center>TOTAL A TIEMPO</center></th> 
                                        <th><center>% A Tiempo</center></th> 
                                        <th><center>TOTAL ESTUDIOS</center></th> 
                                    </thead> 
                                    <tbody>
                                        <?php 
                                        $total=0;
                                        $totalFT=0;
                                        $totalAT=0;
                                        foreach ($detaillimitdaysStudy as $datos ) {
                                        $porcfueratiempo=number_format(($datos['fuera_tiempo']*100)/$datos['total_estudios'],1,',',' ');
                                        $porcatiempo=number_format(($datos['a_tiempo']*100)/$datos['total_estudios'],1,',',' ');
                                        ?>
                                            <tr>
                                                <td form="" style='text-decoration: underline' id="<?php echo $datos['idproducto'].'. '.$datos['producto'].' ('.$datos['total_estudios'].')' ?>" data-toggle="modal" data-target="#staticBackdropdetailproduct" class="secc_detailproductforstudy" data-descr="<?php echo htmlentities($datos['idproducto']); ?>"><font color ="#0277BC"><?php echo  $datos['producto'] ?></font></td>
                                                <td id="limite_dias"><center><?php echo $datos['limite_dias'] ?></center></td>
                                                <td id="fuera_tiempo"><center><?php echo $datos['fuera_tiempo'] ?></center></td>
                                                <td><center><b><?php echo $porcfueratiempo.'%' ?></b></center></td>
                                                <td id="a_tiempo"><center><?php echo $datos['a_tiempo'] ?></center></td>
                                                <td><center><b><?php echo $porcatiempo.'%' ?></b></center></td>
                                                <td id="total_estudios"><center><b><?php echo $datos['total_estudios'] ?></b></center></td>
                                            </tr>
                                        <?php    
                                        $total = $total+$datos['total_estudios'];
                                        $totalFT = $totalFT+$datos['fuera_tiempo'];
                                        $totalAT = $totalAT+$datos['a_tiempo'];
                                        }
                                        ?> 
                                        <tr>
                                            <td><h7><b>TOTAL</b></h7></td>
                                            <td></td>
                                            <td><center><h7><b><?php echo $totalFT ?></b></h7></center></td>
                                            <td></td>
                                            <td><center><h7><b><?php echo $totalAT ?></b></h7></center></td>
                                            <td></td>
                                            <td><center><h7><b><?php echo $total ?></b></h7></center></td>
                                        </tr>
                                    </tbody> 
                                </table>   
                            </div>

                            <div  style="padding-top: 2px;">
                                <div class="card" >
                                <div class="card-body">
                                    <label class="card-title"><b>CONSULTA RÁPIDA DE LISTAS RESTRICTIVAS</b></label><br>
                                    
                                    <?php if (isset($_GET['refr']) && isset($_GET['idnumber'])){
                                            if($_GET['refr']==1){?>
                                            <div class="flash-success">
                                                ¡¡Descargue nuevamente el PDF del Documento: <b><?php echo $_GET['idnumber']; ?></b> desde el Historial de Reportes, para validar la recarga de las fuentes no disponibles.!!
                                            </div>
                                    <?php 
                                            }
                                        }
                                    ?>
                                    <div>
                                        <label form=""> </label>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdroptusdatos">HISTORIAL REPORTES</button>
                                    </div><br>
                                    <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div><br>
                                    <div class="row g-2">
                                        <div style="padding-left: 15px;">
                                            <select class="form-control-sel" id="criteriotd" name="criteriotd">
                                                <option value="0">Tipo Identificación</option>
                                                <option value="CC">CC</option>
                                                <option value="NIT">NIT</option>
                                                <option value="CE">CE</option>
                                                <option value="PEP">PEP</option>
                                                <option value="PP">Pasaporte</option>
                                                <option value="PPT">PPT</option>
                                            </select>
                                        </div>
                                        <div style="padding-left: 5px;">
                                            <input class="form-control-sel" type="text" id="documento" name="documento" placeholder="Número de Identificación" onkeypress="return valideKey(event);"> 
                                        </div>
                                        <div style="padding-left: 10px;">
                                            <input type="date" name="fecha_expedicion" id="fecha_expedicion" name="fecha_expedicion" class="form-control" placeholder="Fecha">
                                        </div>
                                        <div style="padding-left: 30px;">
                                            <label form=""> </label>
                                            <button class="btn btn-primary btn-sm" id="buscar_tusdatos" name="buscar_tuddatos">BUSCAR</button>
                                        </div>
                                    </div>   
                                </div>
                                </div>
                                </div>
                            </div>
                            
                          </div>     
                    </div>
                </div>
            </div>
            
<!--INICIO VENTANAS MODAL-->               
<!-- VENTANA MODAL DEL BOTON NOTIFICACIONES -->
<div>
    <div class="modal fade" id="staticBackdropNot" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">NOTIFICACIONES (<?php echo $totalNot; ?>)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id= "notificaciones" border="0" class="table-striped"> 
                        <thead class="table-primary"> 
                            <th with="50%">Fecha</th>
                            <th with="50%">Ref.</th>
                            <th with="50%">Nombre</th>
                            <th with="50%">Detalle</th>
                            <th with="50%">Tipo</th> 
                            <th with="50%">Tipo Retraso</th>
                        </thead> 
                        <tbody></tbody> 
                    </table>  
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
              </div>
            </div>
        </div>
    </div>

<!-- VENTANA MODAL DEL BOTON DESCARGAS -->
    <div class="modal fade" id="staticBackdropDesc" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Generar reporte</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-primary">Descargar Archivo Plano</button>-->
                    <?php
                        echo CHtml::button('Descargar Reporte de Estudios', array(
                            'id' => 'export-button',
                            'class' => 'btn btn-primary btn-sm',
                            'onClick' => "window.open('" . Yii::app()->controller->createUrl('/vetting/PcAdmin', array(
                                    '_export' => true
                                )) . "','_blank');"
                        ));
                    ?>
                    <button type="button" class="btn btn-primary" media="print" id="btnCapturar" onclick="captura()">Descargar Graficas</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

<!-- VENTANA MODAL DEL BOTON MÁS INFORMACIÓN (CALIFICACIÓN RIESGO) -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Calificación de riesgo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align:justify;">	
                <span style="text-align:justify;">
                    En concordancia con los procesos de debida diligencia realizados por la compañía en la plataforma de SINTECTO, se determina a través de la ponderación y promedio de los niveles de riesgos en cada proceso de debida diligencias finalizados los siguientes niveles de riesgo.
                </span>
                </div>
                <div class="modal-body">
                    <table border="1" class="table-striped"> 
                        <tbody>
                            <tr class="table-danger">
                                <td>Nivel de riesgo alto*</td> 
                                <td>Podría presentar novedades altas vinculadas con temas legales, LAFT, financieros, entre otro.</td> 
                            </tr>
                            <tr class="table-warning">
                                <td>Nivel de riesgo medio*</td> 
                                <td>Podría presentar novedades medias vinculadas con temas legales, LAFT, financieros, entre otro.</td> 
                            </tr>
                            <tr class="table-success">
                                <td>Nivel de riesgo bajo*</td> 
                                <td>Podría presentar novedades bajas y no concluyentes vinculadas con temas legales, LAFT, financieros, entre otro.</td> 
                            </tr>
                        </tbody> 
                    </table> 
                </div>        
                <div class="modal-body" style="text-align:justify;">	
                <span style="text-align:justify;">
                    <b>*NOTA:</b> La calificación del riesgos se toma con base SOLO a los riesgos de las debidas diligencias realizadas, se desconoce el nivel de controles de la entidad, los factores de riesgos específicos, así como las variables de probabilidad e impacto. Por tanto, solo es un proceso de clasificación sujeta a revisión de la entidad.
                </span>
                </div>        
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

<!-- VENTANA MODAL COLABORADORES (ESTUDIOS EN ESTE PERIODO) -->
    <div class="modal fade" id="staticBackdropCO" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">ESTUDIOS COLABORADORES</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="colaboradores" border="1" class="table-striped"> 
                        <thead class="table-primary"> 
                            <th>Ref.</th> 
                            <th>Nombre</th> 
                            <th>Estado</th> 
                        </thead> 
                        <tbody></tbody> 
                    </table> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
<!-- VENTANAS MODAL SEÑALES DE ALERTA -->
<!-- VENTANA MODAL CATEGORIA 1 (SEÑALES DE ALERTA) -->
    <div class="modal fade" id="staticBackdropC1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">NOVEDADES</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <input type="text" class="form-control pull-right" style="width:30%" id="searchCH" placeholder="Buscar registros...">
                    </div>
                    <b><input class="form-control-sel text-danger" type="text" name="descrip" id="descrip" value="" readonly/></b>
                    <table id="DetalleSecciones" border="1" class="table table-sm table-striped table-hover table-bordered">
                        <input type="hidden" name="bookId" id="bookId" value=""/>
                        <thead class="table-primary"> 
                            <th>Referencia</th> 
                            <th>Nombre</th> 
                            <th>Comentarios</th> 
                        </thead> 
                        <tbody></tbody> 
                     </table> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button<
                </div>
            </div>
        </div>
    </div>
</div>


<!-- VENTANA MODAL RESULTADOS EVALUACION DE ESTUDIO -->
<div class="modal fade" id="staticBackdropresult" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">RESULTADO EVALUACIÓN DE ESTUDIOS EN ESTE PERIODO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="padding-left: 15px;">
                <b><input class="redondeado confondo" style="width:50%" type="text" name="resulteval" id="resulteval" value="" readonly/></b>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <input type="text" class="form-control pull-right" style="width:30%" id="search" placeholder="Buscar registros...">
                    </div>
                    <table id="detailresultstudys" cellspacing="0" style="width: 100%;" class="table table-sm table-striped table-hover table-bordered">
                        <input type="hidden" name="pkId" id="pkId" value=""/>
                        <thead class="table-primary"> 
                            <th>Codigo</th> 
                            <th>No. ID</th> 
                            <th>Nombre</th> 
                            <th>Hallazgos</th> 
                        </thead> 
                        <tbody id="myTable"></tbody> 
                     </table> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                </div>
        </div>
    </div>
</div>

<!-- VENTANA MODAL DETALLADO DE TIEMPO DE RESPUESTA POR TIPO DE ESTUDIO -->
<div class="modal fade" id="staticBackdropdetailproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">DETALLADO DE TIEMPO DE RESPUESTA POR ESTUDIO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="padding-left: 15px;">
                <b><input class="redondeado confondo" style="width:50%" type="text" name="product" id="product" value="" readonly/></b>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <input type="text" class="form-control pull-right" style="width:30%" id="searchproduct" placeholder="Buscar registros...">
                    </div>
                    <table id="detailproductsStudy" cellspacing="0" style="width: 100%;" class="table table-sm table-striped table-hover table-bordered">
                        <input type="hidden" name="pkId" id="pkId" value=""/>
                        <thead class="table-primary"> 
                            <th><center>Estudio</center></th> 
                            <th><center>No.ID</center></th> 
                            <th><center>Nombre</center></th> 
                            <th><center>Fecha_Limite</center></th>
                            <th><center>Fecha_Public</center></th>  
                            <th><center>Estado</center></th>  
                            <th><center></center></th> 
                        </thead> 
                        <tbody id="myTable">
                        </tbody> 
                     </table> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                </div>
        </div>
    </div>
</div>


<!--MODAL PARA REGISTRAR OBSERVACIONES DE ESTUDIOS-->
<div class="modal fade" id="staticBackdropObservation" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Registro Observaciones de Estudios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--<b>FILTRAR LISTA</b>  
                    <input class="form-control-sel" id="myInput" type="text" placeholder="Search." width="30%"><br>-->                    
                    <table id="RegObservation" border="1" class="table table-sm table-striped table-hover table-bordered">
                        <thead class="table-primary"> 
                            <th>Ref.</th> 
                            <th>No. ID</th> 
                            <th>Nombre</th> 
                            <th>Observación</th> 
                            <center><th> </th></center>
                        </thead> 
                        <tbody id="myTable">
                            <?php 
                            $customerUs = Yii::app()->user->arUser;
                            $Regobservation = $customerUs->getStudyforObservation();
                            foreach ($Regobservation as $key=>$datos ) {
                            ?>
                                <tr>
                                    <td id="code" name="code"><a href="/vetting/admin?BackgroundCheck[code]=<?php echo  $datos['code'] ?>"><?php echo  $datos['code'] ?></a></td>
                                    <td id="id_number"><?php echo $datos['id_number'] ?></td>
                                    <td id="nombre"><?php echo $datos['nombre'] ?></td>
                                    <?php if($datos['observacion']==NULL || empty($datos['observacion'])){ ?>
                                        <td><textarea name="observacion_<?= $key ?>" id="observacion_<?= $key ?>" rows="2" cols="35" maxlength="255"><?php echo $datos['observacion'] ?>
                                        </textarea></td>
                                        <td>
                                        <button name="guardar"><a href="javascript:submitregobs($('#observacion_<?php echo $key ?>').val(), '<?php echo  $datos['code'] ?>')" >Guardar</a></button>
                                        </td>
                                    <?php }else{?>
                                        <td id="observacion"><?php echo $datos['observacion'] ?></td>
                                        <td></td>
                                    <?php } ?>
                                    
                                </tr>
                            <?php        
                            }
                            ?>
                        </tbody> 
                    </table>   
                </div>
                <div class="modal-footer">
                <pagination 
                    total-items="reviews.count"
                    ng-model="reviews.pageNo"
                    max-size="reviews.maxPages"
                    boundary-links="true"
                    rotate="false"
                    num-pages="reviews.noPages"
                    ng-change="changePageTo(reviews.pageNo)"></pagination>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                </div>
        </div>
    </div>
</div>

<!--MODAL PARA HISTORIAL REPORTES DE TUS DATOS-->
<div class="modal fade" id="staticBackdroptusdatos" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Historal PDFs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--<b>FILTRAR LISTA</b>  
                    <input class="form-control-sel" id="myInput" type="text" placeholder="Search." width="30%"><br>-->
                    <table id="Regtusdatos" border="1" class="table-striped">
                        <thead class="table-primary"> 
                            <th>Documento de Identificación</th> 
                            <th>Nombre</th> 
                            <th>Fecha</th> 
                            <th><center>PDF</center></th>
                            <th><center>Recargar Fuentes no disponibles</center></th>
                        </thead> 
                        <tbody id="myTable">
                            <?php 
                            $customerUs = Yii::app()->user->arUser;
                            $RegTusdatos = $customerUs->getInfTusDatos();
                            foreach ($RegTusdatos as $datos ) {
                            ?>
                                <tr>
                                    <td id="numberId"><?php echo  $datos['tipe_Id'].'. '.$datos['numberId'] ?></td>
                                    <td id="name"><?php echo $datos['name'] ?></td>
                                    <td id="created"><?php echo $datos['created'] ?></td>
                                    <td><center>
                                    <?php 
                                        echo CHtml::button('Descargar', array(
                                            'id' => 'export-button',
                                            'class' => 'btn btn-primary btn-sm',   
                                            'onClick' => "window.open('".Yii::app()->controller->createUrl('/site/descargaPDF', array(
                                                   'valor' => $datos['tusdatosId'],
                                                   'doc' => $datos['numberId'],
                                                   'type' => $datos['tipe_Id']
                                                )) . "','_blank');"
                                        ));
                                    ?>
                                    </center></td>
                                    <td><center>
                                    <?php 

                                        echo CHtml::link(CHtml::image('../../mantenimiento/images/recargar.png','Refr'), '#', array('onclick'=>'ans=confirm("Está seguro de recargar las fuentes no disponibles del doumento: ' . $datos['numberId']. '?"); if (ans) {document.location.href="/site/refresh?valor='.$datos['tusdatosId'].'&doc='.$datos['numberId'].'&type='.$datos['tipe_Id'].'";}')); 
                                    ?>
                                    </center></td>
                                </tr>
                            <?php        
                            }
                            ?>
                        </tbody> 
                    </table>   
                </div>
                <div class="modal-footer">
                <pagination 
                    total-items="reviews.count"
                    ng-model="reviews.pageNo"
                    max-size="reviews.maxPages"
                    boundary-links="true"
                    rotate="false"
                    num-pages="reviews.noPages"
                    ng-change="changePageTo(reviews.pageNo)"></pagination>
                    <?php  
                    echo CHtml::button('Exportar', array(
                        'id' => 'export-button',
                        'class' => 'btn btn-primary btn-sm', 
                        'onClick' => "window.open('" . Yii::app()->controller->createUrl('/site/CsvTusDatos' , array(
                            '_export' => true
                        )) . "','_blank');"

                    ));
                    ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdropresultnovedades" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Novedades de Estudio</h4>
              <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div style="padding-left: 15px;">
                <b><input class="redondeado confondo" style="width:80%" type="text" name="coder" id="coder" value="" readonly/></b>
            </div>
            <div class="container"></div>
            <div class="modal-body">
            <table id="detailnovedadesresultstudy" border="1" class="table table-sm table-striped table-hover table-bordered">
                        <input type="hidden" name="pkId" id="pkId" value=""/>
                        <thead class="table-primary"> 
                            <th><center>Fecha</center></th> 
                            <th><center>Tipo</center></th> 
                            <th><center>Tipo Retraso</center></th> 
                            <th><center>Detalle</center></th>
                        </thead> 
                        <tbody id="myTable">
                        </tbody> 
                     </table> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>        
            </div>
          </div>
        </div>
        </div>

            </div>
        </form>
    </body>
</html>

<script src="../../mantenimiento/js/jquery-3.5.1.min.js"></script>
<script src="../../mantenimiento/js/bootstrap.min.js"></script>
<script src="../../mantenimiento/js/Chart.min.js"></script>
<script src="../../mantenimiento/js/Chart.bundle.min.js"></script>
<script src="../../mantenimiento/js/datatables.min.js"></script>
<script src="../../mantenimiento/js/html2canvas.min.js"></script>

<script type="text/javascript">


$(document).ready( function () {
    $('#RegObservation').DataTable();
} );

$(document).ready(function(){
    $("#search").keyup(function(){
    _this = this;
    // Show only matching TR, hide rest of them
    $.each($("#detailresultstudys tbody tr"), function() {
    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
    $(this).hide();
    else
    $(this).show();
    });
    });
});


$(document).ready(function(){
    $("#searchproduct").keyup(function(){
    _this = this;
    // Show only matching TR, hide rest of them
    $.each($("#detailproductsStudy tbody tr"), function() {
    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
    $(this).hide();
    else
    $(this).show();
    });
    });
});

$(document).ready(function(){
    $("#searchCH").keyup(function(){
    _this = this;
    // Show only matching TR, hide rest of them
    $.each($("#DetalleSecciones tbody tr"), function() {
    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
    $(this).hide();
    else
    $(this).show();
    });
    });
});

$(document).ready( function () {
    $('#Regtusdatos').DataTable();
} );

$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

function valideKey(evt){		
    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;

    if(code==8) { // backspace.
      return true;
    } else if(code>=48 && code<=57) { // is a number.
      return true;
    } else{ // other keys.
      return false;
    }
}

//carga en la ventana modal de los resultados de evaluacion de estudios
$(document).on('click', '.secc_resultstudy', function () {
    
    $('#detailresultstudys > tbody').empty();

    var result = $(this).attr('id');
    $('#resulteval').val(result);
    var id = $(this).attr('data-descr');
    $('#pkId').val(id);

    $.ajax({
    type:'POST',
    url: "/site/detailresultStudy.html",
    dataType: "json",
    data: { 
        'from':  $('#Desde').val(),
        'until':  $('#Hasta').val(),
        'id' : id,
    },
    context: document.body
    }).done(function(resp) {
        $( this ).addClass( "DetailresultStudy" );
        console.log(resp);
    if(resp.length>0){
            var data = resp; 
            var descr =$("input#bookId").val();
            for(var i=0; i<data.length; i++)
            {
                var tblRow = "<tr>" + 
                    "<td><a href='/vetting/admin?BackgroundCheck[code]=" + data[i]["code"] + "'>" + data[i]["code"]+ "</a></td>" + 
                    "<td>" + data[i]["numid"] + "</td>" + 
                    "<td>" + data[i]["nombre"] + "</td>" + 
                    "<td>" + data[i]["hallazgos"]+ "</td>" + 
                    "</tr>" 
                    $(tblRow).appendTo("#detailresultstudys tbody");
            }               
        }
    });

});

//carga en la ventana modal las Secciones por Estudio con Hallazgo
$(document).on('click', '.secc_producto', function () {
    
    $('#DetalleSecciones > tbody').empty();

    var descr = $(this).attr('data-descr');
    $('#bookId').val(descr);
    var descrp = $(this).attr('id');
    $('#descrip').val(descrp);

    alert("Se iniciara la carga de los estudios, por favor espere un momento.");

    $.ajax({
    type:'POST',
    url: "/site/detailSections.html",
    dataType: "json",
    data: { 
        'from':  $('#Desde').val(),
        'until':  $('#Hasta').val(),
        //'typeStudy': $('#typeStudy').val(),
    },
    context: document.body
    }).done(function(resp) {
        $( this ).addClass( "DetailSections" );
    if(resp.length>0){
            var data = resp;
            var descr =$("input#bookId").val();
            for(var i=0; i<data.length; i++)
            {
                if(data[i]["id"]==descr){
                    var tblRow = "<tr>" + "<td><a href='/vetting/admin?BackgroundCheck[code]=" + data[i]["code"] + "'>" + data[i]["code"]+ "</a></td>" + 
                        "<td>" + data[i]["Nombre"]+ "</td>" + 
                        "<td>" + data[i]["comments"]+ "</td>" + "</tr>" 
                        $(tblRow).appendTo("#DetalleSecciones tbody");
                }
            }               
        }
    });
});

//carga en la ventana modal del detallado de tiempo de respuesta por tipo de estudio
$(document).on('click', '.secc_detailproductforstudy', function () {
    
    $('#detailproductsStudy > tbody').empty();

    var producto = $(this).attr('id');
    $('#product').val(producto);
    var id = $(this).attr('data-descr');
    $('#pkId').val(id);
 
    $.ajax({
    type:'POST',
    url: "/site/detailProductsStudydays.html",
    dataType: "json",
    data: { 
        'from':  $('#Desde').val(),
        'until':  $('#Hasta').val(),
        'idproducts' : id,
    },
    context: document.body
    }).done(function(resp) {
        $( this ).addClass( "DetailProductsStudydays" );
        console.log(resp);
    if(resp.length>0){
            var data = resp; 
            var descr =$("input#bookId").val();
            for(var i=0; i<data.length; i++)
            {
                var tblRow = "<tr>" + 
                    "<td><a href='/vetting/admin?BackgroundCheck[code]=" + data[i]["code"] + "'>" + data[i]["code"]+ "</a></td>" + 
                    "<td>" + data[i]["idnumber"] + "</td>" + 
                    "<td>" + data[i]["nombre"] + "</td>" + 
                    "<td>" + data[i]["fecha_limite"]+ "</td>" + 
                    "<td>" + data[i]["fecha_publicado"]+ "</td>" + 
                    "<td><center>" + data[i]["estado"]+ "</center></td>" + 
                    "<td form='' style='text-decoration: underline' id='Ref." + data[i]["code"] + '  Doc.' + data[i]["idnumber"] + '  Nombre:' + data[i]["nombre"] + "' data-toggle='modal' data-target='#staticBackdropresultnovedades' class='secc_novedadesresult' data-descr='" + data[i]["code"] + "'><font color ='#0277BC'>Novedades (" + data[i]["cantNov"] + ")</font></td>" +
                    "</tr>" 
                    $(tblRow).appendTo("#detailproductsStudy tbody");
            }               
        }
    });
});

$(document).on('click', '.secc_novedadesresult', function () {

    $('#detailnovedadesresultstudy > tbody').empty();

    var datos = $(this).attr('id');
    $('#coder').val(datos);
    var id = $(this).attr('data-descr');
    $('#pkId').val(id);


    $.ajax({
    type:'POST',
    url: "/site/novedadStudy.html",
    dataType: "json",
    data: { 
        'code' : id,
    },
    context: document.body
    }).done(function(resp) {
        $( this ).addClass( "NovedadStudy" );
        console.log(resp);
    if(resp.length>0){
            var data = resp; 
            var descr =$("input#bookId").val();
            for(var i=0; i<data.length; i++)
            {
                var tblRow = "<tr>" + 
                    "<td>" + data[i]["fecha"] + "</td>" + 
                    "<td>" + data[i]["tipo"] + "</td>" + 
                    "<td>" + data[i]["tipoRetraso"]+ "</td>" + 
                    "<td>" + data[i]["detalle"]+ "</td>" + 
                    "</tr>" 
                    $(tblRow).appendTo("#detailnovedadesresultstudy tbody");
            }               
        }
    });
});

function submitregobs(obs, code){

    //la condición
    if (obs.length == 0 || /^\s+$/.test(obs)) {
        alert('No ha Ingresado ninguna observación.');
    }else{

    $.ajax({
    type:'POST',
    url: "/site/insertObsv.html",
    dataType: "json",
    data: { 
        'ref':  code,
        'obs':  obs,
    },
    context: document.body
    }).done(function(resp) {
        $( this ).addClass( "InsertObsv" );
        console.log(resp);
        if(resp>0){
            alert('¡¡LA OBSERVACIÓN HA SIDO ENVIADA CON ÉXITO!!.');
        }
    });

    }

}
    
//Redirigir a listado de estudios desde la opción RESUMEN DE ÚLTIMOS ESTUDIOS
function redirigir(url)
{
    var criterio=document.getElementById("criterio").value;
    var dato=document.getElementById("dato").value;
    
    var ruta =url+criterio+'='+dato;
    setTimeout(function ()
    {
        window.location.replace(ruta);
    }, 60);
}

//Descargar desde la opción Generar reporte los graficos de la vista
function captura(){
    $('#staticBackdropDesc').modal('hide');

    const $boton = document.querySelector("#btnCapturar"),   // El botón que realiza la captura
    $objetivo = document.body; // A qué le tomamos la fotocanvas
    //Nota: no necesitamos contenedor, pues vamos a descargarla
    //Agregar el listener al botón
    $boton.addEventListener("click", () => {
    html2canvas($objetivo) // Llamar a html2canvas y pasarle el elemento que se encuentra en la ruta ../../mantenimiento/js/html2canvas.min.js
        .then(canvas => {
            // Cuando se resuelva la promesa traerá el canvas
            // Crear un elemento <a> 
            let enlace = document.createElement('a');
            enlace.download = "Compliance.png"; //Asignamos nombre a la imagen que descargamos
            // Convertir la imagen a Base64
            enlace.href = canvas.toDataURL('www.google.com');
            // Hacer click en él
            enlace.click();
        });
    });
}

//Descarga la vista desde el icono de screenshot
const $boton = document.querySelector("#btnCapturar2"), // El botón que realiza la captura
        $objetivo = document.body; // A qué le tomamos la fotocanvas
        //Nota: no necesitamos contenedor, pues vamos a descargarla
        // Agregar el listener al botón
    $boton.addEventListener("click", () => {
      html2canvas($objetivo) // Llamar a html2canvas y pasarle el elemento que se encuentra en la ruta ../../mantenimiento/js/html2canvas.min.js
        .then(canvas => {
          // Cuando se resuelva la promesa traerá el canvas
          // Crear un elemento <a> 
          let enlace = document.createElement('a');
          enlace.download = "Compliance.png"; //Asignamos nombre a la imagen que descargamos
          // Convertir la imagen a Base64
          enlace.href = canvas.toDataURL('www.google.com');
          // Hacer click en él
          enlace.click();
        });
});

//Llamar ventanas modal
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})

//CREAR LOS GRAFICOS DE LA VISTA DEL DASHBOARD
crear_grafico();


//Llamar las funciones javascript para mostrar los estudios en este periodo
$(document).on('click', '.secc_estudiosperiodos', function () {
    mostar_datos();
});

function mostar_datos(){

     //DATOS PARA EL MODAL ESTUDIOS EN ESTE PERIODO  
    $.ajax({
    type:'POST',
    url: "/site/detailStudy.html",
    dataType: "json",
    data: { 
        'from':  $('#Desde').val(),
        'until':  $('#Hasta').val(),
        //'typeStudy': $('#typeStudy').val(),
    },
    context: document.body
    }).done(function(resp) {
        $('#cliente > tbody').empty();
        $('#provedores > tbody').empty();
        $('#colaboradores > tbody').empty();
        $('#otros > tbody').empty();
        $( this ).addClass( "DetailStudy" );
        if(resp.length>0){
            var data = resp;
            for(var i=0; i<data.length; i++){
                if(data[i]["typeStudy"]=="Colaboradores"){
                    var tblRow = "<tr>" + "<td>" + data[i]["code"]+ "</td>" + 
                        "<td>" + data[i]["nombre"] + "</td>" + 
                        "<td>" + data[i]["TipoEstado"] + "</td>"+"</tr>"
                        $(tblRow).appendTo("#colaboradores tbody");  
                }
            }
        }
    })
}

$("#sec_notificaciones").on("click", function(ev){
    //Carga ventana modal del icono de Notificaciones
    $.ajax({
    type:'POST',
    url: "/site/detailNotificationsIn.html",
    dataType: "json",
    context: document.body
    }).done(function(resp) {
        $('#notificaciones > tbody').empty();
        $( this ).addClass( "DetailNotificationsIn" );
        if(resp.length>0){
            var data = resp;

            for(var i=0; i<data.length; i++){

                var tblRow = "<tr>" + "<td>" + data[i]["fecha"]+ "</td>" + 
                    "<td>" + data[i]["code"] + "</td>" + 
                    "<td>" + data[i]["lastName"] + "</td>" + 
                    "<td>" + data[i]["detail"] + "</td>" + 
                    "<td>" + data[i]["tipo"] + "</td>" + 
                    "<td>" + data[i]["tiporetraso"] + "</td>"+"</tr>" 
                    $(tblRow).appendTo("#notificaciones tbody");  
            }
        }
        //console.log(data);
    });
});

    
function crear_grafico(){
    $.ajax({
    }).done(function(resp){
        ////INICIO ESTUDIOS EN ESTE PERIODO///
        //pinta el grafico de Colaboradores
        if(resp.length>0){
            var colores=[];
            var titulo =[];
            var cantidad = [];
            var abierto = 0;
            var cerrado = 0;
            var data =  <?php echo json_encode($NumStudytotal) ?>;

            for(var i=0; i<data.length; i++){
                if(data[i]["typeStudy"]=="Colaboradores"){
                    titulo.push(data[i]["TipoEstado"]);
                    cantidad.push(data[i]["Cantida_Estado"]);

                    if(data[i]["estado"]==5){
                        abierto+=data[i]["Cantida_Estado"];
                    }
                    if(data[i]["estado"]==4){
                        cerrado+=data[i]["Cantida_Estado"];
                    } 
                }
            }
            var textInside = '';
            CrearGrafico(titulo, cantidad, colores, 'doughnut', ' ','Graficodoughnutcolaboradores', textInside, abierto, cerrado);
        }
        ////FIN ESTUDIOS EN ESTE PERIODO///

        ////INICIO ESTUDIOS EVALUACION DE RIESGOS///
        //pinta el grafico de Evaluacion de riesgos
        if(resp.length>0){
            var colores=[];
            var titulo =[];
            var cantidad = [];
            var data =  <?php echo json_encode($resultforstudy) ?>;
            
            for(var i=0; i<data.length; i++){
                titulo.push(data[i]["name"]);
                cantidad.push(data[i]["resultado"]);
            }
            var textInside = '';
            CrearGraficoResult(titulo, cantidad, colores, 'horizontalBar', ' ','Graficodoughnutresultstudy', textInside);
        }
        ////FIN RESULTADO EVALUACION DE ESTUDIOS///

        //Pinte el grafico de CALIFICACIÓN DE RIESGO
        if(resp.length>0){
            var colores=[];
            var titulo =[];
            var cantidad = [];

            var data =  <?php echo json_encode($riesgo) ?>;
            for(var i=0; i<data.length; i++){
                titulo=<?php echo "'$titulo'"; ?>;
                cantidad.push(data[i]["cantidad"]);
            }
            var textInside = '';
            CrearGraficoRiesgo(titulo, cantidad, colores, 'tsgauge', '','GraficodoughnutRiesgo', textInside, '');
        }
    });
}

function CrearGraficoResult(titulo, cantidad, colores, tipo, encabezado, id, textInside){
    var ctx = document.getElementById(id);
    var myChart = new Chart(ctx, {
        type: tipo,
        title: {
            text: titulo,
            backgroundColor: 'none',
            color: '#626262',
            fontSize: '15px'
          },
        
        data: {
            labels: titulo,
            datasets: [{
                label: 'Resultado Evaluación de estudios en este periodo',
                data: cantidad,          
                backgroundColor:['#004382',
                                '#0277BC',
                                '#004382',
                                '#0277BC'],
                hoverBackgroundColor:['#004382',
                                '#0277BC',
                                '#004382',
                                '#0277BC']           
            }]
        },
        options: {
            animation: {
                duration: 500,
                easing: "easeOutQuart",
                onComplete: function () {
                    var ctx = this.chart.ctx;
                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                    ctx.textAlign = 'left';
                    ctx.textBaseline = 'middle';
                    ctx.font='13px Arial';
  
                    this.data.datasets.forEach(function (dataset) {
                        for (var i = 0; i < dataset.data.length; i++) {
                            var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                            ctx.fillStyle = '#444';
                            var y_pos = model.y + 5;
                            // Asegúrese de que el valor de los datos no se desborde ni se oculte   
                            // cuando el valor de la barra está demasiado cerca del valor máximo de escala
                            // Nota: El valor de y es inverso, cuenta de arriba hacia abajo
                            if ((scale_max - model.y) / scale_max >= 0.93)
                                y_pos = model.y + 20; 
                            ctx.fillText(dataset.data[i], model.x, y_pos);
                        }
                    });               
                }
            }
        }
    });
}

//FUNCION PARA OPTENER LOS DATOS Y PINTAR LAS GRAFICAS DE ESTUDIOS EN ESTE PERIODO
function CrearGrafico(titulo, cantidad, colores, tipo, encabezado, id, textInside, abierto, cerrado){
    var ctx = document.getElementById(id);
    var myChart = new Chart(ctx, {
        type: tipo,
        title: {
            text: titulo,
            backgroundColor: 'none',
            color: '#626262',
            fontSize: '10px'
          },
        data: {
            labels: titulo,
            datasets: [{
                label: encabezado,
                data: cantidad,          
                backgroundColor:['#004382',
                                '#0277BC'],
                hoverBackgroundColor:['#004382',
                                    '#0277BC']           
            }]
        },
        options: {
            elements: {
                center: {
                    text: 'A:'+abierto+' | C:'+cerrado,
                    color: '#000000', 
                    fontStyle: 'Arial', 
                    sidePadding: 10, 
                    minFontSize: 13, 
                    lineHeight: 13 
                }
            },
            responsive: true,
            legend: false,
            cutoutPercentage: 70,
            tooltips: {
                enabled: true,
                mode: 'label'   
            }

        }
 
    });
}

//FUNCION PARA OPTENER LOS DATOS Y PINTAR LA GRAFICA DE CALIFICACIÓN DE RIESGO
function CrearGraficoRiesgo(titulo, cantidad, colores, tipo, encabezado, id, textInside, sum){
        var ctx = document.getElementById(id);
        var myChart = new Chart(ctx, {
            type: tipo,
            title: {
                text: titulo,
                backgroundColor: 'none',
                color: '#626262',
                fontSize: '25px'
            },
            data: {
                labels: titulo,
                datasets: [{
                    label:titulo,
                    data: cantidad, 
                    gaugeData: {
                        value: <?php echo $riesgoPromedio; ?>,
                        valueColor: "#626262"
                    },
                    gaugeLimits: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
                    backgroundColor:['rgba(44, 156, 105)',
                                    'rgba(44, 156, 105)',
                                    'rgba(44, 156, 105)',
                                    'rgba(255, 195, 0)',
                                    'rgba(255, 195, 0)',
                                    'rgba(255, 195, 0)',
                                    'rgba(255, 195, 0)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)'],
                    borderWidth: 2              
                }]
            },
            options: {
                circumference: 1 * Math.PI,
                rotation: 1 * Math.PI,
                cutoutPercentage: 85
            }
 
    });
}

//FUNCIONES PARA ASIGNAR COLORES ALEATORIOS A LAS GRAFICAS
function generarNumero(numero){
    return (Math.random()*numero).toFixed(0);
}

function colorRGB(){
    var coolor = "("+generarNumero(7)+"," + generarNumero(156) + "," + generarNumero(188) +")";
    return "rgb" + coolor;
}
 
 //FUNCIONES PARA UTILIZAR LA GRAFICA DE RIESGO ALTO-MEDIO-BAJO
(function () {
	if (!window.Chart) {
		return;
	}
	function GaugeChartHelper() {
	}
	GaugeChartHelper.prototype.setup = function(chart, config) {
		this.chart = chart;
		this.ctx = chart.ctx;
		this.limits = config.data.datasets[0].gaugeLimits;
		this.data = config.data.datasets[0].gaugeData;
		var options = chart.options;
		this.fontSize = options.defaultFontSize;
		this.fontStyle = options.defaultFontFamily;
		this.fontColor = options.defaultFontColor;
		this.ctx.textBaseline = "alphabetic";
		this.arrowAngle = 8 * Math.PI / 180;
		this.arrowColor = config.options.indicatorColor || options.arrowColor;
		this.showMarkers = typeof(config.options.showMarkers) === 'undefined' ? true : config.options.showMarkers;
		if (config.options.markerFormatFn) {
			this.markerFormatFn = config.options.markerFormatFn;
		} else {
			this.markerFormatFn = function(value) {
				return value;
			}
		}
	};
	GaugeChartHelper.prototype.applyGaugeConfig = function(chartConfig) {
		this.calcLimits();
		chartConfig.data.datasets[0].data = this.doughnutData;
		var ctx = this.ctx;
		var labelsWidth = this.limits.map(function(label){
			var text = this.markerFormatFn(label);
			return ctx.measureText(text).width;
		}.bind(this));
		var padding = Math.max.apply(this, labelsWidth) + this.chart.width / 50;
		var heightRatio = this.chart.height / 80;
		chartConfig.options.layout.padding = {
			top: this.fontSize + heightRatio,
			left: padding,
			right: padding,
			bottom: heightRatio * 5
		};
	};
	GaugeChartHelper.prototype.calcLimits = function() {
		var limits = this.limits;
		var data = [];
		var total = 0;
		for (var i = 1, ln = limits.length; i < ln; i++) {
			var dataValue = Math.abs(limits[i] - limits[i - 1]);
			total += dataValue;
			data.push(dataValue);
		}
		this.doughnutData = data;
		var minValue = limits[0];
		var maxValue = limits[limits.length - 1];
		this.isRevers = minValue > maxValue;
		this.minValue = this.isRevers ? maxValue : minValue;
		this.totalValue = total;
	};
	GaugeChartHelper.prototype.updateGaugeDimensions = function() {
		var chartArea = this.chart.chartArea;
		this.gaugeRadius = this.chart.innerRadius;
		this.gaugeCenterX = (chartArea.left + chartArea.right) / 2;
		this.gaugeCenterY = (chartArea.top + chartArea.bottom + this.chart.outerRadius) / 2;
		this.arrowLength = this.chart.radiusLength * 2;
	};
	GaugeChartHelper.prototype.getCoordOnCircle = function(r, alpha) {
		return {
			x: r * Math.cos(alpha),
			y: r * Math.sin(alpha)
		};
	};
	GaugeChartHelper.prototype.getAngleOfValue = function(value) {
		var result = 0;
		var gaugeValue = value - this.minValue;
		if (gaugeValue <= 0) {
			result = 0;
		} else if (gaugeValue >= this.totalValue) {
			result = Math.PI;
		} else {
			result = Math.PI * gaugeValue / this.totalValue;
		}
		if (this.isRevers) {
			return Math.PI - result;
		} else {
			return result;
		}
	};
	GaugeChartHelper.prototype.renderLimitLabel = function(value) {
		var ctx = this.ctx;
		var angle = this.getAngleOfValue(value);
		var coord = this.getCoordOnCircle(this.chart.outerRadius + (this.chart.radiusLength / 2), angle);
		var align;
		var diff = angle - (Math.PI / 1);
		if (diff > 0) {
			align = "left";
		} else if (diff < 0) {
			align = "right";
		} else {
			align = "center";
		}
		ctx.textAlign = align;
		ctx.font = this.fontSize + "px " + this.fontStyle;
		ctx.fillStyle = this.fontColor;
		var text = this.markerFormatFn(value);
		ctx.fillText(text, this.gaugeCenterX - coord.x, this.gaugeCenterY - coord.y);
	};
	GaugeChartHelper.prototype.renderLimits = function() {
		for (var i = 0, ln = this.limits.length; i < ln; i++) {
			this.renderLimitLabel(this.limits[i]);
		}
	};
	GaugeChartHelper.prototype.renderValueLabel = function() {
		var label = this.data.value.toString();
		var ctx = this.ctx;
		ctx.font = "10px " + this.fontStyle;
		var stringWidth = ctx.measureText(label).width;
		var elementWidth = 1 * this.gaugeRadius * 3;
		var widthRatio = elementWidth / stringWidth;
		var newFontSize = Math.floor(2 * widthRatio);
		var fontSizeToUse = Math.min(newFontSize, this.gaugeRadius);
		ctx.textAlign = "center";
		ctx.font = fontSizeToUse + "px " + this.fontStyle;
		ctx.fillStyle = this.data.valueColor || this.fontColor;
		ctx.fillText(label, this.gaugeCenterX, this.gaugeCenterY);
	};
	GaugeChartHelper.prototype.renderValueArrow = function(value) {
		var angle = this.getAngleOfValue(typeof value === "number" ? value : this.data.value);
		this.ctx.globalCompositeOperation = "source-over";
		this.renderArrow(this.gaugeRadius, angle, this.arrowLength, this.arrowAngle, this.arrowColor);
	};
	GaugeChartHelper.prototype.renderSmallValueArrow = function(value) {
		var angle = this.getAngleOfValue(value);
		this.ctx.globalCompositeOperation = "source-over";
		this.renderArrow(this.gaugeRadius - 1, angle, this.arrowLength - 1, this.arrowAngle, this.arrowColor);
	};
	GaugeChartHelper.prototype.clearValueArrow = function(value) {
		var angle = this.getAngleOfValue(value);
		this.ctx.lineWidth = 1;
		this.ctx.globalCompositeOperation = "destination-out";
		this.renderArrow(this.gaugeRadius - 1, angle, this.arrowLength + 1, this.arrowAngle, "#FFFFFF");
		this.ctx.stroke();
	};
	GaugeChartHelper.prototype.renderArrow = function(radius, angle, arrowLength, arrowAngle, arrowColor) {
		var coord = this.getCoordOnCircle(radius, angle);
		var arrowPoint = {
			x: this.gaugeCenterX - coord.x,
			y: this.gaugeCenterY - coord.y
		};
		var ctx = this.ctx;
		ctx.fillStyle = arrowColor;
		ctx.beginPath();
		ctx.moveTo(arrowPoint.x, arrowPoint.y);
		coord = this.getCoordOnCircle(arrowLength, angle + arrowAngle);
		ctx.lineTo(arrowPoint.x + coord.x, arrowPoint.y + coord.y);
		coord = this.getCoordOnCircle(arrowLength, angle - arrowAngle);
		ctx.lineTo(arrowPoint.x + coord.x, arrowPoint.y + coord.y);
		ctx.closePath();
		ctx.fill();
	};
	GaugeChartHelper.prototype.animateArrow = function() {
		var stepCount = 20;
		var animateTimeout = 200;
		var gaugeValue = this.data.value - this.minValue;
		var step = gaugeValue / stepCount;
		var i = 0;
		var currentValue = this.minValue;
		var interval = setInterval(function() {
			i++;
			this.clearValueArrow(currentValue);
			if (i > stepCount) {
				clearInterval(interval);
				this.renderValueArrow();
			} else {
				currentValue += step;
				this.renderSmallValueArrow(currentValue);
			}
		}.bind(this), animateTimeout / stepCount);
	};
	Chart.defaults.tsgauge = {
		animation: {
			animateRotate: true,
			animateScale: true
		},
		cutoutPercentage: 50,
		rotation: Math.PI,
		circumference: Math.PI,
		legend: {
			display: false
		},
		scales: {},
		arrowColor: "#444"
	};
	Chart.controllers.tsgauge = Chart.controllers.doughnut.extend({
		initialize: function(chart) {
			var gaugeHelper = this.gaugeHelper = new GaugeChartHelper();
			gaugeHelper.setup(chart, chart.config);
			gaugeHelper.applyGaugeConfig(chart.config);
			chart.config.options.animation.onComplete = function(chartElement) {
				gaugeHelper.updateGaugeDimensions();
				gaugeHelper.animateArrow();
			};
			Chart.controllers.doughnut.prototype.initialize.apply(this, arguments);
		},
		draw: function() {
			Chart.controllers.doughnut.prototype.draw.apply(this, arguments);
			var gaugeHelper = this.gaugeHelper;
			gaugeHelper.updateGaugeDimensions();
			gaugeHelper.renderValueLabel();
			if (gaugeHelper.showMarkers) {
				gaugeHelper.renderLimits();
			}
			gaugeHelper.renderSmallValueArrow(gaugeHelper.minValue);
		}
	});
})();

//FUNCION QUE ME AYUDA CON EL INGRESO DE LOS VALORES DENTRO DE LOS DIAGRAMAS CIRCULARES
Chart.pluginService.register({
      beforeDraw: function(chart) {
        if (chart.config.options.elements.center) {
          // Get ctx from string
          var ctx = chart.chart.ctx;

          // Get options from the center object in options
          var centerConfig = chart.config.options.elements.center;
          var fontStyle = centerConfig.fontStyle || 'Arial';
          var txt = centerConfig.text;
          var color = centerConfig.color || '#000000';
          var maxFontSize = centerConfig.maxFontSize || 70;
          var sidePadding = centerConfig.sidePadding || 15;
          var sidePaddingCalculated = (sidePadding / 50) * (chart.innerRadius * 2);
          // Start with a base font of 30px
          ctx.font = "55px " + fontStyle;

          // Get the width of the string and also the width of the element minus 10 to give it 5px side padding
          var stringWidth = ctx.measureText(txt).width;
          var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

          // Find out how much the font can grow in width.
          var widthRatio = elementWidth / stringWidth;
          var newFontSize = Math.floor(30 * widthRatio);
          var elementHeight = (chart.innerRadius * 2);

          // Pick a new font size so it will not be larger than the height of label.
          var fontSizeToUse = Math.min(newFontSize, elementHeight, maxFontSize);
          var minFontSize = centerConfig.minFontSize;
          var lineHeight = centerConfig.lineHeight || 25;
          var wrapText = false;

          if (minFontSize === undefined) {
            minFontSize = 20;
          }

          if (minFontSize && fontSizeToUse < minFontSize) {
            fontSizeToUse = minFontSize;
            wrapText = true;
          }

          // Set font settings to draw it correctly.
          ctx.textAlign = 'center';
          ctx.textBaseline = 'middle';
          var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
          var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
          ctx.font = fontSizeToUse + "px " + fontStyle;
          ctx.fillStyle = color;

          if (!wrapText) {
            ctx.fillText(txt, centerX, centerY);
            return;
          }

          var words = txt.split(' ');
          var line = '';
          var lines = [];

          // Break words up into multiple lines if necessary
          for (var n = 0; n < words.length; n++) {
            var testLine = line + words[n] + ' ';
            var metrics = ctx.measureText(testLine);
            var testWidth = metrics.width;
            if (testWidth > elementWidth && n > 0) {
              lines.push(line);
              line = words[n] + ' ';
            } else {
              line = testLine;
            }
          }

          // Move the center up depending on line height and number of lines
          centerY -= (lines.length / 2) * lineHeight;

          for (var n = 0; n < lines.length; n++) {
            ctx.fillText(lines[n], centerX, centerY);
            centerY += lineHeight;
          }
          //Draw text in center
          ctx.fillText(line, centerX, centerY);
        }
      }
    });
    
    
//LIMPIAR CAMPOS DE TUS DATOS 
$("#enviar").on("click", function(ev) {
      document.getElementById("criteriotd").value = 0;
      document.getElementById("documento").value = "";
      document.getElementById("fecha_expedicion").value = "";
 });
 
$("#buscar_tusdatos").on("click", function(e){
   $.ajax({
  xhr: function()
  {
    var xhr = new window.XMLHttpRequest();
    //Upload progress
    xhr.upload.addEventListener("progress-bar", function(evt){
      if (evt.lengthComputable) {
        var percentComplete = evt.loaded / evt.total;
        //Do something with upload progress
        console.log("up", percentComplete);
      }
    }, false);
    //Download progress
    xhr.addEventListener("progress-bar", function(evt){
      if (evt.lengthComputable) {
        var percentComplete = evt.loaded / evt.total;
        //Do something with download progress
        console.log("down", percentComplete);
      }else{
        // the way jsFiddle's ajax echo service works the length
        // is not computable, so just adding this here:
        console.log("down", evt.loaded / 600000);
      }
    }, false);
    return xhr;
  },
  type: 'POST',
  url: "/site/formularioCompliance/",
  data: {json: JSON.stringify(new Array(100000))},
  success: function(data){
      console.log(arguments);
    //Do something success-ish
  }
});
    
});

//BARRA DE PROGRESO TUS DATOS
$("#buscar_tusdatos").on("click", function(ev){

    if ($('#criteriotd').val() == 0) {
        alert('Por Favor, Ingrese un Tipo de Identificación.');
        return false;
    }else if ($('#documento').val().length == 0) {
        alert('Por Favor, Ingrese un número de Identificación.');
        return false;
    }
    /*else if ($('#fecha_tusdatos').val().length == 0) {
        alert('Por Favor, Ingrese una fecha para continuar con el proceso.');
        return false;
    }*/
    
    var percent = 0;
    timerId = setInterval(function() {
        //increment progress bar
        percent += 10;
        $('.progress-bar').css('width', percent+'%');
        $('.progress-bar').attr('aria-valuenow', percent);
        $('.progress-bar').text(percent+'%');
 
        //complete
        if (percent == 100) {
            clearInterval(timerId);
            $('.information').show();
        }
    }, 1000);
  
});
</script>

<?php

