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
    <!--<tr>
        <td>
            <?php echo CHtml::activeLabel($company, 'lastBalanceSheet'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][lastBalanceSheet]', $company->lastBalanceSheet, array('rows' => 3, 'cols' => 100));
            ?> 
        </td>
    </tr>-->
    <tr>
        <td>
            <?php echo CHtml::activeLabel($company, 'sanctions'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][sanctions]', $company->sanctions, array('rows' => 3, 'cols' => 100));
            ?> 
        </td>
    </tr>
    </table>

    <?php
        if (
            isset($verificationSection->backgroundCheck->customerId) &&
            $verificationSection->backgroundCheck->customerId == "462" // CLARO
        ):
    ?>
    <table>
    <tr>
        <td>
            <?php echo CHtml::activeLabel($company, 'presentRisk'); ?>
        </td>
        <td>
            <?php
                echo CHtml::dropDownList(
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][presentRisk]'
                    , //
                    $company->presentRisk, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
        <td>
            <?php echo CHtml::activeLabel($company, 'rup'); ?>
        </td>
        <td>
            <?php
                echo CHtml::dropDownList(
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][rup]'
                    , //
                    $company->rup, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
        <td>
            <?php echo CHtml::activeLabel($company, 'cecop'); ?>
        </td>
        <td>
            <?php
                echo CHtml::dropDownList(
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][cecop]'
                    , //
                    $company->cecop, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
        <td>
            <?php echo CHtml::activeLabel($company, 'deudoresMorosos'); ?>
        </td>
        <td>
            <?php
                echo CHtml::dropDownList(
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][deudoresMorosos]'
                    , //
                    $company->deudoresMorosos, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
        <td>
            <?php echo CHtml::activeLabel($company, 'otras'); ?>
        </td>
        <td>
            <?php
                echo CHtml::dropDownList(
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][otras]'
                    , //
                    $company->otras, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
    </tr>

    </table>
    <?php endif;?>
    
    <?php
        if (
            isset($verificationSection->backgroundCheck->customerId) &&
            $verificationSection->backgroundCheck->customerId == "529" // PRODECO NACIONAL PLUS
        ):
    ?>
    <table>
        <tr>
            <td style="width: 135px;">
                <?php echo CHtml::activeLabel($company, 'refCIFIN'); ?>
            </td>
            <td>
                <?php
                    echo CHtml::dropDownList(
                        'verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_details]' .
                        '[' . ($company->isNewRecord ? 'new' : $company->id) . '][refCIFIN]'
                        , //
                        $company->refCIFIN, //
                        Controller::$optionCIFIN);
                ?>
            </td>
        </tr>
    </table>
    <?php endif; ?>


    <table>
    <tr>
        <td>
            <?php echo CHtml::activeLabel($company, 'liabilities'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][liabilities]', $company->liabilities, array('rows' => 3, 'cols' => 100));
            ?> 
        </td>
    </tr>
    </table>
    <table>
        <tr>
            <th>Mora</th>
            <th>No. Obligaciones</th>
            <th>Valor total</th>
            <th>Valor en mora</th>
        </tr>
        <tr>
            <th>
                AL DIA
            </th>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][nObligaciones_0]', $company->nObligaciones_0);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorTotal_0]', $company->valorTotal_0);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorMora_0]', $company->valorMora_0);
            ?>
            </td>
        </tr>
        <tr>
            <th>
                30
            </th>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][nObligaciones_30]', $company->nObligaciones_30);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorTotal_30]', $company->valorTotal_30);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorMora_30]', $company->valorMora_30);
            ?>
            </td>
        </tr>
        <tr>
            <th>
                60
            </th>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][nObligaciones_60]', $company->nObligaciones_60);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorTotal_60]', $company->valorTotal_60);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorMora_60]', $company->valorMora_60);
            ?>
            </td>
        </tr>
        <tr>
            <th>
                90
            </th>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][nObligaciones_90]', $company->nObligaciones_90);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorTotal_90]', $company->valorTotal_90);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorMora_90]', $company->valorMora_90);
            ?>
            </td>
        </tr>
        <tr>
            <th>
                120
            </th>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][nObligaciones_120]', $company->nObligaciones_120);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorTotal_120]', $company->valorTotal_120);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorMora_120]', $company->valorMora_120);
            ?>
            </td>
        </tr>
        <tr>
            <th>
                > 120
            </th>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][nObligaciones_more120]', $company->nObligaciones_more120);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorTotal_more120]', $company->valorTotal_more120);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorMora_more120]', $company->valorMora_more120);
            ?>
            </td>
        </tr>
        <tr>
            <th>
                Castigada
            </th>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][nObligaciones_castigada]', $company->nObligaciones_castigada);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorTotal_castigada]', $company->valorTotal_castigada);
            ?>
            </td>
            <td>
            <?php
                    echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][valorMora_castigada]', $company->valorMora_castigada);
            ?>
            </td>
        </tr>
        <tr>
            <th>
                TOTAL
            </th>
            <td>
            <?php
                echo number_format((
                    $company->nObligaciones_0 + 
                    $company->nObligaciones_30 + 
                    $company->nObligaciones_60 + 
                    $company->nObligaciones_90 + 
                    $company->nObligaciones_120 + 
                    $company->nObligaciones_more120 + 
                    $company->nObligaciones_castigada
                ), 0);
            ?>
            </td>
            <td>
            <?php
                echo number_format((
                    $company->valorTotal_0 + 
                    $company->valorTotal_30 + 
                    $company->valorTotal_60 + 
                    $company->valorTotal_90 + 
                    $company->valorTotal_120 + 
                    $company->valorTotal_more120 + 
                    $company->valorTotal_castigada
                ), 2 );
            ?>
            </td>
            <td>
            <?php
                echo number_format((
                    $company->valorMora_0 + 
                    $company->valorMora_30 + 
                    $company->valorMora_60 + 
                    $company->valorMora_90 + 
                    $company->valorMora_120 + 
                    $company->valorMora_more120 + 
                    $company->valorMora_castigada
                ), 2);
            ?>
            </td>
        </tr>


    </table>
    <table>
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