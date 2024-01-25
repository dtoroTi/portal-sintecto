<?php

class SiteTest extends WebTestCase {

  public function testLogin() {
    $this->open('/site/login');
    $this->type("LoginForm_username", "admin@svision.co");
    $this->click("loginSubmit");
    $this->waitForPageToLoad("1000");
    $this->assertTextPresent('Palabra Clave no puede ser nulo.');

    $this->type("LoginForm_username", "");
    $this->type("LoginForm_password", "test");
    $this->click("loginSubmit");
    $this->waitForPageToLoad("1000");
    $this->assertTextPresent('Usuario (email) no puede ser nulo.');

    $this->type("LoginForm_username", "admin@svision.co");
    $this->type("LoginForm_password", "test");
    $this->click("loginSubmit");
    $this->waitForPageToLoad("1000");
    $this->assertTextPresent('Usuario, Palabra clave o llave incorrecta.');


    $this->type("LoginForm_username", "admin@svision.co");
    $this->type("LoginForm_password", "MyPassword1");
    $this->click("loginSubmit");
    $this->waitForPageToLoad("1000");
    $this->assertTextPresent('Configuración');
    $this->assertTextPresent('S&V Estudios');
    $this->assertTextPresent('Admin');
    $this->assertTextPresent('SYS Admin');
    $this->assertTextPresent('Cerrar Sesión');

    $this->click("link=Cerrar Sesión");
    $this->waitForPageToLoad("1000");
    $this->assertTextPresent('Login');
  }

}
