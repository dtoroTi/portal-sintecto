<?php

class DeployCommand extends CConsoleCommand {

  private function deploy($serverName, $migrate="") {
    $userPath = Yii::app()->params['server'][$serverName]['userPath'];
    $fullBasePath = $userPath . Yii::app()->params['server'][$serverName]['basePath'];
    $serverUser = Yii::app()->params['server'][$serverName]['serverUser'];
    $devPath = Yii::app()->params['server']['dev']['userPath'] . Yii::app()->params['server']['dev']['basePath'];

    passthru('rsync -vr -L --delete ' .
            '--exclude ".svn"  ' .
            '--exclude ".git"  ' .
            '--exclude ".hg"  ' .
            '--exclude "/assets/*" ' .
            '--exclude "/protected/runtime/*" ' .
            '--exclude "/temp/*" ' .
            '--exclude "/tests/*" ' .
            '--exclude "/index-test.php" ' .
//            '--exclude "/DumpDataCommand.php" ' .
//            '--exclude "InitialData.php" ' .
//            '--exclude "TestData.php" ' .
//            '--exclude "/data/*" ' .
            '--exclude "/.buildpath" ' .
            '--exclude ".settings" ' .
            '--exclude ".yii" ' .
            '--exclude "test.php" ' .
            '--exclude "._.DS_Store" ' .
            '--exclude ".DS_Store" ' .
            '--exclude "*.log" ' .           
            '--perms ' .
            "{$devPath} " .
            "{$serverUser}:{$fullBasePath}");
    $commands = array(
        "( rm -rf " . $fullBasePath . "assets/* ) ",
    );
    if ($migrate != "") {
      $commands [] = "( /usr/bin/php " . $fullBasePath . "protected/yiic.php migrate ".$migrate.") ";
    }
    $com = implode(" && ", $commands);
    passthru("ssh {$serverUser}  \" {$com} \"");
  }

  public function actionTest($args) {
    $migration="";
    if (isset($args[0]))
      $migration=$args[0];
    $this->deploy("test",$migration);
  }
 
  public function actionTestLocal($args) {
    $migration="";
    if (isset($args[0]))
      $migration=$args[0];
    $this->deploy("testlocal",$migration);
  }


  public function actionOnline($args) {
    $migration="";
    if (isset($args[0]))
      $migration=$args[0];
    $this->deploy("online",$migration);
  }

  public function getHelp() {
    return "Usage: \ndeploy test\ndeploy online\n";
  }

  public function getName() {
    return "deploy";
  }

}