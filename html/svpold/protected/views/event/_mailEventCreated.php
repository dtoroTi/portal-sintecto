<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <p>El Estudio con referencia  
      [<b><?php echo CHtml::encode($event->backgroundCheck->code) ?></b>] tiene una novedad.</p>
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
      <b>Novedad creada en <?php echo CHtml::encode($event->created);?> :</b>
    </p>
    <p>
      <?php echo CHtml::encode($event->detail); ?><br/>
      <?php echo CHtml::encode($event->eventType->name); ?>
    </p>
    <br/>
    <br/>
    
    <p>Atentamente,</p>

    <br/>
    <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>


  </body>
</html>