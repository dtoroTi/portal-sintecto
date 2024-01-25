<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">
        <?php echo $form->label($model, 'firstName'); ?>
        <?php echo $form->textField($model, 'firstName'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'lastName'); ?>
        <?php echo $form->textField($model, 'lastName'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'code'); ?>
        <?php echo $form->textField($model, 'code'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'idNumber'); ?>
        <?php echo $form->textField($model, 'idNumber'); ?>
    </div>


    <div class="row">
        <?php echo $form->label($model, 'customerProductName'); ?>
        <?php echo $form->textField($model, 'customerProductName'); ?>
    </div>


    <div class="row">
        <?php echo $form->label($model, 'createdOnFrom'); ?>
        <?php echo $form->textField($model, 'createdOnFrom'); ?>
        <p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 00:00:00
        </p>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'createdOnUntil'); ?>
        <?php echo $form->textField($model, 'createdOnUntil'); ?>
        <p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 23:59:59
        </p>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'studyStartedOnFrom'); ?>
        <?php echo $form->textField($model, 'studyStartedOnFrom'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'studyStartedOnUntil'); ?>
        <?php echo $form->textField($model, 'studyStartedOnUntil'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'studyLimitOnFrom'); ?>
        <?php echo $form->textField($model, 'studyLimitOnFrom'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'studyLimitOnUntil'); ?>
        <?php echo $form->textField($model, 'studyLimitOnUntil'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'approvedOnFrom'); ?>
        <?php echo $form->textField($model, 'approvedOnFrom'); ?>
        <p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 00:00:00
        </p>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'approvedOnUntil'); ?>
        <?php echo $form->textField($model, 'approvedOnUntil'); ?>
        <p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 23:59:59
        </p>
    </div>


    <div class="row">
        <?php echo $form->label($model, 'deliveredToCustomerOnFrom'); ?>
        <?php echo $form->textField($model, 'deliveredToCustomerOnFrom'); ?>
        <p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 00:00:00
        </p>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'deliveredToCustomerOnUntil'); ?>
        <?php echo $form->textField($model, 'deliveredToCustomerOnUntil'); ?>
        <p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 23:59:59
        </p>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'invoiceSelection'); ?>
        <?php echo $form->dropdownList($model, 'invoiceSelection', Invoice::getStudySlection()); ?>
        <?php echo $form->error($model, 'invoiceSelection'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'resultId'); ?>
        <?php echo $form->dropdownList($model, 'resultId', CHtml::listData(Result::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')); ?>
        <?php echo $form->error($model, 'resultId'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->