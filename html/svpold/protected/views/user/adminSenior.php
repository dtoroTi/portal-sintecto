<?php
if(!Yii::app()->user->isSuperAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Users' => array('adminSenior'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('adminSenior')),
    array('label' => 'Create User', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Asignar Senior a Analistas</h1>

<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<div class="search-form"> <!--style="display:none"-->
    <?php
    $this->renderPartial('_searchSenior', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<div>
    <?php echo CHtml::button('Asignar Senior', array('onclick' => 'assignSeniors();')); ?> 
</div>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->searchSenior(),
    'selectableRows' => 2,
    'filter' => $model, 
    'columns' => array(
        array(
            'id' => 'selectedIds',
            'class' => 'CCheckBoxColumn'
        ),
        'id' => array(
            'name' => 'id',
            'value' => '"<span id=\'codeId_".$data->id."\'>".$data->id."</span>"',
            'type' => 'raw',
            'htmlOptions' => array('width' => '20px'),
        ),
        'username',
        'firstName',
        'lastName',
        'finish' => array(
            'header' => 'Cerrados',
            'value' => '"<span id=finishprocess>".$data->getProcessSeniorFinal("'.$model->dateFrom.'","'.$model->dateUntil.'", $data->id)."</span>"',
            'type' => 'raw',
        ),
        'goal' => array(
            'name' => 'goal',
            'header' => 'Meta Total',
            'htmlOptions' => array('width' => '40px'),
        ),
        'sate' => array(
            'name' => 'state',
            'htmlOptions' => array('width' => '130px'),
        ),
        'city' => array(
            'name' => 'city',
            'htmlOptions' => array('width' => '130px'),
        ),
        'isActive' => array(
            'name' => 'isActive',
            'header' => 'Activo',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'isActive', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px'),
        ),
        'userSeniorId' => array(
            'name' => 'userSenior.username',
            'header' => 'Usuario Senior',
            'filter' => CHtml::activeDropDownList($model, 'userSeniorId', CHtml::listData(User::model()->findAll(array('order' => 'username', 'condition' => 't.userSeniorType=:idvalue', 'params' => array(':idvalue' => 1))), 'id', 'summaryLine'), array('prompt' => '...')),
            'htmlOptions' => array(
            'width' => '150px'),
        ),
        array(
            'class' => 'CButtonColumn',
            //'header' => GridViewFilter::getClearButton($this->route),
            'template' => '{created}', 
            'buttons' => array(
                'created' => array(
                    'label' => '<i class="fa fa-folder-open"></i>',
                    'url' => 'Yii::app()->createUrl("user/updateSenior/", array("idAnalist"=>$data->id))',
                    'options' => array('title' => 'Asignar Senior',),
                ),
            ),
        ),
    ),
));
?>
<script>
    function assignSeniors() {
        var studiesIds = $.fn.yiiGridView.getSelection('user-grid');
        var analistId = [];
        studiesIds.forEach(
                function (id) {
                    analistId.push($('#codeId_' + id).text());
                });
        if (analistId.length > 0) {
            $('#dialogConfirm #numberOfAnalyst').text(studiesIds.length);
            $('#dialogConfirm #seniorAssignment_selectedId').val(analistId);
            $("#dialogConfirm").dialog("open");
        } else {
            alert("Por favor selecciones los analistas que desea asignar al senior.");
        }
    }

    function sendAssignUsers() {
        var dataOut = $("#asignSeniorAnalyst").serialize();

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("user/assignSeniorAnalyst"); ?>',
            data: dataOut,
            dataType: "json",
            success: function (data, status) {
                if (typeof data.error === 'undefined') {
                    alert(data.error);
                    alert(data);
                } else {
                    alert( data.ans);
                    $('#seniorAssignment_usernameSenior').val('');
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
                    if ($('#seniorAssignment_usernameSenior').val().length > 0) {
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
        <?php echo CHtml::beginForm('#', 'post', array('id' => 'asignSeniorAnalyst')); ?>
        <?php
        $assignedUser = new AssignedUser();
        $date = new DateTime();
        ?>

        <style>
            #numberOfAnalyst{
                color: blue;
                font-size: 18px;
                font-weight:  bold;
            }
        </style>
        Asignar los siguientes  <span id="numberOfAnalyst">#</span> analistas<br/>
        <?php echo CHtml::hiddenField('seniorAssignment[selectedId]', '', array('id' => 'seniorAssignment_selectedId')); ?>
        <br/>

        <div class="SvpTable" >
            <table>
                <tr>
                    <th>Asignar Senior</th>
                </tr>
                <tr>
                    <td>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name' => 'seniorAssignment[usernameSenior]',
                            'source' => $this->createUrl('user/autocompleteUserSeniorAsing'),
                            // additional javascript options for the autocomplete plugin
                            'options' => array(
                                'minLength' => '2',
                                'select' => "js:function(event, ui) {
                                          $('#User_user_name').val(ui.item.id);
                                        }"
                            ),
                            'htmlOptions' => array(
                                'style' => 'height:20px;width:400px;',
                            ),
                        ));
                        ?>
                    </td>
                </tr>

            </table>
        </div>
        <?php echo CHtml::endForm(); ?>

    </div><!-- form -->
</div>