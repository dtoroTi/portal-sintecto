<?php
$this->breadcrumbs=array(
	'Holidays'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Holiday', 'url'=>array('index')),
	array('label'=>'Manage Holiday', 'url'=>array('admin')),
);
?>

<h1>Create Holiday</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>