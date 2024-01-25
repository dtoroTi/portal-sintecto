<?php
/* @var $this InvoiceVisitCostController */
/* @var $model InvoiceVisitCost */

$this->breadcrumbs=array(
	'Invoice Visit Costs'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List InvoiceVisitCost', 'url'=>array('index')),
	array('label'=>'Create InvoiceVisitCost', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#invoice-visit-cost-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Costos de visitas</h1>

<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'invoice-visit-cost-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'businessLine',
		'descriptionCost',
		'totalVisitCost',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
