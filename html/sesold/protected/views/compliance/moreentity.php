<fieldset>   
<legend><b>Entidades Implicadas</b></legend> 
<div class='row'>
    <a style="padding-left: 55px;"></a>Razón Social:
    <?php echo $form->textField($model, 'E1businessname',array('size' => 73, 'maxlength' => 250)); ?>
    <a style="padding-left: 63px;"></a>NIT:
    <?php echo $form->textField($model, 'E1nit',array('size' => 25, 'maxlength' => 250)); ?>

    <?php echo $form->error($model, 'E1businessname'); ?>
    <?php echo $form->error($model, 'E1nit'); ?>
</div>
<div class='row'>
    <a style="padding-left: 10px;"></a>Representante Legal:
    <?php echo $form->textField($model, 'E1replegal',array('size' => 73, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Identificación:
    <?php echo $form->textField($model, 'E1replegalid',array('size' => 25, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Tipo de Identificación:
    <?php
    echo $form->dropdownList($model, //
        'E1typeid', //
        array(
            'N/A' => '...',
            'CC' => 'CC',
            'CE' => 'CE',
            'NIT' => 'NIT',
        )
    );
    ?>
    <?php echo $form->error($model, 'E1replegal'); ?>
    <?php echo $form->error($model, 'E1replegalid'); ?>
    <?php echo $form->error($model, 'E1typeid'); ?>
</div>
<div class='row'>
    <a style="padding-left: 78px;"></a>Dirección:
    <?php echo $form->textField($model, 'E1address',array('size' => 60, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Teléfono:
    <?php echo $form->textField($model, 'E1tel',array('size' => 29, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>CIIU:
    <?php echo $form->textField($model, 'E1ciiu',array('size' => 25, 'maxlength' => 250)); ?>

    <?php echo $form->error($model, 'E1address'); ?>
    <?php echo $form->error($model, 'E1tel'); ?>
    <?php echo $form->error($model, 'E1ciiu'); ?>
</div>
<div class='row'>
    <a style="padding-left: 50px;"></a>Departamento:
    <?php echo $form->textField($model, 'E1dept',array('size' => 30, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Producto:
    <?php echo $form->textField($model, 'E1product',array('size' => 30, 'maxlength' => 250)); ?>

    <?php echo $form->error($model, 'E1dept'); ?>
    <?php echo $form->error($model, 'E1product'); ?>
</div>
<div class='row'>
<a style="padding-left: 67px;"></a>Vinculación:
<?php
echo $form->dropdownList($model, //
    'E1vinculat', //
    array(
        'N/A' => '...',
        'Antecedente penales o civiles juzgados de contrapartes no vinculados con Lavado de Activos o Financiación del Terrorismo' => 'Antecedente penales o civiles juzgados de contrapartes no vinculados con Lavado de Activos o Financiación del Terrorismo',
        'Procesos jurídicos de captura por eventos no vinculados con Lavado de Activos o Financiación del Terrorismo' => 'Procesos jurídicos de captura por eventos no vinculados con Lavado de Activos o Financiación del Terrorismo',

    )
);
?>
    <?php echo $form->error($model, 'E1vinculat'); ?>
</div><br>

<h6>¿Hay mas entidades implicadas? <select id="status" name="status" onChange="mostrar(this.value);">
        <option>....</option>
        <option value="SIE1">Si</option>
        <option value="NOE1">No</option>
    </select>
</h6>
</fieldset>

<div id="SIE1" style="display: none;">
<fieldset>   
<legend><b>Entidades Implicadas 2</b></legend> 
<div class='row'>
    <a style="padding-left: 55px;"></a>Razón Social:
    <?php echo $form->textField($model, 'E2businessname',array('size' => 73, 'maxlength' => 250)); ?>
    <a style="padding-left: 63px;"></a>NIT:
    <?php echo $form->textField($model, 'E2nit',array('size' => 25, 'maxlength' => 250)); ?>

    <?php echo $form->error($model, 'E2businessname'); ?>
    <?php echo $form->error($model, 'E2nit'); ?>
</div>
<div class='row'>
    <a style="padding-left: 10px;"></a>Representante Legal:
    <?php echo $form->textField($model, 'E2replegal',array('size' => 73, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Identificación:
    <?php echo $form->textField($model, 'E2replegalid',array('size' => 25, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Tipo de Identificación:
    <?php
    echo $form->dropdownList($model, //
        'E2typeid', //
        array(
            'N/A' => '...',
            'CC' => 'CC',
            'CE' => 'CE',
            'NIT' => 'NIT',

        )
    );
    ?>
    <?php echo $form->error($model, 'E2replegal'); ?>
    <?php echo $form->error($model, 'E2replegalid'); ?>
    <?php echo $form->error($model, 'E2typeid'); ?>
</div>
<div class='row'>
    <a style="padding-left: 78px;"></a>Dirección:
    <?php echo $form->textField($model, 'E2address',array('size' => 60, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Teléfono:
    <?php echo $form->textField($model, 'E2tel',array('size' => 29, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>CIIU:
    <?php echo $form->textField($model, 'E2ciiu',array('size' => 25, 'maxlength' => 250)); ?>

    <?php echo $form->error($model, 'E2address'); ?>
    <?php echo $form->error($model, 'E2tel'); ?>
    <?php echo $form->error($model, 'E2ciiu'); ?>
</div>
<div class='row'>
    <a style="padding-left: 50px;"></a>Departamento:
    <?php echo $form->textField($model, 'E2dept',array('size' => 30, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Producto:
    <?php echo $form->textField($model, 'E2product',array('size' => 30, 'maxlength' => 250)); ?>

    <?php echo $form->error($model, 'E2dept'); ?>
    <?php echo $form->error($model, 'E2product'); ?>
</div>
<div class='row'>
<a style="padding-left: 67px;"></a>Vinculación:
<?php
echo $form->dropdownList($model, //
    'E2vinculat', //
    array(
        'N/A' => '...',
        'Antecedente penales o civiles juzgados de contrapartes no vinculados con Lavado de Activos o Financiación del Terrorismo' => 'Antecedente penales o civiles juzgados de contrapartes no vinculados con Lavado de Activos o Financiación del Terrorismo',
        'Procesos jurídicos de captura por eventos no vinculados con Lavado de Activos o Financiación del Terrorismo' => 'Procesos jurídicos de captura por eventos no vinculados con Lavado de Activos o Financiación del Terrorismo',

    )
);
?>
    <?php echo $form->error($model, 'E2vinculat'); ?>
</div><br>

<h6>¿Hay mas entidades implicadas? <select id="status" name="status" onChange="mostrar(this.value);">
        <option>....</option>
        <option value="SIE2">Si</option>
        <option value="NOE2">No</option>
    </select>
</h6>
</fieldset>
</div>

<div id="SIE2" style="display: none;">
<fieldset>   
<legend><b>Entidades Implicadas 3</b></legend> 
<div class='row'>
    <a style="padding-left: 55px;"></a>Razón Social:
    <?php echo $form->textField($model, 'E3businessname',array('size' => 73, 'maxlength' => 250)); ?>
    <a style="padding-left: 63px;"></a>NIT:
    <?php echo $form->textField($model, 'E3nit',array('size' => 25, 'maxlength' => 250)); ?>

    <?php echo $form->error($model, 'E3businessname'); ?>
    <?php echo $form->error($model, 'E3nit'); ?>
</div>
<div class='row'>
    <a style="padding-left: 10px;"></a>Representante Legal:
    <?php echo $form->textField($model, 'E3replegal',array('size' => 73, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Identificación:
    <?php echo $form->textField($model, 'E3replegalid',array('size' => 25, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Tipo de Identificación:
    <?php
    echo $form->dropdownList($model, //
        'E3typeid', //
        array(
            'N/A' => '...',
            'CC' => 'CC',
            'CE' => 'CE',
            'NIT' => 'NIT',

        )
    );
    ?>
    <?php echo $form->error($model, 'E3replegal'); ?>
    <?php echo $form->error($model, 'E3replegalid'); ?>
    <?php echo $form->error($model, 'E3typeid'); ?>
</div>
<div class='row'>
    <a style="padding-left: 78px;"></a>Dirección:
    <?php echo $form->textField($model, 'E3address',array('size' => 60, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Teléfono:
    <?php echo $form->textField($model, 'E3tel',array('size' => 29, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>CIIU:
    <?php echo $form->textField($model, 'E3ciiu',array('size' => 25, 'maxlength' => 250)); ?>

    <?php echo $form->error($model, 'E3address'); ?>
    <?php echo $form->error($model, 'E3tel'); ?>
    <?php echo $form->error($model, 'E3ciiu'); ?>
</div>
<div class='row'>
    <a style="padding-left: 50px;"></a>Departamento:
    <?php echo $form->textField($model, 'E3dept',array('size' => 30, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Producto:
    <?php echo $form->textField($model, 'E3product',array('size' => 30, 'maxlength' => 250)); ?>

    <?php echo $form->error($model, 'E3dept'); ?>
    <?php echo $form->error($model, 'E3product'); ?>
</div>
<div class='row'>
<a style="padding-left: 67px;"></a>Vinculación:
<?php
echo $form->dropdownList($model, //
    'E3vinculat', //
    array(
        'N/A' => '...',
        'Antecedente penales o civiles juzgados de contrapartes no vinculados con Lavado de Activos o Financiación del Terrorismo' => 'Antecedente penales o civiles juzgados de contrapartes no vinculados con Lavado de Activos o Financiación del Terrorismo',
        'Procesos jurídicos de captura por eventos no vinculados con Lavado de Activos o Financiación del Terrorismo' => 'Procesos jurídicos de captura por eventos no vinculados con Lavado de Activos o Financiación del Terrorismo',

    )
);
?>
    <?php echo $form->error($model, 'E3vinculat'); ?>
</div><br>

<h6>¿Hay mas entidades implicadas? <select id="status" name="status" onChange="mostrar(this.value);">
        <option>....</option>
        <option value="SIE3">Si</option>
        <option value="NOE3">No</option>
    </select>
</h6>
</fieldset>
</div>

<div id="SIE3" style="display: none;">
<fieldset>   
<legend><b>Entidades Implicadas 4</b></legend> 
<div class='row'>
    <a style="padding-left: 55px;"></a>Razón Social:
    <?php echo $form->textField($model, 'E4businessname',array('size' => 73, 'maxlength' => 250)); ?>
    <a style="padding-left: 63px;"></a>NIT:
    <?php echo $form->textField($model, 'E4nit',array('size' => 25, 'maxlength' => 250)); ?>

    <?php echo $form->error($model, 'E4businessname'); ?>
    <?php echo $form->error($model, 'E4nit'); ?>
</div>
<div class='row'>
    <a style="padding-left: 10px;"></a>Representante Legal:
    <?php echo $form->textField($model, 'E4replegal',array('size' => 73, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Identificación:
    <?php echo $form->textField($model, 'E4replegalid',array('size' => 25, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Tipo de Identificación:
    <?php
    echo $form->dropdownList($model, //
        'E4typeid', //
        array(
            'N/A' => '...',
            'CC' => 'CC',
            'CE' => 'CE',
            'NIT' => 'NIT',

        )
    );
    ?>
    <?php echo $form->error($model, 'E4replegal'); ?>
    <?php echo $form->error($model, 'E4replegalid'); ?>
    <?php echo $form->error($model, 'E4typeid'); ?>
</div>
<div class='row'>
    <a style="padding-left: 78px;"></a>Dirección:
    <?php echo $form->textField($model, 'E4address',array('size' => 60, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Teléfono:
    <?php echo $form->textField($model, 'E4tel',array('size' => 29, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>CIIU:
    <?php echo $form->textField($model, 'E4ciiu',array('size' => 25, 'maxlength' => 250)); ?>

    <?php echo $form->error($model, 'E4address'); ?>
    <?php echo $form->error($model, 'E4tel'); ?>
    <?php echo $form->error($model, 'E4ciiu'); ?>
</div>
<div class='row'>
    <a style="padding-left: 50px;"></a>Departamento:
    <?php echo $form->textField($model, 'E4dept',array('size' => 30, 'maxlength' => 250)); ?>
    <a style="padding-left: 10px;"></a>Producto:
    <?php echo $form->textField($model, 'E4product',array('size' => 30, 'maxlength' => 250)); ?>

    <?php echo $form->error($model, 'E4dept'); ?>
    <?php echo $form->error($model, 'E4product'); ?>
</div>
<div class='row'>
<a style="padding-left: 67px;"></a>Vinculación:
<?php
echo $form->dropdownList($model, //
    'E4vinculat', //
    array(
        'N/A' => '...',
        'Antecedente penales o civiles juzgados de contrapartes no vinculados con Lavado de Activos o Financiación del Terrorismo' => 'Antecedente penales o civiles juzgados de contrapartes no vinculados con Lavado de Activos o Financiación del Terrorismo',
        'Procesos jurídicos de captura por eventos no vinculados con Lavado de Activos o Financiación del Terrorismo' => 'Procesos jurídicos de captura por eventos no vinculados con Lavado de Activos o Financiación del Terrorismo',

    )
);
?>
    <?php echo $form->error($model, 'E4vinculat'); ?>
</div><br>
</fieldset>
</div>