<?php
require_once(dirname(__FILE__).'/../../conf/conf.php');

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii1/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

@$serverName = $_SERVER['SERVER_NAME'];
if ( SAV_SYSTEM == 'dev' || SAV_SYSTEM == 'devport' || SAV_SYSTEM == 'test'  ) {
  //activate Debug only on debug
  defined('YII_DEBUG') or define('YII_DEBUG', true);
  defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
}

require_once($yii);
Yii::createWebApplication($config)->run();
