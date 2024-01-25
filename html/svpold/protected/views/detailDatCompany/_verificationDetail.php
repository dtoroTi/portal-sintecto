<table>
    
<tr>
        <td>Nombre de la compañía: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][companyName]', $person->companyName);

            ?>
        </td>

    
        <td>Nombre corto de la empresa: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][companyShortName]', $person->companyShortName);

            ?>
        </td>

        <td>RUC: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][ruc]', $person->ruc);

            ?>
        </td>

        <td>Número de expediente: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][registrationNumber]', $person->registrationNumber);

            ?>
        </td>
    </tr>
    <tr>

        <td>País de registro: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][registrationCountry]', $person->registrationCountry);

            ?>
        </td>


        <td>Forma Legal: </td>

        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][legalForm]', $person->legalForm);
            ?>

        </td>

        <td>Forma Legal Detalle: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][legalFormText]', $person->legalFormText);

            ?>
        </td>
   
        <td>Fecha de investigación: </td>
        <td>
            <?php

            echo CHtml::dateField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][validityDate]', $person->validityDate);

            ?>
        </td>
    </tr>
    <tr>
        <td>TAX: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][taxNumber]', $person->taxNumber);

            ?>
        </td>

    
        <td>Actividad: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][nace1]', $person->nace1);
            ?>
        </td>

        <td>Actividad económica principal NACE: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][nace1Text]', $person->nace1Text);

            ?>
        </td>

        <td>Actividad: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][nace2]', $person->nace2);
            ?>
        </td>

    </tr>
    <tr>
        <td>Actividad económica NACE: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][nace2Text]', $person->nace2Text);

            ?>
        </td><td>Actividad: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][nace3]', $person->nace3);
            ?>
        </td>

        <td>Actividad económica NACE: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][nace3Text]', $person->nace3Text);

            ?>
        </td>
   
        <td>Fecha de capital social: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][usdShareCapitalDate]', $person->usdShareCapitalDate);

            ?>
        </td>
    </tr>
    <tr>
        <td>Capital social original: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][originalShareCapital]', $person->originalShareCapital);

            ?>
        </td>

    
        <td>Moneda capital social: </td>
        <td>
            <?php       

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][originalShareCapitalCurrency]', $person->originalShareCapitalCurrency);
            ?>
        </td>

        <td>Empleados: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][employees]', $person->employees);

            ?>
        </td>

        <td>Fecha Empleados: </td>
        <td>
            <?php

            echo CHtml::dateField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][employeesDate]', $person->employeesDate);

            ?>
        </td>
    </tr>
    <tr>

        <td>Fecha de registro: </td>
        <td>
            <?php

            echo CHtml::dateField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][registrationDate]', $person->registrationDate);
            ?>
        </td>


        <td>Fecha de constitución de la empresa: </td>

        <td>
            <?php
            echo CHtml::dateField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][establishedDate]', $person->establishedDate);
            ?>

        </td>

        <td>Estado de actividad: </td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][activityStatus]', $person->activityStatus);

            ?>
        </td>
   
        <td>Fecha de estado de actividad: </td>
        <td>
            <?php

            echo CHtml::dateField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][activityStatusDate]', $person->activityStatusDate);

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