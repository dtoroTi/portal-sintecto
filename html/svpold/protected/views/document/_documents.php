<div class="ProcessTab">
  <fieldset>
    <legend>
      <a name="documents">
        Archivos relacionados
      </a>
    </legend>  

    <?php if (Yii::app()->user->hasFlash('documents')): ?>

      <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('documents'); ?>
      </div>

    <?php endif; ?>

    <div class="form wide">
      <?php
      echo CHtml::beginForm(
              array('/document/update', 'code' => $backgroundCheck->code), //
              'post', //
              array(
          'enctype' => 'multipart/form-data',
          'id' => "documents",
              )
      );
      ?>

      <div class="SvpTable" >
        <table>
          <tr>
            <th width="100em">Sección</th>
            <th  width="200em">Nombre</th>
            <th width="40em">Extensión</th>
            <th  width="40em">Desc</th>
            <th width="100em">Tamaño</th>
            <th width="100em">Imagen</th>
            <th width="80em">Order</th>
            <th>Descripción</th>
          </tr>
          <?php foreach ($documents as $document): ?>
            <tr>
              <td><?php echo CHtml::encode($document->verificationSection ? $document->verificationSection->sectionName : "--"); ?></td>
              <td><?php echo CHtml::link($document->name, array('/document/file', 'id' => $document->id), array('target' => '_blank')) ?></td>
              <td><?php echo CHtml::encode($document->extension) ?></td>
              <td><?php echo CHtml::link('desc.', array('/document/fileSaveAs', 'id' => $document->id)) ?></td>
              <td><?php echo number_format((int) $document->size / 1024, 0, '.', ',') ?>KB</td>
              <td><?php echo CHtml::encode(($document->imageSize ? $document->imageSize->name : '')) ?></td>
              <td><?php echo CHtml::encode($document->showOrder) ?></td>
              <td><?php echo CHtml::encode($document->description) ?></td>
            </tr>
          <?php endforeach; ?>
        </table>

        <?php foreach ($documents as $document): ?>
          <?php
          echo $this->renderPartial('/document/_document', array(
              'backgroundCheck' => $backgroundCheck,
              'document' => $document,
          ));
          ?>
        <?php endforeach; ?>
        <?php
        if ($backgroundCheck->canUpdate) {
          $document = new Document();
          echo $this->renderPartial('/document/_document', array(
              'backgroundCheck' => $backgroundCheck,
              'document' => $document,
          ));
        }
        ?>

      </div>
      <?php echo CHtml::endForm(); ?>

    </div>
  </fieldset>
</div>