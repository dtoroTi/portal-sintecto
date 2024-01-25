<?php
/* @var $this InvoiceVisitDetailController */
/* @var $model InvoiceVisitDetail */

$this->breadcrumbs=array(
	'Invoice Visit Details'=>array('view','id'=>$model->invoiceVisitId),
	//$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List InvoiceVisitDetail', 'url'=>array('index')),
	array('label'=>'Create InvoiceVisitDetail', 'url'=>array('create')),
	array('label'=>'View InvoiceVisitDetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage InvoiceVisitDetail', 'url'=>array('admin')),
);
?>

<h1>Actualizar detalle de factura <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>