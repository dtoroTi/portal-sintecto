<div class="ProcessTab">
    <fieldset>
        <legend>
            <a name="verificationSection_<?php echo CHtml::encode($verificationSection->id) ?>">
                [<?php echo CHtml::encode($verificationSection->percentCompleted) ?>%]</a> <?php echo CHtml::encode($verificationSection->verificationSectionType->name) ?> 
            &nbsp;
            <?php if ($verificationSection->percentCompleted == 100 && $verificationSection->getUserCanFinish( Yii::app()->user->id)): ?>
                <?php echo CHtml::button('Finalizar Sección', 
                        array(
                            'submit' => array('/verificationSection/finishSection/','id' => $verificationSection->id),
                            'onclick'=>'if (!confirm("Está seguro de finalizar las sección?")) return false;',)
                        ); ?>
            <?php endif; ?>
        </legend>  
        
        
    <?php if (!empty($verificationSection->verificationInProduct->comments)): ?>
        <fieldset>
            <legend>Punto Crítico</legend>  
            <div class="row flash-notice">
                <?php echo CHtml::encode($verificationSection->verificationInProduct->comments); ?>
            </div>
        </fieldset>
    <?php endif; ?>

        
        <?php
        if (Yii::app()->user->hasFlash('verificationSection_' . $verificationSection->id))
            echo '<div class="flash-notice">' . Yii::app()->user->getFlash('verificationSection_' . $verificationSection->id) . "</div>\n";
        ?>
        <div class="form wide">
            <?php echo CHtml::beginForm(array('/verificationSection/updateSection/', 'id' => $verificationSection->id)); ?>
            <?php echo CHtml::errorSummary($verificationSection); ?>
            <?php echo $this->renderPartial('/' . $verificationSection->verificationSectionType->controllerName . '/_verificationDetails', array('verificationSection' => $verificationSection));
            ?>
            <table style="width:10em">
                <tr >
                    <td >
                        Comentarios
                        <br/>
                        <?php echo CHtml::textArea('verificationSection[' . $verificationSection->id . '][comments]', $verificationSection->comments, array('rows' => 2, 'cols' => 100)); ?>
                    </td>
                    <td>
                        <?php
                        echo CHtml::dropDownList('verificationSection[' . $verificationSection->id . '][resultId]'
                                , $verificationSection->resultId
                                , CHtml::listData(
                                        Result::model()->findAll(array('order' => 'name')), 'id', 'name')
                                , array('prompt' => '..'));
                        ?>

                    </td>
                    <td>
                        <?php echo CHtml::submitButton('Actualizar', array('onClick' => 'this.disabled=true;this.form.submit();')); ?> 

                    </td>
                </tr>
            </table>
            <div class="row">
            </div>
            <?php echo CHtml::endForm(); ?>

        </div><!-- form -->
    </fieldset>
</div>
