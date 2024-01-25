<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <p>Cordial Saludo,</p>
    
        <p>Sr@. <?php echo CHtml::encode($backgroundCheck->firstName.' '.$backgroundCheck->lastName); ?></p>

        <p>Le notificamos que el link enviado en el correo de solicitud de documentos para el ingreso de la información de su estudio de seguridad, fue deshabilitado teniendo en cuenta que no se completó en su totalidad, por tal motivo ya no puede hacer uso del mismo.</p>

        <p><b>¡¡Importante!!</b><br/>
            -Si diligenció información esta se tendrá en cuenta para el desarrollo de su estudio de seguridad.<br/>
            -Si por el contrario no diligenció datos y desea enviar documentos los puede hacer llegar a través del correo <u>documentos@sintecto.com</u>.<br/>
            <!---Si requiere información adicional comuniquese al número 3015962247.<br/>-->
        </p>
        
        <p><b>Tenga en cuenta que esto no afectará la entrega final del estudio de seguridad.</b></p><br/>

        <p>Gracias!</p><br/>

        <p>Cordialmente,</p>
        <br/>
        <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>
    </body>
</html>