<?php
/* @var $this ListSuppliersController */
/* @var $model ListSuppliers */

$this->breadcrumbs=array(
	'List Suppliers'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ListSuppliers', 'url'=>array('index')),
	array('label'=>'Manage ListSuppliers', 'url'=>array('admin')),
);
?>

<h1>Adicionar Proveedor</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>