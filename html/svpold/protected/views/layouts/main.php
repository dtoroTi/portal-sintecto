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
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome/css/font-awesome.min.css" />
        <link rel="apple-touch-icon" href="/apple-touch-icon-precomposed.png"/>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139132477-1"></script>-->
        <!--<script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-139132477-1');
        </script>-->
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
                Usuario <?php echo Yii::app()->user->name; ?><br/>
                Copyright &copy; <?php echo date('Y'); ?> by SINTECTO.  All Rights Reserved.<br/>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
