<?php echo CHtml::beginForm(array('/document/checkFilesWithoutLink')) ?>
<div class="SvpTable" >
    <table>
        <tr>
            <th  width="10em">Check</th>
            <th  width="30em">Nombre</th>
            <th width="10em">Tamaño</th>
            <th width="10em">Fecha</th>
        </tr>
        <tr><th colspan="5">Documentos</td></tr>
        <?php $numFile = 0; ?>
        <?php foreach ($documents as $file): ?>
            <tr>
                <?php $numFile++; ?>
                <td><?php echo CHtml::checkBox("File[{$numFile}]", false, array('value' => CHtml::encode($file['dir'] . "/" . $file['filename']))) ?></td>
                <td><?php echo CHtml::encode($file['dir'] . "/" . $file['filename']) ?></td>
                <td><div style="text-align: right"><?php echo CHtml::encode(number_format($file['size'], 0)) ?></div></td>
                <td><?php echo CHtml::encode(date("Y-m-d H:i:s", $file['time'])) ?></td>

            </tr>
        <?php endforeach; ?>
        <tr><th colspan="5">Reportes</td></tr>
        <?php foreach ($reports as $file): ?>
            <tr>
                <?php $numFile++; ?>
                <td><?php echo CHtml::checkBox("Inf[{$numFile}]", false, array('value' => CHtml::encode($file['dir'] . "/" . $file['filename']))) ?></td>
                <td><?php echo CHtml::encode($file['dir'] . "/" . $file['filename']) ?></td>
                <td><div style="text-align: right"><?php echo CHtml::encode(number_format($file['size'], 0)) ?></div></td>
                <td><?php echo CHtml::encode(date("Y-m-d H:i:s", $file['time'])) ?></td>

            </tr>
        <?php endforeach; ?>
    </table>
    <?php
    echo CHtml::submitButton('Borrar', array(
        'confirm' => 'Esta seguro de borrar los archivos marcados?',)
    );
    ?>


</div>
<?php echo CHtml::endForm(); ?>