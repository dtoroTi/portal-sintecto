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

    <p>
      La fecha estimada para resolver ésta novedad es : <?php echo CHtml::encode($event->newLimitDate); ?>.
    </p>

    <p>
      Si usted tiene algún comentario respecto a esta novedad por favor escribalo en el siguiente enlce:<br/>
          <?php echo CHtml::link($event->answerUrl,$event->answerUrl); ?>
    </p>
    <p>
      El anterior enlace será válido sólo por las siguientes 48 horas hábiles.
    </p>
    <br/>
    <br/>
    
    <p>Atentamente,</p>

    <br/>
    <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>


  </body>
</html>