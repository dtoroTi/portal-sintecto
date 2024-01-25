<?php
/* @var $this CustomerGroupController */
/* @var $model CustomerGroup */
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs=array(
	'Customer Groups'=>array('admin'),
	'Actualizar',
);


?>

<h1>Actualizar grupo de Clientes <?php echo CHtml::encode($model->id); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>