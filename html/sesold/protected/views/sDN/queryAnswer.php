<?php
/* @var $this SDNController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Query' => array('/SDN/query'),
);

$this->menu = array(
    array('label' => 'Create SDN', 'url' => array('create')),
    array('label' => 'Manage SDN', 'url' => array('admin')),
);
?>
<h1>Resultado</h1>
<div class="form wide">
  <?php echo $this->renderPartial('_SDNVersion', array('sdnVersions' => $sdnVersions)); ?>

  <fieldset>

    <legend>Opciones</legend>    	
    <div class="row">
      <?php echo CHtml::activeLabelEx($query, 'doNotIncludePrepositions'); ?>
      <?php echo Controller::stringYesNo($query->doNotIncludePrepositions); ?>
    </div>

    <div class="row">
      <?php echo CHtml::activeLabelEx($query, 'oneFirstnameOneLastname'); ?>
      <?php echo Controller::stringYesNo($query->oneFirstnameOneLastname); ?>
    </div>

    <div class="row">
      <?php echo CHtml::activeLabelEx($query, 'allLastnames'); ?>
      <?php echo Controller::stringYesNo($query->allLastnames); ?>
    </div>


  </fieldset>

</div>

<table class="RecordsTable">

  <tr>
    <th class="Num">No.</th>
    <th class="lastname">Apellido</th>
    <th class="firstname">Nombre</th>
    <th class="remarks">Id/Otros</th>
    <th class="answer">Resultado</th>
  </tr>
  <?php foreach ($queries as $key => $rowQuery): ?>
    <?php
    $records = $rowQuery['records'];
    $query = $rowQuery['query'];
    $patterns = $rowQuery['patterns'];
    ?>


    <tr>
      <td class="Num"><?php echo CHtml::encode($key + 1) ?></td>
      <td class="lastname"><?php echo CHtml::encode(strtoupper($query->lastname)); ?></td>
      <td class="firstname"><?php echo CHtml::encode($query->firstname); ?></td>
      <td class="Remarks"><?php echo CHtml::encode($query->remarks); ?></td>
      <td>
        <?php if (count($records) > 0) : ?>
          <?php
          $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
              'id' => 'searchDetail_' . $key,
              // additional javascript options for the dialog plugin
              'options' => array(
                  'title' => 'Detalle de :' . CHtml::encode(strtoupper($query->lastname) . "," . $query->firstname),
                  'autoOpen' => false,
                  'width' => '1000px',
                  'modal' => true,
              ),
          ));
          ?>
          <table class="RecordsTableAns">
            <tr>
              <th class="entNum">Lista</th>
              <th class="entNum">Rec.</th>
              <th class="SDNName">Nombre</th>
              <th class="Program">Programa</th>
              <th class="Remarks">Identificación/Otros</th>
            </tr>
            <?php foreach ($records as $row): ?>
              <tr>
                <td class="entNum"><?php echo CHtml::encode($row->sdnType->name); ?></td>
                <td class="entNum"><?php echo CHtml::encode($row->entNum); ?></td>
                <td class="SDNName"><?php echo SDN::markPaterns(CHtml::encode($row->SDNName),$patterns,"RedMatch"); ?></td>
                <td class="Program"><?php echo CHtml::encode($row->program); ?></td>
                <td class="Remarks"><?php echo SDN::markPaterns(CHtml::encode($row->remarks),$patterns,"RedMatch"); ?></td>
              </tr>
            <?php endforeach; ?>
          </table>

          <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

          <span class="RedMatch">***</span>
          <?php
          echo CHtml::link('Hay ' . count($records) . ' registros', '#', array(
              'onclick' => '$("#searchDetail_' . $key . '").dialog("open"); return false;',
          ));
          ?>
          <span class="RedMatch">***</span>
        <?php else: ?>
          No se encontraron registros
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
