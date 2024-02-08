<?php
/* @var $this TipoPqrController */
/* @var $model TipoPqr */

$this->breadcrumbs=array(
	'Tipo Pqrs'=>array('admin'),
	CHtml::encode($model->id),
);

$this->menu=array(
	array('label'=>'List TipoPqr', 'url'=>array('index')),
	array('label'=>'Create TipoPqr', 'url'=>array('create')),
	array('label'=>'Update TipoPqr', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TipoPqr', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoPqr', 'url'=>array('admin')),
);
?>

<h1>View TipoPqr #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tipoReclamo',
	),
)); ?>
