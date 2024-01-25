<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
    $this->redirect('/noallowed.html');
}
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->breadcrumbs = array(
    'Invoices' => array('admin'),
    'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#invoice-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Invoices</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'invoice-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'customerGroupId' => array(
            'name' => 'customerGroup.name',
            'header' => 'Group',
            'filter' => CHtml::activeDropDownList($model, 'customerGroupId', CHtml::listData(CustomerGroup::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '100px'),
        ),
        'from' => array(
            'name' => 'from',
            'htmlOptions' => array(
                'width' => '70px',
            ),
        ),
        'until' => array(
            'name' => 'until',
            'htmlOptions' => array(
                'width' => '70px',
            ),
        ),
        'invoiceDate' => array(
            'name' => 'invoiceDate',
            'htmlOptions' => array(
                'width' => '70px',
            ),
        ),
        'number' => array(
            'name' => 'number',
            'htmlOptions' => array(
                'width' => '60px',
                'style' => 'text-align:right',
            ),
        ),
        'invoiceDescriptor',
        'comments' => array(
            'name' => 'comments',
            'value' => '(strlen($data->comments)>50?substr($data->comments,0,47)."...":$data->comments)'
        ),
        'numberOfStudies' => array(
            'name' => 'numberOfStudies',
            'filter' => '',
            'htmlOptions' => array(
                'width' => '100px',
                'style' => 'text-align:right',
            ),
        ),
        'dueOn',
        'totalWithTax' => array(
            'name' => 'totalWithTax',
            'filter' => '',
            'value' => '"$".HtmlHelper::amount($data->totalWithTax,true)',
            'htmlOptions' => array(
                'width' => '100px',
                'style' => 'text-align:right',
            ),
        ),
        'paymentDate',
        'totalReceived' => array(
            'name' => 'totalReceived',
            'filter' => '',
            'value' => '"$".HtmlHelper::amount($data->totalReceived,true)',
            'htmlOptions' => array(
                'width' => '100px',
                'style' => 'text-align:right',
            ),
        ),
        'pendingPayment' => array(
            'name' => 'pendingPayment',
            'filter' => '',
            'value' => '"$".HtmlHelper::amount($data->pendingPayment,true)',
            'htmlOptions' => array(
                'width' => '100px',
                'style' => 'text-align:right',
            ),
        ),
        'closed' => array(
            'name' => 'closed',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'closed', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '40px'),
        ),
        array(
            'header' => 'PreFact',
            'value' => ' CHtml::link(\'<i class="fa fa-file-excel-o "></i>\', array("/invoice/getPreInvoice", "id" => $data->id),array("target"=> "blank"))',
            'type' => 'raw',
            'htmlOptions' => array('width' => '40px', 'style' => 'text-align:center'),
        ),
        /*
          'customerGroupId',
         */
        array(
            'class' => 'CButtonColumn',
            'header' => GridViewFilter::getClearButton($this->route),
            'template' => '{products} {studies} {update} {delete}',
            'viewButtonUrl' => 'Yii::app()->createUrl("invoice/view/", array("id"=>$data->id,"initial"=>1, "clearFilter" => 1))',
            'buttons' => array(
                'delete' => array(
                    'visible' => ((Yii::app()->user->isSuperAdmin || Yii::app()->user->getIsByRole()) ? '($data->deletable)' : 'FALSE'),
                ),
                'update' => array(
                ),
                'studies' => array
                    (
                    'label' => '<i class="fa fa-folder-open"></i>',
                    //                   'imageUrl' => Yii::app()->request->baseUrl . '/images/email.png',
                    'url' => 'Yii::app()->createUrl("invoice/view", array("id"=>$data->id))',
                    'options' => array('title' => 'Ver/Editar Estudios asignados a factura',),
                ),
                'products' => array
                    (
                    'label' => '<i class="fa fa-folder-open-o"></i>',
                    'url' => 'Yii::app()->createUrl("invoice/updateProducts", array("id"=>$data->id))',
                    'options' => array('title' => 'Ver/Editar detalle de productos en factura',
                    ),
                ),
            ),
        ),
    ),
));
?>

<?php if ((Yii::app()->user->isBilling || Yii::app()->user->getIsByRole())): ?>
    <br/>
    <br/>
    <?php
    echo CHtml::button('Exportar Detalle', array(
        'id' => 'export-button',
        'class' => 'span-3 button',
        'onClick' => "window.open('" . Yii::app()->controller->createUrl('/invoice/exportInvoices', array(
            '_export' => true
        )) . "','_blank');"
    ));
    ?>
    <?php



 endif ?>
