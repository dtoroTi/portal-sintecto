<?php
$this->breadcrumbs=array(
	'Background Check Statuses'=>array('admin'),
	CHtml::encode($model->name)=>array('view','id'=>CHtml::encode($model->id)),
	'Update',
);

$this->menu=array(
	array('label'=>'List BackgroundCheckStatus', 'url'=>array('admin')),
	array('label'=>'Create BackgroundCheckStatus', 'url'=>array('create')),
	array('label'=>'View BackgroundCheckStatus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BackgroundCheckStatus', 'url'=>array('admin')),
);
?>

<h1>Update BackgroundCheckStatus <?php echo CHtml::encode($model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>