<br><h1> Copia Informacion Antigua Clientes</h1>

<br><br><p>
    Por favor seleccione el rango de fechas que desea realizar la copia de los documentos adjuntos desde la fecha mas antigua hasta la mas reciente.
</p>

<form method="POST" action="datadoc" >
    <!--    <label>Desde</label>
    <input type="date" name="Desde" required="required">
    <label>Hasta</label>
    <input type="date" name="Hasta" required="required"> -->

    <br><br> <p>
        Por favor ingrese el ID de la empresa que desea realizar la copia de los documentos adjuntos.
    </p><br><br>
    <label>Codigo de la empresa</label>
    <input type="number" name="codcustomer" required="required">
    <br><br> <?php // echo CHtml::button('Generar Copia', array('submit' => array('backgroundCheck/datadoc'),'confirm' => '¿Esta seguro de Generar una copia de los documentos?')); ?>
    <input type="submit" value="Generar Copia" onclick="return confirm('¿Esta seguro de Generar una copia de los documentos?')" />
</form>
<?php if (Yii::app()->user->name== 'jcocoma@sintecto.com'): ?>

<br><h1> Eliminacion Informacion Antigua Clientes</h1>

<br><br><p>
    Por favor seleccione el rango de fechas que desea realizar la eliminación de los documentos adjuntos desde la fecha mas antigua hasta la mas reciente.
</p>

    <form method="POST" action="datadocDelete" >
   <!--  <label>Desde</label>
    <input type="date" name="DesdeEliminar" required="required">
    <label>Hasta</label>
    <input type="date" name="HastaEliminar" required="required"> -->

    <br><br> <p>
        Por favor ingrese el ID de la empresa que desea realizar la eliminación de los documentos adjuntos.
    </p><br><br>
    <label>Codigo de la empresa</label>
    <input type="number" name="codcustomerEliminar" required="required">
    <br><br> <?php // echo CHtml::button('Generar Eliminación', array('submit' => array('backgroundCheck/datadocDelete'),'confirm' => '¿Esta seguro de eliminar todos los documentos del adjuntos del cliente?')); ?>
        <input type="submit" value="Generar Eliminación" onclick="return confirm('¿Esta seguro de eliminar todos los documentos del adjuntos del cliente?')" />

</form>
<?php endif; ?>