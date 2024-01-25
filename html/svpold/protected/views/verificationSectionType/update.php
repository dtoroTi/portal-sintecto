<?php
$this->breadcrumbs=array(
	'Verification Section Types'=>array('admin'),
	CHtml::encode($model->name)=>array('update','id'=>CHtml::encode($model->id)),
	'Update',
);

$this->menu=array(
	array('label'=>'List VerificationSectionType', 'url'=>array('index')),
	array('label'=>'Create VerificationSectionType', 'url'=>array('create')),
	array('label'=>'View VerificationSectionType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage VerificationSectionType', 'url'=>array('admin')),
);
?>

<h1>Update VerificationSectionType <?php echo CHtml::encode($model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>