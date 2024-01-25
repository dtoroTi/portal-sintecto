<div class='QTText'>
    <label class='<?php echo CHtml::encode($question->questionText->cssClass) ?>'>
        <?php echo CHtml::encode($question->questionText); ?>
    </label>
    <?php
    echo CHtml::textArea($varName . '[' . $question['id'] . ']', $answer, array(
        'cols' => CHtml::encode($question['cols']),
        'rows' => CHtml::encode($question['rows'])
    ));
    ?>
</div>