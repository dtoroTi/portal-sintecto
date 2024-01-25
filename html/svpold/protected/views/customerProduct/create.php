<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs=array(
	'Customer Products'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage CustomerProduct', 'url'=>array('admin')),
);
?>

<h1>Create Un Informe de un Cliente</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>