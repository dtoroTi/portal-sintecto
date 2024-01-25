<?php
if(!Yii::app()->user->arUser || !Yii::app()->user->arUser->hasAccessToReports){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Estudios de seguridad' => array('index'),
    'Listado',
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

<h1>Estudios de Seguridad</h1>

<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
    <?php

    ?>
</p>

<?php
/*
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'background-check-grid',
    'dataProvider' => $model->searchClient($type),
    'filter' => $model,
    'columns' => array(
        'code' => array(
            'name' => 'code',
            'htmlOptions' => array('width' => '50px'),
        ),
        'customerUserId' => array(
            'name' => 'customerUser.username',
            'header' => 'Usuario',
            'htmlOptions' => array('width' => '120px'),
        ),
        'customerProductId' => array(
            'name' => 'customerProduct.name',
            'header' => 'Tipo',
            'htmlOptions' => array('width' => '120px'),
        ),
        'customer.name' => array(
            'name' => 'customer.name',
            'header' => 'Cliente',
            'filter' => CHtml::activeDropDownList($model, 'customerId', CHtml::listData(Customer::model()->findAllByAttributes(array('customerGroupId' => $user->customer->customerGroupId)), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '120px'),
            'visible' => Yii::app()->user->getIsGroupSupervisor(),
        ),
        'customerField1' => array(
            'name' => 'customerField1',
            'header' => $user->customer->field1,
            'htmlOptions' => array('width' => '120px'),
            'visible' => !empty($user->customer->field1),
        ),
        'customerField2' => array(
            'name' => 'customerField2',
            'header' => $user->customer->field2,
            'htmlOptions' => array('width' => '120px'),
            'visible' => !empty($user->customer->field2),
        ),
        'customerField3' => array(
            'name' => 'customerField3',
            'header' => $user->customer->field3,
            'htmlOptions' => array('width' => '120px'),
            'visible' => !empty($user->customer->field3),
        ),
        'backgroundCheckStatusId' => array(
            'name' => 'backgroundCheckStatus.name',
            'header' => 'Estado',
            'filter' => CHtml::activeDropDownList($model, 'backgroundCheckStatusId', CHtml::listData(BackgroundCheckStatus::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
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
            'htmlOptions' => array('width' => '80px'),
        ),
        'studyStartedOn' => array(
            'name' => 'studyStartedOn',
            'htmlOptions' => array('width' => '60px'),
        ),
        'studyLimitOn' => array(
            'name' => 'studyLimitOn',
            'htmlOptions' => array('width' => '60px'),
        ),
 	'deliveredToCustomerOn' => array(
           'name' => 'deliveredToCustomerOn',
           'htmlOptions' => array('width' => '60px'),
        ),
        'reportAvailable' => array(
            'name' => 'reportAvailable',
            'header' => 'Rep.',
            'value' => '(($data->isReportAvailable || $data->isTemporalReportAvailable)?CHtml::link(($data->isReportAvailable?("Rep(".$data->numberOfDownloads.")"):"Temp."), array("vetting/v/", "code"=>$data->code ), array("target" => "_blank")):"")',
            'type' => 'raw',
            'filter' => CHtml::activeDropDownList($model, 'reportAvailable', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '40px'),
            'visible' => $user->accessToPdfReport,
        ),
        'certificateAvailable' => array(
            'name' => 'certificateAvailable',
            'header' => 'Cert.',
            'value' => '($data->isCertificateAvailable?CHtml::link("Cert.", array("vetting/VC", "code"=>$data->code ), array("target" => "_blank")):"")',
            'type' => 'raw',
            'filter' => CHtml::activeDropDownList($model, 'certificateAvailable', Controller::$optionsYesNo, array(
                'prompt' => '...'
            )),
            'htmlOptions' => array(
                'width' => '20px'
            ),
            'visible' => $user->hasAccessToCertificates,
        ),
        'numberOfEvents' => array(
            'name' => 'numberOfEvents',
            'value' => '("<div title=\"".$data->eventsDescription."\">".$data->numberOfEvents."</div>")',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '35px',
                'style' => 'text-align:right',
            ),
            'filter' => '',
        ),
        'total' => array(
            'header' => 'Tot %',
            'value' => '("<div title=\"".$data->percentageSummary."\">".$data->total."%</div>")',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '35px',
                'style' => 'text-align:right',
            ),
        ),
        'result' => array(
            'name' => 'result.nick',
            'value' => '($data->isReportAvailable?$data->result->nick:"Sin Res.")',
            'filter' => '',
            'htmlOptions' => array('width' => '35px'),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => ' ',
            'htmlOptions' => array('width' => '15px', 'style' => 'text-align:right'),
            'header' => GridViewFilter::getClearButton($this->route),
            'viewButtonUrl' => 'Yii::app()->createUrl("vetting/v/", array("code"=>$data->code))',
        ),
    ),
));
*/

if ($user->customerId == 529) {

    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'background-check-grid',
        'dataProvider' => $model->searchClient($type),
        'filter' => $model,
        'columns' => array(
            'code' => array(
                'name' => 'code',
                'htmlOptions' => array('width' => '50px'),
            ),
            'customerUserId' => array(
                'name' => 'customerUser.username',
                'header' => 'Usuario',
                'htmlOptions' => array('width' => '120px'),
                'filter' => CHtml::activeDropDownList(//
                    $model, //
                    'customerUserId', //
                    CHtml::listData(
                        $model->customer ? $model->customer->customerUsers : array(), //
                        'id', //
                        'username'), //
                    array('prompt' => '...',)),


            ),
            'customerProductId' => array(
                'name' => 'customerProduct.name',
                'header' => 'Tipo',
                'htmlOptions' => array('width' => '120px'),
                'filter' =>CHtml::activeDropDownList(//
                    $model, //
                    'customerProductId', //
                    CHtml::listData(
                        $model->customer ? $model->customer->customerProducts : array(), //
                        'id', //
                        'name'),
                    array('prompt' => '...',)),

            ),
            'customer.name' => array(
                'name' => 'customer.name',
                'header' => 'Cliente',
                'filter' => CHtml::activeDropDownList($model, 'customerId', CHtml::listData(Customer::model()->findAllByAttributes(array('customerGroupId' => $user->customer->customerGroupId)), 'id', 'name'), array('prompt' => '...')),
                'htmlOptions' => array('width' => '120px'),
                'visible' => Yii::app()->user->getIsGroupSupervisor(),
            ),
            'customerField1' => array(
                'name' => 'customerField1',
                'header' => $user->customer->field1,
                'htmlOptions' => array('width' => '120px'),
                'visible' => !empty($user->customer->field1),
            ),
            'customerField2' => array(
                'name' => 'customerField2',
                'header' => $user->customer->field2,
                'htmlOptions' => array('width' => '120px'),
                'visible' => !empty($user->customer->field2),
            ),
            'customerField3' => array(
                'name' => 'customerField3',
                'header' => $user->customer->field3,
                'htmlOptions' => array('width' => '120px'),
                'visible' => !empty($user->customer->field3),
            ),
            'backgroundCheckStatusId' => array(
                'name' => 'backgroundCheckStatus.name',
                'header' => 'Estado',
                'filter' => CHtml::activeDropDownList($model, 'backgroundCheckStatusId', CHtml::listData(BackgroundCheckStatus::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
                'htmlOptions' => array('width' => '80px'),
            ),
            'applyToPosition' => array(
                'name' => 'applyToPosition',
                'header' => 'Cargo Aspira',
                'htmlOptions' => array('width' => '130px'),
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
                'htmlOptions' => array('width' => '80px'),
            ),
            'studyStartedOn' => array(
                'name' => 'studyStartedOn',
                'value' => 'substr($data->studyStartedOn,0,10)',
                'htmlOptions' => array('width' => '60px'),
            ),
            'studyLimitOn' => array(
                'name' => 'studyLimitOn',
                'value' => 'substr($data->studyLimitOn,0,10)',
                'htmlOptions' => array('width' => '60px'),
            ),
            'deliveredToCustomerOn' => array(
                'name' => 'deliveredToCustomerOn',
                'htmlOptions' => array('width' => '60px'),
            ),
            array(
                'header' => 'Vence',
                'value' => '$data->expireIn',
                'filter' => '',
                'htmlOptions' => array('width' => '35px'),
            ),
            'reportAvailable' => array(
                'name' => 'reportAvailable',
                'header' => 'Rep.',
                'value' => '(($data->isReportAvailable || $data->isTemporalReportAvailable)?CHtml::link(($data->isReportAvailable?("Rep(".$data->numberOfDownloads.")"):"Temp."), array("vetting/v/", "code"=>$data->code), array("target" => "_blank")):"")." "'.
                (!$user->customer->accessToanexos?"":
                '.(($data->isReportAvailable || $data->isTemporalReportAvailable)?CHtml::link("<br><br><center><img src=\"/css/sindoc.png\"/></center>", array("vetting/viewPdfSindoc/", "code"=>$data->code ), array("target" => "_blank")):"")'),
                'type' => 'raw',
                'filter' => CHtml::activeDropDownList($model, 'reportAvailable', Controller::$optionsYesNo, array('prompt' => '...')),
                'htmlOptions' => array('width' => '40px'),
                'visible' => $user->accessToPdfReport,
            ),
            'certificateAvailable' => array(
                'name' => 'certificateAvailable',
                'header' => 'Cert.',
                'value' => '($data->isCertificateAvailable?CHtml::link("Cert.", array("vetting/VC", "code"=>$data->code ), array("target" => "_blank")):"")',
                'type' => 'raw',
                'filter' => CHtml::activeDropDownList($model, 'certificateAvailable', Controller::$optionsYesNo, array(
                    'prompt' => '...'
                )),
                'htmlOptions' => array(
                    'width' => '20px'
                ),
                'visible' => $user->hasAccessToCertificates,
            ),

            /*'numberOfEvents' => array(
                'name' => 'numberOfEvents',
                'value' => '("<div title=\"".$data->eventsDescription."\">".$data->numberOfEvents."</div>")',
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '35px',
                    'style' => 'text-align:right',
                ),
                'filter' => '',
            ),*/

           'numberOfEvents' => array(
                //'header' => 'numero de eventos',
                'name' => 'numberOfEvents',
                //'value' => '("<div title=\"".$data->eventsDescription."\">".$data->numberOfEvents."</div>")',
                'value' =>(!$user->customer->graphicsNews?"":'CHtml::link("<i>".$data->numberOfEvents."</i>", "#",array("onclick"=>"selectNovedades(\"$data->code\")","title"=>"Reporte de Novedades"))').($user->customer->graphicsNews?"":'("<div title=\"".$data->eventsDescription."\">".$data->numberOfEvents."</div>")'),
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '35px',
                    'style' => 'text-align:right',
                ),
                'filter' => '',
            ),

            'total' => array(
                'header' => 'Avance del Proceso',
                'value' => '("<div title=\"".$data->percentageSummary."\">".$data->total."%</div>")',
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '35px',
                    'style' => 'text-align:right',
                ),
            ),

            //Creado Por Jonathan

            'Componentes' => array(
                'header' => 'Componentes de Concepto'."<div style=color:#6caace>______________________________________</div>",
                //   'value' => '(" \"".$data->percentageSummaryComp."\""."<div style=color:#6caace>_____________________________________________________</div>")',
                'value' => '(" \"".$data->percentageSummaryComp."\"")',
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '200px',
                    'style' => 'text-align:justify',

                ),
            ),

            //Creado por Jonathan

            'result' => array(
                'name' => 'result.nick',
                'value' => '($data->isReportAvailable?$data->result->nick:"Sin Res.")',
                'filter' => '',
                'htmlOptions' => array('width' => '35px'),
            ),
            array(
                'header' => 'Eval.',
                'value' => '($data->evaluationResult)',
                'filter' => '',
                'htmlOptions' => array('width' => '35px'),
            ),
            array(
                'header' => 'Cal.',
                'value' => '($data->evaluationValue?$data->evaluationValue."%":"")',
                'filter' => '',
                'htmlOptions' => array('width' => '35px'),
            ),

            array(
                'class' => 'CButtonColumn',
                'template' => ' ',
                'htmlOptions' => array('width' => '15px', 'style' => 'text-align:right'),
                'header' => GridViewFilter::getClearButton($this->route),
                'viewButtonUrl' => 'Yii::app()->createUrl("vetting/v/", array("code"=>$data->code))',
            ),
           'Cancelar' => array(
                'header' => 'Cancelar',
                //'value' => '($data->isCancelarAviable?CHtml::link("Cancelar", array("vetting/UpdateCancelar2", "code"=>$data->code )):"")',
                'value' => '($data->isCancelarAviable?CHtml::link("Cancelar",
                array("vetting/UpdateCancelar2","code"=>$data->code),
                array("confirm" => "Está seguro de cancelar la solicitud del estudio?")
                ):"")',
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '20px'
                ),
            ),

        ),
    ));
}

elseif($user->customer->customerGroupId==1 or $user->customer->customerGroupId==37 or $user->customer->customerGroupId==250){
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'background-check-grid',
        'dataProvider' => $model->searchClient($type),
        'filter' => $model,
        'columns' => array(
            'code' => array(
                'name' => 'code',
                'htmlOptions' => array('width' => '50px'),
            ),
            'customerUserId' => array(
                'name' => 'customerUser.username',
                'header' => 'Usuario',
                'htmlOptions' => array('width' => '120px'),
                'filter' => CHtml::activeDropDownList(//
                    $model, //
                    'customerUserId', //
                    CHtml::listData(
                        $model->customer ? $model->customer->customerUsers : array(), //
                        'id', //
                        'username'), //
                    array('prompt' => '...',)),


            ),
            'customerProductId' => array(
                'name' => 'customerProduct.name',
                'header' => 'Tipo',
                'htmlOptions' => array('width' => '120px'),
                'filter' =>CHtml::activeDropDownList(//
                    $model, //
                    'customerProductId', //
                    CHtml::listData(
                        $model->customer ? $model->customer->customerProducts : array(), //
                        'id', //
                        'name'),
                    array('prompt' => '...',)),

            ),
            'customer.name' => array(
                'name' => 'customer.name',
                'header' => 'Cliente',
                'filter' => CHtml::activeDropDownList($model, 'customerId', CHtml::listData(Customer::model()->findAllByAttributes(array('customerGroupId' => $user->customer->customerGroupId)), 'id', 'name'), array('prompt' => '...')),
                'htmlOptions' => array('width' => '120px'),
                'visible' => Yii::app()->user->getIsGroupSupervisor(),
            ),
            'customerField1' => array(
                'name' => 'customerField1',
                'header' => $user->customer->field1,
                'htmlOptions' => array('width' => '120px'),
                'visible' => !empty($user->customer->field1),
            ),
            'customerField2' => array(
                'name' => 'customerField2',
                'header' => $user->customer->field2,
                'htmlOptions' => array('width' => '120px'),
                'visible' => !empty($user->customer->field2),
            ),
            'customerField3' => array(
                'name' => 'customerField3',
                'header' => $user->customer->field3,
                'htmlOptions' => array('width' => '120px'),
                'visible' => !empty($user->customer->field3),
            ),
            'backgroundCheckStatusId' => array(
                'name' => 'backgroundCheckStatus.name',
                'header' => 'Estado',
                'filter' => CHtml::activeDropDownList($model, 'backgroundCheckStatusId', CHtml::listData(BackgroundCheckStatus::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
                'htmlOptions' => array('width' => '80px'),
            ),
            'applyToPosition' => array(
                'name' => 'applyToPosition',
                'header' => 'Cargo Aspira',
                'htmlOptions' => array('width' => '130px'),
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
                'htmlOptions' => array('width' => '80px'),
            ),
            'studyStartedOn' => array(
                'name' => 'studyStartedOn',
                'value' => 'substr($data->studyStartedOn,0,10)',
                'htmlOptions' => array('width' => '60px'),
            ),
            'studyLimitOn' => array(
                'name' => 'studyLimitOn',
                'value' => 'substr($data->studyLimitOn,0,10)',
                'htmlOptions' => array('width' => '60px'),
            ),
            'deliveredToCustomerOn' => array(
                'name' => 'deliveredToCustomerOn',
                'htmlOptions' => array('width' => '60px'),
            ),
            'reportAvailable' => array(
                'name' => 'reportAvailable',
                'header' => 'Rep.',
                'value' => '(($data->isReportAvailable || $data->isTemporalReportAvailable)?CHtml::link(($data->isReportAvailable?("Rep(".$data->numberOfDownloads.")"):"Temp."), array("vetting/v/", "code"=>$data->code), array("target" => "_blank")):"")." "'.
                (!$user->customer->accessToanexos?"":
                '.(($data->isReportAvailable || $data->isTemporalReportAvailable)?CHtml::link("<br><br><center><img src=\"/css/sindoc.png\"/></center>", array("vetting/viewPdfSindoc/", "code"=>$data->code ), array("target" => "_blank")):"")'),
                'type' => 'raw',
                'filter' => CHtml::activeDropDownList($model, 'reportAvailable', Controller::$optionsYesNo, array('prompt' => '...')),
                'htmlOptions' => array('width' => '40px'),
                'visible' => $user->accessToPdfReport,
            ),
            'certificateAvailable' => array(
                'name' => 'certificateAvailable',
                'header' => 'Cert.',
                'value' => '($data->isCertificateAvailable?CHtml::link("Cert.", array("vetting/VC", "code"=>$data->code ), array("target" => "_blank")):"")',
                'type' => 'raw',
                'filter' => CHtml::activeDropDownList($model, 'certificateAvailable', Controller::$optionsYesNo, array(
                    'prompt' => '...'
                )),
                'htmlOptions' => array(
                    'width' => '20px'
                ),
                'visible' => $user->hasAccessToCertificates,
            ),
            /*'numberOfEvents' => array(
                //'header' => 'numero de eventos',
                'name' => 'numberOfEvents',
                'value' => '("<div title=\"".$data->eventsDescription."\">".$data->numberOfEvents."</div>")',
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '35px',
                    'style' => 'text-align:right',
                ),
                'filter' => '',
            ),*/

            'numberOfEvents' => array(
                //'header' => 'numero de eventos',
                'name' => 'numberOfEvents',
                //'value' => '("<div title=\"".$data->eventsDescription."\">".$data->numberOfEvents."</div>")',
                'value' =>(!$user->customer->graphicsNews?"":'CHtml::link("<i>".$data->numberOfEvents."</i>", "#",array("onclick"=>"selectNovedades(\"$data->code\")","title"=>"Reporte de Novedades"))').($user->customer->graphicsNews?"":'("<div title=\"".$data->eventsDescription."\">".$data->numberOfEvents."</div>")'),
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '35px',
                    'style' => 'text-align:right',
                ),
                'filter' => '',
            ),
            'total' => array(
                'header' => 'Avance del Proceso',
                'value' => '("<div title=\"".$data->percentageSummary."\">".$data->total."%</div>")',
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '35px',
                    'style' => 'text-align:right',
                ),
            ),
/*
            //Creado por Jonathan

             if($user->customerGroup==1 or $user->customerGroup==37 or $user->customerGroup==250 ){
             }
             else{

            'Componentes' => array(
                'header' => 'Componentes de Concepto'."<div style=color:#6caace>______________________________________</div>",
                //   'value' => '(" \"".$data->percentageSummaryComp."\""."<div style=color:#6caace>_____________________________________________________</div>")',
                'value' => '(" \"".$data->percentageSummaryComp."\"")',
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '200px',
                    'style' => 'text-align:justify',

                ),
            ),

             };
            //Creado por Jonathan
*/

            'result' => array(
                'name' => 'result.nick',
                'value' => '($data->isReportAvailable?$data->result->nick:"Sin Res.")',
                //'value' => '($data->isReportAvailable?($data->result->nick=="SH"?"<div style=color:#49C42E>SH</div>":$data->result->nick):"Sin Res.")',
                'filter' => '',
                'type' => 'raw',
                'htmlOptions' => array('width' => '35px'),
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => ' ',
                'htmlOptions' => array('width' => '15px', 'style' => 'text-align:right'),
                'header' => GridViewFilter::getClearButton($this->route),
                'viewButtonUrl' => 'Yii::app()->createUrl("vetting/v/", array("code"=>$data->code))',
            ),
           'Cancelar' => array(
                'header' => 'Cancelar',
                //'value' => '($data->isCancelarAviable?CHtml::link("Cancelar", array("vetting/UpdateCancelar2", "code"=>$data->code )):"")',
                'value' => '($data->isCancelarAviable?CHtml::link("Cancelar",
                array("vetting/UpdateCancelar2","code"=>$data->code),
                array("confirm" => "Está seguro de cancelar la solicitud del estudio?")
                ):"")',
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '20px'
                ),
            ),

        ),
    ));

}



else{

    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'background-check-grid',
        'dataProvider' => $model->searchClient($type),
        'filter' => $model,
        'columns' => array(
            'code' => array(
                'name' => 'code',
                'htmlOptions' => array('width' => '50px'),
            ),
            'customerUserId' => array(
                'name' => 'customerUser.username',
                'header' => 'Usuario',
                'htmlOptions' => array('width' => '120px'),
                'filter' => CHtml::activeDropDownList(//
                    $model, //
                    'customerUserId', //
                    CHtml::listData(
                        $model->customer ? $model->customer->customerUsers : array(), //
                        'id', //
                        'username'), //
                    array('prompt' => '...',)),


            ),
            'customerProductId' => array(
                'name' => 'customerProduct.name',
                'header' => 'Tipo',
                'htmlOptions' => array('width' => '120px'),
                'filter' =>CHtml::activeDropDownList(//
                    $model, //
                    'customerProductId', //
                    CHtml::listData(
                        $model->customer ? $model->customer->customerProducts : array(), //
                        'id', //
                        'name'),
                    array('prompt' => '...',)),

            ),
            'customer.name' => array(
                'name' => 'customer.name',
                'header' => 'Cliente',
                'filter' => CHtml::activeDropDownList($model, 'customerId', CHtml::listData(Customer::model()->findAllByAttributes(array('customerGroupId' => $user->customer->customerGroupId)), 'id', 'name'), array('prompt' => '...')),
                'htmlOptions' => array('width' => '120px'),
                'visible' => Yii::app()->user->getIsGroupSupervisor(),
            ),
            'customerField1' => array(
                'name' => 'customerField1',
                'header' => $user->customer->field1,
                'htmlOptions' => array('width' => '120px'),
                'visible' => !empty($user->customer->field1),
            ),
            'customerField2' => array(
                'name' => 'customerField2',
                'header' => $user->customer->field2,
                'htmlOptions' => array('width' => '120px'),
                'visible' => !empty($user->customer->field2),
            ),
            'customerField3' => array(
                'name' => 'customerField3',
                'header' => $user->customer->field3,
                'htmlOptions' => array('width' => '120px'),
                'visible' => !empty($user->customer->field3),
            ),
            'backgroundCheckStatusId' => array(
                'name' => 'backgroundCheckStatus.name',
                'header' => 'Estado',
                'filter' => CHtml::activeDropDownList($model, 'backgroundCheckStatusId', CHtml::listData(BackgroundCheckStatus::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
                'htmlOptions' => array('width' => '80px'),
            ),
            'applyToPosition' => array(
                'name' => 'applyToPosition',
                'header' => 'Cargo Aspira',
                'htmlOptions' => array('width' => '130px'),
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
                'htmlOptions' => array('width' => '80px'),
            ),
            'studyStartedOn' => array(
                'name' => 'studyStartedOn',
                'value' => 'substr($data->studyStartedOn,0,10)',
                'htmlOptions' => array('width' => '60px'),
            ),
            'studyLimitOn' => array(
                'name' => 'studyLimitOn',
                'value' => 'substr($data->studyLimitOn,0,10)',
                'htmlOptions' => array('width' => '60px'),
            ),
            'deliveredToCustomerOn' => array(
		'name' => 'deliveredToCustomerOn',
		'htmlOptions' => array('width' => '60px'),
	    ),
            'reportAvailable' => array(
                'name' => 'reportAvailable',
                'header' => 'Rep.',
                'value' => '(($data->isReportAvailable || $data->isTemporalReportAvailable)?CHtml::link(($data->isReportAvailable?("Rep(".$data->numberOfDownloads.")"):"Temp."), array("vetting/v/", "code"=>$data->code), array("target" => "_blank")):"")." "'.
                (!$user->customer->accessToanexos?"":
                '.(($data->isReportAvailable || $data->isTemporalReportAvailable)?CHtml::link("<br><br><center><img src=\"/css/sindoc.png\"/></center>", array("vetting/viewPdfSindoc/", "code"=>$data->code ), array("target" => "_blank")):"")'),
                'type' => 'raw',
                'filter' => CHtml::activeDropDownList($model, 'reportAvailable', Controller::$optionsYesNo, array('prompt' => '...')),
                'htmlOptions' => array('width' => '40px'),
                'visible' => $user->accessToPdfReport,
            ),
            'certificateAvailable' => array(
                'name' => 'certificateAvailable',
                'header' => 'Cert.',
                'value' => '($data->isCertificateAvailable?CHtml::link("Cert.", array("vetting/VC", "code"=>$data->code ), array("target" => "_blank")):"")',
                'type' => 'raw',
                'filter' => CHtml::activeDropDownList($model, 'certificateAvailable', Controller::$optionsYesNo, array(
                    'prompt' => '...'
                )),
                'htmlOptions' => array(
                    'width' => '20px'
                ),
                'visible' => $user->hasAccessToCertificates,
            ),
            /*'numberOfEvents' => array(
                //'header' => 'numero de eventos',
                'name' => 'numberOfEvents',
                'value' => '("<div title=\"".$data->eventsDescription."\">".$data->numberOfEvents."</div>")',
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '35px',
                    'style' => 'text-align:right',
                ),
                'filter' => '',
            ),*/
            'numberOfEvents' => array(
                //'header' => 'numero de eventos',
                'name' => 'numberOfEvents',
                //'value' => '("<div title=\"".$data->eventsDescription."\">".$data->numberOfEvents."</div>")',
                'value' =>(!$user->customer->graphicsNews?"":'CHtml::link("<i>".$data->numberOfEvents."</i>", "#",array("onclick"=>"selectNovedades(\"$data->code\")","title"=>"Reporte de Novedades"))').($user->customer->graphicsNews?"":'("<div title=\"".$data->eventsDescription."\">".$data->numberOfEvents."</div>")'),
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '35px',
                    'style' => 'text-align:right',
                ),
                'filter' => '',
            ),
            'total' => array(
                'header' => 'Avance del Proceso',
                'value' => '("<div title=\"".$data->percentageSummary."\">".$data->total."%</div>")',
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '35px',
                    'style' => 'text-align:right',
                ),
            ),

         //  if($user->customerGroup==1 or $user->customerGroup==37 or $user->customerGroup==250 ){



          //  }
          //  else{

                'Componentes' => array(
                    'header' => 'Componentes de Concepto'."<div style=color:#6caace>______________________________________</div>",
                    //   'value' => '(" \"".$data->percentageSummaryComp."\""."<div style=color:#6caace>_____________________________________________________</div>")',
                    'value' => '(" \"".$data->percentageSummaryComp."\"")',
                    'type' => 'raw',
                    'htmlOptions' => array(
                        'width' => '200px',
                        'style' => 'text-align:justify',

                    ),
                ),

            //Creado por Jonathan

        //    };



            'result' => array(
                'name' => 'result.nick',
                'value' => '($data->isReportAvailable?$data->result->nick:"Sin Res.")',
                //'value' => '($data->isReportAvailable?($data->result->nick=="SH"?"<div style=color:#49C42E>SH</div>":$data->result->nick):"Sin Res.")',
                'filter' => '',
                'type' => 'raw',
                'htmlOptions' => array('width' => '35px'),
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => ' ',
                'htmlOptions' => array('width' => '15px', 'style' => 'text-align:right'),
                'header' => GridViewFilter::getClearButton($this->route),
                'viewButtonUrl' => 'Yii::app()->createUrl("vetting/v/", array("code"=>$data->code))',
            ),
            'Cancelar' => array(
                'header' => 'Cancelar',
                //'value' => '($data->isCancelarAviable?CHtml::link("Cancelar", array("vetting/UpdateCancelar2", "code"=>$data->code )):"")',
                'value' => '($data->isCancelarAviable?CHtml::link("Cancelar",
                array("vetting/UpdateCancelar2","code"=>$data->code),
                array("confirm" => "Está seguro de cancelar la solicitud del estudio?")
                ):"")',
                'type' => 'raw',
                'htmlOptions' => array(
                    'width' => '20px'
                ),
            ),

        ),
    ));
};
?>
<?php

echo CHtml::button('Exportar', array(
    'id' => 'export-button',
    'class' => 'span-3 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/vetting/PcAdmin', array(
            '_export' => true
        )) . "','_blank');"

));

?>
<?php

//if ($user->customer->customerGroupId==1 or $user->customer->customerGroupId==37 or $user->customer->customerGroupId==250  ){


echo CHtml::button('Estudios Vencidos', array(
    'id' => 'export-button',
    'class' => 'span-5 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/vetting/pcAdmin', array(
            'exportvencidos' => true
        )) . "','_blank');"
));

//}
?>

<?php
echo CHtml::button('Novedades Estudio', array(
    'id' => 'export-button',
    'class' => 'span-5 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/vetting/exportEvent', array(
            '_exportWithEvents' => true
        )) . "','_blank');"
));
?>


<script src="../../mantenimiento/js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../../mantenimiento/css/jquery-ui.css" />

<script type="text/javascript">
    
    function selectNovedades(code) {

        //console.log(code);
        $("#getReportButton").focus();
        $("#dialogConfirm #bgkcode").val(code);
        $("#dialogConfirm").dialog("open");
        $('#openwindow').load('/vetting/selectNovd/ref/'+code, function() {
            //alert('Cargando.');
        });
    }

    $(function () {
        $("#dialogConfirm").dialog({
            resizable: true,
            modal: true,
            autoOpen: false,
            width: 1200,
            /*buttons: {
                Cancelar: function () {
                    $(this).dialog("close");
                }
            }*/
        });
    });
</script>

<div id="dialogConfirm" title="Novedades">
    <div id="openwindow">
    </diV>
</div>
