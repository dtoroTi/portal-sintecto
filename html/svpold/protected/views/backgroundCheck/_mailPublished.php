<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <p>Estimado(a) <?php echo CHtml::encode($backgroundCheck->customerUser->name); ?> </p>

        <p>El estudio solicitado por usted con referencia  
            [<b><?php echo CHtml::encode($backgroundCheck->code) ?></b>] ya esta finalizado.
        </p>
        <p> Ya puede acceder al portal y descargar el informe.</p>
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
                <?php echo CHtml::activeLabelEx($backgroundCheck, 'idNumber'); ?>:
                <?php echo CHtml::encode($backgroundCheck->idNumber); ?><br />
            <?php else: ?>
                <?php echo CHtml::activeLabel($backgroundCheck, 'Razón Social'); ?>:
                <?php echo Chtml::encode($backgroundCheck->lastName); ?><br/>
                <?php echo CHtml::activeLabelEx($backgroundCheck, 'idNumber'); ?>:
                <?php echo CHtml::encode($backgroundCheck->idNumber); ?><br />
            <?php endif; ?>    
        </p>
        <br/>
        <p>Atentamente,</p>

        <br/>
        <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>


    </body>
</html>