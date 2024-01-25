<?php
/* @var $this ImageSizeController */
/* @var $model ImageSize */

$this->breadcrumbs=array(
	'Image Sizes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ImageSize', 'url'=>array('index')),
	array('label'=>'Manage ImageSize', 'url'=>array('admin')),
);
?>

<h1>Create ImageSize</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>