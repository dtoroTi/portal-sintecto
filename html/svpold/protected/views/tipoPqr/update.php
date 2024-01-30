<?php
/* @var $this TipoPqrController */
/* @var $model TipoPqr */

$this->breadcrumbs=array(
	'Tipo Pqrs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoPqr', 'url'=>array('index')),
	array('label'=>'Create TipoPqr', 'url'=>array('create')),
	array('label'=>'View TipoPqr', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TipoPqr', 'url'=>array('admin')),
);
?>

<h1>Update TipoPqr <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>