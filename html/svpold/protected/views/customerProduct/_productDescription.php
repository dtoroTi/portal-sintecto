<div class="ProcessTab">
    <fieldset>
        <legend><a name="productDescription">Instrucciones para diligenciar el Estudio.</a></legend>

        <div><?php echo $customerProduct->description; ?></div>
    </div>
    </fieldset>

    <?php if(Yii::app()->user->isDescription): ?>
    <div class="ProcessTab">
    <fieldset>
        <legend><a name="productDescriptionNew">Instrucciones Nuevas para diligenciar el Estudio.</a></legend>

        <div><?php echo $customerProduct->description2; ?></div>
    </div>
    </fieldset>
    <?php endif; ?>
<!-- form -->