  <tr>
    <td><?php echo CHtml::encode($question->sectionTypeQuestion->question)?></td>
    <td>
      <?php
      echo CHtml::textField('verificationSection' .
              '[' . $verificationSection->id . ']' .
              '[_details]' .
              '[' . $question->id . '][questionAnswer]', $question->questionAnswer);
      ?>
    </td>
  </tr>
