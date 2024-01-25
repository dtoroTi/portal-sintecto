<table>
    
<tr>
        <td>RUC: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][ruc]', $person->ruc);

            ?>
        </td>

    
        <td>Tipo de dirección: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][addressType]', $person->addressType);

            ?>
        </td>

        <td>Código postal: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][zipcode]', $person->zipcode);

            ?>
        </td>

        <td>Ciudad: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][city]', $person->city);

            ?>
        </td>
    </tr>
    <tr>

        <td>Barrio: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][street]', $person->street);

            ?>
        </td>


        <td>Dirección: </td>

        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][houseNumber]', $person->houseNumber);
            ?>

        </td>

        <td>País: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][country]', $person->country);

            ?>
        </td>
   
        <td>Área de Teléfono: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][telephoneArea]', $person->telephoneArea);

            ?>
        </td>
    </tr>
    <tr>
        <td>Número de teléfono: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][telephoneNumber]', $person->telephoneNumber);

            ?>
        </td>

    
        <td>Área de fax: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][faxArea]', $person->faxArea);
            ?>
        </td>

        <td>Número de fax: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][faxNumber]', $person->faxNumber);

            ?>
        </td>

        <td> Télex: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][telex]', $person->telex);
            ?>
        </td>

    </tr>
    <tr>
        <td>Email: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][email]', $person->email);

            ?>
        </td><td>Sitio web: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][webSite]', $person->webSite);
            ?>
        </td>

        <td>Teléfono Área 2: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][telephoneArea2]', $person->telephoneArea2);

            ?>
        </td>
   
        <td>Teléfono Área 3: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][telephoneArea3]', $person->telephoneArea3);

            ?>
        </td>
    </tr>
    <tr>
        <td> Teléfono Área 4: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][telephoneArea4]', $person->telephoneArea4);

            ?>
        </td>

    
        <td>Teléfono Área 5: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][telephoneArea5]', $person->telephoneArea5);
            ?>
        </td>

        <td>Número de teléfono 2: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][telephoneNumber2]', $person->telephoneNumber2);

            ?>
        </td>

        <td>Número de teléfono 3: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][telephoneNumber3]', $person->telephoneNumber3);

            ?>
        </td>
    </tr>
    <tr>

        <td>Número de teléfono 4: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][telephoneNumber4]', $person->telephoneNumber4);
            ?>
        </td>


        <td>Número de teléfono 5: </td>

        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][telephoneNumber5]', $person->telephoneNumber5);
            ?>

        </td>

        <td>Línea de dirección adicional: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][additionalAddressLine]', $person->additionalAddressLine);

            ?>
        </td>
   
        <td>Última modificación: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][lastChangedOn]', $person->lastChangedOn);

            ?>
        </td>
        </tr>
    <tr>
        <td>Región: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][region]', $person->region);

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