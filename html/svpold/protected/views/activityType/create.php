<?php
/* @var $this ActivityTypeController */
/* @var $model ActivityType */

$this->breadcrumbs=array(
	'Activity Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ActivityType', 'url'=>array('index')),
	array('label'=>'Manage ActivityType', 'url'=>array('admin')),
);
?>

<h1>Create ActivityType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>