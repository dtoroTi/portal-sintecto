<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <?php 
      $src="https://verificacion.co/forms/f/$backgroundCheck->reciptFileooid";
      $timeZone = new DateTimeZone('America/Bogota');
      $now = new DateTime($backgroundCheck->reciptExpiration, $timeZone);
      $finishdate= $now->format('d/m/Y H:i:s');
    ?>
    <p>Estimado(a) Aspirante</p>
    
    <p>Este es un mensaje para <?php echo CHtml::encode($backgroundCheck->firstName.' '.$backgroundCheck->lastName); ?> Doc <?php echo CHtml::encode($backgroundCheck->idNumber); ?></p>

    <p>Reciba un cordial saludo.</p>

    <p>Dando continuidad con el proceso encargado por la <b><?php echo $backgroundCheck->customer->name ?></b> a <b>SOLUCIONES EN INTEGRIDAD Y CUMPLIMIENTO – SINTECTO LTDA</b> sobre el Estudio de Confiabilidad para el proceso de incorporación, agradecemos el envío de su información y documentos personales con la mayor agilidad posible, los cuales corresponden a los relacionados en el correo recibido previamente en la solicitud de pago, si lo hace dentro de las 12 horas hábiles siguientes a la recepción de este comunicado, la validación podrá hacerse con prontitud y la <b><?php echo $backgroundCheck->customer->name ?></b>recibirá de manera oportuna los resultados de su proceso.</p>

    <p><?php echo $backgroundCheck->customerProduct->attachmentFile2->requirements; ?></p>

    <b>Cuando tenga la información lista puede subir documentos en el siguiente ENLACE <a HREF=<?php echo $src?>><?php echo $src?></a> con lo cual se iniciará el Estudio de Confiabilidad. Tenga en cuenta que los documentos deben encontrarse en formato PDF para poder ser subidos. </b></br>
    <b style="color:#FF0000";>Tener presente que este link vence el <?php echo $finishdate; ?> (Hora militar) y una vez este vencido no podrá ingresar a diligenciar la información solicitada.</b></p>

  </body>
</html>