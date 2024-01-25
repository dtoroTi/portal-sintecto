<fieldset>
    <legend>Base de Datos:</legend>

    <table class="RecordsTable">
        <tr>
            <th><?php echo CHtml::encode(SDN_Version::model()->getAttributeLabel('sdnType')); ?></th>
            <th><?php echo CHtml::encode(SDN_Version::model()->getAttributeLabel('downloaded')); ?></th>
            <th><?php echo CHtml::encode(SDN_Version::model()->getAttributeLabel('numRecords')); ?></th>
            <th><?php echo CHtml::encode(SDN_Version::model()->getAttributeLabel('isActive')); ?></th>
        </tr>
        <?php foreach ($sdnVersions as $sdnVersion): ?>
            <tr>
                <td><?php echo CHtml::encode($sdnVersion->sdnType->name); ?></td>
                <td><?php echo CHtml::encode($sdnVersion->downloaded); ?></td>
                <td><?php echo CHtml::encode($sdnVersion->numRecords); ?></td>
                <td><?php echo CHtml::encode($sdnVersion->isActive?'Activa':'EN ACTUALIZACION'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>


</fieldset>
