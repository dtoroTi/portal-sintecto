<?php
/* @var $this TablaPqrController */
/* @var $data TablaPqr */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombreId')); ?>:</b>
	<?php echo CHtml::encode($data->nombreId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipoReclamoId')); ?>:</b>
	<?php echo CHtml::encode($data->tipoReclamoId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nota')); ?>:</b>
	<?php echo CHtml::encode($data->nota); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaReclamo')); ?>:</b>
	<?php echo CHtml::encode($data->fechaReclamo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estadoReclamo')); ?>:</b>
	<?php echo CHtml::encode($data->estadoReclamo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaRespuesta')); ?>:</b>
	<?php echo CHtml::encode($data->fechaRespuesta); ?>
	<br />

	*/ ?>

</div>