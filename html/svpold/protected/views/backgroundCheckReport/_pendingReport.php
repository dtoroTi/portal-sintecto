<h2 class="<?php echo (!$firstPage ? 'PageBreak' : ''); ?>">
    Para uso exclusivo interno de S&V</h2>
<?php if ($responsible): ?>
<h2><?php echo mb_strtoupper($responsible->name, 'UTF-8'); ?></h2>
<?php endif; ?>
<br/>
<?php foreach ($printSection as $key => $print): ?>
    <?php if ($print): ?>
        <div>
            <h3><?php echo BackgroundCheck::model()->getAttributeLabel($key); ?></h3>
            <?php echo $this->renderInternal(Yii::app()->basePath . '/views/backgroundCheckReport/_pendingTable.php', array('reports' => $reports, 'condition' => $key, 'style' => $style)); ?>
        </div>
        <br/>
    <?php endif; ?>
<?php endforeach; ?>
