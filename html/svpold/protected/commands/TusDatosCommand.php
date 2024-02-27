<?php
//require_once(dirname(__FILE__) .'/../../../../conf/conf.php');
//require_once(dirname(__FILE__) .'/../config/main.php');

// change the following paths if necessary
//$yii = dirname(__FILE__) . '/../yii1/framework/yii.php';
//$config = dirname(__FILE__) . '/protected/config/main.php';

/**
 * Clase TusDatosCommand
 * 
 * Este comando se encarga de ejecutar la obtención de datos pendientes utilizando la clase TusDatos.
 */
class TusDatosCommand extends CConsoleCommand {

    /**
     * Ejecuta la obtención de datos pendientes.
     *
     * @param array $args Argumentos pasados al comando.
     */
    public function run($args) {
        // Importa las clases necesarias.
        Yii::import('application.models.*');
        Yii::import('application.models.basic.*');
        Yii::import('application.controllers.*');
        Yii::import('application.components.*');
        Yii::import('application.extensions.TusDatos.*');

        // Crea una instancia de la clase TusDatos y obtiene los datos pendientes.
        $tusDatos = new TusDatos();
        $tusDatos->getTusDatosPending();
    }

    /**
     * Obtiene el mensaje de ayuda para el comando tusDatos.
     *
     * @return string El mensaje de ayuda.
     */
    public function getHelp() {
        return "Usage: tusDatos";
    }

    /**
     * Obtiene el nombre del comando tusDatos.
     *
     * @return string El nombre del comando.
     */
    public function getName() {
        return "tusDatos";
    }

}
