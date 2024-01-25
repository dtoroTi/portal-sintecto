<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <h1>Petición de estudio de Hoja de Vida (SVision)</h1>
        <h1>Security & Vision</h1>
        <h2>Ref:  <?php echo CHtml::encode($backgroundCheck->code) ?></h2>
        <div class="form wide">
            <fieldset>
                <legend>Cliente y tipo de Reporte</legend>  

                <div class="row">
                    <?php echo CHtml::activeLabelEx($backgroundCheck, 'customerId'); ?>:
                    <?php echo $backgroundCheck->customer->name; ?>
                </div>

                <div class="row">
                    <?php echo CHtml::activeLabelEx($backgroundCheck, 'customerUserId'); ?>:
                    <?php echo $backgroundCheck->customerUser->name; ?>[<?php echo $backgroundCheck->customerUser->username; ?>]
                </div>

                <div class="row">
                    <?php echo CHtml::activeLabelEx($backgroundCheck, 'customerProductId'); ?>:
                    <?php echo CHtml::encode($backgroundCheck->customerProduct->name); ?>
                </div>

                <?php for ($i = 1; $i <= Customer::MAX_FIELDS; $i++): ?>
                    <div class="row">
                        <?php $field = 'field' . $i; ?>
                        <?php $customerField = 'customerField' . $i; ?>
                        <?php if ($backgroundCheck->customer->$field != ""): ?>
                            <?php echo CHtml::activeLabelEx($backgroundCheck, $backgroundCheck->customer->$field, array('id' => 'field' . $i)); ?>:
                            <?php echo CHtml::encode($backgroundCheck->$customerField); ?>
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>

            </fieldset>

            <fieldset >
                <legend>Detalle</legend>  
                <div class="row">
                    <?php echo CHtml::activeLabelEx($backgroundCheck, 'code'); ?>:
                    <?php echo Chtml::encode($backgroundCheck->code); ?>
                </div>
                <?php if (!$backgroundCheck->customerProduct->isCompanySurvey): ?>
                    <div class="row">
                        <?php echo CHtml::activeLabelEx($backgroundCheck, 'firstName'); ?>:
                        <?php echo Chtml::encode($backgroundCheck->firstName); ?>
                    </div>
                    <div class="row">
                        <?php echo CHtml::activeLabelEx($backgroundCheck, 'lastName'); ?>:
                        <?php echo Chtml::encode($backgroundCheck->lastName); ?>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <?php echo CHtml::activeLabelEx($backgroundCheck, 'Razón Social'); ?>:
                        <?php echo Chtml::encode($backgroundCheck->lastName); ?>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <?php echo CHtml::activeLabelEx($backgroundCheck, 'idNumber'); ?>:
                    <?php echo CHtml::encode($backgroundCheck->idNumber); ?>
                </div>

                <div class="row">
                    <?php echo CHtml::activeLabelEx($backgroundCheck, 'tels'); ?>:
                    <?php echo CHtml::encode($backgroundCheck->tels); ?>
                </div>
                <?php if (!$backgroundCheck->customerProduct->isCompanySurvey): ?>
                    <div class="row">
                        <?php echo CHtml::activeLabelEx($backgroundCheck, 'applyToPosition'); ?>:
                        <?php echo CHtml::encode($backgroundCheck->tels); ?>
                    </div>
                <?php endif; ?>

            </fieldset>
            <fieldset >
                <div class="row">
                    <?php echo CHtml::activeLabelEx($backgroundCheck, 'customerComments'); ?>:
                    <?php echo CHtml::encode($backgroundCheck->customerComments); ?>
                </div>

            </fieldset>

        </div>
    </body>
</html>