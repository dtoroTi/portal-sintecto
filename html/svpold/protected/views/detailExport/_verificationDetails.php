
<div class="row">
    <label>Número total de Contactos</label>
    <?php echo count($verificationSection->detailExport); ?>
</div>

<div class="SvpTable" >
    <?php foreach ($verificationSection->detailExport as $person): ?>
        <?php
        echo $this->renderPartial('/detailExport/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
        ?>
    <?php endforeach ?>
    <?php
    if ($verificationSection->backgroundCheck->canUpdate) {
        $person = new DetailExport();
        $person->verificationSectionId = $verificationSection->id;
        echo $this->renderPartial('/detailExport/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
    }
    ?>
</div>
