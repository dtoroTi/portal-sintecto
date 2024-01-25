<?php

if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
	$this->redirect('/noallowed.html');
}

/* @var $this ActivityTypeController */
/* @var $model ActivityType */

$this->breadcrumbs=array(
	'AttachmentFile'=>array('admin'),
	CHtml::encode($model->name_doc)=>array('view','id'=>CHtml::encode($model->id)),
	'Update',
);

$this->menu=array(
	array('label'=>'List ActivityType', 'url'=>array('index')),
	array('label'=>'Create ActivityType', 'url'=>array('create')),
	array('label'=>'View ActivityType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ActivityType', 'url'=>array('admin')),
);
?>

<h1>Actualizar Archivos <?php echo CHtml::encode($model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>