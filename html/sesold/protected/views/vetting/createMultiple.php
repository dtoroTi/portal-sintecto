<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ProcessView.css" />
<?php
if(!Yii::app()->user->arUser || !Yii::app()->user->arUser->canRequestPersonReport){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Solicitar Multiples Estudios',
);
?>

<h1>Crear Multiples Estudios de Seguridad</h1>

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
        'id' => 'person-security-evaluation-form',
        'enableAjaxValidation' => false,
        'action' => array('/vetting/createMultiple'),
        'htmlOptions' => (array('enctype' => 'multipart/form-data')),
            )
    );
    ?>

    <?php echo $form->errorSummary($model); ?>
    <fieldset>
        <legend>Cliente y tipo de Reporte</legend>

        <div class="row">
            <?php   $customerId = Yii::app()->user->arUser->customerId;
                    $customer = Customer::model()->findByPk($customerId);
                    $model->customer=$customer;
                    $model->customerId=$customerId;
                    $customerIad = Yii::app()->user->arUser->id;
                    $customeraia = CustomerUser::model()->findByPk($customerIad);
                    $user = CustomerUser::model()->findByPK(Yii::app()->user->id);
                    $model->customerUser=$customeraia;
                    $model->customerUserId=$customerIad;
        ?>    
        
        <?php if (Yii::app()->user->getIsGroupSupervisor()): ?>
           <?php echo $form->labelEx($model, 'customerId'); ?>           
                <?php
                echo CHtml::activeDropDownList(//
                        $model, //
                        'customerId', //
                        CHtml::listData(Customer::model()->findAllByAttributes(array('customerGroupId' => $user->customer->customerGroupId)), 'id', 'name'), array('prompt' => '...'));?>
           <?php else: ?>
              <?php echo $form->labelEx($model, 'customerId'); ?>
              <?php echo CHtml::encode($model->customer->name); ?>
              <?php echo CHtml::activeHiddenField($model, 'customerId'); ?>
          <?php endif; ?>
                <?php echo $form->error($model, 'customerId'); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'customerProductId'); ?>

            <?php if (Yii::app()->user->getIsGroupSupervisor()): ?>
                <?php
                $customerProducts = $model->customer ? $model->customer->customerGroup->getCustomerProductByType() : array();
                $customerProductsArray = array();
                /* @var $customerProduct CustomerProduct */
                foreach ($customerProducts as $customerProduct) {
                    if ($customerProduct->isActive) {
                        $customerProductsArray[$customerProduct->id] = $customerProduct->customer->name . ':' . $customerProduct->name;
                    }
                }
                echo CHtml::activeDropDownList(//
                    $model, //
                    'customerProductId', $customerProductsArray);
                ?>
            <?php else: ?>
                <?php
                echo CHtml::activeDropDownList(//
                    $model, //
                    'customerProductId', //
                    CHtml::listData(
                        $model->customer ? $model->customer->getCustomerProductByTypeintegridad() : array(), //
                        'id', //
                        'name'));
                ?>
            <?php endif; ?>
            <?php echo $form->error($model, 'customerProductId'); ?>

        </div>  
        <div class="row">
            <?php echo $form->labelEx($model, 'customerUserId'); ?>          
            <?php echo $form->error($model, 'customerUserId'); ?>
            <?php echo CHtml::encode($model->customerUser->username) ?>
            <?php echo $form->hiddenField($model, 'customerUserId'); ?>
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
            <?php foreach ($permitedFields as $field): ?>
                [<?php echo BackgroundCheck::model()->getAttributeLabel($field) ?>]&nbsp;
            <?php endforeach; ?>
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