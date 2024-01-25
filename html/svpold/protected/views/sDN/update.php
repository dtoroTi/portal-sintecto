<?php
/* @var $this SDNController */
/* @var $model SDN */

$this->breadcrumbs=array(
	'Sdns'=>array('index'),
	CHtml::encode($model->title)=>array('view','id'=>CHtml::encode($model->entNum)),
	'Update',
);

$this->menu=array(
	array('label'=>'List SDN', 'url'=>array('index')),
	array('label'=>'Create SDN', 'url'=>array('create')),
	array('label'=>'View SDN', 'url'=>array('view', 'id'=>$model->entNum)),
	array('label'=>'Manage SDN', 'url'=>array('admin')),
);
?>

<h1>Update SDN <?php echo CHtml::encode($model->entNum); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>