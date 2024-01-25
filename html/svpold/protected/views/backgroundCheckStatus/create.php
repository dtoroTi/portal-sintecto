<?php
$this->breadcrumbs=array(
	'Background Check Statuses'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BackgroundCheckStatus', 'url'=>array('admin')),
	array('label'=>'Manage BackgroundCheckStatus', 'url'=>array('admin')),
);
?>

<h1>Crear un Estado de Estuadio de Seguridad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>