<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->breadcrumbs=array(
	'Invoices'=>array('admin'),
	'Create',
);


?>

<h1>Crear Factura</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>