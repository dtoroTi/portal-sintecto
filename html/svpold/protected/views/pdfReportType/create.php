<?php
/* @var $this PdfReportTypeController */
/* @var $model PdfReportType */

$this->breadcrumbs=array(
	'Pdf Report Types'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage PdfReportType', 'url'=>array('admin')),
);
?>

<h1>Create PdfReportType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>