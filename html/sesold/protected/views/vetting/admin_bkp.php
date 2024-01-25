<?php
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

if ($user->customerId != 529) {
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
} else {
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
            array(
                'header' => 'Vence',
                'value' => '$data->expireIn',
                'filter' => '',
                'htmlOptions' => array('width' => '35px'),
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
        ),
    ));
};


?>