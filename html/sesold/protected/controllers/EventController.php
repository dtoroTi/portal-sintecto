<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EventController extends Controller {

    public function actionAnswerEvent($customerAnswerCode) {
        $event = $this->loadModel($customerAnswerCode);
        if ($event) {
            WebUser::logAccess('', $event->backgroundCheck->code, $event->backgroundCheck->customerUserId);
            if (isset($_POST['Event']) && isset($_POST['Event']['customerComment'])) {
                $event->customerComment = CHtml::encode($_POST['Event']['customerComment']);
                $event->customerIp = $_SERVER["REMOTE_ADDR"];
                $event->customerAnsweredOn = new CDbExpression('NOW()');
                if ($event->save()) {
                    $event->refresh();
                    WebUser::logAccess("Envio un comentario de la novedad creada:".$event->created, $event->backgroundCheck->code, $event->backgroundCheck->customerUserId);
                    if (!Yii::app()->user->sendMailInBackground(
                                    'El Estudio Ref [' . $event->backgroundCheck->code . '] tiene respuesta de novedad', //
                                    $this->renderPartial('_mailAnswerClient', array('event' => $event), true), //
                                    array(array("mail" => Yii::app()->params['serviceEmail']['principalEmail']['email'], "name" => Yii::app()->params['serviceEmail']['principalEmail']['name'])), //
                                    array(), //
                                    array(), // 
                                    array()
                            )
                    ) {
                        Yii::app()->user->setFlash('error', "Hay problemas con el servidor de correo.");
                    }

                    $this->render('answerThanks', array('event' => $event));
                } else {
                    Yii::app()->user->setFlash('error', "Este enlace ya ha caducado. <br> Por favor contactar al encargado del estudio.");
                    $this->render('customerCommentError');
                    // $this->redirect('http://www.securityandvision.com');
                }
            } else {
                $this->render('customerComment', array('event' => $event));
            }
        } else {
            Yii::app()->user->setFlash('error', "Este enlace ya ha caducado. <br> Por favor contactar al encargado del estudio.");
            $this->render('customerCommentError');
            // $this->redirect('http://www.securityandvision.com');
        }
    }

    private function loadModel($customerAnswerCode) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.customerAnswerCode', $customerAnswerCode, false);
        $criteria->addCondition('t.customerAnswerLimit>now()');
        $criteria->addCondition('t.customerAnsweredOn is null');
        $event = Event::model()->find($criteria);
        return $event;
    }

}
