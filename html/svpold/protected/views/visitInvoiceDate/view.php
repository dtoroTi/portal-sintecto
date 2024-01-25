<?php
/* @var $this VisitInvoiceDateController */
/* @var $model VisitInvoiceDate */

$this->breadcrumbs=array(
	'Visit Invoice Dates'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List VisitInvoiceDate', 'url'=>array('index')),
	array('label'=>'Create VisitInvoiceDate', 'url'=>array('create')),
	array('label'=>'Update VisitInvoiceDate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete VisitInvoiceDate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VisitInvoiceDate', 'url'=>array('admin')),
);
?>

<h1>Vista fecha de corte facturación visitadores #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
		'invoiceInitialDate',
		'invoiceClosingDate',
		'invoiceDate',
	),
)); ?>
