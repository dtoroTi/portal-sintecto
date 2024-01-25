<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <p>Estimado(a) Funcionario <?php echo CHtml::encode($userOP->name); ?> </p>

    <p>El Estudio con referencia  
      [<b><?php echo CHtml::encode($event->backgroundCheck->code) ?></b>] Respuesta SAC a OP.</p>
    <p><b>Detalle del estudio:</b></p>
    <p><?php echo CHtml::activeLabel($event->backgroundCheck, 'customerId'); ?>:
      <?php echo $event->backgroundCheck->customer->name; ?><br/>
      <?php echo CHtml::activeLabel($event->backgroundCheck, 'customerUserId'); ?>:
      <?php echo $event->backgroundCheck->customerUser->name; ?><br/>
      <?php echo CHtml::activeLabel($event->backgroundCheck, 'customerProductId'); ?>:
      <?php echo CHtml::encode($event->backgroundCheck->customerProduct->name); ?><br/>
      <?php echo CHtml::activeLabel($event->backgroundCheck, 'code'); ?>:
      <?php echo Chtml::encode($event->backgroundCheck->code); ?><br/>
      <?php echo CHtml::activeLabel($event->backgroundCheck, 'firstName'); ?>:
      <?php echo Chtml::encode($event->backgroundCheck->firstName); ?><br/>
      <?php echo CHtml::activeLabel($event->backgroundCheck, 'lastName'); ?>:
      <?php echo CHtml::encode($event->backgroundCheck->lastName); ?><br/>
      <?php echo CHtml::activeLabelEx($event->backgroundCheck, 'idNumber'); ?>:
      <?php echo CHtml::encode($event->backgroundCheck->idNumber); ?>

    </p>

    <br/>
    <p>
      <b>Novedad creada en <?php echo CHtml::encode($event->created);?></b>
    </p>
    <p>
        <?php echo CHtml::encode($event->eventType->name); ?><br/>
        <b>Detalle: </b><?php echo CHtml::encode($event->detail); ?><br/>
        <b>Respuesta SAC: </b><?php echo CHtml::encode($event->commentSAC); ?><br/>
        <b>Fecha respuesta SAC: </b><?php echo CHtml::encode($event->commentSACDate); ?><br/>
    </p>

    <p>
      La fecha estimada para resolver ésta novedad es : <?php echo CHtml::encode($event->newLimitDate); ?>.
    </p>
    <br/>
    <br/>
    
    <p>Atentamente,</p>

    <br/>
    <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>


  </body>
</html>