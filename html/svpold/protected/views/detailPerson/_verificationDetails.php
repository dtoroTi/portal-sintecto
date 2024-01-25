<div class="row">
  <label>Número total de Personas</label>
  <?php echo count($verificationSection->detailPersons); ?>
</div>
<div class="SvpTable" >
  <?php foreach ($verificationSection->detailPersons as $person): ?>
    <?php
    echo $this->renderPartial('/detailPerson/_verificationDetail', array(
        'verificationSection' => $verificationSection,
        'person' => $person,
    ));
    ?>
  <?php endforeach ?>
  <?php
  if ($verificationSection->backgroundCheck->canUpdate) {
    $person = new DetailPerson();
    $person->verificationSectionId = $verificationSection->id;
    echo $this->renderPartial('/detailPerson/_verificationDetail', array(
        'verificationSection' => $verificationSection,
        'person' => $person,
    ));
  }
  ?>
  <?php
  $verificationSectionType = VerificationSectionType::model()->findByPk($verificationSection->verificationSectionTypeId);
  $showExtras = $verificationSectionType->hasPersonalExtras == 0 || $verificationSectionType->hasPersonalExtras == NULL ? false : true;
  if ($verificationSection->backgroundCheck->canUpdate && $showExtras ) {
    $extra = DetailPersonExtras::model()->findByAttributes(array('verificationSectionId'=>$verificationSection->id));
    if ( !isset($extra) ){
      $extra = new DetailPersonExtras();
    }
    echo $this->renderPartial('/detailPerson/_extrasVerificationDetail', array(
        'verificationSection' => $verificationSection,
        'extra' => $extra,
        'person' => $person,
    ));
  }
  ?>
</div>
