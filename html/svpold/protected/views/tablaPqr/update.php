<?php
/* @var $this TablaPqrController */
/* @var $model TablaPqr */

$this->breadcrumbs=array(
	'Tabla Pqrs'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TablaPqr', 'url'=>array('index')),
	array('label'=>'Create TablaPqr', 'url'=>array('create')),
	array('label'=>'View TablaPqr', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TablaPqr', 'url'=>array('admin')),
);
?>

<h1>Update TablaPqr <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>