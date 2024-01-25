<?php
//comment
/* @var $this RoleController */
/* @var $model Role */

$this->breadcrumbs = [
    'Roles' => ['admin'],
    $model->name,
];

/*$this->menu=array(
array('label'=>'List Role', 'url'=>array('index')),
array('label'=>'Create Role', 'url'=>array('create')),
array('label'=>'Update Role', 'url'=>array('update', 'id'=>$model->id)),
array('label'=>'Delete Role', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Role', 'url'=>array('admin')),
);*/
?>
<?php $this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'name',
    ],
]);?>
<br><br>
 <table style="width:40em">
        <tr >
		<td>
				<?php
$this->widget('zii.widgets.jui.CJuiAutoComplete', [
    'name' => 'roleHasPermission[permissionId]',
    'source' => $this->createUrl('roleHasPermission/autocompletepermission'),
    // additional javascript options for the autocomplete plugin
    'options' => [
        'minLength' => '2',
        'select' => "js:function(event, ui) {
								$('#id').val(ui.item.id);
							}",
    ],
    'htmlOptions' => [
        'class' => 'permissionId',
        'style' => 'height:20px;width:370px;',
    ],
]);
?>
			</td>
            <td style="width:20em">
                <?php if (Yii::app()->user->isAdmin): ?>
					<button id="permission" name = "permission" value="view_manual">Asignar Permiso</button>
                    <?php //echo CHtml::submitButton('Asignar Permiso', array('onClick' => 'this.disabled=true;this.form.submit();')); ?>
                <?php endif;?>
            </td>
        </tr>
    </table>

<h1>Permisos por Rol</h1>

<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php

   /* echo $this->renderPartial('/roleHasPermission/admin', [
        'model' => $rolHasPermissionFilter,
    ]
    );*/
	 $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'role-has-permission-grid',
		'dataProvider'=>$rolHasPermissionFilter->search(),
		'filter'=>$rolHasPermissionFilter,
		'columns'=>array(
			'rolename' => array(
				'name' => 'role.name',
				'header' => 'Rol',
				//'filter' => CHtml::activeDropDownList($rolHasPermissionFilter, 'role', CHtml::listData(Role::rolHasPermissionFilter()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
				'htmlOptions' => array('width' => '120px'),
			),
			'permissioncontroller' => array(
				'name' => 'permission.controller',
				'filter'=>CHtml::activeTextField($rolHasPermissionFilter, 'filterController'),
				'htmlOptions' => array(
					'width' => '100px'
				),
			),
			'permissionaction' => array(
				'name' => 'permission.action',
				'filter'=>CHtml::activeTextField($rolHasPermissionFilter, 'filterAction'),
				'htmlOptions' => array(
					'width' => '100px'
				),
			),
			'permission' => array(
				'name' => 'permission.permission',
				'filter'=>CHtml::activeTextField($rolHasPermissionFilter, 'filterPermission'),
				'htmlOptions' => array(
					'width' => '250px'
				),
			),
			'permissionDescription' => array(
				'name' => 'permission.description',
				'filter'=>CHtml::activeTextField($rolHasPermissionFilter, 'filterDescription'),
				'htmlOptions' => array(
					'width' => '450px'
				),
			),
			array(
				'class' => 'CButtonColumn',
				'header' => GridViewFilter::getClearButton($this->route, ['id'=>$model->id]),
				'template' => '{update}{delete}',
				//'viewButtonUrl' => 'Yii::app()->createUrl("roleHasPermission/view/", array("id"=>$data->id, "clearFilter" => 1))',
				'buttons' => array(
					'delete' => array(
						'visible' => (Yii::app()->user->isAdmin ? 'true' : '$data->canDelete'),
						'url' => 'Yii::app()->createUrl("roleHasPermission/delete", array("id"=>$data->id))',
					),
					'update' => array(
						'url' => 'Yii::app()->createUrl("roleHasPermission/update", array("id"=>$data->id))',
					),
				),
				'htmlOptions' => array(
					'width' => '20px',
					//'style' => 'text-align:right'
				),
			),
		),
	)); 

Yii::app()->clientScript->registerScript('search', "
      $('#permission').click(function(){
		let text = 'Esta seguro de asignar el permiso?';
		if (confirm(text) == true) {
            event.preventDefault();

			idPermission=$('.permissionId').val();
			idRole=$model->id;

			$.ajax({
				type:'POST',
				url: '/roleHasPermission/insertHasPermission',
				dataType: 'json',
				data: {
					'permissionId' : idPermission,
					'roleId' : idRole,
				},
				success: function(data, status){
				  console.log(arguments);
				  //Do something success-ish
				},
				error: function (request, status, error) {
				  location.reload();
				},
			  });
		} else {
		}

      });

      ");
?>

