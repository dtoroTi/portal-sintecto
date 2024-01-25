
<div class="row">
    <label>Número total de Contactos</label>
    <?php echo count($verificationSection->detailDatShareHolders); ?>
</div>

<div class="SvpTable" >
    <?php foreach ($verificationSection->detailDatShareHolders as $person): ?>
        <?php
        echo $this->renderPartial('/detailDatShareHolders/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
        ?>
    <?php endforeach ?>
    <?php
    if ($verificationSection->backgroundCheck->canUpdate) {
        $person = new DetailDatShareHolders();
        $person->verificationSectionId = $verificationSection->id;
        echo $this->renderPartial('/detailDatShareHolders/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
    }
    ?>
</div>
