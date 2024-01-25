<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <!--<div class="row">
        <?php //echo $form->label($model, 'createdOnFrom'); ?>
        <?php //echo $form->textField($model, 'createdOnFrom'); ?>
        <p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 00:00:00
        </p>
    </div>-->

    <!--<div class="row">
        <?php //echo $form->label($model, 'createdOnUntil'); ?>
        <?php //echo $form->textField($model, 'createdOnUntil'); ?>
        <p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 00:00:00
        </p>
    </div>-->

    <div class="row">
        <?php echo $form->label($model, 'studyStartedOnFrom'); ?>
        <?php //echo $form->textField($model, 'studyStartedOnFrom'); ?>
        <?php
            $this->widget('jqueryDateTime', array(
                'name' => 'BackgroundCheck[studyStartedOnFrom]',
                'value' =>  $model->createdOnFrom,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'format' => 'Y-m-d H:i:s',
                    'lang' => 'es',
                    'showButtonPanel' => true,
                ),
                'htmlOptions' => array(
                    'style' => 'width:10em;'
                ),
            ))
        ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'studyStartedOnUntil'); ?>
        <?php //echo $form->textField($model, 'studyStartedOnUntil'); ?>
        <?php
            $this->widget('jqueryDateTime', array(
                'name' => 'BackgroundCheck[studyStartedOnUntil]',
                'value' =>  $model->createdOnFrom,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'format' => 'Y-m-d H:i:s',
                    'lang' => 'es',
                    'showButtonPanel' => true,
                ),
                'htmlOptions' => array(
                    'style' => 'width:10em;'
                ),
            ))
        ?>
    </div>
    <!--<div class="row">
        <?php //echo $form->label($model, 'studyLimitOnFrom'); ?>
        <?php //echo $form->textField($model, 'studyLimitOnFrom'); ?>
    </div>-->

    <!--<div class="row">
        <?php //echo $form->label($model, 'studyLimitOnUntil'); ?>
        <?php //echo $form->textField($model, 'studyLimitOnUntil'); ?>
    </div>-->

    <!--<div class="row">
        <?php //echo $form->label($model, 'approvedOnFrom'); ?>
        <?php //echo $form->textField($model, 'approvedOnFrom'); ?>
        <p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 00:00:00
        </p>
    </div>-->

    <!--<div class="row">
        <?php //echo $form->label($model, 'approvedOnUntil'); ?>
        <?php //echo $form->textField($model, 'approvedOnUntil'); ?>
        <p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 00:00:00
        </p>
    </div>-->


    <div class="row">
        <?php echo $form->label($model, 'deliveredToCustomerOnFrom'); ?>
        <?php //echo $form->textField($model, 'deliveredToCustomerOnFrom'); ?>
        <?php
            $this->widget('jqueryDateTime', array(
                'name' => 'BackgroundCheck[deliveredToCustomerOnFrom]',
                'value' =>  $model->createdOnFrom,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'format' => 'Y-m-d H:i:s',
                    'lang' => 'es',
                    'showButtonPanel' => true,
                ),
                'htmlOptions' => array(
                    'style' => 'width:10em;'
                ),
            ))
        ?>
        <!--<p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 00:00:00
        </p>-->
    </div>

    <div class="row">
        <?php echo $form->label($model, 'deliveredToCustomerOnUntil'); ?>
        <?php //echo $form->textField($model, 'deliveredToCustomerOnUntil'); ?>
        <?php
            $this->widget('jqueryDateTime', array(
                'name' => 'BackgroundCheck[deliveredToCustomerOnUntil]',
                'value' =>  $model->createdOnFrom,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'format' => 'Y-m-d H:i:s',
                    'lang' => 'es',
                    'showButtonPanel' => true,
                ),
                'htmlOptions' => array(
                    'style' => 'width:10em;'
                ),
            ))
        ?>
        <!--<p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 00:00:00
        </p>-->
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'customerGroupId'); ?>
        <?php
        echo $form->dropdownList($model, //
                'customerGroupId', //
                CHtml::listData(//
                        CustomerGroup::model()->findAll(array('order' => 'name asc')), 'id', 'name'), array('prompt' => 'Grupo...'));
        ?>
        <?php echo $form->error($model, 'customerGroupId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'hasInvoice'); ?>
        <?php
        echo $form->dropdownList($model, //
                'hasInvoice', Controller::$optionsYesNo, array('prompt' => '..'));
        ?>
        <?php echo $form->error($model, 'hasInvoice'); ?>
    </div>

    <!--<div class="row">
        <?php //echo $form->labelEx($model, 'reportAvailable'); ?>
        <?php
        //echo $form->dropdownList($model, //
               // 'reportAvailable', Controller::$optionsYesNo, array('prompt' => '..'));
        ?>
        <?php //echo $form->error($model, 'reportAvailable'); ?>
    </div>-->

    <div class="row">
        <?php echo $form->labelEx($model, 'inAmendment'); ?>
        <?php
        echo $form->dropdownList($model, //
                'inAmendment', Controller::$optionsYesNo, array('prompt' => '..'));
        ?>
        <?php echo $form->error($model, 'inAmendment'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'backgroundCheckStatusId'); ?>
        <?php
        echo $form->dropdownList($model, //
                'backgroundCheckStatusId', CHtml::listData(BackgroundCheckStatus::model()->findAll(array(
                            'order' => 'name'
                        )), 'id', 'name'), array(
            'prompt' => '...'
        ));
        ?>
        <?php echo $form->error($model, 'backgroundCheckStatusId'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->