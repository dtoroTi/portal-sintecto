<?php
if(!Yii::app()->user->isValidUser){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Background Checks' => array(
        'pcAdmin'
    ),
    'Manage',
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

<h1>Control de Estudios de Seguridad</h1>

<p>
    Usted puede utilizar alternatvamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php
echo CHtml::link('Busqueda Avanzada', '#', array(
    'class' => 'search-button'
));
?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'background-check-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'customer' => array(
            'name' => 'customer.name',
            'filter' => CHtml::activeDropDownList($model, 'customerId', CHtml::listData(Customer::model()->findAll(array(
                                'order' => 'name'
                            )), 'id', 'name'), array(
                'prompt' => '...'
            )),
            'htmlOptions' => array(
                'width' => '100px'
            ),
        ),
        'code' => array(
            'name' => 'code',
            'htmlOptions' => array(
                'width' => '40px'
            ),
        ),
        'invoice' => array(
            'header' => 'Fact.',
            'value' => '($data->invoice?"<div title=\"".$data->invoice->customerGroup->name."[".$data->invoice->number."] vence en : ".$data->invoice->until."\">".substr($data->invoice->until,2,8)."</div>":($data->reportAvailable?"***":""))',
            'type' => 'raw',
            'filter' => CHtml::activeDropDownList($model, 'hasInvoice', Controller::$optionsYesNo, array(
                'prompt' => '...'
            )),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'customerProductName' => array(
            'name' => 'customerProduct.name',
            'header' => 'Tipo',
            'htmlOptions' => array(
                'width' => '80px'
            ),
            'filter' => CHtml::activeTextField($model, 'customerProductName'),
        ),
        //        'assignedTo' => array(
        //            'name' => 'assigned.name',
        //            'header' => 'Asignado a',
        //            'filter' =>
        //            (Yii::app()->user->isAdmin ?
        //                    CHtml::activeDropDownList($model, 'assignedTo', //
        //                            GridViewFilter::getNullArray() +
        //                            CHtml::listData(User::model()->findAll(array('order' => 'firstName')), 'id', 'name'), array('prompt' => '...')) :
        //                    ''),
        //            'htmlOptions' => array('width' => '80px'),
        //        ),
        'firstName' => array(
            'name' => 'firstName',
            'htmlOptions' => array(
                'width' => '130px'
            ),
        ),
        'lastName' => array(
            'name' => 'lastName',
            'htmlOptions' => array(
                'width' => '130px'
            ),
        ),
        'city' => array(
            'name' => 'city',
            'htmlOptions' => array(
                'width' => '80px'
            ),
        ),
        'idNumber' => array(
            'name' => 'idNumber',
            'value' => '($data->formatedIdNumber.(count($data->otherReportsOfPerson)>0?"<div class=MultipleStudies>**</div>":"").($data->inAmendment?"<div class=MultipleStudies>*ENM*</div>":"").($data->blacklist?"<div class=MultipleStudies>*LN*</div>":"").(($data->customerProduct->hourExpress)>0?"<div class=StudiesExpress>EXP*</div>":""))',
            'htmlOptions' => array(
                'width' => '80px'
            ),
            'type' => 'raw',
        ),
        'studyStartedOn' => array(
            'name' => 'studyStartedOn',
            'header' => 'Solic',
            'value' => '("<div title=\"Creado en:[".$data->created."] \">".substr($data->studyStartedOn,2,8)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '46px'
            ),
        ),
        /*'studyLimitOn' => array(
            'name' => 'studyLimitOn',
            'value' => '("<div title=\"".$data->studyLimitOn."\">".substr($data->studyLimitOn,2,8)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '46px'
            ),
        ),*/
        'studyLimitOn' => array(
            'name' => 'studyLimitOn',
            'value' => '("<div title=\"".$data->maxInternalDays."\">".substr($data->maxInternalDays,2,8)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '46px'
            ),
        ),
        'approvedOn' => array(
            'name' => 'approvedOn',
            'header' => 'Apro.',
            'value' => '("<div title=\"".$data->approvedOn."\">".substr($data->approvedOn,2,8)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '46px'
            ),
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
        'certificateAvailable'=> array(
            'name' => 'certificateAvailable',
            'header' => 'Cert.',
            'value' => '($data->certificateAvailable?CHtml::link("Cert.", array("backgroundCheck/reportCertPdf", "code"=>$data->code ), array("target" => "_blank")):"")',
            'type' => 'raw',
            'filter' => CHtml::activeDropDownList($model, 'certificateAvailable', Controller::$optionsYesNo, array(
                'prompt' => '...'
            )),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'daysStudy' => array(
            'name' => 'daysStudy',
            'htmlOptions' => array(
                'width' => '10px',
                'style' => 'text-align:right'
            ),
            'filter' => '',
        ),
        'daysChecker' => array(
            'name' => 'daysChecker',
            'htmlOptions' => array(
                'width' => '10px',
                'style' => 'text-align:right'
            ),
            'filter' => '',
        ),
        'numberOfEvents' => array(
            'name' => 'numberOfEvents',
            'htmlOptions' => array(
                'width' => '10px',
                'style' => 'text-align:right'
            ),
            'filter' => '',
        ),
        'numberOfDownloads' => array(
            'name' => 'numberOfDownloads',
            'header' => 'D_#',
            'htmlOptions' => array(
                'width' => '10px',
                'style' => 'text-align:right'
            ),
            'filter' => '',
        ),
        'backgroundCheckStatusId' => array(
            'name' => 'backgroundCheckStatus.name',
            'header' => 'Estado',
            'filter' => CHtml::activeDropDownList($model, 'backgroundCheckStatusId', CHtml::listData(BackgroundCheckStatus::model()->findAll(array(
                                'order' => 'name'
                            )), 'id', 'name'), array(
                'prompt' => '...'
            )),
            'htmlOptions' => array(
                'width' => '70px'
            ),
        ),
        'result' => array(
            'name' => 'result.nick',
            'filter' => CHtml::activeDropDownList($model, 'resultId', CHtml::listData(Result::model()->findAll(array(
                                'order' => 'nick'
                            )), 'id', 'nick'), array(
                'prompt' => '...'
            )),
            'htmlOptions' => array(
                'width' => '35px'
            ),
        ),
        'findings' => array(
            'name' => 'findings',
            'htmlOptions' => array(
                'width' => '10px',
                'style' => 'text-align:left'
            ),
            'filter' => '',
        ),
        'result' => array(
            'header' => 'Aprobado',
            'name' => 'approved.name',
            'filter' => CHtml::activeDropDownList($model, 'approvedBy', CHtml::listData(User::model()->findAll(array(
                                'order' => 'firstName',
                                'condition' => 'userTypeId <= :id',
                                'params' => array(
                                    ':id' => UserType::SES_ADMIN
                                )
                            )), 'id', 'name'), array(
                'prompt' => '...'
            )),
            'htmlOptions' => array(
                'width' => '45px'
            ),
        ),
        'result' => array(
            'name' => 'result.nick',
            'filter' => CHtml::activeDropDownList($model, 'resultId', CHtml::listData(Result::model()->findAll(array(
                                'order' => 'nick'
                            )), 'id', 'nick'), array(
                'prompt' => '...'
            )),
            'htmlOptions' => array(
                'width' => '45px'
            ),
        ),
        'responsible' => array(
            'name' => 'responsibleUserId',
            'value' => '($data->responsibleShortUsername)',
            'filter' => ((Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) ? CHtml::activeDropDownList($model, 'responsibleUserId',
                            //
                            GridViewFilter::getNullArray() + CHtml::listData(User::model()->findAll(array(
                                        'order' => 'username'
                                    )), 'id', 'shortUsername'), array(
                        'prompt' => '...'
                    )) : ''),
            'htmlOptions' => array(
                'width' => '45px'
            ),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'htmlOptions' => array(
                'width' => '15px',
                'style' => 'text-align:right'
            ),
            'header' => GridViewFilter::getClearButton($this->route),
            'viewButtonUrl' => 'Yii::app()->createUrl("backgroundCheck/viewPdf/", array("code"=>$data->code, "valor"=>1))',
            //            'viewButtonUrl' => 'Yii::app()->createUrl("backgroundCheck/v/", array("code"=>$data->code))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("backgroundCheck/delete/", array("code"=>$data->code))',
            'updateButtonUrl' => 'Yii::app()->createUrl("backgroundCheck/update/", array("code"=>$data->code,"pc"=>1))',
            'buttons' => array(
                'delete' => array(
                    'visible' => 
                     (Yii::app()->user->isIt ? '($data->backgroundCheckStatusId =='
                     . BackgroundCheckStatus::PROCESSING . '|| $data->backgroundCheckStatusId ==' 
                     . BackgroundCheckStatus::REQUESTED . ')' : 'FALSE'),
                ),
                'update' => array(
                    'visible' => (Yii::app()->user->isSuperAdmin || Yii::app()->user->IsUser || Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole() ? 'true' : '!$data->reportAvailable'),
                )
            )
        ),
    ),
));
?>

<?php if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()): ?>
    <?php
    echo CHtml::button('Exportar', array(
        'id' => 'export-button',
        'class' => 'span-3 button',
        'onClick' => "window.open('" . Yii::app()->controller->createUrl('/backgroundCheck/pcAdmin', array(
            '_export' => true
        )) . "','_blank');"
    ));
    ?>
<?php endif ?>
<?php if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()): ?>
    <br/>
    <br/>
    <?php
    echo CHtml::button('Asignaciones', array(
        'id' => 'export-button',
        'class' => 'span-3 button',
        'onClick' => "window.open('" . Yii::app()->controller->createUrl('/backgroundCheck/pcAdmin', array(
            '_exportDetail' => true
        )) . "','_blank');"
    ));
    ?>
<?php endif ?>
<?php if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()): ?>
    <br/>
    <br/>
    <?php
    echo CHtml::button('Exportar con Novedades', array(
        'id' => 'export-button',
        'class' => 'span-5 button',
        'onClick' => "window.open('" . Yii::app()->controller->createUrl('/backgroundCheck/pcAdmin', array(
                '_exportWithEvents' => true
            )) . "','_blank');"
    ));
    ?>
<?php endif ?>
<?php if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()): ?>
    <br/>
    <br/>
    <?php
    echo CHtml::button('Export Seguimiento', array(
        'id' => 'export-button',
        'class' => 'span-5 button',
        'onClick' => "window.open('" . Yii::app()->controller->createUrl('/backgroundCheck/pcAdmin', array(
                'exportna' => true
            )) . "','_blank');"
    ));
    ?>
<?php endif ?>
<?php//creado export seguimiento?>
<br/>
