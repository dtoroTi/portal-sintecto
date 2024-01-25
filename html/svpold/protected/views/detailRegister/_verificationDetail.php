<table>
  <tr>
    <td>
      Multas de Transito:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($register->isNewRecord ? 'new' : $register->id) . '][simit]', $register->simit);
      ?>
    </td>
    </tr>
    <tr>
    <td>
      Runt:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($register->isNewRecord ? 'new' : $register->id) . '][runt]', $register->runt);
?>
    </td>
</tr>
<tr>
    <td>
      Libreta Militar:
    </td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . ($register->isNewRecord ? 'new' : $register->id) . '][libreta_militar]', $register->libreta_militar);
?>
    </td>
  </tr>
  <tr>
    <td>
            Resultado
        </td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($register->isNewRecord ? 'new' : $register->id) . '][verificationResultId]'
                    , //
                    $register->verificationResultId, //
                    CHtml::listData(
                            VerificationResult::model()->findAll(), //
                            'id', //
                            'name'));
            ?>

        </td>
  </tr>
</table>
