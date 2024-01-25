<?php
/* @var $this InvoiceVisitController */
/* @var $model InvoiceVisit */

$this->breadcrumbs=array(
	'Invoice Visits'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List InvoiceVisit', 'url'=>array('index')),
	array('label'=>'Create InvoiceVisit', 'url'=>array('create')),
	array('label'=>'View InvoiceVisit', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage InvoiceVisit', 'url'=>array('admin')),
);
?>

<h1>Actualizar factura visitadores <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>