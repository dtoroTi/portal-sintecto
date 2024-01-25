<table>
    <tr>
        <td><?php echo CHtml::activeLabel($company, 'dateLastBalanceSheet'); ?></td>

        <td>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . $company->id . '][dateLastBalanceSheet]',
                'value' => $company->dateLastBalanceSheet,
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
        <td colspan="6">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>

    </tr>
    <tr>
        <td colspan="6"><?php echo CHtml::activeLabel($company, 'lastBalanceSheet'); ?><br/>
            <?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][lastBalanceSheet]', $company->lastBalanceSheet, array('rows' => 3, 'cols' => 100));
            ?> 
        </td>
    </tr>
    <tr>
        <td colspan="6"><?php echo CHtml::activeLabel($company, 'liabilities'); ?><br/>
            <?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][liabilities]', $company->liabilities, array('rows' => 3, 'cols' => 100));
            ?> 
        </td>
    </tr>
    <tr>
        <td colspan="6"><?php echo CHtml::activeLabel($company, 'sanctions'); ?><br/>
            <?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][sanctions]', $company->sanctions, array('rows' => 3, 'cols' => 100));
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