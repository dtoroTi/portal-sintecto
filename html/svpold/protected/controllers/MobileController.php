<?php

class MobileController extends Controller {

    public function actionDownload($code) {
        if (substr($_SERVER['SERVER_ADDR'], 0, 7) == '192.168') {
            $backgroundCheck = BackgroundCheck::findByCode($code);
            if ($backgroundCheck) {
                echo $this->renderPartial('download', array(
                    'backgroundCheck' => $backgroundCheck,
                ));
            }
        }
    }

    public function actionLogin() {
        echo $this->renderPartial('login');
    }

    public function actionPending() {
        //        echo "Init¥n";
        foreach ($_POST as $key => $val) {
//            echo "[{$key}]:{$val}";
        }
        $backgroundChecks = BackgroundCheck::model()->getPendingPollsForUser('jospina@svision.co');
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo $this->renderPartial('pending', array('backgroundChecks' => $backgroundChecks));
    }

    public function actionUpload() {
        echo $this->renderPartial('upload');
    }

}
