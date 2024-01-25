<?php

require_once(dirname(__FILE__) .'/../../conf/conf.php');

// change the following paths if necessary
$yii = dirname(__FILE__) . '/../yii1/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

if (SAV_SYSTEM == 'dev'  ) {
  //activate Debug only on debug
  defined('YII_DEBUG') or define('YII_DEBUG', true);
  defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
  define('YII_ENABLE_ERROR_HANDLER', true);
  define('YII_ENABLE_EXCEPTION_HANDLER', true);
}



require_once($yii);
Yii::createWebApplication($config)->run();	


