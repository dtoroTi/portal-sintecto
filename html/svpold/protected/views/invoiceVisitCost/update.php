<?php
/* @var $this InvoiceVisitCostController */
/* @var $model InvoiceVisitCost */

$this->breadcrumbs=array(
	'Invoice Visit Costs'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List InvoiceVisitCost', 'url'=>array('index')),
	array('label'=>'Create InvoiceVisitCost', 'url'=>array('create')),
	array('label'=>'View InvoiceVisitCost', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage InvoiceVisitCost', 'url'=>array('admin')),
);
?>

<h1>Actualizar costo de visita <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>