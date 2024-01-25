<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
    $this->redirect('/noallowed.html');
}
?>

<tr>
    <td>
        <?php
        echo CHtml::dropDownList(//
                'invoiceDetails' .
                '[' . ($model->isNewRecord ? 'new' : $model->id) . ']' .
                '[productId]'
                , //
                $model->productId, //
                CHtml::listData(
                        Product::model()->findAll(), //
                        'id', //
                        'name')
        );
        ?>
    </td>
    <td>
        <?php
        echo CHtml::textField('invoiceDetails' .
                '[' . ($model->isNewRecord ? 'new' : $model->id) . ']' .
                '[description]', $model->description);
        ?>
    </td>

    <td>
        <?php
        echo CHtml::textField('invoiceDetails' .
                '[' . ($model->isNewRecord ? 'new' : $model->id) . ']' .
                '[qty]', $model->qty);
        ?>
    </td>
    <td>
        <?php
        echo CHtml::textField('invoiceDetails' .
                '[' . ($model->isNewRecord ? 'new' : $model->id) . ']' .
                '[unitValue]', $model->unitValue);
        ?>
    </td>
    <td>
        <?php
        echo CHtml::textField('invoiceDetails' .
                '[' . ($model->isNewRecord ? 'new' : $model->id) . ']' .
                '[unitType]', $model->unitType);
        ?>
    </td>
    <td style="text-align:right">
        $<?php echo HtmlHelper::amount($model->total, true) ?>
    </td>

    <td style="text-align:center">
        <?php if ($model->isNewRecord): ?>
            <?php echo CHtml::submitButton('Actualizar'); ?>
        <?php else: ?>
            <div class="ServiceButton">
                <a href="<?php echo $this->createUrl('/invoice/deleteInvoiceDetail/', array('invoiceDetailId' => $model->id)) ?>" 
                   class="ui-button ui-button-icon-only ui-widget ui-state-default ui-corner-all ServiceButton" 
                   title="Borrar"
                   onClick="return (confirm('Realmente desea borrar el detalle de la factura?'));"> 
                    <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span> 
                    <span class="ui-button-text">Borrar</span> 
                </a> 
            </div>
        <?php endif; ?>


    </td>


</tr>
