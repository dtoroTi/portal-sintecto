<?php
/* @var $this InvoiceVisitDetailController */
/* @var $model InvoiceVisitDetail */

$this->breadcrumbs=array(
	'Invoice Visit Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List InvoiceVisitDetail', 'url'=>array('index')),
	array('label'=>'Manage InvoiceVisitDetail', 'url'=>array('admin')),
);
?>

<h1>Create InvoiceVisitDetail</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>