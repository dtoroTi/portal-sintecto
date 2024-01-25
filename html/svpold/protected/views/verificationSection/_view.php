<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('backgroundCheckId')); ?>:</b>
	<?php echo CHtml::encode($data->backgroundCheckId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('verificationSectionTypeId')); ?>:</b>
	<?php echo CHtml::encode($data->verificationSectionTypeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('percentCompleted')); ?>:</b>
	<?php echo CHtml::encode($data->percentCompleted); ?>
	<br />


</div>