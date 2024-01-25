<?php
/**
 * Description of ActiveRecord
 *
 * @author hsugieta
 */
class ActiveRecord extends CActiveRecord {

    //put your code here
    public function getCanBeDeleted() {
        $ans = true;
        foreach ($this->relations() as $relationName => $relation) {
            if (($relation[0] == self::HAS_MANY || $relation[0] == self::MANY_MANY) && $this->$relationName && count($this->$relationName) > 0) {
                $ans = false;
                break;
            }
        }
        return $ans;
    }

    public function behaviors() {
        return array(
            'AutoTimestampBehavior' => array(
                'class' => 'application.components.AutoTimestampBehavior',
            ),
        );
    }

}