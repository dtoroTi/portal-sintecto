<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}

$this->breadcrumbs = array(
    'Background Checks' => array('index'),
    'VCSP',
);

$this->menu = array(
    array('label' => 'List BackgroundCheck', 'url' => array('index')),
    array('label' => 'Create BackgroundCheck', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('background-check-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php if (Yii::app()->user->hasFlash('notification')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
    <br/>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
    <br/>
<?php endif; ?>

<h1>Asignación de Usuarios a Estudios de Seguridad</h1>

<p>
    Usted puede utilizar alternatvamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>
<div class="search-form" >
    <?php
    $this->renderPartial('/backgroundCheck/_searchForAssing', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->
    <b>Reportes asignación de secciones:</b><br>
    <?php
        echo CHtml::button('Asignadas', array(
            'id' => 'export-button',
            'class' => 'span-3 button',
            'onClick' => "window.open('" . Yii::app()->controller->createUrl('/backgroundCheck/exportAssingSection', array(
                '_exportAssingSection' => true
            )) . "','_blank');"
        ));
    ?>
    <?php
        echo CHtml::button('sin Asignar', array(
            'id' => 'export-button',
            'class' => 'span-3 button',
            'onClick' => "window.open('" . Yii::app()->controller->createUrl('/backgroundCheck/exportNotAssingSection', array(
                '_exportNotAssingSection' => true
            )) . "','_blank');"
        ));
    ?>
    <br><br>
    <?php echo CHtml::Button('Asignar', array('onclick' => 'assignUsers();')); ?> 
<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'background-check-grid',
    'htmlOptions' => array(),
    'dataProvider' => $model->searchForAssign(),
    'selectableRows' => 2,
    'filter' => $model,
    'columns' => array(
        array(
            'id' => 'selectedIds',
            'class' => 'CCheckBoxColumn'
        ),
        'customer' => array(
            'name' => 'customer.name',
            'filter' => CHtml::activeDropDownList($model, 'customerId', CHtml::listData(Customer::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '100px'),
        ),
        'code' => array(
            'name' => 'code',
            'value' => '"<span id=\'codeId_".$data->id."\'>".$data->code."</span>"',
            'type' => 'raw',
            'htmlOptions' => array('width' => '20px'),
        ),
        'customerProductName' => array(
            'name' => 'customerProduct.name',
            'header' => 'Tipo',
            'htmlOptions' => array('width' => '80px'),
            'filter' => CHtml::activeTextField($model, 'customerProductName'),
        ),
        /*'customerProductName' => array(
            'name' => 'customerProduct.name',
            'value'=> '("<div title=\"".$data->customerProduct->name."\">".$data->getBackgroundCheckComponents()."</div>")', 
            'header' => 'Tipo',
            'type'=>'raw',
            'htmlOptions' => array('width' => '80px'),
            'filter' => CHtml::activeTextField($model, 'customerProductName'),
        ),*/
        'backgroundCheckStatusId' => array(
            'name' => 'backgroundCheckStatus.name',
            'header' => 'Estado',
            'filter' => CHtml::activeDropDownList($model, 'backgroundCheckStatusId', CHtml::listData(BackgroundCheckStatus::model()->findAll(array('condition' =>'id=1 OR id=5','order' => 'name')), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '80px'),
        ),
        /*'result' => array(
            'name' => 'result.nick',
            'filter' => CHtml::activeDropDownList($model, 'resultId', CHtml::listData(Result::model()->findAll(array('order' => 'nick')), 'id', 'nick'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '35px'),
        ),*/
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
            'value' => '($data->formatedIdNumber.(count($data->otherReportsOfPerson)>0?"<div class=MultipleStudies>**</div>":"").($data->inAmendment?"<div class=MultipleStudies>*ENM*</div>":"").($data->blacklist?"<div class=MultipleStudies>*LN*</div>":""))',
            'htmlOptions' => array('width' => '80px'),
            'type' => 'raw',
        ),
        'city' => array(
            'header' => 'Ciudad',
            'name' => 'city',
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'studyStartedOn' => array(
            'name' => 'studyStartedOn',
            'header' => 'Solic',
            'value' => '("<div title=\"Solicitado en:[".$data->studyStartedOn."]  Límite en: [".$data->studyLimitOn."] Creado en:[".$data->created."] \">".substr($data->studyStartedOn,2,8)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '30px'),
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
        'comments' => array(
            'name' => 'comments',
            'header' => 'Observación',
            'htmlOptions' => array('width' => '70px'),
        ),
        /*'observation' => array(
            'name' => 'candidateCallsAll.observation',
            'header' => 'Observación',
            'value' => '$data->getObservation()',
            'type' => 'raw',
            'htmlOptions' => array('width' => '70px'),
            //'filter' => '',
            'htmlOptions' => array(
                'width' => '30px'
            ),
        ),*/
        'preliminar' => array(
            'name' => 'customerProduct.preliminary',
            'value' => '($data->preliminary)',
            'type' => 'raw',
            'filter'=> CHtml::activeDropDownList($model, 'customerProductPreliminary', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array(
                'width' => '30px'
            ),
        ),
        array(
            'name' => 'assignedUserId',
            'header' => 'Grupos',
            'value' => '$data->getSectionGroupsStr()',
            'type' => 'raw',
            'htmlOptions' => array('width' => '70px'),
            'filter' => '',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
            'htmlOptions' => array('width' => '15px', 'style' => 'text-align:right'),
            'header' => GridViewFilter::getClearButton($this->route),
            'viewButtonUrl' => 'Yii::app()->createUrl("backgroundCheck/viewPdf/", array("code"=>$data->code, "valor"=>1))',
//            'viewButtonUrl' => 'Yii::app()->createUrl("backgroundCheck/v/", array("code"=>$data->code))',
            'updateButtonUrl' => 'Yii::app()->createUrl("backgroundCheck/update/", array("code"=>$data->code))',
            'buttons' => array(
                'update' => array(
                    'visible' => (Yii::app()->user->isSuperAdmin ? 'true' : '$data->canUpdate'),
                )
            )
        ),
    ),
));
?>

<script src="../../mantenimiento/js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../../mantenimiento/css/jquery-ui.css" />

<script type="text/javascript">

    function assignUsers() {
        var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');
        var studiesCodes = [];
        studiesIds.forEach(
                function (id) {
                    studiesCodes.push($('#codeId_' + id).text());
                });
        if (studiesCodes.length > 0) {
            $("#getReportButton").focus();
            $('#dialogConfirm #numberOfStudies').text(studiesIds.length);
            $('#dialogConfirm #assignUserSections_selectedStudiesCodes').val(studiesCodes);
            $("#dialogConfirm").dialog("open");
            $('#openwindow').load('/backgroundCheck/openModal/ref/'+studiesCodes+'/num/'+studiesIds.length, function() {
                //alert('Cargando.');
            });
          
        } else {
            alert("Por favor selecciones los reportes a asignar.");
        }
       
    }

    $(function () {
        $("#dialogConfirm").dialog({
            resizable: true,
            modal: true,
            autoOpen: false,
            width: 1050,
            buttons: {
                Asignar: function () {
                    if ($('#assignUserSections_username').val().length > 0 &&
                            $('#assignUserSections_userRoleId input:checked').val() > 0 /*&&
                            $('#assignUserSections_verificationSectionGroupId input:checked').length > 0*/
                            ) {
                        sendAssignUsers();
                    } else {
                        alert('Por favor complete los campos');
                    }
                },
                'Cerrar y Cargar' : function () {
                    $(this).dialog("close");
                    $.fn.yiiGridView.update("background-check-grid");
                }
            }
        });
    });

    function sendAssignUsers() {
        var dataOut = $("#asignStudiesForm").serialize();

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("backgroundCheck/assignUserToMultipleStudies"); ?>',
            data: dataOut,
            dataType: "json",
            success: function (data, status) {
                if (typeof data.error === 'undefined') {
                    alert(data.error);
                    alert(data);
                } else {
                    alert(data.ans);
                    $('#assignUserSections_username').val('');
                    $('#assignUserSections_userRoleId input:checked').removeAttr('checked');
                    $('#assignUserSections_verificationSectionGroupId input:checked').removeAttr('checked');
                    $('#assignUserSections_verificationSectionId input:checked').removeAttr('checked');
                }
            },
            error: function (request, status, error) {
                    alert(request.responseText);
            },
        });
    }
</script>

<?php //echo CHtml::Button('Asignar', array('onclick' => 'assignUsers();')); ?> 


<div id="dialogConfirm" title="Basic dialog">
    <div id="openwindow">
    </diV>
</div>
