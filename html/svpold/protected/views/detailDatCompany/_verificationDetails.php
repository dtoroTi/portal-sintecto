
<div class="row">
    <label>Número total de Contactos</label>
    <?php echo count($verificationSection->detailDatCompany); ?>
</div>

<div class="SvpTable" >
    <?php foreach ($verificationSection->detailDatCompany as $person): ?>
        <?php
        echo $this->renderPartial('/detailDatCompany/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
        ?>
    <?php endforeach ?>
    <?php
    if ($verificationSection->backgroundCheck->canUpdate) {
        $person = new DetailDatCompany();
        $person->verificationSectionId = $verificationSection->id;
        echo $this->renderPartial('/detailDatCompany/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
    }
    ?>
</div>
