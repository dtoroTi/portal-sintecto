<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <?php 
      $src="https://verificacion.co/forms/f/$backgroundCheck->ooidFD";
      $timeZone = new DateTimeZone('America/Bogota');
      $now = new DateTime($backgroundCheck->validuntilFD, $timeZone);
      $finishdate= $now->format('d/m/Y H:i:s');

      $personalFields='';
      if($backgroundCheck->customer->customerGroupId='979'){
          if(!is_null($backgroundCheck->customerField1)){
            $personalFields='-'.$backgroundCheck->customerField1;
          }else{
            $personalFields='';
          }
      }
    ?>
    <p>Cordial Saludo,</p>
    
    <p>Sr@. <?php echo CHtml::encode($backgroundCheck->firstName.' '.$backgroundCheck->lastName); ?> </p>


    <p>Nos comunicamos de <b>Sintecto Ltda</b>, seremos la compañía encargada de realizar su proceso de integridad ante la Empresa <b><?php echo $backgroundCheck->customer->name; ?><?php echo $personalFields; ?></b>, para su vinculación laboral, por lo cual solicito de su amable colaboración con la siguiente documentación para adelantar su proceso: </p>

    <p><?php echo $backgroundCheck->customerProduct->attachmentFile->requirements; ?></p>

    <b>Por favor ingresar al siguiente link, diligenciar la información solicitada y cargar los documentos en su totalidad,  en caso de que no cuente con uno de los documentos, por favor remitirlo al correo electrónico <u>documentos@sintecto.com</u>.</b>
    <br><br>
    <a HREF=<?php echo $src?>><?php echo $src?></a><br>
    <b style="color:#FF0000";>Tener presente que este link vence el <?php echo $finishdate; ?> (Hora militar) y una vez este vencido no podrá ingresar a diligenciar la información solicitada.</b></p>

    <p><b>Recuerde que cuenta con un lapso de 6 horas o un tiempo inferior con el ánimo de dar celeridad a su proceso.</b></p>

    <p>Por último, en caso de requerir o aclarar información, le estará llamando un Analista de Operaciones para confirmar o solicitar datos adicionales.</p> 

    <p>Quedo atenta a su pronta respuesta.</p>

    <br/>

    <p>Cordialmente,</p>

    <br/>
    <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>


  </body>
</html>