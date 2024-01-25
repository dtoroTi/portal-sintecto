<?php
/* @var $verificationSection VerificationSection */
?>
<?php if($verificationSection->verificationSectionType->id==24){
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

}
?>

<div class="row">
    <div class='XmlQuestion'>
        <?php $questions = $verificationSection->verificationSectionType->questionsXmlFormat; ?>
        <?php $answers = $verificationSection->xmlSection->answerArray; ?>
        <?php
        echo $this->renderPartial('/xmlQuestion/_QTGroup', array(
            'varName' => 'verificationSection[' . $verificationSection->id . '][_details][' . $verificationSection->xmlSection->id . ']', 'questions' => $questions, 'answers' => $answers));
        ?>
    </div>
</div>
<div>
    <?php echo CHtml::activeLabel($verificationSection->xmlSection, 'verificationResultId'); ?>
    <?php
    echo CHtml::dropDownList(//
            'verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $verificationSection->xmlSection->id . '][verificationResultId]'
            , //
            $verificationSection->xmlSection->verificationResultId, //
            CHtml::listData(
                    VerificationResult::model()->findAll(), //
                    'id', //
                    'name'));
    ?>
</div>
<?php if($verificationSection->verificationSectionType->name=="Localizador" && $verificationSection->verificationSectionType->class=='XmlSection'){ 

     Yii::import('application.extensions.TransUnion.*');
     $register = BackgroundCheck::model()->findByPk([$verificationSection->backgroundCheckId]);
 
     $type = "";
     $number = "";
     if (stristr($register->idNumber, 'CE') !== false) {
       $type = '3';
       $number = substr($register->idNumber, 2);
       $force = false;
     } else if (stristr($register->idNumber, 'PP') !== false) {
       $type = '5';
       $number = substr($register->idNumber, 2);
       $force = false;
     } else if (stristr($register->idNumber, 'NIT') !== false) {
       $type = '2';
       $number = substr($register->idNumber, 3);
       $force = false;
     }else if (stristr($register->idNumber, 'TI') !== false) {
         $type = '4';
         $number = substr($register->idNumber, 2);
         $force = false;
     } else if (stristr($register->idNumber, 'PEP') !== false) {
        $type = '12';
        $number = substr($register->idNumber, 3);
        $force = false;
     } else {
       $type = '1';
       $number = $register->idNumber;
       $force = true;
     }
 
     $id=$register->id;

     $toreplace = array("/", " ", "\\", "*", "CE", "NIT", "TI", "PEP", "PP");
     $numero = str_replace($toreplace, "", $number);
     $name=$numero.'_UbicaPlus';
    
?>
<br>
<div class="SvpTable" style="">
    <h1>Consulta información en TransUnion</h1>
    <?php 
        $criteria = new CDbCriteria;
        $criteria->addCondition('t.backgroundCheckId=:backgroundCheckId');
        $criteria->addCondition("t.name=:namedoc");
        $criteria->params=[':backgroundCheckId'=>$id, ':namedoc'=>$name];
        $documents = Document::model()->findAll($criteria);
    if(!$documents){?>
    <button id="ubicaPlus" name = "ubicaPlus" value="view_manual1">Ejecutar Consulta</button>
    <?php } ?>         
<?php
    Yii::app()->clientScript->registerScript('search1', "
        $('#ubicaPlus').click(function(){    

            let text1 = 'Esta seguro de ejecutar la consulta de UbicaPlus?';
            if (confirm(text1) == true) {
            event.preventDefault();

            alert('El sistema tarda un momento para generar una respuesta, por favor espere.');

            $.ajax({

                type: 'GET',

                url: '/verificationSection/transUnion?codInfo=5632&motConsulta=18&typedoc=".$type."&idnumber=".$number."&bckid=".$id."',

                data: $(this).serialize(),

            }).done(function(data) {
                    alert(data);
                    location.reload();

            });
            } else {
            }

        });
    ");   

    if($documents){
      foreach ($documents as $document){
        //echo 'Nombre del Documento: '.$document->name."<br>";
        //echo 'Nombre TD: '.$numero.'_CIFIN'."<br>";
        if($document->name==$name){
          //echo 'entro....';
          $iddoc=$document->id;
          //$src="https://135.148.143.83:2443/document/file/$iddoc.html";
          $src=Yii::app()->params['urlAccesApi']['url']."/document/file/$iddoc.html";
          //$src="https://svp.securityandvision.com:2443/document/file/$iddoc.html";
        }else{
          $src="";
        }
      }
    }else{
      $src="";
    }
    
    if($src==""){
      echo '<h2>No se ha generado la Vista.</h2>';
    }else if($src!=""){

            if(empty($type) || empty($number)){
                  echo 'ocurrio un error tipo de documento no valido \n';
    
            }else{
                
                ?>
                <input type="button" name="view_TU1" id="view_TU1" value="Vista" onclick="toggleIfrm('apDiv0')" />
                <div id="apDiv0" style="visibility:hidden">
 
                <iframe id="viewsTransUnion" src="<?= $src ?>" style="border:none; width: 100%; height: 500px;">
                </iframe>
                </div>
                <?php
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
<?php
}
?>

<?php if($verificationSection->verificationSectionType->id==24 && $verificationSection->verificationSectionType->class=='XmlSection'){ 

Yii::import('application.extensions.TusDatos.*');

$id = $verificationSection->backgroundCheck->id;//isset($_GET['code'])?$_GET['code']:"";
$idNumber = $verificationSection->backgroundCheck->idNumber;//isset($_GET['id'])?$_GET['id']:"";
$tusdatosresp = TusDatosResponse::model()->find("backgroundcheckId='$id'");

  $verificationSecAdv = VerificationSection::model()->findByAttributes(['backgroundCheckId' => $id, 'verificationSectionTypeId' => '4']);

  if(!$verificationSecAdv){
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
  <?php
  }
}
?>
