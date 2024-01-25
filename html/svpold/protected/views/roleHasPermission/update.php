<?php
//comment
/* @var $this RoleHasPermissionController */
/* @var $model RoleHasPermission */

$this->breadcrumbs=array(
	'Role Has Permissions'=>array('role/admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List RoleHasPermission', 'url'=>array('index')),
	array('label'=>'Create RoleHasPermission', 'url'=>array('create')),
	array('label'=>'View RoleHasPermission', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RoleHasPermission', 'url'=>array('admin')),
);*/
?>

<h1>Actualizar Permiso por Rol <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>