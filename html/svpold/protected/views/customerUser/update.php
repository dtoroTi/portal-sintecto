<?php
/* @var $this CustomerUserController */
/* @var $model CustomerUser */
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}

$this->breadcrumbs=array(
	'Customer Users'=>array('admin'),
	CHtml::encode($model->id)=>array('view','id'=>CHtml::encode($model->id)),
	'Update',
);

$this->menu=array(
	array('label'=>'List CustomerUser', 'url'=>array('index')),
	array('label'=>'Create CustomerUser', 'url'=>array('create')),
	array('label'=>'View CustomerUser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CustomerUser', 'url'=>array('admin')),
);
?>

<h1>Update CustomerUser <?php echo CHtml::encode($model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>