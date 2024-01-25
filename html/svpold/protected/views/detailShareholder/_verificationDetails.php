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

<div class="row">
    <label for="DetailCompany_sectionDate">Fecha de la lista Clinton</label>
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'verificationSection' .
        '[' . $verificationSection->id . ']' .
        '[sectionDate]',
        'value' => $verificationSection->sectionDate,
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
</div>

<div class="row">
    <label for="DetailCompany_sectionDate">La empresa está en la Lista Clinton?</label>
    <?php
    echo CHtml::dropDownList(//
            'verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[sectionBool]'
            , $verificationSection->sectionBool
            , Controller::$optionsYesNo);
    ?>
</div>

<div class="row">
    <label>Número total de Socios</label>
<?php echo count($verificationSection->detailShareholder); ?>
</div>

<div class="SvpTable" >
    <?php foreach ($verificationSection->detailShareholder as $person): ?>
        <?php
        echo $this->renderPartial('/detailShareholder/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
        ?>
    <?php endforeach ?>
    <?php
    if ($verificationSection->backgroundCheck->canUpdate) {
        $person = new DetailShareholder();
        $person->verificationSectionId = $verificationSection->id;
        echo $this->renderPartial('/detailShareholder/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
    }
    ?>
</div>
