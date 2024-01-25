<?php $this->pageTitle = Yii::app()->name; ?>
<h1>Bienvenido a Sintecto Ltda</h1>
<h2>Estudios de seguridad a personas y empresas. </h2>
<p>Si tiene problemas con la aplicación o necesita soporte, por favor haga click en el siguiente botón e ingrese con su usuario y contraseña.</p>
 <?php
 /*
 echo CHtml::button('Diligenciar Formato', array('onclick' =>
       "var a = document.createElement('a');a.href='https://docs.google.com/a/securityandvision.com/forms/d/1p8Ot_7MnFm-GFmyla9GvvfgbVZmjFuIc6C0zO0U9omA/viewform';a.target = '_blank';document.body.appendChild(a);a.click();"));
*/
echo CHtml::button('Plataforma de Soporte', array('onclick' =>
    "var a = document.createElement('a');a.href='http://soporte.sintecto.com/login_page.php';a.target = '_blank';document.body.appendChild(a);a.click();"));


?>
<!-- MUESTRA LA VERSION DE YII INSTALADA EN EL SERVIDOR-->
<br><br>
<hr>
<div>
<p>Versión de aplicación: <?php echo Yii::getVersion(); ?></p>
</div>