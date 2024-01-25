<?php
$this->breadcrumbs=array(
	'Verification In Products'=>array('index'),
	CHtml::encode($model->id)=>array('view','id'=>CHtml::encode($model->id)),
	'Update',
);

$this->menu=array(
	array('label'=>'List VerificationInProduct', 'url'=>array('index')),
	array('label'=>'Create VerificationInProduct', 'url'=>array('create')),
	array('label'=>'View VerificationInProduct', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage VerificationInProduct', 'url'=>array('admin')),
);
?>

<h1>Update VerificationInProduct <?php echo CHtml::encode($model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>