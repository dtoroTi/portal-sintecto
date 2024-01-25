<?php

use DetailRegister as GlobalDetailRegister;

/**
 * This is the model class for table "{{DetailRegister}}".
 *
 * The followings are the available columns in table '{{DetailRegister}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property integer $required
 * @property string $name
 * @property string $verifiedOn
 * @property string $simit
 * @property string $runt
 * @property string $libreta_militar
 *
 * The followings are the available model relations:
 * @property VerificationSection $verificationSection
 * @property Verification $verification
 */
class DetailRegister extends SVPActiveRecord {

    const WITH_ADVERSE = 'A la fecha Presenta Adversos.';
    const WITHOUT_ADVERSE = 'A la fecha No Presenta Adversos.';

    public static function basicRegisters() {
        return array(
        );
    }

    public static function basicRegister($id) {
        $arr = DetailRegister::basicRegisters();
        if (isset($arr[$id])) {
            $ans = $arr[$id];
        } else {
            $ans = null;
        }
        return $ans;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DetailRegister the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{DetailRegister}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('verificationSectionId, verificationResultId', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 45),
            array('comments', 'length', 'max' => 255),
            array('simit, runt, libreta_militar', 'length', 'max'=>80),
            array('verifiedOn', 'length', 'max' => 10),
            array('required', 'boolean'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'verificationSection' => array(self::BELONGS_TO, 'VerificationSection', 'verificationSectionId'),
            'verificationResult' => array(self::BELONGS_TO, 'VerificationResult', 'verificationResultId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'verificationSectionId' => 'Verification Section',
            'verificationResultId' => 'Verification',
            'name' => 'Name',
            'simit' => 'Simit',
            'runt' => 'Runt',
            'libreta_militar' => 'Libreta Militar',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('verificationSectionId', $this->verificationSectionId);
        $criteria->compare('verificationResultId', $this->verificationResultId);
        $criteria->compare('required', $this->required);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('simit',$this->simit,true);
        $criteria->compare('runt',$this->runt,true);
        $criteria->compare('libreta_militar',$this->libreta_militar,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getHasEnoughData() {
        return ($this->name != "");
    }

    public function afterSave() {
        parent::afterSave();
        $this->verificationSection->save();
        return;
    }

    public static function createBasicRecords($verificationSectionId) {
        $values = array(
            'verificationSectionId' => $verificationSectionId,
            'verificationResultId' => VerificationResult::PENDING,
            'required' => TRUE,
                )
        ;
        $detailRegister = new DetailRegister;
        $detailRegister->verificationSectionId = $verificationSectionId;
        $detailRegister->verificationResultId = VerificationResult::PENDING;
        if (!$detailRegister->save()) {
        Yii::app()->user->setFlash('verificationSection', 'Error saving the Register detail ');
        Yii::log("Error Saving the verification section: " . serialize($detailRegister->getErrors()), "error", "ZWF." . __CLASS__);
        }
        /*$regNames = DetailRegister::basicRegisters();
        foreach ($regNames as $registerName) {
            $values['name'] = $registerName;
            $doc = new DetailRegister();
            $doc->attributes = $values;
            if (!$doc->save()) {
                Yii::app()->user->setFlash('verificationSection', serialize($doc->getErrors));
            }
        }*/
    }

    public function getComentAdvs($idSection, $val) {
        $models = VerificationSection::model()->findByAttributes(['id'=>$idSection]);

        if($val==0){
            $models->comments="No se encontraron coincidencias en registro público. "."\n".$models->comments;
        }else if($val==1){
            $models->comments="Se encontraron coincidencias en registro público. "."\n".$models->comments;
        }
		$models->update();

		WebUser::logAccess("Se realizo la actualización del comentario en la pestaña adversos.", $models->backgroundCheck->code);
		return true;
    }

    public function getInsertInfTD($responseJSON, $bgcId, $refresh) {
        $licensesRunt="";
        $totalSimur=0;
        if(empty($responseJSON)){ //isset($dateresponse2['sections']) && is_array($dateresponse2['sections'])
            Yii::app()->user->setFlash('backgroundCheck', 'No existe informacion en tus datos.');
        }else{
            //echo "multas: ".$responseJSON['simit']['total_multas'];
            $verificationSec = VerificationSection::model()->findByAttributes(['backgroundCheckId' => $bgcId, 'verificationSectionTypeId' => '4']);

            $backgroundCheck = BackgroundCheck::model()->findByPK($bgcId);

            //$detailRegister = new DetailRegister;
            $detailRegister = DetailRegister::model()->findByAttributes(['verificationSectionId'=>$verificationSec->id]);
            if ($detailRegister) {
                $detailRegister->verificationSectionId = $verificationSec->id;
                if($detailRegister->simit==null || $detailRegister->simit=='' || $refresh==1){
                    if(!empty($responseJSON['simur']) && $responseJSON['simur']!='Error'){
                        foreach($responseJSON['simur'] as $simur=>$smr){
                            if(isset($smr['Saldo'])){
                                $saldo = substr($smr['Saldo'], 0, -2);
                                $saldosmr=str_replace(["$",","], "", $saldo);
                            }else{
                                $saldosmr=0; 
                            }
                            if(isset($smr['Intereses'])){
                                $intereses = substr($smr['Intereses'], 0, -2);
                                $interesessmr=str_replace(["$",","], "", $intereses);
                            }else{
                                $interesessmr=0;
                            }
                        
                            $totalSimur=$totalSimur+$saldosmr+$interesessmr;
                        }
                    }
                    if(isset($responseJSON['simit']['total_multas']) && $responseJSON['simit']['total_multas']>0){
                        $totalMultas=CHtml::encode($responseJSON['simit']['total_multas']); //$totalSimur+
                        $detailRegister->simit='Posee multas por: $'.number_format($totalMultas);
                    }else{
                        if($totalSimur>0){
                            $detailRegister->simit='Posee multas por: $'.number_format($totalSimur);
                        }else{
                            $detailRegister->simit='No posee multas.';
                        }
                    }
                }
                if($detailRegister->runt==null || $detailRegister->runt=="" || $refresh==1){
                    if(!empty($responseJSON['runt_app']['licencia']['licencias'])){
                        foreach($responseJSON['runt_app']['licencia']['licencias'] as $licenses=>$data){
                            $detailRegister->runt=CHtml::encode($data['categoria']).':'.CHtml::encode($data['estado']).',';
                            $licensesRunt=$licensesRunt.$detailRegister->runt;
                        }
                    }else{
                            $licensesRunt='No inscrito';
                    }
                    $detailRegister->runt=$licensesRunt;
                }
                if($detailRegister->libreta_militar==null || $detailRegister->libreta_militar=='' || $refresh==1){
                    if(!empty($responseJSON['libretamilitar'])){
                        if(isset($responseJSON['libretamilitar']['clase'])){
                            $detailRegister->libreta_militar=CHtml::encode($responseJSON['libretamilitar']['clase']);
                        }else if(isset($responseJSON['libretamilitar']['info'])){
                            $detailRegister->libreta_militar=CHtml::encode($responseJSON['libretamilitar']['info']);
                        }else{
                            $detailRegister->libreta_militar=CHtml::encode(implode('', $responseJSON['libretamilitar']));
                        } 
                    }else{
                        $detailRegister->libreta_militar='N/A';
                    }
                }
                $detailRegister->verificationResultId = VerificationResult::PENDING;

                if (!$detailRegister->update()) {
                }
            }

            $commentTDalt="";
            $commentTDamed="";
            $errorfuentes="";
            $detalle='';
            $detalleTyba=[];
            $detallernmc='';
            $detalleprocd="";
            $detalleTybaSuj=""; 
            $sinHallazgo="";
            $detallernmcs=[];

            if($verificationSec){
                if($verificationSec->comments==null || $verificationSec->comments=='' || $refresh==1){
                    if(!empty($responseJSON['errores'])){
                        $cadena_fuentes= "Fuentes no disponibles: ".implode(', ', $responseJSON['errores'])."\n";
                        $errorfuentes=$cadena_fuentes;
                    }
                    if(empty($responseJSON['dict_hallazgos']['altos']) && empty($responseJSON['dict_hallazgos']['medios'])){
                        $sinHallazgo="No se encontraron coincidencias en registro público."."\n";
                    }

                    $codigoFuenteAlt="";
                    $codigoFuenteMed="";
                    $tybaName="juzgados tyba";
                    if(!empty($responseJSON['dict_hallazgos']['altos'])){
                        $procesosTybaAlt=0;
                        foreach($responseJSON['dict_hallazgos']['altos'] as $chAltos=>$dataAlt){
                            if($dataAlt['fuente']=='juzgados_tyba'){
                                $codigoFuenteAlt=$dataAlt['codigo'];
                                $procesosTybaAlt++;
                            }
                        }
                        $codigoFuenteAlt;
                        $procesosTybaAlt;
                    }

                    if(!empty($responseJSON['dict_hallazgos']['medios'])){
                        $procesosTybaMed=0;
                        foreach($responseJSON['dict_hallazgos']['medios'] as $chMedios=>$dataMed){
                            if($dataMed['fuente']=='juzgados_tyba'){
                                $codigoFuenteMed=$dataMed['codigo'];
                                $procesosTybaMed++;
                            }
                        }
                        $codigoFuenteMed;
                        $procesosTybaMed;
                    }

                    $isJepms='';
                    $isPolicia='';
                    $isProcuraduria='';
                    $isContaduria='';
                    $isRnmc='';
                    $isInpec='';
                    $isJuzgadostyba='';
                    $isSimit='';
                    $isLibretamilitar='';
                    $isInhabilidades='';
                    $isListaonu='';
                    $isOfac='';
                    $isInterpol='';
                    if($backgroundCheck->customer->isJepms==1){
                        $isJepms='jepms,';
                    }
                    if($backgroundCheck->customer->isPolicia==1){
                        $isPolicia='policia,';
                    }
                    if($backgroundCheck->customer->isProcuraduria==1){
                        $isProcuraduria='procuraduria,';
                    }
                    if($backgroundCheck->customer->isContaduria==1){
                        $isContaduria='contaduria,';
                    }
                    if($backgroundCheck->customer->isRnmc==1){
                        $isRnmc='rnmc,';
                    }
                    if($backgroundCheck->customer->isInpec==1){
                        $isInpec='inpec,';
                    }
                    if($backgroundCheck->customer->isJuzgadostyba==1){
                        $isJuzgadostyba='isjuzgadostyba,';
                    }
                    if($backgroundCheck->customer->isSimit==1){
                        $isSimit='simit,';
                    }
                    if($backgroundCheck->customer->isLibretamilitar==1){
                        $isLibretamilitar='libretamilitar,';
                    }
                    if($backgroundCheck->customer->isInhabilidades==1){
                        $isInhabilidades='inhabilidades,';
                    }
                    if($backgroundCheck->customer->isListaonu==1){
                        $isListaonu='listaonu,';
                    }
                    if($backgroundCheck->customer->isOfac==1){
                        $isOfac='ofac,';
                    }
                    if($backgroundCheck->customer->isInterpol==1){
                        $isInterpol='interpol,';
                    }

                    $fuentesSelect=$isJepms.$isPolicia.$isProcuraduria.$isContaduria.$isRnmc.$isInpec.$isJuzgadostyba.$isSimit.$isLibretamilitar.$isInhabilidades.$isListaonu.$isOfac.$isInterpol;
                    $fuentesErrosCustomer=$fuentesSelect;
                    $arrayDeCaracteres = explode(',', $fuentesErrosCustomer);
                    //var_dump($arrayDeCaracteres);

                    $fuentesErros=$responseJSON['errores'];
                    //var_dump($fuentesErros);
                    $str = ", " . implode(" ",$fuentesErros);
                    $jepms = substr_count($str, 'jepms');
                    $commonElements = array_intersect($fuentesErros, $arrayDeCaracteres);

                    if (!empty($commonElements) || ($backgroundCheck->customer->isJepms==1 && $jepms>3)) {
                        $value=true;
                    } else {
                        $value=false;
                    }

                    //Proceso para validar si cuenta con rnmc cuando tiene fecha expdicion
                    if(!empty($responseJSON['errores']) && empty($responseJSON['dict_hallazgos']['altos']) && empty($responseJSON['dict_hallazgos']['medios'])){
                        if($value==false && $backgroundCheck->customer->manyAdvSources==0 && $backgroundCheck->customer->isRnmc==1 && $backgroundCheck->datexpedition!=''){
                            $verificationSec->percentCompleted=100;
                            $verificationSec->resultId=2;
                            if ($detailRegister) {
                                $detailRegister->verificationResultId = VerificationResult::VERIFIED;
                                if (!$detailRegister->update()) {
                                }
                            }

                            $cadena1 =  Event::quitarAcentos($responseJSON['nombre']);
                            $cadena2 = Event::quitarAcentos($backgroundCheck->firstName.' '.$backgroundCheck->lastName);

                            // Eliminar espacios y comparar sin considerar mayúsculas, minúsculas ni tildes
                            if (strcasecmp(str_replace(' ', '', $cadena1), str_replace(' ', '', $cadena2)) == 0) {
                                echo "Las cadenas son iguales.";
                                Event::getDateEventsAdv($backgroundCheck->id, $backgroundCheck->code, $backgroundCheck->studyLimitOn);

                                //Yii::import('application.controllers.*');
                                $controlador = new DetailRegisterController('default');
                                $controlador->processSendMailAdv($backgroundCheck->id, $backgroundCheck->code);

                            } else {
                                echo "Las cadenas son diferentes.";
                            }
                        }
                    }
                    if(empty($responseJSON['dict_hallazgos']['altos']) && empty($responseJSON['dict_hallazgos']['medios']) && empty($responseJSON['errores']) && $backgroundCheck->customer->manyAdvSources==0 && $backgroundCheck->customer->isRnmc==1 && $backgroundCheck->datexpedition!=''){
                        $verificationSec->percentCompleted=100;
                        $verificationSec->resultId=2;
                        if ($detailRegister) {
                            $detailRegister->verificationResultId = VerificationResult::VERIFIED;
                            if (!$detailRegister->update()) {
                            }
                        }
                        $cadena1 =  Event::quitarAcentos($responseJSON['nombre']);
                        $cadena2 = Event::quitarAcentos($backgroundCheck->firstName.' '.$backgroundCheck->lastName);

                        // Eliminar espacios y comparar sin considerar mayúsculas, minúsculas ni tildes
                        if (strcasecmp(str_replace(' ', '', $cadena1), str_replace(' ', '', $cadena2)) == 0) {
                            echo "Las cadenas son iguales.";
                            Event::getDateEventsAdv($backgroundCheck->id, $backgroundCheck->code, $backgroundCheck->studyLimitOn);

                            //Yii::import('application.controllers.*');
                            $controlador = new DetailRegisterController('default');
                            $controlador->processSendMailAdv($backgroundCheck->id, $backgroundCheck->code);
                        } else {
                            echo "Las cadenas son diferentes.";
                        }
                    }

                    if(!empty($responseJSON['errores']) && empty($responseJSON['dict_hallazgos']['altos']) && empty($responseJSON['dict_hallazgos']['medios'])){
                        if($value==false && $backgroundCheck->customer->manyAdvSources==0 && $backgroundCheck->customer->isRnmc==0){
                            $verificationSec->percentCompleted=100;
                            $verificationSec->resultId=2;
                            if ($detailRegister) {
                                $detailRegister->verificationResultId = VerificationResult::VERIFIED;
                                if (!$detailRegister->update()) {
                                }
                            }

                            $cadena1 =  Event::quitarAcentos($responseJSON['nombre']);
                            $cadena2 = Event::quitarAcentos($backgroundCheck->firstName.' '.$backgroundCheck->lastName);

                            // Eliminar espacios y comparar sin considerar mayúsculas, minúsculas ni tildes
                            if (strcasecmp(str_replace(' ', '', $cadena1), str_replace(' ', '', $cadena2)) == 0) {
                                echo "Las cadenas son iguales.";
                                Event::getDateEventsAdv($backgroundCheck->id, $backgroundCheck->code, $backgroundCheck->studyLimitOn);

                                //Yii::import('application.controllers.*');
                                $controlador = new DetailRegisterController('default');
                                $controlador->processSendMailAdv($backgroundCheck->id, $backgroundCheck->code);

                            } else {
                                echo "Las cadenas son diferentes.";
                            }
                        }
                    }
                    if(empty($responseJSON['dict_hallazgos']['altos']) && empty($responseJSON['dict_hallazgos']['medios']) && empty($responseJSON['errores']) && $backgroundCheck->customer->manyAdvSources==0 && $backgroundCheck->customer->isRnmc==0){
                        $verificationSec->percentCompleted=100;
                        $verificationSec->resultId=2;
                        if ($detailRegister) {
                            $detailRegister->verificationResultId = VerificationResult::VERIFIED;
                            if (!$detailRegister->update()) {
                            }
                        }

                        $cadena1 =  Event::quitarAcentos($responseJSON['nombre']);
                        $cadena2 = Event::quitarAcentos($backgroundCheck->firstName.' '.$backgroundCheck->lastName);

                        // Eliminar espacios y comparar sin considerar mayúsculas, minúsculas ni tildes
                        if (strcasecmp(str_replace(' ', '', $cadena1), str_replace(' ', '', $cadena2)) == 0) {
                            echo "Las cadenas son iguales.";
                            Event::getDateEventsAdv($backgroundCheck->id, $backgroundCheck->code, $backgroundCheck->studyLimitOn);

                            //Yii::import('application.controllers.*');
                            $controlador = new DetailRegisterController('default');
                            $controlador->processSendMailAdv($backgroundCheck->id, $backgroundCheck->code);
                        } else {
                            echo "Las cadenas son diferentes.";
                        }
                    }
                    if(!empty($responseJSON['dict_hallazgos']['altos'])){
                        $commentTDaltt='HALLAZGOS ALTOS: '."\n";
                        foreach($responseJSON['dict_hallazgos']['altos'] as $chAltos=>$dataAlt){
                            
                            if(!empty($responseJSON['juzgados_tyba']) && $dataAlt['codigo']==$codigoFuenteAlt){
                                $verificationSec->comments='Registra en '.$tybaName.' '.$procesosTybaAlt.' Procesos'."\n";
                            }else if($dataAlt['codigo']!=$codigoFuenteAlt){
                                $verificationSec->comments='Registra en '.CHtml::encode($dataAlt['fuente']).':'.CHtml::encode($dataAlt['hallazgo'])."\n";
                            }else{
                                $verificationSec->comments=''; 
                            }

                            if(!empty($responseJSON['rama'][$dataAlt['codigo']])){
                                $detalles=[];
                                    foreach($responseJSON['rama'][$dataAlt['codigo']] as $process=>$datapro){
                                        if(isset($process)){
                                            $detalleCod='Codigo Proceso: '.CHtml::encode($process).", ";
                                        }else{
                                            $detalleCod='';
                                        }
                                        if(isset($datapro['delitos'])){
                                            $detalledel=' Delito: '.CHtml::encode($datapro['delitos']).", ";
                                        }else{
                                            $detalledel='';
                                        }
                                        if(isset($datapro['pena privativa de la libertad'])){
                                                if(isset($datapro['pena privativa de la libertad']['años'])){
                                                    $anios=CHtml::encode($datapro['pena privativa de la libertad']['años']);
                                                }else{
                                                    $anios=''; 
                                                }
                                                if(isset($datapro['pena privativa de la libertad']['meses'])){
                                                    $meses=CHtml::encode($datapro['pena privativa de la libertad']['meses']);
                                                }else{
                                                    $meses=''; 
                                                }
                                                if(isset($datapro['pena privativa de la libertad']['dias'])){
                                                    $dias=CHtml::encode($datapro['pena privativa de la libertad']['dias']);
                                                }else{
                                                    $dias=''; 
                                                }
                                            $detallepp=' Pena privativa de la libertad: '.$anios.' años,'.$meses.' meses,'.$dias.' días,';
                                        }else{
                                            $detallepp='';
                                        }
                                        if(isset($datapro['observaciones'])){
                                            $detalleob=CHtml::encode($datapro['observaciones']).", ";
                                        }else{
                                            $detalleob='';
                                        }
                                    $detallerama=$detalleCod.$detalledel.$detallepp.$detalleob."\n";
                                    $detalles[]=$detallerama;
                                }
                            }else{
                                $detalles=[];
                            }

                            $detalle = implode('', $detalles);


                            if(!empty($responseJSON['juzgados_tyba']) && $dataAlt['codigo']==$codigoFuenteAlt && $responseJSON['juzgados_tyba']!="Error"){
                                foreach($responseJSON['juzgados_tyba'] as $tyba=>$datatyba){

                                    if(isset($datatyba['Código Proceso'])){
                                        $detalleCodT=CHtml::encode($datatyba['Código Proceso']).", ";
                                    }else{
                                        $detalleCodT='';
                                    }
                                    if(isset($datatyba['Clase Proceso'])){
                                        $dataClase=CHtml::encode($datatyba['Clase Proceso']).", ";
                                    }else{
                                        $dataClase='';
                                    }
                                    if(isset($datatyba['Despacho'])){
                                        $datadesp=CHtml::encode($datatyba['Despacho']).", ";
                                    }else{
                                        $datadesp='';
                                    }

                                    if(!empty($datatyba['INFO PROCES0']['sujetos'])){
                                        foreach($datatyba['INFO PROCES0']['sujetos'] as $sujetos=>$sujeto){
                                            if(isset($sujeto['NÚMERO DE IDENTIFICACIÓN'])){
                                                $NumSujeto=str_replace (".", "", $sujeto['NÚMERO DE IDENTIFICACIÓN']);
                                                if($NumSujeto==$backgroundCheck->idNumber){
                                                    if(isset($sujeto['TIPO SUJETO'])){
                                                        $datatipoSuj=CHtml::encode($sujeto['TIPO SUJETO']).", ";
                                                    }else{
                                                        $datatipoSuj='';
                                                    }
                                                    if(isset($sujeto['FECHA REGISTRO'])){
                                                        $dataFechaReg=CHtml::encode($sujeto['FECHA REGISTRO']).", ";
                                                    }else{
                                                        $dataFechaReg='';
                                                    }
                                                    $detalleTybaSuj=$datatipoSuj.$dataFechaReg;
                                                }
                                            }
                                           
                                        }
                                    }
                                    $detalleTybaDate=$detalleCodT.$dataClase.$datadesp.$detalleTybaSuj."\n";
                                    $detalleTyba[]=$detalleTybaDate;
                                }
                            }else{
                                $detalleTyba=[];
                            }
                            $detailTybas = implode(', ', $detalleTyba);
                            
                            if(!empty($responseJSON['rnmc']) && isset($responseJSON['rnmc']) && $dataAlt['codigo']=='rnmc' && $responseJSON['rnmc']!="Error"){

                                foreach($responseJSON['rnmc'] as $rnmc=>$datarnmc){
                                    if(isset($datarnmc['rnmc_general'])){
                                            if(isset($datarnmc['rnmc_general']['fecha'])){
                                                $detalleFech='Fecha: '.CHtml::encode($datarnmc['rnmc_general']['fecha']).", ";
                                            }else{
                                                $detalleFech='';
                                            }
                                            if(isset($datarnmc['rnmc_general']['expendiente'])){
                                                $detalleExp='Expediente: '.CHtml::encode($datarnmc['rnmc_general']['expendiente']).", ";
                                            }else{
                                                $detalleExp='';
                                            }
                                    }else{
                                        if(isset($responseJSON['rnmc']['fecha'])){
                                            $detalleFech='Fecha: '.CHtml::encode($responseJSON['rnmc']['fecha']).", ";
                                        }else{
                                            $detalleFech='';
                                        }
                                        if(isset($responseJSON['rnmc']['expediente'])){
                                            $detalleExp='Expediente: '.CHtml::encode($responseJSON['rnmc']['expediente']).", ";
                                        }else{
                                            $detalleExp='';
                                        }
                                    }
                                    
                                    if(isset($datarnmc['rnmc_detalles'])){
                                        //foreach($responseJSON['rnmc']['rnmc_detalles'] as $rnmc=>$datarnmcdt){
                                            if(isset($datarnmc['rnmc_detalles']['articulo'])){
                                                $detalleArt='Articulo: '.CHtml::encode($datarnmc['rnmc_detalles']['articulo']).", ";
                                            }else{
                                                $detalleArt='';
                                            }
                                            if(isset($datarnmc['rnmc_detalles']['apelacion'])){
                                                $detalleApl='Apelacion: '.CHtml::encode($datarnmc['rnmc_detalles']['apelacion']).", ";
                                            }else{
                                                $detalleApl='';
                                            }
                                            if(isset($datarnmc['rnmc_detalles']['relato_hechos'])){
                                                $detalleHechos='Relato De Los Hechos: '.CHtml::encode($datarnmc['rnmc_detalles']['relato_hechos']).", ";
                                            }else{
                                                $detalleHechos='';
                                            }
                                        //}
                                    }else{
                                        if(isset($responseJSON['rnmc']['articulo'])){
                                            $detalleArt='Articulo: '.CHtml::encode($responseJSON['rnmc']['articulo']).", ";
                                        }else{
                                            $detalleArt='';
                                        }
                                        if(isset($responseJSON['rnmc']['apelacion'])){
                                            $detalleApl='Apelacion: '.CHtml::encode($responseJSON['rnmc']['apelacion']).", ";
                                        }else{
                                            $detalleApl='';
                                        }
                                        if(isset($responseJSON['rnmc']['relato_hechos'])){
                                            $detalleHechos='Relato De Los Hechos: '.CHtml::encode($responseJSON['rnmc']['relato_hechos']).", ";
                                        }else{
                                            $detalleHechos='';
                                        }
                                    }
                                    
                                    $detallernmcDate=$detalleFech.$detalleExp.$detalleArt.$detalleApl.$detalleHechos."\n";
                                    $detallernmcs[]=$detallernmcDate;
                                }
                                
                            }else{
                                $detallernmcs=[];
                            }

                            $detallernmc = implode('', $detallernmcs);

                            if(!empty($responseJSON['procuraduria']) && $dataAlt['fuente']=='procuraduria' && $responseJSON['procuraduria']!="Error"){

                                /*if(!empty($responseJSON['procuraduria'][0]["inhabilidades"])){
                                    $i=0;
                                }else if(!empty($responseJSON['procuraduria'][1]["inhabilidades"])){
                                    $i=1;
                                }*/

                                foreach($responseJSON['procuraduria'] as $proc=>$procurad){
                                    if(!empty($responseJSON['procuraduria'][$proc]["inhabilidades"])){
                                        foreach($responseJSON['procuraduria'][$proc]["inhabilidades"] as $procd=>$dataproc){ //['inhabilidades']
                                            if(isset($dataproc['SIRI'])){
                                                $detalleSiri='SIRI: '.CHtml::encode($dataproc['SIRI']).", ";
                                            }else{
                                                $detalleSiri='';
                                            }
                                            if(isset($dataproc['Inhabilidad legal'])){
                                                $inhabilidad='Inhabilidad legal: '.CHtml::encode($dataproc['Inhabilidad legal']).", ";
                                            }else{
                                                $inhabilidad='';
                                            }
                                            if(isset($dataproc['Fecha de inicio'])){
                                                $dataFI='Fecha de inicio: '.CHtml::encode($dataproc['Fecha de inicio']).", ";
                                            }else{
                                                $dataFI='';
                                            }
                                            if(isset($dataproc['Fecha fin'])){
                                                $dataFF='Fecha fin: '.CHtml::encode($dataproc['Fecha fin']).", ";
                                            }else{
                                                $dataFF='';
                                            }
                                            $detalleprocd=$detalleSiri.$inhabilidad.$dataFI.$dataFF."\n";
                                        }
                                    }
                                }
                            }else{
                                $detalleprocd='';
                            }
                            $commentTDalt=$commentTDalt.$verificationSec->comments.$detalle.$detailTybas.$detallernmc.$detalleprocd;
                        }
                        $commentTDalt=$commentTDaltt.$commentTDalt;
                    }

                    if(!empty($responseJSON['dict_hallazgos']['medios'])){
                        $commentTDamedt='HALLAZGOS MEDIOS: '."\n";
                        foreach($responseJSON['dict_hallazgos']['medios'] as $chMedios=>$dataMed){

                            if(!empty($responseJSON['juzgados_tyba']) && $dataMed['codigo']==$codigoFuenteMed){
                                $verificationSec->comments='Registra en '.$tybaName.' '.$procesosTybaMed.' Procesos'."\n";
                            }else if($dataMed['codigo']!=$codigoFuenteMed && $dataMed['fuente']!='juzgados_tyba'){
                                $verificationSec->comments='Registra en '.CHtml::encode($dataMed['fuente']).':'.CHtml::encode($dataMed['hallazgo'])."\n";
                            }else{
                                $verificationSec->comments=''; 
                            }
                           
                            if(!empty($responseJSON['rama'][$dataMed['codigo']])){
                                $detalles=[];
                                    foreach($responseJSON['rama'][$dataMed['codigo']] as $process=>$datapro){
                                        if(isset($process)){
                                            $detalleCod='Codigo Proceso: '.CHtml::encode($process).", ";
                                        }else{
                                            $detalleCod='';
                                        }
                                        if(isset($datapro['delitos'])){
                                            $detalledel=' Delito: '.CHtml::encode($datapro['delitos']).", ";
                                        }else{
                                            $detalledel='';
                                        }
                                        if(isset($datapro['pena privativa de la libertad'])){
                                                if(isset($datapro['pena privativa de la libertad']['años'])){
                                                    $anios=CHtml::encode($datapro['pena privativa de la libertad']['años']);
                                                }else{
                                                    $anios=''; 
                                                }
                                                if(isset($datapro['pena privativa de la libertad']['meses'])){
                                                    $meses=CHtml::encode($datapro['pena privativa de la libertad']['meses']);
                                                }else{
                                                    $meses=''; 
                                                }
                                                if(isset($datapro['pena privativa de la libertad']['dias'])){
                                                    $dias=CHtml::encode($datapro['pena privativa de la libertad']['dias']);
                                                }else{
                                                    $dias=''; 
                                                }
                                            $detallepp=' Pena privativa de la libertad: '.$anios.' años,'.$meses.' meses,'.$dias.' días,';
                                        }else{
                                            $detallepp='';
                                        }
                                        if(isset($datapro['observaciones'])){
                                            $detalleob=CHtml::encode($datapro['observaciones']).", ";
                                        }else{
                                            $detalleob='';
                                        }
                                    $detallerama=$detalleCod.$detalledel.$detallepp.$detalleob."\n";
                                    $detalles[]=$detallerama;
                                }
                            }else{
                                $detalles=[];
                            }

                            $detalle = implode('', $detalles);

                            if(!empty($responseJSON['juzgados_tyba']) && $dataMed['codigo']==$codigoFuenteMed && $responseJSON['juzgados_tyba']!="Error"){
                                foreach($responseJSON['juzgados_tyba'] as $tyba=>$datatyba){
                                    if(isset($datatyba['Código Proceso'])){
                                        $detalleCodT='Codigo Proceso: '.CHtml::encode($datatyba['Código Proceso']).", ";
                                    }else{
                                        $detalleCodT='';
                                    }
                                    if(isset($datatyba['Clase Proceso'])){
                                        $dataClase='Clase Proceso: '.CHtml::encode($datatyba['Clase Proceso']).", ";
                                    }else{
                                        $dataClase='';
                                    }
                                    if(isset($datatyba['Despacho'])){
                                        $datadesp='Despacho: '.CHtml::encode($datatyba['Despacho']).", ";
                                    }else{
                                        $datadesp='';
                                    }

                                    if(!empty($datatyba['INFO PROCES0']['sujetos']) && isset($datatyba['INFO PROCES0']['sujetos'])){
                                        foreach($datatyba['INFO PROCES0']['sujetos'] as $sujetos=>$sujeto){
                                            if(isset($sujeto['NÚMERO DE IDENTIFICACIÓN'])){
                                                $NumSujeto=str_replace (".", "", CHtml::encode($sujeto['NÚMERO DE IDENTIFICACIÓN']));
                                                if($NumSujeto==$backgroundCheck->idNumber){
                                                    if(isset($sujeto['TIPO SUJETO'])){
                                                        $datatipoSuj='Tipo Sujeto: '.CHtml::encode($sujeto['TIPO SUJETO']).", ";
                                                    }else{
                                                        $datatipoSuj='';
                                                    }
                                                    if(isset($sujeto['FECHA REGISTRO'])){
                                                        $dataFechaReg='Fecha Registro: '.CHtml::encode($sujeto['FECHA REGISTRO']).", ";
                                                    }else{
                                                        $dataFechaReg='';
                                                    }
                                                    $detalleTybaSuj=$datatipoSuj.$dataFechaReg;
                                                }
                                            }
                                           
                                        }
                                    }
                                    $detalleTybaDate=$detalleCodT.$dataClase.$datadesp.$detalleTybaSuj."\n";
                                    $detalleTyba[]=$detalleTybaDate;
                                }
                            }else{
                                $detalleTyba=[];
                            }
                            $detailTybas = implode('', $detalleTyba);

                            if(!empty($responseJSON['rnmc']) && isset($responseJSON['rnmc']) && $dataMed['codigo']=='rnmc' && $responseJSON['rnmc']!="Error"){

                                foreach($responseJSON['rnmc'] as $rnmc=>$datarnmc){
                                    if(isset($datarnmc['rnmc_general'])){
                                            if(isset($datarnmc['rnmc_general']['fecha'])){
                                                $detalleFech='Fecha: '.CHtml::encode($datarnmc['rnmc_general']['fecha']).", ";
                                            }else{
                                                $detalleFech='';
                                            }
                                            if(isset($datarnmc['rnmc_general']['expendiente'])){
                                                $detalleExp='Expediente: '.CHtml::encode($datarnmc['rnmc_general']['expendiente']).", ";
                                            }else{
                                                $detalleExp='';
                                            }
                                    }else{
                                        if(isset($responseJSON['rnmc']['fecha'])){
                                            $detalleFech='Fecha: '.CHtml::encode($responseJSON['rnmc']['fecha']).", ";
                                        }else{
                                            $detalleFech='';
                                        }
                                        if(isset($responseJSON['rnmc']['expediente'])){
                                            $detalleExp='Expediente: '.CHtml::encode($responseJSON['rnmc']['expediente']).", ";
                                        }else{
                                            $detalleExp='';
                                        }
                                    }
                                    
                                    if(isset($datarnmc['rnmc_detalles'])){
                                        //foreach($responseJSON['rnmc']['rnmc_detalles'] as $rnmc=>$datarnmcdt){
                                            if(isset($datarnmc['rnmc_detalles']['articulo'])){
                                                $detalleArt='Articulo: '.CHtml::encode($datarnmc['rnmc_detalles']['articulo']).", ";
                                            }else{
                                                $detalleArt='';
                                            }
                                            if(isset($datarnmc['rnmc_detalles']['apelacion'])){
                                                $detalleApl='Apelacion: '.CHtml::encode($datarnmc['rnmc_detalles']['apelacion']).", ";
                                            }else{
                                                $detalleApl='';
                                            }
                                            if(isset($datarnmc['rnmc_detalles']['relato_hechos'])){
                                                $detalleHechos='Relato De Los Hechos: '.CHtml::encode($datarnmc['rnmc_detalles']['relato_hechos']).", ";
                                            }else{
                                                $detalleHechos='';
                                            }
                                        //}
                                    }else{
                                        if(isset($responseJSON['rnmc']['articulo'])){
                                            $detalleArt='Articulo: '.CHtml::encode($responseJSON['rnmc']['articulo']).", ";
                                        }else{
                                            $detalleArt='';
                                        }
                                        if(isset($responseJSON['rnmc']['apelacion'])){
                                            $detalleApl='Apelacion: '.CHtml::encode($responseJSON['rnmc']['apelacion']).", ";
                                        }else{
                                            $detalleApl='';
                                        }
                                        if(isset($responseJSON['rnmc']['relato_hechos'])){
                                            $detalleHechos='Relato De Los Hechos: '.CHtml::encode($responseJSON['rnmc']['relato_hechos']).", ";
                                        }else{
                                            $detalleHechos='';
                                        }
                                    }
                                    
                                    $detallernmcDate=$detalleFech.$detalleExp.$detalleArt.$detalleApl.$detalleHechos."\n";
                                    $detallernmcs[]=$detallernmcDate;
                                }
                                
                            }else{
                                $detallernmcs=[];
                            }

                            $detallernmc = implode('', $detallernmcs);
                            
                            if(!empty($responseJSON['procuraduria']) && $dataMed['fuente']=='procuraduria' && $responseJSON['procuraduria']!="Error"){
                                /*if(!empty($responseJSON['procuraduria'][0]["inhabilidades"])){
                                    $i=0;
                                }else if(!empty($responseJSON['procuraduria'][1]["inhabilidades"])){
                                    $i=1;
                                }*/
                                foreach($responseJSON['procuraduria'] as $proc=>$procurad){ //procurad
                                    if(!empty($responseJSON['procuraduria'][$proc]["inhabilidades"])){
                                        foreach($responseJSON['procuraduria'][$proc]["inhabilidades"] as $procd=>$dataproc){ //['inhabilidades']
                                            if(isset($dataproc['SIRI'])){
                                                $detalleSiri='SIRI: '.CHtml::encode($dataproc['SIRI']).", ";
                                            }else{
                                                $detalleSiri='';
                                            }
                                            if(isset($dataproc['Inhabilidad legal'])){
                                                $inhabilidad='Inhabilidad legal: '.CHtml::encode($dataproc['Inhabilidad legal']).", ";
                                            }else{
                                                $inhabilidad='';
                                            }
                                            if(isset($dataproc['Fecha de inicio'])){
                                                $dataFI='Fecha de inicio: '.CHtml::encode($dataproc['Fecha de inicio']).", ";
                                            }else{
                                                $dataFI='';
                                            }
                                            if(isset($dataproc['Fecha fin'])){
                                                $dataFF='Fecha fin: '.CHtml::encode($dataproc['Fecha fin']).", ";
                                            }else{
                                                $dataFF='';
                                            }
                                            $detalleprocd=$detalleSiri.$inhabilidad.$dataFI.$dataFF."\n";
                                        }
                                    }
                                }
                            }else{
                                $detalleprocd='';
                            }

                            $commentTDamed=$commentTDamed.$verificationSec->comments.$detalle.$detailTybas.$detallernmc.$detalleprocd;
                        }

                        $commentTDamed=$commentTDamedt.$commentTDamed;
                    }
                    $verificationSec->comments=$sinHallazgo.$errorfuentes.$commentTDalt.$commentTDamed;
                }

                if (!$verificationSec->update()) {
                }
            }
        }
		return true;
    }
}