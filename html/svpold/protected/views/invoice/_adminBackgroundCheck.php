<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
    $this->redirect('/noallowed.html');
}
/* @var $invoice Invoice */

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
if ($invoice->dayslastDateOfInvoices() >= 30){
    Yii::app()->clientScript->registerScript('findAll', "
     $('#btnContectBackgroundCheck :input').prop('disabled', true);
    ");
}
?>

<?php //echo CHtml::link('Busqueda Avanzada', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
//    $this->renderPartial('_searchForInvoice', array(
//        'model' => $model,
//    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'background-check-grid',
    'dataProvider' => $model->searchForInvoice($invoice),
    'filter' => $model,
    'columns' => array(
        'customer' => array(
            'name' => 'customer.name',
            'filter' => CHtml::activeDropDownList($model, 'customerId', CHtml::listData(Customer::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '100px'),
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
        'city' => array(
            'name' => 'city',
            'header' => 'city',
            'htmlOptions' => array('width' => '70px'),
        ),
        'invoiceSelection' => array(
            'name' => 'invoice.number',
            'header' => 'Fact. Num.',
            'filter' => CHtml::activeDropDownList($model, 'invoiceSelection', Invoice::getStudySlectionShort()),
            'htmlOptions' => array('width' => '40px'),
        ),
        'resultId' => array(
            'name' => 'result.name',
            'header' => 'Res.',
            'filter' => CHtml::activeDropDownList($model, 'resultId', CHtml::listData(Result::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '40px'),
        ),
        'firstName' => array(
            'name' => 'firstName',
            'value' => '(CHtml::link("$data->firstName", array("backgroundCheck/update", "code"=>"$data->code" ), array("target" => "_blank"))).(count($data->otherReportsOfPerson)>0?"<div class=MultipleStudies>[** Rep]</div>":"")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '130px', 'style' => 'text-align: left;'),
        ),
        'lastName' => array(
            'name' => 'lastName',
            'value' => '(CHtml::link("$data->lastName", array("backgroundCheck/update", "code"=>"$data->code" ), array("target" => "_blank")))',
            'type' => 'raw',
            'htmlOptions' => array('width' => '130px', 'style' => 'text-align: left;'),
        ),
        'idNumber' => array(
            'name' => 'idNumber',
            'value' => '(CHtml::link("$data->formatedIdNumber", array("backgroundCheck/update", "code"=>"$data->code" ), array("target" => "_blank"))).(count($data->otherReportsOfPerson)>0?"<div class=MultipleStudies>**</div>":"")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '80px', 'style' => 'text-align: right;'),
        ),
        'studyStartedOn' => array(
            'name' => 'studyStartedOn',
            'header' => 'Solic',
            'value' => '("<div title=\"Solicitado en:[".$data->studyStartedOn."]  Límite en: [".$data->studyLimitOn."] Creado en:[".$data->created."] \">".substr($data->studyStartedOn,2,8)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '30px'),
        ),
        'deliveredToCustomerOn' => array(
            'name' => 'deliveredToCustomerOn',
            'header' => 'Pub.',
            'value' => '("<div title=\"".$data->deliveredToCustomerOn."\">".substr($data->deliveredToCustomerOn,2,8)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '30px'),
        ),
        'total' => array(
            'header' => 'Tot %',
            'name'=> 'total',
            'value' => '("<div title=\"".$data->percentageSummary."\">".$data->total."%</div>")',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '35px',
                'style' => 'text-align:right',
            ),
        ),
        'price' => array(
            'name' => 'price',
            'value' => ($invoice->closed?
                    '"$".HtmlHelper::amount($data->price,true)':
                '(CHtml::link("$".HtmlHelper::amount($data->price,true), array("invoice/updatePrice", "code"=>"$data->code","id"=>"'.$invoice->id.'" )))'),
            'type' => 'raw',
            'htmlOptions' => array('width' => '70px', 'style' => 'text-align: right;'),
        ),
        'diff' => array(
            'header' => 'Dif',
            'value' => ($invoice->closed?'':
                '($data->getIsPriceDifferent()?'.
                '("<div class=MultipleStudies>$".HtmlHelper::amount($data->getPriceDifference(),true))."</div>"'.
                ':'.
                '"")'
                )
            ,
            'type' => 'raw',
            'htmlOptions' => array('width' => '70px', 'style' => 'text-align: right;'),
        ),
        'additionalPrice' => array(
            'name' => 'additionalPrice',
            'value' =>  '("<div title=\"".$data->additionalPriceComment."\">$".HtmlHelper::amount($data->additionalPrice,false)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '70px', 'style' => 'text-align: right;'),
        ),

//        'price' => array(
//            'name' => 'price',
//            'value' => '"$".HtmlHelper::amount($data->price,true)',
//            'htmlOptions' => array(
//                'width' => '70px',
//                'style' => 'text-align:right',
//            ),
//            'filter' => '',
//        ),
        'assignedUserId' => array(
            'name' => 'assignedUserId',
            'header' => 'Asignado a',
            'value' => '($data->assignedUserNames)',
            'type' => 'raw',
            'filter' =>
            (Yii::app()->user->isAdmin ?
                    CHtml::activeDropDownList($model, 'assignedUserId', //
                            GridViewFilter::getNullArray() +
                            CHtml::listData(User::model()->findAll(array('order' => 'firstName')), 'id', 'name'), array('prompt' => '...')) :
                    ''),
            'htmlOptions' => array('width' => '80px'),
        ),
        'approved' => array(
            'header' => 'Aprobado',
            'name' => 'approved.shortUsername',
            'filter' =>
            CHtml::activeDropDownList($model, 'approvedBy', CHtml::listData(User::model()->findAll(
                                    array(
                                        'order' => 'firstName',
                                        'condition' => 'userTypeId <= :id',
                                        'params' => array(':id' => UserType::SES_ADMIN))
                            ), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '45px'),
        ),
        'reportAvailable' => array(
            'name' => 'reportAvailable',
            'header' => 'Rep.',
            'value' => '(($data->reportAvailable || $data->temporalReportAvailable)?CHtml::link(($data->reportAvailable?("Rep(".$data->numberOfDownloads.")"):"Temp."), array("backgroundCheck/reportPdf", "code"=>$data->code ), array("target" => "_blank")):"")',
            'type' => 'raw',
            'filter' => CHtml::activeDropDownList($model, 'reportAvailable', Controller::$optionsYesNo, array(
                'prompt' => '...'
            )),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => GridViewFilter::getClearButton($this->route,array('id'=>$invoice->id,'initial'=>1)),
            'template' => '{Add}{Del}',
            'buttons' => array(
                'Add' => array(
                    'label' => '<input type=checkbox '.($invoice->closed?'Disabled=1':'').'>',
                    'click' => "function(){
                                    $.fn.yiiGridView.update('background-check-grid', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data) {
                                              $.fn.yiiGridView.update('background-check-grid');
                                             updateInvoiceData();
                                        }
                                    });
                                    return false;
                              }
                     ",
                    'url' => 'Yii::app()->createUrl("invoice/assignInvoice",array("code"=>$data->code,"id"=>' . $invoice->id . ',"add"=>1))',
                    'visible' => 'empty($data->invoiceId)',
                ),
                'Del' => array(
                    'label' => '<input type=checkbox checked '.($invoice->closed?'Disabled=1':'').'>',
                    'click' => "function(){
                                    $.fn.yiiGridView.update('background-check-grid', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data) {
                                              $.fn.yiiGridView.update('background-check-grid');
                                              updateInvoiceData();
                                        }
                                    });
                                    return false;
                              }
                     ",
                    'url' => 'Yii::app()->createUrl("invoice/assignInvoice",array("code"=>$data->code,"id"=>' . $invoice->id . ',"add"=>0))',
                    'visible' => '$data->invoiceId ==' . $invoice->id,
                ),
            ),
        ),
    ),
        )
);
?>

<br/>
<div id="btnContectBackgroundCheck">
<?php if (!$invoice->closed) :?>
<?php
echo CHtml::ajaxButton('Asignar Todos', CHtml::normalizeUrl(array('invoice/assignInvoiceToSelectedStudies', 'id' => $invoice->id, 'assignSelected' => 1)), array(
    'success' => 'js:function(data) {alert("Se asignaron " +data+" procesos");$.fn.yiiGridView.update("background-check-grid");}',
        ), array('name' => 'assigndSelected', 'class' => 'btn btn-success', 'confirm' => 'Desea asignar toda las selección? (Se puede demorar un poco esta operacion!)',
        )
);
?>

<?php
echo CHtml::ajaxButton('Desasignar Todos', CHtml::normalizeUrl(array('invoice/assignInvoiceToSelectedStudies', 'id' => $invoice->id, 'assignSelected' => 2)), array(
    'success' => 'js:function(data) {alert("Se asignaron " +data+" procesos");$.fn.yiiGridView.update("background-check-grid");}',
        ), array('name' => 'deassignSelected', 'class' => 'btn btn-success', 'confirm' => 'Desea desasignar toda las selección? (Se puede demorar un poco esta operacion!)',)
);
?>
<?php endif;?>
</div>
