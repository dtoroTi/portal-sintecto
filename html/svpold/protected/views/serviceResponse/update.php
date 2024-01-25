<?php
/* @var $this ServiceResponseController */
/* @var $model ServiceResponse */

$this->breadcrumbs=array(
	'Service Responses'=>array('index'),
	CHtml::encode($model->id)=>array('view','id'=>CHtml::encode($model->id)),
	'Update',
);

$this->menu=array(
	array('label'=>'List ServiceResponse', 'url'=>array('index')),
	array('label'=>'Create ServiceResponse', 'url'=>array('create')),
	array('label'=>'View ServiceResponse', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ServiceResponse', 'url'=>array('admin')),
);
?>

<h1>Update ServiceResponse <?php echo CHtml::encode($model->id); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>