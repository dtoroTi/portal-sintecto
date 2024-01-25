<?php
/* @var $this DynamicFormJSONController */
/* @var $model DynamicFormJSON */

$this->breadcrumbs=array(
	'Dynamic Form Jsons'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Actualizar Formulario Dinámico <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>