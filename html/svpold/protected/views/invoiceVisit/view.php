<?php
/* @var $this InvoiceVisitController */
/* @var $model InvoiceVisit */

$this->breadcrumbs=array(
	'Invoice Visits'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List InvoiceVisit', 'url'=>array('index')),
	array('label'=>'Create InvoiceVisit', 'url'=>array('create')),
	array('label'=>'Update InvoiceVisit', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete InvoiceVisit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InvoiceVisit', 'url'=>array('admin')),
);
?>

<h1>Vista factura visitadores #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'from',
		'until',
		'invoiceDate',
		'created',
		'visitId',
		'numberStudies',
		'totalValueStudies',
		'totalValueAddStudies',
		'statusInvoice',
		'description',
	),
)); ?>
