<?php
/* @var $this SDNController */
/* @var $model SDN */

$this->breadcrumbs = array(
    'Sdns' => array('admin'),
);
?>

<h1>Actualizar la base de datos de Listas Peps</h1>


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
    <legend>Base de datos Listas Peps</legend>  
    <div class="row">
      <?php echo $form->labelEx($docForm, 'doc2'); ?>
      <?php echo $form->fileField($docForm, 'doc2'); ?>
    </div>

    <hint>Esta base de datos de Listas PEPS la puede descargar comunicandose con el Administrador de IT.

    </hint>
  </fieldset>


  <div class="row buttons">
    <?php echo CHtml::submitButton('Actualizar', array('name' => 'uploadButton')); ?>
  </div>

  <?php $this->endWidget(); ?>

</div><!-- form -->  






