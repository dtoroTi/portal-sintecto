<?php
/* @var $this TablaPqrController */
/* @var $model TablaPqr */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tabla-pqr-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo $form->labelEx($model, 'nombreId'); ?>
        <?php
        echo $form->dropdownList($model, //
            'nombreId', //
            CHtml::listData(//
                    User::model()->findAll(array('order' => 'firstName')), //
                    'id', //
                    'summaryLine'),array('prompt' => '...'));
        ?>
        <?php echo $form->error($model, 'nombreId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'tipoReclamoId'); ?>
        <?php
        echo $form->dropdownList($model, //
            'tipoReclamoId', //
            CHtml::listData(//
                    TipoPqr::model()->findAll(array('order' => 'tipoReclamo')), //
                    'id', //
                    'tipoReclamo'),array('prompt' => '...'));
        ?>
        <?php echo $form->error($model, 'tipoReclamoId'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'nota'); ?>
		<?php echo $form->textField($model,'nota',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nota'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model, 'fechaReclamo'); ?>
        <?php 
            $this->widget('jqueryDateTime', array(
                'name' => 'TablaPqr[fechaReclamo]',
                'value' => $model->fechaReclamo,
                'id' => 'fechaReclamo',
                // additional javascript options for the date picker plugin
                'options' => [
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'format' => 'Y-m-d H:i:s',
                    'lang' => 'es',
                    'showButtonPanel' => true,
                ],
                'htmlOptions' => array(
                    'style' => 'width_10em;'
                ),
            ))
        ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'estadoReclamo'); ?>
		<?php echo $form->dropdownList($model, 'estadoReclamo', Controller::$optionsEstadoReclamo); ?>
		<?php echo $form->error($model,'estadoReclamo'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model, 'fechaRespuesta'); ?>
        <?php 
            $this->widget('jqueryDateTime', array(
                'name' => 'TablaPqr[fechaRespuesta]',
                'value' => $model->fechaRespuesta,
                'id' => 'fechaRespuesta',
                // additional javascript options for the date picker plugin
                'options' => [
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'format' => 'Y-m-d H:i:s',
                    'lang' => 'es',
                    'showButtonPanel' => true,
                ],
                'htmlOptions' => array(
                    'style' => 'width_10em;'
                ),
            ))
        ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->