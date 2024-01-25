<?php
$this->breadcrumbs=array(
	'Instituciones educativas' => 'admin',
	CHtml::encode($model->name),
);
$this->pageTitle=$model->name;
?>

<?php $this->renderPartial('_view', array(
	'data'=>$model,
)); ?>

