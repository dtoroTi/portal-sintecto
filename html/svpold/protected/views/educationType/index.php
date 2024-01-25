<?php
$this->breadcrumbs=array(
	'Education Types',
);

$this->menu=array(
	array('label'=>'Create EducationType', 'url'=>array('create')),
	array('label'=>'Manage EducationType', 'url'=>array('admin')),
);
?>

<h1>Education Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
