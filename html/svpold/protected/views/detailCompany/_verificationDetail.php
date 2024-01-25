<table>
    <tr>
        <td><?php echo CHtml::activeLabel($company, 'companyName'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][companyName]', $company->companyName);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($company, 'contactName'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][contactName]', $company->contactName);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($company, 'tel'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][tel]', $company->tel);
            ?> 
        </td>
        <td><?php echo CHtml::activeLabel($company, 'services'); ?></td>
        <td>
            <?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][services]', $company->services, array('rows' => 3, 'cols' => 20));
            ?> 
        </td>
    </tr>
<?php if ($verificationSection->verificationSectionType->name == "Proveedores"): ?>
    <tr>
        <td>
            <?php echo CHtml::activeLabel($company, 'presentsDebts'); ?>
        </td>
        <td>
            <?php
                echo CHtml::dropDownList(
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][presentsDebts]'
                    , //
                    $company->presentsDebts, //
                    Controller::$optionsYesNo);
            ?>
        </td>
    <?php endif;?>

        <?php if ($verificationSection->verificationSectionType->name == "Clientes"): ?>
    <tr>
        <td>
            <?php

            if ($verificationSection->backgroundCheck->customer->customerGroupId==559){

                echo CHtml::activeLabel($company, 'Nivel de satisfacción con el servicio/suministro entregado');

            }else{

                echo CHtml::activeLabel($company, 'deliveryCompliance'); }?>
        </td>
        <td>
            <?php
            echo CHtml::dropDownList(
                'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($company->isNewRecord ? 'new' : $company->id) . '][deliveryCompliance]'
                , //
                $company->deliveryCompliance, //
                Controller::$optionQualification);
            ?>
        </td>
        <td>
            <?php
            if ($verificationSection->backgroundCheck->customer->customerGroupId==559) {
                echo CHtml::activeLabel($company, 'Cumplimiento del servicio pactado');
            } else{
                echo CHtml::activeLabel($company, 'productsQuality');}?>
        </td>
        <td>
            <?php
            echo CHtml::dropDownList(
                'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($company->isNewRecord ? 'new' : $company->id) . '][productsQuality]'
                , //
                $company->productsQuality, //
                Controller::$optionQualification);
            ?>
        </td>
        <!--<td>
            <?php echo CHtml::activeLabel($company, 'customerService');?>
        </td>
        <td>
            <?php
        echo CHtml::dropDownList(
            'verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . ($company->isNewRecord ? 'new' : $company->id) . '][customerService]'
            , //
            $company->customerService, //
            Controller::$optionQualification);
        ?>
        </td>-->
        <td>
            <?php
            if ($verificationSection->backgroundCheck->customer->customerGroupId==559) {
                echo CHtml::activeLabel($company, 'Capacidad de respuesta y la calidad del servicio');
            } else{
                echo CHtml::activeLabel($company, 'prices');
            }
            ?>
        </td>
        <td>
            <?php
            echo CHtml::dropDownList(
                'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($company->isNewRecord ? 'new' : $company->id) . '][prices]'
                , //
                $company->prices, //
                Controller::$optionQualification);
            ?>
        </td>
        <td>
            <?php
            if ($verificationSection->backgroundCheck->customer->customerGroupId==559) {
                echo CHtml::activeLabel($company, 'Cómo considera que es la Disposición del proveedor');
            } else {
                echo CHtml::activeLabel($company, 'postSalesService');}?>
        </td>
        <td>
            <?php
            echo CHtml::dropDownList(
                'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($company->isNewRecord ? 'new' : $company->id) . '][postSalesService]'
                , //
                $company->postSalesService, //
                Controller::$optionQualification);
            ?>
        </td>

    </tr>
<?php endif;?>




    <?php if ($verificationSection->verificationSectionType->name == "Clientes"): ?>
    <tr>

        <?php endif;?>

        <td><?php
            if ($verificationSection->backgroundCheck->customer->customerGroupId==559) {
            } else{
                echo CHtml::activeLabel($company, 'relationAge');}?></td>
        <td>
            <?php
            if ($verificationSection->backgroundCheck->customer->customerGroupId==559){

            } else {
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][relationAge]', $company->relationAge);
            }?>
        </td>

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


        <?php if (!$company->isNewRecord && $verificationSection->backgroundCheck->getCanUpdate()) : ?>
            <td >
                <div class="ServiceButton">
                    <a href="<?php
                    echo $this->createUrl('/verificationSection/delete/', array(
                            'verificationSectionId' => $verificationSection->id,
                            'id' => $company->id,
                        )
                    )
                    ?>"
                       class="ui-button ui-button-icon-only ui-widget ui-state-default ui-corner-all ServiceButton"
                       title="Borrar"
                       onClick="return (confirm('Realmente desea borrar \'<?php echo $company->name; ?>?\''));">
                        <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span>
                        <span class="ui-button-text">Button</span>
                    </a>
                </div>
            </td>
        <?php endif ?>
    </tr>

</table>