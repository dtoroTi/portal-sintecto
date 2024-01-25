<?php
$this->breadcrumbs=array(
	'Holidays'=>array('index'),
	CHtml::encode($model->id)=>array('view','id'=>CHtml::encode($model->id)),
	'Update',
);

$this->menu=array(
	array('label'=>'List Holiday', 'url'=>array('index')),
	array('label'=>'Create Holiday', 'url'=>array('create')),
	array('label'=>'View Holiday', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Holiday', 'url'=>array('admin')),
);
?>

<h1>Update Holiday <?php echo CHtml::encode($model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>