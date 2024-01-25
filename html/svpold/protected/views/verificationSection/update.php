<?php
$this->breadcrumbs=array(
	'Verification Sections'=>array('index'),
	CHtml::encode($model->id)=>array('view','id'=>CHtml::encode($model->id)),
	'Update',
);

$this->menu=array(
	array('label'=>'List VerificationSection', 'url'=>array('index')),
	array('label'=>'Create VerificationSection', 'url'=>array('create')),
	array('label'=>'View VerificationSection', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage VerificationSection', 'url'=>array('admin')),
);
?>

<h1>Update VerificationSection <?php echo CHtml::encode($model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>