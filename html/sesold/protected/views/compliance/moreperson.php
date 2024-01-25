<fieldset>   
<legend><b>Personas Implicadas</b></legend> 
<div class='row'>
    <a style="padding-left: 10px;"></a>Identificación:
    <?php echo $form->textField($model, 'P1id',array('size'=>20, 'maxlength'=> 50)); ?>
    <a style="padding-left: 10px;"></a>Tipo de Identificacion:
    <?php
    echo $form->dropdownList($model, //
        'P1typeid', //
        array(
            'N/A' => '...',
            'CC' => 'CC',
            'CE' => 'CE',
            'NIT' => 'NIT',

        )
    );
    ?>
</div>
<div class='row'>
    <a style="padding-left:30px;"></a>Apellido 1:
    <?php echo $form->textField($model, 'P1lastname1',array('size' => 20, 'maxlength' => 50)); ?>
    <a style="padding-left: 10px;"></a>Apellido 2:
    <?php echo $form->textField($model, 'P1lastname2',array('size' => 20, 'maxlength' => 50)); ?>
    <a style="padding-left: 10px;"></a>Nombres:
    <?php echo $form->textField($model, 'P1name',array('size' => 40, 'maxlength' => 50)); ?>

    <?php echo $form->error($model, 'P1lastname1'); ?>
    <?php echo $form->error($model, 'P1lastname2'); ?>
    <?php echo $form->error($model, 'P1name'); ?>
</div>
<div class='row'>
    <a style="padding-left: 33px;"></a>Dirección:
    <?php echo $form->textField($model, 'P1address',array('size' => 58, 'maxlength' => 50)); ?>
    <a style="padding-left: 15px;"></a>Teléfono:
    <?php echo $form->textField($model, 'P1tel',array('size' => 20, 'maxlength' => 50)); ?>

    <?php echo $form->error($model, 'P1typeid'); ?>
    <?php echo $form->error($model, 'P1id'); ?>
    <?php echo $form->error($model, 'P1address'); ?>
    <?php echo $form->error($model, 'P1tel'); ?>
</div>
<a style="padding-left: 10px;"></a><h6>¿Hay mas personas implicadas? <select id="status" name="status" onChange="mostrar(this.value);">
        <option>....</option>
        <option value="SI1">Si</option>
        <option value="NO1">No</option>
    </select>
</h6>
</fieldset>

<div id="SI1" style="display: none;">
<fieldset>
<legend><b>Personas Implicadas 2</b></legend> 
<div class='row'>
    <a style="padding-left: 10px;"></a>Identificación:
    <?php echo $form->textField($model, 'P2id',array('size'=>20, 'maxlength'=> 50)); ?>
    <a style="padding-left: 10px;"></a>Tipo de Identificacion:
    <?php
    echo $form->dropdownList($model, //
        'P2typeid', //
        array(
            'N/A' => '...',
            'CC' => 'CC',
            'CE' => 'CE',
            'NIT' => 'NIT',

        )
    );
    ?>
</div>
<div class='row'>
    <a style="padding-left:30px;"></a>Apellido 1:
    <?php echo $form->textField($model, 'P2lastname1',array('size' => 20, 'maxlength' => 50)); ?>
    <a style="padding-left: 10px;"></a>Apellido 2:
    <?php echo $form->textField($model, 'P2lastname2',array('size' => 20, 'maxlength' => 50)); ?>
    <a style="padding-left: 10px;"></a>Nombres:
    <?php echo $form->textField($model, 'P2name',array('size' => 40, 'maxlength' => 50)); ?>

    <?php echo $form->error($model, 'P2lastname1'); ?>
    <?php echo $form->error($model, 'P2lastname2'); ?>
    <?php echo $form->error($model, 'P2name'); ?>
</div>
<div class='row'>
    <a style="padding-left: 33px;"></a>Dirección:
    <?php echo $form->textField($model, 'P2address',array('size' => 58, 'maxlength' => 50)); ?>
    <a style="padding-left: 15px;"></a>Teléfono:
    <?php echo $form->textField($model, 'P2tel',array('size' => 20, 'maxlength' => 50)); ?>

    <?php echo $form->error($model, 'P2typeid'); ?>
    <?php echo $form->error($model, 'P2id'); ?>
    <?php echo $form->error($model, 'P2address'); ?>
    <?php echo $form->error($model, 'P2tel'); ?>
</div>
<a style="padding-left:10px;"></a><h6>¿Hay mas personas implicadas? <select id="status" name="status" onChange="mostrar(this.value);">
            <option>....</option>
            <option value="SI2">Si</option>
            <option value="NO2">No</option>
        </select>
    </h6>
</fieldset>
</div>



<div id="SI2" style="display: none;">
<fieldset>
<legend><b>Personas Implicadas 3</b></legend> 
<div class='row'>
    <a style="padding-left: 10px;"></a>Identificación:
    <?php echo $form->textField($model, 'P3id',array('size'=>20, 'maxlength'=> 50)); ?>
    <a style="padding-left: 10px;"></a>Tipo de Identificacion:
    <?php
    echo $form->dropdownList($model, //
        'P3typeid', //
        array(
            'N/A' => '...',
            'CC' => 'CC',
            'CE' => 'CE',
            'NIT' => 'NIT',

        )
    );
    ?>
</div>
<div class='row'>
    <a style="padding-left:30px;"></a>Apellido 1:
    <?php echo $form->textField($model, 'P3lastname1',array('size' => 20, 'maxlength' => 50)); ?>
    <a style="padding-left: 10px;"></a>Apellido 2:
    <?php echo $form->textField($model, 'P3lastname2',array('size' => 20, 'maxlength' => 50)); ?>
    <a style="padding-left: 10px;"></a>Nombres:
    <?php echo $form->textField($model, 'P3name',array('size' => 40, 'maxlength' => 50)); ?>

    <?php echo $form->error($model, 'P3lastname1'); ?>
    <?php echo $form->error($model, 'P3lastname2'); ?>
    <?php echo $form->error($model, 'P3name'); ?>
</div>
<div class='row'>
    <a style="padding-left: 33px;"></a>Dirección:
    <?php echo $form->textField($model, 'P3address',array('size' => 58, 'maxlength' => 50)); ?>
    <a style="padding-left: 15px;"></a>Teléfono:
    <?php echo $form->textField($model, 'P3tel',array('size' => 20, 'maxlength' => 50)); ?>

    <?php echo $form->error($model, 'P3typeid'); ?>
    <?php echo $form->error($model, 'P3id'); ?>
    <?php echo $form->error($model, 'P3address'); ?>
    <?php echo $form->error($model, 'P3tel'); ?>
</div>
<a style="padding-left:10px;"></a><h6>¿Hay mas personas implicadas?<select id="status" name="status" onChange="mostrar(this.value);">
            <option>....</option>
            <option value="SI3">Si</option>
            <option value="NO3">No</option>
        </select>
    </h6>
</fieldset>
</div>

<div id="SI3" style="display: none;">
<fieldset>
<legend><b>Personas Implicadas 4</b></legend> 
<div class='row'>
    <a style="padding-left: 10px;"></a>Identificación:
    <?php echo $form->textField($model, 'P4id',array('size'=>20, 'maxlength'=> 50)); ?>
    <a style="padding-left: 10px;"></a>Tipo de Identificacion:
    <?php
    echo $form->dropdownList($model, //
        'P4typeid', //
        array(
            'N/A' => '...',
            'CC' => 'CC',
            'CE' => 'CE',
            'NIT' => 'NIT',

        )
    );
    ?>
</div>
<div class='row'>
    <a style="padding-left:30px;"></a>Apellido 1:
    <?php echo $form->textField($model, 'P4lastname1',array('size' => 20, 'maxlength' => 50)); ?>
    <a style="padding-left: 10px;"></a>Apellido 2:
    <?php echo $form->textField($model, 'P4lastname2',array('size' => 20, 'maxlength' => 50)); ?>
    <a style="padding-left: 10px;"></a>Nombres:
    <?php echo $form->textField($model, 'P4name',array('size' => 40, 'maxlength' => 50)); ?>

    <?php echo $form->error($model, 'P4lastname1'); ?>
    <?php echo $form->error($model, 'P4lastname2'); ?>
    <?php echo $form->error($model, 'P4name'); ?>
</div>
<div class='row'>
    <a style="padding-left: 33px;"></a>Dirección:
    <?php echo $form->textField($model, 'P4address',array('size' => 58, 'maxlength' => 50)); ?>
    <a style="padding-left: 15px;"></a>Teléfono:
    <?php echo $form->textField($model, 'P4tel',array('size' => 20, 'maxlength' => 50)); ?>

    <?php echo $form->error($model, 'P4typeid'); ?>
    <?php echo $form->error($model, 'P4id'); ?>
    <?php echo $form->error($model, 'P4address'); ?>
    <?php echo $form->error($model, 'P4tel'); ?>
</div>
</fieldset>
</div>
