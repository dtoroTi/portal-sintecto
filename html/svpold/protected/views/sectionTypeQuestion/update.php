<?php
/* @var $this SectionTypeQuestionController */
/* @var $model SectionTypeQuestion */

$this->breadcrumbs=array(
	'Section Type Questions'=>array('admin'),
	CHtml::encode($model->id)=>array('view','id'=>CHtml::encode($model->id)),
	'Update',
);

?>

<h1>Update SectionTypeQuestion <?php echo CHtml::encode($model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>