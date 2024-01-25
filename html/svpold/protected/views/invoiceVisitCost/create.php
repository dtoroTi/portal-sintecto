<?php
/* @var $this InvoiceVisitCostController */
/* @var $model InvoiceVisitCost */

$this->breadcrumbs=array(
	'Invoice Visit Costs'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List InvoiceVisitCost', 'url'=>array('index')),
	array('label'=>'Manage InvoiceVisitCost', 'url'=>array('admin')),
);
?>

<h1>Crear costo de visita</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>