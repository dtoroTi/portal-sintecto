<?php

class RSiteController extends CController {

    public $defaultAction = "error";
    
    private $validIp=array(
        '192.168.0.200'=>true,
    );

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        $permit=Yii::app()->params['webServicePermit'];
        if (!isset($this->validIp[$_SERVER['REMOTE_ADDR']])){
            $permit='deny';
        }
        return array(
            array(
                'deny',
//                $permit,
                'users' => array('*'),
            ),
        );
    }

    public function actions() {
        return array(
            'quote' => array(
                'class' => 'CWebServiceAction',
            ),
        );
    }

    /**
     * @param string the symbol of the stock
     * @return string the stock price
     * @soap
     */
    public function getPrice($symbol) {
        return $_SERVER['REMOTE_ADDR'];
    }

}
