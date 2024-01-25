<html>
    <?php /* @var $backgroundCheck BackgroundCheck */ ?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <p>Estimado(a) <?php echo CHtml::encode($backgroundCheck->customerUser->name); ?> </p>

        <p>El estudio ha sido aprobado con un valor MINIMO
            [<b><?php echo CHtml::encode($backgroundCheck->code) ?></b>].
        </p>
        <br/>

        <p>Detalle del estudio:</p>

        <p><?php echo CHtml::activeLabel($backgroundCheck, 'customerId'); ?>:
            <?php echo $backgroundCheck->customer->name; ?><br/>
            <?php echo CHtml::activeLabel($backgroundCheck, 'customerUserId'); ?>:
            <?php echo $backgroundCheck->customerUser->name; ?><br/>
            <?php echo CHtml::activeLabel($backgroundCheck, 'customerProductId'); ?>:
            <?php echo CHtml::encode($backgroundCheck->customerProduct->name); ?><br/>
            <?php for ($i = 1; $i <= Customer::MAX_FIELDS; $i++): ?>
                <?php $field = 'field' . $i; ?>
                <?php if (isset($backgroundCheck->customer) && ($backgroundCheck->customer->$field != "" )): ?>
                    <?php echo CHtml::encode(($backgroundCheck->customer ? $backgroundCheck->customer->$field : 'customerField' . $i), array('id' => 'field' . $i)); ?>:
                    <?php $customerField = 'customerField' . $i; ?>
                    <?php echo CHtml::encode($backgroundCheck->$customerField); ?><br/>
                <?php endif; ?>
            <?php endfor; ?>

            <?php echo CHtml::activeLabel($backgroundCheck, 'code'); ?>:
            <?php echo Chtml::encode($backgroundCheck->code); ?><br/>
            <?php if (!$backgroundCheck->customerProduct->isCompanySurvey): ?>
                <?php echo CHtml::activeLabel($backgroundCheck, 'firstName'); ?>:
                <?php echo Chtml::encode($backgroundCheck->firstName); ?><br/>
                <?php echo CHtml::activeLabel($backgroundCheck, 'lastName'); ?>:
                <?php echo Chtml::encode($backgroundCheck->lastName); ?><br/>
            <?php else: ?>
                <?php echo CHtml::activeLabel($backgroundCheck, 'Razón Social'); ?>:
                <?php echo Chtml::encode($backgroundCheck->lastName); ?><br/>
            <?php endif; ?>    
            <?php if ($backgroundCheck->approved): ?>
                <?php echo CHtml::activeLabel($backgroundCheck, 'approved'); ?>:
                <?php echo $backgroundCheck->approved->name; ?><br/>
            <?php endif; ?>
        </p>
        <hr/>
        <p>
            <?php echo CHtml::label('Precio del Estudio:','customer_product_price'); ?>:
            <?php echo HtmlHelper::amount($backgroundCheck->customerProduct->price); ?><br/>
            <?php echo CHtml::label('Valor cobrado al cliente:','price'); ?>:
            <?php echo HtmlHelper::amount($backgroundCheck->price); ?><br/>
            <?php echo CHtml::label('DIFERENCIA:','diff'); ?>:
            <?php echo HtmlHelper::amount($backgroundCheck->price-$backgroundCheck->customerProduct->price); ?><br/>
        </p>        
        <br/>
        <p>Atentamente,</p>
        
        <br/>
        <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>


    </body>
</html>