<script src="../../mantenimiento/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    function mostrar(id) {
        for(var i=1; i<=4; i++){
            if (id == "SI"+i) {
                $("#SI"+i).show();
                $("#NO"+i).hide();
            }
            if (id == "NO"+i) {
                $("#SI"+i).hide();
                $("#NO"+i).hide();
            }
            if (id == "SIE"+i) {
                $("#SIE"+i).show();
                $("#NOE"+i).hide();
            }
            if (id == "NOE"+i) {
                $("#SIE"+i).hide();
                $("#NOE"+i).hide();
            }
        }
    }
</script>

<?php $form=$this->beginWidget("CActiveForm");?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ProcessView.css" />

<div class="form wide">

<div class="col-lg-3">
    <?php //echo $form->labelEx($model, 'userId').': '; ?>
    <?php //echo $user2->username; ?>
    <?php echo $form->hiddenField($model, 'userId',array('value'=>$user2->id,'readonly'=>"readonly")); ?>
</div>

<div class="col-lg-3">
    <?php //echo $form->labelEx($model, 'customerid').': '; ?>
    <?php  //echo $user2->customer->name; ?>
    <?php echo $form->hiddenField($model, 'customerid',array('value'=>$user2->customer->id,'readonly'=>"readonly")); ?>
</div>

<h2><a style="padding-left: 10px;"></a>Reporte De Señales De Alerta, Operaciones Inusuales, Operaciones Sospechosas o Ausencia De Operaciones Sospechosas.</h2>

<fieldset>
<legend><b>Datos del Reportante</b></legend>  
<div class="row">
    <?php echo $form->labelEx($model, 'dateReport').':'; ?>
    <?php echo $form->dateField($model, 'dateReport'); ?>
    <?php echo $form->error($model, 'dateReport'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'name').':'; ?>
    <?php echo $form->textField($model, 'name',array('size' => 20, 'maxlength' => 50)); ?>
    <a style="padding-left: 10px;"></a>Apellidos:
    <?php echo $form->textField($model, 'lastname',array('size' => 20, 'maxlength' => 50)); ?>
    <a style="padding-left: 10px;"></a>Nit ó Cedula:
    <?php echo $form->textField($model, 'IdCompliance',array('size' => 20, 'maxlength' => 50)); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'address').':'; ?>
    <?php echo $form->textField($model, 'address',array('size' => 25, 'maxlength' => 50)); ?>
    <a style="padding-left: 10px;"></a>Tipo de Vinculo:
    <?php
    echo $form->dropdownList($model, //
        'typeLink', //
        array(
            'N/A' => '...',
            'Colaborador' => 'Colaborador',
            'Proveedor' => 'Proveedor',
            'Cliente' => 'Cliente',
            'Socio' => 'Socio',
            'Otros' => 'Otros',
        )
    );
    ?>
    <?php echo $form->error($model, 'name'); ?>
    <?php echo $form->error($model, 'lastname'); ?>
    <?php echo $form->error($model, 'address'); ?>
    <?php echo $form->error($model, 'IdCompliance'); ?>
    <?php echo $form->error($model, 'typeLink'); ?>
</div>
</fieldset>

<fieldset>
<legend><b>Tipo de Reporte</b></legend>  
<div class="row">
<a style="padding-left: 53px;"></a>Operación Inusual:
<?php
echo $form->dropdownList($model, //
    'unusualOperation', //
    array(
        'N/A' => '...',
        'SI' => 'SI',
        'NO' => 'NO',
    )
);
?>
<a style="padding-left: 10px;"></a>Importancia: 
<?php
echo $form->dropdownList($model, //
    'importance', //
    array(
        'N/A' => '...',
        'Alta' => 'Alta',
        'Media' => 'Media',
        'Baja' => 'Baja',
    )
);
?>
<a style="padding-left: 15px;"></a>Fuente LAFT:
<?php
echo $form->dropdownList($model, //
    'laftsource', //
    array(
        'N/A' => '...',
        'Información de Prensa' => 'Información de Prensa',
        'Solicitud de otra autoridad' => 'Solicitud de otra autoridad',
        'Otras listas Internacionales' => 'Otras listas Internacionales',
        'Posible Operación de LA' => 'Posible Operación de LA',
        'Posible Operación de FT' => 'Posible Operación de FT',
        'Información de otras fuentes' => 'Información de otras fuentes',
    )
);
?>
</div>
<div class="row">
<?php echo $form->error($model, 'unusualOperation'); ?>
<?php echo $form->error($model, 'importance'); ?>
<?php echo $form->error($model, 'laftsource'); ?>
</div>

<div class="row">
<a style="padding-left: 22px;"></a>Operación Sospechosa:
<?php
echo $form->dropdownList($model, //
    'suspiciousOperation', //
    array(
        'N/A' => '...',
        'SI' => 'SI',
        'NO' => 'NO',
    )
);
?>
<a style="padding-left: 26px;"></a>Urgencia:
    <?php
    echo $form->dropdownList($model, //
        'urgency', //
        array(
            'N/A' => '...',
            'Alta' => 'Alta',
            'Media' => 'Media',
            'Baja' => 'Baja',

        )
    );
    ?>
    <a style="padding-left: 10px;"></a>Otras Alertas:
    <?php
    echo $form->dropdownList($model, //
        'otherAlerts', //
        array(
            'N/A' => '...',
            'Ordenes de Captura no vinculado a LAFT' => 'Ordenes de Captura no vinculado a LAFT',
            'Antecedentes por Hurtos ' => 'Antecedentes por Hurtos ',
            'Antecedentes Judiciales' => 'Antecedentes Judiciales',
            'Antecedentes Penales' => 'Antecedentes Penales',
            'Procesos Civiles y Penales' => 'Procesos Civiles y Penales',
            'Otros Antecedentes ' => 'Otros Antecedentes ',


        )
    );
    ?>
<?php echo $form->error($model, 'suspiciousOperation'); ?>
<?php echo $form->error($model, 'urgency'); ?>
<?php echo $form->error($model, 'otherAlerts'); ?>
</div>

<div  class="row">
    <a style="padding-left: 70px;"></a>Señal de Alerta:
        <?php
        echo $form->dropdownList($model, //
            'alertsignal', //
            array(
                'N/A' => '...',
                'SI' => 'SI',
                'NO' => 'NO',
            )
        );
        ?>
    <a style="padding-left: 28px;"></a>Moneda:
    <?php
    echo $form->dropdownList($model, //
        'currency', //
        array(
            'N/A' => '...',
            'Pesos' => 'Pesos COP',
            'Dólares' => 'Dólares',
            'Euros' => 'Euros',

        )
    );
    ?>
    <a style="padding-left: 10px;"></a>Ausencia ROS (AROS):
    <?php
    echo $form->dropdownList($model, //
        'aros', //
        array(
            'N/A' => '...',
            'SI' => 'SI',
            'NO' => 'NO',

        )
    );
    ?>
    <?php echo $form->error($model, 'alertsignal'); ?>
    <?php echo $form->error($model, 'currency'); ?>
    <?php echo $form->error($model, 'aros'); ?>
</div><br>
<div class="row">
    <a style="padding-left: 20px;"></a>Trimestre del AROS (Fecha Inicial):
    <?php echo $form->dateField($model, 'arostimeinit'); ?>
    <a style="padding-left: 10px;"></a>Trimestre del AROS (Fecha Final):
    <?php echo $form->dateField($model, 'arostimeend'); ?>

        <?php echo $form->error($model, 'arostimeinit'); ?>
        <?php echo $form->error($model, 'arostimeend'); ?>
</div>

</fieldset>

<fieldset>
<legend><b>Información del Reporte</b></legend>  
<div class="row">
    <a style="padding-left: 10px;"></a>Tipo de Contraparte:
    <?php
    echo $form->dropdownList($model, //
        'counterpartType', //
        array(
            'N/A' => '...',
            'Colaborador' => 'Colaborador',
            'Proveedor' => 'Proveedor',
            'Cliente' => 'Cliente',
            'Socio' => 'Socio',
            'Otros' => 'Otros',
        )
    );
    ?>
    <a style="padding-left: 10px;"></a>Valor de la transacción:
    <?php echo $form->textField($model, 'transactionvalue',array('size' => 20, 'maxlength' => 50)); ?>

    <?php echo $form->error($model, 'counterpartType'); ?>
    <?php echo $form->error($model, 'transactionvalue'); ?>
    <a style="padding-left: 10px;"></a>Tipo de Operación:
    <?php
    echo $form->dropdownList($model, //
        'operationType', //
        array(
            'N/A' => '...',
            'Nacional' => 'Nacional',
            'Internacional' => 'Internacional',
        )
    );
    ?>
    <a style="padding-left: 10px;"></a>Moneda:
    <?php
    echo $form->dropdownList($model, //
        'transactioncurrency', //
        array(
            'N/A' => '...',
            'Pesos' => 'Pesos COP',
            'Dólares' => 'Dólares',
            'Euros' => 'Euros',

        )
    );
    ?>
    <a style="padding-left: 10px;"></a>Fecha: 
    <?php echo $form->dateField($model, 'transectiondate'); ?>

    <?php echo $form->error($model, 'operationType'); ?>
    <?php echo $form->error($model, 'transactioncurrency'); ?>
    <?php echo $form->error($model, 'transectiondate'); ?>
</div>
</fieldset>

<fieldset>
<legend><b>Descripción de la Operación o Señal de Alerta</b></legend> 
<div class="row">
    <a style="padding-left: 5px;"></a><?php echo $form->textarea($model, 'description',array( 'rows'=>"3", 'cols'=>"100")); ?>
    <?php echo $form->error($model, 'description'); ?>
</div>
<div class="row">
<a style="padding-left: 15px;"></a><b>Análisis Interno de la Operación (OFICIAL DE CUMPLIMIENTO)</b>
    <?php
    echo $form->dropdownList($model, //
        'analysis', //
        array(
            'N/A' => '...',
            'Incremento patrimonial o de las operaciones no justificado o por fuera de los promedios del respectivo sector o actividad económica, de acuerdo con el SIPLAFT implementado por la entidad' => 'Incremento patrimonial o de las operaciones no justificado o por fuera de los promedios del respectivo sector o actividad económica, de acuerdo con el SIPLAFT implementado por la entidad',
            'Presunto uso indebido de identidades, por ejemplo: uso de números de identificación inexistentes, números de identificación de personas fallecidas, suplantación de personas, alteración de nombres.' => 'Presunto uso indebido de identidades, por ejemplo: uso de números de identificación inexistentes, números de identificación de personas fallecidas, suplantación de personas, alteración de nombres.',
            'Presentación de documentos o datos presuntamente falsos.' => 'Presentación de documentos o datos presuntamente falsos.',
            'Actuación en nombre de terceros y uso de empresas aparentemente de fachada.' => 'Actuación en nombre de terceros y uso de empresas aparentemente de fachada.',
            'Relación con personas vinculadas o presuntamente vinculadas a actividades delictivas.' => 'Relación con personas vinculadas o presuntamente vinculadas a actividades delictivas.',
            'Relación con bienes de presunto origen ilícito.' => 'Relación con bienes de presunto origen ilícito.',
            'Fraccionamiento y/o insuavidades en el manejo del efectivo.' => 'Fraccionamiento y/o insuavidades en el manejo del efectivo.',
            'Antecedente penales o civiles juzgados de contrapartes no vinculados con Lavado de Activos o Financiación del Terrorismo' => 'Antecedente penales o civiles juzgados de contrapartes no vinculados con Lavado de Activos o Financiación del Terrorismo',
            'Procesos jurídicos de captura por eventos no vinculados con Lavado de Activos o Financiación del Terrorismo' => 'Procesos jurídicos de captura por eventos no vinculados con Lavado de Activos o Financiación del Terrorismo',
        )
    );
    ?>
</div>
</fieldset>
<?php echo $form->error($model, 'analysis'); ?>
<?php
include 'moreperson.php';
include 'moreentity.php';
?>

<fieldset>
<legend><b>Observaciones Adicionales</b></legend> 
<div class="row">
    <?php echo $form->textarea($model, 'additionalremarks',array( 'rows'=>"3", 'cols'=>"100")); ?>
    <?php echo $form->error($model, 'additionalremarks'); ?>
</div>
</fieldset>
    <br><hr/><?php echo CHtml::submitButton("Guardar",
                        array("class"=>"btn btn-primary btn-large"));?>
<?php $this->endWidget();?>
