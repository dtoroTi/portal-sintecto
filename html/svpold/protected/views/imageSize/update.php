<?php
/* @var $this ImageSizeController */
/* @var $model ImageSize */

$this->breadcrumbs=array(
	'Image Sizes'=>array('index'),
	CHtml::encode($model->name)=>array('view','id'=>CHtml::encode($model->id)),
	'Update',
);

$this->menu=array(
	array('label'=>'List ImageSize', 'url'=>array('index')),
	array('label'=>'Create ImageSize', 'url'=>array('create')),
	array('label'=>'View ImageSize', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ImageSize', 'url'=>array('admin')),
);
?>

<h1>Update ImageSize <?php echo CHtml::encode($model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>