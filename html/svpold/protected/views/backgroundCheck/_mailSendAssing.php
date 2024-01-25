<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <p>Cordial Saludo,</p>
    
    <p>Sr@. <?php echo CHtml::encode($backgroundCheck->firstName.' '.$backgroundCheck->lastName); ?> </p>


    <p>Le informamos que su visita domiciliaria fue asignada al profesional <b><?php echo $user->firstName.' '.$user->lastName; ?></b>, el cual lo estará contactando en las próximas horas, tenga presente que es la única persona autorizada a realizarle la visita, por ende, no permita que otra persona ingrese a su vivienda, Si su visita es virtual ninguna otra persona a la ya mencionada está autorizada a contactarlo.</p>

    <p>Gracias.</p>

    <br/>

    <p>Cordialmente,</p>

    <br/>
    <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>

  </body>
</html>
<!--coment-->