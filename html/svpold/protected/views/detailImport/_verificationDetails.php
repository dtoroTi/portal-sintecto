
<div class="row">
    <label>Número total de Contactos</label>
    <?php echo count($verificationSection->detailImport); ?>
</div>

<div class="SvpTable" >
    <?php foreach ($verificationSection->detailImport as $person): ?>
        <?php
        echo $this->renderPartial('/detailImport/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
        ?>
    <?php endforeach ?>
    <?php
    if ($verificationSection->backgroundCheck->canUpdate) {
        $person = new DetailImport();
        $person->verificationSectionId = $verificationSection->id;
        echo $this->renderPartial('/detailImport/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
    }
    ?>
</div>
