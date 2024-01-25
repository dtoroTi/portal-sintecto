<tr>
    <td>
        <b><?php echo CHtml::encode($contact->getAttributeLabel('comments')); ?></b>
    </td>

	<td style="width: 150px;">
            <?php
            echo CHtml::textArea('contacts'. '[' . ($contact->isNewRecord ? 'new' : $contact->id) . '][comments]', $contact->comments, array(
                'rows' => 2,
                'cols' => 30,
                //'disabled' => (!Yii::app()->user->isAdmin || !Yii::app()->user->getIsByRole()),
            ));
            ?>
    </td>

	<td>
        <b><?php echo CHtml::encode($contact->getAttributeLabel('statusContact')); ?></b>
    </td>
    <td>
        <?php if($contact->statusContact=="1. Request Received"): ?>
		    <?php echo "1. Solicitud recibida"; ?>
        <?php elseif($contact->statusContact=="-3. Invalid Mobile Number"): ?>
            <?php echo "-3. Número celular inválido"; ?>
        <?php else: ?>
            <?php echo CHtml::encode($contact->statusContact); ?>
        <?php endif ?>
    </td>

	<td>
        <b><?php echo CHtml::encode($contact->getAttributeLabel('contactType')); ?></b>
    </td>
    <td>
		<?php echo CHtml::encode($contact->contactTypes->Type); ?>
    </td>

    <td>
        <b><?php echo CHtml::encode($contact->getAttributeLabel('created')); ?></b>
    </td>
    <td>
		<?php echo CHtml::encode($contact->created); ?>
    </td>
	<td>
		<?php echo CHtml::submitButton('Actualizar', array('onClick' => 'this.disabled=true;this.form.submit();')); ?>
	</td>
</tr>
<tr>
    <td colspan="6">
        <hr/>
    </td>
</tr>
