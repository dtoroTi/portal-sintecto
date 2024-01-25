<?php
/* @var $this InvoiceVisitCostController */
/* @var $model InvoiceVisitCost */

$this->breadcrumbs=array(
	'Invoice Visit Costs'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List InvoiceVisitCost', 'url'=>array('index')),
	array('label'=>'Create InvoiceVisitCost', 'url'=>array('create')),
	array('label'=>'Update InvoiceVisitCost', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete InvoiceVisitCost', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InvoiceVisitCost', 'url'=>array('admin')),
);
?>

<h1>Vista costo de visita #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'businessLine',
		'descriptionCost',
		'totalVisitCost',
	),
)); ?>
