<div class="yiiForm">

    <h1>Cambio de Palabra Clave para cifrar los PDF</h1>
    <p>
        Los campos con <span class="required">*</span> son obligatorios. Recuerde que la palabra clave del PDF debe ser cambaida con frecuencia.
    </p>
    <?php echo CHtml::form(); ?>
    <?php if (Yii::app()->user->hasFlash('success')): ?>
        <div class="info">
            <?php echo Yii::app()->user->getFlash('success'); ?><br/><br/>
        </div>
    <?php endif; ?>

    <?php echo CHtml::errorSummary($customerUser); ?>

    <div class="form wide">
        <div class="simple">
            <?php echo CHtml::activeLabelEx($customerUser, 'pdfPassword'); ?>
            <?php echo CHtml::activePasswordField($customerUser, 'pdfPassword', array('size' => 20, 'maxlength' => 255)); ?>
        </div>

        <div class="action">
            <?php echo CHtml::submitButton('Change'); ?>
        </div>
    </div>
    <?php echo CHtml::endForm(); ?>
</div><!-- yiiForm -->