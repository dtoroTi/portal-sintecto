<?php
/* @var $this TipoPqrController */
/* @var $model TipoPqr */

$this->breadcrumbs=array(
	'Tipo Pqrs'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TipoPqr', 'url'=>array('index')),
	array('label'=>'Create TipoPqr', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tipo-pqr-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Tipos Quejas y Reclamos</h1>

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
	'id'=>'tipo-pqr-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'tipoReclamo',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
