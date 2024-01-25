<?php
/* @var $this ActivityTypeController */
/* @var $model ActivityType */

$this->breadcrumbs = array(
    'RequestsSAC' => array('index'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#RequestsSAC-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Solicitudes SAC</h1>

<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>
<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'RequestsSAC-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id' => array(
            'name' => 'id',
            'htmlOptions' => array(
                'width' => '10px'
            ),
        ),
        'businessLine' => array(
            'name' => 'backgroundcheck.customer.businessLine',
            'filter'=>CHtml::activeTextField($model, 'customerBusinessLine'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'username' => array(
            'name' => 'user.username',
            'filter'=>CHtml::activeTextField($model, 'userName'),
            //'filter' => CHtml::activeDropDownList($model, 'userId', CHtml::listData(User::model()->findAll(array('order' => 'username')), 'id', 'username'), array('prompt' => '...')),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'typeRequest' => array(
            'name' => 'typeRequest',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'code' => array(
            'name' => 'backgroundcheck.code',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckCode'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'idNumber' => array(
            'name' => 'backgroundcheck.idNumber',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckidNumber'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'firstName' => array(
            'name' => 'backgroundcheck.firstName',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckFirstname'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'lastName' => array(
            'name' => 'backgroundcheck.lastName',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckLastname'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        /*'applyToPosition' => array(
            'name' => 'backgroundcheck.applyToPosition',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckApplyToPosition'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),*/
        'CustomerName' => array(
            'name' => 'backgroundcheck.customer.name',
            'filter'=>CHtml::activeTextField($model, 'customerName'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'ProductName' => array(
            'name' => 'backgroundcheck.customerProduct.name',
            'filter'=>CHtml::activeTextField($model, 'customerProductName'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'dateRequest' => array(
            'name' => 'dateRequest',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'dateAnswer' => array(
            'name' => 'dateAnswer',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        /*'deliveryDays' => array(
            'name' => 'deliveryDays',
            'htmlOptions' => array(
                'width' => '50px',
                'style' => 'text-align:center',
            ),
        ),
        'shockedby' => array(
            'name' => 'shockedby',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),*/
        'status' => array(
            'name' => 'status',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'observation' => array(
            'name' => 'observation',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'observationOPS' => array(
            'name' => 'observationOPS',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'header' => GridViewFilter::getClearButton($this->route),
        ),
    ),
));

?>

<?php if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()): ?>
    <?php
    echo CHtml::button('Exportar', array(
        'id' => 'export-button',
        'class' => 'span-3 button',
        'onClick' => "window.open('" . Yii::app()->controller->createUrl('/requestsSAC/exportRequestsSAC', array(
            '_export' => true
        )) . "','_blank');"
    ));
    ?>
<?php endif ?>
