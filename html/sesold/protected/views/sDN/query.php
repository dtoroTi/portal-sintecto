<?php
/* @var $this SDNController */
/* @var $query SDN */

$this->breadcrumbs = array(
    'Query' => array('/SDN/query'),
);

$this->menu = array(
);
?>

<h1>Consulta de base de Datos OFAC</h1>
<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'sdn-query-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => (array('enctype' => 'multipart/form-data'))
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($query); ?>

    <?php echo $this->renderPartial('_SDNVersion', array('sdnVersions' => $sdnVersions)); ?>

    <?php if ($isActive): ?>
        <fieldset>

            <legend>Opciones</legend>    	
            <div class="row">
                <?php echo $form->labelEx($query, 'doNotIncludePrepositions'); ?>
                <?php echo $form->dropDownList($query, 'doNotIncludePrepositions', Controller::$optionsYesNo); ?>
                <?php echo $form->error($query, 'doNotIncludePrepositions'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($query, 'oneFirstnameOneLastname'); ?>
                <?php echo $form->dropDownList($query, 'oneFirstnameOneLastname', Controller::$optionsYesNo); ?>
                <?php echo $form->error($query, 'oneFirstnameOneLastname'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($query, 'allLastnames'); ?>
                <?php echo $form->dropDownList($query, 'allLastnames', Controller::$optionsYesNo); ?>
                <?php echo $form->error($query, 'allLastnames'); ?>
            </div>


        </fieldset>

        <fieldset>
            <legend>Buesqueda Individual</legend>    	
            <div class="row">
                <?php echo $form->labelEx($query, 'firstname'); ?>
                <?php echo $form->textField($query, 'firstname', array('size' => 60, 'maxlength' => 350)); ?>
                <?php echo $form->error($query, 'firstname'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($query, 'lastname'); ?>
                <?php echo $form->textField($query, 'lastname', array('size' => 60, 'maxlength' => 350)); ?>
                <?php echo $form->error($query, 'lastname'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($query, 'remarks'); ?>
                <?php echo $form->textField($query, 'remarks', array('size' => 60, 'maxlength' => 350)); ?>
                <?php echo $form->error($query, 'remarks'); ?>
                <p class="hint">
                    * Escriba los números de identificación SIN "." o ",".
                </p>
                <p class="hint">
                    * Las identificaciones tienen que tener 2 caractéres o más.
                </p>
            </div>

        </fieldset>


        <div class="row buttons">
            <?php echo CHtml::submitButton('Consultar'); ?>
        </div>
    <?php endif; ?>
    
    <?php $this->endWidget(); ?>

</div><!-- form -->

<div class="form wide">

