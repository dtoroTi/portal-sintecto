<?php
/* @var $verificationSection VerificationSection */
?>
<div class="row">
    <div class='XmlQuestion'>
        <?php $answers = $verificationSection->htmlSection->answerArray; ?>
    </div>
</div>

<div>
    <?php echo $verificationSection->htmlSection->getHtmlToFill();?>
</div>

<div>
    <?php echo CHtml::activeLabel($verificationSection->htmlSection, 'verificationResultId'); ?>
    <?php
    echo CHtml::dropDownList(//
            'verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $verificationSection->htmlSection->id  . '][verificationResultId]'
            , //
            $verificationSection->htmlSection->verificationResultId, //
            CHtml::listData(
                    VerificationResult::model()->findAll(), //
                    'id', //
                    'name'));
    ?>
</div>
