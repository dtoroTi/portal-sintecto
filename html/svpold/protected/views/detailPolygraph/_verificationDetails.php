<div class="SvpTable" style="">

  <?php
  echo $this->renderPartial('/detailPolygraph/_verificationDetail', array(
      'verificationSection' => $verificationSection,
      'polygraph' => $verificationSection->detailPolygraph,
  ));
  ?>

</div>
