<?php
$this->breadcrumbs=array(
	'Education Types'=>array('index'),
	CHtml::encode($model->name),
);

$this->menu=array(
	array('label'=>'List EducationType', 'url'=>array('index')),
	array('label'=>'Create EducationType', 'url'=>array('create')),
	array('label'=>'Update EducationType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EducationType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EducationType', 'url'=>array('admin')),
);
?>

<h1>View EducationType #<?php echo CHtml::encode($model->id); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
