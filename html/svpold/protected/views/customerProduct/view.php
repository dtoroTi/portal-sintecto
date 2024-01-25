<?php
if(!Yii::app()->user->isValidUser && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Customer Products' => array('admin'),
    CHtml::encode($model->name),
);

$this->menu = array(
    array('label' => 'Create CustomerProduct', 'url' => array('create')),
    array('label' => 'Update CustomerProduct', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete CustomerProduct', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage CustomerProduct', 'url' => array('admin')),
);
?>

<h1>View CustomerProduct #<?php echo CHtml::encode($model->id); ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'customer.name',
        'typeProduct.value',
        'name',
        'comments',
        'maxDays',
        'maxInternalDays',
        'contract_Limit',
        'created',
        'modified',
        'isCompanySurvey',
        'isActive',
        'notifyByMail',
        'availableInOffline',
        array(
            'name'=> 'cost',
            'type'=>'raw',
            'value'=>HtmlHelper::amount($model->cost,true,0,'$'),
        ),
        array(
            'name'=> 'price',
            'type'=>'raw',
            'value'=>HtmlHelper::amount($model->price,true,0,'$'),
        ),
    ),
));
?>

<br/>
<br/>
<hr/>
<h2>Verificaciones del Producto</h2>
<div class="form">
    <?php echo CHtml::beginForm(); ?>

    <div class="SvpTable" style="width:50em">
        <table>
            <tr>
                <th width="5em">&nbsp;</th>
                <th width="250em">Nombre</th>
                <th width="50em">Costo</th>
                <th width="50em">Precio</th>
                <th width="50em">Peso</th>
                <th width="50em">Orden</th>
                <th width="50em">Linea Neg.Seccion</th>
                <th width="50em">Offline</th>
                <th width="50em">Comentarios</th>
            </tr>
            <?php foreach (VerificationSectionType::findAllAvailable($model->isPdfReportType) as $verification): ?>
                <?php
                $verificationInProduct = VerificationInProduct::model()->
                        findByAttributes(
                        array('verificationSectionTypeId' => $verification->id,
                            'customerProductId' => $model->id)
                );
                ?>

                <tr>
                    <td> <?php echo CHtml::checkBox("verification[{$verification->id}][include]", ($verificationInProduct ? true : false)); ?></td>
                    <td> <?php echo CHtml::encode($verification->name); ?></td>
                    <td><?php
                        echo CHtml::textField("verification[{$verification->id}][cost]", ($verificationInProduct ? $verificationInProduct->cost : $verification->cost), array('size' => '10px')
                        );
                        ?></td>
                    <td><?php
                        echo CHtml::textField("verification[{$verification->id}][price]", ($verificationInProduct ? $verificationInProduct->price : $verification->price), array('size' => '10px')
                        );
                        ?></td>
                    <td><?php
                        echo CHtml::textField("verification[{$verification->id}][weight]", ($verificationInProduct ? $verificationInProduct->weight : ''), array('size' => '3px')
                        );
                        ?></td>
                    <td><?php
                        echo CHtml::textField("verification[{$verification->id}][showOrder]", ($verificationInProduct ? $verificationInProduct->showOrder : ''), array('size' => '3px')
                        );
                        ?>
                    </td>
                    <td> <?php echo CHtml::encode($verification->bussinessLineSeccion); ?></td>
                    <td>
                        <?php if ($verificationInProduct && $verificationInProduct->verificationSectionType->availableInOffline): ?>
                            OK
                        <?php else: ?>
                        <?php endif; ?>
                    </td>
                    <td><?php
                        echo CHtml::textField("verification[{$verification->id}][comments]", ($verificationInProduct ? $verificationInProduct->comments : ''), array('size' => '50px')
                        );
                        ?></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <th>&nbsp;</th>
                <th>Total</th>
                <th><?php echo CHtml::encode($model->totalWeight); ?></th>
                <th><?php echo CHtml::submitButton('Actualizar'); ?></th>
            </tr>
        </table>
    </div>
    <?php echo CHtml::endForm(); ?>
</div>

<?php echo CHtml::button('Retornar', array('onclick' => 'js:document.location.href="/customerProduct/admin"'));
?>