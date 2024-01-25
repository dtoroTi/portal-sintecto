<?php
//coment
/* @var $this JobCompanyController */
/* @var $model JobCompany */

$this->breadcrumbs=array(
	'Job Companies'=>array('admin'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List JobCompany', 'url'=>array('index')),
	array('label'=>'Manage JobCompany', 'url'=>array('admin')),
);*/
?>

<h1>Create JobCompany</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>