<?php
/* @var $this ListSuppliersController */
/* @var $model ListSuppliers */

$this->breadcrumbs=array(
	'List Suppliers'=>array('admin'),
	CHtml::encode($model->name),
);

$this->menu=array(
	array('label'=>'List ListSuppliers', 'url'=>array('index')),
	array('label'=>'Create ListSuppliers', 'url'=>array('create')),
	array('label'=>'Update ListSuppliers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ListSuppliers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ListSuppliers', 'url'=>array('admin')),
);
?>

<h1>Proveedor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'typeDoc',
		'document',
		'phone',
		'email',
		'cityService',
		'address',
		'price',
		'serviceProvidedId',
	),
)); ?>
