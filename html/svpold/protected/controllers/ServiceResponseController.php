<?php

class ServiceResponseController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	public function actionDarServicio(){
		$inicial = isset($_GET['inicial'])?$_GET['inicial']:"";
		$code = isset($_GET['code'])?$_GET['code']:"";
		$busqueda = isset($_GET['busqueda'])?$_GET['busqueda']:"";
		$estudio = BackgroundCheck::model()->find("code='$code'");
		$tipoid = $estudio->isCompanySurvey?2:1;
		if($inicial!=""){
			$this->renderJSON($this->darTiposServicio($tipoid));
			return;
		}
		if($tipoid!=2){
			$response=call_user_func_array(array($this, $busqueda),array($tipoid,$estudio->idNumber,$estudio->firstName." ".$estudio->lastName));
		}
		else { //empresas
			$response=call_user_func_array(array($this, $busqueda),array($tipoid,$estudio->idNumber,$estudio->lastName));
		}
		$servicioresp = ServiceResponse::model()->find("code='$code'&&tipo='$busqueda'");
		
		if($servicioresp==NULL){
			$servicioresp = new ServiceResponse;
			$servicioresp->code = $code;
			$servicioresp->tipo = $busqueda;
			$servicioresp->response = json_encode($response);
			$servicioresp->timestamp = strtotime("now");
			WebUser::logAccess("Service:".var_export($servicioresp,true) , $code);
			$ok = $servicioresp->save();
			WebUser::logAccess("Service:".var_export($servicioresp->getErrors(),true) , $code);
		}
		$this->renderJSON($response);
	}

	public function darTiposServicio($tipoid){

		$servicios = array();
		if($tipoid != 2){
			$servicios['buscarDatosBasicos']='Consultando datos básicos';
			$servicios['buscarPeps']='Consultando Listas restrictivas PEPs';
			//Personas relacionadas
			$servicios['buscarProcuraduria']='Consultando datos Procuraduría';
			$servicios['buscarPolicia']='Consultando datos Policías';
			$servicios['buscarContaduria']='Consultando datos Contaduría';
			$servicios['buscarContraloria']='Consultando datos Contraloría';
			$servicios['buscarNovedadesCamara']='Consultando Novedades Cámara';
			$servicios['buscarFosyga']='Consultando datos Fosyga';
			$servicios['buscarSispro']='Consultando datos SISPRO';
			$servicios['buscarDemandas']='Consultando demandas';
			$servicios['buscarSisben']='Consultando datos SISBEN';
			$servicios['consultaTransUnion']='Consultando Trans Union';
		}
		else { //empresas
			$servicios['buscarDatosBasicos']='Consultando datos básicos';
			$servicios['buscarDian']='Consultando datos DIAN';
			$servicios['buscarPeps']='Consultando Listas restrictivas PEPs';
			//Personas relacionadas
			$servicios['buscarContaduria']='Consultando datos Contaduría';
			$servicios['buscarContraloria']='Consultando datos Contraloría';
			//Importaciones
			//Datos Cámara
			$servicios['buscarNovedadesCamara']='Consultando Novedades Cámara';
			//Superintendencia de sociedades
			$servicios['buscarDemandas']='Consultando demandas';
		}
		return $servicios;
	}

	function verificarPersona($estudio){
		/*Verifica datos básicos*/
		$servicio = ServiceResponse::model()->find("code='$estudio->code'&&tipo='buscarDatosBasicos'");
		if(!$servicio){

		}
	}

	public function buscarContaduria($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarContaduria', array($busqueda));
		return $response;
	}

	public function buscarContraloria($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarContraloria', array($busqueda));
		return $response;
	}

	public function buscarDatosBasicos($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarDatosBasicos', array($busqueda));
		return $response;
	}

	public function buscarDemandas($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
					'Pagina'=>1,
					'IncluirDemandasComoActor'=>1,
					'IncluirCiviles'=>1,
					'IncluirLaborales'=>1,
					'IncluirFamiliares'=>1,
					'IncluirPenales'=>1,
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarDemandas', array($busqueda));
		return $response;
	}

	public function buscarDian($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarDian', array($busqueda));
		return $response;
	}

	public function buscarEsal($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarEsal', array($busqueda));
		return $response;
	}

	public function buscarFosyga($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarFosyga', array($busqueda));
		return $response;
	}

	public function buscarInfoexterna($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarInfoexterna', array($busqueda));
		return $response;
	}

	public function buscarListas($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarListas', array($busqueda));
		return $response;
	}


	public function buscarNoticias($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>0, //CC
					'NumeroIdentificacion'=>0,
					'Denominacion'=>$denominacion,
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarNoticias', array($busqueda));
		return $response;
	}

	public function buscarNovedadesCamara($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarNovedadesCamara', array($busqueda));
		return $response;
	}

	public function buscarPeps($tipoid,$id,$denominacion=''){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarPeps', array($busqueda));
		return $response;
	}

	public function buscarPolicia($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarPolicia', array($busqueda));
		return $response;
	}

	public function buscarProcuraduria($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarProcuraduria', array($busqueda));
		return $response;
	}

	public function buscarRnt($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarRnt', array($busqueda));
		return $response;
	}

	public function buscarRue($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarRue', array($busqueda));
		return $response;
	}


	public function buscarRup($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarRup', array($busqueda));
		return $response;
	}

	public function buscarSigep($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>0, //CC
					'NumeroIdentificacion'=>0,
					'Denominacion'=>$denominacion,
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarSigep', array($busqueda));
		return $response;
	}

	public function buscarSimit($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarSimit', array($busqueda));
		return $response;
	}

	public function buscarSisben($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarSisben', array($busqueda));
		return $response;
	}

	public function buscarSispro($tipoid,$id,$denominacion){
		$soapclient = new SoapClient(URLSOAP);
		//Use the functions of the client, the params of the function are in 
		//the associative array
		$params = array('Usuario'=>USRSOAP,
					'Password'=>PWSOAP,
					'IdClienteInterno'=>'',
					'IdTipoIdentificacion'=>$tipoid, //CC o NIT
					'NumeroIdentificacion'=>$id,
					'Denominacion'=>'',
					'Tag'=>'',
				);
		$busqueda = array('busqueda' => $params);
		$response = $soapclient->__soapCall('buscarSispro', array($busqueda));
		return $response;
	}

	public function consultaTransUnion($tipoid,$id){
		$service_url = URLRESTTU;
		$curl = curl_init($service_url);

		$curl_post_data = "Codigo=154&Numero=" . $id . "&Motivo=17&TipoIdentificacion=" . $tipoid;

		var_export($curl_post_data);

		$headers = [
		    'Content-Type: application/x-www-form-urlencoded',
		];

		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
		    $info = curl_getinfo($curl);
		    curl_close($curl);
		    die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}
		curl_close($curl);
		$curl_response = substr($curl_response, 1, -1);
		$curl_response = str_replace("\\r\\n",'', $curl_response);
		$curl_response = str_replace("\\",'', $curl_response);

		$decoded = json_decode($curl_response);

		return $decoded;		
	}

}