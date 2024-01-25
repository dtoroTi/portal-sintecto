<?php
/* @var $this AgreementsController */
/* @var $model Agreements */

$this->breadcrumbs=array(
	'Agreements'=>array('admin'),
	$model->title=>array('admin','id'=>$model->id),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Agreements', 'url'=>array('admin')),
	array('label'=>'Create Agreements', 'url'=>array('create')),
	array('label'=>'View Agreements', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Agreements', 'url'=>array('admin')),
);*/
?>

<h1>Actualizar Acuerdo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>