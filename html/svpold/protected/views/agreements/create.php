<?php
/* @var $this AgreementsController */
/* @var $model Agreements */

$this->breadcrumbs=array(
	'Agreements'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Agreements', 'url'=>array('admin')),
	array('label'=>'Manage Agreements', 'url'=>array('admin')),
);
?>

<h1>Crear Acuerdo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>