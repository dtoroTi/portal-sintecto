<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->breadcrumbs = array(
    'Facturas' => array('admin'),
    CHtml::encode($model->invoiceVisitId),
);

$this->menu = array(
    array('label' => 'List Invoice', 'url' => array('admin')),
    array('label' => 'Create Invoice', 'url' => array('create')),
    array('label' => 'Update Invoice', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Invoice', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Invoice', 'url' => array('admin')),
);
?>

<?php $this->renderPartial('_invoiceDetailData', array('model' => $model, 'modelinvoiceVs'=>$modelinvoiceVisit)); ?>

<br/>
<?php
echo CHtml::button('Exportar', array(
    'id' => 'export-button',
    'class' => 'span-3 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/InvoiceVisitDetail/export', array('id' => $model->invoiceVisitId)) . "','_blank');")
);
?>
<hr/>

<?php $this->renderPartial('admin', array('model' => $invoiceDetalVs, 'invoice' => $model)); ?>