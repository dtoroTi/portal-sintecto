<?php
/* @var $this InvoiceVisitController */
/* @var $model InvoiceVisit */

$this->breadcrumbs=array(
	'Invoice Visits'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List InvoiceVisit', 'url'=>array('index')),
	array('label'=>'Manage InvoiceVisit', 'url'=>array('admin')),
);
?>

<h1>Create InvoiceVisit</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>