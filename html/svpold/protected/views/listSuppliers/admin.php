<?php
/* @var $this ListSuppliersController */
/* @var $model ListSuppliers */

$this->breadcrumbs=array(
	'List Suppliers'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ListSuppliers', 'url'=>array('index')),
	array('label'=>'Create ListSuppliers', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#list-suppliers-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar lista de proveedores</h1>

<p>
Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) al principio de cada valor para especificar que tipo de comparacion desea hacer.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'list-suppliers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'id',
		'name',
		'typeDoc',
		'document',
		'phone',
		'email',
		'cityService',
		'address',
		'price',
		'serviceProvidedId' => array(
			'name' => 'serviceProvided.name',
			'header' => 'Servicio Prestado',
			'filter' => CHtml::activeDropDownList($model, 'serviceProvidedId', CHtml::listData(ServiceProvided::model()->findAll(array('order' => 'id')), 'id', 'name'), array('prompt' => '...')),
			'htmlOptions' => array('width' => '200px'),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>


<?php
echo CHtml::button('Exportar', array(
	'id' => 'export-button',
	'class' => 'span-3 button',
	'onClick' => "window.open('" . Yii::app()->controller->createUrl('/listSuppliers/exportListSuppliers', array(
		'_export' => true
	)) . "','_blank');"
));
?>
