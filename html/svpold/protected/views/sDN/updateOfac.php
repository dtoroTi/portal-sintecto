<?php
/* @var $this SDNController */
/* @var $model SDN */

$this->breadcrumbs = array(
    'Sdns' => array('admin'),
);
?>

<h1>Actualizar la base de datos de OFAC</h1>
<p>Specially Designated Nationals List (SDN)</p>

<div class="form wide">


  <?php if (Yii::app()->user->hasFlash('notification')): ?>
    <div class="flash-notice">
      <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
  <?php endif; ?>

  <?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="flash-error">
      <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
  <?php endif; ?>

  <?php if ($sdnVersion) : ?>

    <p>La base de datos actual está en el siguiente estado:</p>

    <fieldset>
      <div class="row">
        <label>Estado:</label><?php echo ($sdnVersion->isActive ? "Activa" : '<span class="RedMatch">Inactiva<span>'); ?>
      </div>
      <div class="row">
        <label>Descargada en:</label><?php echo CHtml::encode($sdnVersion->downloaded); ?>
      </div>
      <div class="row">
        <label>Numero de Registros:</label><?php echo CHtml::encode($sdnVersion->numRecords); ?>
      </div>
    </fieldset>

  <?php else: ?>

    <div class="flash-error">La base de datos no ha sido descargada.</div>

  <?php endif; ?>


  <?php
  $form = $this->beginWidget('CActiveForm', array(
      'id' => 'sdn-uploadDB-form',
      'enableAjaxValidation' => false,
      'htmlOptions' => (array('enctype' => 'multipart/form-data')),
          ));
  ?>
  <fieldset >
    <legend>Base de datos en sdn.pip</legend>  
    <div class="row">
      <?php echo $form->labelEx($docForm, 'doc'); ?>
      <?php echo $form->fileField($docForm, 'doc'); ?>
    </div>
    <hint>Esta base de datos la puede descargar de 
      <a href="http://www.treasury.gov/resource-center/sanctions/SDN-List/Pages/default.aspx" target="_blank">
        http://www.treasury.gov/resource-center/sanctions/SDN-List/Pages/default.aspx
      </a>
    </hint>
  </fieldset>


  <div class="row buttons">
    <?php echo CHtml::submitButton('Actualizar', array('name' => 'uploadButton')); ?>
  </div>

  <?php $this->endWidget(); ?>

</div><!-- form -->  






