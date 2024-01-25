<?php
//coment
/* @var $this JobCompanyController */
/* @var $model JobCompany */

$this->breadcrumbs=array(
	'Job Companies'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List JobCompany', 'url'=>array('index')),
	array('label'=>'Create JobCompany', 'url'=>array('create')),
	array('label'=>'View JobCompany', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JobCompany', 'url'=>array('admin')),
);*/
?>

<h1>Update JobCompany <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>