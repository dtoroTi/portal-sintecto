<?php
/* @var $this VisitInvoiceDateController */
/* @var $model VisitInvoiceDate */

$this->breadcrumbs=array(
	'Visit Invoice Dates'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List VisitInvoiceDate', 'url'=>array('index')),
	array('label'=>'Create VisitInvoiceDate', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#visit-invoice-date-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Fecha de corte facturación visitadores</h1>

<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'visit-invoice-date-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'description',
		'invoiceInitialDate',
		'invoiceClosingDate',
		'invoiceDate',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
