<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('admin'),
	'Update',
);

?>

<h1>Update Product <?php echo CHtml::encode($model->id); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>