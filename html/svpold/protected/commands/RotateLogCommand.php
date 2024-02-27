<?php

/**
 * Clase RotateLogCommand
 * 
 * Este comando se encarga de rotar los registros de log.
 */
class RotateLogCommand extends CConsoleCommand {

    /**
     * Ejecuta la rotación de registros de log.
     *
     * @param array $args Argumentos pasados al comando.
     */
    public function run($args) {
        // Importa las clases necesarias.
        Yii::import('application.models.*');
        Yii::import('application.models.basic.*');
        Yii::import('application.controllers.*');
        Yii::import('application.components.*');

        // Obtiene la fecha actual en la zona horaria 'America/Bogota'.
        $date = new DateTime('now', timezone_open('America/Bogota'));

        // Se mantiene solo 15 días de registros de log.
        $date->sub(new DateInterval('P30D'));

        // Obtiene la fecha hasta la cual se conservarán los registros.
        $until = $date->format('Y-m-d');

        // Crea la consulta SQL para insertar registros antiguos en la tabla OldLog.
        $sql = "insert {{OldLog}} select * from {{Log}} l where l.created <'{$until}'";

        // Ejecuta la consulta SQL.
        $ans = Yii::app()->db->createCommand($sql)->execute();

        // Si se insertaron registros antiguos correctamente.
        if ($ans>0) {
            print "inserted {$ans} rows\n";

            // Elimina los registros antiguos de la tabla Log.
            $sql = "delete from {{Log}} where created <'{$until}'";
            $ans = Yii::app()->db->createCommand($sql)->execute();
            print "deleted {$ans} rows\n";
        }
    }

    /**
     * Obtiene el mensaje de ayuda para el comando rotateLog.
     *
     * @return string El mensaje de ayuda.
     */
    public function getHelp() {
        return "Usage: \rotateLog";
    }

    /**
     * Obtiene el nombre del comando rotateLog.
     *
     * @return string El nombre del comando.
     */
    public function getName() {
        return "rotateLog";
    }

}
