<?php

class SDNTest extends WebTestCase {

  public function testSDN() {
    $this->open("/site/login.html");
    $this->type("id=LoginForm_username", "admin@svision.co");
    $this->type("id=LoginForm_password", "MyPassword1");
    $this->click("name=loginSubmit");
    $this->waitForPageToLoad("2000");
    $this->click("//div[@id='mainmenu']/div/div[2]/div/div[3]/div/div[2]/a/span");
    $this->waitForPageToLoad("2000");
    $this->type("id=SDNSearchForm_firstname", "Pedro");
    $this->type("id=SDNSearchForm_lastname", "Perez");
    $this->click("name=yt0");
    $this->waitForPageToLoad("2000");
    $this->assertTextPresent('Hay 26 registros');
    
    $this->click("//div[@id='mainmenu']/div/div[2]/div/div[3]/div/div[2]/a/span");
    $this->waitForPageToLoad("2000");
    $this->type("id=SDNSearchForm_firstname", "Pedro");
    $this->type("id=SDNSearchForm_lastname", "Rodriguez");
    
    
    $this->click("name=yt0");
    $this->waitForPageToLoad("2000");
    $this->assertTextPresent('Hay 32 registros');
    
    $this->click("link=Hay 31 registros");
    $this->waitForPageToLoad("50");
    $this->assertTextPresent('BERM700325');
    $this->click("css=span.ui-icon.ui-icon-closethick");
    $this->waitForPageToLoad("2000");
    
    $this->click("//div[@id='mainmenu']/div/div[2]/div/div[3]/div/div[2]/a/span");
    $this->waitForPageToLoad("2000");
    $this->type("id=SDNSearchForm_firstname", "Rodriguez");
    $this->type("id=SDNSearchForm_lastname", "Pedro");
    $this->click("name=yt0");
    $this->waitForPageToLoad("2000");
    $this->assertTextPresent('No se encontraron registros');
  }

}
