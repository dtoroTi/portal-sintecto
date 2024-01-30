<?php
/* @var $this TipoPqrController */
/* @var $data TipoPqr */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipoReclamo')); ?>:</b>
	<?php echo CHtml::encode($data->tipoReclamo); ?>
	<br />


</div>