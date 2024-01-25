<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->breadcrumbs = array(
    'Facturas' => array('admin'),
    CHtml::encode($model->number),
);

$this->menu = array(
    array('label' => 'List Invoice', 'url' => array('index')),
    array('label' => 'Create Invoice', 'url' => array('create')),
    array('label' => 'Update Invoice', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Invoice', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Invoice', 'url' => array('admin')),
);
?>



<?php $this->renderPartial('_invoiceBasicData', array('model' => $model)); ?>

<br/>
<?php
echo CHtml::button('Exportar', array(
    'id' => 'export-button',
    'class' => 'span-3 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/invoice/export', array('id' => $model->id)) . "','_blank');")
);
?>
<?php
echo CHtml::button('Anexo', array(
    'id' => 'export-button',
    'class' => 'span-3 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/invoice/exportv2', array('id' => $model->id)) . "','_blank');")
);
?>
<hr/>

<?php $this->renderPartial('_adminBackgroundCheck', array('model' => $backgroundCheck, 'invoice' => $model)); ?>