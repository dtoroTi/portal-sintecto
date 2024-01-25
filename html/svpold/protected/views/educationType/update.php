<?php
$this->breadcrumbs=array(
	'Education Types'=>array('index'),
	CHtml::encode($model->name)=>array('view','id'=>CHtml::encode($model->id)),
	'Update',
);

$this->menu=array(
	array('label'=>'List EducationType', 'url'=>array('index')),
	array('label'=>'Create EducationType', 'url'=>array('create')),
	array('label'=>'View EducationType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EducationType', 'url'=>array('admin')),
);
?>

<h1>Update EducationType <?php echo CHtml::encode($model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>