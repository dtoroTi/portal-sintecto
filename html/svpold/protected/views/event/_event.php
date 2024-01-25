<tr>
    <td>
        <b><?php echo CHtml::encode($event->getAttributeLabel('detail')); ?></b>
    </td>
    <td style="width: 150px;">
        <?php if ($event->isNewRecord || !$event->informedToCustomer): ?>

            <?php
            echo CHtml::textArea('events' .
                    '[' . ($event->isNewRecord ? 'new' : $event->id) . '][detail]', $event->detail, array(
                'rows' => 2,
                'cols' => 30,
                'disabled' => (!$event->isNewRecord && $event->informedToCustomer && !Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()),
            ));
            ?>
        <?php else: ?>
            <?php echo CHtml::encode($event->detail); ?>
        <?php endif; ?>

    </td>
    <td>
        <b><?php echo CHtml::encode($event->getAttributeLabel('eventTypeId')); ?></b>
    </td>
    <td>
        <?php if ($event->isNewRecord || !$event->informedToCustomer): ?>
            <?php
            echo CHtml::dropDownList(//
                    'events' .
                    '[' . ($event->isNewRecord ? 'new' : $event->id) . ']' .
                    '[eventTypeId]', //
                    $event->eventTypeId, //
                    CHtml::listData(
                            EventType::model()->findAll(), //
                            'id', //
                            'nick'));
            ?>
        <?php else: ?>
            <?php echo CHtml::encode($event->eventType ? $event->eventType->name : ""); ?>
        <?php endif; ?>
    </td>





    <td>
        <b><?php echo CHtml::encode($event->getAttributeLabel('eventTypeNewsId')); ?></b>
    </td>
    <td>
        <?php if ($event->isNewRecord || !$event->informedToCustomer): ?>
            <?php
            echo CHtml::dropDownList(//
                'events' .
                '[' . ($event->isNewRecord ? 'new' : $event->id) . ']' .
                '[eventTypeNewsId]', //
                $event->eventTypeNewsId, //
                CHtml::listData(
                    EventTypeNews::model()->findAll(), //
                    'id', //
                    'nick'));
            ?>
        <?php else: ?>
            <?php echo CHtml::encode($event->eventTypeNews ? $event->eventTypeNews->name : ""); ?>
        <?php endif; ?>
    </td>







    <td>
        <b><?php echo CHtml::activeLabel($event, 'newLimitDate'); ?></b>
    </td>
    <td>
        <?php if ($event->isNewRecord || !$event->informedToCustomer): ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'events' .
                '[' . ($event->isNewRecord ? 'new' : $event->id) . ']' .
                '[newLimitDate]',
                'value' => $event->newLimitDate,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'dateFormat' => 'yy-mm-dd',
                    'showButtonPanel' => true,
                    'changeYear' => true,
                    'changeMonth' => true,
                    'maxDate' => "+30D",
                ),
                'htmlOptions' => array(
                    'style' => 'width:6em;'
                ),
            ));
            ?>     
        <?php else: ?>
            <?php echo CHtml::encode($event->newLimitDate); ?>
        <?php endif; ?>
    </td>
    <?php if (!$event->isNewRecord)  ?>
    <td nowrap>
        <b><?php echo CHtml::encode($event->getAttributeLabel('created')); ?>:</b>[<?php echo CHtml::encode($event->created); ?>]<br/>
        <b><?php echo CHtml::encode($event->getAttributeLabel('createdById')); ?>:</b>[<?php echo CHtml::encode($event->createdBy ? $event->createdBy->shortUsername : ""); ?>]<br/>
        <b><?php echo CHtml::encode($event->getAttributeLabel('approvedById')); ?>:</b>[<?php echo CHtml::encode($event->approvedBy ? $event->approvedBy->shortUsername : ""); ?>]
    </td>
    <td>
        <?php if (!$event->isNewRecord && $event->informedToCustomer): ?>
            <?php echo CHtml::activeLabel($event, 'informedToCustomerOn'); ?>
            <?php echo CHtml::encode($event->informedToCustomerOn); ?>
        <?php else : ?>
            <?php if (!$event->isNewRecord && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())): ?>
                <?php
                echo CHtml::button('Reportar a cliente', array('onclick' => 'ans=confirm("Está seguro de notificar al cliente de la Novedad en ' . $event->backgroundCheck->fullName . '?");if (ans) {document.location.href="/event/notifyCustomer?id=' . $event->id . '&pc=' . $pc . '";}'));
                ?>
            <?php else : ?>
                &nbsp;
            <?php endif; ?>
        <?php endif; ?>

        <?php if (!$event->isNewRecord && $backgroundCheck->canUpdate && (!$event->informedToCustomer || Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())): ?>
            <?php
            echo CHtml::button('Reportar a SAC', array('onclick' => 'ans=confirm("Está seguro de notificar a SAC de la Novedad en ' . $event->backgroundCheck->fullName . '?");if (ans) {document.location.href="/event/notifySAC?id=' . $event->id . '&pc=' . $pc . '";}'));
            ?>
        <?php endif; ?>
        
    </td>
    <td >
        <?php if (!$event->isNewRecord && $backgroundCheck->canUpdate && (!$event->informedToCustomer || Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())): ?>
            <div class="ServiceButton">
                <a href="<?php echo $this->createUrl('/event/delete/', array('id' => $event->id, 'pc' => $pc)) ?>" 
                   class="ui-button ui-button-icon-only ui-widget ui-state-default ui-corner-all ServiceButton" 
                   title="Borrar"
                   onClick="return (confirm('Realmente desea borrar el evento creado en \'<?php echo $event->created; ?>\'?'));"> 
                    <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span>  
                    <span class="ui-button-text">Button</span> 
                </a> 
            </div>
        <?php else : ?>
            &nbsp;
        <?php endif; ?>
    </td>

</tr>
<?php if (!$event->isNewRecord && $event->informedToCustomer): ?>
    <tr>
        <td>
            <b><?php echo CHtml::encode($event->getAttributeLabel('customerComment')); ?>:</b>
        </td>
        <td>
            <?php echo CHtml::encode($event->customerComment); ?>
        </td>
        <td>
            <b><?php echo CHtml::encode($event->getAttributeLabel('customerAnsweredOn')); ?>:</b>
        </td>
        <td>
            <?php echo CHtml::encode($event->customerAnsweredOn); ?>
        </td>
    </td>
    <td>
        <b><?php echo CHtml::encode($event->getAttributeLabel('customerIp')); ?>:</b>   
    </td>
    <td>
        <?php echo CHtml::encode($event->customerIp); ?>
    </td>
    </tr>
<?php endif; ?>

<tr>
        <?php if (!$event->isNewRecord && $backgroundCheck->canUpdate && ($event->reportSACDate!=null || $event->reportSACDate!="") && (!$event->informedToCustomer || Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())): ?>
            <td>
                <b><?php echo CHtml::encode($event->getAttributeLabel('commentSAC')); ?></b>
            </td>
            <td>
                <?php
                echo CHtml::textArea('events' .
                        '[' . ($event->isNewRecord ? 'new' : $event->id) . '][commentSAC]', $event->commentSAC, array(
                    'rows' => 2,
                    'cols' => 30,
                    'disabled' => (!$event->isNewRecord && $event->informedToCustomer && !Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()),
                ));
                ?>
            </td>
            <td nowrap>
                <b><?php echo CHtml::encode($event->getAttributeLabel('reportSACDate')); ?>:</b>[<?php echo CHtml::encode($event->reportSACDate); ?>]<br/>
                <b><?php echo CHtml::encode($event->getAttributeLabel('reportSACByid')); ?>:</b>[<?php echo CHtml::encode($event->reportSACBy ? $event->reportSACBy->shortUsername : ""); ?>]<br/>
                <b><?php echo CHtml::encode($event->getAttributeLabel('commentSACDate')); ?>:</b>[<?php echo CHtml::encode($event->commentSACDate); ?>]
            </td>
            <?php if (!$event->isNewRecord && $event->commentSAC!=""): ?>
            <td>
                <?php
                echo CHtml::button('Responder OP', array('onclick' => 'ans=confirm("Está seguro de responder a Operaciones la Novedad en ' . $event->backgroundCheck->fullName . '?");if (ans) {document.location.href="/event/responseOP?id=' . $event->id . '&pc=' . $pc . '";}'));
                ?>
            </td>
            <?php endif; ?>
        <?php endif; ?>
</tr>

<tr>
    <td colspan="6">
        <hr/>
    </td>
</tr>

<?php if ($event->isNewRecord): ?>
    <tr>
        <td>
            <?php echo CHtml::submitButton('Actualizar', array('onClick' => 'this.disabled=true;this.form.submit();')); ?>
        </td>
    </tr>
<?php endif; ?>
    
