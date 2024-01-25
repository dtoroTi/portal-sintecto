<?php
/* @var $this ActivityTypeController */
/* @var $model ActivityType */

$this->breadcrumbs = array(
    'Activity Types' => array('index'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#activity-type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Activity Types</h1>

<p>
  You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
  or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'activity-type-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'name',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}',
        ),
    ),
));
?>
