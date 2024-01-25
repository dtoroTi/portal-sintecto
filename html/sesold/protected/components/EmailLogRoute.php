<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EmailLogRoute extends CEmailLogRoute {

    protected function sendEmail($email, $subject, $message) {
        $filename = Yii::app()->basePath . "/runtime/errorMail.dat";
        // Send the error mail with max interval of 5 min
        if (!file_exists($filename) || (time() - filemtime($filename)) > 300) {
            if (file_exists($filename) && filesize($filename) > 0) {
                $oldBody = "<br/><hr/><br/><br/>" . file_get_contents($filename);
            } else {
                $oldBody = "";
            }

            $body = "<p>" .
                    "User:" . @Yii::app()->user->name . "<br/>" .
                    "IP:" . @$_SERVER['REMOTE_ADDR'] . "<br/>" .
                    "Url Referer:" . @$_SERVER['HTTP_REFERER'] . "<br/><br/>" .
                    "Agent:" . @$_SERVER['HTTP_USER_AGENT'] . "<br/><br/>" .
                    "</p>" . "<pre>" . $message . "</pre>" . $oldBody;

            $timeZone = new DateTimeZone('America/Bogota');
            $now = new DateTime('now', $timeZone);
            $subject.='(' . $now->format('Y-m-d H:i:s') . ')';
            Yii::app()->user->sendMailInBackground($subject, $body, array(array('mail' => $email, 'name' => $email)));
            file_put_contents($filename, "");
        } else {
            $timeZone = new DateTimeZone('America/Bogota');
            $now = new DateTime('now', $timeZone);
            $newbody = "Subject:" . $subject . "¥n";
            $newbody.="Time:" . $now->format("c") . "¥n";
            $newbody.= "<p>" .
                    "User:" . @Yii::app()->user->name . "<br/>" .
                    "IP:" . @$_SERVER['REMOTE_ADDR'] . "<br/>" .
                    "Url Referer:" . @$_SERVER['HTTP_REFERER'] . "<br/><br/>" .
                    "Agent:" . @$_SERVER['HTTP_USER_AGENT'] . "<br/><br/>" .
                    "</p>";
            file_put_contents($filename, $newbody . "<br/><hr/><br/><br/><pre>" . $message . "</pre>", FILE_APPEND);
        }
    }

}
