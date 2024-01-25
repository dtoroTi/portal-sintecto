<?php
/* @var $this DynamicFormJSONController */
/* @var $model DynamicFormJSON */

$this->breadcrumbs=array(
	'Dynamic Form Jsons'=>array('admin'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#dynamic-form-json-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Formularios Dinámicos</h1>

<p>
    Usted puede utilizar alternatvamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'dynamic-form-json-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'createdAt',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
