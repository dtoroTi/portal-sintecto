<?php

class DynamicForm{

//01-02-2022 Funciones para consumo de servicios de Formulario Dinamico
//Natalia Henao M
    public function getUsrDinamycForm(){

        //$serverName=Yii::app()->params['serverName'];
        $post = [
            "username" => Yii::app()->params['dform']['username'],
            "password" => Yii::app()->params['dform']['password']
        ];

        return $post;
    }

    public function getRegurl(){

        //$serverName=Yii::app()->params['serverName'];
        $dir_ip=Yii::app()->params['dform']['dir_ip'];

        return $dir_ip;
    }

    public function getDynamicForm()
    {
        $filename = "/tmp/dynamicForm.lock";

        if(file_exists($filename)){
            $fp = fopen($filename, "r+"); 
        }else{
            $fp = fopen($filename, "w");
        }
    
        if (flock($fp, LOCK_EX | LOCK_NB)) {  // acquire an exclusive lock

            $FinishReg=$this->finishRegDynamicForm();
            //var_dump($FinishReg);

            if(sizeof($FinishReg['ooids'])==0){
                echo "No se encontraron registros.";
            }else{
                foreach ($FinishReg['ooids'] as $clave => $valor) {
                    $dynamicForm = BackgroundCheck::getBackgroundCheckByooidFD($valor);
                    if (!empty($dynamicForm)) {
                        //$dynamicForm = BackgroundCheck::getBackgroundCheckByooidFD($valor);
                        $dynamicForm->logDynamicFormAut($valor, $val=1);
                        $dynamicForm->answerDynamicForm($valor, $ptr=0, $val=1);
                    }
                    $dynamicForm2 = BackgroundCheck::getBackgroundCheckByooidFD2($valor);
                    if (!empty($dynamicForm2)) {
                        //$dynamicForm = BackgroundCheck::getBackgroundCheckByooidFD($valor);
                        $dynamicForm2->logDynamicFormAut($valor, $val=2);
                        $dynamicForm2->answerDynamicForm($valor, $ptr=0, $val=2);
                    }
                }
            }
            flock($fp, LOCK_UN);//release the lock
        } else {
            echo "YA HAY UN PROCESO EN EJECUCIÓN\n"; 
        }
        fclose($fp);
    }

    //Generar Token para consumo de servicio
    public function getDynamicToken(){
        $post = $this->getUsrDinamycForm();
        $dir_ip=$this->getRegurl();

        $url = "https://$dir_ip/fs/server_form/authenticate";
        $headers=["Content-Type: multipart/form-data"];
            
        $ch = curl_init();	
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);

        $info = curl_getinfo($ch);

        $err = curl_error($ch);

        curl_close($ch);

        $dateresponse =(array) json_decode($response);
        return $dateresponse['ans'];
    }

    //Crear formulario dinamico segun formato JSON
    public function dynamicQuestion($NumId, $questionnaire, $valid_until){
        $token=$this->getDynamicToken();
        $dir_ip=$this->getRegurl();

        $question=$questionnaire;
        
        //$dateAct = new \DateTime(" ");
        //$FechaActual=$dateAct->format('Y-m-d');
        
        $urlcreate="https://$dir_ip/fs/server_form/create_form";
        $headers1=[
            "Authorization: Bearer ".$token,
            "Content-Type: multipart/form-data"
        ];
        $data = [
            'id_number' => $NumId,
            'questionnaire' => $question,
            'valid_until' => $valid_until
        ];
        
        $ch = curl_init();	
        curl_setopt($ch, CURLOPT_URL, $urlcreate);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);

            
        $info = curl_getinfo($ch);

        $err = curl_error($ch);

        //echo "error";
        //var_dump($err);
        curl_close($ch);
        
        $dateresponse =(array) json_decode($response);
        return $dateresponse;
    }

    //retorna informacion almacenada en el formulario dinamico
    public function dynamicAnswer($ooid){
        $token=$this->getDynamicToken();
        $dir_ip=$this->getRegurl();

        $urlcreate="https://$dir_ip/fs/server_form/get_answer/$ooid";
        $headers1=[
            "Authorization: Bearer ".$token,
            "Content-Type: multipart/form-data"
        ];

        $ch = curl_init();	
        curl_setopt($ch, CURLOPT_URL, $urlcreate);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);

        curl_close($ch);

        $dateresponse =(array) json_decode($response, TRUE);
        return $dateresponse;
    }


    //retorna el nombre del documento con su extension y en base 64 el documento adjunto.
    public function dynamicgetFile($ooid, $idDoc){
        $token=$this->getDynamicToken();
        $dir_ip=$this->getRegurl();

        $urlcreate="https://$dir_ip/fs/server_form/get_file/$ooid/$idDoc";

        $headers1=[
            "Authorization: Bearer ".$token,
            "Content-Type: multipart/form-data"
        ];

        $ch = curl_init();	
        curl_setopt($ch, CURLOPT_URL, $urlcreate);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);

        curl_close($ch);

        $dateresponse =(array) json_decode($response, TRUE);
        return $dateresponse;
    }

    public function dynamicgetlog($ooid){
        $token=$this->getDynamicToken();
        $dir_ip=$this->getRegurl();

        $urlcreate="https://$dir_ip/fs/server_form/get_log/$ooid";

        $headers1=[
            "Authorization: Bearer ".$token,
            "Content-Type: multipart/form-data"
        ];

        $ch = curl_init();	
        curl_setopt($ch, CURLOPT_URL, $urlcreate);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);

        curl_close($ch);

        $dateresponse =(array) json_decode($response, TRUE);
        return $dateresponse;
    }

    public function updatevaliduntil($ooid, $datetime){
        $token=$this->getDynamicToken();
        $dir_ip=$this->getRegurl();

        $urlcreate="https://$dir_ip/fs/server_form/update_valid_until/$ooid";

        $headers1=[
            "Authorization: Bearer ".$token,
            "Content-Type: multipart/form-data"
        ];

        $data = [
            'valid_until' => $datetime
        ];

        $ch = curl_init();	
        curl_setopt($ch, CURLOPT_URL, $urlcreate);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);

        curl_close($ch);

        $dateresponse =(array) json_decode($response, TRUE);
        return $dateresponse;
    }

    public function restorePassword($ooid){
        $token=$this->getDynamicToken();
        $dir_ip=$this->getRegurl();
        
        $urlcreate="https://$dir_ip/fs/server_form/reset_password/$ooid";

        $headers1=[
            "Authorization: Bearer ".$token,
            "Content-Type: multipart/form-data"
        ];

        $ch = curl_init();	
        curl_setopt($ch, CURLOPT_URL, $urlcreate);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '');
        $response = curl_exec($ch);

        curl_close($ch);

        $dateresponse =(array) json_decode($response, TRUE);
        return $dateresponse;
    }

    public function deleteDynamicForm($ooid){
        $token=$this->getDynamicToken();
        $dir_ip=$this->getRegurl();

        $urlcreate="https://$dir_ip/fs/server_form/delete_form/$ooid";

        $headers1=[
            "Authorization: Bearer ".$token,
            "Content-Type: multipart/form-data"
        ];

        $ch = curl_init();	
        curl_setopt($ch, CURLOPT_URL, $urlcreate);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $response = curl_exec($ch);

        curl_close($ch);

        $dateresponse =(array) json_decode($response, TRUE);
        return $dateresponse;
    }

    public function finishRegDynamicForm(){
        $token=$this->getDynamicToken();
        $dir_ip=$this->getRegurl();

        $urlcreate="https://$dir_ip/fs/server_form/get_updated_forms";

        $headers1=[
            "Authorization: Bearer ".$token,
            "Content-Type: multipart/form-data"
        ];

        $ch = curl_init();	
        curl_setopt($ch, CURLOPT_URL, $urlcreate);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);

        curl_close($ch);

        $dateresponse =(array) json_decode($response, TRUE);
        return $dateresponse;
    }

    public function partialDynamicAnswer($ooid){
        $token=$this->getDynamicToken();
        $dir_ip=$this->getRegurl();

        $urlcreate="https://$dir_ip/fs/server_form/get_partial_answer/$ooid";

        $headers1=[
            "Authorization: Bearer ".$token,
            "Content-Type: multipart/form-data"
        ];

        $ch = curl_init();	
        curl_setopt($ch, CURLOPT_URL, $urlcreate);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);

        curl_close($ch);

        $dateresponse =(array) json_decode($response, TRUE);
        return $dateresponse;
    }

}