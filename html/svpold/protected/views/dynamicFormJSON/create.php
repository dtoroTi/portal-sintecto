<?php
/* @var $this DynamicFormJSONController */
/* @var $model DynamicFormJSON */

$this->breadcrumbs=array(
	'Dynamic Form Jsons'=>array('admin'),
	'Create',
);
?>

<h1>Crear Formulario Dinámico</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>