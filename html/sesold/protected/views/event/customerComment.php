
<h1>Respuesta a una Novedad</h1>
<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'event-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($event); ?>


    <fieldset>

        <legend>Estudio</legend>    	
        <div class="row">
            <?php echo CHtml::activeLabel($event->backgroundCheck, 'code'); ?>:
            <?php echo Chtml::encode($event->backgroundCheck->code); ?><br/>
        </div>
        <div class="row">
            <?php echo CHtml::activeLabel($event->backgroundCheck, 'name'); ?>:
            <?php echo Chtml::encode($event->backgroundCheck->fullName); ?><br/>
        </div>
        <div class="row">
            <?php echo CHtml::activeLabel($event, 'detail'); ?>:
            <?php echo Chtml::encode($event->detail); ?><br/>
        </div>
        <div class="row">
            <?php echo CHtml::activeLabel($event, 'newLimitDate'); ?>:
            <?php echo Chtml::encode($event->newLimitDate); ?><br/>
        </div>
    </fieldset>

    <fieldset>

        <legend>Comentario</legend>    	
        <div class="row">
            <?php echo $form->labelEx($event, 'customerComment'); ?>
            <?php echo $form->textArea($event, 'customerComment', array('rows' => 5, 'cols' => 50)); ?>
            <?php echo $form->error($event, 'customerComment'); ?>
        </div>

    </fieldset>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Enviar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<div class="form wide">

