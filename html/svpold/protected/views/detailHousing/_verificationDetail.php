<table>
    <!-- PRIMERA FILA  -->
    <tr>
        <td>
            Estrato:
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][stratum]', $housing->stratum);
            ?>
        </td>
        <td>
            Servicios públicos faltantes:
        </td>
        <td >
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][publicServicesMissing]', $housing->publicServicesMissing);
            ?>
        </td>
        <td>
            Antiguo tipo de Vivienda:
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($housing->isNewRecord ? 'new' : $housing->id) . '][housingType]', $housing->housingType,array('disabled'=>'disabled'));
            ?>
        </td>
    </tr>
    <!-- SEGUNDA FILA  -->
    <tr>
        <td>
            Vive desde:
        </td>
        <td>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . $housing->id . '][livesSince]',
                'value' => $housing->livesSince,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'dateFormat' => 'yy-mm-dd',
                    'showButtonPanel' => true,
                    'changeYear' => true,
                    'changeMonth' => true,
                    'maxDate' => "+0D",
                ),
                'htmlOptions' => array(
                    'style' => 'width:6em;'
                ),
            ));
            ?>
        </td>
        <td>
            Tenencia de Vivienda:
        </td>
        <td colspan="3">
           <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($housing->isNewRecord ? 'new' : $housing->id) . '][housingOwnership]'
                    , //
                    $housing->housingOwnership, //
                    CHtml::listData(
                            HousingOwnership::model()->findAll(), //
                            'id', //
                            'name'));
            ?>
            ¿Cuál?: 
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][otherHousingOwnership]', $housing->otherHousingOwnership);
            ?>
        </td>
    </tr>
    <!-- TERCERA FILA  -->
    <tr>
        <td>
            Tipo de Vivienda:
        </td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($housing->isNewRecord ? 'new' : $housing->id) . '][newHousingType]'
                    , //
                    $housing->newHousingType, //
                    CHtml::listData(
                            HousingType::model()->findAll(), //
                            'id', //
                            'name'));
            ?>
            ¿Cuál?:
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][otherHousingType]', $housing->otherHousingType);
            ?>
        </td>
        <td>
            Visitado en:
        </td>
        <td>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . $housing->id . '][visitedOn]',
                'value' => $housing->visitedOn,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'dateFormat' => 'yy-mm-dd',
                    'showButtonPanel' => true,
                    'changeYear' => true,
                    'changeMonth' => true,
                    'maxDate' => "+0D",
                ),
                'htmlOptions' => array(
                    'style' => 'width:6em;'
                ),
            ));
            ?>        
        </td>
        <td>
            Resultado
        </td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($housing->isNewRecord ? 'new' : $housing->id) . '][verificationResultId]'
                    , //
                    $housing->verificationResultId, //
                    CHtml::listData(
                            VerificationResult::model()->findAll(), //
                            'id', //
                            'name'));
            ?>

        </td>
    </tr>

</table>

<table>
    <tr>
        <th colspan="2">DESCRIPCION INTERNA DE LA VIVIENDA</th>
    </tr>
    <tr>
        <td>Distribución</td>
        <td><?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][distribution]', $housing->distribution, array('style'=>'width:100%;height:40px;'));
            ?></td>
    </tr>
    <tr>
        <td>Orden y aseo</td>
        <td><?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][orderAndCleaning]', $housing->orderAndCleaning, array('style'=>'width:100%;height:40px;'));
            ?></td>
    </tr>
    <tr>
        <td>Iluminación y ventilación</td>
        <td><?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][iluminationAndVentilation]', $housing->iluminationAndVentilation, array('style'=>'width:100%;height:40px;'));
            ?></td>
    </tr>
    <tr>
        <td>Expectativa de cambio</td>
        <td><?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][changeExpectations]', $housing->changeExpectations, array('style'=>'width:100%;height:40px;'));
            ?></td>
    </tr>
</table>

<table>
    <tr>
        <th colspan="2">DESCRIPCION EXTERNA DE LA VIVIENDA</th>
    </tr>
    <tr>
        <td>Equipamiento social*</td>
        <td><?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][socialEquipment]', $housing->socialEquipment, array('style'=>'width:100%;height:40px;'));
            ?></td>
    </tr>
    <tr>
        <td>Límites zona</td>
        <td><?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][zoneLimits]', $housing->zoneLimits, array('style'=>'width:100%;height:40px;'));
            ?></td>
    </tr>
    <tr>
        <td>Factores de inseguridad</td>
        <td><?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][securityFactors]', $housing->securityFactors, array('style'=>'width:100%;height:40px;'));
            ?></td>
    </tr>
    <tr>
        <td>Vías principales</td>
        <td><?php
            echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][accessRoads]', $housing->accessRoads, array('style'=>'width:100%;height:40px;'));
            ?></td>
    </tr>
    <tr>
        <td colspan="2">*  CAI, Bomberos, centros educativos, centros comerciales, iglesias, Alcaldía, centros de salud, zonas recreo deportivas, establecimientos reconocidos</td>
    </tr>
</table>
<?php if ($verificationSection->backgroundCheck->studyStartedOn>='2021-03-07'): ?>
    <table>
        <tr>
            <th colspan="2">CÍRCULO SOCIAL</th>
        </tr>
        <tr>
            <td>¿Cada cuánto se frecuentan y que actividades comparten, que piensa la familia de su círculo de amigos?</td>
            <td><?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][socialNetwork]', $housing->socialNetwork, array('style'=>'width:100%;height:40px;'));
                ?></td>
        </tr>
        <tr>
            <td>Pertenencia a un club, grupo juvenil, de la iglesia, cultural, deportivo, participación en la JAC, en movimientos políticos.</td>
            <td><?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][clubsGroups]', $housing->clubsGroups, array('style'=>'width:100%;height:40px;'));
                ?></td>
        </tr>
        <tr>
            <td>Hobbies, deportes y actividades de tiempo libre.</td>
            <td><?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $housing->id . '][hobbiesActivities]', $housing->hobbiesActivities, array('style'=>'width:100%;height:40px;'));
                ?></td>
        </tr>

    </table>
<?php endif; ?>