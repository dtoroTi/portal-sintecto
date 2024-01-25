<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->breadcrumbs = array(
    'Facturas' => array('admin'),
    CHtml::encode($model->number),
);

if ($model->dayslastDateOfInvoices() >= 30){
    Yii::app()->clientScript->registerScript('', "
     $('#svpTable :input').prop('disabled', true);
    ");
}

$this->menu = array(
    array('label' => 'List Invoice', 'url' => array('index')),
    array('label' => 'Create Invoice', 'url' => array('create')),
    array('label' => 'Update Invoice', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Invoice', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Invoice', 'url' => array('admin')),
);
?>

<h1>Factura de <?php echo $model->customerGroup->name . "&nbsp;&nbsp;(No." . $model->number . ")"; ?></h1>
<?php if ($model->closed): ?><h2>[ ** CERRADA ** ]</h2><?php endif; ?> 

<div class="form wide ProcessTab">
    <fieldset>
        <legend>Factura</legend> 
        <b><?php echo CHtml::encode($model->getAttributeLabel('from')); ?> : </b> 
        <?php echo CHtml::encode($model->from); ?>            &nbsp;&nbsp;&nbsp;&nbsp;
        <b> <?php echo CHtml::encode($model->getAttributeLabel('until')); ?> : </b>     
        <?php echo CHtml::encode($model->until); ?>             &nbsp;&nbsp;&nbsp;&nbsp;  
        <b><?php echo CHtml::encode($model->getAttributeLabel('dueOn')); ?> : </b>
        <?php echo CHtml::encode($model->dueOn); ?>             &nbsp;&nbsp;&nbsp;&nbsp;
        <b><?php echo CHtml::encode($model->getAttributeLabel('invoiceDate')); ?> : </b>
        <?php echo CHtml::encode($model->invoiceDate); ?>             &nbsp;&nbsp;&nbsp;&nbsp;
        <b><?php echo CHtml::encode($model->getAttributeLabel('numberOfStudies')); ?> : </b>
        <?php echo CHtml::encode(Controller::$optionsYesNo[$model->closed]); ?>             &nbsp;&nbsp;&nbsp;&nbsp;
    </fieldset>
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
</div>


<br/>
<hr/>
<div id="svpTable" class="SvpTable">

    <?php echo CHtml::beginForm(array('/invoice/updateProducts/', 'id' => $model->id)); ?>
    <?php echo CHtml::errorSummary($model); ?>

    <?php
    $invoiceDetail = new InvoiceDetail;
    $invoiceDetail->invoiceId = $model->id;
    ?>
    <table  >
        <tr>
            <th><?php echo CHtml::encode($invoiceDetail->getAttributeLabel('productId')); ?></th>
            <th><?php echo CHtml::encode($invoiceDetail->getAttributeLabel('description')); ?></th>
            <th><?php echo CHtml::encode($invoiceDetail->getAttributeLabel('qty')); ?></th>
            <th><?php echo CHtml::encode($invoiceDetail->getAttributeLabel('unitValue')); ?></th>
            <th><?php echo CHtml::encode($invoiceDetail->getAttributeLabel('unitType')); ?></th>
            <th><?php echo CHtml::encode($invoiceDetail->getAttributeLabel('total')); ?></th>
            <th></th>

        </tr>


        <?php foreach ($model->invoiceDetails as $invoiceDetail): ?>
            <?php $this->renderPartial('_invoiceDetail', array('model' => $invoiceDetail)); ?>
        <?php endforeach; ?>
        <?php
        $invoiceDetail = new InvoiceDetail;
        $invoiceDetail->invoiceId = $model->id;
        ?>
        <?php $this->renderPartial('_invoiceDetail', array('model' => $invoiceDetail)); ?>
        <tr>
            <th colspan="5">Total</th>
            <th style="text-align:right">$<?php echo HtmlHelper::amount($model->total, true) ?></th>
            <th>&nbsp;</th>
        </tr>
    </table>
    <?php echo CHtml::endForm(); ?>

</div>

<div class="form wide ProcessTab">
    <fieldset>
        <legend>Total</legend> 
        <?php echo CHtml::activeLabel($model, 'numberOfStudies'); ?>:
        <?php echo CHtml::encode($model->numberOfStudies); ?><br/>
        <?php echo CHtml::activeLabel($model, 'totalStudies'); ?>:
        $<?php echo HtmlHelper::amount($model->totalStudies, true); ?><br/>
        <?php echo CHtml::activeLabel($model, 'totalInvoiceDetail'); ?>:
        $<?php echo HtmlHelper::amount($model->totalInvoiceDetail, true); ?><br/>
        <?php echo CHtml::activeLabel($model, 'total'); ?>:
        $<?php echo HtmlHelper::amount($model->total, true); ?><br/>
        <?php echo CHtml::activeLabel($model, 'discount'); ?>:
        $<?php echo HtmlHelper::amount($model->discount, true); ?><br/>
        <?php echo CHtml::activeLabel($model, 'tax'); ?>:
        $<?php echo HtmlHelper::amount($model->tax, true); ?><br/>
        <?php echo CHtml::activeLabel($model, 'totalWithTax'); ?>:
        $<?php echo HtmlHelper::amount($model->totalWithTax, true); ?><br/>
        <?php echo CHtml::activeLabel($model, 'totalReceived'); ?>:
        $<?php echo HtmlHelper::amount($model->totalReceived, true); ?> [<?php echo CHtml::encode($model->paymentDate, true); ?>]<br/>
        <?php echo CHtml::activeLabel($model, 'pendingPaymend'); ?>:
        $<?php echo HtmlHelper::amount($model->pendingPayment, true); ?><br/>
    </fieldset>

</div>

