
<div class="row">
    <label for="DetailCompany_sectionDate">Fecha de Ultimo Contacto</label>

    <?php /*
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
  */  ?>

    <?php

    foreach ($verificationSection->tracking as $dateEnd): ?>
    <?php endforeach ?>
    <?php
    if(isset($dateEnd)){
        echo CHtml::encode($dateEnd->DateContact);}?>

</div>

<div class="row">
    <label for="DetailCompany_sectionDate">Estado del Proceso?</label>
    <?php
    echo CHtml::dropDownList(//
        'verificationSection' .
        '[' . $verificationSection->id . ']' .
        '[sectionBool]'
        , $verificationSection->sectionBool
        , Controller::$optionsTrackingProcStatus);
    ?>
</div>


<div class="row">
    <label>Número total de Contactos</label>
    <?php echo count($verificationSection->tracking); ?>
</div>

<div class="SvpTable" >
    <?php foreach ($verificationSection->tracking as $person): ?>
        <?php
        echo $this->renderPartial('/tracking/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
        ?>
    <?php endforeach ?>
    <?php
    if ($verificationSection->backgroundCheck->canUpdate) {
        $person = new Tracking();
        $person->verificationSectionId = $verificationSection->id;
        echo $this->renderPartial('/tracking/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
    }
    ?>
</div>
