<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <?php
        $canditato=$backgroundCheck->firstName.' '.$backgroundCheck->lastName;
        $idCandidato=$backgroundCheck->idNumber;

        $company=$detailJob->company;

        $assingUser = AssignedUser::model()->findByAttributes(['verificationSectionId'=>$detailJob->verificationSectionId]);
        if($assingUser){
            $user = User::model()->findByPK($assingUser->userId);
            $emailUser=CHtml::encode($user->username);    
        }else{
            $emailUser=CHtml::encode(Yii::app()->user->arUser->username);
        }
    ?>
    <body>
        <p>Cordial Saludo,</p>

        <p>Señores, <?php echo CHtml::encode($company); ?></p>

        <p>Somos Sintecto Ltda. una entidad que realiza estudios de seguridad para diferentes empresas del país a nivel nacional. Amablemente, solicito la verificación de la información aportada por el/la Sr.(a) <?php echo CHtml::encode($canditato); ?>, identificado(a) con número de cédula <?php echo CHtml::encode($idCandidato); ?>, quien indica haber laborado con ustedes, por medio de la presente me permito solicitar la siguiente información:</p>

        <p>Fecha de ingreso: <br/>
        Fecha de retiro: <br/>
        Cargo desempeñado: <br/>
        Tipo de contrato: <br/>
        Motivo de retiro: <br/>
        Nombre y cargo de la persona que brinda la información:</p><br/>

        <b style="color:#14457f";>Solicito muy amablemente realizar el envío de la información al siguiente correo: </b><u style="color:#14457f";><?php echo CHtml::encode($emailUser); ?></u></p><br/>
        
        <p>Agradezco su pronta respuesta ya que de ello depende la vinculación de la persona en mención.</p><br/>

        <p>Gracias.</p>
        <br/>
        <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>
    </body>
</html>

