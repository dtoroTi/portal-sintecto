<table>

  <tr>
    <td>
       <?php echo $polygraph->getAttributeLabel('verifiedOn');?>
    </td>
    <td>
      <?php
      $this->widget('zii.widgets.jui.CJuiDatePicker', array(
          'name' => 'verificationSection' .
          '[' . $verificationSection->id . ']' .
          '[_details]' .
          '[' . $polygraph->id . '][verifiedOn]',
          'value' => $polygraph->verifiedOn,
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
    <td>
       <?php echo $polygraph->getAttributeLabel('verificationResultId');?>
    </td>
    <td>
      <?php
      echo CHtml::dropDownList(//
              'verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . $polygraph->id . '][verificationResultId]'
              , //
              $polygraph->verificationResultId, //
              CHtml::listData(
                      VerificationResult::model()->findAll(), //
                      'id', //
                      'name'));
      ?>

    </td>
  </tr>
</table>
