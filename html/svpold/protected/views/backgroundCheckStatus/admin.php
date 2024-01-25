<?php
$this->breadcrumbs = array(
    'Background Check Statuses' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List BackgroundCheckStatus', 'url' => array('admin')),
    array('label' => 'Create BackgroundCheckStatus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('background-check-status-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Estados de los Estudios de Seguridad</h1>

<p>
  Usted puede utilizar alternatvamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
  or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
  <?php
  $this->renderPartial('_search', array(
      'model' => $model,
  ));
  ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'background-check-status-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'name',
        array(
            'class' => 'CButtonColumn',
            'template'=>'{view} {update}',
            'header' => GridViewFilter::getClearButton($this->route),
        ),
    ),
));
?>
