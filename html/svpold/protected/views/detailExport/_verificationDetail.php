<table>
    
<tr>
        <td>RUC: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][Ruc]', $person->Ruc);

            ?>
        </td>

    
        <td>Exporta: </td>
        <td>
            <?php       

                echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][Export]'
                    , //
                    $person->Export, //
                    Controller::$optionsYesNoNull);

            ?>
        </td>

        <td>Código País: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][CountryCode]', $person->CountryCode);

            ?>
        </td>

        <td>Nombre País: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][CountryName]', $person->CountryName);

            ?>
        </td>
    </tr>
    <tr>

        <td>Listado Países: </td>
        <td>
            <?php

            echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][CountryList]', $person->CountryList);

            ?>
        </td>


        <td>Fecha: </td>

        <td>
            <?php
            echo CHtml::dateField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][AsOfDate]', $person->AsOfDate);
            ?>

        </td>

        <td>Monto: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][Amount]', $person->Amount);

            ?>
        </td>
   
        <td>Moneda: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][Currency]', $person->Currency);

            ?>
        </td>
    </tr>
    <tr>
        <td>Porcentaje: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][Percentage]', $person->Percentage);

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