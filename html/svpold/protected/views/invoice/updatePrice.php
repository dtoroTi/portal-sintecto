<?php
/* @var $this InvoiceController */
/* @var $model Invoice */
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
    $this->redirect('/noallowed.html');
}

$this->breadcrumbs = array(
    'Facturas' => array('admin'),
    CHtml::encode($invoice->number),
);
?>

<?php $this->renderPartial('_invoiceBasicData', array('model' => $invoice)); ?>

<?php
/* @var $this InvoiceController */
/* @var $invoice Invoice */
/* @var $backgroundCheck BackgroundCheck */
/* @var $form CActiveForm */
?>


<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'invoice-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));

if ($invoice->dayslastDateOfInvoices() >= 30){
    Yii::app()->clientScript->registerScript('', "
     $('#updatePrices :input').prop('disabled', true);
    ");
}
?>

<div id="updatePrices" class="form wide">
    <fieldset>
        <legend>Cliente y Tipo de Reporte</legend>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'customer.customerGroupId'); ?>
            <?php echo CHtml::encode($backgroundCheck->customer->name); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'customerId'); ?>
            <?php echo CHtml::encode($backgroundCheck->customer->name); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'customerProductId'); ?>
            <?php echo CHtml::encode($backgroundCheck->customerProduct->name); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'customerUserId'); ?>
            <?php echo CHtml::encode($backgroundCheck->customerUser->name); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'customerUserId'); ?>
            <?php echo CHtml::encode($backgroundCheck->customerUser->username); ?>
        </div>
    </fieldset>
    <fieldset>
        <legend>Estudio de Seguridad</legend>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'code'); ?>
            <?php echo CHtml::encode($backgroundCheck->code); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'fullname'); ?>
            <?php echo CHtml::encode($backgroundCheck->fullname); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'formatedIdNumber'); ?>
            <?php echo CHtml::encode($backgroundCheck->formatedIdNumber); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'studyStartedOn'); ?>
            <?php echo CHtml::encode($backgroundCheck->studyStartedOn); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'deliveredToCustomerOn'); ?>
            <?php echo CHtml::encode($backgroundCheck->deliveredToCustomerOn); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'backgroundCheckStatus'); ?>
            <?php echo CHtml::encode($backgroundCheck->backgroundCheckStatus->name); ?>
        </div>

    </fieldset>

    <fieldset>
        <legend>
            Valor del Estudio
        </legend>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'Precio Del Producto'); ?>
            $<?php echo HtmlHelper::amount($backgroundCheck->customerProduct->price); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'price'); ?>
            <?php echo $form->textField($backgroundCheck, 'price', array('size' => 30, 'maxlength' => 45)); ?>
            <?php echo $form->error($backgroundCheck, 'price'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'additionalPrice'); ?>
            <?php echo $form->textField($backgroundCheck, 'additionalPrice', array('size' => 45, 'maxlength' => 45)); ?>
            <?php echo $form->error($backgroundCheck, 'additionalPrice'); ?>
        </div>        
        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'additionalPriceComment'); ?>
            <?php echo $form->textField($backgroundCheck, 'additionalPriceComment', array('size' => 45, 'maxlength' => 100)); ?>
            <?php echo $form->error($backgroundCheck, 'additionalPriceComment'); ?>
        </div>    
        <div class="row buttons">
            <?php echo CHtml::submitButton('Actualizar'); ?>
        </div>        
    </fieldset>

</div>


<?php $this->endWidget(); ?>
