<table>
    <tr>
        <td><?php echo CHtml::activeLabel($audit, 'request'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($audit->isNewRecord ? 'new' : $audit->id) . '][request]', $audit->request);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($audit, 'description'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($audit->isNewRecord ? 'new' : $audit->id) . '][description]', $audit->description);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($audit, 'area'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($audit->isNewRecord ? 'new' : $audit->id) . '][area]', $audit->area);
            ?>
        </td>


        <td><?php echo CHtml::activeLabel($audit, 'findings'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($audit->isNewRecord ? 'new' : $audit->id) . '][findings]',$audit->findings, //
                CHtml::listData(
                    FindingsAudit::model()->findAll(), //
                    'id', //
                    'name'));
            ?>
        </td>


    </tr>
        

   
        <td><?php echo CHtml::activeLabel($audit, 'verificationResultId'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($audit->isNewRecord ? 'new' : $audit->id) . '][verificationResultId]'
                    , //
                    $audit->verificationResultId, //
                    CHtml::listData(
                            VerificationResult::model()->findAll(), //
                            'id', //
                            'name'));
            ?>
        </td>


        <?php if (!$audit->isNewRecord && $verificationSection->backgroundCheck->getCanUpdate()) : ?>
            <td >
                <div class="ServiceButton">
                    <a href="<?php
                    echo $this->createUrl('/verificationSection/delete/', array(
                        'verificationSectionId' => $verificationSection->id,
                        'id' => $audit->id,
                            )
                    )
                    ?>" 
                       class="ui-button ui-button-icon-only ui-widget ui-state-default ui-corner-all ServiceButton" 
                       title="Borrar"
                       onClick="return (confirm('Realmente desea borrar \'<?php echo $audit->request; ?>?\''));"> 
                        <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span> 
                        <span class="ui-button-text">Button</span> 
                    </a> 
                </div>
            </td>
        <?php endif ?>
    </tr>

</table>