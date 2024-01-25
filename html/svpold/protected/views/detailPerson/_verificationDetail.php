<table>
  <?php if (!$person->isAReference): ?>
    <tr>
      <td><?php echo CHtml::activeLabel($person, 'relation'); ?></td>
      <td>
        <?php
        echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][relation]', $person->relation);
        ?>
      </td>
      <td><?php echo CHtml::activeLabel($person, 'name'); ?></td>
      <td>
        <?php
        echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][name]', $person->name);
        ?>
      </td>
      <td><?php echo CHtml::activeLabel($person, 'age'); ?></td>
      <td>
        <?php
        echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][age]', $person->age, array('size' => '5em'));
        ?> Años
      </td>
      <td><?php echo CHtml::activeLabel($person, 'relationshipStatusId'); ?></td>
      <td>
        <?php
        echo CHtml::dropDownList(//
                'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][relationshipStatusId]'
                , $person->relationshipStatusId, //
                CHtml::listData(RelationshipStatus::model()->findAll(), 'id', 'name')
        );
        ?>
      </td>
    </tr>
    <tr>
      <?php if (!$person->isAReference): ?>
        <td><?php echo CHtml::activeLabel($person, 'workingAt'); ?></td>
        <td>
          <?php
          echo CHtml::textField('verificationSection' .
                  '[' . $verificationSection->id . ']' .
                  '[_details]' .
                  '[' . ($person->isNewRecord ? 'new' : $person->id) . '][workingAt]', $person->workingAt);
          ?>
        </td>
        <td><?php echo CHtml::activeLabel($person, 'profession'); ?></td>
        <td>
          <?php
          echo CHtml::textField('verificationSection' .
                  '[' . $verificationSection->id . ']' .
                  '[_details]' .
                  '[' . ($person->isNewRecord ? 'new' : $person->id) . '][profession]', $person->profession);
          ?>
        </td>
        <td ><?php echo CHtml::activeLabel($person, 'functions'); ?></td>
        <td >
          <?php
          echo CHtml::textField('verificationSection' .
                  '[' . $verificationSection->id . ']' .
                  '[_details]' .
                  '[' . ($person->isNewRecord ? 'new' : $person->id) . '][functions]', $person->functions);
          ?>
        </td>
      <?php else: ?>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      <?php endif; ?>

      <td ><?php echo CHtml::activeLabel($person, 'tel'); ?></td>
      <td >
        <?php
        echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][tel]', $person->tel);
        ?>
      </td>
    </tr>
    <?php if ($person->isAReference): ?>
      <tr>
        <td><?php echo CHtml::activeLabel($person, 'howLongKnowEachOther'); ?></td>
        <td>
          <?php
          echo CHtml::textField('verificationSection' .
                  '[' . $verificationSection->id . ']' .
                  '[_details]' .
                  '[' . ($person->isNewRecord ? 'new' : $person->id) . '][howLongKnowEachOther]', $person->howLongKnowEachOther);
          ?>
        </td>
        <?php if (!$person->isAReference): ?>
          <td><?php echo CHtml::activeLabel($person, 'whoLivesWithTheCandidate'); ?></td>
          <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][whoLivesWithTheCandidate]', $person->whoLivesWithTheCandidate);
            ?>
          </td>
          <td ><?php echo CHtml::activeLabel($person, 'neighborhoodOfTheCandidate'); ?></td>
          <td >
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($person->isNewRecord ? 'new' : $person->id) . '][neighborhoodOfTheCandidate]', $person->neighborhoodOfTheCandidate);
            ?>
          </td>
        <?php else: ?>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        <?php endif; ?>
        <td ><?php echo CHtml::activeLabel($person, 'wouldYouRecomendTheCandidate'); ?></td>
        <td >
          <?php
          echo CHtml::textField('verificationSection' .
                  '[' . $verificationSection->id . ']' .
                  '[_details]' .
                  '[' . ($person->isNewRecord ? 'new' : $person->id) . '][wouldYouRecomendTheCandidate]', $person->wouldYouRecomendTheCandidate);
          ?>
        </td>
      </tr>
    <?php endif; ?>
    <tr>
      <?php if (!$person->isAReference): ?>

        <td><?php echo CHtml::activeLabel($person, 'educationTypeId'); ?></td>
        <td>
          <?php
          echo CHtml::dropDownList(//
                  'verificationSection' .
                  '[' . $verificationSection->id . ']' .
                  '[_details]' .
                  '[' . ($person->isNewRecord ? 'new' : $person->id) . '][educationTypeId]'
                  , $person->educationTypeId, //
                  CHtml::listData(EducationType::model()->findAll(), 'id', 'name'), array('prompt' => 'N/A')
          );
          ?>
        </td>
      <?php else: ?>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      <?php endif; ?>
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

      <td><?php echo CHtml::activeLabel($person, 'verifiedOn'); ?></td>
      <td>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . ($person->isNewRecord ? 'new' : $person->id) . '][verifiedOn]',
            'value' => $person->verifiedOn,
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
      <td><?php echo CHtml::activeLabel($person, 'comments'); ?></td>
      <td>
        <?php
        echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][comments]', $person->comments, array('rows' => 1, 'cols' => 20));
        ?>
      </td>
      <?php if (!$person->isNewRecord && $verificationSection->backgroundCheck->canUpdate) : ?>
        <td >
          <div class="ServiceButton">
            <a href="<?php echo $this->createUrl('/detailPerson/deletePerson/', array('id' => $person->id)) ?>" 
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
  <?php else : ?>
    <tr>
      <td><?php echo CHtml::activeLabel($person, 'relation'); ?></td>
      <td>
        <?php
        echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][relation]', $person->relation);
        ?>
      </td>
      <td><?php echo CHtml::activeLabel($person, 'name'); ?></td>
      <td>
        <?php
        echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][name]', $person->name);
        ?>
      </td>
      <td ><?php echo CHtml::activeLabel($person, 'tel'); ?></td>
      <td >
        <?php
        echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][tel]', $person->tel);
        ?>
      </td>
    </tr>
    <tr>
      <td><?php echo CHtml::activeLabel($person, 'howLongKnowEachOther'); ?></td>
      <td>
        <?php
        echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][howLongKnowEachOther]', $person->howLongKnowEachOther);
        ?>
      </td>
      <td ><?php echo CHtml::activeLabel($person, 'wouldYouRecomendTheCandidate'); ?></td>
      <td >
        <?php
        echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][wouldYouRecomendTheCandidate]', $person->wouldYouRecomendTheCandidate);
        ?>
      </td>
    </tr>
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

      <td><?php echo CHtml::activeLabel($person, 'verifiedOn'); ?></td>
      <td>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . ($person->isNewRecord ? 'new' : $person->id) . '][verifiedOn]',
            'value' => $person->verifiedOn,
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
      <td><?php echo CHtml::activeLabel($person, 'comments'); ?></td>
      <td>
        <?php
        echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][comments]', $person->comments, array('rows' => 1, 'cols' => 20));
        ?>
      </td>
      <?php if (!$person->isNewRecord && $verificationSection->backgroundCheck->canUpdate) : ?>
        <td >
          <div class="ServiceButton">
            <a href="<?php echo $this->createUrl('/detailPerson/deletePerson/', array('id' => $person->id)) ?>" 
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
  <?php endif; ?>

</table>
<?php 
if ($person->verificationSection['verificationSectionTypeId'] == 7): // Sólo aparece en el tab Familia 
?>
<table>
  <tr>
    <td>Comunicación:</td>
    <td>
      <?php
        echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][familyCommunication]', $person->familyCommunication, array('rows' => 3, 'cols' => 60));
        ?>
    </td>
  </tr>
  <tr>
    <td>Actividades que comparten:</td>
    <td>
      <?php
        echo CHtml::textArea('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . ($person->isNewRecord ? 'new' : $person->id) . '][familyActivities]', $person->familyActivities, array('rows' => 3, 'cols' => 60));
        ?>
    </td>
  </tr>
</table>
<?php endif; ?>