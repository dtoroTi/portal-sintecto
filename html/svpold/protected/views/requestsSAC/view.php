<?php
$this->breadcrumbs=array(
	'RequestsSAC'=>array('admin'),
	CHtml::encode($model->id),
);

$this->menu=array(
	array('label'=>'List Attachment File', 'url'=>array('index')),
	array('label'=>'Create Attachment File', 'url'=>array('create')),
	array('label'=>'Update Attachment File', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Attachment File', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Attachment File', 'url'=>array('admin')),
);
?>

<h1>Solicitud SAC Subida #<?php echo CHtml::encode($model->id); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'backgroundcheck.customer.businessLine',
		'user.username',
		'typeRequest',
		'backgroundcheck.code',
		'backgroundcheck.idNumber',
		'backgroundcheck.customer.name',
		'backgroundcheck.applyToPosition',
		'backgroundcheck.customerProduct.name',
		'dateRequest',
		'dateAnswer',
		'shockedby',
		'status',
		'observation',
	),
)); ?>
