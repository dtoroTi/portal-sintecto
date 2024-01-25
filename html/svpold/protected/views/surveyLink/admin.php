<?php
/* @var $this ActivityTypeController */
/* @var $model ActivityType */

$this->breadcrumbs = array(
    'SurveyLink' => array('admin'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#SurveyLink-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Links Ingresados</h1>

<p>
    Usted puede utilizar alternatvamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'SurveyLink-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id' => array(
            'name' => 'id',
            'htmlOptions' => array(
                'width' => '10px'
            ),
        ),
        'name' => array(
            'name' => 'name',
            'htmlOptions' => array(
                'width' => '30px'
            ),
        ),
        'link' => array(
            'name' => 'link',
            'htmlOptions' => array(
                'width' => '40px'
            ),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
        ),
    ),
));
?>
