<div class="SvpTable" style="">
  <?php
  if ($verificationSection->detailHousing) {
    echo $this->renderPartial('/detailHousing/_verificationDetail', array(
        'verificationSection' => $verificationSection,
        'housing' => $verificationSection->detailHousing,
    ));
  }
  ?>

</div>
