<?php
/* @var $this SDNController */
/* @var $model SDN */

$this->breadcrumbs = array(
    'Sdns' => array('admin'),
);
?>

<h1>Actualizar la base de datos de la Lista de Sanciones de la ONU</h1>
<p>Consolidated United Nations Security Council Sanctions List</p>

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
    <legend>Base de datos en consolidated.xml</legend>  
    <hint>Esta base de datos se va a descargar automáticamente del siguiente sitio
        <?php echo CHtml::link(SdnType::UN_LIST_URL,SdnType::UN_LIST_URL,array('target'=>'_blank'))?>
    </hint>
  </fieldset>


  <div class="row buttons">
    <?php echo CHtml::submitButton('Actualizar', array('name' => 'uploadButton')); ?>
  </div>

  <?php $this->endWidget(); ?>

</div><!-- form -->  






