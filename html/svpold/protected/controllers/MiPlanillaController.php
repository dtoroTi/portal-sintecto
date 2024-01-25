<?php
//Controller para compartir servicio que sera consumido por mi planilla, para retornar los datos.
//Natalia Henao M--21/09/2022
class MiPlanillaController extends CController
{

	public $layout = '//layouts/column1';
    public $defaultAction = 'admin';

	public function filters()
	{
		return array( 'accessControl' ); // perform access control for CRUD operations
	}

	public function accessRules() {
		$accessIp = [
			['allow', // allow all users to perform these actions
				'actions' => ['createCustomer','getstatusCustomer', 'customerUserReg', 'customerUserUpd', 'getServices', 'createStudy', 'addDocumentToStudy', 'cancelledStudy', 'getStudyEvents', 'updateEvent', 'getStudyStatus', 'getReport'],
				'ips' => [
					"147.135.75.225", "192.168.1.15", //"191.95.162.180", "60.111.242.45", "192.168.55.141", "201.184.51.10"
				]
			],
			['deny', // deny all users to perform these actions
				'actions' => [],
				'ips' => ['*']
			],
		];
		return $accessIp;
	}

    public function getUsrMiplanilla(){

		if (!isset($_SERVER['PHP_AUTH_USER'])) {
			header('WWW-Authenticate: Basic realm="miPlanilla"');
			header('HTTP/1.1 401 Unauthorized');
			exit;
		}else {
			$user = $_SERVER['PHP_AUTH_USER'];
			$pass = $_SERVER['PHP_AUTH_PW'];

			$user = CustomerUser::model()->findByAttributes(array('username' => $user));

			if ($user === null) {
				return false;
			} else if (!$user->validatePassword($pass)) {
			    return false;
			} else {
				return true;
			}
		}
    }

	public function actioncreateCustomer()
	{
		$user = $this->getUsrMiplanilla();

		if(true){

				if($user==true){

                    $dateReceived = file_get_contents("php://input");
                    $dateCustomer = json_decode($dateReceived);

                    if(!empty($dateCustomer)){

                        if($dateCustomer->customerName=="" || $dateCustomer->docCustomer=="" || $dateCustomer->responsible=="" || $dateCustomer->telResponsible=="" || $dateCustomer->authorization=="" || $dateCustomer->Textauthorization==""){
                            $this->deliver_responseCustomer(200, "Debe registrar todos los campos solicitados.", null, null, null);
                        }else{

							$CustomerVal = Customer::model()->findByAttributes(['customerGroupId'=>Customer::GROUP_CENET, 'Idcustomer'=>$dateCustomer->docCustomer]); //'name'=>$dateCustomer->customerName.'-CENET',
							$dateAct = new DateTime();  
							$date = $dateAct->format("Y-m-d h:i:s");  

							if($CustomerVal){
								$this->deliver_responseCustomer(200, "Cliente creado anteriormente.", null, $date, $CustomerVal->id);
							}else if($dateCustomer->authorization=="false" || $dateCustomer->authorization=="False"){
								$this->deliver_responseCustomer(200, "El Cliente no autorizo el tratamiento de sus datos.", null, $date, null);
							}else{

								$CustomerUsers = Customer::model()->findByAttributes(['id'=>Customer::CUSTOMER_CENET, 'customerGroupId'=>Customer::GROUP_CENET]);
								if($CustomerUsers){
									$leaderId=$CustomerUsers->userId;
									$sacId=$CustomerUsers->sacId;
									$salesmanId=$CustomerUsers->salesmanId;
								}

								$model = new Customer;
								$model->customerGroupId = Customer::GROUP_CENET;
								$model->name = $dateCustomer->customerName.'-CENET';
								$model->Idcustomer = $dateCustomer->docCustomer;
								$model->comments = $dateCustomer->responsible.' '.$dateCustomer->telResponsible;
								$model->address = $dateCustomer->direccion;
								$model->city = $dateCustomer->telefono;
								$model->created = $date;
								$model->isActive = "1";
								$model->userId=$leaderId;
								$model->sacId=$sacId;
								$model->salesmanId=$salesmanId;
								$model->businessLine="Integridad";
		
								if ($model->save()) {
									WebUser::logAccess("Creo un cliente :" . $model->Idcustomer, null, true, null);

									$message="SE SOLICITA LA VALIDACIÓN DEL CLIENTE REGISTRADO DESDE LA PLATAFORMA MI PLANILLA.";

									$body = "<b>AUTORIZACIÓN</b></br>" .
									"<pre>".$dateCustomer->authorization.", ".$dateCustomer->Textauthorization."</pre><br/><br/>".
									"</p>" . "<pre><b>" . $message . "</b></pre><br/>".
									"<b>DATOS DEL CLIENTE</b><br/><br/>" .
									"<b>Grupo cliente:</b> ". $model->customerGroup->name ."<br/>" .
									"<b>Cliente #:</b> " .  $model->id . "<br/>" .
									"<b>Cliente:</b> " . $model->name . "<br/>" .
									"<b>Documento:</b> " . $model->Idcustomer. "<br/><br/>".

									"<b>Servidor:</b> " .$_SERVER['SERVER_NAME']. "<br/><br/>";
									
									//Yii::app()->params['serverName']
									$timeZone = new DateTimeZone('America/Bogota');
									$now = new DateTime('now', $timeZone);
									$subject='❗⏰ Validación cliente CENET (' . $now->format('Y-m-d H:i:s') . ') ❗⏰';
									Yii::app()->user->sendMailInBackground($subject, $body, array(array('mail' => Yii::app()->params['approvesCustomerCenet'], 'name' => Yii::app()->params['approvesCustomerCenet'])));

									$this->deliver_responseCustomer(200, "Información recibida con éxito.", null, $date, $model->id);
								}else{
									$this->deliver_responseCustomer(200, "no pudo crear el cliente.", null, $date,  $dateCustomer->customerName);
								}
							}
                        }
                    }
				}else{
					$this->deliver_responseCustomer(200, "Error: Incorrect username or password.", null, null, null);
				}
		}else{
			$this->deliver_responseCustomer(400, "Permiso Denegado", null, null, null);
		}
	}

	public function actiongetstatusCustomer()
	{
		$user = $this->getUsrMiplanilla();

		if(true){

				if($user==true){

					$dateReceived = file_get_contents("php://input");
                    $dateCustomerStatus = json_decode($dateReceived);

					$dateAct = new DateTime();  
					$date = $dateAct->format("Y-m-d h:i:s");  

					if(!empty($dateCustomerStatus)){
						if($dateCustomerStatus->idCustomer==""){
							$this->deliver_responseCustomer(200, "Debe ingresar el idCustomer.", null, $date, null);
						}else{

							$CustomerVal = Customer::model()->findByAttributes(['id'=>$dateCustomerStatus->idCustomer, 'customerGroupId'=>Customer::GROUP_CENET]);

							if($CustomerVal){
								if($CustomerVal->isActive==0){
									$statusStudy="Inactivo";
								}else{
									$statusStudy="Activo";
								}
								$alert=$CustomerVal->comments;
								WebUser::logAccess("Consulto el estado del cliente.". $CustomerVal->id, null, true, null);
								$this->deliver_responseCustomer(200, "El cliente se encuentra en estado: ".$statusStudy, $alert, $date, null);
							}else{
								$this->deliver_responseCustomer(200, "No se encontraron datos con ese codigo de cliente.", null, $date, null);
							}

                    	}
					}
				}else{
					$this->deliver_responseCustomer(200, "Error: Incorrect username or password.",null, null, null);
				}
		}else{
			$this->deliver_responseCustomer(400, "Permiso Denegado", null, null, null);
		}
	}

	function deliver_responseCustomer($status, $status_message, $alert, $data, $id)
    {
		header("Content-Type:application/json");
        header("HTTP/1.1 $status $status_message");
        $response['status'] = $status;
        $response['status_Message'] = $status_message;
		$response['alert'] = $alert;
		if($id!=null){
			$response['idCustomer'] = $id;
		}
        $response['date'] = $data;
 
        $json_response = json_encode($response);
        echo $json_response;
		Yii::app()->end();
    }


	public function actioncustomerUserReg()
	{
        $user = $this->getUsrMiplanilla();

		if(true){

				if($user==true){

                    $dateReceived = file_get_contents("php://input");
                    $dateUsers = json_decode($dateReceived);

                    if(!empty($dateUsers)){

                        if($dateUsers->email=="" || $dateUsers->firstName=="" || $dateUsers->lastName=="" || $dateUsers->idCustomer=="" || $dateUsers->reportPassword==""){
                            $this->deliver_response(200, "Debe registrar todos los campos solicitados.", null, null);
                        }else{
							$dateAct = new DateTime();  
							$date = $dateAct->format("Y-m-d h:i:s");  

							$CustomerVal = Customer::model()->findByAttributes(['id'=>$dateUsers->idCustomer, 'customerGroupId'=>Customer::GROUP_CENET]);
							if($CustomerVal){
								if($CustomerVal->isActive==1){

									$model = new CustomerUser;
									$model->customerId = $dateUsers->idCustomer;
									$model->username = '___'.$CustomerVal->Idcustomer.'_'.$dateUsers->email;
									$model->email2 = $dateUsers->email;
									$model->firstName = $dateUsers->firstName;
									$model->lastName = $dateUsers->lastName;
									$model->pdfPassword = $dateUsers->reportPassword;
									$model->created = $date;
									$model->mustChangePassword = "0";
									$model->clearPassword1 ="0";
									$model->clearPassword2 ="0";
			
									if ($model->save()) {
										WebUser::logAccess("Creo un usuario de cliente :" . $model->username, null, true, $model->username);
									}
		
									if($model->id==null){
										$userVal = CustomerUser::model()->findByAttributes(['customerId'=>$dateUsers->idCustomer, 'email2'=>$dateUsers->email]);
										if($userVal){
											$this->deliver_response(200, "Usuario almacenado anteriormente.", $date, $userVal->id);
										}
									}else{
										$this->deliver_response(200, "Información recibida con éxito.", $date, $model->id);
									}
								}else{
									$this->deliver_response(200, "El cliente aun no se encuentra activo para registrar usuario.", $date, $CustomerVal->id);
								}
							
							}else{
								$this->deliver_response(200, "No se encuentra ningun cliente registrado con ese idCustomer.", $date, null);
							}
                           
                        }
                    }
				}else{
					$this->deliver_response(200, "Error: Incorrect username or password.", null, null);
				}
		}else{
			$this->deliver_response(400, "Permiso Denegado", null, null);
		}
	}

	public function actioncustomerUserUpd()
	{
        $user = $this->getUsrMiplanilla();

		if(true){

			if($user==true){

                    $dateReceived = file_get_contents("php://input");
                    $dateUsers = json_decode($dateReceived);

                    if(!empty($dateUsers)){

                        if($dateUsers->idUser==""){
                            $this->deliver_response(200, "Debe ingresar el idUser que desea actualizar.", null, null);
                        }else{
							
							$dateAct = new DateTime();  
							$date = $dateAct->format("Y-m-d h:i:s");  

							$CustomerUser = CustomerUser::model()->findByPK($dateUsers->idUser);

							if(isset($dateUsers->email) && $dateUsers->email!=""){
								//$CustomerUser->username = $dateUsers->email;
								$CustomerUser->email2=$dateUsers->email;
							}
							if(isset($dateUsers->firstName) && $dateUsers->firstName!=""){
								$CustomerUser->firstName = $dateUsers->firstName;
							}
							if(isset($dateUsers->lastName) && $dateUsers->lastName!=""){
								$CustomerUser->lastName = $dateUsers->lastName;
							}
							if(isset($dateUsers->reportPassword) && $dateUsers->reportPassword!=""){
								$CustomerUser->pdfPassword = $dateUsers->reportPassword;
							}
							$CustomerUser->modified = $date;
	
							/*$userVal = CustomerUser::model()->findByAttributes(['username'=>$dateUsers->email]);
							if($userVal && $userVal->id!=$dateUsers->idUser){
								$this->deliver_response(200, "Correo de usuario ya se encuentra registrado.", $date, null); //$userVal->id
							}else */if ($CustomerUser->update()) {
								WebUser::logAccess("Actualizo un usuario de cliente :" . $CustomerUser->username, null, true, $CustomerUser->username);
								$this->deliver_response(200, "Información actualizada con éxito.", $date, null);
							}else{
								$this->deliver_response(200, "No pudo ser actualizados los datos del usuario.", $date, null);
							}
                        }
                    }
				}else{
					$this->deliver_response(200, "Error: Incorrect username or password.", null, null);
				}
		}else{
			$this->deliver_response(400, "Permiso Denegado", null, null);
		}
	}

	function deliver_response($status, $status_message, $data, $id)
    {
		header("Content-Type:application/json");
        header("HTTP/1.1 $status $status_message");
        $response['status'] = $status;
        $response['status_Message'] = $status_message;

		if($id!=null){
			$response['idUser'] = $id;
		}
        $response['date'] = $data;
 
        $json_response = json_encode($response);
        echo $json_response;
		Yii::app()->end();
    }

	public function actiongetServices(){

		$user = $this->getUsrMiplanilla();

		if(true){

			if($user==true){		

				$dateAct = new DateTime();  
				$date = $dateAct->format("Y-m-d h:i:s");  

				$custumerProd = CustomerProduct::model()->findAllByAttributes(['customerId'=>Customer::CUSTOMER_CENET, 'isActive'=>'1']);
				if($custumerProd){
					WebUser::logAccess("Llamo la lista de productos", null, true, $user);
					$this->deliver_responseServices(200, "", $date, $custumerProd);
				}
			}else{
				$this->deliver_responseServices(200, "Error: Incorrect username or password.", null, null);
			}
		}else{
			$this->deliver_responseServices(400, "Permiso Denegado", null, null);
		}
	}

	function deliver_responseServices($status, $status_message, $date, $custumerProd)
    {
		header("Content-Type:application/json");
        header("HTTP/1.1 $status $status_message");

        foreach ($custumerProd AS $prod){
            $product[]=[
                'idProducto'=>$prod->id,
                'Nombre'=>$prod->name
            ];
        }
        
        $response['status'] = $status;
        $response['servicios'] = $product;
        $response['date'] = $date;
 
        $json_response = json_encode($response);
        echo $json_response;
		Yii::app()->end();
    }

	public function actioncreateStudy(){

		$user = $this->getUsrMiplanilla();

    	if(true){

			if($user==true){		

					$dateReceived = file_get_contents("php://input");
                    $dateStudy = json_decode($dateReceived);

					$dateAct = new DateTime();  
					$date = $dateAct->format("Y-m-d h:i:s");  

					if($dateStudy->idCustomer=="" || $dateStudy->idProducto=="" || $dateStudy->idUser=="" || $dateStudy->firstName=="" || $dateStudy->lastName=="" || $dateStudy->idNumber==""){
						$this->deliver_responseStudy(200, "Debe registrar todos los campos requeridos.", $date, null);
					}else if(!empty($dateStudy)){
								
						$CustomerVal = Customer::model()->findByAttributes(['id'=>$dateStudy->idCustomer, 'customerGroupId'=>Customer::GROUP_CENET]);
						if($CustomerVal){
							if($CustomerVal->isActive==1){

								$validateProduct=CustomerProduct::model()->findByAttributes(['id'=>$dateStudy->idProducto, 'customerId'=>Customer::CUSTOMER_CENET]);
								if($validateProduct){

									$userVal = CustomerUser::model()->findByAttributes(['id'=> $dateStudy->idUser, 'customerId'=>$dateStudy->idCustomer]);
									
									if($userVal){
										$customerProduct=CustomerProduct::createproductmiplanilla($dateStudy->idProducto, $dateStudy->idCustomer);
										if($customerProduct->hasErrors()){
											$this->deliver_responseStudy(200, "No pudo asociar el producto al estudio.", $date, null); //.serialize($backgroundcheck->getErrors())
										}else{


											if (stristr($dateStudy->idNumber, 'CC') !== false) {
												$number = substr($dateStudy->idNumber, 2);
											} else if (stristr($dateStudy->idNumber, 'CE') !== false) {
												$number = $dateStudy->idNumber;
											} else if (stristr($dateStudy->idNumber, 'PA') !== false) {
												$type = 'PP';
												$number1 = substr($dateStudy->idNumber, 2);
												$number=$type.$number1;
											} else if (stristr($dateStudy->idNumber, 'PE') !== false) {
												$type = 'PEP';
												$number1 = substr($dateStudy->idNumber, 2);
												$number=$type.$number1;
											}else if (stristr($dateStudy->idNumber, 'PT') !== false) {
												$type = 'PPT';
												$number1 = substr($dateStudy->idNumber, 2);
												$number=$type.$number1;
											} else {
												$number = substr($dateStudy->idNumber, 2);
											}
			
											if($dateStudy->idIssueDated=="0001-01-01T00:00:00"){
												$idIssueDated="";
											}else{
												$idIssueDated=$dateStudy->idIssueDated;
											}

											$userVal = CustomerUser::model()->findByAttributes(['id'=>$dateStudy->idUser]);
											$attributes=[
												'customerId' =>$dateStudy->idCustomer,
												'customerProductId'=>$dateStudy->idProducto,
												'customerUserId'=> $dateStudy->idUser,
												'firstName'=> $dateStudy->firstName,
												'lastName'=> $dateStudy->lastName,
												'idNumber'=> $number,
												'datexpedition'=> "",
												'tels'=> $dateStudy->tels,
												'mobile'=> $dateStudy->mobile,
												'city'=> $dateStudy->city,
												'applyToPosition'=> $dateStudy->applyToPosition,
												'email'=> $dateStudy->email,
												'customerComments'=> $dateStudy->customerComments,
												'backgroundCheckStatusId'=>BackgroundCheckStatus::REQUESTED,
												'requestSystemId'=>RequestSystem::SALE_CHANNEL,
											];

											$backgroundcheck=BackgroundCheck::createBackgroundCheck($attributes, FALSE);

											if($backgroundcheck->hasErrors()){
												$this->deliver_responseStudy(200, "Error: No se creo el estudio.", $date, null); //.serialize($backgroundcheck->getErrors())
											}else{
												WebUser::logAccess("Creo el estudio con éxito.", $backgroundcheck->code, true, $userVal->username);
												$this->deliver_responseStudy(200, "Estudio creado con éxito.", $date, $backgroundcheck->code);
											}	
										}
									}else{
										$this->deliver_responseStudy(200, "El usuario no pertenece al cliente.", $date, $CustomerVal->id);
									}
								}else{
									$this->deliver_responseStudy(200, "El producto no esta asociado a este grupo de cliente.", $date, $CustomerVal->id);
								}
							}else{
								$this->deliver_responseStudy(200, "El cliente aun no se encuentra activo para crear un estudio seguridad.", $date, $CustomerVal->id);
							}
						}else{
							$this->deliver_responseStudy(200, "No se encuentra ningun cliente registrado con ese idCustomer.", $date, null);
						}
					}
					
				}else{
					$this->deliver_responseStudy(200, "Error: Incorrect username or password.", null, null);
				}
		}else{
			$this->deliver_responseStudy(400, "Permiso Denegado", null, null);
		}
	}

	public function actionaddDocumentToStudy(){

		$user = $this->getUsrMiplanilla();

    	if(true){

			if($user==true){		

					$dateReceived = file_get_contents("php://input");
                    $dateDocument = json_decode($dateReceived);

                    if(!empty($dateDocument)){
						
						$dateAct = new DateTime();  
						$date = $dateAct->format("Y-m-d h:i:s");  
						
						if($dateDocument->code=="" || $dateDocument->idUser==""){
							$this->deliver_responseStudy(200, "Debe registrar todos los campos requeridos.", $date, null);
						}else if(!empty($dateDocument->documents)){ 
							$userVal = CustomerUser::model()->findByAttributes(['id'=>$dateDocument->idUser]);

							$backgroundcheck= BackgroundCheck::model()->findByAttributes(['code'=>$dateDocument->code, 'customerUserId'=>$dateDocument->idUser]);

							if(!$backgroundcheck){
								$this->deliver_responseStudy(200, "Error no se encuentra el estudio con los datos ingresados.", $date, null);
							}else if($backgroundcheck->backgroundCheckStatusId==BackgroundCheckStatus::CANCELLED || $backgroundcheck->backgroundCheckStatusId==BackgroundCheckStatus::FINISHED){
								$this->deliver_responseStudy(200, "No puede ingresar archivos al estudio de seguridad.", $date, null);
							}else{
								foreach($dateDocument->documents as $data){

									if(empty($data->nombreDocument)) { 
										continue;
									}
									$nombredoc=$data->nombreDocument;
									$extension=$data->extension;
									$docBase64=$data->docBase64;
								
									$document= new Document();
									$document->documentStudyChannel($nombredoc, $extension, $docBase64, $backgroundcheck->id);	
								}

								if($document->hasErrors()){
									$this->deliver_responseStudy(200, "Error no pudo almacenar.", $date, null); //.serialize($document->getErrors())
								}else{
									WebUser::logAccess("Creo los documentos del estudio con éxito.", $dateDocument->code, true, $userVal->username);
									$this->deliver_responseStudy(200, "Documentos de estudio almacenados con éxito.", $date, null);
								}
							}
						}	
					}
					
				}else{
					$this->deliver_responseStudy(200, "Error: Incorrect username or password.", null, null);
				}
		}else{
			$this->deliver_responseStudy(400, "Permiso Denegado", null, null);
		}
	}

	public function actioncancelledStudy(){

		$user = $this->getUsrMiplanilla();

		if(true){

			if($user==true){		

			$dateAct = new DateTime();  
			$date = $dateAct->format("Y-m-d h:i:s");  

			$dateReceived = file_get_contents("php://input");
			$cancelledStudy = json_decode($dateReceived);

				if($cancelledStudy->code=="" || $cancelledStudy->idUser==""){
					$this->deliver_responseStudy(200, "Debe registrar todos los campos requeridos.", $date, null);
				}else if(!empty($cancelledStudy)){
					$backgroundcheck= BackgroundCheck::model()->findByAttributes(['code'=>$cancelledStudy->code, 'customerUserId'=>$cancelledStudy->idUser]);
					$userVal = CustomerUser::model()->findByAttributes(['id'=>$cancelledStudy->idUser]);

					if(!$backgroundcheck){
						$this->deliver_responseStudy(200, "Error no se encuentra el estudio con los datos ingresados.", $date, null);
					}else{
						$timeStudy=$backgroundcheck->getIsCancelarAviable();
						if($timeStudy==false){
							$this->deliver_responseStudy(200, "No se puede cancelar el estudio, porque supera el tiempo permitido para su cancelación.", $date, null);
						}else{
							$cancelledStudy=BackgroundCheck::getCancelledStudyChannel($cancelledStudy->code);
							if($cancelledStudy->hasErrors()){
								$this->deliver_responseStudy(200, "Error al cancelar el estudio.", $date, null);
							}else{
								WebUser::logAccess("Cancelo el estudio de seguridad.", $cancelledStudy->code, true, $userVal->username);
								$this->deliver_responseStudy(200, "Estudio cancelado con éxito.", $date, null);
							}
						}
					
					}
				}
			}else{
				$this->deliver_responseStudy(200, "Error: Incorrect username or password.", null, null);
			}
		}else{
			$this->deliver_responseStudy(400, "Permiso Denegado", null, null);
		}
	}

	function deliver_responseStudy($status, $status_message, $data, $code)
    {
		header("Content-Type:application/json");
        header("HTTP/1.1 $status $status_message");
        $response['status'] = $status;
        $response['status_Message'] = $status_message;
		if($code!=null){
			$response['code'] = $code;
		}
        $response['date'] = $data;
 
        $json_response = json_encode($response);
        echo $json_response;
		Yii::app()->end();
    }

	public function actiongetStudyEvents(){

		$user = $this->getUsrMiplanilla();

		if(true){

			if($user==true){		

					$dateAct = new DateTime();  
					$date = $dateAct->format("Y-m-d h:i:s");  

					$dateReceived = file_get_contents("php://input");
                    $eventsStudy = json_decode($dateReceived);

					if($eventsStudy->code=="" || $eventsStudy->idUser==""){
						$this->deliver_responseStudy(200, "Debe registrar todos los campos requeridos.", $date, null);
					}else if(!empty($eventsStudy)){
						$backgroundcheck= BackgroundCheck::model()->findByAttributes(['code'=>$eventsStudy->code, 'customerUserId'=>$eventsStudy->idUser]);

						if(!$backgroundcheck){
							$this->deliver_responseEvents(200, "Error no se encuentran datos del estudio.", $date, null);
						}else{
							$events = new Event;
							$userVal = CustomerUser::model()->findByAttributes(['id'=>$eventsStudy->idUser]);
							if($events){
								$EventsStudys = $events->getEventsStudy($eventsStudy->code);
								if($EventsStudys!=null){
									WebUser::logAccess("Consulto las novedades del estudio.", $eventsStudy->code, true, $userVal->username);
									$this->deliver_responseEvents(200, "Novedades del estudio.", $date, $EventsStudys);
								}else{
									$this->deliver_responseEvents(200, "El estudio no cuenta con novedades.", $date, null);
								}
							}
						}
					}
					
				}else{
					$this->deliver_responseEvents(200, "Error: Incorrect username or password.", null, null);
				}
		}else{
			$this->deliver_responseEvents(400, "Permiso Denegado", null, null);
		}
	}

	function deliver_responseEvents($status, $status_message, $data, $EventsStudys)
    {
		header("Content-Type:application/json");
        header("HTTP/1.1 $status $status_message");
        $response['status'] = $status;
        $response['status_Message'] = $status_message;

		if($EventsStudys!=null){
			foreach ($EventsStudys AS $event){
				$events[]=[
					'eventId'=>$event->id,
					'detail'=>$event->detail,
					'eventType'=>$event->eventType->name,
					'eventDelayType'=>$event->eventTypeNews->name,
					'eventdate'=>$event->informedToCustomerOn,
				];
			}
			$response['events'] = $events;
		}else{
			$response['events'] = $EventsStudys;
		}
        $response['date'] = $data;
 
        $json_response = json_encode($response);
        echo $json_response;
		Yii::app()->end();
    }

	public function actionupdateEvent(){

		$user = $this->getUsrMiplanilla();

		if(true){

			if($user==true){		

					$dateAct = new DateTime();  
					$date = $dateAct->format("Y-m-d h:i:s");  

					$dateReceived = file_get_contents("php://input");
                    $eventsUpdate = json_decode($dateReceived);

                    if($eventsUpdate->code=="" || $eventsUpdate->idUser=="" || $eventsUpdate->eventId=="" || $eventsUpdate->coments=="" || $eventsUpdate->ipComents==""){
						$this->deliver_responseEventsInsert(200, "Debe registrar todos los campos requeridos.", $date);
					}else if(!empty($eventsUpdate)){
						$backgroundcheck= BackgroundCheck::model()->findByAttributes(['code'=>$eventsUpdate->code, 'customerUserId'=>$eventsUpdate->idUser]);

						if(!$backgroundcheck){
							$this->deliver_responseEventsInsert(200, "Error no se encuentran datos del estudio.", $date);
						}else{
							$userVal = CustomerUser::model()->findByAttributes(['id'=>$eventsUpdate->idUser]);
							$event = Event::model()->findByPK($eventsUpdate->eventId);

							if(!$event){
								$this->deliver_responseEventsInsert(200, "Error no se encuentran datos con el eventId.", $date);
							}else{
								$dateAct = new DateTime();  
								$date = $dateAct->format("Y-m-d h:i:s");  

								$event->customerComment=$eventsUpdate->coments;
								$event->customerAnsweredOn=$date;
								$event->customerIp=$eventsUpdate->ipComents;

								if ($event->update()) {
									WebUser::logAccess("El cliente agrego el siguiente comentario en el estudio: ".$eventsUpdate->coments."", $eventsUpdate->code, true, $userVal->username);
									$this->deliver_responseEventsInsert(200, "Comentario de novedad ingresado con éxito.", $date);
								}else{
									$this->deliver_responseEventsInsert(200, "No pudo registrar el comentario a la novedad.", $date);
								}
							}
							
						}
					}
					
				}else{
					$this->deliver_responseEventsInsert(200, "Error: Incorrect username or password.", null);
				}
		}else{
			$this->deliver_responseEventsInsert(400, "Permiso Denegado", null);
		}
	}

	function deliver_responseEventsInsert($status, $status_message, $data)
    {
		header("Content-Type:application/json");
        header("HTTP/1.1 $status $status_message");
        $response['status'] = $status;
        $response['status_Message'] = $status_message;
        $response['date'] = $data;
 
        $json_response = json_encode($response);
        echo $json_response;
		Yii::app()->end();
    }

	public function actiongetStudyStatus(){

		$user = $this->getUsrMiplanilla();

		if(true){

			if($user==true){	

					$dateAct = new DateTime();  
					$date = $dateAct->format("Y-m-d h:i:s"); 

					$dateReceived = file_get_contents("php://input");
                    $statusStudys = json_decode($dateReceived);

					if($statusStudys->code=="" || $statusStudys->idUser==""){
						$this->deliver_responseStatustudy(200, "Debe registrar todos los campos requeridos.", $date);
					}else if(!empty($statusStudys)){
						$backgroundcheck= BackgroundCheck::model()->findByAttributes(['code'=>$statusStudys->code, 'customerUserId'=>$statusStudys->idUser]);

						if(!$backgroundcheck){
							$this->deliver_responseStatustudy(200, "Error no se encuentran datos del estudio.", $date);
						}else{
							$userVal = CustomerUser::model()->findByAttributes(['id'=>$statusStudys->idUser]);

							$dateAct = new DateTime();  
							$date = $dateAct->format("Y-m-d h:i:s");  

							$statusStudy=$backgroundcheck->backgroundCheckStatus->name;

							WebUser::logAccess("Consulto el estado del estudio.", $statusStudys->code, true, $userVal->username);
							$this->deliver_responseStatustudy(200, "El estudio se encuentra en estado: ".$statusStudy, $date);
						}
					}
					
				}else{
					$this->deliver_responseStatustudy(200, "Error: Incorrect username or password.", null);
				}
		}else{
			$this->deliver_responseStatustudy(400, "Permiso Denegado", null);
		}
	}

	function deliver_responseStatustudy($status, $status_message, $data)
    {
		header("Content-Type:application/json");
        header("HTTP/1.1 $status $status_message");
        $response['status'] = $status;
        $response['status_Message'] = $status_message;
        $response['date'] = $data;
 
        $json_response = json_encode($response);
        echo $json_response;
		Yii::app()->end();
    }

	public function actiongetReport(){

		$user = $this->getUsrMiplanilla();

		if(true){

			if($user==true){	

					$dateAct = new DateTime();  
					$date = $dateAct->format("Y-m-d h:i:s"); 

					$dateReceived = file_get_contents("php://input");
                    $finishReport = json_decode($dateReceived);

                    if($finishReport->code=="" || $finishReport->idUser==""){
						$this->deliver_responseStatustudy(200, "Debe registrar todos los campos requeridos.", $date, null);
					}else if(!empty($finishReport)){
						$backgroundcheck= BackgroundCheck::model()->findByAttributes(['code'=>$finishReport->code, 'customerUserId'=>$finishReport->idUser]);

						if(!$backgroundcheck){
							$this->deliver_responseReportfinish(200, "Error no se encuentran datos del estudio.", $date, null);
						}else if($backgroundcheck->backgroundCheckStatusId!=BackgroundCheckStatus::FINISHED){
							$this->deliver_responseReportfinish(200, "Error el reporte no puede ser generado porque el estudio aun no ha finalizado.", $date, null);
						}else{

							$customer = Customer::model()->findByAttributes(['id'=>$backgroundcheck->customerId]);
							if($customer){

								//$dateVal = new DateTime();  
								//$dateVal = $dateVal->format("Y-m-d");

								if($customer->dateValidation!=null || $customer->dateValidation!="0000-00-00"){
									$dateVal = new DateTime();  
									$fecha1 = $dateVal->format("Y-m-d");
									$dateVal2 = new DateTime();  
									$fecha2 = $dateVal2->format($customer->dateValidation);
									
									$diff = ((strtotime($fecha1)-strtotime($fecha2))/86400);
								}
								
								if($customer->dateValidation==null || $customer->dateValidation=="" || $customer->dateValidation=="0000-00-00"){
									$this->deliver_responseReportfinish(200, "El cliente no cuenta con fecha de validación, por favor comunicarse con la entidad.", $date, null);
								}else if($diff>365){
									$this->deliver_responseReportfinish(200, "Se debe realizar nuevamente la validación del cliente, ya que paso más de 1 año desde su registro: ".$customer->dateValidation.", por favor comunicarse con la entidad.", $date, null);
								}else{
									$userVal = CustomerUser::model()->findByAttributes(['id'=>$finishReport->idUser]);

									if($backgroundcheck->pagesPDF!=" "){
										$pages=$backgroundcheck->pagesPDF;
									}else{
										$pages=5;
									}
		
									$pdfData = $backgroundcheck->getBackgroundCheckReport($userVal->pdfPassword, true, $userVal->username, null, null, $pages, true);
		
									$b64Doc = base64_encode($pdfData);
		
									WebUser::logAccess("Genero reporte final del estudio de seguridad.", $finishReport->code, true, $userVal->username);
									$this->deliver_responseReportfinish(200, "Reporte final de estudio de seguridad.", $date, $b64Doc);

								}
							}
						}
					}
					
				}else{
					$this->deliver_responseReportfinish(200, "Error: Incorrect username or password.", null, null);
				}
		}else{
			$this->deliver_responseReportfinish(400, "Permiso Denegado", null, null);
		}
	}

	function deliver_responseReportfinish($status, $status_message, $data, $pdfData)
    {
		header("Content-Type:application/json");
        header("HTTP/1.1 $status $status_message");
        $response['status'] = $status;
        $response['status_Message'] = $status_message;
		$response['finish_report'] = $pdfData;
        $response['date'] = $data;
 
        $json_response = json_encode($response);
        echo $json_response;
		Yii::app()->end();
    }

}