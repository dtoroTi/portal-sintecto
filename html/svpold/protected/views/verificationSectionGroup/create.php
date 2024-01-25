<?php
/* @var $this VerificationSectionGroupController */
/* @var $model VerificationSectionGroup */

$this->breadcrumbs=array(
	'Verification Section Groups'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage VerificationSectionGroup', 'url'=>array('admin')),
);
?>

<h1>Crear un Grupo de Sección</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>