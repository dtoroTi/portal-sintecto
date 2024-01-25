<div class="row">
  <label>Número Hallazgos</label>
  <?php echo count($verificationSection->detailAudit); ?>
</div>
<div class="SvpTable" >
  <?php foreach ($verificationSection->detailAudit as $audit): ?>
    <?php
    echo $this->renderPartial('/detailAudit/_verificationDetail', array(
        'verificationSection' => $verificationSection,
        'audit' => $audit,
    ));
    ?>
  <?php endforeach ?>
  <?php
  
  if ($verificationSection->backgroundCheck->canUpdate) {
    $audit = new DetailAudit();
    $audit->verificationSectionId = $verificationSection->id;
    echo $this->renderPartial('/detailAudit/_verificationDetail', array(
        'verificationSection' => $verificationSection,
        'audit' => $audit,
    ));
  }
  
  ?>
</div>
