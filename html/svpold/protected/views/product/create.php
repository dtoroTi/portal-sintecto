<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('admin'),
	'Create',
);

?>

<h1>Create Product</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>