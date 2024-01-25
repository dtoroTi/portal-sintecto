<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<div> 

<style>
    #imgensss {
        float:right;
        border-radius: 5%;
        margin: 4%; 
    }
    .slide {
        position: relative;
        box-shadow: 0px 1px 6px rgba(0, 0, 0, 0.64);
        margin-top: -5px;
    }
    .slide-inner {
        float:right;
        position: relative;
        overflow: visible;
        width: 35%;
        height: 35%;
        left: -60px;
    }
    .slide-open:checked + .slide-item {
        position: static;
        opacity: 100;
    }
    .slide-item {
        float:right;
        position: absolute;
        opacity: 0;
        -webkit-transition: opacity 0.6s ease-out;
        transition: opacity 0.6s ease-out;
    }
    .slide-item img {
        display: block;
        height: auto;
        max-width: 100%;
    }
    .slide-control {
        background: rgba(0, 0, 0, 0.28);
        border-radius: 100%;
        color: #fff;
        cursor: pointer;
        display: none;
        font-size: 40px;
        height: 40px;
        line-height: 40px;
        position: absolute;
        top: 50%;
        -webkit-transform: translate(0, -50%);
        cursor: pointer;
        -ms-transform: translate(0, -50%);
        transform: translate(0, -50%);
        text-align: center;
        width: 40px;
        z-index: 10;
    }
    .slide-control.prev {
        left: -4%;
    }
    .slide-control.next {
        right: 6%;
    }
    .slide-control:hover {
        background: rgba(0, 0, 0, 0.8);
        color: #aaaaaa;
    }
    #slide-1:checked ~ .control-1,
    #slide-2:checked ~ .control-2,
    #slide-3:checked ~ .control-3 {
        display: block;
    }
    .slide-indicador {
        list-style: none;
        margin: 0;
        padding: 0;
        position: absolute;
        bottom: 2%;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 10;
    }
    .slide-indicador li {
        display: inline-block;
        margin: 0 5px;
    }
    .slide-circulo {
        color: #828282;
        cursor: pointer;
        display: block;
        font-size: 35px;
    }
    .slide-circulo:hover {
        color: #aaaaaa;
    }
    #slide-1:checked ~ .control-1 ~ .slide-indicador 
            li:nth-child(1) .slide-circulo,
    #slide-2:checked ~ .control-2 ~ .slide-indicador 
            li:nth-child(2) .slide-circulo,
    #slide-3:checked ~ .control-3 ~ .slide-indicador 
            li:nth-child(3) .slide-circulo {
        color: #428bca;
    }
</style>

<div class="slide">
            <div class="slide-inner">
                <input class="slide-open" type="radio" id="slide-1" name="slide" aria-hidden="true" hidden="" checked="checked">
                <div class="slide-item">
                <a title="Seminario" href="https://www.sintectoacademia.com/post/es-en-realidad-un-riesgo-la-salud-mental-en-la-selecci%C3%B3n-de-candidatos"><img id="imgensss" src="https://sintecto.com/wp-content/uploads/2023/12/Pieza-Cumplimiento-Part-1.jpg"></a>
                </div>
                <input class="slide-open" type="radio" id="slide-2"  name="slide" aria-hidden="true" hidden="">
                <div class="slide-item">
                <a title="Seminario" href="https://www.sintectoacademia.com/post/es-en-realidad-un-riesgo-la-salud-mental-en-la-selecci%C3%B3n-de-candidatos"><img  id="imgensss" src="https://sintecto.com/wp-content/uploads/2023/12/Pieza-Cumplimiento-Part-2.jpg"></a>
                </div>
                <input class="slide-open" type="radio" id="slide-3" 
                      name="slide" aria-hidden="true" hidden="">
                <div class="slide-item">
                <a title="Seminario" href="https://www.sintectoacademia.com/post/es-en-realidad-un-riesgo-la-salud-mental-en-la-selecci%C3%B3n-de-candidatos">
                    <img id="imgensss" src="https://sintecto.com/wp-content/uploads/2023/12/Pieza-Cumplimiento-Part-3.jpg">
                </a>
                </div>
                <label for="slide-3" class="slide-control prev control-1">‹</label>
                <label for="slide-2" class="slide-control next control-1">›</label>
                <label for="slide-1" class="slide-control prev control-2">‹</label>
                <label for="slide-3" class="slide-control next control-2">›</label>
                <label for="slide-2" class="slide-control prev control-3">‹</label>
                <label for="slide-1" class="slide-control next control-3">›</label>
                <ol class="slide-indicador">
                    <li>
                        <label for="slide-1" class="slide-circulo">•</label>
                    </li>
                    <li>
                        <label for="slide-2" class="slide-circulo">•</label>
                    </li>
                    <li>
                        <label for="slide-3" class="slide-circulo">•</label>
                    </li>
                </ol>
            </div>
        </div>

<h1>Ingreso al Sistema</h1>

<p>Por favor ingrese su usuario y palabra clave asignada:</p>

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
  //  <label for="LoginForm_otp" class="required">Llave<span class="required">*</span></label>
  //  <input name="LoginForm[otp]" id="LoginForm_password" type="otp" size="40"/>
  //</div>
?>

  <div class="row buttons">
    <?php echo CHtml::submitButton('Ingresar al Sistema'); ?>
  </div>

  <?php $this->endWidget(); ?>
</div><!-- form -->


