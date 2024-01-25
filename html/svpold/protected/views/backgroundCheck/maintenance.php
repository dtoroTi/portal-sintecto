<?php
$this->pageTitle = Yii::app()->name . ' - Mantenimiento';
$this->breadcrumbs = array(
    'admin',
);
?>

<h1>Mantenimiento</h1>

<?php if (Yii::app()->user->hasFlash('notification')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
    <br/>
<?php endif; ?>

<p>
    Por favor digite a continuación la fecha hasta la cual quiere liberar el espacio en disco.
</p>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => '/backgroundCheck/mainteinance/',
        'id' => 'mainteinance',
        'enableClientValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'customerGroupId'); ?>
        <?php
        echo $form->dropdownList($model, //
                'customerGroupId', //
                CHtml::listData(//
                        CustomerGroup::model()->findAll(array('order' => 'name asc')), 'id', 'name'), array('prompt' => 'Grupo...'));
        ?>
        <?php echo $form->error($model, 'customerGroupId'); ?>
    </div>    
    <div class="row">
        <?php echo $form->labelEx($model, 'customerId'); ?>
        <?php
        echo $form->dropdownList($model, //
                'customerId', //
                CHtml::listData(//
                        Customer::model()->findAll(array('order' => 'name asc')), 'id', 'name'), array('prompt' => 'Cliente...'));
        ?>
        <?php echo $form->error($model, 'customerId'); ?>
    </div>    

    <div class="row">
        <?php echo $form->labelEx($model, 'customerProductName'); ?> 
        <?php echo $form->textField($model, 'customerProductName'); ?>
        <?php echo $form->error($model, 'customerProductName'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'resultId'); ?>
        <?php
        echo $form->dropdownList($model, //
                'resultId', //
                CHtml::listData(//
                        Result::model()->findAll(array('order' => 'name asc')), 'id', 'name'), array('prompt' => 'Resultado...'));
        ?>
        <?php echo $form->error($model, 'customerId'); ?>
    </div>    

    <div class="row">
        <?php echo $form->labelEx($model, 'studyStartedOnFrom'); ?> *
        <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'studyStartedOnFrom',
                'value' => $model->created,
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
                    'style' => 'width:6em;', 
                    'readonly' => 'readonly'
    
                ),
            )); 
        ?>
        <?php //echo $form->textField($model, 'studyStartedOnFrom'); ?>
        <?php echo $form->error($model, 'studyStartedOnFrom'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'studyStartedOnUntil'); ?> *
        <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'studyStartedOnUntil',
                'value' => $model->created,
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
                    'style' => 'width:6em;', 
                    'readonly' => 'readonly'
    
                ),
            )); 
        ?>
        <?php //echo $form->textField($model, 'studyStartedOnUntil'); ?>
        <?php echo $form->error($model, 'studyStartedOnUntil'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Iniciar Log'); ?>
        <?php echo CHtml::checkBox("log", false) ?>
    </div>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Calcular', array('name' => 'calculate')); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Limpiar el Log', array('name' => 'clearLog', 'onClick' => 'if (confirm("Realmente desea limpiar el log a la fecha?") && confirm("Toda la información del log será borrará. Está de acuerdo?")) {return true;}else{return false;}')); ?>
    </div>

    <?php if ($counted): ?>
        <div class="row buttons">
            <?php echo CHtml::submitButton('Guardar', array('name' => 'save')); ?>
        </div>
    <?php endif ?>
    <?php if ($saved): ?>
        <div class="row buttons">
            <?php echo CHtml::submitButton('Descargar', array('name' => 'discharge', 'onClick' => 'if (confirm("Realmente desea eliminar los estudios previos a la fecha?") && confirm("Toda la información de las secciones se borrará. Está de acuerdo?")) {return true;}else{return false;}')); ?>
        </div>
    <?php endif; ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->


<h1>Recuperación de archivos-Certificados de un cliente</h1>

<p>
    Por favor seleccione el cliente del que quiere recuperar los archivos.
</p>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => '/backgroundCheck/mainteinance/',
        'id' => 'mainteinance',
        'enableClientValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

     <div class="row">
        <?php echo $form->labelEx($model, 'customerId'); ?>
        <?php
        echo $form->dropdownList($model, //
                'customerId', //
                CHtml::listData(//
                        Customer::model()->findAll(array('order' => 'name asc')), 'id', 'name'), array('prompt' => 'Cliente...'));
        ?>
        <?php echo $form->error($model, 'customerId'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'createdOnFrom'); ?> *
        <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'createdOnFrom',
                'value' => $model->created,
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
                    'style' => 'width:6em;', 
                    'readonly' => 'readonly'
    
                ),
            )); 
        ?>
        <?php //echo $form->textField($model, 'studyStartedOnFrom'); ?>
        <?php echo $form->error($model, 'createdOnFrom'); ?>
    </div>

    <div class="row">
    <?php echo $form->labelEx($model, 'createdOnUntil'); ?> *
    
        <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'createdOnUntil',
                'value' => $model->created,
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
                    'style' => 'width:6em;', 
                    'readonly' => 'readonly'
    
                ),
            )); 
        ?>
        <?php //echo $form->textField($model, 'studyStartedOnUntil'); ?>
        <?php echo $form->error($model, 'createdOnUntil'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Recuperar Archivos', array('name' => 'recover')); ?>
        <?php echo CHtml::submitButton('Recuperar Certificados', array('name' => 'recoverCertf')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>