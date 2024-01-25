<?php
$this->breadcrumbs=array(
	'Verification Section Types'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage VerificationSectionType', 'url'=>array('admin')),
);
?>

<h1>Create VerificationSectionType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>