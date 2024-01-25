<?php
/* @var $this VisitInvoiceDateController */
/* @var $model VisitInvoiceDate */

$this->breadcrumbs=array(
	'Visit Invoice Dates'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VisitInvoiceDate', 'url'=>array('index')),
	array('label'=>'Manage VisitInvoiceDate', 'url'=>array('admin')),
);
?>

<h1>Crear fecha de corte facturación visitadores</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>