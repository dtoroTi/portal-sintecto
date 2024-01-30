<?php
/* @var $this TablaPqrController */
/* @var $model TablaPqr */

$this->breadcrumbs=array(
	'Tabla Pqrs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TablaPqr', 'url'=>array('index')),
	array('label'=>'Create TablaPqr', 'url'=>array('create')),
	array('label'=>'Update TablaPqr', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TablaPqr', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TablaPqr', 'url'=>array('admin')),
);
?>

<h1>View TablaPqr #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombreId',
		'tipoReclamoId',
		'nota',
		'descripcion',
		'fechaReclamo',
		'estadoReclamo',
		'fechaRespuesta',
	),
)); ?>
