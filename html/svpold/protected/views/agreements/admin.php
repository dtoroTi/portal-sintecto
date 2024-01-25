<?php
/* @var $this AgreementsController */
/* @var $model Agreements */

$this->breadcrumbs=array(
	'Agreements'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Agreements', 'url'=>array('admin')),
	array('label'=>'Create Agreements', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#agreements-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Acuerdos</h1>

<p>
    Usted puede utilizar alternatvamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
)); */ ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'agreements-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		//'agreementsText',
		'created',
		'modified',
		array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
			'deleteButtonUrl' => 'Yii::app()->createUrl("agreements/delete/", array("id"=>$data->id))',
            'updateButtonUrl' => 'Yii::app()->createUrl("agreements/update/", array("id"=>$data->id))',
			'buttons' => array(
				'delete' => array(
                    'visible' => (Yii::app()->user->isAgreements ? 'true' : ''),
                ),
            ),
        ),
	),
)); ?>
