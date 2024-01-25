<div class="form">
    <h1>Registro de Segunda Clave</h1>
    <?php if (Yii::app()->user->hasFlash('success')): ?>
        <div class="flash-notice">
            <?php echo Yii::app()->user->getFlash('success'); ?><br/><br/>
        </div>

    <?php else: ?>
        <?php if (Yii::app()->user->hasFlash('error')): ?>
            <div class="flash-error">
                <?php echo Yii::app()->user->getFlash('error'); ?><br/><br/>
            </div>
        <?php endif; ?>


        <p>
            Por favor instale en su celular el 
            <?php echo CHtml::link('Google Authenticator', 'https://support.google.com/accounts/answer/1066447?hl=es', array('target' => '_blank')); ?> y agregue el código para ingresar a la aplicación.
        </p>
        <p>
            Si ya tenía instalada el código de seguridad de SVP, por favor borrelo y vuelva a agregarlo.
        </p>

        <?php echo $qrCode; ?>
        <hr/>

        <?php echo CHtml::form(); ?>

        <div class="form wide">
            <div class="simple">
                <?php echo CHtml::label('Código de 6 dígitos', 'otpCode'); ?>
                <?php echo CHtml::textField('otpCode', '', array('size' => 20, 'maxlength' => 6)); ?>
            </div>

            <div class="action">
                <?php echo CHtml::submitButton('Validar',array('name'=>'validate')); ?>
            </div>
        </div>

    </form>
<?php endif; ?>
</div>