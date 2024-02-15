<?php
/* @var $this TablaPqrController */
/* @var $model TablaPqr */

$this->breadcrumbs = array(
    'Tabla Pqrs' => array('admin'),
    'Manage',
);

$this->menu=array(
    array('label' => 'List Reclamo', 'url' => array('index')),
    array('label'=> 'Create Reclamo', 'url'=>array('create')),
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

<h1>Quejas y Reclamos</h1>

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
    'id'=>'tabla-pqr-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'nombreId' => array(
            'name' => 'user.summaryLine',
            'header' => 'Nombre Usuario',
            'filter' => CHtml::activeDropDownList($model, 'nombreId', CHtml::listData(User::model()->findAll(array('order' => 'id')), 'id', 'summaryLine'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '200px'),
        ),
        'tipoReclamoId' => array(
            'name' => 'tipoPqr.tipoReclamo',
            'header' => 'Tipo Reclamo',
            'filter' => CHtml::activeDropDownList($model, 'tipoReclamoId', CHtml::listData(TipoPqr::model()->findAll(array('order' => 'id')), 'id', 'tipoReclamo'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '200px'),
        ),
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
