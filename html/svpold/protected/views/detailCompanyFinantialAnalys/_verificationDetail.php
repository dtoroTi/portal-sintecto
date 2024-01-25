<?php //var_dump($verificationSection->backgroundCheck->customerProductId);?>
<?php
    setlocale(LC_MONETARY, 'es_CO');
    function addNumbers($a=0, $b=0, $c=0,$d=0, $e=0, $f=0, $g=0, $h=0, $i=0, $j=0, $k=0, $l=0, $m=0, $n=0){
        $ans = $a + $b + $c + $d + $e + $f +$g;
        return $ans;
    }
    function subtractNumbers($a, $b){
        $ans = $a - $b;
        if ($ans == 0) {
            $ans = '0';
        }
        return $ans;
    }
    function divideNumbers($a, $b){
        if ($a != 0 && $b != 0)
        {
            $ans = $a / $b;
        } else
        {
            $ans = '0';
        }
        return $ans;
    }
    function percentNumber($a){
        $ans = number_format(($a * 100), 2) . '%';
        return $ans;
    }

    function indicadoresFinancierosCoface( $label, $operacion, $indice_0_0, $indice_0_1,$indice_0_2, $indice_1_0, $indice_1_1, $indice_1_2, $format="" , $customerProductId = "", $colpensionesType = 0 , $pond_1 = NULL){


        if ($operacion == "divide") {
            $indic_0 = divideNumbers( $indice_0_0, $indice_1_0 );
            $indic_1 = divideNumbers( $indice_0_1, $indice_1_1);
            $indic_2 = divideNumbers( $indice_0_2, $indice_1_2);
        } else if ($operacion == "subtract") {
            $indic_0 = subtractNumbers( $indice_0_0, $indice_1_0 );
            $indic_1 = subtractNumbers( $indice_0_1, $indice_1_1);
            $indic_2 = subtractNumbers( $indice_0_2, $indice_1_2);
        };

        if ($format == "percent") {
            $ind_0 = percentNumber($indic_0);
            $ind_1 = percentNumber($indic_1);
            $ind_2 = percentNumber($indic_2);
        } else if ($format == "money") {
            $ind_0 = "$ " . number_format( $indic_0, 2, ',', '.');
            $ind_1 = "$ " . number_format( $indic_1, 2, ',', '.');
            $ind_2 = "$ " . number_format( $indic_2, 2, ',', '.');
        } else if ($format == "days") {
            $ind_0 = number_format($indic_0, 0, '.', ''). " dias\n";
            $ind_1 = number_format($indic_1, 0, '.', ''). " dias\n";
            $ind_2 = number_format($indic_2, 0, '.', ''). " dias\n";
        } else if ($format == "percent2") {
            $ind_0 = number_format($indic_0, 2, '.', ''). " %\n";
            $ind_1 = number_format($indic_1, 2, '.', ''). " %\n";
            $ind_2 = number_format($indic_2, 2, '.', ''). " %\n";
        } else {
            $ind_0 = number_format($indic_0, 2, '.', ''). " veces\n";
            $ind_1 = number_format($indic_1, 2, '.', ''). " veces\n";
            $ind_2 = number_format($indic_2, 2, '.', ''). " veces\n";
        }

            $ans = "<tr>
                <th>
                    <b>".$label."</b>
                </th>
                <td  class='align_right' >".$ind_0." </td>
                <td  class='align_right' >".$ind_1."</td>
                <td  class='align_right' >".$ind_2."</td>";

                return $ans;
    };
    
    function indicadoresFinancieros( $label, $operacion, $indice_0_0, $indice_0_1, $indice_1_0, $indice_1_1, $format="" , $customerProductId = "", $colpensionesType = 0 , $pond_1 = NULL){


        if ($operacion == "divide") {
            $indic_0 = divideNumbers( $indice_0_0, $indice_1_0 );
            $indic_1 = divideNumbers( $indice_0_1, $indice_1_1);
        } else if ($operacion == "subtract") {
            $indic_0 = subtractNumbers( $indice_0_0, $indice_1_0 );
            $indic_1 = subtractNumbers( $indice_0_1, $indice_1_1);
        };

        if ($format == "percent") {
            $ind_0 = percentNumber($indic_0);
            $ind_1 = percentNumber($indic_1);
        } else if ($format == "money") {
            $ind_0 = "$ " . number_format( $indic_0, 2, ',', '.');
            $ind_1 = "$ " . number_format( $indic_1, 2, ',', '.');
        } else if ($format == "days") {
            $ind_0 = number_format($indic_0, 0, '.', ''). " dias\n";
            $ind_1 = number_format($indic_1, 0, '.', ''). " dias\n";
        } else if ($format == "percent2") {
            $ind_0 = number_format($indic_0, 2, '.', ''). " %\n";
            $ind_1 = number_format($indic_1, 2, '.', ''). " %\n";
        } else {
            $ind_0 = number_format($indic_0, 2, '.', ''). " veces\n";
            $ind_1 = number_format($indic_1, 2, '.', ''). " veces\n";
        }

            $ans = "<tr>
                <th>
                    <b>".$label."</b>
                </th>
                <td  class='align_right' >".$ind_0." </td>
                <td  class='align_right' >".$ind_1."</td>";

        //Creado por Jonathan ---->

 //Creado por Jonathan <----


        if( isset($customerProductId) &&
            $customerProductId == "2632" || $customerProductId == "3096" || $customerProductId == "3157" || $customerProductId == "3159"
        ){
            // PONDERADOS PERSONALIZADOS COLPENSIONES
            $colpensiones_1 = array(
                0 => array(
                        true,
                        array( ">=", 1),
                        array( ">=", 10),
                        array( ">=", .08),
                        array( ">=", .01),
                        array( ">=", .02),
                        array( "<=", .7),
                        array( ">=", .5)
                    ),
                1 => array(
                        true,
                        array( ">=", 1),
                        array( ">=", 10),
                        array( ">=", .035),
                        array( ">=", .005),
                        array( ">=", .01),
                        array( "<=", .8),
                        array( ">=", .5)
                ),
                2 => array(
                        true,
                        array( ">=", 1),
                        array( "", "" ),
                        array( ">", 0),
                        array( ">", 0),
                        array( ">", 0),
                        array( "<=", .7),
                        array( ">=", .5)
                ),
                3 => array(
                        true,
                        array( ">=", 1),
                        array( "", "" ),
                        array( ">", 0),
                        array( ">", 0),
                        array( ">=", .008),
                        array( "<=", .65),
                        array( ">=", .5)
                )
            );

            $colpensionesPond_1 = $pond_1;
            $pondAns_0 = "";
            if (isset($colpensionesPond_1) && $colpensionesPond_1 != NULL){
                if ($colpensiones_1[$colpensionesType][$colpensionesPond_1][0] == ">=" ){
                    if ($indic_0 >= $colpensiones_1[$colpensionesType][$colpensionesPond_1][1]){
                        $pondAns_0 =  "CUMPLE";
                    } else {
                        $pondAns_0 =  "NO CUMPLE";
                    }
                    if ($indic_1 >= $colpensiones_1[$colpensionesType][$colpensionesPond_1][1]){
                        $pondAns_1 =  "CUMPLE";
                    } else {
                        $pondAns_1 =  "NO CUMPLE";
                    }
                } else if($colpensiones_1[$colpensionesType][$colpensionesPond_1][0] == "<=" ){
                    if ($indic_0 <= $colpensiones_1[$colpensionesType][$colpensionesPond_1][1]){
                        $pondAns_0 =  "CUMPLE";
                    } else {
                        $pondAns_0 =  "NO CUMPLE";
                    }
                    if ($indic_1 <= $colpensiones_1[$colpensionesType][$colpensionesPond_1][1]){
                        $pondAns_1 =  "CUMPLE";
                    } else {
                        $pondAns_1 =  "NO CUMPLE";
                    }
                } else if($colpensiones_1[$colpensionesType][$colpensionesPond_1][0] == ">" ){
                    if ($indic_0 > $colpensiones_1[$colpensionesType][$colpensionesPond_1][1]){
                        $pondAns_0 =  "CUMPLE";
                    } else {
                        $pondAns_0 =  "NO CUMPLE";
                    }
                    if ($indic_1 > $colpensiones_1[$colpensionesType][$colpensionesPond_1][1]){
                        $pondAns_1 =  "CUMPLE";
                    } else {
                        $pondAns_1 =  "NO CUMPLE";
                    }
                } else if($colpensiones_1[$colpensionesType][$colpensionesPond_1][0] == "<" ){
                    if ($indic_0 < $colpensiones_1[$colpensionesType][$colpensionesPond_1][1]){
                        $pondAns_0 =  "CUMPLE";
                    } else {
                        $pondAns_0 =  "NO CUMPLE";
                    }
                    if ($indic_1 < $colpensiones_1[$colpensionesType][$colpensionesPond_1][1]){
                        $pondAns_1 =  "CUMPLE";
                    } else {
                        $pondAns_1 =  "NO CUMPLE";
                    }
                } else{
                    $pondAns_0 =  "N/A";
                    $pondAns_1 =  "N/A";
                }
                $ans .= "<td>". $colpensiones_1[$colpensionesType][$colpensionesPond_1][0] .
                    " ". $colpensiones_1[$colpensionesType][$colpensionesPond_1][1]. "</td>";
                $ans .= "<td>". $pondAns_0 ."</td>";
                $ans .= "<td>". $pondAns_1 ."</td>";
            } else{
                $ans .= "<td></td>";
                $ans .= "<td></td>";
                $ans .= "<td></td>";
            }
        }

        if( isset($customerProductId) &&
            $customerProductId == "2697"
        ){
            
        }


        //$ans .= "</tr>";
        return $ans;
    };

    function varCuentas( $var_0, $var_1){
        $varInt = subtractNumbers( $var_0, $var_1);
        $varPercent = percentNumber(divideNumbers( $varInt , $var_1));
        $ans = "<td class='align_right'>".  "$ " . number_format( $varInt, 2, ',', '.')."</td>
                <td>".$varPercent."</td>";
        return $ans;
    };

?>

<style>
    #detailCompanyFinantialAnalys th.th_title{
        text-align: center;
        background: #ffffff;
        border: solid 2px #08124C;
    }
    #detailCompanyFinantialAnalys th.th_title > span{
        padding: 5px;
        font-weight: bold;
        font-size: large;
    }
    #detailCompanyFinantialAnalys td{
        border: solid 1px #000000;
        background: #ffffff;
    }
    #detailCompanyFinantialAnalys td.td_title label{
        width: auto !important;
        float: none !important;
        text-align: right !important;
        background: #efefef;
    }
    #detailCompanyFinantialAnalys td.td_title{
        background: #efefef;
        text-align: right !important;
    }
    #detailCompanyFinantialAnalys td.bg-blue{
        background: #c6e2ff !important;
    }
    #financeIndicators tr th{
        color: #666666 !important;
        font-weight:normal;
    }
    #financeIndicators tr th b{
        color: #000000 !important;
        font-weight: bold;
    }
    #financeIndicators td {
        border: solid 1px #000000;
    }
    .bg_lightblue{
        /*background: #8BB4C6 !important;*/
        background: #DAEDF0 !important;
        text-align: right;
    }
    .bg_lightblue_1{
        background: #8BB4C6 !important;
        text-align: right;
    }

    .align_right{
        text-align: right !important;
    }
</style>

<?php if ($verificationSection->backgroundCheck->customerId == 985): ?>
<table>
<tr>
        <td>CIERRE DEL ULTIMO AÑO:</td>
   </tr>
<tr>
        <td>Estados financieros auditados: </td>
        <td>
        <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][auditedFinancialfigures]', $company->auditedFinancialfigures, array('rows' => 1, 'cols' => 100));
            ?> 
        </td>

        <td>Estados financieros consolidados: </td>
        <td>
        <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][consolidatedFinancialStatements]', $company->consolidatedFinancialStatements, array('rows' => 1, 'cols' => 100));
            ?> 
        </td>

        <td>Moneda: </td>
        <td>
        <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][currency]', $company->currency, array('rows' => 1, 'cols' => 100));
            ?> 
        </td>

        <td>Privacidad: </td>
        <td>
        <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][privacy]', $company->privacy, array('rows' => 1, 'cols' => 100));
            ?> 
        </td>

        <td>Fuente de los estados financieros: </td>
                <td>
                <?php
                    echo CHtml::textField('verificationSection' .
                            '[' . $verificationSection->id . ']' .
                            '[_details]' .
                            '[' . $company->id . '][financialSource]', $company->financialSource, array('rows' => 1, 'cols' => 100));
                    ?> 
                </td>
    </tr>
    </table>
</table>
<table>
<tr>
        <td>CIERRE DEL PENULTIMO AÑO:</td>
   </tr>
<tr>
        <td>Estados financieros auditados: </td>
        <td>
        <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][auditedFinancialfigures_1]', $company->auditedFinancialfigures_1, array('rows' => 1, 'cols' => 100));
            ?> 
        </td>

        <td>Estados financieros consolidados: </td>
        <td>
        <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][consolidatedFinancialStatements_1]', $company->consolidatedFinancialStatements_1, array('rows' => 1, 'cols' => 100));
            ?> 
        </td>

        <td>Moneda: </td>
        <td>
        <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][currency_1]', $company->currency_1, array('rows' => 1, 'cols' => 100));
            ?> 
        </td>

        <td>Privacidad: </td>
        <td>
        <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][privacy_1]', $company->privacy_1, array('rows' => 1, 'cols' => 100));
            ?> 
        </td>

        <td>Fuente de los estados financieros: </td>
                <td>
                <?php
                    echo CHtml::textField('verificationSection' .
                            '[' . $verificationSection->id . ']' .
                            '[_details]' .
                            '[' . $company->id . '][financialSource_1]', $company->financialSource_1, array('rows' => 1, 'cols' => 100));
                    ?> 
                </td>
    </tr>
    </table>
</table>
<?php endif; ?>

<?php //Indicadores COFACE
if ($verificationSection->backgroundCheck->customerId == 985): ?>
<table id="detailCompanyFinantialAnalys">
    <tr>
        <th width="200" style="color: #ffffff !important; font-size: large; background: #08124C; font-weight: bold; ">CUENTAS PRINCIPALES</th>
        <th class="th_title"><span>Cierre del último año</span></th>
        <th class="th_title"><span>Cierre del Penúltimo año</span></th>
        <th class="th_title"><span>Cierre del Antepenúltimo año</span></th>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'dateLastBalanceSheet'); ?>
        </td>
        <td>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . $company->id . '][dateLastBalanceSheet]',
                'value' => $company->dateLastBalanceSheet,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'dateFormat' => 'yy',
                    'showButtonPanel' => true,
                    'changeYear' => true,
                    'changeMonth' => true,
                    'maxDate' => "+1Y",
                ),
                'htmlOptions' => array(
                    'style' => 'width:8em;'
                ),
            ));
            ?>
        </td>
        <td>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . $company->id . '][dateLastBalanceSheet_1]',
                'value' => $company->dateLastBalanceSheet_1,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'dateFormat' => 'yy',
                    'showButtonPanel' => true,
                    'changeYear' => true,
                    'changeMonth' => true,
                    'maxDate' => "+0D",
                    'value' => '0000'
                ),
                'htmlOptions' => array(
                    'style' => 'width:8em;',
                    'value' => '0000'
                ),
            ));
            ?>
        </td>       
        <td>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . $company->id . '][dateLastBalanceSheet_2]',
                'value' => $company->dateLastBalanceSheet_2,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'dateFormat' => 'yy',
                    'showButtonPanel' => true,
                    'changeYear' => true,
                    'changeMonth' => true,
                    'maxDate' => "+0D",
                    'value' => '0000'
                ),
                'htmlOptions' => array(
                    'style' => 'width:8em;',
                    'value' => '0000'
                ),
            ));
            ?>
        </td>            
    </tr>
    
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoDisponible_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoDisponible_0]', $company->activoDisponible_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoDisponible_1]', $company->activoDisponible_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoDisponible_2]', $company->activoDisponible_2, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
    </tr>
    
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoClientes_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoClientes_0]', $company->activoClientes_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoClientes_1]', $company->activoClientes_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoClientes_2]', $company->activoClientes_2, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoAnticiposYAvances_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoAnticiposYAvances_0]', $company->activoAnticiposYAvances_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoAnticiposYAvances_1]', $company->activoAnticiposYAvances_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoAnticiposYAvances_2]', $company->activoAnticiposYAvances_2, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoInventarios_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInventarios_0]', $company->activoInventarios_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInventarios_1]', $company->activoInventarios_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInventarios_2]', $company->activoInventarios_2, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
    </tr>
   
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoInversionesCP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInversionesCP_0]', $company->activoInversionesCP_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInversionesCP_1]', $company->activoInversionesCP_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInversionesCP_2]', $company->activoInversionesCP_2, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'otrosActivosCorrientes_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosActivosCorrientes_0]', $company->otrosActivosCorrientes_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosActivosCorrientes_1]', $company->otrosActivosCorrientes_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosActivosCorrientes_2]', $company->otrosActivosCorrientes_2, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
    </tr>
    <tr>
        <td class="td_title">Activo Corriente</td>
        <td class="bg_lightblue">
            <?php
                $activoCorriente_0 = addNumbers($company->activoDisponible_0, $company->activoClientes_0, $company->activoAnticiposYAvances_0 , $company->activoInventarios_0, $company->activoInversionesCP_0, $company->otrosActivosCorrientes_0);
                echo  "$ " . number_format( $activoCorriente_0, 2, ',', '.');

            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $activoCorriente_1 = addNumbers( $company->activoDisponible_1, $company->activoClientes_1, $company->activoAnticiposYAvances_1, $company->activoInventarios_1, $company->activoInversionesCP_1, $company->otrosActivosCorrientes_1);
                echo  "$ " . number_format( $activoCorriente_1, 2, ',', '.');

            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $activoCorriente_2 = addNumbers( $company->activoDisponible_2, $company->activoClientes_2, $company->activoAnticiposYAvances_2, $company->activoInventarios_2, $company->activoInversionesCP_2, $company->otrosActivosCorrientes_2);
                echo  "$ " . number_format( $activoCorriente_2, 2, ',', '.');

            ?>
        </td>
    </tr>
 
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoPropiedadPlantaYEquipo_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoPropiedadPlantaYEquipo_0]', $company->activoPropiedadPlantaYEquipo_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoPropiedadPlantaYEquipo_1]', $company->activoPropiedadPlantaYEquipo_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoPropiedadPlantaYEquipo_2]', $company->activoPropiedadPlantaYEquipo_2, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
    </tr>
    
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoDepreciacion_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoDepreciacion_0]', $company->activoDepreciacion_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoDepreciacion_1]', $company->activoDepreciacion_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoDepreciacion_2]', $company->activoDepreciacion_2, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
    </tr>
    <tr>
        <td class="td_title"><b>Activo Fijo</b></td>
        <td class="bg_lightblue">
            <?php
                $activoFijo_0 = subtractNumbers($company->activoPropiedadPlantaYEquipo_0, $company->activoDepreciacion_0);
                echo "$ " . number_format( $activoFijo_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $activoFijo_1 = subtractNumbers($company->activoPropiedadPlantaYEquipo_1, $company->activoDepreciacion_1);
                echo "$ " . number_format( $activoFijo_1, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $activoFijo_2 = subtractNumbers($company->activoPropiedadPlantaYEquipo_2, $company->activoDepreciacion_2);
                echo "$ " . number_format( $activoFijo_2, 2, ',', '.');
            ?>
        </td>
    </tr>
    
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoInversionesLP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInversionesLP_0]', $company->activoInversionesLP_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInversionesLP_1]', $company->activoInversionesLP_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInversionesLP_2]', $company->activoInversionesLP_2, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
    </tr>
    <tr>
            <td class="td_title">
                <?php echo CHtml::activeLabel($company, 'activoIntangibles_0'); ?>
            </td>
            <td>
                <?php
                echo CHtml::textField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_details]' .
                        '[' . $company->id . '][activoIntangibles_0]', $company->activoIntangibles_0, array('rows' => 1, 'cols' => 30));
                ?>
            </td>
            <td>
                <?php
                    echo CHtml::textField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_details]' .
                        '[' . $company->id . '][activoIntangibles_1]', $company->activoIntangibles_1, array('rows' => 1, 'cols' => 30));
                ?>
            </td>
            <td>
                <?php
                    echo CHtml::textField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_details]' .
                        '[' . $company->id . '][activoIntangibles_2]', $company->activoIntangibles_2, array('rows' => 1, 'cols' => 30));
                ?>
            </td>
        </tr>
        <tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'activoValorizaciones_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][activoValorizaciones_0]', $company->activoValorizaciones_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][activoValorizaciones_1]', $company->activoValorizaciones_1, array('rows' => 1, 'cols' => 30));
    ?>
        </td>
        <td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][activoValorizaciones_2]', $company->activoValorizaciones_2, array('rows' => 1, 'cols' => 30));
    ?>
        </td>
    </tr>
        <tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'otrosNoActivosCorrientes_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][otrosNoActivosCorrientes_0]', $company->otrosNoActivosCorrientes_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][otrosNoActivosCorrientes_1]', $company->otrosNoActivosCorrientes_1, array('rows' => 1, 'cols' => 30));
    ?>
        </td>
        <td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][otrosNoActivosCorrientes_2]', $company->otrosNoActivosCorrientes_2, array('rows' => 1, 'cols' => 30));
    ?>
        </td>
    </tr>
    <tr>
        <td class="td_title"><b>Otros Activos</b></td>
        <td class="bg_lightblue">
            <?php
                $otrosActivos_0 = addNumbers($company->activoInversionesLP_0, $company->activoIntangibles_0, $company->activoValorizaciones_0, $company->otrosNoActivosCorrientes_0);
                echo "$ " . number_format( $otrosActivos_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $otrosActivos_1 = addNumbers($company->activoInversionesLP_1, $company->activoIntangibles_1, $company->activoValorizaciones_1, $company->otrosNoActivosCorrientes_1);
                echo "$ " . number_format( $otrosActivos_1, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $otrosActivos_2 = addNumbers($company->activoInversionesLP_2, $company->activoIntangibles_2, $company->activoValorizaciones_2, $company->otrosNoActivosCorrientes_2);
                echo "$ " . number_format( $otrosActivos_2, 2, ',', '.');
            ?>
        </td>
    </tr>
    <tr>
        <td class="td_title"><b>Activo</b></td>
        <td class="bg_lightblue_1">
            <?php
                $activo_0 = addNumbers($activoCorriente_0, $activoFijo_0, $otrosActivos_0);
                echo "$ " . number_format( $activo_0, 2, ',', '.');
                
            ?>
        </td>
        <td class="bg_lightblue_1">
            <?php
                $activo_1 = addNumbers($activoCorriente_1, $activoFijo_1, $otrosActivos_1);
                echo "$ " . number_format( $activo_1, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue_1">
            <?php
                $activo_2 = addNumbers($activoCorriente_2, $activoFijo_2, $otrosActivos_2);
                echo "$ " . number_format( $activo_2, 2, ',', '.');
            ?>
        </td>
    </tr>

    
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoObligacionesFinancierasCP_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesFinancierasCP_0]', $company->pasivoObligacionesFinancierasCP_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesFinancierasCP_1]', $company->pasivoObligacionesFinancierasCP_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesFinancierasCP_2]', $company->pasivoObligacionesFinancierasCP_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoProveedores_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProveedores_0]', $company->pasivoProveedores_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProveedores_1]', $company->pasivoProveedores_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProveedores_2]', $company->pasivoProveedores_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoCXP_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoCXP_0]', $company->pasivoCXP_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoCXP_1]', $company->pasivoCXP_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoCXP_2]', $company->pasivoCXP_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>  
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'pasivoImpuestosYTasas_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoImpuestosYTasas_0]', $company->pasivoImpuestosYTasas_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoImpuestosYTasas_1]', $company->pasivoImpuestosYTasas_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoImpuestosYTasas_2]', $company->pasivoImpuestosYTasas_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoObligacionesLaborales_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesLaborales_0]', $company->pasivoObligacionesLaborales_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesLaborales_1]', $company->pasivoObligacionesLaborales_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesLaborales_2]', $company->pasivoObligacionesLaborales_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoProvisiones_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProvisiones_0]', $company->pasivoProvisiones_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProvisiones_1]', $company->pasivoProvisiones_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProvisiones_2]', $company->pasivoProvisiones_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>
        <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'depositosExigiblesCP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][depositosExigiblesCP_0]', $company->depositosExigiblesCP_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][depositosExigiblesCP_1]', $company->depositosExigiblesCP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][depositosExigiblesCP_2]', $company->depositosExigiblesCP_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'fondosSocialesCP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][fondosSocialesCP_0]', $company->fondosSocialesCP_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][fondosSocialesCP_1]', $company->fondosSocialesCP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][fondosSocialesCP_2]', $company->fondosSocialesCP_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'otrosPasivosCorrientes_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosPasivosCorrientes_0]', $company->otrosPasivosCorrientes_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosPasivosCorrientes_1]', $company->otrosPasivosCorrientes_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosPasivosCorrientes_2]', $company->otrosPasivosCorrientes_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>
    

    <tr>
        <td class="td_title"><b>Pasivo Corriente</b></td>
        <td class="bg_lightblue">
            <?php
                $pasivoCorriente_0 = 
                    $company->pasivoObligacionesFinancierasCP_0 +
                    $company->pasivoProveedores_0 +
                    $company->pasivoCXP_0 +
                    $company->pasivoImpuestosYTasas_0 +
                    $company->pasivoObligacionesLaborales_0 +
                    $company->pasivoProvisiones_0 +
                    $company->depositosExigiblesCP_0 +
                    $company->otrosPasivosCorrientes_0 +
                    $company->fondosSocialesCP_0
                ;
                echo "$ " . number_format( $pasivoCorriente_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $pasivoCorriente_1 = 
                    $company->pasivoObligacionesFinancierasCP_1 +
                    $company->pasivoProveedores_1 +
                    $company->pasivoCXP_1 +
                    $company->pasivoImpuestosYTasas_1 +
                    $company->pasivoObligacionesLaborales_1 +
                    $company->pasivoProvisiones_1 +
                    $company->depositosExigiblesCP_1 +
                    $company->otrosPasivosCorrientes_1 +
                    $company->fondosSocialesCP_1
                ;
                echo "$ " . number_format( $pasivoCorriente_1, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $pasivoCorriente_2 = 
                    $company->pasivoObligacionesFinancierasCP_2 +
                    $company->pasivoProveedores_2 +
                    $company->pasivoCXP_2 +
                    $company->pasivoImpuestosYTasas_2 +
                    $company->pasivoObligacionesLaborales_2 +
                    $company->pasivoProvisiones_2 +
                    $company->depositosExigiblesCP_2 +
                    $company->otrosPasivosCorrientes_2 +
                    $company->fondosSocialesCP_2
                ;
                echo "$ " . number_format( $pasivoCorriente_2, 2, ',', '.');
            ?>
        </td>
    </tr>
    
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'pasivoObligacionesFinancierasLP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoObligacionesFinancierasLP_0]', $company->pasivoObligacionesFinancierasLP_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoObligacionesFinancierasLP_1]', $company->pasivoObligacionesFinancierasLP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoObligacionesFinancierasLP_2]', $company->pasivoObligacionesFinancierasLP_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoProveedoresLP_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProveedoresLP_0]', $company->pasivoProveedoresLP_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProveedoresLP_1]', $company->pasivoProveedoresLP_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProveedoresLP_2]', $company->pasivoProveedoresLP_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
</tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'pasivoCXPLP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoCXPLP_0]', $company->pasivoCXPLP_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoCXPLP_1]', $company->pasivoCXPLP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoCXPLP_2]', $company->pasivoCXPLP_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoImpuestosYTasasLP_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoImpuestosYTasasLP_0]', $company->pasivoImpuestosYTasasLP_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoImpuestosYTasasLP_1]', $company->pasivoImpuestosYTasasLP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoImpuestosYTasasLP_2]', $company->pasivoImpuestosYTasasLP_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoObligacionesLaboralesLP_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesLaboralesLP_0]', $company->pasivoObligacionesLaboralesLP_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesLaboralesLP_1]', $company->pasivoObligacionesLaboralesLP_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesLaboralesLP_2]', $company->pasivoObligacionesLaboralesLP_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
</tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoProvisionesLP_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .

           '[' . $company->id . '][pasivoProvisionesLP_0]', $company->pasivoProvisionesLP_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoProvisionesLP_1]', $company->pasivoProvisionesLP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoProvisionesLP_2]', $company->pasivoProvisionesLP_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'depositosExigiblesLP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][depositosExigiblesLP_0]', $company->depositosExigiblesLP_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][depositosExigiblesLP_1]', $company->depositosExigiblesLP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][depositosExigiblesLP_2]', $company->depositosExigiblesLP_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>
    </tr>
        <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'fondosSociales_0'); ?>
        </td>
        
        <td>
            <?php

                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][fondosSociales_0]', $company->fondosSociales_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][fondosSociales_1]', $company->fondosSociales_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][fondosSociales_2]', $company->fondosSociales_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
                
    </tr>
        <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'otrosPasivosNoCorrientes_0'); ?>
        </td>
        
        <td>
            <?php

                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosPasivosNoCorrientes_0]', $company->otrosPasivosNoCorrientes_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosPasivosNoCorrientes_1]', $company->otrosPasivosNoCorrientes_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosPasivosNoCorrientes_2]', $company->otrosPasivosNoCorrientes_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>          
    </tr>
    <tr>
        <td class="td_title"><b>Pasivo No Corriente</b></td>
        <td class="bg_lightblue">
            <?php
                $pasivoNoCorriente_0 = addNumbers($company->pasivoObligacionesFinancierasLP_0, $company->pasivoProveedoresLP_0, $company->pasivoCXPLP_0, $company->pasivoImpuestosYTasasLP_0, $company->pasivoObligacionesLaboralesLP_0, $company->pasivoProvisionesLP_0, $company->depositosExigiblesLP_0);
                $pasivoNoCorriente_0 = addNumbers($pasivoNoCorriente_0, $company->fondosSociales_0, $company->otrosPasivosNoCorrientes_0);

                echo "$ " . number_format( $pasivoNoCorriente_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $pasivoNoCorriente_1 = addNumbers($company->pasivoObligacionesFinancierasLP_1, $company->pasivoProveedoresLP_1, $company->pasivoCXPLP_1, $company->pasivoImpuestosYTasasLP_1, $company->pasivoObligacionesLaboralesLP_1, $company->pasivoProvisionesLP_1, $company->depositosExigiblesLP_1);
                $pasivoNoCorriente_1 = addNumbers($pasivoNoCorriente_1, $company->fondosSociales_1, $company->otrosPasivosNoCorrientes_1);
                echo "$ " . number_format( $pasivoNoCorriente_1, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $pasivoNoCorriente_2 = addNumbers($company->pasivoObligacionesFinancierasLP_2, $company->pasivoProveedoresLP_2, $company->pasivoCXPLP_2, $company->pasivoImpuestosYTasasLP_2, $company->pasivoObligacionesLaboralesLP_2, $company->pasivoProvisionesLP_2, $company->depositosExigiblesLP_2);
                $pasivoNoCorriente_2 = addNumbers($pasivoNoCorriente_2, $company->fondosSociales_2, $company->otrosPasivosNoCorrientes_2);
                echo "$ " . number_format( $pasivoNoCorriente_2, 2, ',', '.');
            ?>
        </td>
    </tr>
    <tr>
        <td class="td_title">Pasivo</td>
        <td class="bg_lightblue_1">
            <?php
                $pasivo_0 = addNumbers($pasivoCorriente_0, $pasivoNoCorriente_0);
                echo "$ " . number_format( $pasivo_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue_1">
            <?php
                $pasivo_1 = addNumbers( $pasivoCorriente_1, $pasivoNoCorriente_1);
                echo "$ " . number_format( $pasivo_1, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue_1">
            <?php
                $pasivo_2 = addNumbers( $pasivoCorriente_2, $pasivoNoCorriente_2);
                echo "$ " . number_format( $pasivo_2, 2, ',', '.');
            ?>
        </td>
    </tr>
    <tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'patrimonioCapitalSocial_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioCapitalSocial_0]', $company->patrimonioCapitalSocial_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioCapitalSocial_1]', $company->patrimonioCapitalSocial_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioCapitalSocial_2]', $company->patrimonioCapitalSocial_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'patrimonioReservaSocial_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioReservaSocial_0]', $company->patrimonioReservaSocial_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioReservaSocial_1]', $company->patrimonioReservaSocial_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioReservaSocial_2]', $company->patrimonioReservaSocial_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'patrimonioResultadoEjercicio_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioResultadoEjercicio_0]', $company->patrimonioResultadoEjercicio_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioResultadoEjercicio_1]', $company->patrimonioResultadoEjercicio_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioResultadoEjercicio_2]', $company->patrimonioResultadoEjercicio_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'patrimonioResultadoEjerciciosAnteriores_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioResultadoEjerciciosAnteriores_0]', $company->patrimonioResultadoEjerciciosAnteriores_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioResultadoEjerciciosAnteriores_1]', $company->patrimonioResultadoEjerciciosAnteriores_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioResultadoEjerciciosAnteriores_2]', $company->patrimonioResultadoEjerciciosAnteriores_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'patrimonioSuperavitPorValorizaciones_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioSuperavitPorValorizaciones_0]', $company->patrimonioSuperavitPorValorizaciones_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioSuperavitPorValorizaciones_1]', $company->patrimonioSuperavitPorValorizaciones_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioSuperavitPorValorizaciones_2]', $company->patrimonioSuperavitPorValorizaciones_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'patrimonioFondoDestinacionEspecifica_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioFondoDestinacionEspecifica_0]', $company->patrimonioFondoDestinacionEspecifica_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioFondoDestinacionEspecifica_1]', $company->patrimonioFondoDestinacionEspecifica_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioFondoDestinacionEspecifica_2]', $company->patrimonioFondoDestinacionEspecifica_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>

    <tr>
        <td class="td_title"><b>Patrimonio</b></td>
        <td class="bg_lightblue">
            <?php
                $patrimonio_0 = addNumbers($company->patrimonioCapitalSocial_0, $company->patrimonioReservaSocial_0, $company->patrimonioResultadoEjercicio_0, $company->patrimonioResultadoEjerciciosAnteriores_0, $company->patrimonioSuperavitPorValorizaciones_0) + $company->patrimonioFondoDestinacionEspecifica_0;
                echo "$ " . number_format( $patrimonio_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $patrimonio_1 = addNumbers($company->patrimonioCapitalSocial_1, $company->patrimonioReservaSocial_1, $company->patrimonioResultadoEjercicio_1, $company->patrimonioResultadoEjerciciosAnteriores_1, $company->patrimonioSuperavitPorValorizaciones_1) + $company->patrimonioFondoDestinacionEspecifica_1;
                echo "$ " . number_format( $patrimonio_1, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $patrimonio_2 = addNumbers($company->patrimonioCapitalSocial_2, $company->patrimonioReservaSocial_2, $company->patrimonioResultadoEjercicio_2, $company->patrimonioResultadoEjerciciosAnteriores_2, $company->patrimonioSuperavitPorValorizaciones_2) + $company->patrimonioFondoDestinacionEspecifica_2;
                echo "$ " . number_format( $patrimonio_2, 2, ',', '.');
            ?>
        </td>
    </tr>
    <tr>
        <td class="td_title"><b>Total Pasivo y Patrimonio</b></td>
        <td class="bg_lightblue_1">
            <?php
                $patrimonioPasivoYPatrimonio_0 = addNumbers($pasivo_0, $patrimonio_0);
                echo "$ " . number_format( $patrimonioPasivoYPatrimonio_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue_1">
            <?php
                $patrimonioPasivoYPatrimonio_1 = addNumbers($pasivo_1, $patrimonio_1);
                echo "$ " . number_format( $patrimonioPasivoYPatrimonio_1, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue_1">
            <?php
                $patrimonioPasivoYPatrimonio_2 = addNumbers($pasivo_2, $patrimonio_2);
                echo "$ " . number_format( $patrimonioPasivoYPatrimonio_2, 2, ',', '.');
            ?>
        </td>
    </tr>
    <tr>
        <th class="" colspan="5"><b>ESTADO DE RESULTADOS</b></th>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'estadoIngresosOperacionales_0'); ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoIngresosOperacionales_0]', $company->estadoIngresosOperacionales_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoIngresosOperacionales_1]', $company->estadoIngresosOperacionales_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoIngresosOperacionales_2]', $company->estadoIngresosOperacionales_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </td>
</tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'estadoCostoDeVenta_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoCostoDeVenta_0]', $company->estadoCostoDeVenta_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoCostoDeVenta_1]', $company->estadoCostoDeVenta_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoCostoDeVenta_2]', $company->estadoCostoDeVenta_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>
    <tr>
        <td class="td_title"><b>Utilidad Bruta</b></td>
        <td class="bg_lightblue">
            <?php
                $utilidadBruta_0 = subtractNumbers($company->estadoIngresosOperacionales_0, $company->estadoCostoDeVenta_0);
                echo "$ " . number_format( $utilidadBruta_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $utilidadBruta_1 = subtractNumbers($company->estadoIngresosOperacionales_1, $company->estadoCostoDeVenta_1);
                echo "$ " . number_format( $utilidadBruta_1, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $utilidadBruta_2 = subtractNumbers($company->estadoIngresosOperacionales_2, $company->estadoCostoDeVenta_2);
                echo "$ " . number_format( $utilidadBruta_2, 2, ',', '.');
            ?>
        </td>
    </tr>
    <tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'estadoGastosOperacionalesAdmon_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosOperacionalesAdmon_0]', $company->estadoGastosOperacionalesAdmon_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosOperacionalesAdmon_1]', $company->estadoGastosOperacionalesAdmon_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosOperacionalesAdmon_2]', $company->estadoGastosOperacionalesAdmon_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
</tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'Depreciación (Informativo)'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoDepreciacion_0]', $company->estadoDepreciacion_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoDepreciacion_1]', $company->estadoDepreciacion_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoDepreciacion_2]', $company->estadoDepreciacion_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'Amortización (Informativo)'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoAmortizacion_0]', $company->estadoAmortizacion_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoAmortizacion_1]', $company->estadoAmortizacion_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoAmortizacion_2]', $company->estadoAmortizacion_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>

<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'estadoGastosOperacionalesVenta_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosOperacionalesVenta_0]', $company->estadoGastosOperacionalesVenta_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosOperacionalesVenta_1]', $company->estadoGastosOperacionalesVenta_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosOperacionalesVenta_2]', $company->estadoGastosOperacionalesVenta_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>
    <tr>
        <td class="td_title"><b>Utilidad Operacional</b></td>
        <td class="bg_lightblue">
            <?php
                $utilidadOperacional_0 = subtractNumbers($utilidadBruta_0, addNumbers($company->estadoGastosOperacionalesAdmon_0, $company->estadoGastosOperacionalesVenta_0));
                echo "$ " . number_format( $utilidadOperacional_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $utilidadOperacional_1 = subtractNumbers($utilidadBruta_1, addNumbers($company->estadoGastosOperacionalesAdmon_1, $company->estadoGastosOperacionalesVenta_1));
                echo "$ " . number_format( $utilidadOperacional_1, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $utilidadOperacional_2 = subtractNumbers($utilidadBruta_2, addNumbers($company->estadoGastosOperacionalesAdmon_2, $company->estadoGastosOperacionalesVenta_2));
                echo "$ " . number_format( $utilidadOperacional_2, 2, ',', '.');
            ?>
        </td>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'estadoIngresosNoOperacionales_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoIngresosNoOperacionales_0]', $company->estadoIngresosNoOperacionales_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoIngresosNoOperacionales_1]', $company->estadoIngresosNoOperacionales_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoIngresosNoOperacionales_2]', $company->estadoIngresosNoOperacionales_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'estadoGastosNoOperacionales_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosNoOperacionales_0]', $company->estadoGastosNoOperacionales_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosNoOperacionales_1]', $company->estadoGastosNoOperacionales_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosNoOperacionales_2]', $company->estadoGastosNoOperacionales_2, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    </tr>
    
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'estadoInteresesBancarios_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][estadoInteresesBancarios_0]', $company->estadoInteresesBancarios_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][estadoInteresesBancarios_1]', $company->estadoInteresesBancarios_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][estadoInteresesBancarios_2]', $company->estadoInteresesBancarios_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>
    <tr>
        <td class="td_title"><b>Utilidad Antes de Impuestos</b></td>
        <td class="bg_lightblue">
            <?php
                $utilidadAntesDeImpuestos_0 = subtractNumbers(addNumbers($utilidadOperacional_0, $company->estadoIngresosNoOperacionales_0 ), $company->estadoGastosNoOperacionales_0);
                echo "$ " . number_format( $utilidadAntesDeImpuestos_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $utilidadAntesDeImpuestos_1 = subtractNumbers(addNumbers($utilidadOperacional_1, $company->estadoIngresosNoOperacionales_1 ), $company->estadoGastosNoOperacionales_1);
                echo "$ " . number_format( $utilidadAntesDeImpuestos_1, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $utilidadAntesDeImpuestos_2 = subtractNumbers(addNumbers($utilidadOperacional_2, $company->estadoIngresosNoOperacionales_2 ), $company->estadoGastosNoOperacionales_2);
                echo "$ " . number_format( $utilidadAntesDeImpuestos_2, 2, ',', '.');
            ?>
        </td>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'impuestoDeRenta_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][impuestoDeRenta_0]', $company->impuestoDeRenta_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][impuestoDeRenta_1]', $company->impuestoDeRenta_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][impuestoDeRenta_2]', $company->impuestoDeRenta_2, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
    </tr>
    <tr>
        <td class="td_title"><b>Utilidad Neta</b></td>
        <td class="bg_lightblue">
            <?php
                $utilidadNeta_0 = subtractNumbers($utilidadAntesDeImpuestos_0, $company->impuestoDeRenta_0);
                echo "$ " . number_format( $utilidadNeta_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $utilidadNeta_1 = subtractNumbers($utilidadAntesDeImpuestos_1, $company->impuestoDeRenta_1);
                echo "$ " . number_format( $utilidadNeta_1, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $utilidadNeta_2 = subtractNumbers($utilidadAntesDeImpuestos_2, $company->impuestoDeRenta_2);
                echo "$ " . number_format( $utilidadNeta_2, 2, ',', '.');
            ?>
        </td>
    </tr>
    <tr>
        <td class="td_title"><b>EBITDA</b></td>
        <td class="bg_lightblue">
            <?php
                $ebitda_0 = addNumbers($company->estadoDepreciacion_0, $company->estadoAmortizacion_0 ,$utilidadOperacional_0);
                echo "$ " . number_format( $ebitda_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $ebitda_1 = addNumbers($company->estadoDepreciacion_1, $company->estadoAmortizacion_1 ,$utilidadOperacional_1);
                echo "$ " . number_format( $ebitda_1, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $ebitda_2 = addNumbers($company->estadoDepreciacion_2, $company->estadoAmortizacion_2 ,$utilidadOperacional_2);
                echo "$ " . number_format( $ebitda_2, 2, ',', '.');
            ?>
        </td>
    </tr>
</table>
<br>
<?php else: ?>

<table id="detailCompanyFinantialAnalys">
    <tr>
        <th width="200" style="color: #ffffff !important; font-size: large; background: #08124C; font-weight: bold; ">CUENTAS PRINCIPALES</th>
        <th class="th_title"><span>Cierre del último año</span></th>
        <th class="th_title"><span>Cierre del penúltimo año</span></th>
        <th class="th_title"><span>Variación $</span></th>
        <th class="th_title"><span>Variación %</span></th>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'dateLastBalanceSheet'); ?>
        </td>
        <td>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . $company->id . '][dateLastBalanceSheet]',
                'value' => $company->dateLastBalanceSheet,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'dateFormat' => 'yy',
                    'showButtonPanel' => true,
                    'changeYear' => true,
                    'changeMonth' => true,
                    'maxDate' => "+1Y",
                ),
                'htmlOptions' => array(
                    'style' => 'width:8em;'
                ),
            ));
            ?>
        </td>
        <td>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . $company->id . '][dateLastBalanceSheet_1]',
                'value' => $company->dateLastBalanceSheet_1,
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'buttonText' => '...',
                    'dateFormat' => 'yy',
                    'showButtonPanel' => true,
                    'changeYear' => true,
                    'changeMonth' => true,
                    'maxDate' => "+0D",
                    'value' => '0000'
                ),
                'htmlOptions' => array(
                    'style' => 'width:8em;',
                    'value' => '0000'
                ),
            ));
            ?>
        </td>
        <td style="background: #000000;" ></td>
        <td style="background: #000000;" ></td>
    </tr>
    
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoDisponible_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoDisponible_0]', $company->activoDisponible_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoDisponible_1]', $company->activoDisponible_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <?php echo varCuentas($company->activoDisponible_0,$company->activoDisponible_1); ?>
    </tr>
    
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoClientes_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoClientes_0]', $company->activoClientes_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoClientes_1]', $company->activoClientes_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <?php echo varCuentas($company->activoClientes_0, $company->activoClientes_1); ?>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoAnticiposYAvances_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoAnticiposYAvances_0]', $company->activoAnticiposYAvances_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoAnticiposYAvances_1]', $company->activoAnticiposYAvances_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <?php echo varCuentas($company->activoAnticiposYAvances_0, $company->activoAnticiposYAvances_1); ?>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoInventarios_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInventarios_0]', $company->activoInventarios_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInventarios_1]', $company->activoInventarios_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <?php echo varCuentas($company->activoInventarios_0, $company->activoInventarios_1); ?>
    </tr>
   
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoInversionesCP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInversionesCP_0]', $company->activoInversionesCP_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInversionesCP_1]', $company->activoInversionesCP_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <?php echo varCuentas($company->activoInversionesCP_0, $company->activoInversionesCP_1); ?>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'otrosActivosCorrientes_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosActivosCorrientes_0]', $company->otrosActivosCorrientes_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosActivosCorrientes_1]', $company->otrosActivosCorrientes_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <?php echo varCuentas($company->otrosActivosCorrientes_0, $company->otrosActivosCorrientes_1); ?>
    </tr>
    <tr>
        <td class="td_title">Activo Corriente</td>
        <td class="bg_lightblue">
            <?php
                $activoCorriente_0 = addNumbers($company->activoDisponible_0, $company->activoClientes_0, $company->activoAnticiposYAvances_0 , $company->activoInventarios_0, $company->activoInversionesCP_0, $company->otrosActivosCorrientes_0);
                echo  "$ " . number_format( $activoCorriente_0, 2, ',', '.');

            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $activoCorriente_1 = addNumbers( $company->activoDisponible_1, $company->activoClientes_1, $company->activoAnticiposYAvances_1, $company->activoInventarios_1, $company->activoInversionesCP_1, $company->otrosActivosCorrientes_1);
                echo  "$ " . number_format( $activoCorriente_1, 2, ',', '.');

            ?>
        </td>
        <?php echo varCuentas($activoCorriente_0, $activoCorriente_1); ?>
    </tr>
 
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoPropiedadPlantaYEquipo_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoPropiedadPlantaYEquipo_0]', $company->activoPropiedadPlantaYEquipo_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoPropiedadPlantaYEquipo_1]', $company->activoPropiedadPlantaYEquipo_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <?php echo varCuentas($company->activoPropiedadPlantaYEquipo_0, $company->activoPropiedadPlantaYEquipo_1); ?>
    </tr>
    
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoDepreciacion_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoDepreciacion_0]', $company->activoDepreciacion_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoDepreciacion_1]', $company->activoDepreciacion_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <?php echo varCuentas($company->activoDepreciacion_0, $company->activoDepreciacion_1); ?>
    </tr>
    <tr>
        <td class="td_title"><b>Activo Fijo</b></td>
        <td class="bg_lightblue">
            <?php
                $activoFijo_0 = subtractNumbers($company->activoPropiedadPlantaYEquipo_0, $company->activoDepreciacion_0);
                echo "$ " . number_format( $activoFijo_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $activoFijo_1 = subtractNumbers($company->activoPropiedadPlantaYEquipo_1, $company->activoDepreciacion_1);
                echo "$ " . number_format( $activoFijo_1, 2, ',', '.');
            ?>
        </td>
        <?php echo varCuentas($activoFijo_0, $activoFijo_1); ?>
    </tr>
    
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'activoInversionesLP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInversionesLP_0]', $company->activoInversionesLP_0, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][activoInversionesLP_1]', $company->activoInversionesLP_1, array('rows' => 1, 'cols' => 30));
            ?> 
        </td>
        <?php echo varCuentas($company->activoInversionesLP_0, $company->activoInversionesLP_1); ?>
    </tr>
    <tr>
            <td class="td_title">
                <?php echo CHtml::activeLabel($company, 'activoIntangibles_0'); ?>
            </td>
            <td>
                <?php
                echo CHtml::textField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_details]' .
                        '[' . $company->id . '][activoIntangibles_0]', $company->activoIntangibles_0, array('rows' => 1, 'cols' => 30));
                ?>
            </td>
            <td>
                <?php
                    echo CHtml::textField('verificationSection' .
                        '[' . $verificationSection->id . ']' .
                        '[_details]' .
                        '[' . $company->id . '][activoIntangibles_1]', $company->activoIntangibles_1, array('rows' => 1, 'cols' => 30));
                ?>
            </td>
            <?php echo varCuentas($company->activoIntangibles_0, $company->activoIntangibles_1); ?>
        </tr>
        <tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'activoValorizaciones_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][activoValorizaciones_0]', $company->activoValorizaciones_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][activoValorizaciones_1]', $company->activoValorizaciones_1, array('rows' => 1, 'cols' => 30));
    ?>
        </td>
        <?php echo varCuentas($company->activoValorizaciones_0, $company->activoValorizaciones_1); ?>
    </tr>
        <tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'otrosNoActivosCorrientes_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][otrosNoActivosCorrientes_0]', $company->otrosNoActivosCorrientes_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][otrosNoActivosCorrientes_1]', $company->otrosNoActivosCorrientes_1, array('rows' => 1, 'cols' => 30));
    ?>
        </td>
        <?php echo varCuentas($company->otrosNoActivosCorrientes_1, $company->otrosNoActivosCorrientes_1); ?>
    </tr>
    <tr>
        <td class="td_title"><b>Otros Activos</b></td>
        <td class="bg_lightblue">
            <?php
                $otrosActivos_0 = addNumbers($company->activoInversionesLP_0, $company->activoIntangibles_0, $company->activoValorizaciones_0, $company->otrosNoActivosCorrientes_0);
                echo "$ " . number_format( $otrosActivos_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $otrosActivos_1 = addNumbers($company->activoInversionesLP_1, $company->activoIntangibles_1, $company->activoValorizaciones_1, $company->otrosNoActivosCorrientes_1);
                echo "$ " . number_format( $otrosActivos_1, 2, ',', '.');
            ?>
        </td>
        <?php echo varCuentas($otrosActivos_0, $otrosActivos_1); ?>
    </tr>
    <tr>
        <td class="td_title">Activo</td>
        <td class="bg_lightblue_1">
            <?php
                $activo_0 = addNumbers($activoCorriente_0, $activoFijo_0, $otrosActivos_0);
                echo "$ " . number_format( $activo_0, 2, ',', '.');
                
            ?>
        </td>
        <td class="bg_lightblue_1">
            <?php
                $activo_1 = addNumbers($activoCorriente_1, $activoFijo_1, $otrosActivos_1);
                echo "$ " . number_format( $activo_1, 2, ',', '.');
            ?>
        </td>
        <?php echo varCuentas($activo_0, $activo_1); ?>
    </tr>

    
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoObligacionesFinancierasCP_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesFinancierasCP_0]', $company->pasivoObligacionesFinancierasCP_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesFinancierasCP_1]', $company->pasivoObligacionesFinancierasCP_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->pasivoObligacionesFinancierasCP_0, $company->pasivoObligacionesFinancierasCP_1); ?>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoProveedores_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProveedores_0]', $company->pasivoProveedores_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProveedores_1]', $company->pasivoProveedores_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->pasivoProveedores_0, $company->pasivoProveedores_1); ?>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoCXP_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoCXP_0]', $company->pasivoCXP_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoCXP_1]', $company->pasivoCXP_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->pasivoCXP_0, $company->pasivoCXP_1); ?>
    </tr>  
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'pasivoImpuestosYTasas_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoImpuestosYTasas_0]', $company->pasivoImpuestosYTasas_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoImpuestosYTasas_1]', $company->pasivoImpuestosYTasas_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <?php echo varCuentas($company->pasivoImpuestosYTasas_0, $company->pasivoImpuestosYTasas_1); ?>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoObligacionesLaborales_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesLaborales_0]', $company->pasivoObligacionesLaborales_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesLaborales_1]', $company->pasivoObligacionesLaborales_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->pasivoObligacionesLaborales_0, $company->pasivoObligacionesLaborales_1); ?>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoProvisiones_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProvisiones_0]', $company->pasivoProvisiones_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProvisiones_1]', $company->pasivoProvisiones_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->pasivoProvisiones_0, $company->pasivoProvisiones_1); ?>
    </tr>
        <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'depositosExigiblesCP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][depositosExigiblesCP_0]', $company->depositosExigiblesCP_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][depositosExigiblesCP_1]', $company->depositosExigiblesCP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
                <?php echo varCuentas($company->depositosExigiblesCP_0, $company->depositosExigiblesCP_1); ?>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'fondosSocialesCP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][fondosSocialesCP_0]', $company->fondosSocialesCP_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][fondosSocialesCP_1]', $company->fondosSocialesCP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
                <?php echo varCuentas($company->fondosSocialesCP_0, $company->fondosSocialesCP_1); ?>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'otrosPasivosCorrientes_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosPasivosCorrientes_0]', $company->otrosPasivosCorrientes_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosPasivosCorrientes_1]', $company->otrosPasivosCorrientes_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
                <?php echo varCuentas($company->otrosPasivosCorrientes_0, $company->otrosPasivosCorrientes_1); ?>
    </tr>
    

    <tr>
        <td class="td_title"><b>Pasivo Corriente</b></td>
        <td class="bg_lightblue">
            <?php
                $pasivoCorriente_0 = 
                    $company->pasivoObligacionesFinancierasCP_0 +
                    $company->pasivoProveedores_0 +
                    $company->pasivoCXP_0 +
                    $company->pasivoImpuestosYTasas_0 +
                    $company->pasivoObligacionesLaborales_0 +
                    $company->pasivoProvisiones_0 +
                    $company->depositosExigiblesCP_0 +
                    $company->otrosPasivosCorrientes_0 +
                    $company->fondosSocialesCP_0
                ;
                echo "$ " . number_format( $pasivoCorriente_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $pasivoCorriente_1 = 
                    $company->pasivoObligacionesFinancierasCP_1 +
                    $company->pasivoProveedores_1 +
                    $company->pasivoCXP_1 +
                    $company->pasivoImpuestosYTasas_1 +
                    $company->pasivoObligacionesLaborales_1 +
                    $company->pasivoProvisiones_1 +
                    $company->depositosExigiblesCP_1 +
                    $company->otrosPasivosCorrientes_1 +
                    $company->fondosSocialesCP_1
                ;
                echo "$ " . number_format( $pasivoCorriente_1, 2, ',', '.');
            ?>
        </td>
        <?php echo varCuentas($pasivoCorriente_0, $pasivoCorriente_1); ?>
    </tr>
    
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'pasivoObligacionesFinancierasLP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoObligacionesFinancierasLP_0]', $company->pasivoObligacionesFinancierasLP_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoObligacionesFinancierasLP_1]', $company->pasivoObligacionesFinancierasLP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <?php echo varCuentas($company->pasivoObligacionesFinancierasLP_0, $company->pasivoObligacionesFinancierasLP_1); ?>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoProveedoresLP_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProveedoresLP_0]', $company->pasivoProveedoresLP_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoProveedoresLP_1]', $company->pasivoProveedoresLP_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->pasivoProveedoresLP_0, $company->pasivoProveedoresLP_1); ?>
</tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'pasivoCXPLP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoCXPLP_0]', $company->pasivoCXPLP_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoCXPLP_1]', $company->pasivoCXPLP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <?php echo varCuentas($company->pasivoCXPLP_0, $company->pasivoCXPLP_1); ?>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoImpuestosYTasasLP_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoImpuestosYTasasLP_0]', $company->pasivoImpuestosYTasasLP_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoImpuestosYTasasLP_1]', $company->pasivoImpuestosYTasasLP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <?php echo varCuentas($company->pasivoImpuestosYTasasLP_0, $company->pasivoImpuestosYTasasLP_1); ?>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoObligacionesLaboralesLP_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesLaboralesLP_0]', $company->pasivoObligacionesLaboralesLP_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][pasivoObligacionesLaboralesLP_1]', $company->pasivoObligacionesLaboralesLP_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<?php echo varCuentas($company->pasivoObligacionesLaboralesLP_0, $company->pasivoObligacionesLaboralesLP_1); ?>
</tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'pasivoProvisionesLP_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .

           '[' . $company->id . '][pasivoProvisionesLP_0]', $company->pasivoProvisionesLP_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][pasivoProvisionesLP_1]', $company->pasivoProvisionesLP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <?php echo varCuentas($company->pasivoProvisionesLP_0, $company->pasivoProvisionesLP_1); ?>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'depositosExigiblesLP_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][depositosExigiblesLP_0]', $company->depositosExigiblesLP_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][depositosExigiblesLP_1]', $company->depositosExigiblesLP_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
                <?php echo varCuentas($company->depositosExigiblesLP_0, $company->depositosExigiblesLP_1); ?>
    </tr>
    </tr>
        <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'fondosSociales_0'); ?>
        </td>
        
        <td>
            <?php

                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][fondosSociales_0]', $company->fondosSociales_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][fondosSociales_1]', $company->fondosSociales_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
                <?php echo varCuentas($company->fondosSociales_0, $company->fondosSociales_1);
                
                ?>
    </tr>
        <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'otrosPasivosNoCorrientes_0'); ?>
        </td>
        
        <td>
            <?php

                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosPasivosNoCorrientes_0]', $company->otrosPasivosNoCorrientes_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][otrosPasivosNoCorrientes_1]', $company->otrosPasivosNoCorrientes_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
                <?php echo varCuentas($company->otrosPasivosNoCorrientes_0, $company->otrosPasivosNoCorrientes_1);
                
                ?>
    </tr>
    <tr>
        <td class="td_title"><b>Pasivo No Corriente</b></td>
        <td class="bg_lightblue">
            <?php
                $pasivoNoCorriente_0 = addNumbers($company->pasivoObligacionesFinancierasLP_0, $company->pasivoProveedoresLP_0, $company->pasivoCXPLP_0, $company->pasivoImpuestosYTasasLP_0, $company->pasivoObligacionesLaboralesLP_0, $company->pasivoProvisionesLP_0, $company->depositosExigiblesLP_0);
                $pasivoNoCorriente_0 = addNumbers($pasivoNoCorriente_0, $company->fondosSociales_0, $company->otrosPasivosNoCorrientes_0);

                echo "$ " . number_format( $pasivoNoCorriente_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $pasivoNoCorriente_1 = addNumbers($company->pasivoObligacionesFinancierasLP_1, $company->pasivoProveedoresLP_1, $company->pasivoCXPLP_1, $company->pasivoImpuestosYTasasLP_1, $company->pasivoObligacionesLaboralesLP_1, $company->pasivoProvisionesLP_1, $company->depositosExigiblesLP_1);
                $pasivoNoCorriente_1 = addNumbers($pasivoNoCorriente_1, $company->fondosSociales_1, $company->otrosPasivosNoCorrientes_1);
                echo "$ " . number_format( $pasivoNoCorriente_1, 2, ',', '.');
            ?>
        </td>
        <?php echo varCuentas($pasivoNoCorriente_0, $pasivoNoCorriente_1); ?>
    </tr>
    <tr>
        <td class="td_title">Pasivo</td>
        <td class="bg_lightblue_1">
            <?php
                $pasivo_0 = addNumbers($pasivoCorriente_0, $pasivoNoCorriente_0);
                echo "$ " . number_format( $pasivo_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue_1">
            <?php
                $pasivo_1 = addNumbers( $pasivoCorriente_1, $pasivoNoCorriente_1);
                echo "$ " . number_format( $pasivo_1, 2, ',', '.');
            ?>
        </td>
        <?php echo varCuentas($pasivo_0, $pasivo_1); ?>
    </tr>
    <tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'patrimonioCapitalSocial_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioCapitalSocial_0]', $company->patrimonioCapitalSocial_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioCapitalSocial_1]', $company->patrimonioCapitalSocial_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->patrimonioCapitalSocial_0, $company->patrimonioCapitalSocial_1); ?>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'patrimonioReservaSocial_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioReservaSocial_0]', $company->patrimonioReservaSocial_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioReservaSocial_1]', $company->patrimonioReservaSocial_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
    <?php echo varCuentas($company->patrimonioReservaSocial_0, $company->patrimonioReservaSocial_1); ?>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'patrimonioResultadoEjercicio_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioResultadoEjercicio_0]', $company->patrimonioResultadoEjercicio_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioResultadoEjercicio_1]', $company->patrimonioResultadoEjercicio_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <?php echo varCuentas($company->patrimonioResultadoEjercicio_0, $company->patrimonioResultadoEjercicio_1); ?>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'patrimonioResultadoEjerciciosAnteriores_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioResultadoEjerciciosAnteriores_0]', $company->patrimonioResultadoEjerciciosAnteriores_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][patrimonioResultadoEjerciciosAnteriores_1]', $company->patrimonioResultadoEjerciciosAnteriores_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->patrimonioResultadoEjerciciosAnteriores_0, $company->patrimonioResultadoEjerciciosAnteriores_1); ?>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'patrimonioSuperavitPorValorizaciones_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioSuperavitPorValorizaciones_0]', $company->patrimonioSuperavitPorValorizaciones_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioSuperavitPorValorizaciones_1]', $company->patrimonioSuperavitPorValorizaciones_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <?php echo varCuentas($company->patrimonioSuperavitPorValorizaciones_0, $company->patrimonioSuperavitPorValorizaciones_1); ?>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'patrimonioFondoDestinacionEspecifica_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioFondoDestinacionEspecifica_0]', $company->patrimonioFondoDestinacionEspecifica_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][patrimonioFondoDestinacionEspecifica_1]', $company->patrimonioFondoDestinacionEspecifica_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <?php echo varCuentas($company->patrimonioFondoDestinacionEspecifica_0, $company->patrimonioFondoDestinacionEspecifica_1); ?>
    </tr>

    <tr>
        <td class="td_title"><b>Patrimonio</b></td>
        <td class="bg_lightblue">
            <?php
                $patrimonio_0 = addNumbers($company->patrimonioCapitalSocial_0, $company->patrimonioReservaSocial_0, $company->patrimonioResultadoEjercicio_0, $company->patrimonioResultadoEjerciciosAnteriores_0, $company->patrimonioSuperavitPorValorizaciones_0) + $company->patrimonioFondoDestinacionEspecifica_0;
                echo "$ " . number_format( $patrimonio_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $patrimonio_1 = addNumbers($company->patrimonioCapitalSocial_1, $company->patrimonioReservaSocial_1, $company->patrimonioResultadoEjercicio_1, $company->patrimonioResultadoEjerciciosAnteriores_1, $company->patrimonioSuperavitPorValorizaciones_1) + $company->patrimonioFondoDestinacionEspecifica_1;
                echo "$ " . number_format( $patrimonio_1, 2, ',', '.');
            ?>
        </td>
        <?php echo varCuentas($patrimonio_0, $patrimonio_1); ?>
    </tr>
    <tr>
        <td class="td_title"><b>Total Pasivo y Patrimonio</b></td>
        <td class="bg_lightblue_1">
            <?php
                $patrimonioPasivoYPatrimonio_0 = addNumbers($pasivo_0, $patrimonio_0);
                echo "$ " . number_format( $patrimonioPasivoYPatrimonio_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue_1">
            <?php
                $patrimonioPasivoYPatrimonio_1 = addNumbers($pasivo_1, $patrimonio_1);
                echo "$ " . number_format( $patrimonioPasivoYPatrimonio_1, 2, ',', '.');
            ?>
        </td>
        <?php echo varCuentas($patrimonioPasivoYPatrimonio_0, $patrimonioPasivoYPatrimonio_1); ?>
    </tr>
    <tr>
        <th class="" colspan="5"><b>ESTADO DE RESULTADOS</b></th>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'estadoIngresosOperacionales_0'); ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoIngresosOperacionales_0]', $company->estadoIngresosOperacionales_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoIngresosOperacionales_1]', $company->estadoIngresosOperacionales_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1); ?>
    </td>
</tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'estadoCostoDeVenta_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoCostoDeVenta_0]', $company->estadoCostoDeVenta_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoCostoDeVenta_1]', $company->estadoCostoDeVenta_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->estadoCostoDeVenta_0, $company->estadoCostoDeVenta_1); ?>
    </tr>
    <tr>
        <td class="td_title"><b>Utilidad Bruta</b></td>
        <td class="bg_lightblue">
            <?php
                $utilidadBruta_0 = subtractNumbers($company->estadoIngresosOperacionales_0, $company->estadoCostoDeVenta_0);
                echo "$ " . number_format( $utilidadBruta_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $utilidadBruta_1 = subtractNumbers($company->estadoIngresosOperacionales_1, $company->estadoCostoDeVenta_1);
                echo "$ " . number_format( $utilidadBruta_1, 2, ',', '.');
            ?>
        </td>
        <?php echo varCuentas($utilidadBruta_0, $utilidadBruta_1); ?>
    </tr>
    <tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'estadoGastosOperacionalesAdmon_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosOperacionalesAdmon_0]', $company->estadoGastosOperacionalesAdmon_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosOperacionalesAdmon_1]', $company->estadoGastosOperacionalesAdmon_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->estadoGastosOperacionalesAdmon_0, $company->estadoGastosOperacionalesAdmon_1); ?>
</tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'Depreciación (Informativo)'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoDepreciacion_0]', $company->estadoDepreciacion_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoDepreciacion_1]', $company->estadoDepreciacion_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->estadoDepreciacion_0, $company->estadoDepreciacion_1); ?>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'Amortización (Informativo)'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoAmortizacion_0]', $company->estadoAmortizacion_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoAmortizacion_1]', $company->estadoAmortizacion_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->estadoAmortizacion_0, $company->estadoAmortizacion_1); ?>
    </tr>

<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'estadoGastosOperacionalesVenta_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosOperacionalesVenta_0]', $company->estadoGastosOperacionalesVenta_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosOperacionalesVenta_1]', $company->estadoGastosOperacionalesVenta_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->estadoGastosOperacionalesVenta_0, $company->estadoGastosOperacionalesVenta_1); ?>
    </tr>
    <tr>
        <td class="td_title"><b>Utilidad Operacional</b></td>
        <td class="bg_lightblue">
            <?php
                $utilidadOperacional_0 = subtractNumbers($utilidadBruta_0, addNumbers($company->estadoGastosOperacionalesAdmon_0, $company->estadoGastosOperacionalesVenta_0));
                echo "$ " . number_format( $utilidadOperacional_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $utilidadOperacional_1 = subtractNumbers($utilidadBruta_1, addNumbers($company->estadoGastosOperacionalesAdmon_1, $company->estadoGastosOperacionalesVenta_1));
                echo "$ " . number_format( $utilidadOperacional_1, 2, ',', '.');
            ?>
        </td>
        <?php echo varCuentas($utilidadOperacional_0, $utilidadOperacional_1); ?>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'estadoIngresosNoOperacionales_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoIngresosNoOperacionales_0]', $company->estadoIngresosNoOperacionales_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoIngresosNoOperacionales_1]', $company->estadoIngresosNoOperacionales_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->estadoIngresosNoOperacionales_0, $company->estadoIngresosNoOperacionales_1); ?>
    </tr>
<tr>
<td class="td_title">
    <?php echo CHtml::activeLabel($company, 'estadoGastosNoOperacionales_0'); ?>
</td>
<td>
    <?php
    echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosNoOperacionales_0]', $company->estadoGastosNoOperacionales_0, array('rows' => 1, 'cols' => 30));
    ?>
</td>
<td>
    <?php
        echo CHtml::textField('verificationSection' .
            '[' . $verificationSection->id . ']' .
            '[_details]' .
            '[' . $company->id . '][estadoGastosNoOperacionales_1]', $company->estadoGastosNoOperacionales_1, array('rows' => 1, 'cols' => 30));
    ?>
</td>
        <?php echo varCuentas($company->estadoGastosNoOperacionales_0, $company->estadoGastosNoOperacionales_1); ?>
    </tr>
    
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'estadoInteresesBancarios_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][estadoInteresesBancarios_0]', $company->estadoInteresesBancarios_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][estadoInteresesBancarios_1]', $company->estadoInteresesBancarios_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <?php echo varCuentas($company->estadoInteresesBancarios_0, $company->estadoInteresesBancarios_1); ?>
    </tr>
    <tr>
        <td class="td_title"><b>Utilidad Antes de Impuestos</b></td>
        <td class="bg_lightblue">
            <?php
                $utilidadAntesDeImpuestos_0 = subtractNumbers(addNumbers($utilidadOperacional_0, $company->estadoIngresosNoOperacionales_0 ), $company->estadoGastosNoOperacionales_0);
                echo "$ " . number_format( $utilidadAntesDeImpuestos_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $utilidadAntesDeImpuestos_1 = subtractNumbers(addNumbers($utilidadOperacional_1, $company->estadoIngresosNoOperacionales_1 ), $company->estadoGastosNoOperacionales_1);
                echo "$ " . number_format( $utilidadAntesDeImpuestos_1, 2, ',', '.');
            ?>
        </td>
        <?php echo varCuentas($utilidadAntesDeImpuestos_0, $utilidadAntesDeImpuestos_1); ?>
    </tr>
    <tr>
        <td class="td_title">
            <?php echo CHtml::activeLabel($company, 'impuestoDeRenta_0'); ?>
        </td>
        <td>
            <?php
            echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][impuestoDeRenta_0]', $company->impuestoDeRenta_0, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][impuestoDeRenta_1]', $company->impuestoDeRenta_1, array('rows' => 1, 'cols' => 30));
            ?>
        </td>
        <?php echo varCuentas($company->impuestoDeRenta_0, $company->impuestoDeRenta_1); ?>
    </tr>
    <tr>
        <td class="td_title"><b>Utilidad Neta</b></td>
        <td class="bg_lightblue">
            <?php
                $utilidadNeta_0 = subtractNumbers($utilidadAntesDeImpuestos_0, $company->impuestoDeRenta_0);
                echo "$ " . number_format( $utilidadNeta_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $utilidadNeta_1 = subtractNumbers($utilidadAntesDeImpuestos_1, $company->impuestoDeRenta_1);
                echo "$ " . number_format( $utilidadNeta_1, 2, ',', '.');
            ?>
        </td>
        <?php echo varCuentas($utilidadNeta_0, $utilidadNeta_1); ?>
    </tr>
    <tr>
        <td class="td_title"><b>EBITDA</b></td>
        <td class="bg_lightblue">
            <?php
                $ebitda_0 = addNumbers($company->estadoDepreciacion_0, $company->estadoAmortizacion_0 ,$utilidadOperacional_0);
                echo "$ " . number_format( $ebitda_0, 2, ',', '.');
            ?>
        </td>
        <td class="bg_lightblue">
            <?php
                $ebitda_1 = addNumbers($company->estadoDepreciacion_1, $company->estadoAmortizacion_1 ,$utilidadOperacional_1);
                echo "$ " . number_format( $ebitda_1, 2, ',', '.');
            ?>
        </td>
        <?php echo varCuentas($ebitda_0, $ebitda_1); ?>
    </tr>
</table>
<br>
<?php endif; ?>

<?php
$customerid = $verificationSection->backgroundCheck->customerId;
    $customerProductId = $verificationSection->backgroundCheck->customerProductId;
    if ($customerProductId == 2632 || $customerProductId == 3096 || $customerProductId == 3157 || $customerProductId == 3159):
?>
<table>
    <tr>
        <td >
            <?php echo CHtml::activeLabel($company, 'colpensionesType'); ?>
        </td>
        <td>
            <?php
                echo CHtml::dropDownList(
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][colpensionesType]'
                    , //
                    $company->colpensionesType, //
                    Controller::$optionColpensionesType);
            ?>
        </td>
    </tr>
</table>
    <?php endif;?>
    
        
<table id="financeIndicators">
    <tr >
        <th style="color: #ffffff !important; font-size: large !important; background: green;" width="350px">INDICADORES FINANCIEROS</th>
        <td>
            <?php echo $company->dateLastBalanceSheet; ?>
        </td>
        <td>
            <?php echo $company->dateLastBalanceSheet_1; ?>
        </td>
        <?php if ($verificationSection->backgroundCheck->customerId == 985): ?>
        <td>
            <?php echo $company->dateLastBalanceSheet_2; ?>
        </td>
        <?php endif;?>

        <?php
            if( $customerProductId == 2632 || $customerProductId == 3096 || $customerProductId == 3157 || $customerProductId == 3159){
                echo "<td> Ponderado </td>"; 
                echo "<td> Calificación de ".$company->dateLastBalanceSheet."</td>"; 
                echo "<td> Calificación de ".$company->dateLastBalanceSheet_1."</td>"; 
                if (!isset($company->colpensionesType)) {
                    $company->colpensionesType = 0;
                }
            }
            if($customerProductId == 2697){ // CLARO
                echo "<td>Max. Pond.</td>"; 
                echo "<td> Calificación de ".$company->dateLastBalanceSheet."</td>"; 
                echo "<td> Calificación de ".$company->dateLastBalanceSheet_1."</td>"; 
                if (!isset($company->colpensionesType)) {
                    $company->colpensionesType = 0;
                }
            }
/*

        if($customerid == 502) {
            echo "<td> Calificación de Vanti " . $company->dateLastBalanceSheet . "</td>";
            echo "<td> Calificación de Vanti " . $company->dateLastBalanceSheet_1 . "</td>";

        }*/
        ?>
        
    </tr>
    <?php
        
    ?>
    <?php  ?>
    <?php  ?>

    <?php
        $cuentasDisponibles_0 = $company->activoDisponible_0 + $company->activoInversionesCP_0;
        $cuentasDisponibles_1 = $company->activoDisponible_1 + $company->activoInversionesCP_1;
        $cuentasDisponibles_2 = $company->activoDisponible_2 + $company->activoInversionesCP_2;
        $depositosExigibles_0 = $company->depositosExigiblesCP_0 + $company->depositosExigiblesLP_0;
        $depositosExigibles_1 = $company->depositosExigiblesCP_1 + $company->depositosExigiblesLP_1;
        $depositosExigibles_2 = $company->depositosExigiblesCP_2 + $company->depositosExigiblesLP_2;
        $ObligacionesFinancieras_0 = addNumbers($company->pasivoObligacionesFinancierasCP_0, $company->pasivoObligacionesFinancierasLP_0);
        $ObligacionesFinancieras_1 = addNumbers($company->pasivoObligacionesFinancierasCP_1, $company->pasivoObligacionesFinancierasLP_1);
        $ObligacionesFinancieras_2 = addNumbers($company->pasivoObligacionesFinancierasCP_2, $company->pasivoObligacionesFinancierasLP_2);
        $totalIngresos_0 = $company->estadoIngresosOperacionales_0;
        $totalIngresos_1 = $company->estadoIngresosOperacionales_1;
        $totalIngresos_2 = $company->estadoIngresosOperacionales_2;

    ?>
    <?php
        if( $customerProductId == "2697"){ // CLARO NACIONAL
            include(Yii::app()->basePath . '/views/detailCompanyFinantialAnalys/_ponds/_claroNacional.php');
            echo indicadoresFinancieros( "Capital de Trabajo (3)", "subtract", $activoCorriente_0, $activoCorriente_1, $pasivoCorriente_0, $pasivoCorriente_1, "money" , $customerProductId, $company->colpensionesType) . $Obt_6_1 ."</tr>";
            echo indicadoresFinancieros( "Razón Corriente (1, 2, 3)", "divide", $activoCorriente_0, $activoCorriente_1, $pasivoCorriente_0, $pasivoCorriente_1, NULL , $customerProductId, $company->colpensionesType, 1) . $Obt_6_2 ."</tr>";
            echo indicadoresFinancieros( "Nivel de endeudamiento (1, 2, 3)", "divide", $pasivo_0, $pasivo_1, $activo_0, $activo_1, "percent" , $customerProductId, $company->colpensionesType, 6) . $Obt_6_3 ."</tr>";
            echo indicadoresFinancieros( "Concentración de Endeudamiento CP (3)", "divide", $pasivoCorriente_0, $pasivoCorriente_1, $pasivo_0, $pasivo_1, "percent", $customerProductId, $company->colpensionesType) . $Obt_6_4 ."</tr>";
            echo indicadoresFinancieros( "Endeudamiento/Ventas (3)", "divide", $pasivoCorriente_0, $pasivoCorriente_1, $pasivo_0, $pasivo_1, "percent", $customerProductId, $company->colpensionesType) . $Obt_6_5 ."</tr>";
            echo indicadoresFinancieros( "Endeudamiento Financiero (3)", "divide", $ObligacionesFinancieras_0, $ObligacionesFinancieras_1, $pasivo_0, $pasivo_1, 'percent2', $customerProductId, $company->colpensionesType) . $Obt_6_6 ."</tr>";
            echo indicadoresFinancieros( "Margen EBITDA (3)", "divide", $ebitda_0, $ebitda_1, $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, "percent", $customerProductId, $company->colpensionesType) . $Obt_6_7 . "</tr>";
            echo indicadoresFinancieros( "Rentabilidad Operativa Activo (ROA) (1, 3)", "divide", $utilidadNeta_0, $utilidadNeta_1, $activo_0, $activo_1,  "percent", $customerProductId, $company->colpensionesType, 4) . $Obt_6_8 ."</tr>";
            echo indicadoresFinancieros( "Cobertura de Gastos No Operacionales (3)", "divide", $utilidadOperacional_0, $utilidadOperacional_1, $company->estadoGastosNoOperacionales_0, $company->estadoGastosNoOperacionales_1 ,  "percent", $customerProductId, $company->colpensionesType, 5) . $Obt_6_9 ."</tr>";
            // echo indicadoresFinancieros( "Quebranto Patrimonial (1)", "divide", $patrimonio_0, $patrimonio_1, $company->patrimonioCapitalSocial_0, $company->patrimonioCapitalSocial_1, "percent", $customerProductId, $company->colpensionesType, 7)  . $empty ."</tr>";
            echo "<tr>
                    <th>
                        <b>Utilidades Acumuladas (3)</b>
                    </th>
                    <td class='align_right' colspan='2'>". $utilidadesAcumuladas. "</td>
                    <td class='align_right'>".$Max_6_10."</td>
                    <td class='align_right' colspan='2'>".$Obt_6_10." </td>
                </tr>";
            
                echo "<tr>
                    <th>
                        <b>Var. Ingresos Operacionales (3)</b>
                    </th>
                    <td class='align_right' colspan='2'>". $varingresosOperacionales. "</td>
                    <td class='align_right'>".$Max_6_11."</td>
                    <td class='align_right' colspan='2'>".$Obt_6_11." </td>
                </tr>";
                
                echo "<tr>
                    <th>
                        <b>Var. Capital de Trabajo (3)</b>
                    </th>
                    <td class='align_right' colspan='2'>". $varCapitalTrabajo. "</td>
                    <td class='align_right'>".$Max_6_13."</td>
                    <td class='align_right' colspan='2'>".$Obt_6_13." </td>
                </tr>";
            
        } elseif($customerid == 502) {
            // INDICADORES VANTI
            echo indicadoresFinancieros( "Razón Corriente", "divide", $activoCorriente_0, $activoCorriente_1, $pasivoCorriente_0, $pasivoCorriente_1, NULL , $customerProductId, $company->colpensionesType, 1) . "</tr>";
            echo indicadoresFinancieros( "Prueba Ácida", "divide", ($activoCorriente_0 - $company->activoInventarios_0), ($activoCorriente_1 - $company->activoInventarios_1), $pasivoCorriente_0, $pasivoCorriente_1, NULL , $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Capital de Trabajo", "subtract", $activoCorriente_0, $activoCorriente_1, $pasivoCorriente_0, $pasivoCorriente_1, "money" , $customerProductId, $company->colpensionesType) . "</tr>";
           // echo indicadoresFinancieros( "Fondo de liquidez (1)", "divide", $cuentasDisponibles_0, $cuentasDisponibles_1, $depositosExigibles_0, $depositosExigibles_1, NULL , $customerProductId, $company->colpensionesType, 2) . "</tr>";
            echo indicadoresFinancieros( "Nivel de endeudamiento", "divide", $pasivo_0, $pasivo_1, $activo_0, $activo_1, "percent" , $customerProductId, $company->colpensionesType, 6) . "</tr>";
            echo indicadoresFinancieros( "Rentabilidad Patrimonio (ROE)", "divide", $utilidadNeta_0, $utilidadNeta_1, $patrimonio_0, $patrimonio_1 ,  "percent", $customerProductId, $company->colpensionesType, 5) . "</tr>";
            echo indicadoresFinancieros( "Margen EBITDA", "divide", $ebitda_0, $ebitda_1, $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, "percent", $customerProductId, $company->colpensionesType) . "</tr>";

         }elseif($customerid == 648) {
            //INDICADORES RCN
            echo indicadoresFinancieros( "Razón Corriente", "divide", $activoCorriente_0, $activoCorriente_1, $pasivoCorriente_0, $pasivoCorriente_1, NULL , $customerProductId, $company->colpensionesType, 1) . "</tr>";
            echo indicadoresFinancieros( "Prueba Ácida", "divide", ($activoCorriente_0 - $company->activoInventarios_0), ($activoCorriente_1 - $company->activoInventarios_1), $pasivoCorriente_0, $pasivoCorriente_1, NULL , $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Capital de Trabajo", "subtract", $activoCorriente_0, $activoCorriente_1, $pasivoCorriente_0, $pasivoCorriente_1, "money" , $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Nivel de endeudamiento", "divide", $pasivo_0, $pasivo_1, $activo_0, $activo_1, "percent" , $customerProductId, $company->colpensionesType, 6) . "</tr>";
            echo indicadoresFinancieros( "Endeudamiento Financiero", "divide", $ObligacionesFinancieras_0, $ObligacionesFinancieras_1, $company->estadoIngresosOperacionales_0,$company->estadoIngresosOperacionales_1, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Apalancamiento Corto Plazo", "divide", $pasivoCorriente_0, $pasivoCorriente_1, $patrimonio_0, $patrimonio_1, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Margen EBITDA", "divide", $ebitda_0, $ebitda_1, $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Rentabilidad Operativa Activo (ROA)", "divide", $utilidadNeta_0, $utilidadNeta_1, $activo_0, $activo_1,  "percent", $customerProductId, $company->colpensionesType, 4) . "</tr>";
            echo indicadoresFinancieros( "Rentabilidad Patrimonio (ROE)", "divide", $utilidadNeta_0, $utilidadNeta_1, $patrimonio_0, $patrimonio_1 ,  "percent", $customerProductId, $company->colpensionesType, 5) . "</tr>";
            echo indicadoresFinancieros( "Margen Neto de Utilidad", "divide", $utilidadNeta_0, $utilidadNeta_1, $company->estadoIngresosOperacionales_0,$company->estadoIngresosOperacionales_1, "percent", $customerProductId, $company->colpensionesType, 3) . "</tr>";
            echo indicadoresFinancieros( "Margen Bruto de Utilidad", "divide", $utilidadBruta_0, $utilidadBruta_1, $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Rotación de Activos", "divide", $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, $activo_0, $activo_1, NULL , $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Rotación de Cartera", "divide", $company->activoClientes_0 * 360, $company->activoClientes_1 * 360, $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, "days" , $customerProductId) . "</tr>";
            echo indicadoresFinancieros( "Rotación de Inventario", "divide", $company->activoInventarios_0 * 360, $company->activoInventarios_1 * 360, $company->estadoCostoDeVenta_0, $company->estadoCostoDeVenta_1, "days" , $customerProductId) . "</tr>";
            // echo indicadoresFinancieros( "Fondo de liquidez (1)", "divide", $cuentasDisponibles_0, $cuentasDisponibles_1, $depositosExigibles_0, $depositosExigibles_1, NULL , $customerProductId, $company->colpensionesType, 2) . "</tr>";
            //  echo indicadoresFinancieros( "Leverage (2)", "divide", $pasivo_0, $pasivo_1, $patrimonio_0, $patrimonio_1, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            // echo indicadoresFinancieros( "Apalancamiento Largo Plazo (3)", "divide", $pasivoNoCorriente_0, $pasivoNoCorriente_1, $pasivo_0, $pasivo_1, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            //  echo indicadoresFinancieros( "Cobertura de Gastos No Operacionales (3)", "divide", $utilidadOperacional_0, $utilidadOperacional_1, $company->estadoGastosNoOperacionales_0, $company->estadoGastosNoOperacionales_1 ,  "percent", $customerProductId, $company->colpensionesType, 5) . "</tr>";
            //   echo indicadoresFinancieros( "Quebranto Patrimonial (1)", "divide", $patrimonio_0, $patrimonio_1, $company->patrimonioCapitalSocial_0, $company->patrimonioCapitalSocial_1, "percent", $customerProductId, $company->colpensionesType, 7) . "</tr>";
        }elseif($customerid == 985) {

            // INDICADORES Coface
            echo indicadoresFinancierosCoface( "Razón Corriente (1, 2, 3)", "divide", $activoCorriente_0, $activoCorriente_1, $activoCorriente_2, $pasivoCorriente_0, $pasivoCorriente_1, $pasivoCorriente_2, NULL , $customerProductId, $company->colpensionesType, 1) . "</tr>";
            echo indicadoresFinancierosCoface( "Prueba Ácida (2, 3)", "divide", ($activoCorriente_0 - $company->activoInventarios_0), ($activoCorriente_1 - $company->activoInventarios_1), ($activoCorriente_2 - $company->activoInventarios_2),$pasivoCorriente_0, $pasivoCorriente_1, $pasivoCorriente_2, NULL , $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancierosCoface( "Capital de Trabajo (3)", "subtract", $activoCorriente_0, $activoCorriente_1, $activoCorriente_2, $pasivoCorriente_0, $pasivoCorriente_1, $pasivoCorriente_2, "money" , $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancierosCoface( "Fondo de liquidez (1)", "divide", $cuentasDisponibles_0, $cuentasDisponibles_1, $cuentasDisponibles_2, $depositosExigibles_0, $depositosExigibles_1, $depositosExigibles_2, NULL , $customerProductId, $company->colpensionesType, 2) . "</tr>";
            echo indicadoresFinancierosCoface( "Nivel de endeudamiento (1, 2, 3)", "divide", $pasivo_0, $pasivo_1, $pasivo_2, $activo_0, $activo_1, $activo_2, "percent" , $customerProductId, $company->colpensionesType, 6) . "</tr>";
            echo indicadoresFinancierosCoface( "Leverage (2)", "divide", $pasivo_0, $pasivo_1, $pasivo_2, $patrimonio_0, $patrimonio_1, $patrimonio_2, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancierosCoface( "Endeudamiento Financiero (3)", "divide", $ObligacionesFinancieras_0, $ObligacionesFinancieras_1, $ObligacionesFinancieras_2, $pasivo_0, $pasivo_1, $pasivo_2, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancierosCoface( "Apalancamiento Corto Plazo (3)", "divide", $pasivoCorriente_0, $pasivoCorriente_1, $pasivoCorriente_2, $pasivo_0, $pasivo_1, $pasivo_2, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancierosCoface( "Apalancamiento Largo Plazo (3)", "divide", $pasivoNoCorriente_0, $pasivoNoCorriente_1, $pasivoNoCorriente_2, $pasivo_0, $pasivo_1, $pasivo_2, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancierosCoface( "Rentabilidad Operativa Activo (ROA) (1, 3)", "divide", $utilidadNeta_0, $utilidadNeta_1, $utilidadNeta_2, $activo_0, $activo_1, $activo_2,  "percent", $customerProductId, $company->colpensionesType, 4) . "</tr>";
            echo indicadoresFinancierosCoface( "Rentabilidad Patrimonio (ROE) (1, 3)", "divide", $utilidadNeta_0, $utilidadNeta_1, $utilidadNeta_2, $patrimonio_0, $patrimonio_1, $patrimonio_2,  "percent", $customerProductId, $company->colpensionesType, 5) . "</tr>";
            echo indicadoresFinancierosCoface( "Cobertura de Gastos No Operacionales (3)", "divide", $utilidadOperacional_0, $utilidadOperacional_1, $utilidadOperacional_2, $company->estadoGastosNoOperacionales_0, $company->estadoGastosNoOperacionales_1, $company->estadoGastosNoOperacionales_2,  "percent", $customerProductId, $company->colpensionesType, 5) . "</tr>";
            echo indicadoresFinancierosCoface( "Margen Neto de Utilidad (1, 3)", "divide", $utilidadNeta_0, $utilidadNeta_1, $company->estadoIngresosOperacionales_0,$company->estadoIngresosOperacionales_1, "percent", $customerProductId, $company->colpensionesType, 3) . "</tr>";
            echo indicadoresFinancierosCoface( "Margen Bruto de Utilidad (2, 3)", "divide", $utilidadBruta_0, $utilidadBruta_1, $utilidadBruta_2, $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, $company->estadoIngresosOperacionales_2, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancierosCoface( "Margen EBITDA (3)", "divide", $ebitda_0, $ebitda_1, $ebitda_2, $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, $company->estadoIngresosOperacionales_2, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancierosCoface( "Quebranto Patrimonial (1)", "divide", $patrimonio_0, $patrimonio_1, $patrimonio_2, $company->patrimonioCapitalSocial_0, $company->patrimonioCapitalSocial_1, $company->patrimonioCapitalSocial_2, "percent", $customerProductId, $company->colpensionesType, 7) . "</tr>";

            echo indicadoresFinancierosCoface( "Rotación de Cartera (3)", "divide", $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, $company->estadoIngresosOperacionales_2, $company->activoClientes_0, $company->activoClientes_1, $company->activoClientes_2, NULL , $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancierosCoface( "Rotación de Inventario (3)", "divide", $company->estadoCostoDeVenta_0, $company->estadoCostoDeVenta_1, $company->estadoCostoDeVenta_2, $company->activoInventarios_0, $company->activoInventarios_1, $company->activoInventarios_2, NULL , $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancierosCoface( "Rotación de Activos (3)", "divide", $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, $company->estadoIngresosOperacionales_2, $activo_0, $activo_1, $activo_2, NULL , $customerProductId, $company->colpensionesType) . "</tr>";

        } else{
            // INDICADORES COLPENSIONES Y OTROS
            echo indicadoresFinancieros( "Razón Corriente (1, 2, 3)", "divide", $activoCorriente_0, $activoCorriente_1, $pasivoCorriente_0, $pasivoCorriente_1, NULL , $customerProductId, $company->colpensionesType, 1) . "</tr>";
            echo indicadoresFinancieros( "Prueba Ácida (2, 3)", "divide", ($activoCorriente_0 - $company->activoInventarios_0), ($activoCorriente_1 - $company->activoInventarios_1), $pasivoCorriente_0, $pasivoCorriente_1, NULL , $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Capital de Trabajo (3)", "subtract", $activoCorriente_0, $activoCorriente_1, $pasivoCorriente_0, $pasivoCorriente_1, "money" , $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Fondo de liquidez (1)", "divide", $cuentasDisponibles_0, $cuentasDisponibles_1, $depositosExigibles_0, $depositosExigibles_1, NULL , $customerProductId, $company->colpensionesType, 2) . "</tr>";
            echo indicadoresFinancieros( "Nivel de endeudamiento (1, 2, 3)", "divide", $pasivo_0, $pasivo_1, $activo_0, $activo_1, "percent" , $customerProductId, $company->colpensionesType, 6) . "</tr>";
            echo indicadoresFinancieros( "Leverage (2)", "divide", $pasivo_0, $pasivo_1, $patrimonio_0, $patrimonio_1, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Endeudamiento Financiero (3)", "divide", $ObligacionesFinancieras_0, $ObligacionesFinancieras_1,$pasivo_0, $pasivo_1, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Apalancamiento Corto Plazo (3)", "divide", $pasivoCorriente_0, $pasivoCorriente_1, $patrimonio_0, $patrimonio_1, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Apalancamiento Largo Plazo (3)", "divide", $pasivoNoCorriente_0, $pasivoNoCorriente_1, $patrimonio_0, $patrimonio_1, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Rentabilidad Operativa Activo (ROA) (1, 3)", "divide", $utilidadNeta_0, $utilidadNeta_1, $activo_0, $activo_1,  "percent", $customerProductId, $company->colpensionesType, 4) . "</tr>";
            echo indicadoresFinancieros( "Rentabilidad Patrimonio (ROE) (1, 3)", "divide", $utilidadNeta_0, $utilidadNeta_1, $patrimonio_0, $patrimonio_1 ,  "percent", $customerProductId, $company->colpensionesType, 5) . "</tr>";
            echo indicadoresFinancieros( "Cobertura de Gastos No Operacionales (3)", "divide", $utilidadOperacional_0, $utilidadOperacional_1, $company->estadoGastosNoOperacionales_0, $company->estadoGastosNoOperacionales_1 ,  "percent", $customerProductId, $company->colpensionesType, 5) . "</tr>";
            echo indicadoresFinancieros( "Margen Neto de Utilidad (1, 3)", "divide", $utilidadNeta_0, $utilidadNeta_1, $company->estadoIngresosOperacionales_0,$company->estadoIngresosOperacionales_1, "percent", $customerProductId, $company->colpensionesType, 3) . "</tr>";
            echo indicadoresFinancieros( "Margen Bruto de Utilidad (2, 3)", "divide", $utilidadBruta_0, $utilidadBruta_1, $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Margen EBITDA (3)", "divide", $ebitda_0, $ebitda_1, $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, "percent", $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Quebranto Patrimonial (1)", "divide", $patrimonio_0, $patrimonio_1, $company->patrimonioCapitalSocial_0, $company->patrimonioCapitalSocial_1, "percent", $customerProductId, $company->colpensionesType, 7) . "</tr>";
            // SE CONDICIONA PARA QUE LOS ANDES TOME  LOS DATOS EN DIAS Y EL RESTO LO SIGAN TOMANDO EN VECES
            if($customerid == 544){
                echo indicadoresFinancieros( "Rotación de Cartera (3)", "divide", $company->activoClientes_0 * 360, $company->activoClientes_1 * 360, $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, "days" , $customerProductId) . "</tr>";
                echo indicadoresFinancieros( "Rotación de Inventario (3)", "divide", $company->activoInventarios_0 * 360, $company->activoInventarios_1 * 360, $company->estadoCostoDeVenta_0, $company->estadoCostoDeVenta_1, "days" , $customerProductId) . "</tr>";
                echo indicadoresFinancieros( "Rotación de Activos (3)", "divide", $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, $activo_0, $activo_1, NULL , $customerProductId, $company->colpensionesType) . "</tr>";
            }else{

            echo indicadoresFinancieros( "Rotación de Cartera (3)", "divide", $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, $company->activoClientes_0, $company->activoClientes_1, NULL , $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Rotación de Inventario (3)", "divide", $company->estadoCostoDeVenta_0, $company->estadoCostoDeVenta_1, $company->activoInventarios_0, $company->activoInventarios_1, NULL , $customerProductId, $company->colpensionesType) . "</tr>";
            echo indicadoresFinancieros( "Rotación de Activos (3)", "divide", $company->estadoIngresosOperacionales_0, $company->estadoIngresosOperacionales_1, $activo_0, $activo_1, NULL , $customerProductId, $company->colpensionesType) . "</tr>";
              }

            if ($customerProductId == 2698){
                $capitalDeTrabajo_0 =  $activoCorriente_0 - $pasivoCorriente_0;
                $capitalDeTrabajo_1 =  $activoCorriente_1 - $pasivoCorriente_1;
                $varCapitalTrabajo  = divideNumbers($capitalDeTrabajo_0, $capitalDeTrabajo_1)-1;

                echo "<tr>
                    <th>
                        <b>Var. Capital de Trabajo (3)</b>
                    </th>
                    <td class='align_right' colspan='3'>". $varCapitalTrabajo. "</td>
                 
                </tr>";
            }


        }

        // Creado por Jonathan

    if($customerid == 502) {

        $razoncorriente_0=divideNumbers($activoCorriente_0,$pasivoCorriente_0);
        $razoncorriente_1=divideNumbers($activoCorriente_1,$pasivoCorriente_1);


        if($razoncorriente_0 >=1){

            $razoncorr_0="Cumple";
            }

            else{
                $razoncorr_0="No Cumple";

            }

        if($razoncorriente_1 >=1){

            $razoncorr_1="Cumple";
        }

        else{
            $razoncorr_1="No Cumple";

        }

        $pruebaAcida_0 = divideNumbers( ($activoCorriente_0 - $company->activoInventarios_0) , $pasivoCorriente_0);
        $pruebaAcida_1 = divideNumbers( ($activoCorriente_1 - $company->activoInventarios_1) , $pasivoCorriente_1);

        if($pruebaAcida_0 >=1.1 ){

            $PruebaAci_0="Cumple";
        }

        else{
            $PruebaAci_0="No Cumple";

        }

        if($pruebaAcida_1 >=1){

            $PruebaAci_1="Cumple";
        }

        else{
            $PruebaAci_1="No Cumple";

        }

        $nivelDeEndeudamiento_0 = divideNumbers( $pasivo_0 , $activo_0) * 100 ;
        $nivelDeEndeudamiento_1 = divideNumbers( $pasivo_1 , $activo_1) * 100;
       // $nvendFloat_0 = (float)$nivelDeEndeudamiento_0;
       // $nvendFloat_1 = (float)$nivelDeEndeudamiento_1;

        if($nivelDeEndeudamiento_0 < 60.0 ){

            $niveldeendeuda_0="Cumple";
        }

        else{
            $niveldeendeuda_0="No Cumple";

        }

        if($nivelDeEndeudamiento_1 < 60.0){

            $niveldeendeuda_1="Cumple";
        }

        else{
            $niveldeendeuda_1="No Cumple";

        }

        $capitalDeTrabajo_0 =  $activoCorriente_0 - $pasivoCorriente_0;
        $capitalDeTrabajo_1 =  $activoCorriente_1 - $pasivoCorriente_1;


        if($capitalDeTrabajo_0 >0 ){

            $Capitaltrab_0="Cumple";
        }

        else{
            $Capitaltrab_0="No Cumple";

        }

        if($capitalDeTrabajo_1 >0){

            $Capitaltrab_1="Cumple";
        }

        else{
            $Capitaltrab_1="No Cumple";

        }

        $margenEBITDA_0 = divideNumbers($ebitda_0, $company->estadoIngresosOperacionales_0);
        $margenEBITDA_1 = divideNumbers($ebitda_1, $company->estadoIngresosOperacionales_1);

        if($margenEBITDA_0 >= 0.16 ){

            $Mebitda_0="Cumple";
        }

        else{
            $Mebitda_0="No Cumple";

        }

        if($margenEBITDA_1 >= 0.16){

            $Mebitda_1="Cumple";
        }

        else{
            $Mebitda_1="No Cumple";

        }


        $rentabilidadPatrimonioROE_0 = divideNumbers($utilidadNeta_0, $patrimonio_0) * 100;
        $rentabilidadPatrimonioROE_1 = divideNumbers($utilidadNeta_1, $patrimonio_1) * 100;


        if($rentabilidadPatrimonioROE_0 >=1 ){

            $Rentabilidadpatrimon_0="Cumple";
        }

        else{
            $Rentabilidadpatrimon_0="No Cumple";

        }

        if($rentabilidadPatrimonioROE_1 >=1){

            $Rentabilidadpatrimon_1="Cumple";
        }

        else{
            $Rentabilidadpatrimon_1="No Cumple";

        }


        echo "<th style=\"color: #ffffff !important; font-size: large !important; background: green;\" width=\"350px\">CALIFICACIÓN VANTI</th>";
        echo "<td> <b> CALIFICACIÓN DE VANTI " . $company->dateLastBalanceSheet . "</td>";
        echo "<td> <b> CALIFICACIÓN DE VANTI " . $company->dateLastBalanceSheet_1 . "</td>";

        echo "<tr>";
        echo "<th><b>Razon Corriente</th>";
        echo "<td> " . $razoncorr_0 . "</td>";
        echo "<td> " . $razoncorr_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Prueba Acida</th>";
        echo "<td> " . $PruebaAci_0 . "</td>";
        echo "<td> " . $PruebaAci_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Capital de Trabajo</th>";
        echo "<td> " . $Capitaltrab_0 . "</td>";
        echo "<td> " . $Capitaltrab_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Nivel de Endeudamiento</th>";
        echo "<td> " . $niveldeendeuda_0 . "</td>";
        echo "<td> " . $niveldeendeuda_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Margen EBITDA</th>";
        echo "<td> " . $Mebitda_0 . "</td>";
        echo "<td> " . $Mebitda_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Rentabilidad del Patrimonio</th>";
        echo "<td> " . $Rentabilidadpatrimon_0 . "</td>";
        echo "<td> " . $Rentabilidadpatrimon_1 . "</td>";
        echo "</tr>";


    }

    if($customerid == 648) {

        $razoncorriente_0=divideNumbers($activoCorriente_0,$pasivoCorriente_0);
        $razoncorriente_1=divideNumbers($activoCorriente_1,$pasivoCorriente_1);
        if($razoncorriente_0 >=1.3){
            $razoncorr_0="Sin Hallazgo";
        } elseif ($razoncorriente_0 >=1 && $razoncorriente_0 < 1.3 ){
            $razoncorr_0="Hallazgo Menor";
        } else{
            $razoncorr_0="Con Hallazgo";
        }
        if($razoncorriente_1 >=1.3){
            $razoncorr_1="Sin Hallazgo";
        } elseif ($razoncorriente_1 >=1 && $razoncorriente_1 < 1.3 ){
            $razoncorr_1="Hallazgo Menor";
        } else{
            $razoncorr_1="Con Hallazgo";
        }
        $pruebaAcida_0 = divideNumbers( ($activoCorriente_0 - $company->activoInventarios_0) , $pasivoCorriente_0);
        $pruebaAcida_1 = divideNumbers( ($activoCorriente_1 - $company->activoInventarios_1) , $pasivoCorriente_1);
        if($pruebaAcida_0 >=1 ){
            $PruebaAci_0="Sin Hallazgo";
        } elseif($pruebaAcida_0 >0 && $pruebaAcida_0 <1  ){
            $PruebaAci_0="Hallazgo Menor";
        } else{
            $PruebaAci_0="Con Hallazgo";
        }
        if($pruebaAcida_1 >=1 ){
            $PruebaAci_1="Sin Hallazgo";
        } elseif($pruebaAcida_1 >0 && $pruebaAcida_1 <1  ){
            $PruebaAci_1="Hallazgo Menor";
        } else{
            $PruebaAci_1="Con Hallazgo";
        }
        $capitalDeTrabajo_0 =  $activoCorriente_0 - $pasivoCorriente_0;
        $capitalDeTrabajo_1 =  $activoCorriente_1 - $pasivoCorriente_1;
        if($capitalDeTrabajo_0 >0 ){
            $Capitaltrab_0="Sin Hallazgo";
        } else{
            $Capitaltrab_0="Con Hallazgo";
        }
        if($capitalDeTrabajo_1 >0){
            $Capitaltrab_1="Sin Hallazgo";
        } else{
            $Capitaltrab_1="Con Hallazgo";
        }
        $nivelDeEndeudamiento_0 = divideNumbers( $pasivo_0 , $activo_0) * 100;
        $nivelDeEndeudamiento_1 = divideNumbers( $pasivo_1 , $activo_1) * 100;
        if($nivelDeEndeudamiento_0 <= 50.0 ){
            $niveldeendeuda_0="Sin Hallazgo";
        } elseif($nivelDeEndeudamiento_0 >50.0 && $nivelDeEndeudamiento_0 <= 60.0){
            $niveldeendeuda_0="Hallazgo Menor";
        } else{
            $niveldeendeuda_0="Con Hallazgo";
        }
        if($nivelDeEndeudamiento_1 <= 50.0 ){
            $niveldeendeuda_1="Sin Hallazgo";
        } elseif($nivelDeEndeudamiento_1 >50.0 && $nivelDeEndeudamiento_1 <= 60.0){
            $niveldeendeuda_1="Hallazgo Menor";
        } else{
            $niveldeendeuda_1="Con Hallazgo";
        }

        $EndeudamientoFinanciero_0 = divideNumbers($ObligacionesFinancieras_0, $company->estadoIngresosOperacionales_0 ) * 100;
        $EndeudamientoFinanciero_1 = divideNumbers($ObligacionesFinancieras_1, $company->estadoIngresosOperacionales_1 ) * 100;
        if($EndeudamientoFinanciero_0 <=50.0){
            $endfinancia_0='Sin Hallazgo';
        } elseif ($EndeudamientoFinanciero_0 >50.0 && $EndeudamientoFinanciero_0 <=60.0){
            $endfinancia_0='Hallazgo Menor';
        } else{
            $endfinancia_0='Con Hallazgo';
        }
        if($EndeudamientoFinanciero_1 <=50.0){
            $endfinancia_1='Sin Hallazgo';
        } elseif ($EndeudamientoFinanciero_1 >50.0 && $EndeudamientoFinanciero_1 <=60.0){
            $endfinancia_1='Hallazgo Menor';
        } else{
            $endfinancia_1='Con Hallazgo';
        }
        $apalancamientoCortPlazo_0 = divideNumbers($pasivoCorriente_0, $patrimonio_0) * 100;
        $apalancamientoCortPlazo_1 = divideNumbers($pasivoCorriente_1, $patrimonio_1) * 100;
        if($apalancamientoCortPlazo_0 >=40.0){
            $apalcortplazo_0 = 'Sin Hallazgo';
        } elseif ($apalancamientoCortPlazo_0 >=20.0 && $apalancamientoCortPlazo_0 <40.0){
            $apalcortplazo_0 = 'Hallazgo Menor';
        } else{
            $apalcortplazo_0 = 'Con Hallazgo';
        }
        if($apalancamientoCortPlazo_1 >=40.0){
            $apalcortplazo_1 = 'Sin Hallazgo';
        } elseif ($apalancamientoCortPlazo_1 >=20.0 && $apalancamientoCortPlazo_1 <40.0){
            $apalcortplazo_1 = 'Hallazgo Menor';
        } else{
            $apalcortplazo_1 = 'Con Hallazgo';
        }
        $margenEBITDA_0 = divideNumbers($ebitda_0, $company->estadoIngresosOperacionales_0);
        $margenEBITDA_1 = divideNumbers($ebitda_1, $company->estadoIngresosOperacionales_1);
        if($margenEBITDA_0 >0 ){
            $Mebitda_0="Sin hallazgo";
        } else{
            $Mebitda_0="Con hallazgo";
        }
        if($margenEBITDA_1 >0){
            $Mebitda_1="Sin hallazgo";
        } else{
            $Mebitda_1="Con hallazgo";
        }
        $rentabilidadOperativaROA_0 = divideNumbers($utilidadNeta_0, $activo_0) * 100;
        $rentabilidadOperativaROA_1 = divideNumbers($utilidadNeta_1, $activo_1) * 100;
        if($rentabilidadOperativaROA_0 >=05.0){
            $rentoperROA_0 = 'Sin Hallazgo';
        } elseif ($rentabilidadOperativaROA_0 >=0 && $rentabilidadOperativaROA_0 <05.0){
            $rentoperROA_0 = 'Hallazgo Menor';
        } else{
            $rentoperROA_0 = 'Con Hallazgo';
        }
        if($rentabilidadOperativaROA_1 >=05.0){
            $rentoperROA_1 = 'Sin Hallazgo';
        } elseif ($rentabilidadOperativaROA_1 >=0 && $rentabilidadOperativaROA_1 <05.0){
            $rentoperROA_1 = 'Hallazgo Menor';
        } else{
            $rentoperROA_1 = 'Con Hallazgo';
        }
        $rentabilidadPatrimonioROE_0 = divideNumbers($utilidadNeta_0, $patrimonio_0) * 100;
        $rentabilidadPatrimonioROE_1 = divideNumbers($utilidadNeta_1, $patrimonio_1) * 100;
        if($rentabilidadPatrimonioROE_0 >=05.0){
            $Rentabilidadpatrimon_0 = 'Sin Hallazgo';
        } elseif ($rentabilidadPatrimonioROE_0 >=0 && $rentabilidadPatrimonioROE_0 <05.0){
            $Rentabilidadpatrimon_0 = 'Hallazgo Menor';
        } else{
            $Rentabilidadpatrimon_0 = 'Con Hallazgo';
        }
        if($rentabilidadPatrimonioROE_1 >=05.0){
            $Rentabilidadpatrimon_1 = 'Sin Hallazgo';
        } elseif ($rentabilidadPatrimonioROE_1 >=0 && $rentabilidadPatrimonioROE_1 <05.0){
            $Rentabilidadpatrimon_1 = 'Hallazgo Menor';
        } else{
            $Rentabilidadpatrimon_1 = 'Con Hallazgo';
        }
        $MargeNetoUtilidad_0 = divideNumbers($utilidadNeta_0, $company->estadoIngresosOperacionales_0) * 100;
        $MargeNetoUtilidad_1 = divideNumbers($utilidadNeta_1, $company->estadoIngresosOperacionales_1) * 100;
        if($MargeNetoUtilidad_0 >=20.0){
            $margnetutilidad_0 = 'Sin Hallazgo';
        } elseif ($MargeNetoUtilidad_0 >=0 && $MargeNetoUtilidad_0 <20.0){
            $margnetutilidad_0 = 'Hallazgo Menor';
        } else{
            $margnetutilidad_0 = 'Con Hallazgo';
        }
        if($MargeNetoUtilidad_1 >=20.0){
            $margnetutilidad_1 = 'Sin Hallazgo';
        } elseif ($MargeNetoUtilidad_1 >=0 && $MargeNetoUtilidad_1 <20.0){
            $margnetutilidad_1 = 'Hallazgo Menor';
        } else{
            $margnetutilidad_1 = 'Con Hallazgo';
        }
        $MargeBrutoUtilidad_0 = divideNumbers($utilidadBruta_0, $company->estadoIngresosOperacionales_0) * 100;
        $MargeBrutoUtilidad_1 = divideNumbers($utilidadBruta_1, $company->estadoIngresosOperacionales_1) * 100;
        if($MargeBrutoUtilidad_0 >=20.0){
            $margbrutoutilidad_0 = 'Sin Hallazgo';
        } elseif ($MargeBrutoUtilidad_0 >=0 && $MargeBrutoUtilidad_0 <20.0){
            $margbrutoutilidad_0 = 'Hallazgo Menor';
        } else{
            $margbrutoutilidad_0 = 'Con Hallazgo';
        }
        if($MargeBrutoUtilidad_1 >=20.0){
            $margbrutoutilidad_1 = 'Sin Hallazgo';
        } elseif ($MargeBrutoUtilidad_1 >=0 && $MargeBrutoUtilidad_1 <20.0){
            $margbrutoutilidad_1 = 'Hallazgo Menor';
        } else{
            $margbrutoutilidad_1 = 'Con Hallazgo';
        }
        $RotacionCartera_0 = divideNumbers($company->activoClientes_0 * 360, $company->estadoIngresosOperacionales_0);
        $RotacionCartera_1 = divideNumbers($company->activoClientes_1 * 360, $company->estadoIngresosOperacionales_1);
        if($RotacionCartera_0 <=30){
            $rotcartera_0 = 'Sin Hallazgo';
        } elseif ($RotacionCartera_0 >30 && $RotacionCartera_0 <60){
            $rotcartera_0 = 'Hallazgo Menor';
        } else{
            $rotcartera_0 = 'Con Hallazgo';
        }
        if($RotacionCartera_1 <=30){
            $rotcartera_1 = 'Sin Hallazgo';
        } elseif ($RotacionCartera_1 >30 && $RotacionCartera_1 <60){
            $rotcartera_1 = 'Hallazgo Menor';
        } else{
            $rotcartera_1 = 'Con Hallazgo';
        }


        echo "<th style=\"color: #ffffff !important; font-size: large !important; background: green;\" width=\"350px\">CALIFICACIÓN RCN</th>";
        echo "<td> <b> CALIFICACIÓN DE RCN " . $company->dateLastBalanceSheet . "</td>";
        echo "<td> <b> CALIFICACIÓN DE RCN " . $company->dateLastBalanceSheet_1 . "</td>";

        echo "<tr>";
        echo "<th><b>Razon Corriente</th>";
        echo "<td> " . $razoncorr_0 . "</td>";
        echo "<td> " . $razoncorr_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Prueba Acida</th>";
        echo "<td> " . $PruebaAci_0 . "</td>";
        echo "<td> " . $PruebaAci_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Capital de Trabajo</th>";
        echo "<td> " . $Capitaltrab_0 . "</td>";
        echo "<td> " . $Capitaltrab_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Nivel de Endeudamiento</th>";
        echo "<td> " . $niveldeendeuda_0 . "</td>";
        echo "<td> " . $niveldeendeuda_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Endeudamiento Financiero</th>";
        echo "<td> " . $endfinancia_0 . "</td>";
        echo "<td> " . $endfinancia_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Apalancamiento a corto plazo</th>";
        echo "<td> " . $apalcortplazo_0 . "</td>";
        echo "<td> " . $apalcortplazo_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Margen EBITDA</th>";
        echo "<td> " . $Mebitda_0 . "</td>";
        echo "<td> " . $Mebitda_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Rentabilidad Operativa Activo(ROA)</th>";
        echo "<td> " . $rentoperROA_0 . "</td>";
        echo "<td> " . $rentoperROA_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Rentabilidad del Patrimonio(ROE)</th>";
        echo "<td> " . $Rentabilidadpatrimon_0 . "</td>";
        echo "<td> " . $Rentabilidadpatrimon_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Margen Neto de Utilidad</th>";
        echo "<td> " . $margnetutilidad_0 . "</td>";
        echo "<td> " . $margnetutilidad_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Margen Bruto de Utilidad</th>";
        echo "<td> " . $margbrutoutilidad_0 . "</td>";
        echo "<td> " . $margbrutoutilidad_1 . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th><b>Rotación de cartera</th>";
        echo "<td> " . $rotcartera_0 . "</td>";
        echo "<td> " . $rotcartera_1 . "</td>";
        echo "</tr>";
    }


    // Creado por Jonathan
    ?>




</table>
<?php if( $customerProductId == "2697"):?>
<table>
    <tr>
        <th width="300px">
            <h3>Capacidad de Contratación</h3>
        </th>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                '[' . $verificationSection->id . ']' .
                '[_details]' .
                '[' . $company->id . '][kContratacion]', $company->kContratacion, array('rows' => 1, 'cols' => 50));
                ?>
        </td>
    </tr>
    <tr>
        <th>
            <h3>Capacidad de Ejecución</h3>
        </th>
        <td>
            <?php
                echo CHtml::textField('verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . $company->id . '][kEjecucion]', $company->kEjecucion, array('rows' => 1, 'cols' => 50));
            ?>
        </td>
       
    </tr>
</table>
    <?php endif;?>

<table>
    <tr>
        <td><?php echo CHtml::activeLabel($company, 'verificationResultId'); ?></td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'verificationSection' .
                    '[' . $verificationSection->id . ']' .
                    '[_details]' .
                    '[' . ($company->isNewRecord ? 'new' : $company->id) . '][verificationResultId]'
                    , //
                    $company->verificationResultId, //
                    CHtml::listData(
                            VerificationResult::model()->findAll(), //
                            'id', //
                            'name'));
            ?>
        </td>
    </tr>
</table>
