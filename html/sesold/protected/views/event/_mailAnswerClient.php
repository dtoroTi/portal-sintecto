<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <p>Estimado(a) <?php echo CHtml::encode($event->backgroundCheck->customerUser->name); ?> </p>

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
    </p>
    <br/>
    <p>NOVEDAD</p>
    <p>
      <?php echo CHtml::activeLabel($event, 'created'); ?>:
      <?php echo CHtml::encode($event->created); ?><br/>
      <?php echo CHtml::activeLabel($event, 'informedToCustomerOn'); ?>:
      <?php echo CHtml::encode($event->informedToCustomerOn); ?><br/>
      <?php echo CHtml::activeLabel($event, 'newLimitDate'); ?>:
      <?php echo CHtml::encode($event->newLimitDate); ?><br/>
      <?php echo CHtml::activeLabel($event, 'customerAnsweredOn'); ?>:
      <?php echo CHtml::encode($event->customerAnsweredOn); ?><br/>
      <?php echo CHtml::activeLabel($event, 'customerIp'); ?>:
      <?php echo CHtml::encode($event->customerIp); ?><br/>
    </p>

    <br/>
    
    <p>
      <?php echo CHtml::encode($event->detail); ?>
    </p>
    
    <p>COMENTARIO DEL CLIENTE</p>

    <p>
      <?php echo CHtml::encode($event->customerComment); ?>
    </p>


  </body>
</html>