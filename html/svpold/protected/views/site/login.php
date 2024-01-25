<?php
/*
echo'<script type="text/javascript">
    alert("Les informamos que a partir del día primero de febrero del año 2021 nuestra nueva sede estará ubicada en la carrera 45 # 97-50 edificio Porto 100 - Oficina 807 y nuestro nuevo número de contacto en la ciudad de Bogotá será el (1) 915 9000.");
</script>';
*/
?>

<!--
<div> 

<style>
  #imgensss {
    float:right;
    border-radius: 5%;
    margin: 4%; 
   
  }
</style>
<a title="Seminario" href="https://www.sintecto.com" target="_blank"> <img id="imgensss" src="https://sintecto.com/wp-content/uploads/2023/12/Pieza-Fin-de-Ano.png" width=35% height=35% style="border:solid" alt="Seminario" /></a>

</div>
-->

<h1>Ingreso al Sistema</h1>
<p>Por favor ingrese su usuario y palabra clave asignada:</p>

<br/>
<br/>

<div class="form wide" id="loginForm">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>
    <?php echo $form->errorSummary($model); ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>




    <div class="row">
        <label for="LoginForm_username" class="required">Usuario (email) <span class="required">*</span></label>
        <input name="LoginForm[username]" id="LoginForm_username" type="text" size="40" autocomplete="off" /></div>

    <div class="row">
        <label for="LoginForm_password" class="required">Palabra Clave <span class="required">*</span></label>
        <input name="LoginForm[password]" id="LoginForm_password" type="password" size="40" autocomplete="off"/>
        <p class="hint">
            *Si tiene inconvenientes en ingresar al sistema, por favor comuniquese con soporte técnico.
        </p>
    </div>

    <?php if(CCaptcha::checkRequirements()): ?>
    <div class="row">
        <?php echo $form->labelEx($model,'verifyCode'); ?>
        <div>
          <?php $this->widget("CCaptcha",
                       array('buttonType'=> 'button',
                       'buttonOptions' => array(
                           'type'=>'image',
                           'width'=>'20px',
                           'height'=>'20px',
                           'src'=>'../../mantenimiento/images/refresh.png'
                       ))); ?>
          <?php echo $form->textField($model,'verifyCode'); ?>
        </div>
        <div class="hint">
          Por favor, introduzca el texto que ve en la imagen.
        </div>
        <?php echo $form->error($model,'verifyCode'); ?>
    </div>
	<?php endif; ?>
  <?php
   // <div class="row">
  //      <label for="LoginForm_otp" class="required">Llave<span class="required">*</span></label>
  //      <input name="LoginForm[otp]" id="LoginForm_password" type="otp" size="40"/>
   // </div>
?>
    <div class="row">
        <label for="terminos">Acepto <a href="/files/CONTRATO.pdf" target="_blank">términos y condiciones</a></label>
        <?php echo CHtml::checkBox('terminos',false,array('onchange' => 'habilitar()')); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Ingresar al Sistema', array('name' => 'loginSubmit','id'=>'submit')); ?>
    </div>

    <div class="rwo">
        <p class="hint">
            *Para ingresar al sistema acepte los términos y condiciones.
        </p>
    </div>

    <?php $this->endWidget(); ?>
    <script>
        document.getElementById("submit").disabled = true;
        function habilitar(){
            if(document.getElementById("terminos").checked){
                document.getElementById("submit").disabled = false;
            }else{
                document.getElementById("submit").disabled = true;
            }
        }
    </script>
</div><!-- form -->
