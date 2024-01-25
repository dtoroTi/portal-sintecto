<table>

    <tr>
        <td><?php echo CHtml::activeLabel($person, 'DateContact'); ?></td>

        <td>
            <?php
            echo CHtml::dateField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][DateContact]', $person->DateContact);
            ?>

        </td>


    <tr>
        <td><?php echo CHtml::activeLabel($person, 'Responsible'); ?></td>
        <td>
            <?php

            echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][Responsible]', $person->Responsible, array('rows' => 1, 'cols' => 100));

            ?>
        </td>

    <tr>
        <td><?php echo CHtml::activeLabel($person, 'NameContact'); ?></td>
        <td>
            <?php

            echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][NameContact]', $person->NameContact, array('rows' => 1, 'cols' => 100));

            ?>
        </td>

    <tr>
        <td><?php echo CHtml::activeLabel($person, 'Email'); ?></td>
        <td>
            <?php

            echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][Email]', $person->Email, array('rows' => 1, 'cols' => 100));

            ?>
        </td>

    <tr>
        <td><?php echo CHtml::activeLabel($person, 'Number'); ?></td>
        <td>
            <?php

            echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][Number]', $person->Number, array('rows' => 1, 'cols' => 100));

            ?>
        </td>


    <tr>

        <td><?php echo CHtml::activeLabel($person, 'ContactStatus'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][ContactStatus]'
                , //
                $person->ContactStatus, //
                Controller::$optionsTrackingContactStatus);
            ?>
        </td>

    <tr>
        <td><?php echo CHtml::activeLabel($person, 'Observations'); ?></td>
        <td>
            <?php

            echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][Observations]', $person->Observations, array('rows' => 1, 'cols' => 100));

            ?>
        </td>

    <tr>
        <td><?php echo CHtml::activeLabel($person, 'verificationResultId'); ?></td>
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