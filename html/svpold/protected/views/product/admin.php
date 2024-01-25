<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
    'Products' => array('admin'),
    'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Productos de Security & Vision</h1>

<p>
    Usted puede utilizar alternatvamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php echo CHtml::link('Busqueda Avanzada', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'product-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name' => array(
            'name' => 'name',
            'htmlOptions' => array(
                'width' => '100px'
            ),
        ),
        'unitType' => array(
            'name' => 'unitType',
            'htmlOptions' => array(
                'width' => '40px'
            ),
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
