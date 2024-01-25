<?php

class SVPActiveRecord extends CActiveRecord {
  
  const NULL_VALUE = '__NULL__';

  public function beforeDelete() {
    $ans = true;

    foreach ($this->relations() as $relationName => $relation) {
      if ($ans && $relation[0] == self::HAS_MANY) {
        $records = $this->$relationName;
        foreach ($records as $record) {
          $ans = $record->delete();
          if (!$ans) {
            break;
          }
        }
      }
      if ($ans && $relation[0] == self::HAS_ONE) {
        $record = $this->$relationName;
        if ($record) {
          $ans = $record->delete();
          if (!$ans) {
            break;
          }
        }
      }
      if (!$ans) {
        break;
      }
    }

    return $ans;
  }
  
}