<?php

class EventController extends Controller {

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Event;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Event'])) {
            $model->attributes = $_POST['Event'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($code, $pc) {
        //Creado por jonathan
        $user = User::model()->findByPk(Yii::app()->user->getId());
        if (isset($_POST['events'])) {
            $backgroundCheck = BackgroundCheck::findByCode($code);
            WebUser::logAccess("Actualizo los eventos ", $backgroundCheck->code);

            foreach ($_POST['events'] as $key => $detail) {
                if ($key == 'new') {
                    if (trim($detail['detail']) != "") {
                        $event = new Event;
                        $event->attributes = $detail;
                        $event->backgroundCheckId = $backgroundCheck->id;
                        $event->createdById = Yii::app()->user->id;
                        if ($event->eventTypeId != EventType::DELAY) {
                            $fecha = new DateTime($event->backgroundCheck->studyLimitOn);
                            $event->newLimitDate = $fecha->format('Y-m-d');
                        }

                        if (!$event->save()) {
                            Yii::app()->user->setFlash('events', "Error Saving [{$key}] :" . serialize($event->errors));
                        } else {
                            $event->refresh();
                            $body = $this->renderPartial('_mailEventCreated', array(
                                'event' => $event,
                                    ), true);
                            if ($event->eventType->id ==1) {
                                //Creado por jonathan
                                if($user->MailTimeImpact > 0)  {
                                     Yii::app()->user->sendMailInBackground(

                                    "❗⏰  El Estudio Ref [" . $backgroundCheck->code . "] tiene una novedad -->".$event->eventType->name. "<--", //
                                    $body, //
                                    array(Yii::app()->params['serviceEmail']['novedad'],), //
                                    array(Yii::app()->user->arUser->mailParam,)
                                );
                                    //Creado por jonathan
                                }else{
                                     Yii::app()->user->sendMailInBackground(

                                         "❗⏰  El Estudio Ref [" . $backgroundCheck->code . "] tiene una novedad -->".$event->eventType->name. "<--", //
                                         $body, //
                                         array(Yii::app()->params['serviceEmail']['novedad'],)
                                     );
                                }
                            }

                            else {
                                //Creado por jonathan
                                if ($user->MailInformativeNews > 0) {
                                    Yii::app()->user->sendMailInBackground(


                                        "🔄 El Estudio Ref [" . $backgroundCheck->code . "] tiene una novedad -->" . $event->eventType->name . "<--", //
                                        $body, //
                                        array(Yii::app()->params['serviceEmail']['novedad'],), //
                                        array(Yii::app()->user->arUser->mailParam,)
                                    );
                                }else{
                                    Yii::app()->user->sendMailInBackground(


                                        "🔄 El Estudio Ref [" . $backgroundCheck->code . "] tiene una novedad -->" . $event->eventType->name . "<--", //
                                        $body, //
                                        array(Yii::app()->params['serviceEmail']['novedad'],) //

                                    );
                                }
                            }

                        }

                        WebUser::logAccess("Creo un nuevo evento : " . CHtml::encode($event->detail), $backgroundCheck->code);
                    }
                } else {
                    $event = $this->loadModel($key);
                    if ($event) {
                        $event->attributes = $detail;
                        if (!$event->save()) {
                            Yii::app()->user->setFlash('events', "Error Saving new records[{$key}] :" . serialize($event->errors));
                        }
                    }
                }
            }
            $url = $this->createUrl('/backgroundCheck/update/', array('code' => $code, 'activeTab' => 'events', 'pc' => $pc));
            $this->redirect($url, true);
        }
    }

    public function actionNotifyCustomer($id, $pc) {
        //Agregado por Jonathan
        $user = User::model()->findByPk(Yii::app()->user->getId());
        $event = $this->loadModel($id);
        if ($event && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())) {
            WebUser::logAccess("Notificó al cliente de la novedad creado en {$event->created}", $event->backgroundCheck->code);
            $event->informedToCustomerOn = new CDbExpression('NOW()');
            $event->customerAnswerCode = Event::getNewCode();
            if ($event->eventTypeId != EventType::DELAY) {
                $fecha = new DateTime($event->backgroundCheck->studyLimitOn);
                $event->newLimitDate = $fecha->format('Y-m-d');
            }
            $event->customerAnswerLimit = $event->nextValidPeriod->format('Y-m-d H:i:s');
            $event->approvedById = Yii::app()->user->id;

            if (!$event->save()) {
                Yii::app()->user->setFlash('error', "Hay problemas con el envío de correo.");
            } else {
                $fecha = new DateTime($event->backgroundCheck->studyLimitOn);
                if ($fecha->format('Y-m-d') < $event->newLimitDate && $event->backgroundCheck->customerProduct->hourExpress==0) {
                    $event->backgroundCheck->studyLimitOn = $event->newLimitDate.' H:i:s';
                    $event->backgroundCheck->save();
                }
                $event->refresh();
                if ($event->backgroundCheck->notifyCustomerByMail) {
                    $body = $this->renderPartial('_mailForClientEventCreated', array(
                        'event' => $event,
                            ), true);
                    if ($event->eventType->id ==1) {
                        //creado por jonathan
                        if ($user->MailTimeImpact > 0) {
                            if (Yii::app()->user->sendMailInBackground(
                                "❗⏰  El Estudio Ref [" . $event->backgroundCheck->code . "] tiene una novedad  -->" . $event->eventType->name . "<--", //
                                $body, //
                                $event->backgroundCheck->customerUser->mailsParam, //
                                array(
                                    Yii::app()->user->arUser->mailParam,
                                    Yii::app()->params['serviceEmail']['novedad'],
                                )
                            )) {

                            }//if sendmail
                        }
                        //creado por jonathan
                        elseif(Yii::app()->user->sendMailInBackground(
                            "❗⏰  El Estudio Ref [" . $event->backgroundCheck->code . "] tiene una novedad  -->" . $event->eventType->name . "<--", //
                            $body, //
                            $event->backgroundCheck->customerUser->mailsParam,
                            array(
                                Yii::app()->params['serviceEmail']['novedad'],
                            )//
                            )){

                        }
                        else {
                        Yii::app()->user->setFlash('error', "Se tienen problemas con el envío de correo.");
                         }
                    }//event tipe id
                    else {
                        //creado por jonathan
                        if ($user->MailInformativeNews > 0) {
                        if (Yii::app()->user->sendMailInBackground(
                            "🔄 El Estudio Ref [" . $event->backgroundCheck->code . "] tiene una novedad  -->".$event->eventType->name. "<--", //
                            $body, //
                            $event->backgroundCheck->customerUser->mailsParam, //
                            array(
                                Yii::app()->user->arUser->mailParam,
                                Yii::app()->params['serviceEmail']['novedad'],
                            )
                        )) {

                        }
                        }
                        //creador por jonathan
                        elseif (Yii::app()->user->sendMailInBackground(
                            "🔄 El Estudio Ref [" . $event->backgroundCheck->code . "] tiene una novedad  -->".$event->eventType->name. "<--", //
                            $body, //
                            $event->backgroundCheck->customerUser->mailsParam,
                            array(
                                Yii::app()->params['serviceEmail']['novedad'],
                            ))
                        ){

                        }
                        else {
                            Yii::app()->user->setFlash('error', "Se tienen problemas con el envío de correo.");
                        }

                    }
                }//denajo del refresh
            }
            $url = $this->createUrl('/backgroundCheck/update/', array('code' => $event->backgroundCheck->code, 'activeTab' => 'events', 'pc' => $pc));
            $this->redirect($url, true);
        } else {
            $this->redirect('/site/home/', true);
        }
    }

    //Natalia Henao Mayorga
    //26/09/2022
    public function actionNotifySAC($id, $pc) {
        //Agregado por Jonathan
        $user = User::model()->findByPk(Yii::app()->user->getId());
        $event = $this->loadModel($id);
        if ($event && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())) {
            WebUser::logAccess("Notificó a SAC de la novedad creada en {$event->created}", $event->backgroundCheck->code);
            $event->reportSACDate = new CDbExpression('NOW()');
            //$event->customerAnswerCode = Event::getNewCode();
            if ($event->eventTypeId != EventType::DELAY) {
                $fecha = new DateTime($event->backgroundCheck->studyLimitOn);
                $event->newLimitDate = $fecha->format('Y-m-d');
                //$event->newLimitDate = $event->backgroundCheck->studyLimitOn;
            }
            //$event->customerAnswerLimit = $event->nextValidPeriod->format('Y-m-d H:i:s');
            //$event->approvedById = Yii::app()->user->id;
            $event->reportSACByid =  Yii::app()->user->id;

            if (!$event->save()) {
                Yii::app()->user->setFlash('error', "Hay problemas con el envío de correo.");
            } else {
                $fecha = new DateTime($event->backgroundCheck->studyLimitOn);
                if ($fecha->format('Y-m-d') < $event->newLimitDate && $event->backgroundCheck->customerProduct->hourExpress==0) {
                    $event->backgroundCheck->studyLimitOn = $event->newLimitDate.' H:i:s';
                    $event->backgroundCheck->save();
                }
                /*if ($event->backgroundCheck->studyLimitOn < $event->newLimitDate) {
                    $event->backgroundCheck->studyLimitOn = $event->newLimitDate;
                    $event->backgroundCheck->save();
                }*/
                $event->refresh();
                //if ($user->MailInformativeNews>0) {

                    $userEmailSAC = User::model()->findByPk($event->backgroundCheck->customer->sacId);

                    if(!$userEmailSAC){
                        Yii::app()->user->setFlash('error', "No puede envíar el correo porque no ha registrado un usuario SAC en la información del cliente.");
                    }else{

                        $body = $this->renderPartial('_mailForSACEvent', array(
                            'event' => $event,
                            'userSAC'=>$userEmailSAC
                                ), true);
                        if ($event->eventType->id ==1) {
                                if(Yii::app()->user->sendMailInBackground(
                                "❗⏰  El Estudio Ref [" . $event->backgroundCheck->code . "] Reporte SAC -->" . $event->eventType->name . "<--", //
                                $body, //
                                array(
                                    array(
                                        "mail" => $userEmailSAC->username,
                                        "name" => $userEmailSAC->name
                                    )
                                ),
                                array(
                                    array(
                                        "mail" => Yii::app()->user->name,
                                        "name" => Yii::app()->user->name
                                    ),
                                    array(
                                        "mail" => 'jcuellar@sintecto.com',
                                        "name" => 'Julian Cuellas'
                                    ),
                                ),
                                array(
                                    //Yii::app()->user->arUser->mailParam,
                                    Yii::app()->params['serviceEmail']['novedad'],
                                )//
                                )){
                                    Yii::app()->user->setFlash('error', "Se envío el correo a SAC.");
                            }
                            else {
                            Yii::app()->user->setFlash('error', "Se tienen problemas con el envío de correo.");
                            }
                        }else {

                            if (Yii::app()->user->sendMailInBackground(
                                "🔄 El Estudio Ref [" . $event->backgroundCheck->code . "] Reporte SAC -->".$event->eventType->name. "<--", //
                                $body, //
                                array(
                                    array(
                                        "mail" => $userEmailSAC->username,
                                        "name" => $userEmailSAC->name
                                    )
                                ),
                                array(
                                    array(
                                        "mail" => Yii::app()->user->name,
                                        "name" => Yii::app()->user->name
                                    ),
                                    array(
                                        "mail" => 'jcuellar@sintecto.com',
                                        "name" => 'Julian Cuellas'
                                    ),
                                ),
                                array(
                                    //Yii::app()->user->arUser->mailParam,
                                    Yii::app()->params['serviceEmail']['novedad'],
                                )
                            )) {
                                Yii::app()->user->setFlash('error', "Se envío el correo a SAC.");
                            }
                        }
                    }
                //}//denajo del refresh
                /*else{
                    Yii::app()->user->setFlash('error', "El usuario no tiene habilitado Mail Nov.Infor en su información general.");
                }*/
            }
            $url = $this->createUrl('/backgroundCheck/update/', array('code' => $event->backgroundCheck->code, 'activeTab' => 'events', 'pc' => $pc));
            $this->redirect($url, true);
        } else {
            $this->redirect('/site/home/', true);
        }
    }


    //Natalia Henao Mayorga
    //28/11/2022
    public function actionResponseOP($id, $pc) {

        $user = User::model()->findByPk(Yii::app()->user->getId());
        $event = $this->loadModel($id);
        if ($event && Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            WebUser::logAccess("Funcionario SAC, Respondio a operaciones la novedad creada en {$event->created}", $event->backgroundCheck->code);

            $event->commentSACDate = new CDbExpression('NOW()');
            if ($event->eventTypeId != EventType::DELAY) {
                $fecha = new DateTime($event->backgroundCheck->studyLimitOn);
                $event->newLimitDate = $fecha->format('Y-m-d');
                //$event->newLimitDate = $event->backgroundCheck->studyLimitOn;
            }
            //$event->approvedById = Yii::app()->user->id;

            if (!$event->save()) {
                Yii::app()->user->setFlash('error', "Hay problemas con el envío de correo.");
            } else {
                /*if ($event->backgroundCheck->studyLimitOn < $event->newLimitDate) {
                    $event->backgroundCheck->studyLimitOn = $event->newLimitDate;
                    $event->backgroundCheck->save();
                }*/
                $fecha = new DateTime($event->backgroundCheck->studyLimitOn);
                if ($fecha->format('Y-m-d') < $event->newLimitDate && $event->backgroundCheck->customerProduct->hourExpress==0) {
                    $event->backgroundCheck->studyLimitOn = $event->newLimitDate.' H:i:s';
                    $event->backgroundCheck->save();
                }
                $event->refresh();
                //if ($user->MailInformativeNews>0) {

                    $userEmailOP = User::model()->findByPk($event->createdById);

                    if(!$userEmailOP){
                        Yii::app()->user->setFlash('error', "No puede envíar el correo porque no ha registrado un usuario SAC en la información del cliente.");
                    }else{

                        $body = $this->renderPartial('_mailForResponseOP', array(
                            'event' => $event,
                            'userOP'=>$userEmailOP
                                ), true);
                        if ($event->eventType->id ==1) {
                                if(Yii::app()->user->sendMailInBackground(
                                "❗⏰  El Estudio Ref [" . $event->backgroundCheck->code . "] Respuesta SAC a OP-->" . $event->eventType->name . "<--", //
                                $body, //
                                array(
                                    array(
                                        "mail" => $userEmailOP->username,
                                        "name" => $userEmailOP->name
                                    )
                                ),
                                array(
                                    array(
                                        "mail" => Yii::app()->user->name,
                                        "name" => Yii::app()->user->name
                                    ),
                                    array(
                                        "mail" => 'jcuellar@sintecto.com',
                                        "name" => 'Julian Cuellas'
                                    ),
                                ),
                                array(
                                    //Yii::app()->user->arUser->mailParam,
                                    Yii::app()->params['serviceEmail']['novedad'],
                                )//
                                )){
                                    Yii::app()->user->setFlash('error', "Se envío el correo a Operaciones.");
                            }
                            else {
                            Yii::app()->user->setFlash('error', "Se tienen problemas con el envío de correo.");
                            }
                        }else {

                            if (Yii::app()->user->sendMailInBackground(
                                "🔄 El Estudio Ref [" . $event->backgroundCheck->code . "] Respuesta SAC a OP-->".$event->eventType->name. "<--", //
                                $body, //
                                array(
                                    array(
                                        "mail" => $userEmailOP->username,
                                        "name" => $userEmailOP->name
                                    )
                                ),
                                array(
                                    array(
                                        "mail" => Yii::app()->user->name,
                                        "name" => Yii::app()->user->name
                                    ),
                                    array(
                                        "mail" => 'jcuellar@sintecto.com',
                                        "name" => 'Julian Cuellas'
                                    ),
                                ),
                                array(
                                    //Yii::app()->user->arUser->mailParam,
                                    Yii::app()->params['serviceEmail']['novedad'],
                                )
                            )) {
                                Yii::app()->user->setFlash('error', "Se envío el correo a Operaciones.");
                            }
                        }
                    }
                //}//denajo del refresh
                /*else{
                    Yii::app()->user->setFlash('error', "El usuario no tiene habilitado Mail Nov.Infor en su información general.");
                }*/
            }
            $url = $this->createUrl('/backgroundCheck/update/', array('code' => $event->backgroundCheck->code, 'activeTab' => 'events', 'pc' => $pc));
            $this->redirect($url, true);
        } else {
            $this->redirect('/site/home/', true);
        }
    }
    
    
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id, $pc) {
        $event = $this->loadModel($id, $pc);
        if ($event) {
            // we only allow deletion via POST request
            $code = $event->backgroundCheck->code;
            WebUser::logAccess("Borro el evento : " . CHtml::encode($event->detail), $event->backgroundCheck->code);
            $event->delete();
            $url = $this->createUrl('/backgroundCheck/update/', array('code' => $code, 'activeTab' => 'events', 'pc' => $pc));
            $this->redirect($url, true);
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Event');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Event('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Event']))
            $model->attributes = $_GET['Event'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Event::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'event-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionExportEventSACCSV() {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $today = new DateTime('now', timezone_open('America/Bogota'));
            $eventReportsSAC = Event::getEventSAC();

            echo $this->renderPartial( 'exportEventReportSAC'
                    , array(
                'eventReportsSAC' => $eventReportsSAC,
            ));
        }
    }

}
//comment