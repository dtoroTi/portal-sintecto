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
            <?php echo CHtml::encode(Yii::app()->user->arUser->firstName); ?>
            <?php echo CHtml::encode(Yii::app()->user->arUser->lastName); ?>
        </p>
        <p>
            <b><?php echo CHtml::activelabelEx($model, 'customerProductId'); ?></b><br/>
            <?php echo CHtml::encode(CustomerProduct::model()->findByPk($model->customerProductId)->name); ?>
        </p>

        <?php for ($i = 1; $i <= Customer::MAX_FIELDS; $i++): ?>
            <?php $fieldStr="field{$i}"; ?>
            <?php $customerFieldStr="customerField{$i}"; ?>
            <?php if (trim($customer->$fieldStr != "")) : ?>
                <p>
                    <b><?php echo CHtml::activelabelEx($model, $customer->$fieldStr); ?></b><br/>
                    <?php echo CHtml::encode($model->$customerFieldStr); ?>
                </p>
            <?php endif; ?>
        <?php endfor; ?>

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
                    Informada al cliente
                </th>
                <th  width="300px">
                    Detalle
                </th>
            </tr>
            <?php foreach ($model->events as $event) : ?>
                <tr>
                    <td>
                        <?php echo CHtml::encode($event->reportedOn); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($event->expireOn); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($event->informedToCustomerOn); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($event->detail); ?>
                    </td>

                </tr>
            <?php endforeach; ?>

        </p>
</body>
</html>