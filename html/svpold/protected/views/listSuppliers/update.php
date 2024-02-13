<?php
/* @var $this ListSuppliersController */
/* @var $model ListSuppliers */

$this->breadcrumbs=array(
	'List Suppliers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ListSuppliers', 'url'=>array('index')),
	array('label'=>'Create ListSuppliers', 'url'=>array('create')),
	array('label'=>'View ListSuppliers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ListSuppliers', 'url'=>array('admin')),
);
?>

<h1>Update ListSuppliers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>