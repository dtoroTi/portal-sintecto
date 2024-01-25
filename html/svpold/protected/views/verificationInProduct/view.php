<?php
$this->breadcrumbs=array(
	'Verification In Products'=>array('index'),
	CHtml::encode($model->id),
);

$this->menu=array(
	array('label'=>'List VerificationInProduct', 'url'=>array('index')),
	array('label'=>'Create VerificationInProduct', 'url'=>array('create')),
	array('label'=>'Update VerificationInProduct', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete VerificationInProduct', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VerificationInProduct', 'url'=>array('admin')),
);
?>

<h1>View VerificationInProduct #<?php echo CHtml::encode($model->id); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'verificationSectionTypeId',
		'customerProductId',
		'weight',
		'showOrder',
	),
)); ?>
