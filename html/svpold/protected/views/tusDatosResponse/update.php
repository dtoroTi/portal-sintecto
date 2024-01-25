<?php
/* @var $this TusDatosResponseController */
/* @var $model TusDatosResponse */

$this->breadcrumbs=array(
	'TusDatos Responses'=>array('index'),
	CHtml::encode($model->id)=>array('view','id'=>CHtml::encode($model->id)),
	'Update',
);

$this->menu=array(
	array('label'=>'List TusDatosResponse', 'url'=>array('index')),
	array('label'=>'Create TusDatosResponse', 'url'=>array('create')),
	array('label'=>'View TusDatosResponse', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TusDatosResponse', 'url'=>array('admin')),
);
?>

<h1>Update TusDatosResponse <?php echo CHtml::encode($model->id); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>