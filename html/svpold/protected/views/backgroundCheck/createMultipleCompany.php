<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ProcessView.css" />
<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}

$this->breadcrumbs = array(
    'Background Checks' => array('admin'),
    'Create',
);
?>

<h1>Solicitar Multiples Estudios para Empresas</h1>


<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('notification')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
<?php endif; ?>

<div class="form wide ProcessTab">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'company-security-evaluation-form',
        'enableAjaxValidation' => false,
        'action' => array('/backgroundCheck/createMultipleCompany'),
        'htmlOptions' => (array('enctype' => 'multipart/form-data')),
            )
    );
    ?>

    <?php echo $form->errorSummary($model); ?>
    <fieldset>
        <legend>Cliente y tipo de Reporte</legend>  

        <div class="row">
            <?php echo $form->labelEx($model, 'customerId'); ?>
            <?php if ($model->isNewRecord): ?>
                <?php
                echo $form->dropDownList(
                        $model, //
                        'customerId', //
                        CHtml::listData(Customer::model()->customersWithUsersAndProducts(1), 'id', 'name'), //
                        array(//
                    'ajax' => array(
                        'type' => 'POST', //request type
                        'url' => CController::createUrl('/customer/dynamicCustomerProducts', array('companySurvey' => 1)),
                        'success' => '  
                  function updateDropdownLists(data){
                      $("#BackgroundCheck_customerUserId").html(data.customerUsers);
                      $("#BackgroundCheck_customerProductId").html(data.customerProducts);
                      if (data.customerFields.field1!=null) {
                        $("#field1").html(data.customerFields.field1);
                      }else{
                        $("#field1").html("&nbsp;");
                      }
                      if (data.customerFields.field2!=null) {
                        $("#field2").html(data.customerFields.field2);
                      }else{
                        $("#field2").html("&nbsp;");
                      }
                      if (data.customerFields.field3!=null) {
                        $("#field3").html(data.customerFields.field3);
                      }else{
                        $("#field3").html("&nbsp;");
                      }
                      if (data.customerFields.field4!=null) {
                        $("#field4").html(data.customerFields.field4);
                      }else{
                        $("#field4").html("&nbsp;");
                      }
                      if (data.customerFields.field5!=null) {
                        $("#field5").html(data.customerFields.field5);
                      }else{
                        $("#field5").html("&nbsp;");
                      }
                      if (data.customerFields.field6!=null) {
                        $("#field6").html(data.customerFields.field6);
                      }else{
                        $("#field6").html("&nbsp;");
                      }
                      if (data.customerFields.field7!=null) {
                        $("#field7").html(data.customerFields.field7);
                      }else{
                        $("#field7").html("&nbsp;");
                      }
                      if (data.customerFields.field8!=null) {
                        $("#field8").html(data.customerFields.field8);
                      }else{
                        $("#field8").html("&nbsp;");
                      }
                      if (data.customerFields.field9!=null) {
                        $("#field9").html(data.customerFields.field9);
                      }else{
                        $("#field9").html("&nbsp;");
                      }
                    }',
                        'error' => '
                  function(XMLHttpRequest, textStatus, errorThrown){
                        alert("Error en llamada Dinámica " + errorThrown);
                    }',
                        'dataType' => 'json',
                    ),
                    'prompt' => 'Cliente...',
                ));
                ?>
                <?php echo $form->error($model, 'customerId'); ?>
            <?php else: ?>
                <?php echo CHtml::encode($model->customer->name) ?>
            <?php endif; ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'customerProductId'); ?>
            <?php if ($model->isNewRecord): ?>
                <?php
                echo CHtml::activeDropDownList(//
                        $model, //
                        'customerProductId', //
                        CHtml::listData(
                                $model->customer ? $model->customer->customerProducts : array(), //
                                'id', //
                                'name'), //
                        array('prompt' => '',));
                ?>
                <?php echo $form->error($model, 'customerProductId'); ?>
            <?php else: ?>
                <?php echo CHtml::encode($model->customerProduct->name) ?>
                <?php if (!$model->isNewRecord && (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole())): ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
                    echo CHtml::button('Cambiar', array('onclick' =>
                        "showSectionTypeDialog();"));
                    ?>
                <?php endif; ?>
            <?php endif; ?>

        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'customerUserId'); ?>
            <?php
            echo CHtml::activeDropDownList(//
                    $model, //
                    'customerUserId', //
                    CHtml::listData(
                            $model->customer ? $model->customer->customerUsers : array(), //
                            'id', //
                            'username'), //
                    array('prompt' => '',));
            ?>
            <?php echo $form->error($model, 'customerUserId'); ?>
        </div>

    </fieldset>


    <fieldset>
        <legend>Cargar archivo</legend>
        <div class="row">
            <?php echo CHtml::label('Tipo de Archivo', 'fileType'); ?>
            <?php echo CHtml::dropDownList('fileType', 'pc', array('pc' => 'PC', 'mac' => 'Mac')); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($file, 'doc'); ?>
            <?php echo $form->fileField($file, 'doc'); ?>
        </div>
        <hint>El archivo debe estar separado por Tabuladores "TAB" y el nombre debe terminar .txt
        </hint>
        <p>
            <?php /*foreach ($permitedCompanyFields as $field): ?>
                [<?php echo BackgroundCheck::model()->getAttributeLabel($field) ?>]&nbsp;
            <?php endforeach; */?>

            [Razón Social]&nbsp;
            [Nit]&nbsp;
            [Teléfono]&nbsp;
            [Celular]&nbsp;
            [Email]&nbsp;

        </p>

    </fieldset>




    <?php echo CHtml::submitButton('Cargar', array('name' => 'uploadButton')); ?>

    <?php $this->endWidget(); ?>

</div>
<?php /*
<div class="form wide ProcessTab">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'person-security-evaluation-form',
        'enableAjaxValidation' => false,
        'action' => array('/backgroundCheck/createMultipleArmada'),
        'htmlOptions' => (array('enctype' => 'multipart/form-data')),
            )
    );
    ?>

    <fieldset>
        <legend>Cargar archivo Armada</legend>
        <div class="row">
            <?php echo $form->labelEx($file, 'doc'); ?>
            <?php echo $form->fileField($file, 'doc'); ?>
        </div>
        <p>
            <?php foreach ($permitedFields as $field): ?>
                [<?php echo BackgroundCheck::model()->getAttributeLabel($field) ?>]&nbsp;
            <?php endforeach; ?>
        </p>

    </fieldset>

    <?php echo CHtml::submitButton('Cargar CSV', array('name' => 'uploadButton')); ?>

    <?php $this->endWidget(); ?>

    <?php echo CHtml::button('Revisar Archivos Zip', array('submit' => array('/backgroundCheck/RevisarArchivosZip'))); ?>
</div>
*/?>