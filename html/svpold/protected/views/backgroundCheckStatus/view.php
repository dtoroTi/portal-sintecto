<?php
$this->breadcrumbs=array(
	'Background Check Statuses'=>array('admin'),
	CHtml::encode($model->name),
);

$this->menu=array(
	array('label'=>'List BackgroundCheckStatus', 'url'=>array('admin')),
	array('label'=>'Create BackgroundCheckStatus', 'url'=>array('create')),
	array('label'=>'Update BackgroundCheckStatus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BackgroundCheckStatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BackgroundCheckStatus', 'url'=>array('admin')),
);
?>

<h1>View BackgroundCheckStatus #<?php echo CHtml::encode($model->id); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
