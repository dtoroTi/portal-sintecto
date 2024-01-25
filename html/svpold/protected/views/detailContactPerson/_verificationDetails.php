
<div class="row">
    <label>Número total de Contactos</label>
    <?php echo count($verificationSection->detailContactPerson); ?>
</div>

<div class="SvpTable" >
    <?php foreach ($verificationSection->detailContactPerson as $person): ?>
        <?php
        echo $this->renderPartial('/detailContactPerson/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
        ?>
    <?php endforeach ?>
    <?php
    if ($verificationSection->backgroundCheck->canUpdate) {
        $person = new DetailContactPerson();
        $person->verificationSectionId = $verificationSection->id;
        echo $this->renderPartial('/detailContactPerson/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
    }
    ?>
</div>
