<?php
/* @var $this VerificationSectionGroupController */
/* @var $model VerificationSectionGroup */

$this->breadcrumbs=array(
	'Verification Section Groups'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'Create VerificationSectionGroup', 'url'=>array('create')),
	array('label'=>'Manage VerificationSectionGroup', 'url'=>array('admin')),
);
?>

<h1>Actualizar el group de sección : <?php echo CHtml::encode($model->name); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>