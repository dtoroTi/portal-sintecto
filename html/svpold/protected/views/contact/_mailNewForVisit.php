<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
  
    <p>Cordial Saludo,</p>
    
    <p>Sr@. Visitador/Visitadora.</p>


    <p> Nos comunicamos de <b>Sintecto Ltda</b>, somos la compañía encargada de asignarle las visitas domiciliarias, a continuación, le relacionaremos los formatos requeridos para la visita del sr@ <?php echo CHtml::encode($backgroundCheck->firstName.' '.$backgroundCheck->lastName); ?> del cliente <b><?php echo $backgroundCheck->customer->name; ?></b>.  

    
    <p><b>Recuerde que, una vez realizada la visita, usted cuenta con <b>24 horas</b> para cargar el informe a la plataforma, agradecemos su colaboración.</b></p>

    <p>Por último, en caso de requerir o aclarar información, por favor comuníquese a la línea de WhatsApp +57 3165262993 o escribanos al correo de visitasoperaciones@securityandvision.com.</p>

    <p>Quedo atenta a su pronta respuesta.</p>

    <br/>

    <p>Cordialmente,</p>

    <br/>
    <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>


  </body>
</html>