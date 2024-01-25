<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>


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
        <?php echo $form->labelEx($model, 'customerId'); ?>
        <?php
        echo $form->dropDownList($model, 'customerId', CHtml::listData(
                        Customer::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => 'Cliente...'));
        ?> 
        <?php echo $form->error($model, 'customerId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'userId'); ?>
        <?php if (Yii::app()->user->isAdmin): ?>
            <?php
            echo $form->dropDownList($model, 'assignedUserId', CHtml::listData(
                            User::getPermitedUsers(), 'id', 'username'), array('prompt' => 'Usuario...'));
            ?> 
        <?php else : ?>
            <?php echo Yii::app()->user->name; ?>
        <?php endif; ?>
        <?php echo $form->error($model, 'userId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'studyStartedOnFrom'); ?>
        <?php
        $this->widget('jqueryDateTime', array(
            'name' => 'BackgroundCheck[studyStartedOnFrom]',
            'value' => $model->studyStartedOnFrom,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'Y-m-d H:i:s',
                'lang' => 'es',
                'showButtonPanel' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
                'readonly' => 'readonly'
            ),
        ));
        ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'studyStartedOnUntil'); ?>
        <?php
        $this->widget('jqueryDateTime', array(
            'name' => 'BackgroundCheck[studyStartedOnUntil]',
            'value' => $model->studyStartedOnUntil,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'Y-m-d H:i:s',
                'lang' => 'es',
                'showButtonPanel' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
                'readonly' => 'readonly'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'studyStartedOnUntil'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'approvedOnFrom'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'BackgroundCheck[approvedOnFrom]',
            'value' => $model->approvedOnFrom,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
                'readonly' => 'readonly'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'approvedOnFrom'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'approvedOnUntil'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'BackgroundCheck[approvedOnUntil]',
            'value' => $model->approvedOnUntil,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
                'readonly' => 'readonly'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'approvedOnUntil'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'deliveredToCustomerOnFrom'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'BackgroundCheck[deliveredToCustomerOnFrom]',
            'value' => $model->deliveredToCustomerOnFrom,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
                'readonly' => 'readonly'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'deliveredToCustomerOnFrom'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'deliveredToCustomerOnUntil'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'BackgroundCheck[deliveredToCustomerOnUntil]',
            'value' => $model->deliveredToCustomerOnUntil,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
                'readonly' => 'readonly'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'deliveredToCustomerOnUntil'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->