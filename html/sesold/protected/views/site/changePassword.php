<div class="yiiForm">

    <h1>Cambio de Palabra Clave</h1>
    <p>
        Los campos con <span class="required">*</span> son obligatorios.
    </p>

    <?php echo CHtml::form(); ?>

    <?php echo CHtml::errorSummary($form); ?>

    <div class="form wide">
        <fieldset>
            <legend>Cambio de Palabra Clave</legend>  
            <div class="row">
                <?php echo CHtml::activeLabelEx($form, 'password'); ?>
                <?php echo CHtml::activePasswordField($form, 'password', array('size' => 20, 'maxlength' => 255)); ?>
            </div>
            <div class="row">
                <?php echo CHtml::activeLabelEx($form, 'newPassword1'); ?>
                <?php echo CHtml::activePasswordField($form, 'newPassword1', array('size' => 20, 'maxlength' => 255)); ?>
            </div>
            <div class="row">
                <?php echo CHtml::activeLabelEx($form, 'newPassword2'); ?>
                <?php echo CHtml::activePasswordField($form, 'newPassword2', array('size' => 20, 'maxlength' => 255)); ?>
                <p class="hint">Por favor confirme la nueva clave.</p>
            </div>

            <div class="action">
                <?php echo CHtml::submitButton('Cambiar'); ?>
            </div>
        </fieldset>
    </div>

</form>
</div><!-- yiiForm -->