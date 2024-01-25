<?php
/* @var $this VisitInvoiceDateController */
/* @var $model VisitInvoiceDate */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'visit-invoice-date-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description'); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model, 'invoiceInitialDate'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'VisitInvoiceDate[invoiceInitialDate]',
            'value' => $model->invoiceInitialDate,
			'id'=>'invoiceInitialDate',
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
                'style' => 'height:20px;',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'invoiceInitialDate'); ?>
    </div>

	
	<div class="row">
        <?php echo $form->labelEx($model, 'invoiceClosingDate'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'VisitInvoiceDate[invoiceClosingDate]',
            'value' => $model->invoiceClosingDate,
			'id'=>'invoiceClosingDate',
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
                'style' => 'height:20px;',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'invoiceClosingDate'); ?>
    </div>

	
	<div class="row">
        <?php echo $form->labelEx($model, 'invoiceDate'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'VisitInvoiceDate[invoiceDate]',
            'value' => $model->invoiceDate,
			'id'=>'invoiceDate',
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
                'style' => 'height:20px;',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'invoiceDate'); ?>
    </div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->