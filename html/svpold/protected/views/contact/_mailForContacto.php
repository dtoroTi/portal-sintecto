<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <p>Estimado(a) <?php echo CHtml::encode($contact->backgroundCheck->customerUser->name); ?> </p>

    <p>El Estudio con referencia  
      [<b><?php echo CHtml::encode($contact->backgroundCheck->code) ?></b>] tiene un documento adjunto para su respectivo diligenciamiento.</p>
    <p><b>Detalle:</b></p>
    <p><?php echo CHtml::activeLabel($contact->backgroundCheck, 'customerId'); ?>:
      <?php echo $contact->backgroundCheck->customer->name; ?><br/>
      <?php echo CHtml::activeLabel($contact->backgroundCheck, 'code'); ?>:
      <?php echo Chtml::encode($contact->backgroundCheck->code); ?><br/>
      <?php echo CHtml::activeLabel($contact->backgroundCheck, 'firstName'); ?>:
      <?php echo Chtml::encode($contact->backgroundCheck->firstName); ?><br/>
      <?php echo CHtml::activeLabel($contact->backgroundCheck, 'lastName'); ?>:
      <?php echo CHtml::encode($contact->backgroundCheck->lastName); ?><br/>
      <?php echo CHtml::activeLabelEx($contact->backgroundCheck, 'idNumber'); ?>:
      <?php echo CHtml::encode($contact->backgroundCheck->idNumber); ?>

    </p>

    <br/>
   

    <p>Atentamente,</p>

    <br/>
    <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>


  </body>
</html>