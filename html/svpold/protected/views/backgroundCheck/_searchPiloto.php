<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>
    
    <div class="row">
        <?php echo $form->label($model, 'deliveredToCustomerOnFrom'); ?>
        <?php //echo $form->textField($model, 'deliveredToCustomerOnFrom'); ?>
        <?php
            $this->widget('jqueryDateTime', array(
                'name' => 'BackgroundCheck[deliveredToCustomerOnFrom]',
                'value' =>  $model->deliveredToCustomerOnFrom,
                'id'=>'deliveredToCustomerOnFrom',
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'format' => 'Y-m-d H:i:s',
                    'lang' => 'es',
                    'showButtonPanel' => true,
                ),
                'htmlOptions' => array(
                    'style' => 'width:10em;'
                ),
            ))
        ?>
        <!--<p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 00:00:00
        </p>-->
    </div>

    <div class="row">
        <?php echo $form->label($model, 'deliveredToCustomerOnUntil'); ?>
        <?php //echo $form->textField($model, 'deliveredToCustomerOnUntil'); ?>
        <?php
            $this->widget('jqueryDateTime', array(
                'name' => 'BackgroundCheck[deliveredToCustomerOnUntil]',
                'value' =>  $model->deliveredToCustomerOnUntil,
                'id'=>'deliveredToCustomerOnUntil',
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'format' => 'Y-m-d H:i:s',
                    'lang' => 'es',
                    'showButtonPanel' => true,
                ),
                'htmlOptions' => array(
                    'style' => 'width:10em;'
                ),
            ))
        ?>
        <!--<p class="hint">
            * Fecha y hora en formato AAAA-MM-DD HH:MM:SS Si no escribe la hora se considerara 00:00:00
        </p>-->
    </div>
	<div class="row buttons">
    	<?php echo CHtml::button('Reporte Plan Piloto', array('onclick' => 'pilotExport();')); ?> 
	</div>

    <div>
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->

<script type="text/javascript">


    function pilotExport() {
		
		var from=$('#deliveredToCustomerOnFrom').val();
		var until=$('#deliveredToCustomerOnUntil').val();

        if (from=='' || until=='' ) {
            alert("Debe ingresar las fechas entre las cuales generara el informe.");
        }else{
            window.open("/backgroundCheck/adminPilot?from="+from+"&until="+until, '_blank');
        }
		
    }
</script>