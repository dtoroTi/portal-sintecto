<?php
$this->breadcrumbs = array(
    'Solicitud via Archivo',
);

$this->menu = array(
    array('label' => 'Manage BackgroundCheck', 'url' => array('admin')),
);
?>
<script>
    function checkIdNumber(ans) {
        var continueSubmit;
        if (ans == "1") {
            var r = confirm("Ya se ha solicitador previamente un estudio para la persona identificada con [" + $("#BackgroundCheck_idNumber").val() + "]. Desea volverlo a solicitar?");
            if (r == true)
            {
                continueSubmit = true;
            } else {
                continueSubmit = false;
            }
        } else {
            continueSubmit = true;
        }
        if (continueSubmit) {
            $("#person-security-evaluation-form").trigger("submit");
        }
    }
</script>

<h1>Solicitar Estudios de Seguridad vía Archivo</h1>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ProcessView.css" />

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'person-security-evaluation-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => (array('enctype' => 'multipart/form-data'))
    ));
    ?>

    <?php echo $form->errorSummary($backgroundCheck); ?>
    <fieldset>
        <legend>Cliente y tipo de Reporte</legend>  

        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'customerId'); ?>
            <?php echo $backgroundCheck->customer->name; ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'customerUserId'); ?>
            <?php echo $backgroundCheck->customerUser->username; ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($backgroundCheck, 'customerProductId'); ?>
            <?php
            echo CHtml::activeDropDownList(//
                    $backgroundCheck, //
                    'customerProductId', //
                    CHtml::listData(
                            $backgroundCheck->customer ? $backgroundCheck->customer->customerProducts : array(), //
                            'id', //
                            'name'));
            ?>
            <?php echo $form->error($backgroundCheck, 'customerProductId'); ?>

        </div>


        <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="row">
                <?php $field = 'field' . $i; ?>
                <?php if ($backgroundCheck->customer->$field != ""): ?>
                    <?php echo $form->labelEx($backgroundCheck, $backgroundCheck->customer->$field, array('id' => 'field' . $i)); ?>
                    <?php echo $form->textField($backgroundCheck, 'customerField' . $i, array('size' => 60, 'maxlength' => 255)); ?>
                    <?php echo $form->error($backgroundCheck, 'customerField' . $i); ?>
                <?php endif; ?>
            </div>
        <?php endfor; ?>



    </fieldset>

    <fieldset >
        <fieldset >
            <legend>Archivo con los datos</legend>  
            <div class="row">
                <?php echo $form->labelEx($docForm, 'doc'); ?>
                <?php echo $form->fileField($docForm, 'doc'); ?>
            </div>
        </fieldset>

        <?php echo CHtml::submitButton('Solicitar'); ?>

        <?php $this->endWidget(); ?>

</div><!-- form -->