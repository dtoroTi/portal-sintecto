<?php
/* @var $this LogController */
/* @var $model Log */
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}

$this->breadcrumbs=array(
	'Logs'=>array('admin'),
	CHtml::encode($model->id),
);


?>

<h1>View Log #<?php echo CHtml::encode($model->id); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'customerUserLogin',
		'userLogin',
		'backgroundCheckCode',
		'serverName',
		'module',
		'controller',
		'action',
		'ip',
		'comments',
		'created',
		'modified',
	),
)); 
//comment
?>
