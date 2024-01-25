<?php
$this->breadcrumbs = array(
    'Inicio' => array('user/myPendingReports'),
);

//TOTAL DE ESTUDIOS A TIEMPO
foreach ($productivityonTime as $r) {
    foreach ( $r as $v ) {
        $TotalonTime=$v;
    }
}


//TOTAL DE ESTUDIOS FUERA DE TIEMPO
foreach ($productivityOutofTime as $r) {
    foreach ( $r as $v ) {
        $TotalOutofTime=$v;
    }
}


//TOTAL DE ESTUDIOS CON OPORTUNIDAD
foreach ($opportunityStudies as $r) {
    foreach ( $r as $v ) {
        $TotalOpportunityStudies=$v;
    }
}

//Array Grafica Productividad y Oportunidad
$arrayTotalStudy = [
    ['total' => $TotalonTime],
    ['total' => $TotalOutofTime],
    ['total' => $TotalOpportunityStudies],
    ['total' => "0"],
];
 
//TOTAL DE ESTUDIOS USUARIO
foreach ($totalStudies as $r) {
    foreach ( $r as $v ) {
        $Totalstudy=$v;
    }
}

//PORCENTAGE CALIDAD
foreach ($qualityPorc as $value) {
    $valueSection=$value['valueSection'];
    $valuePQR=$value['valuePQR'];
    $valuePNC=$value['valuePNC'];
}

//TOTAL ESTUDIOS POR SECCION, PQR Y PNC EN CALIDAD
if(!empty($qualityStudies)){
    foreach ($qualityStudies as $datos) {
        $cantStudies=$datos['CantEstudios'];
        //Laboral
        $laboral=$datos['Laboral'];
        $laboralPQR=$datos['LaboralPQR'];
        $laboralPNC=$datos['LaboralPNC'];
        $totalL=$laboral*$valueSection;
        $totalLPQR=$laboralPQR*$valuePQR;
        $totalLPNC=$laboralPNC*$valuePNC;
        $totalLaborar=$totalL+$totalLPQR+$totalLPNC;

        //Academico
        $Academico=$datos['Academico'];
        $AcademicoPQR=$datos['AcademicoPQR'];
        $AcademicoPNC=$datos['AcademicoPNC'];
        $totalAc=$Academico*$valueSection;
        $totalAcPQR=$AcademicoPQR*$valuePQR;
        $totalAcPNC=$AcademicoPNC*$valuePNC;
        $totalAcademico=$totalAc+$totalAcPQR+$totalAcPNC;

        //Financiero
        $Financiero=$datos['Financiero'];
        $FinancieroPQR=$datos['FinancieroPQR'];
        $FinancieroPNC=$datos['FinancieroPNC'];
        $totalFin=$Financiero*$valueSection;
        $totalFinPQR=$FinancieroPQR*$valuePQR;
        $totalFinPNC=$FinancieroPNC*$valuePNC;
        $totalFinanciero=$totalFin+$totalFinPQR+$totalFinPNC;

        //Adverso
        $Adversos=$datos['Adversos'];
        $AdversosPQR=$datos['AdversosPQR'];
        $AdversosPNC=$datos['AdversosPNC'];
        $totalAd=$Adversos*$valueSection;
        $totalAdPQR=$AdversosPQR*$valuePQR;
        $totalAdPNC=$AdversosPNC*$valuePNC;
        $totalAdversos=$totalAd+$totalAdPQR+$totalAdPNC;

        //Visita
        $Visita=$datos['Visita'];
        $VisitaPQR=$datos['VisitaPQR'];
        $VisitaPNC=$datos['VisitaPNC'];
        $totalVis=$Visita*$valueSection;
        $totalVisPQR=$VisitaPQR*$valuePQR;
        $totalVisPNC=$VisitaPNC*$valuePNC;
        $totalVisita=$totalVis+$totalVisPQR+$totalVisPNC;

        //Poligrafo
        $Poligrafo=$datos['Poligrafo'];
        $PoligrafoPQR=$datos['PoligrafoPQR'];
        $PoligrafoPNC=$datos['PoligrafoPNC'];
        $totalPlg=$Poligrafo*$valueSection;
        $totalPlgPQR=$PoligrafoPQR*$valuePQR;
        $totalPlgPNC=$PoligrafoPNC*$valuePNC;
        $totalPoligrafo=$totalPlg+$totalPlgPQR+$totalPlgPNC;

        //Pruebas Psicotecnicas
        $Prueba=$datos['Pruebas_Psicotecnicas'];
        $PruebaPQR=$datos['PruebaPQR'];
        $PruebaPNC=$datos['PruebaPNC'];
        $totalPr=$Prueba*$valueSection;
        $totalPrPQR=$PruebaPQR*$valuePQR;
        $totalPrPNC=$PruebaPNC*$valuePNC;
        $totalPrueba=$totalPr+$totalPrPQR+$totalPrPNC;

        //Referencias 
        $Referencias=$datos['Reference'];
        $ReferenciasPQR=$datos['ReferencePQR'];
        $ReferenciasPNC=$datos['ReferencePNC'];
        $totalRef=$Referencias*$valueSection;
        $totalRefPQR=$ReferenciasPQR*$valuePQR;
        $totalRefPNC=$ReferenciasPNC*$valuePNC;
        $totalReferencias=$totalRef+$totalRefPQR+$totalRefPNC;

        $totalPorc=$totalLaborar+$totalAcademico+$totalFinanciero+$totalAdversos+$totalVisita+$totalPoligrafo+$totalPrueba+$totalReferencias;
        $totalRiegoProc=100-$totalPorc;
        $riesgoPromedio= round($totalRiegoProc, 1);
    }
}else{
    $cantStudies=0;
    //Laboral
    $laboral=0;
    $laboralPNC=0;
    $laboralPQR=0;
    $totalLaborar=0;
    //Academico
    $Academico=0;
    $AcademicoPQR=0;
    $AcademicoPNC=0;
    $totalAcademico=0;
    //Financiero
    $Financiero=0;
    $FinancieroPQR=0;
    $FinancieroPNC=0;
    $totalFinanciero=0;
    //Adverso
    $Adversos=0;
    $AdversosPQR=0;
    $AdversosPNC=0;
    $totalAdversos=0;
    //Visita
    $Visita=0;
    $VisitaPQR=0;
    $VisitaPNC=0;
    $totalVisita=0;
    //Poligrafo
    $Poligrafo=0;
    $PoligrafoPQR=0;
    $PoligrafoPNC=0;
    $totalPoligrafo=0;
    //Pruebas Psicotecnicas
    $Prueba=0;
    $PruebaPQR=0;
    $PruebaPNC=0;
    $totalPrueba=0;
    //Referencias
    $Referencias=0;
    $ReferenciasPQR=0;
    $ReferenciasPNC=0;
    $totalReferencias=0;

    $totalPorc=0;
    $riesgoPromedio=100;
}

//Array Riesgo Calidad
$arrayQualityRiesg = [
    ['titulo' => 'Calificación Calidad', 'total' => $totalPorc],
];

if($Totalstudy==0){
    $cumplimientoOportunidad=0;
}else{
    $cumplimientoOportunidad=round(($TotalonTime*100/$Totalstudy), 2);
}

if($goaluser==0){
    $meta=0;
    $pendientes=0;
}else{
    $meta=round(($Totalstudy*100/$goaluser), 2);
    $pendientes=$goaluser-$Totalstudy;
}

if($cumplimientoOportunidad<=85){
    $colorcumplimientoOp="#C62F29";
}else if($cumplimientoOportunidad>85 && $cumplimientoOportunidad<=95){
    $colorcumplimientoOp="#FFC300";
}else{
    $colorcumplimientoOp="#2C9C69";
}

if($meta<=85){
    $colormeta="#C62F29";
}else if($meta>85 && $meta<=95){
    $colormeta="#FFC300";
}else{
    $colormeta="#2C9C69";
}

if($pendientes<0){
    $colorPend="#2C9C69";
}else{
    $colorPend="#C62F29";
}
?>

<?php //if(Yii::app()->user->name=='nhenao@sintecto.com'):?>
<h1>Resultados Funcionari@: <?php echo Yii::app()->user->arUser->name ?> (<?php echo Yii::app()->user->name ?>)</h1>
<fieldset>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            
            <!-- LIBRERIAS Bootstrap CSS && ChartJS -->
            <link rel="stylesheet" href="../../css/Chart.css">
            <link rel="stylesheet" href="../../css/Bootstrap.css">
            <!--<link rel="stylesheet" href="../../datatables.min.css">-->
        </head>

        <body>
            <form method="POST" action="/user/myPendingReports" class="">
                <div style="padding-top: 2px;" class="information" style="display:none;">
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
                                    <label form=""></label>
                                    <button class="btn btn-primary" id="enviar">ENVIAR</button>
                                </div> 

                            </div>
                        </div>
                    </div> 
                    <br>
                <div>
                <div class="card" >
                    <div class="card-body">
                        <div class="row g-2">  
                            <div style="padding-left:5px;" class="col-md-3"> 
                                <center><label  form=""><b>PRODUCTIVIDAD Y OPORTUNIDAD</b></label></center> 
                                <canvas id="GraficoProductivityandOpportunity" width="400" height="250"></canvas> 
                            </div>

                            <div style="padding-top:60px; padding-left:1px;" class="col-lg-1">  
                                <table id="resultstudy" border="2" class="table-striped">
                                    <thead class="table-primary"> 
                                        <th with="60%"><center>TÍTULO</center></th> 
                                        <th with="20%"><center>CANTIDAD</center></th> 
                                    </thead> 
                                    <tbody>
                                        <tr>
                                            <td>Productividad a tiempo</td>
                                            <td><center><b><?php echo $TotalonTime ?></b></center></td>
                                        </tr>
                                        <tr>
                                            <td>Productividad fuera de tiempo</td>
                                            <td><center><b><?php echo $TotalOutofTime ?></b></center></td>
                                        </tr>
                                        <tr>
                                            <td>Oportunidad</td>
                                            <td><center><b><?php echo $TotalOpportunityStudies ?></b></center></td>
                                        </tr>
                                    </tbody> 
                                </table>    
                            </div>

                            <div style="padding-top:80px;  padding-left:49px;">
                                <div>
                                    <div class="cardTotal text-dark bg-light mx-3" style="max-width: 20rem;">
                                        <div class="card-body">
                                            <p class="card-text"><center><b>TOTAL<br>ESTUDIOS<h1><p style="color:#0277BC";><?php echo $Totalstudy; ?></p></h1></b></center></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3" style="padding-left:1px;">
                                <center><label  form=""><b>CALIFICACIÓN DE CALIDAD</b></label></center>
                                <canvas id="GraficodoughnutRiesgo" width="420" height="260"></canvas> 
                            </div>

                            <div style="padding-top:5px; padding-left:1px;" class="col-lg-3">  
                                <table id="resultstudy" border="1" class="table-striped">
                                    <thead class="table-primary"> 
                                        <th with="60%"><center>SECCIONES</center></th> 
                                        <th with="20%"><center>CANTIDAD <?php echo $valueSection; ?></center></th> 
                                        <th with="20%"><center>PQR <?php echo $valuePQR; ?></center></th> 
                                        <th with="20%"><center>PNC <?php echo $valuePNC; ?></center></th> 
                                        <th with="30%"><center>TOTAL %</center></th> 
                                    </thead> 
                                    <tbody>
                                        <tr>
                                            <td form="" style='text-decoration: underline' id="<?php echo "Laboral" ?>" data-toggle="modal" data-target="#staticBackdropQuality" class="secc_resultQualitySection" data-descr="<?php echo htmlentities("Laboral"); ?>"><font color ="#0277BC"><b>Laboral<b></font></td>
                                            <td><center><?php echo $laboral; ?></center></td>
                                            <td><center><?php echo $laboralPQR; ?></center></td>
                                            <td><center><?php echo $laboralPNC; ?></center></td>
                                            <td><center><?php echo $totalLaborar; ?></center></td>
                                        </tr>
                                        <tr>
                                            <td form="" style='text-decoration: underline' id="<?php echo "Académico" ?>" data-toggle="modal" data-target="#staticBackdropQuality" class="secc_resultQualitySection" data-descr="<?php echo htmlentities("Académico"); ?>"><font color ="#0277BC"><b>Académico<b></font></td>
                                            <td><center><?php echo $Academico; ?></center></td>
                                            <td><center><?php echo $AcademicoPQR; ?></center></td>
                                            <td><center><?php echo $AcademicoPNC; ?></center></td>
                                            <td><center><?php echo $totalAcademico; ?></center></td>
                                        </tr>
                                        <tr>
                                            <td form="" style='text-decoration: underline' id="<?php echo "Financiero" ?>" data-toggle="modal" data-target="#staticBackdropQuality" class="secc_resultQualitySection" data-descr="<?php echo htmlentities("Financiero"); ?>"><font color ="#0277BC"><b>Financiero<b></font></td>
                                            <td><center><?php echo $Financiero; ?></center></td>
                                            <td><center><?php echo $FinancieroPQR; ?></center></td>
                                            <td><center><?php echo $FinancieroPNC; ?></center></td>
                                            <td><center><?php echo $totalFinanciero; ?></center></td>
                                        </tr>
                                        <tr>
                                            <td form="" style='text-decoration: underline' id="<?php echo "Adversos" ?>" data-toggle="modal" data-target="#staticBackdropQuality" class="secc_resultQualitySection" data-descr="<?php echo htmlentities("Adversos"); ?>"><font color ="#0277BC"><b>Adversos<b></font></td>
                                            <td><center><?php echo $Adversos; ?></center></td>
                                            <td><center><?php echo $AdversosPQR; ?></center></td>
                                            <td><center><?php echo $AdversosPNC; ?></center></td>
                                            <td><center><?php echo $totalAdversos; ?></center></td>
                                        </tr>
                                        <tr>
                                            <td form="" style='text-decoration: underline' id="<?php echo "Personas en la Vivienda" ?>" data-toggle="modal" data-target="#staticBackdropQuality" class="secc_resultQualitySection" data-descr="<?php echo htmlentities("Personas en la Vivienda"); ?>"><font color ="#0277BC"><b>Visita<b></font></td>
                                            <td><center><?php echo $Visita; ?></center></td>
                                            <td><center><?php echo $VisitaPQR; ?></center></td>
                                            <td><center><?php echo $VisitaPNC; ?></center></td>
                                            <td><center><?php echo $totalVisita; ?></center></td>
                                        </tr>
                                        <tr>
                                            <td form="" style='text-decoration: underline' id="<?php echo "Polígrafo" ?>" data-toggle="modal" data-target="#staticBackdropQuality" class="secc_resultQualitySection" data-descr="<?php echo htmlentities("Polígrafo"); ?>"><font color ="#0277BC"><b>Polígrafo<b></font></td>
                                            <td><center><?php echo $Poligrafo; ?></center></td>
                                            <td><center><?php echo $PoligrafoPQR; ?></center></td>
                                            <td><center><?php echo $PoligrafoPNC; ?></center></td>
                                            <td><center><?php echo $totalPoligrafo; ?></center></td>
                                        </tr>
                                        <tr>
                                            <td form="" style='text-decoration: underline' id="<?php echo "Pruebas Psicotécnicas" ?>" data-toggle="modal" data-target="#staticBackdropQuality" class="secc_resultQualitySection" data-descr="<?php echo htmlentities("Pruebas Psicotécnicas"); ?>"><font color ="#0277BC"><b>Pruebas Psicotécnicas<b></font></td>
                                            <td><center><?php echo $Prueba; ?></center></td>
                                            <td><center><?php echo $PruebaPQR; ?></center></td>
                                            <td><center><?php echo $PruebaPNC; ?></center></td>
                                            <td><center><?php echo $totalPrueba; ?></center></td>
                                        </tr>
                                        <tr>
                                            <td form="" style='text-decoration: underline' id="<?php echo "Referencias" ?>" data-toggle="modal" data-target="#staticBackdropQuality" class="secc_resultQualitySection" data-descr="<?php echo htmlentities("Referencias"); ?>"><font color ="#0277BC"><b>Referencias<b></font></td>
                                            <td><center><?php echo $Referencias; ?></center></td>
                                            <td><center><?php echo $ReferenciasPQR; ?></center></td>
                                            <td><center><?php echo $ReferenciasPNC; ?></center></td>
                                            <td><center><?php echo $totalReferencias; ?></center></td>
                                        </tr>
                                        <tr>
                                            <td><left>ESTUDIOS AFECTADOS</left></td>
                                            <td><b><h2><?php echo $cantStudies; ?></h2></b></td>
                                            <td></td>
                                            <td></td>
                                            <td><center><b><?php echo round($totalPorc,1); ?></b></center></td>
                                        </tr>
                                    </tbody> 
                                </table>    
                            </div>

                            <div style="padding-left:30px;" class="col-lg-3">  
                            <center><label  form=""><b>PORCENTAJE CUMPLIDO POR PRODUCTIVIDAD</b></label></center>
                                <table id="resultstudy" border="2" class="table-striped">
                                    <thead class="table-primary"> 
                                        <th with="30%"><center>Meta</center></th> 
                                        <th with="60%"><center>Procesos Finalizados</center></th>
                                        <th with="60%"><center>% de Cumplimiento</center></th>  
                                    </thead> 
                                    <tbody>
                                        <tr>
                                            <td><center><?php echo $goaluser; ?></center></td>
                                            <td><center><?php echo $Totalstudy; ?></center></td>
                                            <td bgcolor=<?php echo $colormeta; ?>><center><FONT COLOR="FDFDFD"><b><?php echo $meta; ?>%</b></FONT></center></td>
                                        </tr>
                                    </tbody> 
                                </table>    
                            </div>

                            <div style="padding-left:40px;" class="col-lg-4">  
                            <center><label  form=""><b>PORCENTAJE CUMPLIDO POR OPORTUNIDAD</b></label></center>
                                <table id="resultstudy" border="2" class="table-striped">
                                    <thead class="table-primary"> 
                                        <th with="30%"><center>Procesos Finalizados</center></th> 
                                        <th with="60%"><center>Procesos en Tiempo</center></th>
                                        <th with="60%"><center>% de Cumplimiento</center></th>  
                                    </thead> 
                                    <tbody>
                                        <tr>
                                            <td><center><?php echo $Totalstudy; ?></center></td>
                                            <td><center><?php echo $TotalonTime; ?></center></td>
                                            <td bgcolor=<?php echo $colorcumplimientoOp; ?>><center><FONT COLOR="FDFDFD"><b><?php echo $cumplimientoOportunidad; ?>%</b></FONT></center></td>
                                        </tr>
                                    </tbody> 
                                </table>    
                            </div>

                            <div style="padding-top:5px;  padding-left:10px;">
                                <div class="cardTotal text-dark bg-light mx-2" style="max-width: 20rem;">
                                    <div class="card-body">
                                    <p class="card-text"><center><b>ESTUDIOS PENDIENTES PARA LA META<h1><p style="color:<?php echo $colorPend; ?>";><?php echo $pendientes; ?></p></h1></b></center></p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>  
            </div>
            </div>
            </form>
        </body>
    </html>
</fieldset>
<?php //endif ?>

<?php if(Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))):?>
  
  <h1>Listado de Reportes Urgentes : <?php echo Yii::app()->user->arUser->name ?> (<?php echo Yii::app()->user->name ?>)</h1>
  
  <div class="SvpTable" >
      <table>
          <tr>
              <th>Cliente</th>
              <th>Código</th>
              <th>Nombre</th>            
              <th>Fécha límite</th>
              <th>Comentario Cliente</th>
  
  
          </tr>
          
          <?php foreach ($pendingUrgents as $pendingUrgent): ?>
          <?php /* @var $userAssigment UserAssigment */?>
           <tr <?php // echo ($pendingUrgent->isDelayed?"class='delayed'":"")?>>
                  <td><?php echo CHtml::encode($pendingUrgent->customer->name)?></td>
                  <td><?php echo CHtml::link($pendingUrgent->code,array('backgroundCheck/update','code'=>$pendingUrgent->code))?></td>
                  <td><?php echo CHtml::link($pendingUrgent->fullname,array('backgroundCheck/update','code'=>$pendingUrgent->code))?></td>
                  <td><?php echo CHtml::encode($pendingUrgent->studyLimitOn)?></td>
                  <td><?php echo CHtml::encode($pendingUrgent->observationToCustomer)?></td>
  
              </tr>
          <?php endforeach; ?>
      </table>
  </div>
  
  <?php endif?>

<h1>Reportes pendientes de  : <?php echo Yii::app()->user->arUser->name ?> (<?php echo Yii::app()->user->name ?>)</h1>

<div class="SvpTable" >
    <table>
        <tr>
            <th>Cliente</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Sección</th>
            <th>Fécha límite</th>
            <th>Plazo</th>
        </tr>
        
        <?php foreach ($pendingAssigments as $userAssigment): ?>
        <?php /* @var $userAssigment UserAssigment */?>
            <tr <?php echo ($userAssigment->isDelayed?"class='delayed'":"")?>>
                <td><?php echo CHtml::encode($userAssigment->backgroundCheck->customer->name)?></td>
                <td><?php echo CHtml::link($userAssigment->backgroundCheck->code,array('backgroundCheck/update','code'=>$userAssigment->backgroundCheck->code))?></td>
                <td><?php echo CHtml::link($userAssigment->backgroundCheck->fullname,array('backgroundCheck/update','code'=>$userAssigment->backgroundCheck->code))?></td>
                <td><?php echo CHtml::encode($userAssigment->userRole->name)?></td>
                <td><?php echo CHtml::encode($userAssigment->verificationSection?$userAssigment->verificationSection->sectionName:"")?></td>
                <td><?php echo CHtml::encode($userAssigment->limit)?></td>
                <td><?php echo CHtml::encode($userAssigment->timeLeft)?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<!--VENTANA MODAL SECCIONES CALIDAD-->
<div class="modal fade" id="staticBackdropQuality" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">DETALLADO DE CALIDAD POR SECCIÓN</h5>
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
                    <table id="detailresultqualitySection" cellspacing="0" style="width: 100%;" class="table table-sm table-striped table-hover table-bordered">
                        <input type="hidden" name="pkId" id="pkId" value=""/>
                        <thead class="table-primary"> 
                            <th>Empresa</th> 
                            <th>Referencia</th> 
                            <th>Cantidad</th> 
                            <th>PQR</th> 
                            <th>PNC</th> 
                            <th>Comentario</th> 
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

<script src="../../mantenimiento/js/jquery-3.5.1.min.js"></script>
<script src="../../mantenimiento/js/bootstrap.min.js"></script>
<script src="../../mantenimiento/js/Chart.min.js"></script>
<script src="../../mantenimiento/js/Chart.bundle.min.js"></script>
<!--<script src="../../mantenimiento/js/datatables.min.js"></script>-->

<script type="text/javascript">


//carga en la ventana modal de los resultados de Seccion de Calidad
$(document).on('click', '.secc_resultQualitySection', function () {
    
    $('#detailresultqualitySection > tbody').empty();

    var result = $(this).attr('id');
    $('#resulteval').val(result);
    var name = $(this).attr('data-descr');
    $('#pkId').val(name);

    alert("Si la sección cuenta con estudios, por favor espere un momento que cargue el detalle.");
    
    $.ajax({
    type:'POST',
    url: "/user/detailresultquality.html",
    dataType: "json",
    data: { 
        'from':  $('#Desde').val(),
        'until':  $('#Hasta').val(),
        'id' : name,
    },
    context: document.body
    }).done(function(resp) {
        $( this ).addClass( "Detailresultquality" );
        console.log(resp);
    if(resp.length>0){
            var data = resp; 

            var descr =$("input#bookId").val();
            for(var i=0; i<data.length; i++)
            {
                if(name=="Laboral"){
                    var tblRow = "<tr>" + 
                    "<td>" + data[i]["nombre"] + "</td>" + 
                    "<td>" + data[i]["code"] + "</td>" + 
                    "<td>" + data[i]["Laboral"] + "</td>" + 
                    "<td>" + data[i]["LaboralPQR"] + "</td>" + 
                    "<td>" + data[i]["LaboralPNC"]+ "</td>" + 
                    "<td>" + data[i]["qualitytextLaboral"]+ "</td>" + 
                    "</tr>" 
                }
                else if(name=="Académico"){
                    var tblRow = "<tr>" + 
                    "<td>" + data[i]["nombre"] + "</td>" + 
                    "<td>" + data[i]["code"] + "</td>" + 
                    "<td>" + data[i]["Academico"] + "</td>" + 
                    "<td>" + data[i]["AcademicoPQR"] + "</td>" + 
                    "<td>" + data[i]["AcademicoPNC"]+ "</td>" + 
                    "<td>" + data[i]["qualitytextEducation"]+ "</td>" + 
                    "</tr>" 
                }

                else if(name=="Financiero"){
                    var tblRow = "<tr>" + 
                    "<td>" + data[i]["nombre"] + "</td>" + 
                    "<td>" + data[i]["code"] + "</td>" + 
                    "<td>" + data[i]["Financiero"] + "</td>" + 
                    "<td>" + data[i]["FinancieroPQR"] + "</td>" + 
                    "<td>" + data[i]["FinancieroPNC"]+ "</td>" + 
                    "<td>" + data[i]["qualitytextFinancial"]+ "</td>" + 
                    "</tr>" 
                }

                else if(name=="Adversos"){
                    var tblRow = "<tr>" + 
                    "<td>" + data[i]["nombre"] + "</td>" + 
                    "<td>" + data[i]["code"] + "</td>" + 
                    "<td>" + data[i]["Adversos"] + "</td>" + 
                    "<td>" + data[i]["AdversosPQR"] + "</td>" + 
                    "<td>" + data[i]["AdversosPNC"]+ "</td>" + 
                    "<td>" + data[i]["qualitytextAdverse"]+ "</td>" + 
                    "</tr>" 
                }

                else if(name=="Personas en la Vivienda"){
                    var tblRow = "<tr>" + 
                    "<td>" + data[i]["nombre"] + "</td>" + 
                    "<td>" + data[i]["code"] + "</td>" + 
                    "<td>" + data[i]["Visita"] + "</td>" + 
                    "<td>" + data[i]["VisitaPQR"] + "</td>" + 
                    "<td>" + data[i]["VisitaPNC"]+ "</td>" + 
                    "<td>" + data[i]["qualitytextVisit"]+ "</td>" + 
                    "</tr>"
                } 

                else if(name=="Polígrafo"){
                    var tblRow = "<tr>" + 
                    "<td>" + data[i]["nombre"] + "</td>" + 
                    "<td>" + data[i]["code"] + "</td>" + 
                    "<td>" + data[i]["Poligrafo"] + "</td>" + 
                    "<td>" + data[i]["PoligrafoPQR"] + "</td>" + 
                    "<td>" + data[i]["PoligrafoPNC"]+ "</td>" + 
                    "<td>" + data[i]["qualitytextPolygraph"]+ "</td>" + 
                    "</tr>" 
                } 

                else if(name=="Pruebas Psicotécnicas"){
                    var tblRow = "<tr>" + 
                    "<td>" + data[i]["nombre"] + "</td>" + 
                    "<td>" + data[i]["code"] + "</td>" + 
                    "<td>" + data[i]["Pruebas_Psicotecnicas"] + "</td>" + 
                    "<td>" + data[i]["PruebaPQR"] + "</td>" + 
                    "<td>" + data[i]["PruebaPNC"]+ "</td>" + 
                    "<td>" + data[i]["qualitytextTest"]+ "</td>" + 
                    "</tr>" 
                } 

                else if(name=="Referencias"){
                    var tblRow = "<tr>" + 
                    "<td>" + data[i]["nombre"] + "</td>" + 
                    "<td><a href='/backgroundCheck/update.html?code=" + data[i]["code"] + "'>" + data[i]["code"]+ "</a></td>" + 
                    "<td>" + data[i]["Reference"] + "</td>" + 
                    "<td>" + data[i]["ReferencePQR"] + "</td>" + 
                    "<td>" + data[i]["ReferencePNC"]+ "</td>" + 
                    "<td>" + data[i]["qualitytextReference"]+ "</td>" + 
                    "</tr>" 
                } 

                $(tblRow).appendTo("#detailresultqualitySection tbody");
            }               
        }
    });

});

//CREAR LOS GRAFICOS DE LA VISTA 
crear_grafico();


function crear_grafico(){
    $(document).ready(function(resp) {
        ////INICIO ESTUDIOS EN ESTE PERIODO///
        //pinta el grafico de Colaboradores
        if(resp.length>0){
            var cantidad = [];
            var data =  <?php echo json_encode($arrayTotalStudy) ?>;

            for(var i=0; i<data.length; i++){
                cantidad.push(data[i]["total"]);
            }
            CrearGrafico('', cantidad, '', 'bar', ' ','GraficoProductivityandOpportunity', '');
        }
        ////FIN ESTUDIOS EN ESTE PERIODO///

          //Pinte el grafico de CALIFICACIÓN DE RIESGO CALIDAD
          if(resp.length>0){
            var titulo =[];
            var cantidad = [];
            var data =  <?php echo json_encode($arrayQualityRiesg) ?>;

            for(var i=0; i<data.length; i++){
                titulo.push(data[i]["titulo"]);
                cantidad.push(data[i]["cantidad"]);
            }
            CrearGraficoRiesgo(titulo, cantidad, '', 'tsgauge', ' ','GraficodoughnutRiesgo', '', '');
        }
    });
}

function CrearGrafico(titulo, cantidad, colores, tipo, encabezado, id, textInside){
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
            labels: ["A Tiempo","Fuera de Teimpo","Oportunidad"],
            datasets: [{
                label: 'Resultado de Productividad y Oportunidad',
                data: cantidad,          
                backgroundColor:['#0277BC',
                                '#8F2000',
                                '#3A8002'],
                hoverBackgroundColor:['#0277BC',
                                '#8F2000',
                                '#3A8002']           
            }]
        },
        options: {
            animation: {
                duration: 500,
                easing: "easeOutQuart",
                onComplete: function () {
                    var ctx = this.chart.ctx;
                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'top';
                    ctx.font='20px Arial';
  
                    this.data.datasets.forEach(function (dataset) {
                        for (var i = 0; i < dataset.data.length; i++) {
                            var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                            ctx.fillStyle = '#ECECEC';
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


//FUNCION PARA OPTENER LOS DATOS Y PINTAR LA GRAFICA DE CALIFICACIÓN DE RIESGO CALIDAD
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
                    gaugeLimits: [0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100],
                    backgroundColor:['rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(198, 47, 41)',
                                    'rgba(255, 195, 0)',
                                    'rgba(255, 195, 0)',
                                    'rgba(44, 156, 105)'],
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

 //FUNCIONES PARA UTILIZAR LA GRAFICA DE RIESGO CALIDAD
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

</script>