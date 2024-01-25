<div class="row">
  <label>Número total de Empresas</label>
  <?php echo count($verificationSection->detailCompany); ?>
</div>
<div class="SvpTable" >
  <?php foreach ($verificationSection->detailCompany as $company): ?>
    <?php
    echo $this->renderPartial('/detailCompany/_verificationDetail', array(
        'verificationSection' => $verificationSection,
        'company' => $company,
    ));
    ?>
  <?php endforeach ?>
  <?php
  if ($verificationSection->backgroundCheck->canUpdate) {
    $company = new DetailCompany();
    $company->verificationSectionId = $verificationSection->id;
    echo $this->renderPartial('/detailCompany/_verificationDetail', array(
        'verificationSection' => $verificationSection,
        'company' => $company,
    ));
  }
  ?>
</div>
