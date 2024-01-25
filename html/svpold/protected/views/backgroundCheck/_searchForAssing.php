<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>
    <table>

        <tr>
            <td>
                <div class="row">
                <?php //echo $form->label($model, 'createdOnFrom'); ?>
                    <?php 
                   /* $this->widget('jqueryDateTime', array(
                        'name' => 'createdOnFrom',
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
                    ))*/
                    ?><!--<b> Hasta: </b>--><?php /*
                        $this->widget('jqueryDateTime', array(
                            'name' => 'createdOnUntil',
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
                        ))*/
                    ?>
                    <?php //echo $form->label($model, 'createdOn'); ?>
                    <?php //echo $form->textField($model, 'createdOnFrom'); ?><?php //echo $form->textField($model, 'createdOnUntil'); ?>

                    <!--<p class="hint">
                        * Fecha y hora en formato AAAA-MM-DD HH:MM:SS 
                    </p>-->
                </div>


                <div class="row">
                    <?php echo $form->label($model, 'studyStartedOnFrom'); ?>
                    <?php 
                         $this->widget('jqueryDateTime', array(
                            'name' => 'BackgroundCheck[studyStartedOnFrom]',
                            'value' =>  $model->studyStartedOnFrom,
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
                    ?><b> Hasta:</b>
                    <?php
                        $this->widget('jqueryDateTime', array(
                            'name' => 'BackgroundCheck[studyStartedOnUntil]',
                            'value' =>  $model->studyStartedOnUntil,
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
                    <?php //echo $form->label($model, 'studyStartedOn'); ?>
                    <?php //echo $form->textField($model, 'studyStartedOnFrom'); ?><?php //echo $form->textField($model, 'studyStartedOnUntil'); ?>
                </div>

                <div class="row">
                    <?php echo $form->label($model, 'studyLimitOnFrom'); ?>
                    <?php 
                         $this->widget('jqueryDateTime', array(
                            'name' => 'BackgroundCheck[studyLimitOnFrom]',
                            'value' =>  $model->studyLimitOnFrom,
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
                    ?><b> Hasta:</b>
                    <?php
                        $this->widget('jqueryDateTime', array(
                            'name' => 'BackgroundCheck[studyLimitOnUntil]',
                            'value' =>  $model->studyLimitOnUntil,
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
                    <?php //echo $form->label($model, 'studyLimitOn'); ?>
                    <?php //echo $form->textField($model, 'studyLimitOnFrom'); ?><?php //echo $form->textField($model, 'studyLimitOnUntil'); ?>
                </div>


                <div class="row">
                    <?php //echo $form->label($model, 'approvedOnFrom'); ?>
                    <?php 
                         /*$this->widget('jqueryDateTime', array(
                            'name' => 'approvedOnFrom',
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
                        ))*/
                    ?><!--<b> Hasta:</b>-->
                    <?php
                        /*$this->widget('jqueryDateTime', array(
                            'name' => 'approvedOnUntil',
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
                        ))*/
                    ?>
                    <?php //echo $form->label($model, 'approvedOnFrom'); ?>
                    <?php //echo $form->textField($model, 'approvedOnFrom'); ?><?php //echo $form->textField($model, 'approvedOnUntil'); ?>
                    <!--<p class="hint">
                        * Fecha y hora en formato AAAA-MM-DD HH:MM:SS
                    </p>-->
                </div>
                <div class="row">
                    <?php //echo $form->label($model, 'deliveredToCustomerOn'); ?>
                    <?php 
                         /*$this->widget('jqueryDateTime', array(
                            'name' => 'deliveredToCustomerOn',
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
                        ))*/
                    ?><!--<b> Hasta:</b>-->
                    <?php
                        /*$this->widget('jqueryDateTime', array(
                            'name' => 'deliveredToCustomerOnUntil',
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
                        ))*/
                    ?>
                    <?php //echo $form->label($model, 'deliveredToCustomerOn'); ?>
                    <?php //echo $form->textField($model, 'deliveredToCustomerOn'); ?><?php //echo $form->textField($model, 'deliveredToCustomerOnUntil'); ?>
                    <!--<p class="hint">
                        * Fecha y hora en formato AAAA-MM-DD HH:MM:SS 
                    </p>-->
                </div>
                <div class="row">
                    <?php echo $form->label($model, 'customerProductName'); ?>
                    <?php echo $form->textField($model, 'customerProductName'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'Asignado a'); ?>
                    <?php
                    echo $form->dropdownList($model, 'assignedUserId', //
                            GridViewFilter::getNullArray() +
                            CHtml::listData(User::model()->findAll(array('order' => 'firstName')), 'id', 'name'), array('prompt' => '...'));
                    ?>
                    <?php echo $form->error($model, 'assignedUserId'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'Sección'); ?>
                    <?php
                    echo $form->dropdownList($model, 'verificationSectionTypeId', //
                            CHtml::listData(VerificationSectionType::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...'));
                    ?>
                    <?php echo $form->error($model, 'verificationSectionTypeId'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'Grupo de Secciones'); ?>
                    <?php
                    echo $form->dropdownList($model, 'verificationSectionGroupId', //
                            CHtml::listData(VerificationSectionGroup::model()->findAll(array('order'=>'name')), 'id', 'name'), array('prompt' => '...'));
                    ?>
                    <?php echo $form->error($model, 'verificationSectionGroupId'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'hasSectionsWithoutUser'); ?>
                    <?php echo $form->checkBox($model, 'hasSectionsWithoutUser'); ?>
                    <?php echo $form->error($model, 'hasSectionsWithoutUser'); ?>
                </div><br>
                <div class="row buttons">
                    <?php echo CHtml::submitButton('Search'); ?>
                </div>

            </td>
            <td>
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
                    echo $form->dropdownList($model, //
                            'customerId', //
                            CHtml::listData(//
                                    Customer::model()->findAll(array('order' => 'name asc')), 'id', 'name'), array('prompt' => 'Cliente...'));
                    ?>
                    <?php echo $form->error($model, 'customerGroupId'); ?>
                </div>


                <div class="row">
                    <?php echo $form->labelEx($model, 'backgroundCheckStatusId'); ?>
                    <?php
                    echo $form->dropdownList($model, //
                            'backgroundCheckStatusId', CHtml::listData(BackgroundCheckStatus::model()->findAll(array(
                                        'condition' =>'id=1 OR id=5',
                                        'order' => 'name'
                                    )), 'id', 'name'), array(
                        'prompt' => '...'
                    ));
                    ?>
                    <?php echo $form->error($model, 'backgroundCheckStatusId'); ?>
                </div>

                <!--<div class="row">
                    <?php //echo $form->labelEx($model, 'code'); ?>
                    <?php //echo $form->textField($model, 'code'); ?>
                    <?php //echo $form->error($model, 'code'); ?>
                </div>-->
                <div class="row">
                    <?php echo $form->labelEx($model, 'code'); ?>
                    <?php echo $form->textField($model, 'code'); ?>
                    <?php echo $form->error($model, 'code'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'firstName'); ?>
                    <?php echo $form->textField($model, 'firstName'); ?>
                    <?php echo $form->error($model, 'firstName'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'lastName'); ?>
                    <?php echo $form->textField($model, 'lastName'); ?>
                    <?php echo $form->error($model, 'lastName'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'idNumber'); ?>
                    <?php echo $form->textField($model, 'idNumber'); ?>
                    <?php echo $form->error($model, 'idNumber'); ?>
                </div>
            </td>
        </tr>
    </table>


    <?php $this->endWidget(); ?>

</div><!-- search-form -->