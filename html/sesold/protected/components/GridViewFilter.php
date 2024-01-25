<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GridViewFilter
 *
 * @author hzubieta
 */
class GridViewFilter {

    const SESSION_NAME = 'GVFilter';

    static public function getNullArray() {
        return array(SVPActiveRecord::NULL_VALUE => '[NA]');
    }
    
    static public function getClearButton($route){
        return CHtml::link('Quitar Filtros', Yii::app()->createUrl($route, array('clearFilter' => 1)));
    }

    //put your code here
    static public function getFilter($className, $scenario, $action = NULL) {
        $seedController = GridViewFilter::getSeedController($scenario,$action);
        $ans = Yii::app()->user->getState($seedController, null);
        if ($ans == null || (int) Yii::app()->request->getParam('clearFilter', 0) == 1) {
            $ans = new $className($scenario);
            $ans->unsetAttributes();  // clear any default values
        }
        return $ans;
    }

    //put your code here
    static public function getPage($scenario) {
        $page = (int) Yii::app()->user->getState(GridViewFilter::getSeedControllerPage($scenario));
        return ($page );
    }

    static public function setFilter($obj, $scenario) {

        Yii::app()->user->setState(GridViewFilter::getSeedController($scenario), $obj);
        $page = Yii::app()->request->getParam(get_class($obj) . '_page', null);
        if ($page != null) {
            $page = (int) $page - 1;
        } else if (Yii::app()->request->getParam('ajax', null)) {
            $page = 0;
        } else {
            $page = GridViewFilter::getPage($scenario);
        }

        Yii::app()->user->setState(GridViewFilter::getSeedControllerPage($scenario), $page);
    }

    static public function getSeedController($scenario, $action = NULL) {
        if (empty($action))
            $action = Yii::app()->controller->action->id;
        return (GridViewFilter::SESSION_NAME . $scenario . '__' . Yii::app()->controller->id . '_' . $action );
    }

    static public function getSeedControllerPage($scenario, $action = NULL) {
        if (empty($action))
            $action = Yii::app()->controller->action->id;
        return (GridViewFilter::SESSION_NAME . $scenario . '_Page_' . Yii::app()->controller->id . '_' . $action);
    }

}
