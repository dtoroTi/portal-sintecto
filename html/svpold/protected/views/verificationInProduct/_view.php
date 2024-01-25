<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('verificationSectionTypeId')); ?>:</b>
	<?php echo CHtml::encode($data->verificationSectionTypeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerProductId')); ?>:</b>
	<?php echo CHtml::encode($data->customerProductId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight')); ?>:</b>
	<?php echo CHtml::encode($data->weight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('showOrder')); ?>:</b>
	<?php echo CHtml::encode($data->showOrder); ?>
	<br />
</div>