<?php
/* @var $this AgreementsController */
/* @var $model Agreements */

$this->breadcrumbs=array(
	'Agreements'=>array('admin'),
	$model->title,
);

/*$this->menu=array(
	array('label'=>'List Agreements', 'url'=>array('index')),
	array('label'=>'Create Agreements', 'url'=>array('create')),
	array('label'=>'Update Agreements', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Agreements', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Agreements', 'url'=>array('admin')),
);*/
?>

<h1>Ver Acuerdo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'agreementsText',
		'created',
		'modified',
	),
)); ?>
