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
    ?>
    <p>Buen días,</p>
    
    <p>Apreciado <?php echo CHtml::encode($backgroundCheck->lastName); ?> </p>


    <p><b>Sintecto Ltda</b><br>830076042</p>

    <p>Les escribo de parte de SINTECTO LTDA., empresa asesora en temas de seguridad de <b><?php echo $backgroundCheck->customer->name; ?></b>.</p>

    <p>Según una solicitud prioritaria para adelantar la Evaluación de Proveedor por parte de esta última empresa, <b>agradezco confirmar 3 fechas disponibles en que podrá ser atendida la visita</b> (si por algun motivo especial, la prefiere virtual, puede referirlo en el correo tambien, indicando el motivo)</p>

    <p>Durante un periodo de máximo una hora, se hablarán temas tales como la historia de la compañía, quiénes son sus clientes y proveedores, sobre las certificaciones ISO y Basc (si aplica), número de empleados con los que cuenta la compañía y procesos de vinculación, entre otros.</p>

    <p><?php echo $backgroundCheck->customerProduct->attachmentFile->requirements; ?></p>

    <p><b>Por favor ingresar al siguiente link y diligenciar la información solicitada en su totalidad:</b></p>
    <p><a HREF=<?php echo $src?>><?php echo $src?></a><br>
    <b style="color:#FF0000";>Tener presente que este link vence el <?php echo $finishdate; ?> (Hora militar) y una vez este vencido no podrá ingresar a diligenciar la información solicitada.</b></p>

    <p>Es importante que durante el procedimiento se cuente con la presencia del Representante Legal, si en dado caso no llegase a estar, de manera respetuosa solicitamos que ustedes generen un documento en el que indiquen cual será la persona autorizada para recibir la visita, documento que debe estar firmado por el Representante Legal de la empresa. Adicional a esto adjuntamos autorización expedida por parte de nosotros, (que debe ir firmada por el mismo). </p>

    <br/>

    <p>Atenta a sus comentarios.</p>

    <br/>

    <p>Cordialmente,</p>

    <br/>
    <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>


  </body>
</html>