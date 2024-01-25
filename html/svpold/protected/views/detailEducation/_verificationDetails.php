<div class="SvpTable" style="">
  <table>
    <tr>
      <th width="40em">Grado</th>
      <th  width="100em">Tipo</th>
      <th>Institución</th>
      <th>Ciudad</th>
      <th>Titulo</th>
      <th>Grado</th>
      <th>Verificación</th>
      <th>Comentario</th>
    </tr>
    <?php foreach ($verificationSection->detailStudies as $study): ?>
      <tr>
        <td><?php echo CHtml::encode($study->graduationYear); ?></td>
        <td><?php echo CHtml::encode($study->educationType->name); ?></td>
        <td><?php echo CHtml::encode($study->institution); ?></td>
        <td><?php echo CHtml::encode($study->city); ?></td>
        <td><?php echo CHtml::encode($study->title); ?></td>
        <td><?php echo Controller::stringYesNo($study->didObtainDiploma); ?></td>
        <td><?php echo CHtml::encode($study->verificationResult->name); ?></td>
        <td><?php echo CHtml::encode($study->comments) ?></td>
      </tr>
    <?php endforeach
    ?>
  </table>

  <?php //echo CHtml::button('Envío Correos Verificación',array('submit' => array('detailEducation/sendEmail', 'verificationSection'=>$verificationSection->id), 'class'=>'WithoutAdverse')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <?php foreach ($verificationSection->detailStudies as $study): ?>
    <?php
    echo $this->renderPartial('/detailEducation/_verificationDetail', array(
        'verificationSection' => $verificationSection,
        'study' => $study,
    ));
    ?>
  <?php endforeach; ?>
  <?php
  if ($verificationSection->backgroundCheck->canUpdate){
    $study = new DetailEducation();
    echo $this->renderPartial('/detailEducation/_verificationDetail', array(
        'verificationSection' => $verificationSection,
        'study' => $study,
    ));
  }
  ?>
</div>
