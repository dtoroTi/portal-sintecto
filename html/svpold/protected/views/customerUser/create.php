<?php
/* @var $this CustomerUserController */
/* @var $model CustomerUser */

if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}

$this->breadcrumbs=array(
	'Customer Users'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CustomerUser', 'url'=>array('index')),
	array('label'=>'Manage CustomerUser', 'url'=>array('admin')),
);
?>

<h1>Create CustomerUser</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>