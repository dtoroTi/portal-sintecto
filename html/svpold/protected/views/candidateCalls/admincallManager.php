<?php
/* @var $this CandidateCallsController */
/* @var $model CandidateCalls */

$this->breadcrumbs=array(
	'Llamadas asignadas'=>array('admintoAssign'),
	'Manage',
);



Yii::app()->clientScript->registerScript('searchcallManager', "
$('.searchcallManager-button').click(function(){
	$('.searchcallManager-form').toggle();
	return false;
});
$('.searchcallManager-form form').submit(function(){
	$('#candidate-calls-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<h1>Asignar responsables de Llamadas</h1>

<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php //echo CHtml::link('Busqueda Avanzada', '#', array('class' => 'search-button')); ?>
<div class="search-form"> <!--style="display:none"-->
    <?php
    $this->renderPartial('_searchAssing', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<div>
    <?php echo CHtml::button('Asignar Llamadas', array('onclick' => 'ans=confirm("Está seguro de realizar la asignación de llamadas?");if (ans) {document.location.href="/candidateCalls/callstoAssign?";}')); ?> 
    <?php echo CHtml::Button('Quitar Asignación', array('onclick' => 'ans=confirm("Está seguro de quitar la asignación de llamadas a esos estudios?");if (ans) {notAssign();}')); ?> 
    <?php echo CHtml::button('Reasignar Llamadas', array('onclick' => 'ans=confirm("Está seguro de reasignar las llamadas a esos estudios?");if (ans) {reAssign();}')); ?> 
</div>
<br>
<b>Adicionar Observación:</b>
<div>
    <?php echo CHtml::Button('Sin Hoja de vida', array('onclick' => 'ans=confirm("Está seguro de agregar la observación: (Sin HDV) a esos estudios?");if (ans) {observ(1);}')); ?> 
    <?php echo CHtml::Button('Presencial-Nacional', array('onclick' => 'ans=confirm("Está seguro de agregar la observación: (Presencial Nacional) a esos estudios?");if (ans) {observ(2);}')); ?> 
    <?php echo CHtml::Button('Presencial', array('onclick' => 'ans=confirm("Está seguro de agregar la observación: (Presencial) a esos estudios?");if (ans) {observ(3);}')); ?> 
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	//'id'=>'candidate-calls-grid',
    'id' => 'background-check-grid',
    'htmlOptions' => array(),
	'dataProvider'=>$model->searchcallManager(),
    'selectableRows' => 2,
	'filter'=>$model,
	'columns'=>array(
        array(
            'id' => 'selectedIds',
            'class' => 'CCheckBoxColumn'
        ),
		'id' => array(
            'name' => 'id',
            'value' => '"<span id=\'IdCalls_".$data->id."\'>".$data->id."</span>"',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
		'created' => array(
            'header' => 'Fecha de Ingreso',
            'name' => 'backgroundcheck.studyStartedOn',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckstudyStartedOn'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
		'dateCreate' => array(
            'name' => 'dateCreate',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
		'studyLimitOn' => array(
            'header' => 'Fecha Limite',
            'name' => 'backgroundcheck.studyLimitOn',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckstudyLimitOn'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'username' => array(
            'header' => 'Responsable llamada Inicial',
            'name' => 'callManager.username',
            'filter'=>CHtml::activeTextField($model, 'userName1'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
		'CustomerName' => array(
            'name' => 'backgroundcheck.customer.name',
            'filter'=>CHtml::activeTextField($model, 'customerName'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
		'code' => array(
            'name' => 'backgroundcheck.code',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckCode'),
            'value' => '(CHtml::link($data->backgroundcheck->code, array("backgroundCheck/update", "code"=>$data->backgroundcheck->code), array("target" => "_blank")))',
            //'value' => '(CHtml::link($data->backgroundcheck->code, array("backgroundCheck/update", "code"=>$data->backgroundcheck->code), array("target" => "_blank")))',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'idNumber' => array(
            'name' => 'backgroundcheck.idNumber',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckidNumber'),
            'value' => '($data->backgroundcheck->formatedIdNumber.(count($data->backgroundcheck->otherReportsOfPerson)>0?"<div class=MultipleStudies>**</div>":"").($data->backgroundcheck->inAmendment?"<div class=MultipleStudies>*ENM*</div>":"").($data->backgroundcheck->blacklist?"<div class=MultipleStudies>*LN*</div>":""))',
            'htmlOptions' => array(
                'width' => '50px'
            ),
            'type' => 'raw',
        ),
        'firstName' => array(
            'name' => 'backgroundcheck.firstName',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckfirstName'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'lastName' => array(
            'name' => 'backgroundcheck.lastName',
            'filter'=>CHtml::activeTextField($model, 'backgroundchecklastName'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'city' => array(
            'header' => 'Ciudad',
            'name' => 'backgroundcheck.city',
            'value' =>  '($data->verificationCity)',
            'type' => 'raw',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckcity'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'preliminar' => array(
            'name' => 'backgroundcheck.customerProduct.preliminary',
            'value' => '($data->preliminary)',
            'type' => 'raw',
            'filter'=> CHtml::activeDropDownList($model, 'customerProductPreliminary', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array(
                'width' => '30px'
            ),
        ),
        'productName' => array(
            'header' => 'Componente',
            //'name' => 'backgroundcheck.customerProduct.name',
            'value'=> '("<div title=\"".$data->backgroundcheck->customerProduct->name."\">".$data->backgroundcheck->getBackgroundCheckComponents()."</div>")', 
            'type'=>'raw',
            'filter' => CHtml::activeTextField($model, 'customerProductName'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'Componentes' => array(
            'header' => 'Resultado Componentes',
            'value' => '(" \"".$data->backgroundcheck->percentageSummaryAdv."\"")',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '80px',
                'style' => 'text-align:justify',

            ),
        ),
        'username2' => array(
            'header' => 'Responsable de Llamada reprogramación',
            'name' => 'callReschedulingManager.username',
            'value' =>  '($data->resreprogram)',
            'type' => 'raw',
            'filter'=>CHtml::activeTextField($model, 'userName2'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'observation' => array(
            'header' => 'Observación',
            'name' => 'observation',
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'statusVisit' => array(
            'name' => 'statusVisit',
            'value' =>  '($data->statusVisitPend)',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '20px',
            ),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'htmlOptions' => array(
                'width' => '50px',
                //'style' => 'text-align:right'
            ),
            'header' => GridViewFilter::getClearButton($this->route),
            'updateButtonUrl' => 'Yii::app()->createUrl("candidateCalls/update/", array("id"=>$data->id,"pc"=>1))',
        ),
	),
)); 
?>

<?php
echo CHtml::button('Llamadas Asignadas', array(
    'id' => 'export-button',
    'class' => 'span-5 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/candidateCalls/admintoAssign', array(
        '_exporttoAssing' => true
    )) . "','_blank');"
));
?>

<script src="../../mantenimiento/js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../../mantenimiento/css/jquery-ui.css" />

<script type="text/javascript">

    function notAssign() {

        var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');
        var studiesCodes = [];

        if (studiesIds.length > 0) {
           
            jQuery.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl("candidateCalls/notAssignmassive"); ?>',
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
                    alert('Se quito la asignación con éxito.');
                    $.fn.yiiGridView.update("background-check-grid");
                },
            });

        } else {
            alert("Por favor selecciones los estudios que desea quitar la asignación.");
        }
       
    }

    function notAssign() {

    var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');
    var studiesCodes = [];

    if (studiesIds.length > 0) {
    
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("candidateCalls/notAssignmassive"); ?>',
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
                alert('Se quito la asignación con éxito.');
                $.fn.yiiGridView.update("background-check-grid");
            },
        });

    } else {
        alert("Por favor selecciones los estudios que desea quitar la asignación.");
    }

    }

    function observ(value) {

        var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');
        var studiesCodes = [];

        if(value==1){
            var ruta='<?php echo Yii::app()->createAbsoluteUrl("candidateCalls/notCV"); ?>';
        }

        if(value==2){
           var ruta='<?php echo Yii::app()->createAbsoluteUrl("candidateCalls/presencialNac"); ?>';
        }

        if(value==3){
            var ruta='<?php echo Yii::app()->createAbsoluteUrl("candidateCalls/presencial"); ?>';
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
                    alert('Se agrego la observación con éxito.');
                    $.fn.yiiGridView.update("background-check-grid");
                },
            });

        } else {
            alert("Por favor selecciones los estudios a los que desea agregar la observación.");
        }
    }

    function reAssign() {

        var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');
        var studiesCodes = [];

        studiesIds.forEach(
                function (id) {
                    studiesCodes.push($('#IdCalls_' + id).text());
                });
        if (studiesCodes.length > 0) {
            $("#getReportButton").focus();
            $('#dialogConfirm #numberOfStudies').text(studiesIds.length);
            $('#dialogConfirm #reAssignment_selectedId').val(studiesCodes);
            $("#dialogConfirm").dialog("open");
        } else {
            alert("Por favor selecciones los reportes a asignar.");
        }
    }

    function sendAssignUsers() {
        var dataOut = $("#reasignUser").serialize();

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("candidateCalls/reassignUserCalls"); ?>',
            data: dataOut,
            dataType: "json",
            success: function (data, status) {
                if (typeof data.error === 'undefined') {
                    alert(data.error);
                    alert(data);
                } else {
                    alert( data.ans);
                    $('#reAssignment_username').val('');
                    window.location.reload();
                }
            },
            error: function (request, status, error) {
                    alert(request.responseText);
            },
        });
    }

    $(function () {
        $("#dialogConfirm").dialog({
            resizable: true,
            modal: true,
            autoOpen: false,
            width: 900,
            buttons: {
                Asignar: function () {
                    if ($('#reAssignment_username').val().length > 0) {
                        sendAssignUsers();
                    } else {
                        alert('Por favor complete los campos');
                    }
                },
                Cerrar : function () {
                    $(this).dialog("close");
                    $.fn.yiiGridView.update("background-check-grid");
                }
            }
        });
    });
</script>

<div id="dialogConfirm" title="Basic dialog">

    <div class="form wide">
        <?php echo CHtml::beginForm('#', 'post', array('id' => 'reasignUser')); ?>
        <?php
        $assignedUser = new AssignedUser();
        $date = new DateTime();
        ?>

        <style>
            #numberOfStudies{
                color: blue;
                font-size: 18px;
                font-weight:  bold;
            }
        </style>
        Reasignar las siguientes  <span id="numberOfStudies">#</span> Llamadas<br/>
        <?php echo CHtml::hiddenField('reAssignment[selectedId]', '', array('id' => 'reAssignment_selectedId')); ?>
        <br/>

        <div class="SvpTable" >
            <table>
                <tr>
                    <th>Reasignar Llamadas</th>
                </tr>
                <tr>
                    <td>
                        <?php
                         echo CHtml::dropDownList(//
                            'reAssignment[username]', //
                            $assignedUser->userId, //
                            CHtml::listData(
                                    User::model()->findAll(array(
                                        'condition' => 'callManager=1',
                                        'order' => 'firstname')), //
                                    'id', 'name'), //
                            array('prompt' => 'Reasignar a...', 'style' => 'height:20px;width:250px;')
                    )
                        ?>
                    </td>
                </tr>

            </table>
        </div>
        <?php echo CHtml::endForm(); ?>

    </div><!-- form -->
</div>