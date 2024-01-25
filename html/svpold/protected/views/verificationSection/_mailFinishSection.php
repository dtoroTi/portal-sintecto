<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <p>Cordial Saludo,</p>
    
        <p>Sr@. <?php echo CHtml::encode($Section->backgroundCheck->firstName.' '.$Section->backgroundCheck->lastName); ?> 🤗</p>

        <p>Nuestro visitador nos notifica que ya finalizó tu visita, en SINTECTO te invitamos en el siguiente link para que nos indiques tu satisfacción con la atención y servicio brindado será de gran ayuda.</p>

        <p><a HREF=<?php echo $link ?>><?php echo $link ?></a></p>

        <p>Muchas gracias!</p><br/>

        <p>Cordialmente,</p>
        <br/>
        <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>
    </body>
</html>