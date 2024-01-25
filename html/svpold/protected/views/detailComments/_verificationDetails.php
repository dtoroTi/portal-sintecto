
<div class="row">
    <label>Número total de Contactos</label>
    <?php echo count($verificationSection->detailComments); ?>
</div>

<div class="SvpTable" >
    <?php foreach ($verificationSection->detailComments as $person): ?>
        <?php
        echo $this->renderPartial('/detailComments/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
        ?>
    <?php endforeach ?>
    <?php
    if ($verificationSection->backgroundCheck->canUpdate) {
        $person = new DetailComments();
        $person->verificationSectionId = $verificationSection->id;
        echo $this->renderPartial('/detailComments/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'person' => $person,
        ));
    }
    ?>
</div>
