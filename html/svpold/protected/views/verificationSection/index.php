<?php
$this->breadcrumbs=array(
	'Verification Sections',
);

$this->menu=array(
	array('label'=>'Create VerificationSection', 'url'=>array('create')),
	array('label'=>'Manage VerificationSection', 'url'=>array('admin')),
);
?>

<h1>Verification Sections</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
