<?php

/**
 * This is the model class for table "{{DetailCompanyFinantialAnalys}}".
 *
 * The followings are the available columns in table '{{DetailCompanyFinantialAnalys}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $dateLastBalanceSheet
 * @property string $dateLastBalanceSheet_1
 * @property string $dateLastBalanceSheet_2
 * @property string $lastBalanceSheet
 * @property string $liabilities
 * @property string $sanctions
 * @property integer $totalOperatingIncome
 * @property string $totalOperatingIncome_1
 * @property string $profitsBeforeTax
 * @property string $profitsBeforeTax_1
 * @property string $laborPersonnelExpenses
 * @property string $laborPersonnelExpenses_1
 * @property string $financialCharges
 * @property string $financialCharges_1
 * @property string $totalActive
 * @property string $totalActive_1
 * @property string $totalCurrentActive
 * @property string $totalCurrentActive_1
 * @property string $totalCurrentLiabilities
 * @property string $totalCurrentLiabilities_1
 * @property string $totalNetWorth
 * @property string $totalNetWorth_1
 * @property string $liability
 * @property string $liability_1
 * @property string $totalLiability
 * @property string $totalLiability_1
 * @property string $operationalUtility
 * @property string $operationalUtility_1
 * @property string $profitsAfterTax
 * @property string $profitsAfterTax_1
 * @property string $financialObligations
 * @property string $financialObligations_1
 * @property string $totalNonOperationalExpenses
 * @property string $totalNonOperationalExpenses_1
 * @property string $sellsVsNetResults
 * @property string $sellsVsNetResults_1
 * @property integer $activoDisponible_0
 * @property integer $activoDisponible_1
 * @property integer $activoDisponible_2
 * @property integer $activoClientes_0
 * @property integer $activoClientes_1
 * @property integer $activoClientes_2
 * @property integer $activoAnticiposYAvances_0
 * @property integer $activoAnticiposYAvances_1
 * @property integer $activoAnticiposYAvances_2
 * @property integer $activoInventarios_0
 * @property integer $activoInventarios_1
 * @property integer $activoInventarios_2
 * @property integer $activoInversionesCP_0
 * @property integer $activoInversionesCP_1
 * @property integer $activoInversionesCP_2
 * @property integer $activoPropiedadPlantaYEquipo_0
 * @property integer $activoPropiedadPlantaYEquipo_1
 * @property integer $activoPropiedadPlantaYEquipo_2
 * @property integer $activoDepreciación_0
 * @property integer $activoDepreciación_1
 * @property integer $activoDepreciación_2
 * @property integer $activoInversionesLP_0
 * @property integer $activoInversionesLP_1
 * @property integer $activoInversionesLP_2
 * @property integer $activoIntangibles_0
 * @property integer $activoIntangibles_1
 * @property integer $activoIntangibles_2
 * @property integer $activoValorizaciones_0
 * @property integer $activoValorizaciones_1
 * @property integer $activoValorizaciones_2
 * @property integer $pasivoObligacionesFinancierasCP_0
 * @property integer $pasivoObligacionesFinancierasCP_1
 * @property integer $pasivoObligacionesFinancierasCP_2
 * @property integer $pasivoProveedores_0
 * @property integer $pasivoProveedores_1
 * @property integer $pasivoProveedores_2
 * @property integer $pasivoCXP_0
 * @property integer $pasivoCXP_1
 * @property integer $pasivoCXP_2
 * @property integer $pasivoImpuestosYTasas_0
 * @property integer $pasivoImpuestosYTasas_1
 * @property integer $pasivoImpuestosYTasas_2
 * @property integer $pasivoObligacionesLaborales_0
 * @property integer $pasivoObligacionesLaborales_1
 * @property integer $pasivoObligacionesLaborales_2
 * @property integer $pasivoProvisiones_0
 * @property integer $pasivoProvisiones_1
 * @property integer $pasivoProvisiones_2
 * @property integer $pasivoObligacionesFinancierasLP_0
 * @property integer $pasivoObligacionesFinancierasLP_1
 * @property integer $pasivoObligacionesFinancierasLP_2
 * @property integer $pasivoProveedoresLP_0
 * @property integer $pasivoProveedoresLP_1
 * @property integer $pasivoProveedoresLP_2
 * @property integer $pasivoCXPLP_0
 * @property integer $pasivoCXPLP_1
 * @property integer $pasivoCXPLP_2
 * @property integer $pasivoImpuestosYTasasLP_0
 * @property integer $pasivoImpuestosYTasasLP_1
 * @property integer $pasivoImpuestosYTasasLP_2
 * @property integer $pasivoObligacionesLaboralesLP_0
 * @property integer $pasivoObligacionesLaboralesLP_1
 * @property integer $pasivoObligacionesLaboralesLP_2
 * @property integer $pasivoProvisionesLP_0
 * @property integer $pasivoProvisionesLP_1
 * @property integer $pasivoProvisionesLP_2
 * @property integer $patrimonioCapitalSocial_0
 * @property integer $patrimonioCapitalSocial_1
 * @property integer $patrimonioCapitalSocial_2
 * @property integer $patrimonioReservaSocial_0
 * @property integer $patrimonioReservaSocial_1
 * @property integer $patrimonioReservaSocial_2
 * @property integer $patrimonioResultadoEjercicio_0
 * @property integer $patrimonioResultadoEjercicio_1
 * @property integer $patrimonioResultadoEjercicio_2
 * @property integer $patrimonioResultadoEjerciciosAnteriores_0
 * @property integer $patrimonioResultadoEjerciciosAnteriores_1
 * @property integer $patrimonioResultadoEjerciciosAnteriores_2
 * @property integer $patrimonioSuperavitPorValorizaciones_0
 * @property integer $patrimonioSuperavitPorValorizaciones_1
 * @property integer $patrimonioSuperavitPorValorizaciones_2
 * @property integer $patrimonioFondoDestinacionEspecifica_0
 * @property integer $patrimonioFondoDestinacionEspecifica_1
 * @property integer $patrimonioFondoDestinacionEspecifica_2
 * @property integer $estadoIngresosOperacionales_0
 * @property integer $estadoIngresosOperacionales_1
 * @property integer $estadoIngresosOperacionales_2
 * @property integer $estadoCostoDeVenta_0
 * @property integer $estadoCostoDeVenta_1
 * @property integer $estadoCostoDeVenta_2
 * @property integer $estadoUtilidadBruta_0
 * @property integer $estadoUtilidadBruta_1
 * @property integer $estadoUtilidadBruta_2
 * @property integer $estadoGastosOperacionalesAdmon_0
 * @property integer $estadoGastosOperacionalesAdmon_1
 * @property integer $estadoGastosOperacionalesAdmon_2
 * @property integer $estadoDepreciación_0
 * @property integer $estadoDepreciación_1
 * @property integer $estadoDepreciación_2
 * @property integer $estadoAmortización_0
 * @property integer $estadoAmortización_1
 * @property integer $estadoAmortización_2
 * @property integer $estadoGastosOperacionalesVenta_0
 * @property integer $estadoGastosOperacionalesVenta_1
 * @property integer $estadoGastosOperacionalesVenta_2
 * @property integer $estadoIngresosNoOperacionales_0
 * @property integer $estadoIngresosNoOperacionales_1
 * @property integer $estadoIngresosNoOperacionales_2
 * @property integer $estadoGastosNoOperacionales_0
 * @property integer $estadoGastosNoOperacionales_1
 * @property integer $estadoGastosNoOperacionales_2
 * @property integer $estadoInteresesBancarios_0
 * @property integer $estadoInteresesBancarios_1
 * @property integer $estadoInteresesBancarios_2
 * @property integer $impuestoDeRenta_0
 * @property integer $impuestoDeRenta_1
 * @property integer $impuestoDeRenta_2
 * @property integer depositosExigiblesCP_0
 * @property integer depositosExigiblesCP_1
 * @property integer depositosExigiblesLP_0
 * @property integer depositosExigiblesLP_1
 * @property integer $fondosSociales_0
 * @property integer $fondosSociales_1
 * @property integer $fondosSociales_2
 * @property integer $otrosActivosCorrientes_0
 * @property integer $otrosActivosCorrientes_1
 * @property integer $otrosActivosCorrientes_2
 * @property integer $otrosNoActivosCorrientes_0
 * @property integer $otrosNoActivosCorrientes_1
 * @property integer $otrosNoActivosCorrientes_2
 * @property integer $otrosPasivosCorrientes_0
 * @property integer $otrosPasivosCorrientes_1
 * @property integer $otrosPasivosCorrientes_2
 * @property integer $otrosPasivosNoCorrientes_0
 * @property integer $otrosPasivosNoCorrientes_1
 * @property integer $otrosPasivosNoCorrientes_2
 * @property integer $fondosSocialesCP_0
 * @property integer $fondosSocialesCP_1
 * @property integer $fondosSocialesCP_2
* @property integer $auditedFinancialfigures
 * @property integer $consolidatedFinancialStatements
 * @property integer $currency
 * @property integer $privacy
 * @property integer $financialSource 
 * @property integer $auditedFinancialfigures_1
 * @property integer $consolidatedFinancialStatements_1
 * @property integer $currency_1
 * @property integer $privacy_1
 * @property integer $financialSource_1
 * @property integer $kContratacion
 * @property integer $kEjecucion
 * 
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */

class DetailCompanyFinantialAnalys extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{DetailCompanyFinantialAnalys}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('kContratacion', 'numerical', 'integerOnly' => false),
            array('verificationSectionId, verificationResultId', 'numerical', 'integerOnly' => true),
            array('activoDisponible_0, activoDisponible_1, activoDisponible_2, activoClientes_0, activoClientes_1, activoClientes_2, '.
            'activoAnticiposYAvances_0, activoAnticiposYAvances_1, activoAnticiposYAvances_2, activoInventarios_0, activoInventarios_1, activoInventarios_2, '.
            'activoInversionesCP_0, activoInversionesCP_1, activoInversionesCP_2, activoPropiedadPlantaYEquipo_0, activoPropiedadPlantaYEquipo_1, activoPropiedadPlantaYEquipo_2, '.
            'activoDepreciacion_0, activoDepreciacion_1, activoDepreciacion_2, activoInversionesLP_0, activoInversionesLP_1, activoInversionesLP_2, '.
            'activoIntangibles_0, activoIntangibles_1, activoIntangibles_2, activoValorizaciones_0, activoValorizaciones_1, activoValorizaciones_2, '.
            'pasivoObligacionesFinancierasCP_0, pasivoObligacionesFinancierasCP_1, pasivoObligacionesFinancierasCP_2, pasivoProveedores_0, pasivoProveedores_1, pasivoProveedores_2, '.
            'pasivoCXP_0, pasivoCXP_1, pasivoCXP_2, pasivoImpuestosYTasas_0, pasivoImpuestosYTasas_1, pasivoImpuestosYTasas_2, '.
            'pasivoObligacionesLaborales_0, pasivoObligacionesLaborales_1, pasivoObligacionesLaborales_2, pasivoProvisiones_0, pasivoProvisiones_1, pasivoProvisiones_2, '.
            'depositosExigiblesCP_0,depositosExigiblesCP_1,depositosExigiblesLP_0,depositosExigiblesLP_1, depositosExigiblesCP_2, depositosExigiblesLP_2,'.
            'fondosSociales_0, fondosSociales_1, fondosSociales_2,'.
            'pasivoObligacionesFinancierasLP_0, pasivoObligacionesFinancierasLP_1, pasivoObligacionesFinancierasLP_2, pasivoProveedoresLP_0, pasivoProveedoresLP_1, pasivoProveedoresLP_2, '.
            'pasivoCXPLP_0, pasivoCXPLP_1, pasivoCXPLP_2, pasivoImpuestosYTasasLP_0, pasivoImpuestosYTasasLP_1, pasivoImpuestosYTasasLP_2, '.
            'pasivoObligacionesLaboralesLP_0, pasivoObligacionesLaboralesLP_1, pasivoObligacionesLaboralesLP_2, pasivoProvisionesLP_0, pasivoProvisionesLP_1, pasivoProvisionesLP_2, '.
            'patrimonioCapitalSocial_0, patrimonioCapitalSocial_1, patrimonioCapitalSocial_2, patrimonioReservaSocial_0, patrimonioReservaSocial_1, patrimonioReservaSocial_2, '.
            'patrimonioResultadoEjercicio_0, patrimonioResultadoEjercicio_1, patrimonioResultadoEjercicio_2, patrimonioResultadoEjerciciosAnteriores_0, patrimonioResultadoEjerciciosAnteriores_1, patrimonioResultadoEjerciciosAnteriores_2, '.
            'patrimonioSuperavitPorValorizaciones_0, patrimonioSuperavitPorValorizaciones_1, patrimonioSuperavitPorValorizaciones_2, estadoIngresosOperacionales_0, estadoIngresosOperacionales_1, estadoIngresosOperacionales_2, '.
            'estadoCostoDeVenta_0, estadoCostoDeVenta_1, estadoCostoDeVenta_2, estadoUtilidadBruta_0, estadoUtilidadBruta_1, estadoUtilidadBruta_2, '.
            'estadoGastosOperacionalesAdmon_0, estadoGastosOperacionalesAdmon_1, estadoGastosOperacionalesAdmon_2, estadoDepreciacion_0, estadoDepreciacion_1, estadoDepreciacion_2, '.
            'estadoAmortizacion_0, estadoAmortizacion_1, estadoAmortizacion_2, estadoGastosOperacionalesVenta_0, estadoGastosOperacionalesVenta_1, estadoGastosOperacionalesVenta_2, '.
            'otrosActivosCorrientes_0, otrosNoActivosCorrientes_0, otrosPasivosCorrientes_0, otrosPasivosNoCorrientes_0,'.
            'otrosActivosCorrientes_1, otrosNoActivosCorrientes_1, otrosPasivosCorrientes_1, otrosPasivosNoCorrientes_1,'.
            'otrosActivosCorrientes_2, otrosNoActivosCorrientes_2, otrosPasivosCorrientes_2, otrosPasivosNoCorrientes_2,'.
            'fondosSocialesCP_0, fondosSocialesCP_1, fondosSocialesCP_2, '.
            'patrimonioFondoDestinacionEspecifica_0, patrimonioFondoDestinacionEspecifica_1, patrimonioFondoDestinacionEspecifica_2,'.
            ' kEjecucion, ' .
            'estadoIngresosNoOperacionales_0, estadoIngresosNoOperacionales_1, estadoIngresosNoOperacionales_2, estadoGastosNoOperacionales_0, estadoGastosNoOperacionales_1, estadoGastosNoOperacionales_2, '.
            'estadoInteresesBancarios_0, estadoInteresesBancarios_1, estadoInteresesBancarios_2, impuestoDeRenta_0, impuestoDeRenta_1, impuestoDeRenta_2', 'numerical', 'integerOnly' => true),
            
            array('id, dateLastBalanceSheet, dateLastBalanceSheet_1, dateLastBalanceSheet_2,  lastBalanceSheet_1, lastBalanceSheet, liabilities,'.
            'activoDisponible_0, activoDisponible_1, activoDisponible_2, activoClientes_0, activoClientes_1, activoClientes_2, '.
            'activoAnticiposYAvances_0, activoAnticiposYAvances_1, activoAnticiposYAvances_2, activoInventarios_0, activoInventarios_1, activoInventarios_2, '.
            'activoInversionesCP_0, activoInversionesCP_1, activoInversionesCP_2, activoPropiedadPlantaYEquipo_0, activoPropiedadPlantaYEquipo_1, activoPropiedadPlantaYEquipo_2, '.
            'activoDepreciacion_0, activoDepreciacion_1, activoDepreciacion_2, activoInversionesLP_0, activoInversionesLP_1, activoInversionesLP_2, '.
            'activoIntangibles_0, activoIntangibles_1, activoIntangibles_2, activoValorizaciones_0, activoValorizaciones_1, activoValorizaciones_2, '.
            'pasivoObligacionesFinancierasCP_0, pasivoObligacionesFinancierasCP_1, pasivoObligacionesFinancierasCP_2, pasivoProveedores_0, pasivoProveedores_1, pasivoProveedores_2, '.
            'pasivoCXP_0, pasivoCXP_1, pasivoCXP_2, pasivoImpuestosYTasas_0, pasivoImpuestosYTasas_1, pasivoImpuestosYTasas_2, '.
            'pasivoObligacionesLaborales_0, pasivoObligacionesLaborales_1, pasivoObligacionesLaborales_2, pasivoProvisiones_0, pasivoProvisiones_1, pasivoProvisiones_2, '.
            'depositosExigiblesCP_0,depositosExigiblesCP_1,depositosExigiblesLP_0,depositosExigiblesLP_1, depositosExigiblesCP_2, depositosExigiblesLP_2'.
            'fondosSociales_0, fondosSociales_1, fondosSociales_2,'.
            'pasivoObligacionesFinancierasLP_0, pasivoObligacionesFinancierasLP_1, pasivoObligacionesFinancierasLP_2, pasivoProveedoresLP_0, pasivoProveedoresLP_1, pasivoProveedoresLP_2, '.
            'pasivoCXPLP_0, pasivoCXPLP_1, pasivoCXPLP_2, pasivoImpuestosYTasasLP_0, pasivoImpuestosYTasasLP_1, pasivoImpuestosYTasasLP_2, '.
            'pasivoObligacionesLaboralesLP_0, pasivoObligacionesLaboralesLP_1, pasivoObligacionesLaboralesLP_2, pasivoProvisionesLP_0, pasivoProvisionesLP_1, pasivoProvisionesLP_2, '.
            'patrimonioCapitalSocial_0, patrimonioCapitalSocial_1, patrimonioCapitalSocial_2, patrimonioReservaSocial_0, patrimonioReservaSocial_1, patrimonioReservaSocial_2, '.
            'patrimonioResultadoEjercicio_0, patrimonioResultadoEjercicio_1, patrimonioResultadoEjercicio_2, patrimonioResultadoEjerciciosAnteriores_0, patrimonioResultadoEjerciciosAnteriores_1, patrimonioResultadoEjerciciosAnteriores_2, '.
            'patrimonioSuperavitPorValorizaciones_0, patrimonioSuperavitPorValorizaciones_1, patrimonioSuperavitPorValorizaciones_2, estadoIngresosOperacionales_0, estadoIngresosOperacionales_1, estadoIngresosOperacionales_2, '.
            'estadoCostoDeVenta_0, estadoCostoDeVenta_1, estadoCostoDeVenta_2, estadoUtilidadBruta_0, estadoUtilidadBruta_1, estadoUtilidadBruta_2, '.
            'estadoGastosOperacionalesAdmon_0, estadoGastosOperacionalesAdmon_1, estadoGastosOperacionalesAdmon_2, estadoDepreciacion_0, estadoDepreciacion_1, estadoDepreciacion_2, '.
            'estadoAmortizacion_0, estadoAmortizacion_1, estadoAmortizacion_2, estadoGastosOperacionalesVenta_0, estadoGastosOperacionalesVenta_1, estadoGastosOperacionalesVenta_2, '.
            'estadoIngresosNoOperacionales_0, estadoIngresosNoOperacionales_1, estadoIngresosNoOperacionales_2, estadoGastosNoOperacionales_0, estadoGastosNoOperacionales_1, estadoGastosNoOperacionales_2, '.
            'otrosActivosCorrientes_0, otrosNoActivosCorrientes_0, otrosPasivosCorrientes_0, otrosPasivosNoCorrientes_0,'.
            'otrosActivosCorrientes_1, otrosNoActivosCorrientes_1, otrosPasivosCorrientes_1, otrosPasivosNoCorrientes_1,'.
            'otrosActivosCorrientes_2, otrosNoActivosCorrientes_2, otrosPasivosCorrientes_2, otrosPasivosNoCorrientes_2,'.
            'fondosSocialesCP_0, fondosSocialesCP_1, fondosSocialesCP_2, '.
            'patrimonioFondoDestinacionEspecifica_0, patrimonioFondoDestinacionEspecifica_1, patrimonioFondoDestinacionEspecifica_2,'.
            'kContratacion, kEjecucion, ' .
            'estadoInteresesBancarios_0, estadoInteresesBancarios_1, estadoInteresesBancarios_2, impuestoDeRenta_0, impuestoDeRenta_1, impuestoDeRenta_2, colpensionesType, auditedFinancialfigures, consolidatedFinancialStatements, currency, privacy, financialSource, auditedFinancialfigures_1, consolidatedFinancialStatements_1, currency_1, privacy_1, financialSource_1 ', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, dateLastBalanceSheet, lastBalanceSheet, liabilities, sanctions','safe', 'on' => 'search'),
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
            'verificationSectionId' => 'Verification Section',
            'verificationResultId' => 'Verification Result',
            'dateLastBalanceSheet' => 'Fecha de último balance',
            'dateLastBalanceSheet_1' => 'Fecha de penúltimo balance',
            'dateLastBalanceSheet_2' => 'Fecha de antepenúltimo balance',
            'lastBalanceSheet_1' => 'Balance',
            'lastBalanceSheet' => 'Balance anterior',
            'liabilities' => 'Obligaciones Financieras',
            'sanctions' => 'Sanciones y Multas',
            // NEW FIELDS
            'activoDisponible_0' => 'Activo Disponible',
            'activoClientes_0' => 'Activo Clientes',
            'activoAnticiposYAvances_0' => 'Activo Anticipos Y Avances',
            'activoInventarios_0' => 'Activo Inventarios',
            'activoInversionesCP_0' => 'Activo Inversiones CP',
            'activoPropiedadPlantaYEquipo_0' => 'Activo Propiedad Planta Y Equipo',
            'activoDepreciacion_0' => 'Activo Depreciacion',
            'activoInversionesLP_0' => 'Activo Inversiones LP',
            'activoIntangibles_0' => 'Activo Intangibles',
            'activoValorizaciones_0' => 'Activo Valorizaciones',
            'pasivoObligacionesFinancierasCP_0' => 'Pasivo Obligaciones Financieras CP',
            'pasivoProveedores_0' => 'Pasivo Proveedores',
            'pasivoCXP_0' => 'Pasivo CXP',
            'pasivoImpuestosYTasas_0' => 'Pasivo Impuestos Y Tasas',
            'pasivoObligacionesLaborales_0' => 'Pasivo Obligaciones Laborales',
            'pasivoProvisiones_0' => 'Pasivo Provisiones',
            'depositosExigiblesCP_0' => 'Depósitos y Exigibilidades CP',
            'fondosSociales_0' => 'Fondos Sociales LP',
            'pasivoObligacionesFinancierasLP_0' => 'Pasivo Obligaciones Financieras LP',
            'pasivoProveedoresLP_0' => 'Pasivo Proveedores LP',
            'pasivoCXPLP_0' => 'Pasivo CXP LP',
            'pasivoImpuestosYTasasLP_0' => 'Pasivo Impuestos Y Tasas LP',
            'pasivoObligacionesLaboralesLP_0' => 'Pasivo Obligaciones Laborales LP',
            'pasivoProvisionesLP_0' => 'Pasivo Provisiones LP',
            'depositosExigiblesLP_0' => 'Depósitos y Exigibilidades LP',
            'patrimonioCapitalSocial_0' => 'Patrimonio Capital Social',
            'patrimonioReservaSocial_0' => 'Patrimonio Reserva Social',
            'patrimonioResultadoEjercicio_0' => 'Patrimonio Resultado Ejercicio',
            'patrimonioResultadoEjerciciosAnteriores_0' => 'Patrimonio Resultado Ejercicios Anteriores',
            'patrimonioSuperavitPorValorizaciones_0' => 'Patrimonio Superavit Por Valorizaciones',
            'patrimonioFondoDestinacionEspecifica_0' => 'Fondos de Destinación Específica',
            'estadoIngresosOperacionales_0' => 'Ingresos Operacionales',
            'estadoCostoDeVenta_0' => 'Costo DeVenta',
            'estadoUtilidadBruta_0' => 'Utilidad Bruta',
            'estadoGastosOperacionalesAdmon_0' => 'Gastos Operacionales Admon',
            'estadoDepreciacion_0' => 'Depreciacion',
            'estadoAmortizacion_0' => 'Amortizacion',
            'estadoGastosOperacionalesVenta_0' => 'Gastos Operacionales Venta',
            'estadoIngresosNoOperacionales_0' => 'Ingresos No Operacionales',
            'estadoGastosNoOperacionales_0' => 'Gastos No Operacionales',
            'estadoInteresesBancarios_0' => 'Intereses Bancarios (Informativo)',
            'impuestoDeRenta_0' => 'Impuesto de Renta',
            'fondosSocialesCP_0' => 'Fondos Sociales CP',
            'otrosActivosCorrientes_0' => "Otros Activos Corrientes",
            'otrosNoActivosCorrientes_0' => "Otros Activos No Corrientes",
            'otrosPasivosCorrientes_0' => "Otros Pasivos Corrientes",
            'otrosPasivosNoCorrientes_0' => "Otros Pasivos No Corrientes",
            'kContratacion' => "Capacidad de Contratación",
            'kEjecucion' => "Capacidad de Ejecución",
            'colpensionesType' => "Tipo de Entidad Colpensiones",
            'auditedFinancialfigures' => "Estados financieros auditados",
            'consolidatedFinancialStatements' => "Estados financieros consolidados",
            'currency' => "Moneda",
            'privacy' => "Privacidad",
            'financialSource' => "Fuente de los estados financieros",
            'auditedFinancialfigures_1' => "Estados financieros auditados",
            'consolidatedFinancialStatements_1' => "Estados financieros consolidados",
            'currency_1' => "Moneda",
            'privacy_1' => "Privacidad",
            'financialSource_1' => "Fuente de los estados financieros",
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
        $criteria->compare('dateLastBalanceSheet', $this->dateLastBalanceSheet, true);
        $criteria->compare('lastBalanceSheet', $this->lastBalanceSheet, true);
        $criteria->compare('liabilities', $this->liabilities, true);
        $criteria->compare('sanctions', $this->sanctions, true);
        $criteria->compare('totalOperatingIncome', $this->totalOperatingIncome, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetailCompanyFinantialAnalys the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getHasEnoughData() {
        return (true);
    }

    public function afterSave() {
        parent::afterSave();
        $this->verificationSection->save();
        return;
    }

    public static function createBasicRecords($verificationSectionId) {
        $companyFinantialAnalys = new DetailCompanyFinantialAnalys;
        $companyFinantialAnalys->verificationSectionId = $verificationSectionId;
        $companyFinantialAnalys->verificationResultId = VerificationResult::PENDING;
        if (!$companyFinantialAnalys->save()) {
            Yii::app()->user->setFlash('verificationSection', 'Error saving the detail Finance');
            Yii::log("Error Saving the verification section: " . serialize($companyFinantialAnalys->getErrors()), "error", "ZWF." . __CLASS__);
        }
    }
}