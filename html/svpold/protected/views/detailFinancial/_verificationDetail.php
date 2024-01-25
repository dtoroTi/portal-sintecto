<table>

  <tr>
    <td>
       <?php echo $financial->getAttributeLabel('verifiedOn');?>
    </td>
    <td>
      <?php
      $this->widget('zii.widgets.jui.CJuiDatePicker', array(
          'name' => 'verificationSection' .
          '[' . $verificationSection->id . ']' .
          '[_details]' .
          '[' . $financial->id . '][verifiedOn]',
          'value' => $financial->verifiedOn,
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
       <?php echo $financial->getAttributeLabel('verificationResultId');?>
    </td>
    <td>
      <?php
      echo CHtml::dropDownList(//
              'verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($financial->isNewRecord ? 'new' : $financial->id) . '][verificationResultId]'
              , //
              $financial->verificationResultId, //
              CHtml::listData(
                      VerificationResult::model()->findAll(), //
                      'id', //
                      'name'));
      ?>

    </td>
  </tr>
  <tr>
    <td><?php echo $financial->getAttributeLabel('finalResult');?></td>
    <td>
      <?php
      echo CHtml::dropDownList(//
              'verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($financial->isNewRecord ? 'new' : $financial->id) . '][finalResult]'
              , //
              $financial->finalResult, //
              DetailFinancial::model()->getResultStatusOptions()
              );
      ?>
    </td>
  </tr>
</table>
