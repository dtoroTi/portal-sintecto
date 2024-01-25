<?php
/* @var $this DynamicFormJSONController */
/* @var $model DynamicFormJSON */

$this->breadcrumbs=array(
	'Dynamic Form Jsons'=>array('admin'),
	$model->name,
);
?>

<h1>View DynamicFormJSON #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'questionnaireJSON',
		'createdAt',
	),
)); ?>
