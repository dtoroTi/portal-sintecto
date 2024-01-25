<?php
/* @var $this InvoiceVisitController */
/* @var $model InvoiceVisit */

$this->breadcrumbs=array(
	'Invoice Visits'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List InvoiceVisit', 'url'=>array('index')),
	array('label'=>'Create InvoiceVisit', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#invoice-visit-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Facturación Visitadores</h1>

<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<!--<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//)); ?>
</div>--><!-- search-form -->
<?php
if (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))) {
    echo CHtml::button('Export', array(
        'id' => 'export-button',
        'class' => 'span-5 button',
        'onClick' => "window.open('" . Yii::app()->controller->createUrl('/invoiceVisit/admin', array(
            '_exporttoFactureVis' => true
        )) . "','_blank');"
    ));
}
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'invoice-visit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

		'username' => array(
            'header' => 'Visitador',
            'name' => 'user.username',
            'filter'=>CHtml::activeTextField($model, 'userName'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'firstName' => array(
            'header' => 'Nombre',
            'name' => 'user.firstName',
            'filter'=>CHtml::activeTextField($model, 'firstName'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'lastName' => array(
            'header' => 'Apellido',
            'name' => 'user.lastName',
            'filter'=>CHtml::activeTextField($model, 'lastName'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
		'from',
		'until',
		'invoiceDate',
		'numberStudies',
		'totalValueStudies' => array(
            'name' => 'totalValueStudies',
            'filter' => '',
            'value' => '"$".HtmlHelper::amount($data->totalValueStudies,true)',
            'htmlOptions' => array(
                'width' => '100px',
                'style' => 'text-align:right',
            ),
        ),
        'totalValueAddStudies' => array(
            'name' => 'totalValueAddStudies',
            'filter' => '',
            'value' => '"$".HtmlHelper::amount($data->totalValueAddStudies,true)',
            'htmlOptions' => array(
                'width' => '100px',
                'style' => 'text-align:right',
            ),
        ),
        'totaltransport' => array(
            'name' => 'invoiceVisitDetails.totalValueTransportation',
            'value' =>  '("<div>$".HtmlHelper::amount($data->totalCostTansport,true)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '70px', 'style' => 'text-align: right;'),
        ),
        'totalAliment' => array(
            'name' => 'invoiceVisitDetails.totalValueFeeding',
            'value' =>  '("<div>$".HtmlHelper::amount($data->totalCostFeeding,true)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '70px', 'style' => 'text-align: right;'),
        ),
        'totalpapeleria' => array(
            'name' => 'invoiceVisitDetails.totalValueStationery',
            'value' =>  '("<div>$".HtmlHelper::amount($data->totalCostStationery,true)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '70px', 'style' => 'text-align: right;'),
        ),
		'statusInvoice' => array(
            'name' => 'statusInvoice',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'statusInvoice', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '40px'),
        ),
		'description',
		array(
            'header' => 'PreFact',
            'value' => ' CHtml::link(\'<i class="fa fa-file-excel-o "></i>\', array("/invoiceVisit/getPreInvoiceVisit", "id" => $data->id),array("target"=> "blank"))',
            'type' => 'raw',
            'htmlOptions' => array('width' => '40px', 'style' => 'text-align:center'),
        ),
		array(
            'class' => 'CButtonColumn',
            'header' => GridViewFilter::getClearButton($this->route),
            'template' => '{studies}{update}', //{delete}
            'viewButtonUrl' => 'Yii::app()->createUrl("invoiceVisitDetail/view/", array("id"=>$data->id, "clearFilter" => 1))',
            'buttons' => array(
                'update' => array(
                    'visible' => ((Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))) ? 'true' : '$data->canUpdate'),
                ),
                'studies' => array(
                    'label' => '<i class="fa fa-folder-open"></i>',
                    //'imageUrl' => Yii::app()->request->baseUrl . '/images/email.png',
                    'url' => 'Yii::app()->createUrl("invoiceVisitDetail/view", array("id"=>$data->id))',
                    'options' => array('title' => 'Ver/Editar Estudios asignados a factura',),
                ),
            ),
        ),
	),
)); ?>
