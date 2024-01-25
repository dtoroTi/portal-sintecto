<?php
/* @var $this PdfReportTypeController */
/* @var $model PdfReportType */

$this->breadcrumbs=array(
	'Pdf Report Types'=>array('admin'),
	CHtml::encode($model->name),
);

$this->menu=array(
	array('label'=>'Create PdfReportType', 'url'=>array('create')),
	array('label'=>'Update PdfReportType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PdfReportType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PdfReportType', 'url'=>array('admin')),
);
?>

<h1>View PdfReportType #<?php echo CHtml::encode($model->id); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'header',
		'footer',
		'body',
	),
)); ?>
