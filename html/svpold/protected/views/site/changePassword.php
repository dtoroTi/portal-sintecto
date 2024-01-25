<div class="form">
  <h1>Cambio de Palabra Clave</h1>
  <?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="info">
      <?php echo Yii::app()->user->getFlash('success'); ?><br/><br/>
    </div>

  <?php else: ?>
    <p>
      Los campos con <span class="required">*</span> son obligatorios.
    </p>

    <?php echo CHtml::form(); ?>

    <?php echo CHtml::errorSummary($form); ?>

    <div class="form wide">
      <div class="simple">
        <?php echo CHtml::activeLabelEx($form, 'password'); ?>
        <?php echo CHtml::activePasswordField($form, 'password', array('size' => 20, 'maxlength' => 255)); ?>
      </div>
      <div class="simple">
        <?php echo CHtml::activeLabelEx($form, 'newPassword1'); ?>
        <?php echo CHtml::activePasswordField($form, 'newPassword1', array('size' => 20, 'maxlength' => 255)); ?>
      </div>
      <div class="simple">
        <?php echo CHtml::activeLabelEx($form, 'newPassword2'); ?>
        <?php echo CHtml::activePasswordField($form, 'newPassword2', array('size' => 20, 'maxlength' => 255)); ?>
        <p class="hint">Por favor confirme la nueva clave.</p>
      </div>

      <div class="action">
        <?php echo CHtml::submitButton('Change'); ?>
      </div>
    </div>

  </form>
<?php endif; ?>
</div><!-- yiiForm -->