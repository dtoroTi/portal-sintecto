<?php
$this->breadcrumbs=array(
	'Education Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EducationType', 'url'=>array('index')),
	array('label'=>'Manage EducationType', 'url'=>array('admin')),
);
?>

<h1>Create EducationType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>