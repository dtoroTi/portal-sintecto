<?php

class CustomerTest extends WebTestCase {

  public function testCreateCustomer() {
    $this->open('/site/login');
    $this->type("LoginForm_username", "admin@svision.co");
    $this->type("LoginForm_password", "MyPassword1");
    $this->click("loginSubmit");
    $this->waitForPageToLoad("1000");
    $this->assertTextPresent('Cerrar Sesión');

    $this->open("/site/login.html");
    $this->click("//div[@id='mainmenu']/div/div[4]/div/div/div/div[2]/a/span");
    $this->waitForPageToLoad("1000");
    $this->type("id=Customer_name", "Recruit");
    $this->type("id=Customer_comments", "Este es un cliente temporal");
    $this->type("id=Customer_field1", "Campo 1");
    $this->type("id=Customer_field2", "No. de Solicitud");
    $this->type("id=Customer_field3", "Id de Trabajo");
    $this->select("id=Customer_notifyByMail", "label=Si");
    $this->click("name=yt0");
    $this->waitForPageToLoad("1000");
//    $this->click("name=loginSubmit");
//    $this->waitForPageToLoad("1000");

    $this->assertTextPresent('Cliente #');
    $this->assertTextPresent('Recruit');
    $this->assertTextPresent('Este es un cliente temporal');
    $this->assertTextPresent('Campo 1');
    $this->assertTextPresent('No. de Solicitud');
    $this->assertTextPresent('Id de Trabajo');
    $this->assertTextPresent('Yes');

    // Delete the just created customer
    $customerId = $this->getText('customerId');
    
    $this->open("/customer/update/".$customerId.".html");
    $this->click("id=deleteCustomer");
    $this->waitForPageToLoad("1000");
    $this->assertTextPresent('Se ha borrado el cliente : Recruit');
     

//    $this->runScript("javascript{alert('hola');}");
//    $this->waitForPageToLoad("5000");
//    $this->runScript("javascript{alert('hola2');}");
    
  }

}
