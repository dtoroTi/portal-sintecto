<?php
/* @var $this TablaPqrController */
/* @var $model TablaPqr */

$this->breadcrumbs=array(
	'Tabla Pqrs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TablaPqr', 'url'=>array('index')),
	array('label'=>'Manage TablaPqr', 'url'=>array('admin')),
);
?>

<h1>Solicitar queja o reclamo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>