<?php
/* @var $this TablaPqrController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tabla Pqrs',
);

$this->menu=array(
	array('label'=>'Crear reclamo', 'url'=>array('create')),
	array('label'=>'Manage TablaPqr', 'url'=>array('index')),
);
?>

<h1>Tabla Pqrs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
