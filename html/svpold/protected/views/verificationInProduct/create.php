<?php
$this->breadcrumbs=array(
	'Verification In Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VerificationInProduct', 'url'=>array('index')),
	array('label'=>'Manage VerificationInProduct', 'url'=>array('admin')),
);
?>

<h1>Create VerificationInProduct</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>