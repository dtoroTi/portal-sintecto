<?php
/* @var $this CustomerGroupController */
/* @var $model CustomerGroup */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'customer-group-form',
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
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'invoiceClosingDay'); ?>
        <?php echo $form->textField($model, 'invoiceClosingDay'); ?>
        <?php echo $form->error($model, 'invoiceClosingDay'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'invoiceDay'); ?>
        <?php echo $form->textField($model, 'invoiceDay'); ?>
        <?php echo $form->error($model, 'invoiceDay'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'paymentTerms'); ?>
        <?php echo $form->textField($model, 'paymentTerms'); ?>
        <?php echo $form->error($model, 'paymentTerms'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'invoicePerCustomer'); ?>
        <?php echo $form->dropDownList($model, 'invoicePerCustomer', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'invoicePerCustomer'); ?>
    </div>

    <?php
    //Creado por Jonathan Abajo
    // echo $form->dropdownList($model, 'hasPersonalExtras', Controller::$optionsYesNo);

    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'economicSector'); ?>
        <?php
        echo $form->dropdownList($model, //
            'economicSector', //
            array(
                '' => 'N/A',
                'Electricidad & Gas' => 'Electricidad & Gas',
                'Estatal' => 'Estatal',
                'Salud' => 'Salud',
                'Tecnología y Telecomunicaciones' => 'Tecnología y Telecomunicaciones',
                'Comercio' => 'Comercio',
                'Construcción' => 'Construcción',
                'Financiero y Solidario' => 'Financiero y Solidario',
                'Industrial' => 'Industrial',
                'Minero y Petróleo' => 'Minero y Petróleo',
                'ONG' => 'ONG',
                'Servicios' => 'Servicios',
                'Transporte' => 'Transporte',

            )
        );
        ?>
        <?php echo $form->error($model, 'economicSector'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'sizeGroup'); ?>
        <?php
        echo $form->dropdownList($model, //
            'sizeGroup', //
            array(
                '' => 'N/A',
                'Grande' => 'Grande',
                'Mediano' => 'Mediano',
                'Pequeño' => 'Pequeño',
                'Micro' => 'Micro',
                'Pyme' => 'Pyme',

            )
        );
        ?>
        <?php echo $form->error($model, 'sizeGroup'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'customerAssigned'); ?>
        <?php
        echo $form->dropdownList($model, //
            'customerAssigned', //
            CHtml::listData(//
                User::model()->findAll(array('order' => 'username asc')), 'id', 'username'), array('prompt' => 'Usuario...'));
        ?>
        <?php echo $form->error($model, 'customerAssigned'); ?>
    </div>



    <?php
    //Creado por Jonathan Arriba
    ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'invoiceFieldId'); ?>
        <?php
        echo $form->dropdownList($model, //
                'invoiceFieldId', //
                array(
            '' => 'N/A',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
                )
        );
        ?>
        <?php echo $form->error($model, 'invoiceFieldId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'userId'); ?>
        <?php
        echo $form->dropdownList($model, //
                'userId', //
                CHtml::listData(//
                        User::model()->findAll(array('order' => 'username asc')), 'id', 'username'), array('prompt' => 'Usuario...'));
        ?>
        <?php echo $form->error($model, 'userId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'alertGroupDoc'); ?>
        <?php echo $form->dropDownList($model, 'alertGroupDoc', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'alertGroupDoc'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->