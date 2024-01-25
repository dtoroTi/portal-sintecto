<?php
//comment
/* @var $this RoleController */
/* @var $model Role */

$this->breadcrumbs=array(
	'Roles'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Role', 'url'=>array('index')),
	array('label'=>'Create Role', 'url'=>array('create')),
	array('label'=>'View Role', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Role', 'url'=>array('admin')),
);*/
?>

<h1>Update Role <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>