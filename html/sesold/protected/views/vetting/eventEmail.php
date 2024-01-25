<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <h1>Novedad en el estudio de Hoja de Vida</h1>
        <?php $customer = $model->user->customer; ?>
        <h1><?php echo CHtml::encode($customer->name) ?></h1>
        <p>
            <b>Solicitado por:</b><br/>
            <?php echo CHtml::encode(Yii::app()->user->name); ?><br/>
            <?php echo CHtml::encode(Yii::app()->user->arUser->name); ?>
        </p>
        <p>
            <b><?php echo CHtml::activelabelEx($model, 'customerProductId'); ?></b><br/>
            <?php echo CHtml::encode(CustomerProduct::model()->findByPk($model->customerProductId)->name); ?>
        </p>

        <?php if (trim($customer->field1 != "")) : ?>
            <p>
                <b><?php echo CHtml::activelabelEx($model, $customer->field1); ?></b><br/>
                <?php echo CHtml::encode($model->customerField1); ?>
            </p>
        <?php endif; ?>

        <?php if (trim($customer->field2 != "")) : ?>
            <p>
                <b><?php echo CHtml::activelabelEx($model, $customer->field2); ?></b><br/>
                <?php echo CHtml::encode($model->customerField2); ?>
            </p>
        <?php endif; ?>

        <?php if (trim($customer->field3 != "")) : ?>

            <p>
                <b><?php echo CHtml::activelabelEx($model, $customer->field3); ?></b><br/>
                <?php echo CHtml::encode($model->customerField3); ?>
            </p>
        <?php endif; ?>

        <p>
            <b><?php echo CHtml::activelabelEx($model, 'firstName'); ?></b><br/>
            <?php echo CHtml::encode($model->firstName); ?>
        </p>
        <p>
            <b><?php echo CHtml::activelabelEx($model, 'lastName'); ?></b><br/>
            <?php echo CHtml::encode($model->lastName); ?>
        </p>

        <p>
            <b><?php echo CHtml::activelabelEx($model, 'idNumber'); ?></b><br/>
            <?php echo CHtml::encode($model->idNumber); ?>
        </p>

        <p>
            <b><?php echo CHtml::activelabelEx($model, 'city'); ?></b><br/>
            <?php echo CHtml::encode($model->city); ?>
        </p>

        <p>
            <b><?php echo CHtml::activelabelEx($model, 'applyToPosition'); ?></b><br/>
            <?php echo CHtml::encode($model->applyToPosition); ?>
        </p>
        <p>
            <b><?php echo CHtml::activelabelEx($model, 'comments'); ?></b><br/>
            <?php echo CHtml::encode($model->comments); ?>
        </p>
        <p>
            <b>Usuario</b><br/>
            <?php echo Yii::app()->user->name; ?>
        </p>
        <p>
        <hr/>
        <h2>Novedades</h2>
        <table style="border-top:1px;" >
            <tr>
                <th width="70px">
                    Registro
                </th>
                <th  width="70px">
                    Vigencia
                </th>
                <th width="20px">
                    Retraso (en Días)
                </th>
                <th  width="300px">
                    Detalle
                </th>
            </tr>
            <?php foreach ($model->events as $event) : ?>
                <tr>
                    <td>
                        <?php echo CHtml::encode($event->registeredOn); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($event->expireOn); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($event->delayDays); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($event->detail); ?>
                    </td>

                </tr>
            <?php endforeach; ?>

        </p>
</body>
</html>