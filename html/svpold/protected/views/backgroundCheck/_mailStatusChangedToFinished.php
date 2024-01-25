<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <p>Se ha finalizado el estudio Ref: 
      [<b><?php echo CHtml::encode($backgroundCheck->code) ?></b>] . 
      Por favor revise la aplicación para ver la información complementaria.</p>

    <br/>

    <p>Detalle del estudio:</p>

    <p><?php echo CHtml::activeLabel($backgroundCheck, 'customerId'); ?>:
      <?php echo $backgroundCheck->customer->name; ?><br/>
      <?php echo CHtml::activeLabel($backgroundCheck, 'customerUserId'); ?>:
      <?php echo $backgroundCheck->customerUser->name; ?><br/>
      <?php echo CHtml::activeLabel($backgroundCheck, 'customerProductId'); ?>:
      <?php echo CHtml::encode($backgroundCheck->customerProduct->name); ?><br/>
      <?php echo CHtml::activeLabel($backgroundCheck, 'code'); ?>:
      <?php echo Chtml::encode($backgroundCheck->code); ?><br/>
      <?php echo CHtml::activeLabel($backgroundCheck, 'firstName'); ?>:
      <?php echo Chtml::encode($backgroundCheck->firstName); ?><br/>
      <?php echo CHtml::activeLabel($backgroundCheck, 'lastName'); ?>:
      <?php echo Chtml::encode($backgroundCheck->lastName); ?><br/>
      <?php echo CHtml::activeLabelEx($backgroundCheck, 'idNumber'); ?>:
      <?php echo CHtml::encode($backgroundCheck->idNumber); ?><br />
    </p>
    <br/>
    <p>Atentamente,</p>

    <br/>
    <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>


  </body>
</html>