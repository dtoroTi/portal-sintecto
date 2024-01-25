<?php
/* @var $this PdfReportTypeController */
/* @var $model PdfReportType */

$this->breadcrumbs=array(
	'Pdf Report Types'=>array('admin'),
	CHtml::encode($model->name)=>array('view','id'=>CHtml::encode($model->id)),
	'Update',
);

$this->menu=array(
	array('label'=>'Create PdfReportType', 'url'=>array('create')),
	array('label'=>'View PdfReportType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PdfReportType', 'url'=>array('admin')),
);
?>

<h1>Update PdfReportType <?php echo CHtml::encode($model->id); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>