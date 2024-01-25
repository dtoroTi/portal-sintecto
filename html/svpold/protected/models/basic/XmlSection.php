<?php

use XmlSection as GlobalXmlSection;

/**
 * This is the model class for table "{{XmlSection}}".
 *
 * The followings are the available columns in table '{{XmlSection}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $answer
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class XmlSection extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{XmlSection}}';
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
            array('answer', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, answer', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'verificationResult' => array(self::BELONGS_TO, 'VerificationResult', 'verificationResultId'),
            'verificationSection' => array(self::BELONGS_TO, 'VerificationSection', 'verificationSectionId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'verificationSectionId' => 'Sección de Verificación',
            'verificationResultId' => 'Estado de Verificación',
            'answer' => 'Respuesta',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('verificationSectionId', $this->verificationSectionId);
        $criteria->compare('verificationResultId', $this->verificationResultId);
        $criteria->compare('answer', $this->answer, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return XmlSection the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function createBasicRecords($verificationSectionId) {
        $xmlSection = new XmlSection;
        $xmlSection->verificationSectionId = $verificationSectionId;
        $xmlSection->verificationResultId = VerificationResult::PENDING;
        if (!$xmlSection->save()) {
            Yii::app()->user->setFlash('verificationSection', 'Error saving the xmlSection detial');
            Yii::log("Error Saving the verification section: " . serialize($xmlSection->getErrors()), "error", "ZWF." . __CLASS__);
        }
    }

    function getAnswerArray() {
        if ($this->answer != "") {
            @$ans = unserialize($this->answer);
            if ($ans === false || !is_array($ans)) {
                $ans = array();
            }
        } else {
            $ans = array();
        }
        return $ans;
    }

    public function afterSave() {
        parent::afterSave();
        $this->verificationSection->save();
        return;
    }


    public function getInsertInfTDXml($responseJSON, $bgcId, $refresh) {

        //$xmlQuestion = VerificationSectionType::model()->findByPK('24');
        if(empty($responseJSON)){ //isset($dateresponse2['sections']) && is_array($dateresponse2['sections'])
            Yii::app()->user->setFlash('backgroundCheck', 'No existe informacion en tus datos.');
        }else{
            $OfacYOnu="NO";
            $entControl="NO";
            $entPoliciales="NO";
            $otrosBoletines="NO";
            $boletinesDeudoresMorosos="NO";
            $registrosRamaJudicial="NO";
            $demandas="NO";
            $arrayVlr=[];
            if(!empty($responseJSON['dict_hallazgos']['altos'])){
                foreach($responseJSON['dict_hallazgos']['altos'] as $chAltos=>$dataAlt){
                    if(CHtml::encode($dataAlt['codigo'])=='lista_onu' || CHtml::encode($dataAlt['codigo'])=='ofac'){
                        $OfacYOnu="SI";
                    }
                    if(CHtml::encode($dataAlt['codigo'])=='contraloria' || CHtml::encode($dataAlt['fuente'])=='procuraduria'  || CHtml::encode($dataAlt['codigo'])=='fiscalia'){
                        $entControl="SI";
                    }
                    if(CHtml::encode($dataAlt['codigo'])=='policia' || CHtml::encode($dataAlt['codigo'])=='europol' || CHtml::encode($dataAlt['codigo'])=='interpol'){
                        $entPoliciales="SI";
                    }
                    if(CHtml::encode($dataAlt['codigo'])=='presidencia' || CHtml::encode($dataAlt['codigo'])=='superFinanciera' || CHtml::encode($dataAlt['codigo'])=='embajadas' || CHtml::encode($dataAlt['codigo'])=='fuerzasMilitares'){
                        $otrosBoletines="SI";
                    }
                    if(CHtml::encode($dataAlt['codigo'])=='contaduria'){
                        $boletinesDeudoresMorosos="SI";
                    }
                    if(CHtml::encode($dataAlt['fuente'])=='ramajepms'){
                        $registrosRamaJudicial="SI";
                    }
                    if(CHtml::encode($dataAlt['fuente'])=='juzgados_tyba'){
                        $demandas="SI";
                    }
                    
                }
            }

            if(!empty($responseJSON['dict_hallazgos']['medios'])){
                foreach($responseJSON['dict_hallazgos']['medios'] as $chMedios=>$dataMed){
                    if(CHtml::encode($dataMed['codigo'])=='lista_onu' || CHtml::encode($dataMed['codigo'])=='ofac'){
                        $OfacYOnu="SI";
                    }
                    if(CHtml::encode($dataMed['codigo'])=='contraloria' || CHtml::encode($dataMed['fuente'])=='procuraduria'  || CHtml::encode($dataMed['codigo'])=='fiscalia'){
                        $entControl="SI";
                    }
                    if(CHtml::encode($dataMed['codigo'])=='policia' || CHtml::encode($dataMed['codigo'])=='europol' || CHtml::encode($dataMed['codigo'])=='interpol' || CHtml::encode($dataMed['codigo'])=='noticias_criminales_denom'){
                        $entPoliciales="SI";
                    }
                    if(CHtml::encode($dataMed['codigo'])=='presidencia' || CHtml::encode($dataMed['codigo'])=='boletines' || CHtml::encode($dataMed['codigo'])=='peps_denom' || CHtml::encode($dataMed['codigo'])=='peps'){
                        $otrosBoletines="SI";
                    }
                    if(CHtml::encode($dataMed['codigo'])=='contaduria'){
                        $boletinesDeudoresMorosos="SI";
                    }
                    if(CHtml::encode($dataMed['fuente'])=='ramajepms'){
                        $registrosRamaJudicial="SI";
                    }
                    if(CHtml::encode($dataMed['fuente'])=='juzgados_tyba'){
                        $demandas="SI";
                    }
                    
                }
            }
            
            if($OfacYOnu=="SI" || $entControl=="SI" || $entPoliciales=="SI" || $otrosBoletines=="SI" || $boletinesDeudoresMorosos=="SI" || $registrosRamaJudicial=="SI" ||  $demandas=="SI"){

                $sinNovedad="NO";
                $arrayVlr=[
                    "OfacYOnu"=> $OfacYOnu, 
                    "Boe"=> "NO", 
                    "entControl"=>  $entControl,
                    "entPoliciales"=>  $entPoliciales, 
                    "otrosBoletines"=>  $otrosBoletines, 
                    "empresasFicticias"=>  "NO", 
                    "paraisosFiscales"=>  "NO", 
                    "boletinesDeudoresMorosos"=>  $boletinesDeudoresMorosos, 
                    "registrosRamaJudicial"=>  $registrosRamaJudicial,
                    "demandas"=>   $demandas, 
                    "sinNovedad"=>  $sinNovedad, 
                    "sinNovedadDet"=> "", 
                    "verificationResultId"=> "1" 
                ];
            }else{

                $sinNovedad="SI";
                $arrayVlr=[
                    "OfacYOnu"=> $OfacYOnu, 
                    "Boe"=> "NO", 
                    "entControl"=>  $entControl,
                    "entPoliciales"=>  $entPoliciales, 
                    "otrosBoletines"=>  $otrosBoletines, 
                    "empresasFicticias"=>  "NO", 
                    "paraisosFiscales"=>  "NO", 
                    "boletinesDeudoresMorosos"=>  $boletinesDeudoresMorosos, 
                    "registrosRamaJudicial"=>  $registrosRamaJudicial,
                    "demandas"=>   $demandas, 
                    "sinNovedad"=>  $sinNovedad, 
                    "sinNovedadDet"=> "Sin Novedades", 
                    "verificationResultId"=> "1" 
                ];
            }

            $xmlAns = array();
            foreach ($arrayVlr as $varName => $val) {
                if ($varName != 'verificationResultId') {
                    $xmlAns[CHtml::encode($varName)] = CHtml::encode($val);
                }
            }

            $answer = serialize($xmlAns);

            $verificationSec = VerificationSection::model()->findByAttributes(['backgroundCheckId' => $bgcId, 'verificationSectionTypeId' => '24']);

            $backgroundCheck = BackgroundCheck::model()->findByPK($bgcId);

            $detailXMLvlr = XmlSection::model()->findByAttributes(['verificationSectionId'=>$verificationSec->id]);
            if ($detailXMLvlr) {
                $detailXMLvlr->answer=$answer;
            }

            if (!$detailXMLvlr->update()) {
            }

            $commentTDalt="";
            $commentTDamed=""; 
            $errorfuentes="";
            $detalle='';
            $detalleTyba=[];
            $detallernmc="";
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
                    
                    if(!empty($responseJSON['errores']) && empty($responseJSON['dict_hallazgos']['altos']) && empty($responseJSON['dict_hallazgos']['medios'])){
                        if($value==false && $backgroundCheck->customer->manyAdvSources==0){
                            $verificationSec->percentCompleted=100;
                            $verificationSec->resultId=2;
                            if ($detailXMLvlr) {
                                $detailXMLvlr->verificationResultId = VerificationResult::VERIFIED;
                                if (!$detailXMLvlr->update()) {
                                }
                            }
                        }
                    }
                    if(empty($responseJSON['dict_hallazgos']['altos']) && empty($responseJSON['dict_hallazgos']['medios']) && empty($responseJSON['errores']) && $backgroundCheck->customer->manyAdvSources==0){
                        $verificationSec->percentCompleted=100;
                        $verificationSec->resultId=2;

                        if ($detailXMLvlr) {
                            $detailXMLvlr->verificationResultId = VerificationResult::VERIFIED;
                            if (!$detailXMLvlr->update()) {
                            }
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
                    $verificationSecAdv = VerificationSection::model()->findByAttributes(['backgroundCheckId' => $bgcId, 'verificationSectionTypeId' => '4']);

                    if(!$verificationSecAdv){
                        $verificationSec->comments=$sinHallazgo.$errorfuentes.$commentTDalt.$commentTDamed;
                    }else{
                        $verificationSec->comments='';
                    }
                   
                }

                if (!$verificationSec->update()) {
                }
            }
            
        }    
       //die();
    }
}
