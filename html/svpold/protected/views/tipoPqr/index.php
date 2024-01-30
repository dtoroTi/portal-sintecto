<?php
/* @var $this TipoPqrController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Pqrs',
);

$this->menu=array(
	array('label'=>'Create TipoPqr', 'url'=>array('create')),
	array('label'=>'Manage TipoPqr', 'url'=>array('admin')),
);
?>

<h1>Tipo Pqrs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
