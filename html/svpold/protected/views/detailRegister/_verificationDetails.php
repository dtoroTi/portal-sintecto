<?php  

Yii::app()->clientScript->registerScript('search', "
$('.WithoutAnnotation').click(function(){
        var comments=$('#verificationSection_" . $verificationSection->id . "_comments');
        if (comments){
          comments.val('" . DetailRegister::WITHOUT_ADVERSE . "');
          $(this).parents('form:first').submit();          
        }
	return false;
});

$('.WithAnnotation').click(function(){
        var comments=$('#verificationSection_" . $verificationSection->id . "_comments');
        if (comments && confirm('Esta seguro que presenta adversos?')){
          comments.val('" . DetailRegister::WITH_ADVERSE . "');
          $(this).parents('form:first').submit();
        }
	return false;
});

function retryTusDatos(jobid,rid, tid){
    alert('Refrescando la búsqueda');
    $('#infoTusDatos').attr('src','/detailRegister/testAPI?retry=1&jid='+jobId+'&rid='+rid+'&tid='+tid+'');
}

");

?>
<?php
  if($verificationSection->backgroundCheck->customerProduct->isTusDatos==1){
    $validateTD='Tus Datos, ';
  }else{
    $validateTD='';
  };

  if($verificationSection->backgroundCheck->customerProduct->isWC==1){
    $validateWC='WC, ';
  }else{
    $validateWC='';
  };

  if($verificationSection->backgroundCheck->customerProduct->isSico==1){
    $validateSico='Sico, ';
  }else{
    $validateSico='';
  };

  if($verificationSection->backgroundCheck->customerProduct->isRamaUnif==1){
    $validateRU='Rama Unificada, ';
  }else{
    $validateRU='';
  };

  if($verificationSection->backgroundCheck->customerProduct->isMediosAbrt==1){
    $validateMA='Medios Abiertos, ';
  }else{
    $validateMA='';
  };

  if($verificationSection->backgroundCheck->customerProduct->isJurad==1){
    $validateJ='Jurad, ';
  }else{
    $validateJ='';
  };

  if($verificationSection->backgroundCheck->customerProduct->isTusDatos==1 || $verificationSection->backgroundCheck->customerProduct->isWC==1 || $verificationSection->backgroundCheck->customerProduct->isSico==1 || $verificationSection->backgroundCheck->customerProduct->isRamaUnif==1 || $verificationSection->backgroundCheck->customerProduct->isMediosAbrt==1 || $verificationSection->backgroundCheck->customerProduct->isJurad==1){
  ?>
    <div class="flash-error">
      <b>Requisitos Validación Adversos:</b><br>
      <?php echo $validateTD.$validateWC.$validateSico.$validateRU.$validateMA.$validateJ; ?>
    </div> 
  <?php
  }
?>

<?php echo CHtml::button('Sin Adversos',array('submit' => array('detailRegister/comentAdvs', 'idSection'=>$verificationSection->id, 'val'=>'0'), 'class'=>'WithoutAdverse')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<?php echo CHtml::button('Con Adversos',array('submit' => array('detailRegister/comentAdvs', 'idSection'=>$verificationSection->id, 'val'=>'1'),'class'=>'WithAdverse')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<?php
  $id = $verificationSection->backgroundCheck->id;
  $idNumber = $verificationSection->backgroundCheck->idNumber;
?>

<?php //echo CHtml::button('Consulta tus Datos', array('onclick' => 'sendtusDatos("'.$id.'", "'.$idNumber.'");')); ?> 

<div class="SvpTable" style="">
   <?php foreach ($verificationSection->detailRegisters as $register): ?>
    <?php
    echo $this->renderPartial('/detailRegister/_verificationDetail', array(
        'verificationSection' => $verificationSection,
        'register' => $register,
    ));
    ?>
  <?php endforeach; ?>
  <?php
  if ($verificationSection->backgroundCheck->canUpdate){
    $register = new DetailRegister();
  }
  ?>
  
<div class="SvpTable" style="">
  <h1>Consultar información de Tus Datos</h1>

<div id="service-status">
</div>

<?php

if ($verificationSection->backgroundCheck->studyStartedOn>='2021-07-27'){

    //include 'tus-datos-api/testapi.php';
    Yii::import('application.extensions.TusDatos.*');

    $results_url = URLRESULTSTUSDATOS;
    $report_url = URLREPORTTUSDATOS;
    $username = USRTUSDATOS;
    $password = PWTUSDATOS;

    $id = $verificationSection->backgroundCheck->id;//isset($_GET['code'])?$_GET['code']:"";
    $idNumber = $verificationSection->backgroundCheck->idNumber;//isset($_GET['id'])?$_GET['id']:"";
    $tusdatosresp = TusDatosResponse::model()->find("backgroundcheckId='$id'");

   if($tusdatosresp && $tusdatosresp->status == 'PENDING'){
?>
    <button id="tus-datos-manual" name = "tus-datos-manual" value="view_manual">Ejecutar Manualmente</button>
    <br><br>
<?php

    Yii::app()->clientScript->registerScript('search', "
      $('#tus-datos-manual').click(function(){    
          let text = 'Esta seguro de ejecutar de forma manual?';
          if (confirm(text) == true) {
            event.preventDefault();

            alert('El sistema tarda un momento para generar una respuesta, por favor espere.');
            
            $.ajax({

              type: 'GET',

              url: '/detailRegister/TestAPI?bckid=".$id."',

              data: $(this).serialize(),

            }).done(function(data) {

                  alert('Solicitud enviada');
                  location.reload();

            });
          } else {
          }

      });

      ");   

    }

    //$numero = intval(preg_replace('/[^0-9]+/', '', $idNumber), 10); 
    $toreplace = array("/", " ", "\\", "*", "CE", "NIT", "PEP", "PPT", "PP");
    $numero = str_replace($toreplace, "", $idNumber);
    $name=$numero.'_tusDatos';

    $criteria = new CDbCriteria;
    $criteria->addCondition('t.backgroundCheckId=:backgroundCheckId');
    $criteria->addCondition("t.name=:namedoc");
    $criteria->params=[':backgroundCheckId'=>$id, ':namedoc'=>$name];
    $documents = Document::model()->findAll($criteria);
    
    if($documents){
      foreach ($documents as $document){
        //echo 'Nombre del Documento: '.$document->name."<br>";
        //echo 'Nombre TD: '.$numero.'_tusDatos'."<br>";
        if($document->name==$name){
          //echo 'entro....';
          $iddoc=$document->id;
          $src=Yii::app()->params['urlAccesApi']['url']."/document/file/$iddoc.html";
        }else{
          $src="";
        }
      }
    }else{
      $src="";
    }
    
    if(!$tusdatosresp)
    {
      echo '<h2>No se genero la vista, porque no esta registrado para ser consultado en Tus Datos.</h2>';
    }else if($tusdatosresp->status == 'PENDING') //(is_null($tusdatosresp) || $tusdatosresp->idNumber != $idNumber) ||  
    {
      echo '<h2>Su estudio se encuentra en estado pendiente. Este se generará 4 horas después de creado. Vuelva a consultar luego.</h2>';
    }else if($tusdatosresp->status == 'PROCESSING') //(is_null($tusdatosresp) || $tusdatosresp->idNumber != $idNumber) ||  
    {
      echo '<h2>Su estudio se encuentra en proceso en la plataforma tus datos. Este se generará en unos minutos. Vuelva a consultar luego.</h2>';
    }else if($src==""){
      echo '<h2>No se genero la Vista.</h2>';
    }else if($src!=""){

      $jobId = $tusdatosresp->idTusDatos;
      $reportId = $tusdatosresp->idReport;

      /*if(stristr($tusdatosresp->idNumber, 'CE') !==false || stristr($tusdatosresp->idNumber, 'PEP') !==false || stristr($tusdatosresp->idNumber, 'NIT') !==false || stristr($tusdatosresp->idNumber, 'PP') !==false){*/

            $type = "";
            $number = "";
            if (stristr($tusdatosresp->idNumber, 'CE') !== false) {

              $type = 'CE';
              $number = substr($tusdatosresp->idNumber, 2);
              $force = false;
            } else if (stristr($tusdatosresp->idNumber, 'PEP') !== false) {
  
              $type = 'PEP';
              $number = substr($tusdatosresp->idNumber, 3);
              $force = false;
            } else if (stristr($tusdatosresp->idNumber, 'PP') !== false) {
  
              $type = 'PP';
              $number = substr($tusdatosresp->idNumber, 2);
              $force = false;
  
            } else if (stristr($tusdatosresp->idNumber, 'NIT') !== false) {
  
              $type = 'NIT';
              $number = substr($tusdatosresp->idNumber, 3);
              $force = false;
            } else {
              $type = 'CC';
              $number = $tusdatosresp->idNumber;
              $force = true;
            }

            if(empty($type) || empty($number)){
                  echo 'ocurrio un error tipo de documento no valido \n';
    
            }else{
                echo '<button id="tus-datos-retry" name = "tus-datos-retry" value = "retry">Refrescar</button> ';
                
                ?>
                <input type="button" name="view_TD" id="view_TD" value="Vista" onclick="toggleIfrm('apDiv1')" />
                <div id="apDiv1" style="visibility:hidden">
 
                <iframe id="viewsTusDatos" src="<?= $src ?>" style="border:none; width: 100%; height: 500px;">
                </iframe>
                </div>
                <?php
         
                //echo '<iframe id="infoTusDatos" src = "https://135.148.162.42:2443/document/file/350.html" style="border:none; width: 100%; height: 1200px;"></iframe>';

                  Yii::app()->clientScript->registerScript('search', "


                    $('#tus-datos-retry').click(function(){    
                    
                        let text = 'Esta seguro de realizar nuevamente la carga del PDF?';
                        if (confirm(text) == true) {
                          event.preventDefault();

                          alert('El sistema tarda un momento para generar una respuesta, por favor espere.');

                          $.ajax({
  
                            type: 'GET',
  
                            url: '/detailRegister/refresh?retry=1&id=".$reportId ."&typedoc=".$type."&idnumber=".$number."&jobid=".$jobId."&bckid=".$id."',
  
                            data: $(this).serialize(),

                          }).done(function(data) {
  
                                alert('Proceso realizado correctamente.');
                                location.reload();
  
                          });
                        } else {
                        }

                    });

                ");     

            }

        }
}
 ?>

</div>

<script>

      function toggleIfrm(id) {
        if(document.getElementById(id).style.visibility=="hidden") {

          document.getElementById(id).style.visibility="visible";

        }else {

          document.getElementById(id).style.visibility="hidden";
          
        }

      }

</script>


