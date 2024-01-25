<?php

$this->breadcrumbs = array(
    'Background Checks' => array('index'),
    'VCSP',
);

$this->menu = array(
    array('label' => 'List BackgroundCheck', 'url' => array('index')),
    array('label' => 'Create BackgroundCheck', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('background-check-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Estudios de Seguridad Clientes Plan Piloto</h1>

<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>
<?php //echo CHtml::link('Busqueda Avanzada', '#', array('class' => 'search-button')); ?>
<div class="search-form" >
    <?php
    $this->renderPartial('/backgroundCheck/_searchPiloto', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php

$listblack = $model->BlackList();


$this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'background-check-grid',
    'dataProvider' => $model->searchForPiloto(),
    'filter' => $model,
    'columns' => array(
        'customer' => array(
            'name' => 'customer.name',
            'filter' => CHtml::activeDropDownList($model, 'customerId', CHtml::listData(Customer::model()->findAll(array('condition' =>'isPilot=1','order' => 'name')), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '100px'),
        ),
        'customerPilot' => array(
            'name' => 'customer.isPilot',
            'header' => 'Tipo Cliente',
            'value' => '($data->customer->isPilot=1?"Plan Piloto":"")',
            'htmlOptions' => array('width' => '20px'),
        ),
        'code' => array(
            'name' => 'code',
            'htmlOptions' => array('width' => '20px'),
        ),
        'customerProductName' => array(
            'name' => 'customerProduct.name',
            'header' => 'Tipo',
            'htmlOptions' => array('width' => '80px'),
            'filter' => CHtml::activeTextField($model, 'customerProductName'),
        ),
        'backgroundCheckStatusId' => array(
            'name' => 'backgroundCheckStatus.name',
            'header' => 'Estado',
            'htmlOptions' => array('width' => '80px'),
        ),
        'firstName' => array(
            'name' => 'firstName',
            'htmlOptions' => array('width' => '130px'),
        ),
        'lastName' => array(
            'name' => 'lastName',
            'htmlOptions' => array('width' => '130px'),
        ),

        'idNumber' => array(
            'name' => 'idNumber',
            'value' => '($data->formatedIdNumber.(count($data->otherReportsOfPerson)>0?"<div class=MultipleStudies>**</div>":"").($data->inAmendment?"<div class=MultipleStudies>*ENM*</div>":"").($data->blacklist?"<div class=MultipleStudies>*LN*</div>":""))',
            'htmlOptions' => array('width' => '80px'),
            'type' => 'raw',
        ),
        array(
            'name' => 'assignedUserId',
            'header' => 'Última hora de Entrega por OPS',
            'value' => '$data->getSectionDateFinis()',
            'type' => 'raw',
            'htmlOptions' => array('width' => '90px'),
            'filter' => '',
        ),
        'approvedOn' => array(
            'name' => 'approvedOn',
            'header' => 'Aprob. En',
            'value' => '("<div title=\"".$data->approvedOn."\">".substr($data->approvedOn,0,20)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '90px'),
        ),
        'deliveredToCustomerOn' => array(
            'name' => 'deliveredToCustomerOn',
            'header' => 'Fecha Public.',
            'value' => '("<div title=\"".$data->deliveredToCustomerOn."\">".substr($data->deliveredToCustomerOn,0,10)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '90px'),
        ),
        array(
            'name' => 'assignedUserId',
            'header' => 'Entregado a',
            'value' => '$data->getTimeDelivered()',
            'type' => 'raw',
            'htmlOptions' => array('width' => '90px'),
            'filter' => '',
        ),
        'deliveredToCustomerOnHour' => array(
            'name' => 'deliveredToCustomerOn',
            'header' => 'Hora Publi.',
            'value' => '("<div title=\"".$data->deliveredToCustomerOn."\">".substr($data->deliveredToCustomerOn,10,10)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '90px'),
        ),
        'customerProductLimit' => array(
            'name' => 'customerProduct.maxDays',
            'header' => 'Limite Días Cliente',
            'htmlOptions' => array('width' => '30px'),
        ),
        array(
            'name' => 'assignedUserId',
            'header' => 'Dias usados',
            'value' => '$data->getDaysStudy()',
            'type' => 'raw',
            'htmlOptions' => array('width' => '90px'),
            'filter' => '',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '',
            'htmlOptions' => array('width' => '15px', 'style' => 'text-align:right'),
            'header' => GridViewFilter::getClearButton($this->route),
        ),
    ),

));
?>
