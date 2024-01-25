<div class='QTRadio <?php echo CHtml::encode($question['cssClass']); ?>'>
    <label><?php echo $question->questionText; ?></label>
    <?php
    $options = array();
    foreach ($question->option as $key => $option) {
        $options[(string) $option['value']] = (string) $option;
    }
    echo CHtml::dropDownList($varName. '[' . $question['id'] . ']', $answer, $options, array('separator' => ''));
    ?>
</div>