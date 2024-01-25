<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
    $this->redirect('/noallowed.html');
}
/* @var $this InvoiceController */
/* @var $model Invoice */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'invoice-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'customerGroupId'); ?>
        <?php if ($model->isNewRecord || $model->numberOfStudies === 0) : ?>
            <?php
            echo $form->dropdownList($model, //
                    'customerGroupId', //
                    CHtml::listData(//
                            CustomerGroup::model()->findAll(), //
                            'id', //
                            'name'), array(//
                'ajax' => array(
                    'type' => 'POST', //request type
                    'url' => CController::createUrl('customerGroup/dynamicNextInvoice'),
                    'success' => '  
                  function updateDropdownLists(data){
                    $("#Invoice_from").datepicker("setDate",data.from);
                    $("#Invoice_until").datepicker("setDate",data.until);
                    $("#Invoice_invoiceDate").datepicker("setDate",data.invoiceDate);
                    $("#Invoice_dueOn").datepicker("setDate",data.dueOn);

                    $("#prevInvoice_from").text("Anterior:"+data.prevInvoice.from);
                    $("#prevInvoice_until").text("Anterior:"+data.prevInvoice.until);
                    $("#prevInvoice_dueOn").text("Anterior:"+data.prevInvoice.dueOn);
                    $("#prevInvoice_invoiceDate").text("Anterior:"+data.prevInvoice.invoiceDate);
                    $("#prevInvoice_number").text("Anterior:"+data.prevInvoice.number);
                    $("#prevInvoice_total").text("Anterior:"+data.prevInvoice.total);

                    }',
                    'error' => '
                  function(XMLHttpRequest, textStatus, errorThrown){
                        alert("Error en llamada Dinámica " + errorThrown);
                    }',
                    'dataType' => 'json',
                ),
                'prompt' => 'Cliente...',
            ));
            ?>
            <?php echo $form->error($model, 'customerGroupId'); ?>
        <?php else: ?>
            <?php echo CHtml::encode($model->customerGroup->name); ?>
        <?php endif; ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'from'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Invoice[from]',
            'value' => $model->from,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:14px;'
            ),
        ));
        ?>        <?php echo $form->error($model, 'from'); ?>
        <p class="hint" id="prevInvoice_from"></p>

    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'until'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Invoice[until]',
            'value' => $model->until,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:14px;'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'until'); ?>
        <p class="hint" id="prevInvoice_until"></p>

    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'invoiceDate'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Invoice[invoiceDate]',
            'value' => $model->invoiceDate,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:14px;'
            ),
        ));
        ?>        <?php echo $form->error($model, 'invoiceDate'); ?>
        <p class="hint" id="prevInvoice_invoiceDate"></p>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'dueOn'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Invoice[dueOn]',
            'value' => $model->dueOn,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:14px;'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'dueOn'); ?>
        <p class="hint" id="prevInvoice_dueOn"></p>

    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'invoiceDescriptor'); ?>
        <?php echo $form->textField($model, 'invoiceDescriptor', array('size' => 60)); ?>
        <?php echo $form->error($model, 'invoiceDescriptor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'number'); ?>
        <?php echo $form->textField($model, 'number'); ?>
        <?php echo $form->error($model, 'number'); ?>
        <p class="hint" id="prevInvoice_number"></p>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'discount'); ?>
        <?php echo $form->textField($model, 'discount'); ?>
        <?php echo $form->error($model, 'discount'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'tax'); ?>
        <?php echo $form->textField($model, 'tax'); ?>
        <?php echo $form->error($model, 'tax'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'totalReceived'); ?>
        <?php echo $form->textField($model, 'totalReceived'); ?>
        <?php echo $form->error($model, 'totalReceiced'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'paymentDate'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Invoice[paymentDate]',
            'value' => $model->paymentDate,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:14px;'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'paymentDate'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'comments'); ?>
        <?php echo $form->textArea($model, 'comments', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'comments'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'closed'); ?>
        <?php echo $form->dropDownList($model, 'closed', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'closed'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->