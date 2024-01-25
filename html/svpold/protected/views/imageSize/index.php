<?php
/* @var $this ImageSizeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Image Sizes',
);

$this->menu=array(
	array('label'=>'Create ImageSize', 'url'=>array('create')),
	array('label'=>'Manage ImageSize', 'url'=>array('admin')),
);
?>

<h1>Image Sizes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
