<?php

$this->breadcrumbs=array(
	'Tipo Pqrs'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoPqr', 'url'=>array('admin')),
	array('label'=>'Manage TipoPqr', 'url'=>array('admin')),
);
?>

<h1>Create Tipo De Queja</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>