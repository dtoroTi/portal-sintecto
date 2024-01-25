<?php
//comment
/* @var $this PermissionController */
/* @var $model Permission */

$this->breadcrumbs=array(
	'Permissions'=>array('admin'),
	CHtml::encode($model->controller)=>array('view','id'=>CHtml::encode($model->id)),
	'Actualizar',
);


/*$this->menu=array(
	array('label'=>'List Permission', 'url'=>array('index')),
	array('label'=>'Create Permission', 'url'=>array('create')),
	array('label'=>'View Permission', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Permission', 'url'=>array('admin')),
);*/
?>

<h1>Update Permission <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>