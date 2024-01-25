
<div class="row">
    <label>Número total de Contactos</label>
    <?php echo count($verificationSection->detailAddress); ?>
</div>

<div class="SvpTable" >
    <?php foreach ($verificationSection->detailAddress as $person): ?>
        <?php
        echo $this->renderPartial('/detailAddress/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
        ?>
    <?php endforeach ?>
    <?php
    if ($verificationSection->backgroundCheck->canUpdate) {
        $person = new DetailAddress();
        $person->verificationSectionId = $verificationSection->id;
        echo $this->renderPartial('/detailAddress/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
    }
    ?>
</div>
