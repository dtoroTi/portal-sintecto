<?php
/* @var $this InvoiceVisitCostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Invoice Visit Costs',
);

$this->menu=array(
	array('label'=>'Create InvoiceVisitCost', 'url'=>array('create')),
	array('label'=>'Manage InvoiceVisitCost', 'url'=>array('admin')),
);
?>

<h1>Invoice Visit Costs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
