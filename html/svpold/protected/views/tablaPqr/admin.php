<?php
/* @var $this TablaPqrController */
/* @var $model TablaPqr */

$this->breadcrumbs=array(
    'Tabla Pqrs'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'Create Reclamo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#tabla-pqr-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");

?>

<h1>Manage Tabla Pqrs</h1>

<p>
Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al principio de cada uno de sus valores de búsqueda para especificar cómo debe realizarse la comparación.
</p>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'tabla-pqr-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'nombreId',
        'tipoReclamoId',
        'nota',
        'descripcion',
        'fechaReclamo',
        'estadoReclamo',
        'fechaRespuesta',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
