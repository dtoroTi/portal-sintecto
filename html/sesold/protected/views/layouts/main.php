<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">

            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?>
                    <?php if (Yii::app()->params['serverType'] != "online") : ?>
                        <span id="logoServer">&nbsp; ** <?= strtoupper(Yii::app()->params['serverType']); ?> **</span>
                    <?php endif; ?>

                </div>
            </div><!-- header -->

            <div id="mainmenu">
                <?php
                $this->widget('ext.cssmenu.CssMenu', AppMenu::getMenu());
                ?>                
            </div><!-- mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
                <?php if (!Yii::app()->user->isGuest): ?>
                    Usuario: <b><?php echo Yii::app()->user->arUser->name; ?></b> &nbsp;&nbsp;&nbsp; Conectado desde:<b><?php echo $_SERVER['REMOTE_ADDR']; ?> </b><br/>
                <?php endif; ?>
                Copyright &copy; <?php echo date('Y'); ?> by Sintecto Ltda.<br/>
                All Rights Reserved.<br/>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
