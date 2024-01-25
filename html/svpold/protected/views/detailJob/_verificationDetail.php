<table>
  <tr>
    <td>
      Inició En:
    </td>
    <td>
      <?php
      $this->widget('zii.widgets.jui.CJuiDatePicker', array(
          'name' => 'verificationSection' .
          '[' . $verificationSection->id . ']' .
          '[_details]' .
          '[' . ($job->isNewRecord ? 'new' : $job->id) . '][startedOn]',
          'value' => $job->startedOn,
          // additional javascript options for the date picker plugin
          'options' => array(
              'showAnim' => 'fold',
              'buttonText' => '...',
              'dateFormat' => 'yy-mm-dd',
              'showButtonPanel' => true,
              'changeYear' => true,
              'changeMonth' => true,
              'maxDate' => "+0D",
          ),
          'htmlOptions' => array(
              'style' => 'width:6em;'
          ),
      ));
      ?>
    </td>
    <td>
      Terminó En:
    </td>
    <td>
      <?php
      $this->widget('zii.widgets.jui.CJuiDatePicker', array(
          'name' => 'verificationSection' .
          '[' . $verificationSection->id . ']' .
          '[_details]' .
          '[' . ($job->isNewRecord ? 'new' : $job->id) . '][finishedOn]',
          'value' => $job->finishedOn,
          // additional javascript options for the date picker plugin
          'options' => array(
              'showAnim' => 'fold',
              'buttonText' => '...',
              'dateFormat' => 'yy-mm-dd',
              'showButtonPanel' => true,
              'changeYear' => true,
              'changeMonth' => true,
              'maxDate' => "+0D",
          ),
          'htmlOptions' => array(
              'style' => 'width:6em;'
          ),
      ));
      ?>
    </td>
    <td>
      Tipo de actividad:
    </td>
    <td>
      <?php
      echo CHtml::dropDownList(//
              'verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][activityTypeId]'
              , //
              $job->activityTypeId, //
              CHtml::listData(
                      ActivityType::model()->findAll(), //
                      'id', //
                      'name'),
              array('class'=>'select_job_activityTypeId')
            );
      ?>
    </td>
    <td>
      Tipo de contrato:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][contractType]', $job->contractType);
      ?>
    </td>
  </tr>
  <tr>
    <td>
      Compañía:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][company]', $job->company,['class'=>'select_job_company_'.($job->isNewRecord ? 'new' : $job->id)]);
      ?>
    </td>
    <td>
      Último Cargo:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][lastPosition]', $job->lastPosition);
      ?>
    </td>
    <td>
      Primer Cargo:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][firstPosition]', $job->firstPosition);
      ?>
    </td>
    <td>
      Continua Trabajando:
    </td>
    <td>
      <?php
      echo CHtml::dropDownList(//
              'verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][stillWorking]'
              , //
              $job->stillWorking, //
              Controller::$optionsYesNo);
      ?>
    </td>
  </tr>
  <tr>
    <td>
      País:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][country]', $job->country,['class'=>'select_job_country_'.($job->isNewRecord ? 'new' : $job->id)]);
      ?>
    </td>
    <td>
      Ciudad:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][city]', $job->city,['class'=>'select_job_city_'.($job->isNewRecord ? 'new' : $job->id)]);
      ?>
    </td>
    <td>
      Tel:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][tel]', $job->tel,['class'=>'select_job_tel_'.($job->isNewRecord ? 'new' : $job->id)]);
      ?>
    </td>
    <td>
      Contacto:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][nameOfContact]',$job->nameOfContact,  ['class'=>'select_job_nameOfContact_'.($job->isNewRecord ? 'new' : $job->id)]);
      ?>
    </td>
  </tr>
  <tr>
    <td>
      Cargo de Contacto:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][contactPosition]', $job->contactPosition);
      ?>
    </td>
    <td>
      Funciones:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][workDetail]', $job->workDetail);
      ?>
    </td>
    <td>
      Motivo de retiro:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][retireReason]', $job->retireReason);
      ?>
    </td>

    <td>
     Contacto Jefe Inmediato:
    </td>
    <td>
      <?php
      echo CHtml::dropDownList(//
              'verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][bossInmediateContact]'
              , //
              $job->bossInmediateContact, //
              Controller::$optionsYesNoNull);
      ?>
    </td>
  </tr>

    <td>
      Jefe inmediato:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][immediateBoss]', $job->immediateBoss);
      ?>
    </td>
    <td>
      Contacto Jefe:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][immediateBossContact]', $job->immediateBossContact);
      ?>
    </td>
    <?php if($verificationSection->backgroundCheck->customer->quantitativeEvaluation==1): ?>
    <td>
      Aportó Certificado:
       </td>
    <td>
    <?php echo CHtml::dropDownList(//
            'verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]'.
            '[' . ($job->isNewRecord ? 'new' : $job->id) . '][providedCertificate]'
            , $job->providedCertificate,
            Controller::$optionsYesNoNull);?>    
    </td>  
    </tr>
    <tr>  
    <td>
      HV Congruente:
    </td>
    <td>
    <?php echo CHtml::dropDownList(//
            'verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]'.
            '[' . ($job->isNewRecord ? 'new' : $job->id) . '][congruentResume]'
            , $job->congruentResume,
            Controller::$optionsYesNoNull);?>    
    </td>    
    <?php endif; //else: ?>
    <td>
      Fortalezas:
       </td>
    <td>
    <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][strenghts]', $job->strenghts);
      ?>
      </td>
    <td>
      Debilidades:
    </td>
    <td>
    <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][weaknesses]', $job->weaknesses);
      ?>  
    </td>
    <?php //endif; ?><br>
    </tr>
    <tr>
    <td>   
      Contrataría Nuevamente:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][wouldYouContractAgain]', $job->wouldYouContractAgain);
      ?>
    </td>
    <td>
      Lo Recomendaría:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][wouldYouRecomend]', $job->wouldYouRecomend);
      ?>
    </td>
    <?php if($verificationSection->backgroundCheck->customer->salaryEarnedCust==1): ?>
    <td>
      Salario Devengado:
    </td>
    <td>
      <?php
     echo CHtml::textField('verificationSection' .
     '[' . $verificationSection->id . ']' .
     '[_details]' .
     '[' . ($job->isNewRecord ? 'new' : $job->id) . '][salaryEarned]', $job->salaryEarned);
      ?>
    </td>
    <?php endif; ?><br>
    <td>
      Resultado:
    </td>
    <td>
      <?php
      echo CHtml::dropDownList(//
              'verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][verificationResultId]'
              , //
              $job->verificationResultId, //
              CHtml::listData(
                      VerificationResult::model()->findAll(), //
                      'id', //
                      'name'));
      ?>
    </td>
    </tr>
    <tr>
    <td>
      Email:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][email]', $job->email, ['class'=>'select_job_email_'.($job->isNewRecord ? 'new' : $job->id)]);
      ?>
    </td>

    <td>
      Verificado en:
    </td>
    <td>
      <?php
      $this->widget('zii.widgets.jui.CJuiDatePicker', array(
          'name' => 'verificationSection' .
          '[' . $verificationSection->id . ']' .
          '[_details]' .
          '[' . ($job->isNewRecord ? 'new' : $job->id) . '][verifiedOn]',
          'value' => $job->verifiedOn,
          // additional javascript options for the date picker plugin
          'options' => array(
              'showAnim' => 'fold',
              'buttonText' => '...',
              'dateFormat' => 'yy-mm-dd',
              'showButtonPanel' => true,
              'changeYear' => true,
              'changeMonth' => true,
              'maxDate' => "+0D",
          ),
          'htmlOptions' => array(
              'style' => 'width:6em;'
          ),
      ));
      ?>        
    </td>
    <?php if($verificationSection->backgroundCheck->customer->salaryEarnedCust==1): ?>
   
    <?php endif; ?><br>
    <td>
      Comentarios
    </td>
    <td>
      <?php
      echo CHtml::textArea('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($job->isNewRecord ? 'new' : $job->id) . '][comments]', $job->comments, array('rows' => 1, 'cols' => 40));
      ?>
    </td>
    <?php if($verificationSection->backgroundCheck->customer->quantitativeEvaluation==1): ?>

<tr>
  <td>
   <!--  Debilidades:--> Histórico Pensional:
  </td>
  <td>
  <?php echo CHtml::dropDownList(//
          'verificationSection' .
          '[' . $verificationSection->id . ']' .
          '[_details]'.
          '[' . ($job->isNewRecord ? 'new' : $job->id) . '][historicPension]'
          , $job->historicPension,
          Controller::$optionsYesNoNull);?>    
  </td>

    
  <div class="SvpTable" style=""><table>
  <tr>
      <th colspan="2">EVALUACIÓN CUANTITATIVA Y CUALITATIVA</th>
  </tr>
  <tr>
      <td>De acuerdo a lo que usted observo en los comportamientos de <b><?php echo $verificationSection->backgroundCheck->firstName." ".$verificationSection->backgroundCheck->lastName; ?> </b>como califica cada una de las siguientes competencias siendo: <br><br> 0 = No sabe, no responde.<br>5 = su máximo potencial para el cargo que ocupó.</br> </td>        
  </tr>
</table>
</div>
<div class="SvpTable">
<table>
<tr>

<th>Solucion de Problemas</th>
<th>Puntualidad</th>
<th>Trabajo en Equipo</th>
<th>Orientación a Resultados</th>
<th>Adaptabilidad</th>
</tr>
<tr>
<td>
<?php echo CHtml::radioButtonList(//
          'verificationSection' .
          '[' . $verificationSection->id . ']' .
          '[_details]'.
          '[' . ($job->isNewRecord ? 'new' : $job->id) . '][problemSolving]'
          , $job->problemSolving,
          Controller::$optionsCalificationCuantitative);?>

</td>
<td>
<?php echo CHtml::radioButtonList(//
          'verificationSection' .
          '[' . $verificationSection->id . ']' .
          '[_details]'.
          '[' . ($job->isNewRecord ? 'new' : $job->id) . '][leadership]'
          , $job->leadership,
          Controller::$optionsCalificationCuantitative);?>

</td>
<td>
<?php echo CHtml::radioButtonList(//
          'verificationSection' .
          '[' . $verificationSection->id . ']' .
          '[_details]'.
          '[' . ($job->isNewRecord ? 'new' : $job->id) . '][teamWork]'
          , $job->teamWork,
          Controller::$optionsCalificationCuantitative);?>

</td>
<td>
<?php echo CHtml::radioButtonList(//
          'verificationSection' .
          '[' . $verificationSection->id . ']' .
          '[_details]'.
          '[' . ($job->isNewRecord ? 'new' : $job->id) . '][orientationtoResults]'
          , $job->orientationtoResults,
          Controller::$optionsCalificationCuantitative);?>

</td>
<td>
<?php echo CHtml::radioButtonList(//
          'verificationSection' .
          '[' . $verificationSection->id . ']' .
          '[_details]'.
          '[' . ($job->isNewRecord ? 'new' : $job->id) . '][adaptability]'
          , $job->adaptability,
          Controller::$optionsCalificationCuantitative);?>

</td>
</tr>
</table>
<?php endif; ?><br>


  <?php if (!$job->isNewRecord && $verificationSection->backgroundCheck->canUpdate): ?>

    <td >
      <div class="ServiceButton">Eliminar
        <a href="<?php echo $this->createUrl('/detailJob/deleteJob/', array('id' => $job->id)) ?>" 
           class="ui-button ui-button-icon-only ui-widget ui-state-default ui-corner-all ServiceButton" 
           title="Borrar"
           onClick="return (confirm('Realmente desea borrar \'<?php echo $job->company; ?>?\''));"> 
          <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span> 
          <span class="ui-button-text">Button</span>
        </a> 
      </div>
    </td>
  <?php endif; ?><br>
</tr>
</table>
<?php
Yii::app()->clientScript->registerScript(1, '$( ".select_job_activityTypeId" ).change(function() {
  parent = $(this).parents("tbody");
  if($(this).val()==3||$(this).val()==5||$(this).val()==6){
    $(parent).find("input").each(function( index ) {
      if(!$(this).hasClass("hasDatepicker")){
        $(this).val("No aplica");
        $(this).attr("value","No aplica");

      }
    });
  }
  else{
    $(parent).find("input").each(function( index ) {
      if(!$(this).hasClass("hasDatepicker")){
        $(this).val("");
        $(this).attr("value","");
 
      }
    });
  }
});');


Yii::app()->clientScript->registerScript(2, "$('.select_job_company_new').change(function(){   

    parent = $(this).parents('tbody');
      event.preventDefault();
          $(parent).find('input').each(function( index ) {
            $.ajax({
                type: 'POST',
                url: '/detailJob/listContJob.html',
                data: {'company' : $('.select_job_company_new').val()},
            }).done(function(resp) {
              $( this ).addClass( 'ListContJob' );
              if(resp.length>0){
                    var data = resp;
                    $('.select_job_city_new').val(data[0]['city']);
                    $('.select_job_country_new').val(data[0]['country']);
                    $('.select_job_tel_new').val(data[0]['phone']);
                    $('.select_job_nameOfContact_new').val(data[0]['contact']);
                    $('.select_job_email_new').val(data[0]['email']);
              }
            });
          });
});
");   
?>

<script>
/*$.ajax({
  
    url: "/detailJob/listContJob.html",
    data: {'company' : $('#company').val()},
    type: "post",
    context: document.body
    }).done(function(resp) {
        $( this ).addClass( "ListContJob" );
        if(resp.length>0){
            var data = resp;
            //alert("Info en lista Laboral");
            city.value=data[0]['city'];
            country.value=data[0]['country'];
            tel.value=data[0]['phone'];
            nameOfContact.value=data[0]['contact'];
            email.value=data[0]['email'];
        }/*else{
          alert("No existe la compañia en la lista.");
        }*/
    //});
//})
//coment

</script>
