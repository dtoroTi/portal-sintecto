<?php
/* @var $this InvoiceVisitDetailController */
/* @var $model InvoiceVisitDetail */

$this->breadcrumbs=array(
	'Invoice Visit Details'=>array('invoiceVisit/admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List InvoiceVisitDetail', 'url'=>array('index')),
	array('label'=>'Create InvoiceVisitDetail', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#invoice-visit-detail-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Detalle de facturas visitador</h1>

<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>
<div>
    <?php 
        if (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))) { ?>
            <?php echo CHtml::Button('Aprueba Operaciones', array('onclick' => 'ans=confirm("Está seguro de realizar la aprobación de facturas?");if (ans) {aprovedFac(1);}')); ?>
            <?php echo CHtml::Button('No Aprueba Operaciones', array('onclick' => 'ans=confirm("Está seguro de no realizar la aprobación de facturas?");if (ans) {aprovedFac(0);}')); ?>
       <?php }
    ?>  
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'invoice-visit-detail-grid',
    'htmlOptions' => array(),
	'dataProvider'=>$model->search(),
    'selectableRows' => 2,
	'filter'=>$model,
	'columns'=>array(
        array(
            'id' => 'selectedIds',
            'class' => 'CCheckBoxColumn'
        ),
        'id',
		'username' => array(
            'header' => 'Visitador',
            'name' => 'invoiceVisit.user.username',
            //'filter'=>CHtml::activeTextField($model, 'userName'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
		'code' => array(
            'header' => 'Ref.',
            'name' => 'background.code',
			'value' => '(CHtml::link($data->background->code, array("backgroundCheck/update", "code"=>$data->background->code), array("target" => "_blank")))',
            'type' => 'raw',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckCode'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
		'firstName' => array(
            'name' => 'background.firstName',
            'htmlOptions' => array('width' => '130px', 'style' => 'text-align: left;'),
            'filter'=>CHtml::activeTextField($model, 'firstName'),
        ),
        'lastName' => array(
            'name' => 'background.lastName',
            'htmlOptions' => array('width' => '130px', 'style' => 'text-align: left;'),
            'filter'=>CHtml::activeTextField($model, 'lastName'),
        ),
        'idNumber' => array(
            'name' => 'background.idNumber',
			'value' => '($data->background->formatedIdNumber.(count($data->background->otherReportsOfPerson)>0?"<div class=MultipleStudies>**</div>":"").($data->background->inAmendment?"<div class=MultipleStudies>*ENM*</div>":"").($data->background->blacklist?"<div class=MultipleStudies>*LN*</div>":""))',
			'htmlOptions' => array('width' => '80px', 'style' => 'text-align: right;'),
            'type' => 'raw',
            'filter'=>CHtml::activeTextField($model, 'idNumber'),
        ),
		'city' => array(
            'name' => 'background.city',
            'header' => 'Ciudad',
            'htmlOptions' => array('width' => '70px'),
            'filter'=>CHtml::activeTextField($model, 'city'),
        ),
        'CustomerName' => array(
            'name' => 'background.customer.name',
            'filter'=>CHtml::activeTextField($model, 'customerName'),
            'htmlOptions' => array(
                'width' => '130px'
            ),
        ),
        'customerProductName' => array(
            'header' => 'Tipo producto',
            'name' => 'product.name',
            'filter'=>CHtml::activeTextField($model, 'productName'),
            'htmlOptions' => array(
                'width' => '80px'
            ),
        ),
        'studyStartedOn' => array(
            'name' => 'background.studyStartedOn',
            'header' => 'Solicitado',
            'value' => '("<div title=\"Solicitado en:[".$data->background->studyStartedOn."]  Límite en: [".$data->background->studyLimitOn."] Creado en:[".$data->background->created."] \">".substr($data->background->studyStartedOn,2,8)."</div>")',
            'type' => 'raw',
            'filter'=>CHtml::activeTextField($model, 'dateSolic'),
            'htmlOptions' => array('width' => '30px'),
        ),
        'deliveredToCustomerOn' => array(
            'name' => 'background.deliveredToCustomerOn',
            'header' => 'Publicado',
            'value' => '("<div title=\"".$data->background->deliveredToCustomerOn."\">".substr($data->background->deliveredToCustomerOn,2,8)."</div>")',
            'type' => 'raw',
            'filter'=>CHtml::activeTextField($model, 'datepublic'),
            'htmlOptions' => array('width' => '30px'),
        ),
        'total' => array(
            'header' => 'Total %',
            'name'=> 'background.total',
            'value' => '("<div title=\"".$data->background->percentageSummary."\">".$data->background->total."%</div>")',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '35px',
                'style' => 'text-align:right',
            ),
        ),
		'totalValueCostVisit' => array(
            'name' => 'totalValueCostVisit',
            'filter' => '',
            'value' => '"$".HtmlHelper::amount($data->totalValueCostVisit,true)',
            'htmlOptions' => array(
                'width' => '100px',
                'style' => 'text-align:right',
            ),
        ),
		'totalValueAddVisit' => array(
            'name' => 'totalValueAddVisit',
            'filter' => '',
            'value' => '"$".HtmlHelper::amount($data->totalValueAddVisit,true)',
            'htmlOptions' => array(
                'width' => '100px',
                'style' => 'text-align:right',
            ),
        ),
        'totalValueTransportation' => array(
            'name' => 'totalValueTransportation',
            'filter' => '',
            'value' => '"$".HtmlHelper::amount($data->totalValueTransportation,true)',
            'htmlOptions' => array(
                'width' => '100px',
                'style' => 'text-align:right',
            ),
        ),
        'totalValueFeeding' => array(
            'name' => 'totalValueFeeding',
            'filter' => '',
            'value' => '"$".HtmlHelper::amount($data->totalValueFeeding,true)',
            'htmlOptions' => array(
                'width' => '100px',
                'style' => 'text-align:right',
            ),
        ),
        'totalValueStationery' => array(
            'name' => 'totalValueStationery',
            'filter' => '',
            'value' => '"$".HtmlHelper::amount($data->totalValueStationery,true)',
            'htmlOptions' => array(
                'width' => '100px',
                'style' => 'text-align:right',
            ),
        ),
        'visitedOn' => array(
            'header' => 'Visitado',
            'name' => 'visitedOnSection',
            'value' =>  '($data->verifcatedOn)',
            'type' => 'raw',
            'filter' => '',
            'htmlOptions' => array(
                'width' => '30px'
            ),
        ),

        'isApprovedOP' => array(
            'name' => 'isApprovedOP',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'isApprovedOP', Controller::$optionsYesNoNull, array('prompt' => '...')),
            'htmlOptions' => array(
                'width' => '70px',
                'style' => 'text-align:center',
            ),
        ),
		'description',

        /*'assignedUserId' => array(
            'name' => 'background.assignedUserId',
            'header' => 'Asignado a',
            'value' => '($data->background->assignedUserNames)',
            'type' => 'raw',
            'htmlOptions' => array('width' => '80px'),
        ),
        'approved' => array(
            'header' => 'Aprobado',
            'name' => 'background.approved.shortUsername',
            'htmlOptions' => array('width' => '45px'),
        ),*/
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'visible' => ((Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))) ? 'true' : '$data->canDelete'),
                ),
            ),
            //'visible' => Yii::app()->user->isInvoiceVisit,
            'htmlOptions' => array(
                'width' => '20px',
                //'style' => 'text-align:right'
            ),
            'header' => GridViewFilter::getClearButton($this->route,array('id'=>$model->invoiceVisitId,'initial'=>1)),
        ),
	),
)); ?>

<script src="../../mantenimiento/js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../../mantenimiento/css/jquery-ui.css" />

<script type="text/javascript">

    function aprovedFac(value) {

        var studiesIds = $.fn.yiiGridView.getSelection('invoice-visit-detail-grid');
        var studiesCodes = [];

        if(value==1){
            var ruta='<?php echo Yii::app()->createAbsoluteUrl("invoiceVisitDetail/aprovedFac"); ?>';
        }

        if(value==0){
            var ruta='<?php echo Yii::app()->createAbsoluteUrl("invoiceVisitDetail/notAprovedFac"); ?>';
        }

        if (studiesIds.length > 0) {
        
            jQuery.ajax({
                type: 'POST',
                url: ruta,
                data: {'ids':studiesIds},
                dataType: "json",
                success: function (data, status) {
                    if (typeof data.error === 'undefined') {
                        alert(data.error);
                    } else {
                        alert( data.ans);
                    }
                },
                error: function (request, status, error) {
                    alert('Se agrego la información de operaciones con exito.');
                    $.fn.yiiGridView.update("invoice-visit-detail-grid");
                },
            });

        } else {
            alert("Por favor seleccione los estudios que serán validados para aprobación de operaciones.");
        }
    }

</script>
</div>
