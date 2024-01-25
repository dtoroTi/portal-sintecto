<?php

class SvpmailCommand extends CConsoleCommand {

    public function run($args) {
        Yii::import('application.models.*');
        Yii::import('application.models.basic.*');
        if (count($args) == 1) {
            $filename = $args[0];
            if (file_exists(BackgroundCheck::getFullPath($filename))) {
                $mailArgs = unserialize(file_get_contents(BackgroundCheck::getFullPath($filename)));

                if (count($mailArgs) == 6) {
                    Yii::import('application.models.basic.SvpMail');
                    $ans = SvpMail::sendMail($mailArgs['subject'], $mailArgs['body'], $mailArgs['to'], $mailArgs['cc'], $mailArgs['bcc'], $mailArgs['files']);
                    if ($ans) {
                        unlink(BackgroundCheck::getFullPath($filename));
                        if (is_array($mailArgs['files']) && count($mailArgs['files']) > 0) {
                            foreach ($mailArgs['files'] as $attachedFile) {
                                if (file_exists(BackgroundCheck::getFullPath($attachedFile['fileName']))) {
                                    unlink(BackgroundCheck::getFullPath($attachedFile['fileName']));
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function getHelp() {
        return "Usage: VSPMail ";
    }

    public function getName() {
        return "VSPMail";
    }

//    public function sendMail($subject, $body, $to, $cc = null, $bcc = null, $files = null) {
//        $ans = false;
//        Yii::import('application.extensions.phpmailer.JPhpMailer');
//
//        $mail = new JPhpMailer;
//
//
////        $mail->IsSMTP();
////        $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
////        $mail->SMTPAuth = true;                  // enable SMTP authentication
////        $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
////        $mail->Port = 587;
////        $mail->Username = 'hv1@securityandvision.com';
////        $mail->Password = 'inmersion';
////        $mail->SetFrom('hv1@securityandvision.com', 'Security and Vision');
////        $mail->AddReplyTo('info@securityandvision.com', 'Security and Vision');
//
//        $mail->CharSet = 'UTF-8';
//        $app = Yii::app();
//        $mailType = $app->params['mailConfig']['mailType'];
//        $mail->$mailType();
//        $mail->Host = $app->params['mailConfig']['Host'];      // sets GMAIL as the SMTP server
//        $mail->SMTPAuth = $app->params['mailConfig']['SMTPAuth'];                  // enable SMTP authentication
//        $mail->SMTPSecure = $app->params['mailConfig']['SMTPSecure'];                 // sets the prefix to the servier
//        $mail->Port = $app->params['mailConfig']['Port'];
//        $mail->Username = $app->params['mailConfig']['Username'];
//        $mail->Password = $app->params['mailConfig']['Password'];
//        $mail->SetFrom($app->params['mailConfig']['from']['mail'], $app->params['mailConfig']['from']['name']);
//        $mail->AddReplyTo($app->params['mailConfig']['replayTo']['mail'], $app->params['mailConfig']['replayTo']['name']);
//
//
//////
////    $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
////    $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
////    $mail->Port = 465; // set the SMTP port for the GMAIL server
//        $mail->Username = 'support@zubietas.com';
////        $mail->Password = 'suPP0rt';
////        $mail->SetFrom('support@zubietas.com', 'Security and Vision');
//        $mail->Subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
//        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
//
//
//        // To keep a copy in the server
//
//        if ($bcc == null) {
//            $bcc = array();
//        }
//        $bcc[] = array('mail' => 'hv1@securityandvision.com', 'name' => 'Security And Vision');
//
//
//        try {
//            if ($app->params['serverName'] != "online") {
//                foreach ($app->params['supportMail'] as $contact) {
//                    if (trim($contact['mail']) != '') {
//                        $mail->AddAddress(trim($contact['mail']), trim($contact['name']));
//                    }
//                }
//
//                if (isset($to) && is_array($to)) {
//                    $body.="<br/><br/><hr/>Correo enviado a <br/>[" . $app->params['serverName'] . "]<br/><br/>";
//                    foreach ($to as $destinatary) {
//                        $body.="{$destinatary['mail']}   [{$destinatary['name']}] <br/>";
//                    }
//                }
//                if (isset($cc) && is_array($cc)) {
//                    $body.="<br/><br/><hr/>Correo enviado con CC a <br/>";
//                    foreach ($cc as $destinatary) {
//                        $body.="{$destinatary['mail']}  [{$destinatary['name']}]<br/>";
//                    }
//                }
//                if (isset($bcc) && is_array($bcc)) {
//                    $body.="<br/><br/><hr/>Correo enviado con BCC a <br/>";
//                    foreach ($bcc as $destinatary) {
//                        $body.="{$destinatary['mail']}   [{$destinatary['name']}] <br/>";
//                    }
//                }
//            } else if ($app->params['serverName'] == "online") {
//
//                if (isset($to) && is_array($to)) {
//                    foreach ($to as $destinatary) {
//                        if (trim($destinatary['mail']) != '') {
//                            $mail->AddAddress(trim($destinatary['mail']), trim($destinatary['name']));
//                        }
//                    }
//                }
//
//                if (isset($cc) && is_array($cc)) {
//                    foreach ($cc as $destinatary) {
//                        if (trim($destinatary['mail']) != '') {
//                            $mail->AddCC(trim($destinatary['mail']), trim($destinatary['name']));
//                        }
//                    }
//                }
//
//                if (isset($bcc) && is_array($bcc)) {
//                    foreach ($bcc as $destinatary) {
//                        if (trim($destinatary['mail']) != '') {
//                            $mail->AddBCC(trim($destinatary['mail']), trim($destinatary['name']));
//                        }
//                    }
//                }
//            }
//
//            $mail->MsgHTML($body);
//
//            if (!empty($files) && is_array($files)) {
//                foreach ($files as $file) {
//                    if (is_array($file) && isset($file['fileName']) && file_exists(BackgroundCheck::getFullPath($file['fileName'])))
//                        $mail->AddAttachment(BackgroundCheck::getFullPath($file['fileName']), $file['baseName']);
//                }
//            }
//
//
//            $ans = true;
//            if ($app->params['serverName'] != "devportable") {
//                $ans = $mail->Send();
//            }
//
//            if (!empty($files) && is_array($files)) {
//                foreach ($files as $file) {
//                    if (is_array($file) && isset($file['fileName']) && file_exists(BackgroundCheck::getFullPath($file['fileName'])))
//                        unlink(BackgroundCheck::getFullPath($file['fileName']));
//                }
//            }
//        } catch (phpmailerException $e) {
//            echo $e->errorMessage(); //Pretty error messages from PHPMailer
//        } catch (Exception $e) {
//            echo $e->getMessage(); //Boring error messages from anything else!
//        }
//        if (!$ans) {
//            print ("ERROR: " . $mail->ErrorInfo);
//            Yii::log("Error Sending the mail :" . $mail->ErrorInfo, "error", "ZWF." . __CLASS__);
//        }
//        return ($ans);
//    }
}
