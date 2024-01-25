<?php

class SvpmailCommand extends CConsoleCommand {

    public function run($args) {

        if (count($args) == 1) {
            $filename = $args[0];
            if (file_exists($filename)) {
                $mailArgs = unserialize(file_get_contents($filename));
                if (count($mailArgs) >= 5) {
                    Yii::import('application.models.basic.SvpMail');
                    $ans = SvpMail::sendMail($mailArgs['subject'], $mailArgs['body'], $mailArgs['to'], $mailArgs['cc'], $mailArgs['bcc'], $mailArgs['files'], $mailArgs['sender']);
                    if ($ans) {
                        unlink($filename);
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

}
