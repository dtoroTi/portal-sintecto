<?php
$this->breadcrumbs=array(
	'Verification Sections'=>array('index'),
	CHtml::encode($model->id),
);

$this->menu=array(
	array('label'=>'List VerificationSection', 'url'=>array('index')),
	array('label'=>'Create VerificationSection', 'url'=>array('create')),
	array('label'=>'Update VerificationSection', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete VerificationSection', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VerificationSection', 'url'=>array('admin')),
);
?>

<h1>View VerificationSection #<?php echo CHtml::encode($model->id); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'backgroundCheckId',
		'verificationSectionTypeId',
		'comments',
		'percentCompleted',
	),
)); ?>
