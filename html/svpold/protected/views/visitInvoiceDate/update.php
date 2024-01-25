<?php
/* @var $this VisitInvoiceDateController */
/* @var $model VisitInvoiceDate */

$this->breadcrumbs=array(
	'Visit Invoice Dates'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List VisitInvoiceDate', 'url'=>array('index')),
	array('label'=>'Create VisitInvoiceDate', 'url'=>array('create')),
	array('label'=>'View VisitInvoiceDate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage VisitInvoiceDate', 'url'=>array('admin')),
);
?>

<h1>Update VisitInvoiceDate <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>