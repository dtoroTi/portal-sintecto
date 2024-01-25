<div class="row">
  <label>Asistencias</label>
  <?php echo count($verificationSection->detailAuditAttendance); ?>
</div>
<div class="SvpTable" >
  <?php foreach ($verificationSection->detailAuditAttendance as $auditAttendance): ?>
    <?php
    echo $this->renderPartial('/detailAuditAttendance/_verificationDetail', array(
        'verificationSection' => $verificationSection,
        'auditAttendance' => $auditAttendance,
    ));
    ?>
  <?php endforeach ?>
  <?php
  
  if ($verificationSection->backgroundCheck->canUpdate) {
    $auditAttendance = new DetailAuditAttendance();
    $auditAttendance->verificationSectionId = $verificationSection->id;
    echo $this->renderPartial('/detailAuditAttendance/_verificationDetail', array(
        'verificationSection' => $verificationSection,
        'auditAttendance' => $auditAttendance,
    ));
  }
  
  ?>
</div>
