<tr>
    <td>
        <?php if ($document->isNewRecord || !$document->required): ?>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($document->isNewRecord ? 'new' : $document->id) . '][name]', $document->name);
            ?>
        <?php else: ?>
            <?php
            echo CHtml::encode($document->name);
            ?>
        <?php endif; ?>
    </td>
    <td>
        <?php
        echo CHtml::dropDownList(//
                'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($document->isNewRecord ? 'new' : $document->id) . '][verificationResultId]'
                , //
                $document->verificationResultId, //
                CHtml::listData(
                        VerificationResult::model()->findAll(), //
                        'id', //
                        'name'));
        ?>
    </td>
    <td>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . ($document->isNewRecord ? 'new' : $document->id) . '][verifiedOn]',
            'value' => $document->verifiedOn,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
                'maxDate' => "+0D",
            ),
            'htmlOptions' => array(
                'style' => 'width:6em;'
            ),
        ));
        ?>        
    </td>
    <td>
        <?php
        echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($document->isNewRecord ? 'new' : $document->id) . '][comments]', $document->comments);
        ?>
    </td>
    <td >
        <?php if (!$document->isNewRecord && !$document->required && $verificationSection->backgroundCheck->canUpdate): ?>
            <div class="ServiceButton">
                <a href="<?php echo $this->createUrl('/detailDocument/deleteDocument/', array('id' => $document->id)) ?>" 
                   class="ui-button ui-button-icon-only ui-widget ui-state-default ui-corner-all ServiceButton" 
                   title="Borrar"
                   onClick="return (confirm('Realmente desea borrar \'<?php echo $document->name; ?>?\''));"> 
                    <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span> 
                    <span class="ui-button-text">Button</span> 
                </a> 
            </div>
        <?php else: ?>
            &nbsp;
        <?php endif ?>
    </td>
</tr>
