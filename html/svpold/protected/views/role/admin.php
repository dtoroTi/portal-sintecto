<?php
//comment
/* @var $this RoleController */
/* @var $model Role */

$this->breadcrumbs=array(
	'Roles'=>array('admin'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List Role', 'url'=>array('admin')),
	array('label'=>'Create Role', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#role-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Roles Grupo de Usuarios</h1>

<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'role-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		array(
            'class' => 'CButtonColumn',
            'header' => GridViewFilter::getClearButton($this->route),
            'template' => '{permission}{update}',
            'viewButtonUrl' => 'Yii::app()->createUrl("roleview/", array("id"=>$data->id, "clearFilter" => 1))',
            'buttons' => array(
                'update' => array(
                    'visible' => ((Yii::app()->user->isAdmin  || Yii::app()->user->getIsByRole())? 'true' : '$data->canUpdate'),
                ),
                'permission' => array(
                    'label' => '<i class="fa fa-folder-open"></i>',
                    //'imageUrl' => Yii::app()->request->baseUrl . '/images/email.png',
                    'url' => 'Yii::app()->createUrl("role/view", array("id"=>$data->id))',
                    'options' => array('title' => 'Ver/Editar Permisos',),
                ),
            ),
        ),
	),
)); ?>
