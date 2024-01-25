<div class='QTText'>
    <label class='<?php echo CHtml::encode($question->questionText->cssClass) ?>'>
        <?php echo CHtml::encode($question->questionText); ?>
    </label>
    <?php 
        $options = array('size' => CHtml::encode($question['size']));
        if(isset($question['maxlength']))
            $options['maxlength']=$question['maxlength'];
            
        if ($question['textFormat'] == 'date'): ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => $varName . '[' . $question['id'] . ']',
            'value' => $answer,
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
                'style' => 'height:20px;'
            ),
        ));
        ?>
    <?php else: ?>
        <?php
        echo CHtml::textField($varName . '[' . $question['id'] . ']', $answer, $options);
        ?>
    <?php endif; ?>
</div>