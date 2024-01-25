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

    
        <td>Redes sociales: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][socialNetworks]', $person->socialNetworks);

            ?>
        </td>

        <td>Referencias comerciales: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][commercialReferences]', $person->commercialReferences);

            ?>
        </td>

        <td>Condiciones de pago: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][paymentConditions]', $person->paymentConditions);

            ?>
        </td>
    </tr>
    <tr>

        <td>Experiencia de pago: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][checkoutExperience]', $person->checkoutExperience);

            ?>
        </td>


        <td>Nombre del Proveedor: </td>

        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][providersName]', $person->providersName);
            ?>

        </td>

        <td>Notas: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][grades]', $person->grades);

            ?>
        </td>
   
        <td>Proveedor del estado: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][stateProvider]', $person->stateProvider);

            ?>
        </td>
    </tr>
    <tr>
        <td>Proveedor Incumplido: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][incompleteProvider]', $person->incompleteProvider);

            ?>
        </td>

    
        <td>Historia: </td>
        <td>
            <?php       

            echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][history]', $person->history);
            ?>
        </td>

        <td>Compañías vinculadas: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][relatedCompanies]', $person->relatedCompanies);

            ?>
        </td>

        <td> Nombre: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][name]', $person->name);
            ?>
        </td>

    </tr>
    <tr>
        <td>Identificación tributaria (ID): </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][taxIdentification]', $person->taxIdentification);

            ?>
        </td><td>País de Origen: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][countryOrigin]', $person->countryOrigin);
            ?>
        </td>

        <td>Pocentaje de relación: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][relationshipPercentage]', $person->relationshipPercentage);

            ?>
        </td>
   
        <td>Marcas registradas: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][trademarks]', $person->trademarks);

            ?>
        </td>
    </tr>
    <tr>
        <td> Identificación de marcas: Propio, Franquicia u otro: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][identificationBrands]', $person->identificationBrands);

            ?>
        </td>

    
        <td>Registro de bolsa de valores: </td>
        <td>
            <?php       

            echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][stockExchangeReg]', $person->stockExchangeReg);
            ?>
        </td>

        <td>Mercado: </td>
        <td>
            <?php

            echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][market]', $person->market);

            ?>
        </td>

        <td>Pólizas de seguro: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][insurancePolicies]', $person->insurancePolicies);

            ?>
        </td>
    </tr>
    <tr>

        <td>Publicaciones de prensa: </td>
        <td>
            <?php

            echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][pressReleases]', $person->pressReleases);
            ?>
        </td>


        <td>Información negativa: </td>

        <td>
            <?php
            echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][negativeInformation]', $person->negativeInformation);
            ?>

        </td>

        <td>Deudas registradas: </td>
        <td>
            <?php

            echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][registeredDebts]', $person->registeredDebts);

            ?>
        </td>
   
        <td>Clasificaciones - Rankings: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][classificationsRankings]', $person->classificationsRankings);

            ?>
        </td>
        </tr>
    <tr>
        <td>Casos judiciales registrados: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][registeredCourtCases]', $person->registeredCourtCases);

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