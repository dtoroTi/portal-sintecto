
<h1>Ver Reporte #<?php echo $model->id;?></h1>

<style>

    table {
        width: 100%;
        border: 1px solid #000;
    }
    th, td {
        font-weight: bold;
        width: 16%;
        text-align: left;
        vertical-align: top;
        border: 1px solid #000;
        border-collapse: collapse;
        padding: 0.3em;
        caption-side: bottom;
    }
    caption {
        font-weight: bold;
        padding: 0.3em;
        color: #fff;
        background: #000;
    }
    th {
        font-weight: bold;
        background: #D4E6F1;
    }
    .box {
        height:200px;
        overflow: auto;
        width:97%;
    }

</style>

<div id="page">

    <table>
        <caption>REPORTE DE SEÑALES DE ALERTA , OPERACIONES INUSUALES, OPERACIONES SOSPECHOSAS O AUSENCIA DE OPERACIONES SOSPECHOSAS</caption>
    </table>
    <table>
        <thead>
        <tr>
            <th scope="col" colspan="2">Fecha del reporte :  <?php echo $model->dateReport;?> </th>
            <td></td>



        </tr>
        </thead>
    </table>

    <table>
        <caption>Datos del Reportante</caption>
    </table>

    <table>
    <tbody>
        <tr class="odd">
            <th scope="row">Nombre</th>
            <td><?php echo $model->name;?></td>
            <th scope="row">Apellido</th>
            <td><?php echo $model->lastname;?></td>
        </tr>
        <tr>
            <th scope="row">Direccion</th>
            <td><?php echo $model->address;?></td>
            <th scope="row">Nit ó Cedula</th>
            <td><?php echo $model->IdCompliance;?></td>
        </tr>
        <tr class="odd">
            <th scope="row">Tipo de Vinculo</th>
            <td><?php echo $model->typeLink;?></td>
        </tr>
        </tbody>
    </table>

    <table>
        <caption>Tipo de Reporte</caption>
    </table>

    <table>
        <tbody>
        <tr>
            <th>Operación Inusual</th>
            <td><?php echo $model->unusualOperation;?></td>
            <th>Importancia</th>
            <td><?php echo $model->importance;?></td>
            <th>Fuente LAFT</th>
            <td><?php echo $model->laftsource;?></td>
        </tr>
        <tr>
            <th>Operación Sospechosa</th>
            <td><?php echo $model->suspiciousOperation;?></td>
            <th>Urgencia</th>
            <td><?php echo $model->urgency;?></td>
            <th rowspan="2">Otras Alertas</th>
            <td rowspan="2"><?php echo $model->otherAlerts;?></td>
        </tr>
        <tr>
            <th>Señal de Alerta</th>
            <td><?php echo $model->alertsignal;?></td>
            <th>Moneda</th>
            <td><?php echo $model->currency;?></td>
        </tr>
        <tr>
            <th>Ausencia (AROS)</th>
            <td><?php echo $model->aros;?></td>
            <th colspan="2">Trimestre del AROS (Fecha del xx al xx)</th>
            <td colspan="2">Desde <?php echo $model->arostimeinit;?> hasta el <?php echo $model->arostimeend;?></td>
        </tr>
        </tbody>
    </table>

    <table>
        <caption>Información del Reporte</caption>
    </table>

    <table>
        <tbody>
        <tr>
            <th>Tipo de Contraparte</th>
            <td><?php echo $model->counterpartType;?></td>
            <th colspan="2">Valor de la transacción</th>
            <td colspan="2"><?php echo $model->transactionvalue;?></td>
        </tr>
        <tr>
            <th>Tipo de Operación</th>
            <td><?php echo $model->operationType;?></td>
            <th>Moneda</th>
            <td><?php echo $model->transactioncurrency;?></td>
            <th>Fecha</th>
            <td><?php echo $model->transectiondate;?></td>
        </tr>
        </tbody>
    </table>
    <table>
        <caption>Descripción de la Operación o Señal de Alerta</caption>
    </table>

    <table>
        <tbody>
        <tr>

            <div class="box"><?php echo $model->description;?></div>

        </tr>
        </tbody>
    </table>

    <table>
        <caption>Análisis Interno de la Operación (OFICIAL DE CUMPLIMIENTO)</caption>
    </table>

    <table>
        <tbody>
        <tr>
            <td>
            <?php echo $model->analysis;?>
            </td>
        </tr>
        </tbody>
    </table>


</div>
