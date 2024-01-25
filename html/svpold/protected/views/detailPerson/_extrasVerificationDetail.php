<?php 
$isNew = $extra->isNewRecord ? 'new' : $extra->id;

Yii::app()->clientScript->registerScript('addExistingIncomes'.$verificationSection->id,'
    jQuery( ".familyMemberAmount" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-income-value-'.$verificationSection->id.'").html(addIncomes'.$verificationSection->id.'(parent));

        jQuery(".total-general-'.$verificationSection->id.'").html(addIncomesTg'.$verificationSection->id.'(parent));
    });
    jQuery( ".income" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-income-value-'.$verificationSection->id.'").html(addIncomes'.$verificationSection->id.'(parent));

        jQuery(".total-general-'.$verificationSection->id.'").html(addIncomesTg'.$verificationSection->id.'(parent));
    });
    jQuery( ".additionalIncomeValue" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-income-value-'.$verificationSection->id.'").html(addIncomes'.$verificationSection->id.'(parent));

        jQuery(".total-general-'.$verificationSection->id.'").html(addIncomesTg'.$verificationSection->id.'(parent));
    });

    jQuery( ".familyMemberAmount2" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-income2-value-'.$verificationSection->id.'").html(addIncomes2'.$verificationSection->id.'(parent));

        jQuery(".total-general-'.$verificationSection->id.'").html(addIncomesTg'.$verificationSection->id.'(parent));
    });
    jQuery( ".income2" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-income2-value-'.$verificationSection->id.'").html(addIncomes2'.$verificationSection->id.'(parent));

        jQuery(".total-general-'.$verificationSection->id.'").html(addIncomesTg'.$verificationSection->id.'(parent));
    });
    jQuery( ".additionalIncomeValue2" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-income2-value-'.$verificationSection->id.'").html(addIncomes2'.$verificationSection->id.'(parent));

        jQuery(".total-general-'.$verificationSection->id.'").html(addIncomesTg'.$verificationSection->id.'(parent));
    });

    jQuery( ".familyMemberAmount3" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-income3-value-'.$verificationSection->id.'").html(addIncomes3'.$verificationSection->id.'(parent));

        jQuery(".total-general-'.$verificationSection->id.'").html(addIncomesTg'.$verificationSection->id.'(parent));
    });
    jQuery( ".income3" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-income3-value-'.$verificationSection->id.'").html(addIncomes3'.$verificationSection->id.'(parent));

        jQuery(".total-general-'.$verificationSection->id.'").html(addIncomesTg'.$verificationSection->id.'(parent));
    });
    jQuery( ".additionalIncomeValue3" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-income3-value-'.$verificationSection->id.'").html(addIncomes3'.$verificationSection->id.'(parent));

        jQuery(".total-general-'.$verificationSection->id.'").html(addIncomesTg'.$verificationSection->id.'(parent));
    });

    function addIncomes'.$verificationSection->id.'(verificationId){
        idFamilyMember = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_familyMemberAmount";
        idIncome = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_income";
        idAditionalIncome = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_additionalIncomeValue";

        return Number($( "#" + idFamilyMember ).val()) + Number($( "#" + idIncome ).val()) + Number($( "#" + idAditionalIncome ).val());

    }

    function addIncomes2'.$verificationSection->id.'(verificationId){
      
        idFamilyMember2 = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_familyMemberAmount2";
        idIncome2 = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_income2";
        idAditionalIncome2 = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_additionalIncomeValue2";

        return Number($( "#" + idFamilyMember2 ).val()) + Number($( "#" + idIncome2 ).val()) + Number($( "#" + idAditionalIncome2 ).val());
    }

    function addIncomes3'.$verificationSection->id.'(verificationId){
      
        idFamilyMember3 = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_familyMemberAmount3";
        idIncome3 = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_income3";
        idAditionalIncome3 = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_additionalIncomeValue3";

        return Number($( "#" + idFamilyMember3 ).val()) + Number($( "#" + idIncome3 ).val()) + Number($( "#" + idAditionalIncome3 ).val());
    }

    function addIncomesTg'.$verificationSection->id.'(verificationId){
        idFamilyMember = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_familyMemberAmount";
        idIncome = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_income";
        idAditionalIncome = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_additionalIncomeValue";

        idFamilyMember2 = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_familyMemberAmount2";
        idIncome2 = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_income2";
        idAditionalIncome2 = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_additionalIncomeValue2";

        idFamilyMember3 = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_familyMemberAmount3";
        idIncome3 = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_income3";
        idAditionalIncome3 = "verificationSection_'.$verificationSection->id.'__extras_DetailPersonExtras_'.$isNew.'_additionalIncomeValue3";

        return Number($( "#" + idFamilyMember ).val()) + Number($( "#" + idIncome ).val()) + Number($( "#" + idAditionalIncome ).val()) + Number($( "#" + idFamilyMember2 ).val()) + Number($( "#" + idIncome2 ).val()) + Number($( "#" + idAditionalIncome2 ).val()) + Number($( "#" + idFamilyMember3 ).val()) + Number($( "#" + idIncome3 ).val()) + Number($( "#" + idAditionalIncome3 ).val()) ;
    }'
);


Yii::app()->clientScript->registerScript('addExistingOutcomes'.$verificationSection->id,'
    jQuery( ".expendituresHousing" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-outcome-value-'.$verificationSection->id.'").html(addOutcomes'.$verificationSection->id.'(parent));
    });
    jQuery( ".expendituresPublicServices" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-outcome-value-'.$verificationSection->id.'").html(addOutcomes'.$verificationSection->id.'(parent));
    });
    jQuery( ".expendituresFood" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-outcome-value-'.$verificationSection->id.'").html(addOutcomes'.$verificationSection->id.'(parent));
    });
    jQuery( ".expendituresTransportation" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-outcome-value-'.$verificationSection->id.'").html(addOutcomes'.$verificationSection->id.'(parent));
    });
    jQuery( ".expendituresStudies" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-outcome-value-'.$verificationSection->id.'").html(addOutcomes'.$verificationSection->id.'(parent));
    });
    jQuery( ".expendituresRecreation" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-outcome-value-'.$verificationSection->id.'").html(addOutcomes'.$verificationSection->id.'(parent));
    });
    jQuery( ".expendituresClothing" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-outcome-value-'.$verificationSection->id.'").html(addOutcomes'.$verificationSection->id.'(parent));
    });
    jQuery( ".expendituresLoans" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-outcome-value-'.$verificationSection->id.'").html(addOutcomes'.$verificationSection->id.'(parent));
    });
    jQuery( ".expendituresCreditCard" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-outcome-value-'.$verificationSection->id.'").html(addOutcomes'.$verificationSection->id.'(parent));
    });
    jQuery( ".expendituresOthers" ).change(function() {
        parent = $(this).parents("table").attr("verificationid");
        jQuery(".total-outcome-value-'.$verificationSection->id.'").html(addOutcomes'.$verificationSection->id.'(parent));
    });
    
    function addOutcomes'.$verificationSection->id.'(verificationId){
        idexpendituresHousing = "verificationSection_" + verificationId + "__extras_DetailPersonExtras_'.$isNew.'_expendituresHousing";
        idexpendituresPublicServices = "verificationSection_" + verificationId + "__extras_DetailPersonExtras_'.$isNew.'_expendituresPublicServices";
        idexpendituresFood = "verificationSection_" + verificationId + "__extras_DetailPersonExtras_'.$isNew.'_expendituresFood";
        idexpendituresTransportation = "verificationSection_" + verificationId + "__extras_DetailPersonExtras_'.$isNew.'_expendituresTransportation";
        idexpendituresStudies = "verificationSection_" + verificationId + "__extras_DetailPersonExtras_'.$isNew.'_expendituresStudies";
        idexpendituresRecreation = "verificationSection_" + verificationId + "__extras_DetailPersonExtras_'.$isNew.'_expendituresRecreation";
        idexpendituresClothing = "verificationSection_" + verificationId + "__extras_DetailPersonExtras_'.$isNew.'_expendituresClothing";
        idexpendituresLoans = "verificationSection_" + verificationId + "__extras_DetailPersonExtras_'.$isNew.'_expendituresLoans";
        idexpendituresCreditCard = "verificationSection_" + verificationId + "__extras_DetailPersonExtras_'.$isNew.'_expendituresCreditCard";
        idexpendituresOthers = "verificationSection_" + verificationId + "__extras_DetailPersonExtras_'.$isNew.'_expendituresOthers";
        return (Number($( "#" + idexpendituresHousing ).val()) + 
            Number($( "#" + idexpendituresPublicServices ).val()) + 
            Number($( "#" + idexpendituresFood ).val()) + 
            Number($( "#" + idexpendituresTransportation ).val()) + 
            Number($( "#" + idexpendituresStudies ).val()) + 
            Number($( "#" + idexpendituresRecreation ).val()) + 
            Number($( "#" + idexpendituresClothing ).val()) + 
            Number($( "#" + idexpendituresLoans ).val()) + 
            Number($( "#" + idexpendituresCreditCard ).val()) + 
            Number($( "#" + idexpendituresOthers ).val()));
    }'
);
?>
<?php if (!$person->isAReference): ?>
<table>
    <tr>
        <th colspan="2">DINÁMICA FAMILIAR</th>
    </tr>
    <tr>
        <td>Pautas de crianza: </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][parentingGuidelines]', $extra->parentingGuidelines, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Manejo de autoridad: </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][authorityManagement]', $extra->authorityManagement, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Toma de decisiones: </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][decisionMaking]', $extra->decisionMaking, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Comunicación: </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][comunication]', $extra->comunication, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Actividades en familia: </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][familyActivities]', $extra->familyActivities, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Último evento positivo: </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][lastPositiveEvent]', $extra->lastPositiveEvent, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Último evento negativo: </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][lastNegativeEvent]', $extra->lastNegativeEvent, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Proyecto familiar: </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][familyProject]', $extra->familyProject, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Proyecto personal: </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][personalProject]', $extra->personalProject, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Aspecto a mejorar del evaluado según su familia: </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][aspectsToImprove]', $extra->aspectsToImprove, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Expectativa frente a la oferta/Trabajo: </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][offerExpectations]', $extra->offerExpectations, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Qué conoce la flia de la empresa: </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][familyCompanyKnowledge]', $extra->familyCompanyKnowledge, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Actitud frente a la visita: </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][visitAttitude]', $extra->visitAttitude, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Ha sido demandado (por quién, cuándo, por qué): </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][demands]', $extra->demands, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
    <tr>
        <td>Ha sido testigo en algún proceso judicial (de quién, cuándo, por qué): </td>
        <td>
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][witness]', $extra->witness, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
    </tr>
</table>

<table>
    <tr>
        <th colspan="4">Familiares o conocidos que trabajen para esta empresa (La empresa para la que el evaluado se postula)</th>
    </tr>
    <tr>
        <td>Nombre: </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][knownFamilyName]', $extra->knownFamilyName);
            ?>
        </td>
        <td>Relación: </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][knownFamilyRelationship]', $extra->knownFamilyRelationship);
            ?>
        </td>
    </tr>
    <tr>
        <td>Cargo: </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][knownFamilyPosition]', $extra->knownFamilyPosition);
            ?>
        </td>
        <td>Unidad/Ciudad: </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][knownFamilyCity]', $extra->knownFamilyCity);
            ?>
        </td>
    </tr>
</table>

<table>
    <tr>
        <th colspan="6">¿Cómo se enteró de la oferta/Como se vínculo con la empresa?</th>
    </tr>
    <tr>
        <td>Aviso: </td>
        <td>
            <?php
                echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][offerNotice]'
                    , //
                    $extra->offerNotice, //
                    Controller::$optionsYesNo);
            ?>
        </td>
        <td>Recomendación: </td>
        <td>
            <?php
                echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][offerRecomendation]'
                    , //
                    $extra->offerRecomendation, //
                    Controller::$optionsYesNo);
            ?>
        </td>
        <td>De quién: </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][offerWhoRecomended]', $extra->offerWhoRecomended);
            ?>
        </td>
    </tr>
</table>
  
<table>
    <table>
        <tr>
            <th colspan="4">ESTUDIO SOCIOECONÓMICO</th>
        </tr>
        <tr>
            <td>Quiénes aportan en el hogar (Integrantes): </td>
            <td>
                <?php
                    echo CHtml::textField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][familyMemberIncome]', $extra->familyMemberIncome);
                ?>
            </td>
            <td>Valor: </td>
            <td>
                $ <?php
                    echo CHtml::numberField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][familyMemberAmount]', $extra->familyMemberAmount,
                        array('class'=>'familyMemberAmount'));
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">Ingresos: </td>
            <td>Valor: </td>
            <td>
                $ <?php
                    echo CHtml::numberField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][income]', $extra->income,
                        array('class'=>'income'));
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Posee ingreso adicional: 
                <?php
                    echo CHtml::dropDownList(//
                        'verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][additionalIncome]'
                        , //
                        $extra->additionalIncome, //
                        Controller::$optionsYesNo);
                ?>
            </td>
            <td>
                ¿Cuál?
                <?php
                    echo CHtml::textField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][additionalIncomeWhich]', $extra->additionalIncomeWhich);
                ?>
            </td>
            <td>
                Valor: 
            </td>
            <td>
                $ <?php
                    echo CHtml::numberField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][additionalIncomeValue]', $extra->additionalIncomeValue,
                        array('class'=>'additionalIncomeValue'));
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">

            </td>
            <td>
                Total:
            </td>
            <td>
                <div class="total-income-wrapper">$ <span class="total-income-value-<?php echo $verificationSection->id ?>"><?php echo ($extra->familyMemberAmount + $extra->income + $extra->additionalIncomeValue) ?></span></div>
            </td>
        </tr>     
        </table>
        <table>
        <tr>
            <td>Quiénes aportan en el hogar (Integrantes): </td>
            <td>
                <?php
                    echo CHtml::textField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][familyMemberIncome2]', $extra->familyMemberIncome2);
                ?>
            </td>
            <td>Valor: </td>
            <td>
                $ <?php
                    echo CHtml::numberField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][familyMemberAmount2]', $extra->familyMemberAmount2,
                        array('class'=>'familyMemberAmount2'));
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">Ingresos: </td>
            <td>Valor: </td>
            <td>
                $ <?php
                    echo CHtml::numberField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][income2]', $extra->income2,
                        array('class'=>'income2'));
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Posee ingreso adicional: 
                <?php
                    echo CHtml::dropDownList(//
                        'verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][additionalIncome2]'
                        , //
                        $extra->additionalIncome2, //
                        Controller::$optionsYesNo);
                ?>
            </td>
            <td>
                ¿Cuál?
                <?php
                    echo CHtml::textField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][additionalIncomeWhich2]', $extra->additionalIncomeWhich2);
                ?>
            </td>
            <td>
                Valor: 
            </td>
            <td>
                $ <?php
                    echo CHtml::numberField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][additionalIncomeValue2]', $extra->additionalIncomeValue2,
                        array('class'=>'additionalIncomeValue2'));
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">

            </td>
            <td>
                Total:
            </td>
            <td>
                <div class="total-income-wrapper">$ <span class="total-income2-value-<?php echo $verificationSection->id ?>"><?php echo ($extra->familyMemberAmount2 + $extra->income2 + $extra->additionalIncomeValue2) ?></span></div>
            </td>
        </tr> 
        </table>
        <table>    
        <tr>
            <td>Quiénes aportan en el hogar (Integrantes): </td>
            <td>
                <?php
                    echo CHtml::textField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][familyMemberIncome3]', $extra->familyMemberIncome3);
                ?>
            </td>
            <td>Valor: </td>
            <td>
                $ <?php
                    echo CHtml::numberField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][familyMemberAmount3]', $extra->familyMemberAmount3,
                        array('class'=>'familyMemberAmount3'));
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">Ingresos: </td>
            <td>Valor: </td>
            <td>
                $ <?php
                    echo CHtml::numberField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][income3]', $extra->income3,
                        array('class'=>'income3'));
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Posee ingreso adicional: 
                <?php
                    echo CHtml::dropDownList(//
                        'verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][additionalIncome3]'
                        , //
                        $extra->additionalIncome3, //
                        Controller::$optionsYesNo);
                ?>
            </td>
            <td>
                ¿Cuál?
                <?php
                    echo CHtml::textField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][additionalIncomeWhich3]', $extra->additionalIncomeWhich3);
                ?>
            </td>
            <td>
                Valor: 
            </td>
            <td>
                $ <?php
                    echo CHtml::numberField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_extras][DetailPersonExtras]' .
                        '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][additionalIncomeValue3]', $extra->additionalIncomeValue3,
                        array('class'=>'additionalIncomeValue3'));
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            </td>
            <td>
                Total:
            </td>
            <td>
                <div class="total-income-wrapper">$ <span class="total-income3-value-<?php echo $verificationSection->id ?>"><?php echo ($extra->familyMemberAmount3 + $extra->income3 + $extra->additionalIncomeValue3) ?></span></div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="525"></td>
            <td width="455"></td>
            <td width="85">
                <b>TOTAL:</b>
            </td>
            <td>
                <b>
                <div class="total-income-wrapper">$ <span class="total-general-<?php echo $verificationSection->id ?>"><?php echo ($extra->familyMemberAmount + $extra->income + $extra->additionalIncomeValue+$extra->familyMemberAmount2 + $extra->income2 + $extra->additionalIncomeValue2+$extra->familyMemberAmount3 + $extra->income3 + $extra->additionalIncomeValue3) ?></span></div>
                </b>
            </td>
        </tr>  
    </table>  
</table>


<table verificationid="<?php echo $verificationSection->id ?>">
    <tr>
        <th colspan="4">EGRESOS DEL HOGAR "GASTOS"</th>
    </tr>
    <tr>
        <td>
            Vivienda Arriendo y/o cuota: 
        </td>
        <td>
            $ <?php
                echo CHtml::numberField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][expendituresHousing]', $extra->expendituresHousing,
                    array('class'=>'expendituresHousing'));
            ?>
        </td>
        <td>
            Servicios públicos: 
        </td>
        <td>
            $ <?php
                echo CHtml::numberField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][expendituresPublicServices]', $extra->expendituresPublicServices,
                    array('class'=>'expendituresPublicServices'));
            ?>
        </td>
    </tr>
    <tr>
        <td>
            Alimentación: 
        </td>
        <td>
            $ <?php
                echo CHtml::numberField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][expendituresFood]', $extra->expendituresFood,
                    array('class'=>'expendituresFood'));
            ?>
        </td>
        <td>
            Transporte: 
        </td>
        <td>
            $ <?php
                echo CHtml::numberField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][expendituresTransportation]', $extra->expendituresTransportation,
                    array('class'=>'expendituresTransportation'));
            ?>
        </td>
    </tr>
    <tr>
        <td>
            Estudios: 
        </td>
        <td>
            $ <?php
                echo CHtml::numberField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][expendituresStudies]', $extra->expendituresStudies,
                    array('class'=>'expendituresStudies'));
            ?>
        </td>
        <td>
            Recreación: 
        </td>
        <td>
            $ <?php
                echo CHtml::numberField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][expendituresRecreation]', $extra->expendituresRecreation,
                    array('class'=>'expendituresRecreation'));
            ?>
        </td>
    </tr>
    <tr>
        <td>
            Vestuario: 
        </td>
        <td>
            $ <?php
                echo CHtml::numberField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][expendituresClothing]', $extra->expendituresClothing,
                    array('class'=>'expendituresClothing'));
            ?>
        </td>
        <td>
            Préstamos: 
        </td>
        <td>
            $ <?php
                echo CHtml::numberField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][expendituresLoans]', $extra->expendituresLoans,
                    array('class'=>'expendituresLoans'));
            ?>
        </td>
    </tr>
    <tr>
        <td>
            Tarjeta de crédito: 
        </td>
        <td>
            $ <?php
                echo CHtml::numberField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][expendituresCreditCard]', $extra->expendituresCreditCard,
                    array('class'=>'expendituresCreditCard'));
            ?>
        </td>
        <td>
            Otros: 
        </td>
        <td>
            $ <?php
                echo CHtml::numberField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][expendituresOthers]', $extra->expendituresOthers,
                    array('class'=>'expendituresOthers'));
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:right">
            TOTAL: 
        </td>
        <td colspan="2" style="text-align:right">
            <div class="total-outcome-wrapper">$ 
                <span class="total-outcome-value-<?php echo $verificationSection->id ?>">
                    <?php if(!is_numeric($extra->expendituresTransportation)){
                        $extra->expendituresTransportation = 0;
                    }?>
                    <?php echo ($extra->expendituresHousing + 
                        $extra->expendituresPublicServices + 
                        $extra->expendituresFood + 
                        $extra->expendituresTransportation + 
                        $extra->expendituresStudies + 
                        $extra->expendituresRecreation + 
                        $extra->expendituresClothing + 
                        $extra->expendituresLoans + 
                        $extra->expendituresCreditCard + 
                        $extra->expendituresOthers 
                    ) ?>
                </span>
            </div>
        </td>

    </tr>
</table>



<table>
    <tr>
        <th colspan="6">VALIDACIÓN ECONÓMICA</th>
    </tr>
    <tr>
        <td>
            Vehículo: 
        </td>
        <td>
            $ <?php
                echo CHtml::numberField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][economicCar]', $extra->economicCar,
                    array('placeholder'=>'Ej. 25000000'));
            ?>
        </td>
        <td>
            Marca: 
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][economicBrand]', $extra->economicBrand,
                    array('placeholder'=>'Ej. Chevrolet'));
            ?>
        </td>
        <td>
            Modelo: 
        </td>
        <td>
            <?php
                echo CHtml::numberField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][economicModel]', $extra->economicModel,
                    array('placeholder'=>'Ej. 2002'));
            ?>
        </td>
    </tr>
    <tr>
        <td>
            Finca raíz: 
        </td>
        <td colspan="5">
             $ <?php
                echo CHtml::numberField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][economicHouse]', $extra->economicHouse,
                    array('class'=>'economicHouse'));
            ?>
        </td>
     </tr>
     <tr>
        <td colspan="2">
            ¿Está reportado negativamente en las centrales de riesgo? 
        </td>
        <td>
            <?php
                echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][economicRiskCenters]'
                    , //
                    $extra->economicRiskCenters, //
                    Controller::$optionsYesNo);
            ?>
        </td>
        <td>
            ¿Por qué?
        </td>
        <td colspan="2">
           <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][economicRiskCentersWhy]', $extra->economicRiskCentersWhy, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
     </tr>  
     <tr>
        <td colspan="2">
            ¿Tiene acuerdos de pago?
        </td>
        <td>
            <?php
                echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][economicPaymentAgreements]'
                    , //
                    $extra->economicPaymentAgreements, //
                    Controller::$optionsYesNo);
            ?>
        </td>
        <td>
            ¿Por qué?
        </td>
        <td colspan="2">
           <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][economicPaymentAgreementsWhy]', $extra->economicPaymentAgreementsWhy, array('style'=>'width:100%;height:40px;'));
            ?>
        </td>
     </tr>  
</table>
<?php endif; ?>
<?php if ($person->isAReference and $verificationSection->backgroundCheck->studyStartedOn<'2021-03-06'): ?>
<table>
    <tr>
        <th colspan="6">CÍRCULO SOCIAL</th>
    </tr> 
    <tr>
        <td width="40%">
            ¿Cada cuánto se frecuentan y que actividades comparten, que piensa la familia de su círculo de amigos?
        </td>
        <td width="60%">
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][socialNetwork]', $extra->socialNetwork, array('style'=>'width:100%;height:60px;'));
            ?>
        </td>
     </tr>
     <tr>
        <td width="40%">
            Pertenencia a un club, grupo juvenil, de la iglesia, cultural, deportivo,  participación en la JAC, en movimientos políticos.
        </td>
        <td width="60%">
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][clubsGroups]', $extra->clubsGroups, array('style'=>'width:100%;height:60px;'));
            ?>
        </td>
     </tr>
     <tr>
        <td width="40%">
            Hobbies, deportes y actividades de tiempo libre.
        </td>
        <td width="60%">
            <?php
                echo CHtml::textArea('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_extras][DetailPersonExtras]' .
                    '[' . ($extra->isNewRecord ? 'new' : $extra->id) . '][hobbiesActivities]', $extra->hobbiesActivities, array('style'=>'width:100%;height:60px;'));
            ?>
        </td>
     </tr>  
</table>
<?php endif; ?>