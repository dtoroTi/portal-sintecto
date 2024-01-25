<?php
/* @var $this InvoiceVisitController */
/* @var $model InvoiceVisit */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoice-visit-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo $form->labelEx($model, 'from'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'InvoiceVisit[from]',
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
        ?> <?php echo $form->error($model, 'from'); ?>
        <p class="hint" id="prevInvoice_from"></p>
    </div>

	<div class="row">
        <?php echo $form->labelEx($model, 'until'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'InvoiceVisit[until]',
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
            'name' => 'InvoiceVisit[invoiceDate]',
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
        ?>
        <?php echo $form->error($model, 'invoiceDate'); ?>
        <p class="hint" id="prevInvoice_invoiceDate"></p>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'numberStudies'); ?>
		<?php echo $form->textField($model,'numberStudies', array('size'=>10,'maxlength'=>10,'disabled'=>"disabled")); ?>
		<?php echo $form->error($model,'numberStudies'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'totalValueStudies'); ?>
		<?php echo $form->textField($model,'totalValueStudies',array('size'=>10,'maxlength'=>10, 'disabled'=>"disabled")); ?>
		<?php echo $form->error($model,'totalValueStudies'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'totalValueAddStudies'); ?>
		<?php echo $form->textField($model,'totalValueAddStudies',array('size'=>10,'maxlength'=>10, 'disabled'=>"disabled")); ?>
		<?php echo $form->error($model,'totalValueAddStudies'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'invoiceVisitDetails.totalValueTransportation'); ?>
		<?php echo $form->textField($model,'totalCostTansport',array('size'=>10,'maxlength'=>10, 'disabled'=>"disabled")); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'invoiceVisitDetails.totalValueFeeding'); ?>
		<?php echo $form->textField($model,'totalCostFeeding',array('size'=>10,'maxlength'=>10, 'disabled'=>"disabled")); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'invoiceVisitDetails.totalValueStationery'); ?>
		<?php echo $form->textField($model,'totalCostStationery',array('size'=>10,'maxlength'=>10, 'disabled'=>"disabled")); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model, 'statusInvoice'); ?>
        <?php echo $form->dropDownList($model, 'statusInvoice', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'statusInvoice'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->