<?php

class DumpDataCommand extends CConsoleCommand {

  public function run() {
    Yii::import('application.models.*');
    Yii::import('application.models.basic.*');
    Yii::import('application.data.*');
    $this->truncateTables();
    $data = InitialData::getData();
    print ("\n\n Adding Initial Data\n\n");
    $this->addData($data);
    $data = TestData::getData();
    print ("\n\n Adding TEST Data\n\n");
    $this->addData($data);
  }

  public function addData($data) {
    foreach ($data as $rows) {
      $table = $rows['table'];
      print ("Adding " . (count($rows) -1). " rows to {$table}\n");
      foreach ($rows as $rowNo => $row) {
        if (is_int($rowNo)) {
          print ("     Adding Row {$rowNo} \n");
          foreach ($row as $attr => $val) {
            if (is_array($val)) {

              // is Reference
              $models = array_keys($val);
              $modelName = $models[0];
              $model = new $modelName();
              $reference = $model->findByAttributes($val[$modelName]);
              $row[$attr] = $reference->primaryKey;
            } else {
              
            }
          }
          $record = new $table();
          $record->attributes = $row;
          if (isset($row['id'])) {
            $record->id = $row['id'];
          }
          if (!$record->save()) {
            print("Error: \n");
            print_r($record->errors);
            print("\n");
            throw new Exception('Error saving the record.');
          }
        }
      }
    }
  }

  public function getHelp() {
    return "Usage: \ndumpData \n";
  }

  public function getName() {
    return "dumpData";
  }

  public function truncateTables() {
//        $schema = $args[0];
    $tables = Yii::app()->db->schema->getTables();
    $result = array();
    foreach ($tables as $def) {
      if ($def->name != 'tbl_migration') {
        $createString = "\$this->createTable(\"{$def->name}\", array(\n";
        foreach ($def->columns as $col) {
          $createString .= "    \"{$col->name}\"=>\"{$this->getColType($col)}\",\n";
        }
        $createString .= "), \"ENGINE=InnoDB\");\n\n";

        $dependencies = array();
        foreach ($def->foreignKeys as $key => $foreignKey) {
          $dependencies[] = $foreignKey[0];
          $createString .= "\$this->addForeignKey(" .
                  "\"{$def->name}_{$foreignKey[0]}\",\"{$def->name}\",\"{$key}\"," .
                  "\"{$foreignKey[0]}\",\"{$foreignKey[0]}\");\n\n";
        }
        $unsortedTables[$def->name]['createString'] = $createString;
        $unsortedTables[$def->name]['dependencies'] = $dependencies;
      }
    }
// Sort
    $sortedTables = array();
    $loop = false;
    while ((count($unsortedTables) > 0) && !$loop) {
      $loop = true;
      $tablesLeft = array_keys($unsortedTables);
      foreach ($tablesLeft as $tableName) {
        $moveTable = true;
        foreach ($unsortedTables[$tableName]['dependencies'] as $dependency) {
// Review if the dependencies are not itself and are not included in sortedTables
          if (($dependency != $tableName) && !isset($sortedTables[$dependency])) {

            $moveTable = false;
          }
        }
        if ($moveTable) {
          $sortedTables[$tableName] = $unsortedTables[$tableName];
          unset($unsortedTables[$tableName]);
          $loop = false;
        }
      }
    }

    if ($loop) {
      print("There is a loop in the creation string " . count($unsortedTables) . " s=" . count($sortedTables));
      return false;
    }

    $createString = '';
    $dropString = '';
    $tropTables = array();
    foreach ($sortedTables as $tableName => $table) {
      $createString.=$table['createString'];
      $dropString = "\$this->dropTable('{$tableName}');\n" . $dropString;
      $dropTables[] = $tableName;
    }
    print "\n\n";
    for ($i = (count($dropTables) - 1); $i >= 0; $i--) {
      $tableName = substr($dropTables[$i], 4);
      echo "Deleting {$tableName} \n";
      $model = new $tableName;
      $model->deleteAll();
//      $user = Yii::app()->db->createCommand()
//              ->truncateTable($dropTables[$i]);
    }
//    echo $createString . "\n\n" . $dropString;
  }

  public function schema() {
//        $schema = $args[0];
    $tables = Yii::app()->db->schema->getTables();
    $result = array();
    $unsortedTables=array();
    foreach ($tables as $def) {
      if ($def->name != 'tbl_migration') {
        $createString = "\$this->createTable(\"{$def->name}\", array(\n";
        foreach ($def->columns as $col) {
          $createString .= "    \"{$col->name}\"=>\"{$this->getColType($col)}\",\n";
        }
        $createString .= "), \"ENGINE=InnoDB\");\n\n";

        $dependencies = array();
        foreach ($def->foreignKeys as $key => $foreignKey) {
          $dependencies[] = $foreignKey[0];
          $createString .= "\$this->addForeignKey(" .
                  "\"{$def->name}_{$foreignKey[0]}\",\"{$def->name}\",\"{$key}\"," .
                  "\"{$foreignKey[0]}\",\"{$foreignKey[0]}\");\n\n";
        }
        $unsortedTables[$def->name]['createString'] = $createString;
        $unsortedTables[$def->name]['dependencies'] = $dependencies;
      }
    }
// Sort
    $sortedTables = array();
    $loop = false;
    while ((count($unsortedTables) > 0) && !$loop) {
      $loop = true;
      $tablesLeft = array_keys($unsortedTables);
      foreach ($tablesLeft as $tableName) {
        $moveTable = true;
        foreach ($unsortedTables[$tableName]['dependencies'] as $dependency) {
// Review if the dependencies are not itself and are not included in sortedTables
          if (($dependency != $tableName) && !isset($sortedTables[$dependency])) {

            $moveTable = false;
          }
        }
        if ($moveTable) {
          $sortedTables[$tableName] = $unsortedTables[$tableName];
          unset($unsortedTables[$tableName]);
          $loop = false;
        }
      }
    }

    if ($loop) {
      print("There is a loop in the creation string " . count($unsortedTables) . " s=" . count($sortedTables));
    }

    $createString = '';
    $dropString = '';
    foreach ($sortedTables as $tableName => $table) {
      $createString.=$table['createString'];
      $dropString = "\$this->dropTable('{$tableName}');\n" . $dropString;
    }
    echo $createString . "\n\n" . $dropString;
  }

  public function getColType($col) {
    if ($col->isPrimaryKey) {
      return "pk";
    }
    $result = $col->dbType;
    if (!$col->allowNull) {
      $result .= ' NOT NULL';
    }
    if ($col->defaultValue != null) {
      $result .= " DEFAULT '{$col->defaultValue}'";
    }
    return $result;
  }

}