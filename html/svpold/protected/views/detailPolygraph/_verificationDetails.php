<?php echo CHtml::button('Sin Poligrafia',array('submit' => array('detailPolygraph/comentAdvs', 'idSection'=>$verificationSection->id, 'val'=>'0'), 'class'=>'WithoutAdverse')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<?php echo CHtml::button('Con Poligrafia',array('submit' => array('detailPolygraph/comentAdvs', 'idSection'=>$verificationSection->id, 'val'=>'1'),'class'=>'WithAdverse')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<div class="SvpTable" style="">

  <?php
  echo $this->renderPartial('/detailPolygraph/_verificationDetail', array(
      'verificationSection' => $verificationSection,
      'polygraph' => $verificationSection->detailPolygraph,
  ));
  ?>

</div>
