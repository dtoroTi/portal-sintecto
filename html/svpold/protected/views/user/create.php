<?php
if(!Yii::app()->user->isSuperAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs=array(
	'Users'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Crear un Usuario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>