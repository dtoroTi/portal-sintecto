<?php
/* @var $this InvoiceController */
/* @var $model Invoice */
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
    $this->redirect('/noallowed.html');
}

$this->breadcrumbs=array(
	'Invoices'=>array('admin'),
	'Update',
);


?>

<h1>Actualización de Factura <?php echo CHtml::link('<i class="fa fa fa-folder-open"></i>', array('/invoice/view', 'id' => $model->id)) ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>