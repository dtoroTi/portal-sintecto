
<div class="row">
    <label>Número total de Contactos</label>
    <?php echo count($verificationSection->detailCommercialRef); ?>
</div>

<div class="SvpTable" >
    <?php foreach ($verificationSection->detailCommercialRef as $person): ?>
        <?php
        echo $this->renderPartial('/detailCommercialRef/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
        ?>
    <?php endforeach ?>
    <?php
    if ($verificationSection->backgroundCheck->canUpdate) {
        $person = new DetailCommercialRef();
        $person->verificationSectionId = $verificationSection->id;
        echo $this->renderPartial('/detailCommercialRef/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
    }
    ?>
</div>
