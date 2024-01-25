<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <?php
        $canditato=$backgroundCheck->firstName.' '.$backgroundCheck->lastName;
        $idCandidato=$backgroundCheck->idNumber;

        $institucion=$detailEdu->institution;
        $anio=$detailEdu->graduationYear;
        $titulo=$detailEdu->title;

        $assingUser = AssignedUser::model()->findByAttributes(['verificationSectionId'=>$detailEdu->verificationSectionId]);
        if($assingUser){
            $user = User::model()->findByPK($assingUser->userId);
            $emailUser=CHtml::encode($user->username);    
        }else{
            $emailUser=CHtml::encode(Yii::app()->user->arUser->username);;
        }
    ?>
    <body>
        <p>Buen día,</p>

        <p>Señores, <?php echo CHtml::encode($institucion); ?></p>

        <p>De la manera más atenta me dirijo a ustedes con el fin de solicitar colaboración con la verificación académica del evaluado <?php echo CHtml::encode($canditato); ?>, identificado con cédula de ciudadanía No. <?php echo CHtml::encode($idCandidato); ?>, quien afirma ser egresad@ en el año <?php echo CHtml::encode($anio); ?> como <?php echo CHtml::encode($titulo); ?>.</p>

        <p><b>Nota: Agradezco confirmar número de registro, folio, libro, y acta.</b></p><br/>
        
        <p>Se solicita a ustedes esta información con el fin de concluir un proceso de selección laboral, en el que se encuentra participando la persona anteriormente mencionada.<br/><br/>
        <b style="color:#14457f";>Agradezco su colaboración y el envío de la información al siguiente correo: </b><u style="color:#14457f";><?php echo CHtml::encode($emailUser); ?></u></p><br/>
        
        <!--<p>Agradezco su colaboración.</p><br/>-->

        <p>Cordialmente,</p>
        <br/>
        <p><?php echo CHtml::encode(Yii::app()->user->arUser->name); ?></p>
    </body>
</html>

