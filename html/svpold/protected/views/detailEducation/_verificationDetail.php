<table>
  <tr>
    <td>
      Año de Grado:
    </td>
    <td>
      <?php
      echo CHtml::numberField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][graduationYear]', $study->graduationYear);
      ?>
    </td>
    <td>
      Institución:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][institution]',$study->institution, ['class'=>'select_ed_institution_'.($study->isNewRecord ? 'new' : $study->id)]);
      ?>
      <?php
      echo CHtml::dropDownList(//
              'verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][educationTypeId]'
              , //
              $study->educationTypeId, //
              CHtml::listData(
                      EducationType::model()->findAll(), //
                      'id', //
                      'name'));
      ?>
    </td>
    <td>
      Título:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][title]', $study->title);
      ?>
    </td>
    <td>
      Continua Estudiando:
    </td>
    <td>
      <?php
      echo CHtml::dropDownList(//
              'verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][stillStuding]'
              , //
              $study->stillStuding, //
              Controller::$optionsYesNo);
      ?>
      Se Graduo:
      <?php
      echo CHtml::dropDownList(//
              'verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][didObtainDiploma]'
              , //
              $study->didObtainDiploma, //
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
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][country]', $study->country, ['class'=>'select_ed_country_'.($study->isNewRecord ? 'new' : $study->id)]);
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
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][city]', $study->city, ['class'=>'select_ed_city_'.($study->isNewRecord ? 'new' : $study->id)]);
      ?>
    </td>
    <td>
      Tel:
    </td>
    <td>
      <?php
      echo CHtml::numberField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][tel]', $study->tel, ['class'=>'select_ed_tel_'.($study->isNewRecord ? 'new' : $study->id)]);
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
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][contact]', $study->contact, ['class'=>'select_ed_contact_'.($study->isNewRecord ? 'new' : $study->id)]);
      ?>
    </td>
  </tr>
  <!--COMIENZO NUEVOS CAMPOS-->
  <tr>
    <td>
      Registro:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][registry]', $study->registry);
      ?>
    </td>
    <td>
      Folio:
    </td>
    <td>
      <?php
      echo CHtml::numberField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][folio]', $study->folio);
      ?>
    </td>
    <td>
      Libro:
    </td>
    <td>
      <?php
      echo CHtml::numberField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][book]', $study->book);
      ?>
    </td>
    <td>
      Acta:
    </td>
    <td>
      <?php
      echo CHtml::numberField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][minute]', $study->minute);
      ?>
    </td>
  </tr>

  <!--FIN NUEVOS CAMPOS-->
  <tr>
  <td>
      Email:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][email]', $study->email, ['class'=>'select_ed_email_'.($study->isNewRecord ? 'new' : $study->id)]);
      ?>
    </td>

  
    <td>
      Resultado:
    </td>
    <td>
      <?php
      echo CHtml::dropDownList(//
              'verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][verificationResultId]'
              , //
              $study->verificationResultId, //
              CHtml::listData(
                      VerificationResult::model()->findAll(), //
                      'id', //
                      'name'));
      ?>
      Verificado en:
      <?php
      $this->widget('zii.widgets.jui.CJuiDatePicker', array(
          'name' => 'verificationSection' .
          '[' . $verificationSection->id . ']' .
          '[_details]' .
          '[' . ($study->isNewRecord ? 'new' : $study->id) . '][verifiedOn]',
          'value' => $study->verifiedOn,
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
      Comentarios
    </td>
    <td colspan="3">
      <?php
      echo CHtml::textArea('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($study->isNewRecord ? 'new' : $study->id) . '][comments]', $study->comments, array('rows' => 1, 'cols' => 70));
      ?>
    </td>
    <?php if (!$study->isNewRecord && $verificationSection->backgroundCheck->canUpdate): ?>

      <td >
        <div class="ServiceButton">
          <a href="<?php echo $this->createUrl('/detailEducation/deleteStudy/', array('id' => $study->id)) ?>" 
             class="ui-button ui-button-icon-only ui-widget ui-state-default ui-corner-all ServiceButton" 
             title="Borrar"
             onClick="return (confirm('Realmente desea borrar \'<?php echo $study->institution; ?>?\''));"> 
            <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span> 
            <span class="ui-button-text">Button</span> 
          </a> 
        </div>
      </td>
    <?php endif; ?>
  </tr>
</table>
<?php
Yii::app()->clientScript->registerScript(3, "$('.select_ed_institution_new').change(function(){   
  
    parent = $(this).parents('tbody');
      event.preventDefault();
          $(parent).find('input').each(function(index) {
            $.ajax({
                type: 'POST',
                url: '/detailEducation/listContEduct.html',
                data: {'institution' : $(this).val()},
            }).done(function(resp) {
              $( this ).addClass('ListContEduct');
              if(resp.length>0){
                    var data = resp;
                    $('.select_ed_city_new').val(data[0]['city']);
                    $('.select_ed_country_new').val(data[0]['country']);
                    $('.select_ed_tel_new').val(data[0]['phone']);
                    $('.select_ed_contact_new').val(data[0]['contact']);
                    $('.select_ed_email_new').val(data[0]['email']);
              }
            });
          });
});
");   
?>
<script>

/*$('#institution').on('change', function(){
$.ajax({
  
    url: "/detailEducation/listContEduct.html",
    data: {'institution' : $('#institution').val()},
    type: "post",
    context: document.body
    }).done(function(resp) {
        $( this ).addClass( "ListContEduct" );
        if(resp.length>0){
            var data = resp;
            //alert("Info en lista Laboral");
            citye.value=data[0]['city'];
            countrye.value=data[0]['country'];
            telf.value=data[0]['phone'];
            contact.value=data[0]['contact'];
            emaile.value=data[0]['email'];
        }/*else{
          alert("No existe la compañia en la lista.");
        }*/
    //});
//})
//coment

</script>
