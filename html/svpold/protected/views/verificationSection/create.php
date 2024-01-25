<?php
$this->breadcrumbs=array(
	'Verification Sections'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VerificationSection', 'url'=>array('index')),
	array('label'=>'Manage VerificationSection', 'url'=>array('admin')),
);
?>

<h1>Create VerificationSection</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>