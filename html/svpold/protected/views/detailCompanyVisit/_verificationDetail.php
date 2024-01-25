<table>
    <tr>
        <td><?php echo CHtml::activeLabel($company, 'verifiedOn'); ?></td>
        <td>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($company->isNewRecord ? 'new' : $company->id) . '][verifiedOn]',
                'value' => $company->verifiedOn,
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
    </tr>
    <tr>
        <td><?php echo CHtml::activeLabel($company, 'contact'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][contact]', $company->contact);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($company, 'contactPosition'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][contactPosition]', $company->contactPosition);
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="4"><?php echo CHtml::activeLabel($company, 'socialObject'); ?><br/>
            <?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][socialObject]', $company->socialObject, array('rows' => 3, 'cols' => 100));
            ?> 
        </td>
    </tr>

    <tr>
        <td colspan="4"><?php echo CHtml::activeLabel($company, 'services'); ?><br/>
            <?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][services]', $company->services, array('rows' => 3, 'cols' => 100));
            ?> 
        </td>
    </tr>
    <tr>
        <td colspan="4"><?php echo CHtml::activeLabel($company, 'companyHistory'); ?><br/>
            <?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][companyHistory]', $company->companyHistory, array('rows' => 3, 'cols' => 100));
            ?> 
        </td>
    </tr>

    <tr>
        <td><?php echo CHtml::activeLabel($company, 'verificationResultId'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][verificationResultId]'
                    , //
                    $company->verificationResultId, //
                    CHtml::listData(
                            VerificationResult::model()->findAll(), //
                            'id', //
                            'name'));
            ?>
        </td>

    </tr>

</table>