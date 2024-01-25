<?php
/* @var $this SDNController */
/* @var $model SDN */

$this->breadcrumbs=array(
	'Sdns'=>array('index'),
	CHtml::encode($model->title),
);

$this->menu=array(
	array('label'=>'List SDN', 'url'=>array('index')),
	array('label'=>'Create SDN', 'url'=>array('create')),
	array('label'=>'Update SDN', 'url'=>array('update', 'id'=>$model->entNum)),
	array('label'=>'Delete SDN', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->entNum),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SDN', 'url'=>array('admin')),
);
?>

<h1>View SDN #<?php echo CHtml::encode($model->entNum); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'entNum',
		'SDNName',
		'SDNType',
		'program',
		'title',
		'callSign',
		'vessType',
		'tonnage',
		'GRT',
		'vessFlag',
		'vessOwner',
		'remarks',
	),
)); ?>
