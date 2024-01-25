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

if (Yii::app()->user->name=='jcocoma@sintecto.com' || Yii::app()->user->name=='nhenao@sintecto.com' || Yii::app()->user->name=='ngonzalez@sintecto.com' || Yii::app()->user->name=='wlugo@sintecto.com' || Yii::app()->user->name=='ngonzalez@svision.co' || Yii::app()->user->name=='wlugo@svision.co'){

    Yii::import('application.extensions.TusDatos.*');

    $tusDatos = new TusDatos();
    $decoded=$tusDatos->getplanstusdatos();


    if (isset($decoded[0]["amount"])): 
        if($decoded[0]["amount"]<=1000): ?>
            <div class="flash-error">
                ¡¡ QUEDAN <b><?php echo $decoded[0]["amount"]; ?></b> CONSULTAS DISPONIBLES EN TUS DATOS !!
            </div>
        <?php else: ?>
            <div class="flash-success">
                ¡¡ HAY <b><?php echo $decoded[0]["amount"]; ?></b> CONSULTAS DISPONIBLES EN TUS DATOS !!
            </div>
        <?php endif; 
    endif; 
}
?>

<h1>Estudios de Seguridad</h1>

<p>
    Usted puede utilizar alternatvamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>
<?php echo CHtml::link('Busqueda Avanzada', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php

$listblack = $model->BlackList();


$this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'background-check-grid',
    'dataProvider' => $model->search(),
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
        'backgroundCheckStatusId' => array(
            'name' => 'backgroundCheckStatus.name',
            'header' => 'Estado',
            'filter' => CHtml::activeDropDownList($model, 'backgroundCheckStatusId', CHtml::listData(BackgroundCheckStatus::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '80px'),
        ),
        'result' => array(
            'name' => 'result.nick',
            'filter' => CHtml::activeDropDownList($model, 'resultId', CHtml::listData(Result::model()->findAll(array('order' => 'nick')), 'id', 'nick'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '35px'),
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
            'value' => '($data->formatedIdNumber.(count($data->otherReportsOfPerson)>0?"<div class=MultipleStudies>**</div>":"").($data->inAmendment?"<div class=MultipleStudies>*ENM*</div>":"").($data->blacklist?"<div class=MultipleStudies>*LN*</div>":"").(($data->customerProduct->hourExpress)>0?"<div class=StudiesExpress>EXP*</div>":""))',
            'htmlOptions' => array('width' => '80px'),
            'type' => 'raw',
        ),

        'studyStartedOn' => array(
            'name' => 'studyStartedOn',
            'header' => 'Solic',
            'value' => '("<div title=\"Solicitado en:[".$data->studyStartedOn."]  Límite en: [".$data->studyLimitOn."] Creado en:[".$data->created."] \">".substr($data->studyStartedOn,2,8)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '30px'),
        ),
        'approvedOn' => array(
            'name' => 'approvedOn',
            'header' => 'Apro.',
            'value' => '("<div title=\"".$data->approvedOn."\">".substr($data->approvedOn,2,8)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '30px'),
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
        'total' => array(
            'header' => 'Tot %',
            'value' => '("<div title=\"".$data->percentageSummary."\">".$data->total."%</div>")',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '35px',
                'style' => 'text-align:right',
            ),
        ),
        'numberOfEvents' => array(
            'name' => 'numberOfEvents',
            'htmlOptions' => array(
                'width' => '35px',
                'style' => 'text-align:right',
            ),
            'filter' => '',
        ),

        'assignedUserId' => array(
            'name' => 'assignedUserId',
            'header' => 'Asignado a',
            'value' => '($data->assignedUserNames)',
            'type' => 'raw',
            'filter' =>
            (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS)) ?
                    CHtml::activeDropDownList($model, 'assignedUserId', //
                            GridViewFilter::getNullArray() +
                            CHtml::listData(User::model()->findAll(array('order' => 'firstName')), 'id', 'name'), array('prompt' => '...')) :
                    ''),
            'htmlOptions' => array('width' => '70px'),
        ),
        'Aprobado' => array(
            'header' => 'Aprobado',
            'name' => 'approved.shortUsername',
            'filter' =>
            CHtml::activeDropDownList($model, 'approvedBy', CHtml::listData(User::model()->findAll(
                                    array(
                                        'order' => 'firstName',
                                        'condition' => 'userTypeId <= :id AND isActive=1',
                                        'params' => array(':id' => UserType::SES_BY_ROLL))
                            ), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '45px'),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'htmlOptions' => array('width' => '15px', 'style' => 'text-align:right'),
            'header' => GridViewFilter::getClearButton($this->route),
            'viewButtonUrl' => 'Yii::app()->createUrl("backgroundCheck/viewPdf/", array("code"=>$data->code, "valor"=>1))',
//            'viewButtonUrl' => 'Yii::app()->createUrl("backgroundCheck/v/", array("code"=>$data->code))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("backgroundCheck/delete/", array("code"=>$data->code))',
            'updateButtonUrl' => 'Yii::app()->createUrl("backgroundCheck/update/", array("code"=>$data->code))',
            'buttons' => array(
                'delete' => array(
                    'visible' => 
                    ( Yii::app()->user->isIt ?
                            '(($data->backgroundCheckStatusId ==' . BackgroundCheckStatus::PROCESSING .
                            '|| $data->backgroundCheckStatusId ==' . BackgroundCheckStatus::REQUESTED . ') && !$data->invoice)' : 'FALSE'),
                ),
                'update' => array(
                   'visible' => (Yii::app()->user->isSuperAdmin || Yii::app()->user->IsUser || Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole() ? 'true' : '$data->canUpdate'),
                )
            )
        ),
    ),

));
?>
