<div class="form">
  <h1>Cambio de Palabra Clave para cifrar los PDF</h1>
  <?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="info">
      <?php echo Yii::app()->user->getFlash('success'); ?><br/><br/>
    </div>

  <?php else: ?>
    <p>
      Los campos con <span class="required">*</span> son obligatorios.
    </p>
    <?php echo CHtml::form(); ?>

    <?php echo CHtml::errorSummary($user); ?>

    <div class="form wide">
      <div class="simple">
        <?php echo CHtml::activeLabelEx($user, 'pdfPassword'); ?>
        <?php echo CHtml::activePasswordField($user, 'pdfPassword', array('size' => 20, 'maxlength' => 255)); ?>
      </div>

      <div class="action">
        <?php echo CHtml::submitButton('Change'); ?>
      </div>
    </div>

  </form>
<?php endif; ?>
</div><!-- yiiForm -->