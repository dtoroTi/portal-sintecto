<?php
$this->breadcrumbs=array(
	'Verification In Products',
);

$this->menu=array(
	array('label'=>'Create VerificationInProduct', 'url'=>array('create')),
	array('label'=>'Manage VerificationInProduct', 'url'=>array('admin')),
);
?>

<h1>Verification In Products</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
