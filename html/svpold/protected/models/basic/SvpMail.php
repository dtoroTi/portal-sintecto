<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SendMail
 *
 * @author hsugieta
 */
class SvpMail {

    CONST COUNTER_FILENAME = 'mailcounter.txt';
    CONST LOG_FILENAME = 'mail_';

    //put your code here

    static public function sendMail($subject, $body, $to, $cc = null, $bcc = null, $files = null, $sender = null) {
        $ans = false;
        Yii::import('application.extensions.mandrill.src.Mandrill');
        try {
            //$api_key = MANDRIL_API;
            $api_key = 'whbrimRiNLWYn6_NmuDvBQ';

            $mandrill = new Mandrill($api_key);

            $to_array = array();


            if (isset($to) && is_array($to)) {
                foreach ($to as $key => $destinatary) {
                    if (trim($destinatary['mail']) != '') {
                        $array_interno_to = array();
                        $array_interno_to['email'] = trim($destinatary['mail']);
                        $array_interno_to['name'] = trim($destinatary['name']);
                        $array_interno_to['type'] = 'to';
                        $to_array[] = $array_interno_to;
                    }
                }
            }

            if (isset($cc) && is_array($cc)) {
                foreach ($cc as $key => $destinatary_cc) {
                    if (trim($destinatary_cc['mail']) != '') {
                        $array_interno_cc = array();
                        $array_interno_cc['email'] = trim($destinatary_cc['mail']);
                        $array_interno_cc['name'] = trim($destinatary_cc['name']);
                        $array_interno_cc['type'] = 'cc';
                        $to_array[] = $array_interno_cc;
                    }
                }
            }

            $attachments = array();

            if(null != $files)
            {
                foreach ($files as $key => $file) {
                    $attachments[] = array(
                        //'type' => 'application/pdf',
                        'name' => $file['baseName'],
                        'content' => $file['base64']
                    );
                }
            }

            if($sender==1){
                //Remitente envío correo de verificación laboral
                $email='Verificacioneslaborales@sintecto.com';
                $emailcc=$email;
                $from_name='Reponder';
            }else if($sender==2){
                //Remitente envío correo de verificación Academico
                $email='Verificacionesacademicas@sintecto.com';
                $emailcc=$email;
                $from_name='Reponder';
            }else{
                //Remitente envío correos generales plataforma
                $email='notificacion@sintecto.com';
                $emailcc='';
                $from_name='No Reponder';
            }
            
            $message = array(
                'html' => $body,
                //'text' => 'Example text content',
                'subject' => $subject,
                'from_email' => $email, //'notificacion@sintecto.com',
                'from_name' => $from_name,
                'to' => $to_array,
                'headers' => array('Reply-To' => $email), //'notificacion@sintecto.com'
                'important' => false,
                'track_opens' => null,
                'track_clicks' => null,
                'auto_text' => null,
                'auto_html' => null,
                'inline_css' => null,
                'url_strip_qs' => null,
                'preserve_recipients' => null,
                'view_content_link' => null,
                'bcc_address' => $emailcc,//'message.bcc_address@example.com',
                'tracking_domain' => null,
                'signing_domain' => null,
                'return_path_domain' => null,
                'attachments' => $attachments
            );
            $async = false;
            $ip_pool = 'Main Pool';
            $send_at = '2016-12-12 10:00:00';
            $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
			$ans = true;
            print_r($result);
        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }

        return ($ans);
    }

    public static function logSend($to) {
        if (isset($to) && is_array($to)) {
            $date = new DateTime();
            $dest = $date->format('Y-m-d H:i:s') . "\t";
            foreach ($to as $destinatary) {
                $dest.="{$destinatary['mail']}\t";
            }
            $dest.="\n";
            file_put_contents(Yii::app()->basePath . "/runtime/" . SvpMail::LOG_FILENAME . $date->format('Y-m').'.log'
                    , $dest
                    , FILE_APPEND);
        }
    }

    public static function getUsername() {
        $ans = null;
        $app = Yii::app();

        if (empty($app->params['mailConfig']['numUsers'])) {
            $ans = $app->params['mailConfig']['Username'];
        } else {
            $filename = Yii::app()->basePath . "/runtime/" . SvpMail::COUNTER_FILENAME;
            if (file_exists($filename)) {
                $counter = 0 + file_get_contents($filename);
            } else {
                $counter = 0;
            }
            $counter++;
            file_put_contents($filename, $counter);
            $counter = ($counter % $app->params['mailConfig']['numUsers']);
            $ans = $app->params['mailConfig']['baseUserName'] .
                    $counter . '@' . $app->params['mailConfig']['domain'];
        }
        return $ans;
    }

}
