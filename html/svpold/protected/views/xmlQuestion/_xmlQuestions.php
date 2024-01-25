<div class="ProcessTab">
    <fieldset>
        <legend>
            <a name="xmlQuestion"></a>
        </legend>  
        <?php
        if (Yii::app()->user->hasFlash('xmlQuestion'))
            echo '<div class="flash-notice">' . Yii::app()->user->getFlash('xmlQuestion') . "</div>\n";
        ?>
        <div class="form wide">
            <?php echo CHtml::beginForm(array('/backgroundCheck/updateXmlQuestion/', 'code' => $model->code)); ?>
            <div class="row">
                <div class='XmlQuestion'>
                    <?php $questions = $model->questionXmlFormat ?>
                    <?php $answers = $model->xmlAnswerArray ?>
                    <?php echo $this->renderPartial('/xmlQuestion/_QTGroup', array( 'varName'=>'xmlQuestion' ,'questions' => $questions, 'answers' => $answers)); ?>
                </div>
                <div class = 'buttons'>
                    <?php echo CHtml::submitButton('Actualizar');
                    ?>
                </div>
            </div>
            <?php echo CHtml::endForm(); ?>

        </div><!-- form -->
    </fieldset>
</div>
