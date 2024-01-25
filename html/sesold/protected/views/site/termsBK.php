<?php
echo'<script type="text/javascript">
    alert("Les informamos que a partir del día primero de febrero del año 2021 nuestra nueva sede estará ubicada en la carrera 45 # 97-50 edificio Porto 100 - Oficina 807 y nuestro nuevo número de contacto en la ciudad de Bogotá será el (1) 915 9000.");    
    </script>';

$this->pageTitle=Yii::app()->name . 'Terminos de Uso';
$this->breadcrumbs=array(
    'términos',
);
?>

<div id="terms">
    <h2>SINTECTO</h2>
    <h2>(la “Compañía”)</h2>

    <h3>Términos de Uso del Portal Web</h3>

    <p>
        Como cliente de la Compañía declaro que el acceso por internet a la consulta de
        la información que reposa en los archivos de la Compañía,  es un servicio que
        presta la Compañía en virtud de la relación comercial que sostengo con la misma.
        El uso de esta información está limitado a los fines privados en virtud de la
        mencionada relación comercial, cualquier uso para una finalidad diferente, será
        responsabilidad única y exclusivamente de quien consulta, y se considerará como
        irregular, estando sujeto al inicio de las acciones legales pertinentes.
        Declaro que me hago responsable por el uso y cuidado de la información que
        llegare a obtener a través del presente sistema informático.
    </p>
    <p>
        La información que aquí reposa se encuentra sujeta a la Política de Tratamiento
        de Datos de la Compañía <a href="http://www.sintecto.com/terminos-y-condiciones/" target="_blank">www.sintecto.com</a>, la cual declaro conocer y aceptar.
    </p>
    <p>
        Como cliente de la Compañía acepto que la información aquí contenida no
        constituye obligación alguna respecto de la vinculación y/o contratación del
        Titular de la información, siendo la misma el resultado de la relación
        contractual inicialmente citada.  La decisión respecto de la vinculación y/o
        contratación es de única y exclusiva responsabilidad mía como cliente, por lo
        cual declaro que la información obtenida por este sistema informático no
        constituye recomendación alguna para la vinculación y/o contratación del
        Titular de la información.
    </p>
    <p>
        Cualquier uso no autorizado de este sistema informativo o uso no autorizado de
        la información en él contenida se considerará una violación a los presentes
        Términos y procederán las acciones legales del caso.
    </p>
    <p>
        Así mismo, declaro que los recursos con los cuales cancelo los servicios
        prestados por la Compañía no provienen de actividades ilícitas,
        comprometiéndome a establecer los procedimientos y políticas respectivas
        para prevenir el Lavado de Activos y la Financiación al Terrorismo.
    </p>
    <p>
        El usuario es el responsable del login y clave generados para su acceso,
        estos datos son secretos, cualquier ingreso con los mismos serán registrado
        como del usuario y el uso será de su entera responsabilidad. Asegúrese de cerrar la sesión una vez terminada su consulta.
    </p>


    <?php echo CHtml::beginForm(array('site/terms'));?>
    <?php echo CHtml::submitButton('Acepto los Términos', array('name' => 'btAccepted')); ?>
    <?php echo CHtml::submitButton('No Acepto', array('name' => 'btNotAccepted')); ?>
    <?php echo CHtml::endForm();?>

</div>
