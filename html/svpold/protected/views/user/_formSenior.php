<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-formSenior',
        'method' => 'post',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
            )
    );
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('size' => 60, 'maxlength' => 255, 'disabled'=>"true")); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'firstName'); ?>
        <?php echo $form->textField($model, 'firstName', array('size' => 60, 'maxlength' => 255, 'disabled'=>"true")); ?>
        <?php echo $form->error($model, 'firstName'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'lastName'); ?>
        <?php echo $form->textField($model, 'lastName', array('size' => 60, 'maxlength' => 255, 'disabled'=>"true")); ?>
        <?php echo $form->error($model, 'lastName'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'userSeniorId'); ?>
        <?php echo $form->dropDownList($model, 'userSeniorId', 
		CHtml::listData(User::model()->findAll(
				array(
					'order' => 'firstName',
					'condition' => 'userSeniorType=:idvalue',
					'params' => array(':idvalue' => 1))
		), 'id', 'username'), array('prompt' => '...'));
        ?>
        <?php echo $form->error($model, 'userSeniorId'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->