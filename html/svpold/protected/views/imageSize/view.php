<?php
/* @var $this ImageSizeController */
/* @var $model ImageSize */

$this->breadcrumbs=array(
	'Image Sizes'=>array('index'),
	CHtml::encode($model->name),
);

$this->menu=array(
	array('label'=>'List ImageSize', 'url'=>array('index')),
	array('label'=>'Create ImageSize', 'url'=>array('create')),
	array('label'=>'Update ImageSize', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ImageSize', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ImageSize', 'url'=>array('admin')),
);
?>

<h1>View ImageSize #<?php echo CHtml::encode($model->id); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'maxWidth',
		'maxHeight',
	),
)); ?>
