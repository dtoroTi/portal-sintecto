<?php
/* @var $this SDNController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Query' => array('/SDN/query'),
);

?>
<h1>Resultado</h1>
<div class="form wide">
  <?php echo $this->renderPartial('_SDNVersion', array('sdnVersions' => $sdnVersions)); ?>

  <fieldset>

    <legend>Opciones</legend>    	
    <div class="row">
      <?php echo CHtml::activeLabelEx($query, 'doNotIncludePrepositions'); ?>
      <?php echo Controller::stringYesNo($query->doNotIncludePrepositions); ?>
    </div>

    <div class="row">
      <?php echo CHtml::activeLabelEx($query, 'oneFirstnameOneLastname'); ?>
      <?php echo Controller::stringYesNo($query->oneFirstnameOneLastname); ?>
    </div>

    <div class="row">
      <?php echo CHtml::activeLabelEx($query, 'allLastnames'); ?>
      <?php echo Controller::stringYesNo($query->allLastnames); ?>
    </div>

  </fieldset>
</div>

<table  id="refresh" class="RecordsTable">

  <tr>
    <th class="Num">No.</th>  
    <th class="lastname">Apellido</th>
    <th class="firstname">Nombre</th>
    <th class="remarks">Id/Otros</th>
    <th class="answer">Resultado</th>
    <th class="answerv">Verificado</th>
  </tr>
  <?php foreach ($queries as $key => $rowQuery): ?>
    <?php
      $records = $rowQuery['records'];
      $query = $rowQuery['query'];
      $patterns = $rowQuery['patterns'];
      $verifiedRecords=$rowQuery['verifiedRecords'];
    ?>

    <tr>
      <td class="Num"><?php echo CHtml::encode($key + 1) ?></td>
      <td class="lastname"><?php echo CHtml::encode(strtoupper($query->lastname)); ?></td>
      <td class="firstname"><?php echo CHtml::encode($query->firstname); ?></td>
      <td class="Remarks"><?php echo CHtml::encode($query->remarks); ?></td>
      <td>
        <?php if (count($verifiedRecords['new']) > 0) : ?>
          <?php
          $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
              'id' => 'searchDetail_' . $key,
              // additional javascript options for the dialog plugin
              'options' => array(
                  'title' => 'Detalle de :' . CHtml::encode(strtoupper($query->lastname) . "," . $query->firstname),
                  'autoOpen' => false,
                  'width' => '1000px',
                  'modal' => true,
              ),
          ));

          $arrayresult=[];        

          foreach ($verifiedRecords['new'] as $result) {
              $arrayresult[]=[
                  'hashR'=>$result->getHash(),
                  'hashP'=>$verifiedRecords['hash']
              ];
          }
          ?>
          
          <table class="RecordsTableAns">

            <center><button class="disable" type='button' id='envioR' onclick='js:sendAllResult(<?php echo json_encode($arrayresult);?>)'>Enviar Resultado</button></center>
            <br>
              
            <tr>
              <th class="entNum">Lista</th>
              <th class="entNum">Rec.</th>
              <th class="SDNName">Nombre</th>
              <th class="Program">Programa</th>
              <th class="Remarks">Identificación/Otros</th>
              <th class="answer">Verificar</th>
            </tr>
            <?php foreach ($verifiedRecords['new'] as $row): ?>
              <tr>
                <td class="entNum"><?php echo CHtml::encode($row->sdnType->name); ?></td>
                <td class="entNum"><?php echo CHtml::encode($row->entNum); ?></td>
                <td class="SDNName"><?php echo SDN::markPaterns(CHtml::encode($row->SDNName),$patterns,"RedMatch"); ?></td>
                <td class="Program"><?php echo CHtml::encode($row->program); ?></td>
                <td class="Remarks"><?php echo SDN::markPaterns(CHtml::encode($row->remarks),$patterns,"RedMatch"); ?></td>
                <td><?php 
                $hashPerson=$verifiedRecords['hash'];
                $hashRecord=$row->getHash();
                echo CHtml::checkBox('validar',false,array('onclick' =>"verificar('".$hashRecord."','".$hashPerson."', true);")); 
                ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>

          <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

          <span class="RedMatch">***</span>
          <?php
          echo CHtml::link('Hay ' . count($verifiedRecords['new']) . ' registros', '#', array(
              'onclick' => '$("#searchDetail_' . $key . '").dialog("open"); return false;',
          ));
          ?>
          <span class="RedMatch">***</span>
        <?php else: ?>
           No se encontraron registros
        <?php endif; ?>
      </td>

      <td>
        <?php if (count($verifiedRecords['verified']) > 0) : ?>
          <?php
          $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
              'id' => 'searchDetail2_' . $key,
              // additional javascript options for the dialog plugin
              'options' => array(
                  'title' => 'Detalle de :' . CHtml::encode(strtoupper($query->lastname) . "," . $query->firstname),
                  'autoOpen' => false,
                  'width' => '1000px',
                  'modal' => true,
              ),
          ));
          ?>
          <table class="RecordsTableAns">
            <tr>
              <th class="entNum">Lista</th>
              <th class="entNum">Rec.</th>
              <th class="SDNName">Nombre</th>
              <th class="Program">Programa</th>
              <th class="Remarks">Identificación/Otros</th>
              <th class="answer">Eliminar Verificación</th>
            </tr>
            <?php foreach ($verifiedRecords['verified'] as $row): ?>
              <tr>
                <td class="entNum"><?php echo CHtml::encode($row->sdnType->name); ?></td>
                <td class="entNum"><?php echo CHtml::encode($row->entNum); ?></td>
                <td class="SDNName"><?php echo SDN::markPaterns(CHtml::encode($row->SDNName),$patterns,"RedMatch"); ?></td>
                <td class="Program"><?php echo CHtml::encode($row->program); ?></td>
                <td class="Remarks"><?php echo SDN::markPaterns(CHtml::encode($row->remarks),$patterns,"RedMatch"); ?></td>
                <td><?php 
                $hashRecordd=$row->getHash();
                echo CHtml::checkBox('eliminar',false,array('onclick' =>"deletev('".$hashRecordd."', true);")); 
                ?></td>
              </tr>
            <?php endforeach; ?>
          </table>

          <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

          <span class="RedMatch">***</span>
          <?php
          echo CHtml::link('Hay ' . count($verifiedRecords['verified']) . ' registros verificados', '#', array(
              'onclick' => '$("#searchDetail2_' . $key . '").dialog("open"); return false;',
          ));
          ?>
          <span class="RedMatch">***</span>
        <?php else: ?>
         No se encontraron registros verificados
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<script>

    function verificar(hashRecord, hashPerson, val){
      if(val==true){     
        $.ajax({
          type:'POST',  
          url: "/SDN/insertRegOFAC",
          dataType: "json",
          data: { 
            'hashrecord':  hashRecord,
            'hashperson':  hashPerson,
          },
          success: function(data, status){
            console.log(arguments);
            //Do something success-ish
          },
          error: function (request, status, error) {
            alert('Se ingreso la verificación del registro con exito!!');
            //document.getElementById('validar').disabled=true;
          },
        });

      }else{
        alert('No guardo la verificación del registro');
      }
    }

    function deletev(hashRecordd, vald){
      if(vald==true){
          $.ajax({
            type:'POST',  
            url: "/SDN/deleteRegOFAC",
            dataType: "json",
            data: { 
              'hashrecordd':  hashRecordd,
            },
            success: function(data, status){
              console.log(arguments);
              //Do something success-ish
            },
            error: function (request, status, error) {
              //alert(request.responseText);
              alert('Se elimino el registro verificado, con exito!!');
              //document.getElementById('eliminar').disabled=true;
            },
          });

      }else{
        alert('No elimino el registro verificado');
      }
    }


    function sendAllResult(returnr, value) {

        $.ajax({
          type:'POST',  
          url: "/SDN/sendResult",
          dataType: "json",
          data: { 
            'recordsResult': returnr
          },
          success: function(data, status){
            console.log(arguments);
            //Do something success-ish
          },
          error: function (request, status, error) {
            alert('Se enviaron los registro verificados, con exito!!');
            //location.reload();
          },
        });
    }

    $('.disable').click(function(){
      $(this).prop('disabled', true);
    });

  </script>
