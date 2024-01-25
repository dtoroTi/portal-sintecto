<?php
//comment
/* @var $this PermissionController */
/* @var $model Permission */

$this->breadcrumbs=array(
	'Permissions'=>array('admin'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List Permission', 'url'=>array('index')),
	array('label'=>'Create Permission', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#permission-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Permisos</h1>

<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>
<style>
#permission-grid {width: 1200px;}
</style>

<?php $this->widget('zii.widgets.grid.CGridView', [
	'id'=>'permission-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>[
		'id',
		'controller',
		'action',
		'permission' => [
			'name' => 'permission',
			'htmlOptions' => array('width' => '250px'),
		],
		'description' => [
			'name' => 'description',
			'htmlOptions' => array('width' => '450px'),
		],
		'rolelist' => [
            'name' => 'rolesListstr',
            'header' => 'Lista Roles',
            'filter' => CHtml::activeDropDownList($model, 'roleId', CHtml::listData(Role::model()->findAll(['order' => 'name']), 'id', 'name'), ['prompt' => '...']),
            'htmlOptions' => ['width' => '250px'],
		],
		[
            'class' => 'CButtonColumn',
            'header' => GridViewFilter::getClearButton($this->route),

		],
	],
]); ?>

