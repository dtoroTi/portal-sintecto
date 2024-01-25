<?php
$this->breadcrumbs=array(
	CHtml::encode($model->name)=>CHtml::encode($model->id),
	'Update',
);
?>

<h1>Update <i><?php echo CHtml::encode($model->name); ?></i></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>