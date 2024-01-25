<?php
    function percentNumber($a){
        $ans = number_format(($a * 100), 2) . '%';
        return $ans;
    }
    function varCuentas( $var_0, $var_1){
        $varInt = $var_0 - $var_1;
        if ($var_1 != 0) {
            $varPercent = percentNumber( $varInt /  $var_1);
            $ans = $varPercent;
        } else {
            $ans = "";
        }
        return $ans;
    };
    function divideNumbers($a, $b){
        if ($a != 0 && $b != 0) {
            $ans = $a / $b;
        } else {
            $ans = '0';
        }
        return $ans;
    }
    function pondCalc($query, $points = 0, $value = 0, $weight = 0){
        $obtValue = divideNumbers($points, $value);
        $obtWeight =  divideNumbers(($obtValue * $weight),100);
        if ($query == "peso") {
            $ans = percentNumber($obtWeight);
        } else {
            $ans = $obtValue;
        }
        return $ans;
    };
    function valCalc($query, $points = 0, $questionValue = 0, $value = 0, $weight = 0){
        $obtValue = divideNumbers($points, $questionValue);
        $questionWeight = divideNumbers($questionValue, $value)*$weight;
        $obtWeight =  divideNumbers(($obtValue * $questionWeight),100);
        if ($query == "peso") {
            $ans = percentNumber($obtWeight);
        } else {
            $ans = percentNumber($obtValue);
        }
        return $ans;
    };