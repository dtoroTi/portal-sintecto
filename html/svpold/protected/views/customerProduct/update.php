<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs=array(
	'Customer Products'=>array('admin'),
	CHtml::encode($model->name)=>array('view','id'=>CHtml::encode($model->id)),
	'Actualizar',
);

?>

<h1>Actualizar Producto de cliente <?php echo CHtml::encode($model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>