<?php
/* @var $this ActivityTypeController */
/* @var $model ActivityType */

$this->breadcrumbs=array(
	'RequestsSAC'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ActivityType', 'url'=>array('index')),
	array('label'=>'Manage ActivityType', 'url'=>array('admin')),
);
?>

<h1>Solicitud SAC</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>