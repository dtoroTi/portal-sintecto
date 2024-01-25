<table>
    
<tr>
        <td>Razon social </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][companyName]', $person->companyName);

            ?>
        </td>

    
        <td>TAX ID cliente: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][taxIdClient]', $person->taxIdClient);

            ?>
        </td>

        <td>Año de vinculación: </td>
        <td>
            <?php

            echo CHtml::dateField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][yearConnection]', $person->yearConnection);

            ?>
        </td>

        <td>Linea de credito otorgada: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][lineCreditGranted]', $person->lineCreditGranted);

            ?>
        </td>
    </tr>
    <tr>

        <td>Terminos de pago: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][paymentTerms]', $person->paymentTerms);

            ?>
        </td>


        <td>Metodo de pago: </td>

        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][paymentMethod]', $person->paymentMethod);
            ?>

        </td>

        <td>Fecha de ultima compra: </td>
        <td>
            <?php

            echo CHtml::dateField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][dateLastPurchase]', $person->dateLastPurchase);

            ?>
        </td>
   
        <td>Importe de ultima compra: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][lastPurchaseAmount]', $person->lastPurchaseAmount);

            ?>
        </td>
    </tr>
    <tr>
        <td>Promedio de compra mensual: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][averageMonthlyPurchase]', $person->averageMonthlyPurchase);

            ?>
        </td>

    
        <td>Cartera vencida: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][pastPortfolio]', $person->pastPortfolio);
            ?>
        </td>

        <td>Promedio de días vencidos: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][averageDaysPastDue]', $person->averageDaysPastDue);

            ?>
        </td>

        <td>Promedio de compra mensual: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][productServiceProvide]', $person->productServiceProvide);
            ?>
        </td>

    </tr>
    <tr>
        <td>Concepto: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][concept]', $person->concept);

            ?>
        </td><td>Razon social: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][socialName]', $person->socialName);
            ?>
        </td>

        <td>TAX ID empresa: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][taxIdCompany]', $person->taxIdCompany);

            ?>
        </td>
   
        <td>Telefono contactado: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][contactedPhone]', $person->contactedPhone);

            ?>
        </td>
    </tr>
    <tr>
        <td>Persona contactada: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][contactedPerson]', $person->contactedPerson);

            ?>
        </td>

    
        <td>Email: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][email]', $person->email);
            ?>
        </td>       
    </tr>
    <tr>
        <td>Resultado: </td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][verificationResultId]'
                , //
                $person->verificationResultId, //
                CHtml::listData(
                    VerificationResult::model()->findAll(), //
                    'id', //
                    'name'));
            ?>
        </td>


        <?php if (!$person->isNewRecord && $verificationSection->backgroundCheck->canUpdate) : ?>
            <td >
                <div class="ServiceButton">
                    <a href="<?php
                    echo $this->createUrl('/verificationSection/delete/', array(
                            'verificationSectionId' => $verificationSection->id,
                            'id' => $person->id,
                        )
                    )
                    ?>"
                       class="ui-button ui-button-icon-only ui-widget ui-state-default ui-corner-all ServiceButton"
                       title="Borrar"
                       onClick="return (confirm('Realmente desea borrar \'?\''));">
                        <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span>
                        <span class="ui-button-text">Button</span>
                    </a>
                </div>
            </td>
        <?php endif ?>
    </tr>

</table>