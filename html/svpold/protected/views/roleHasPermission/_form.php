<?php
//comment
/* @var $this RoleHasPermissionController */
/* @var $model RoleHasPermission */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'role-has-permission-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo $form->labelEx($model, 'roleId'); ?>
        <?php echo $form->dropDownList($model, 'roleId', 
		CHtml::listData(Role::model()->findAll(
				array(
					'order' => 'id',)
		), 'id', 'name'), array('prompt' => '...'));
        ?>
        <?php echo $form->error($model, 'roleId'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model, 'permissionId'); ?>
		<?php if ($model->isNewRecord): 
		    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name' => 'roleHasPermission[permissionId]',
				'source' => $this->createUrl('roleHasPermission/autocompletepermission'),
				// additional javascript options for the autocomplete plugin
				//$('#permissionName').text(ui.item.value);
				'options' => array(
					'minLength' => '2',
					'select' => "js:function(event, ui) {
								  $('#id').val(ui.item.id);
								  habilitar($('#id').val());
								}",
				),
				'htmlOptions' => array(
					'style' => 'height:20px;width:200px;',
				),
			));
			echo $form->hiddenfield($model, 'permissionId', array('id'=>'id'));
		?>
		<?php endif; ?>
	</div>

	<!--<span id="permissionName"></span>-->

	<div class="modal-body">
		<table id="detailresultPermission" cellspacing="0" style="width: 85%;" class="table table-sm table-striped table-hover table-bordered">
			<thead class="table-primary"> 
				<th>Id</th> 
				<th>controlador</th> 
				<th>acción</th> 
				<th>Permiso</th> 
				<th>Descripción</th> 
			</thead> 
		<?php if ($model->isNewRecord): ?>
			<tbody id="myTable"></tbody> 
		<?php else: ?>
			<tbody id="myTable">
				<td><?php echo $model->permission->id; ?></td> 
				<td><?php echo $model->permission->controller; ?></td> 
				<td><?php echo $model->permission->action; ?></td> 
				<td><?php echo $model->permission->permission; ?></td> 
				<td><?php echo $model->permission->description; ?></td> 
			</tbody> 
		<?php endif; ?>
		</table> 
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	function habilitar(value)
    {

		$('#detailresultPermission > tbody').empty();

        $.ajax({
        type:'POST',
        url: "/permission/datePermission.html",
        dataType: "json",
        data: { 
            'PermissionId': value,
        },
        context: document.body
        }).done(function(resp) {
            $( this ).addClass( "DatePermission");
            if(resp.length>0){
                var data = resp;
                for(var i=0; i<data.length; i++){
                    var tblRow = "<tr>" + 
					"<td>" + data[i]["id"] + "</td>" +  
					"<td>" + data[i]["controller"] + "</td>" + 
					"<td>" + data[i]["action"] + "</td>" + 
					"<td>" + data[i]["permission"] + "</td>" + 
					"<td>" + data[i]["description"] + "</td>" + 
                    "</tr>" 
                $(tblRow).appendTo("#detailresultPermission tbody");
                }
            }
        })
    }
</script>