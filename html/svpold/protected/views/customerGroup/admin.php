<?php
/* @var $this CustomerGroupController */
/* @var $model CustomerGroup */
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Customer Groups' => array('admin'),
    'Listado',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#customer-group-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Grupos de Clientes</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'customer-group-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name',
        'invoiceDay',
        'invoiceClosingDay',
        'paymentTerms',
        array(
            'name' => 'user.username',
            'header' => 'Asignado',
            'filter' => CHtml::activeDropDownList($model, 'userId', CHtml::listData(User::model()->findAll(array('order' => 'username')), 'id', 'username'), array('prompt' => '...')),
        ),
        'invoicePerCustomer' => array(
            'name' => 'invoicePerCustomer',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'invoicePerCustomer', Controller::$optionsYesNo, array('prompt' => '...')),
        ),
        'invoiceFieldId',
        array(
            'header' => 'Rep.',
            'value' => 'CHtml::link("<i class=\"fa fa fa-file-text\"></i>", "#",array("onclick"=>"selectDates($data->id)","title"=>"Reporte de Group de Clientes") )',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '35px',
                'style' => 'text-align:center',
            ),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update} {delete}',
            'header' => GridViewFilter::getClearButton($this->route),
            'buttons' => array(
                'delete' => array(
                    'visible' => '$data->canBeDeleted',
                ),
            ),
        ),
    ),
));
?>



<script>
    function selectDates(id) {
        $("#getReportButton").focus();
        $('#dialogConfirm #customerGroupId').val(id);
        $("#dialogConfirm").dialog("open");
    }


    $(function () {
        $("#dialogConfirm").dialog({
            resizable: true,
            modal: true,
            autoOpen: false,
            width: 900,
            buttons: {
                Reporte: function () {
                    $('#reportForm').submit();
                },
                Cancelar: function () {
                    $(this).dialog("close");
                }
            }
        });
    });
</script>


<div id="dialogConfirm" title="Basic dialog">

    <?php
    $this->renderPartial('/customerGroup/_selectReportDates', array(
//        'backgroundChecks' => array(),
    ));
    ?>
</div>