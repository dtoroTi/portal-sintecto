<table>
    <tr>
        <td><?php echo CHtml::activeLabel($auditAttendance, 'name'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($auditAttendance->isNewRecord ? 'new' : $auditAttendance->id) . '][name]', $auditAttendance->name);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($auditAttendance, 'position'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($auditAttendance->isNewRecord ? 'new' : $auditAttendance->id) . '][position]', $auditAttendance->position);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($auditAttendance, 'area'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($auditAttendance->isNewRecord ? 'new' : $auditAttendance->id) . '][area]', $auditAttendance->area);
            ?>
        </td>
        
    </tr>
   
        <td><?php echo CHtml::activeLabel($auditAttendance, 'verificationResultId'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($auditAttendance->isNewRecord ? 'new' : $auditAttendance->id) . '][verificationResultId]'
                    , //
                    $auditAttendance->verificationResultId, //
                    CHtml::listData(
                            VerificationResult::model()->findAll(), //
                            'id', //
                            'name'));
            ?>
        </td>


        <?php if (!$auditAttendance->isNewRecord && $verificationSection->backgroundCheck->getCanUpdate()) : ?>
            <td >
                <div class="ServiceButton">
                    <a href="<?php
                    echo $this->createUrl('/verificationSection/delete/', array(
                        'verificationSectionId' => $verificationSection->id,
                        'id' => $auditAttendance->id,
                            )
                    )
                    ?>" 
                       class="ui-button ui-button-icon-only ui-widget ui-state-default ui-corner-all ServiceButton" 
                       title="Borrar"
                       onClick="return (confirm('Realmente desea borrar \'<?php echo $auditAttendance->name; ?>?\''));"> 
                        <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span> 
                        <span class="ui-button-text">Button</span> 
                    </a> 
                </div>
            </td>
        <?php endif ?>
    </tr>

</table>