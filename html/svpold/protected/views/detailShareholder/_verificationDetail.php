<table>
    <tr>
        <td><?php echo CHtml::activeLabel($person, 'firstName'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][firstName]', $person->firstName);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($person, 'lastName'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][lastName]', $person->lastName);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($person, 'typeDoc'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(
                    'verificationSection' . 
                    '[' . $verificationSection->id . ']' . 
                    '[_details]' . 
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][typeDoc]'
                    , // 
                    $person->typeDoc, //
                    Controller::$typeDocument);
            ?> 
        </td>
        <td><?php echo CHtml::activeLabel($person, 'idNumber'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][idNumber]', $person->idNumber);
            ?> 
        </td>
        
    </tr>
    
    <tr>
        <td><?php echo CHtml::activeLabel($person, 'participation'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][participation]', $person->participation, array('size', '5em'));
            ?> %
        </td>      
        <td><?php echo CHtml::activeLabel($person, 'isCompany'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][isCompany]'
                    , //
                    $person->isCompany, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($person, 'position'); ?></td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][position]', $person->position);
            ?> 
        </td>

        <td><?php echo CHtml::activeLabel($person, 'appearsInClintonsList'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][appearsInClintonsList]'
                    , //
                    $person->appearsInClintonsList, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
        
    </tr>
    <?php
     //  if ($verificationSection->backgroundCheck->customerId != 298):
    ?>
    <tr>
        <td><?php echo CHtml::activeLabel($person, 'hasAdverseReference'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][hasAdverseReference]'
                    , //
                    $person->hasAdverseReference, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($person, 'managepublicresources'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][managepublicresources]'
                    , //
                    $person->managepublicresources, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($person, 'prominentpublicfunctions'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][prominentpublicfunctions]'
                    , //
                    $person->prominentpublicfunctions, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($person, 'OfacYOnu'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][OfacYOnu]'
                    , //
                    $person->OfacYOnu, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
    </tr>

    <tr>
        <td><?php echo CHtml::activeLabel($person, 'Boe'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][Boe]'
                    , //
                    $person->Boe, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($person, 'entControl'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][entControl]'
                    , //
                    $person->entControl, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($person, 'entPoliciales'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][entPoliciales]'
                    , //
                    $person->entPoliciales, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($person, 'otrosBoletines'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][otrosBoletines]'
                    , //
                    $person->otrosBoletines, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
    </tr>
    
    <tr>
        <td><?php echo CHtml::activeLabel($person, 'empresasFicticias'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][empresasFicticias]'
                    , //
                    $person->empresasFicticias, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
        <td><?php echo CHtml::activeLabel($person, 'bDeudoresMorosos'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][bDeudoresMorosos]'
                    , //
                    $person->bDeudoresMorosos, //
                    Controller::$optionsYesNoNA);
            ?>
        </td>
    </tr>
  
    <?php

       // endif; ?>
            
    <tr>
        <td><?php echo CHtml::activeLabel($person, 'comments'); ?></td>
        <td colspan="4">
            <?php
            
                echo CHtml::textArea('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_details]' .
                        '[' . ($person->isNewRecord ? 'new' : $person->id) . '][comments]', $person->comments, array('rows' => 1, 'cols' => 100));
                    
            ?>
        </td>
    
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
                       onClick="return (confirm('Realmente desea borrar \'<?php echo $person->name; ?>?\''));"> 
                        <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span> 
                        <span class="ui-button-text">Button</span> 
                    </a> 
                </div>
            </td>
        <?php endif ?>
    </tr>

</table>