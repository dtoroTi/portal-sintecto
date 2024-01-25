<?php
/* @var $this ImageSizeController */
/* @var $data ImageSize */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maxWidth')); ?>:</b>
	<?php echo CHtml::encode($data->maxWidth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maxHeight')); ?>:</b>
	<?php echo CHtml::encode($data->maxHeight); ?>
	<br />


</div>