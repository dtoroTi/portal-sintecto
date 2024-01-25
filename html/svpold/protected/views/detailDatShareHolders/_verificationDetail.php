<table>
    
<tr>
        <td>Documento de Identidad / RUC: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][ruc]', $person->ruc);

            ?>
        </td>

    
        <td>Tipo Accionista: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][shareHolderType]', $person->shareHolderType);

            ?>
        </td>

        <td>Nombre: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][shareHolderName]', $person->shareHolderName);

            ?>
        </td>

        <td>Pais: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][shareHolderCountry]', $person->shareHolderCountry);

            ?>
        </td>
    </tr>
    <tr>

        <td>Porcentaje de participación: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][ownerShipPercentage]', $person->ownerShipPercentage);

            ?>
        </td>

        <td>Codigo de funcionario: </td>

        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][functionaryCode]', $person->functionaryCode);
            ?>

        </td>


        <td>Funcion: </td>

        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][function]', $person->function);
            ?>

        </td>

        <td>Tiene acciones en: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][hasSharesIn]', $person->hasSharesIn);

            ?>
        </td>
        </tr>
    <tr>
        <td>ID del titular de la acción: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][shareHolderNameID]', $person->shareHolderNameID);

            ?>
        </td>
 
        <td>Activo desde: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][activeSince]', $person->activeSince);

            ?>
        </td>
    

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