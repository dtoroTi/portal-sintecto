<?php
$this->breadcrumbs=array(
	'SurveyLink'=>array('admin'),
	CHtml::encode($model->id),
);

$this->menu=array(
	array('label'=>'List Survey Link File', 'url'=>array('index')),
	array('label'=>'Create Survey Link File', 'url'=>array('create')),
	array('label'=>'Update Survey Link File', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Survey Link File', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Survey Link File', 'url'=>array('admin')),
);
?>

<h1>Links Creados #<?php echo CHtml::encode($model->id); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'link',
	),
)); ?>
