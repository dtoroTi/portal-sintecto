<?php
/* @var $backgroundChecks BackgroundCheck[] */
?>
<div class="form wide">
    <?php echo CHtml::beginForm(array('/customerGroup/report'), 'get', array('id' => 'reportForm','target'=>'_blank')); ?>
    <?php
    $assignedUser = new AssignedUser();
    $date = new DateTime('first day of this Month');
    $date->sub(new DateInterval('P1D'));
    $untilDate = $date->format('Y-m-d');
    $date = new DateTime('first day of this Month');
    $date->sub(new DateInterval('P12M'));
    $fromDate = $date->format('Y-m-d');
    ?>

    Reporte <br/>
    <?php echo CHtml::hiddenField('customerGroupId', '', array('id' => 'customerGroupId')); ?>
    <br/>

    <div class="row">
        <?php echo CHtml::label('Desde', 'report_fromDate'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'report_fromDate',
            'value' => $fromDate,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:14px;'
            ),
        ));
        ?>
    </div>


    <div class="row">
        <?php echo CHtml::label('Hasta', 'report_untilDate'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'report_untilDate',
            'value' => $untilDate,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:14px;'
            ),
        ));
        ?>
    </div>

    <?php echo CHtml::endForm();
    ?>

</div><!-- form -->

