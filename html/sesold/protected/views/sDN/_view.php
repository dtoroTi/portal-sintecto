<?php
/* @var $this SDNController */
/* @var $data SDN */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('entNum')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->entNum), array('view', 'id'=>$data->entNum)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SDNName')); ?>:</b>
	<?php echo CHtml::encode($data->SDNName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SDNType')); ?>:</b>
	<?php echo CHtml::encode($data->SDNType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('program')); ?>:</b>
	<?php echo CHtml::encode($data->program); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('callSign')); ?>:</b>
	<?php echo CHtml::encode($data->callSign); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vessType')); ?>:</b>
	<?php echo CHtml::encode($data->vessType); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('tonnage')); ?>:</b>
	<?php echo CHtml::encode($data->tonnage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GRT')); ?>:</b>
	<?php echo CHtml::encode($data->GRT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vessFlag')); ?>:</b>
	<?php echo CHtml::encode($data->vessFlag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vessOwner')); ?>:</b>
	<?php echo CHtml::encode($data->vessOwner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
	<?php echo CHtml::encode($data->remarks); ?>
	<br />

	*/ ?>

</div>