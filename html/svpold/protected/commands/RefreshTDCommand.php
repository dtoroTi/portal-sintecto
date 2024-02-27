<?php
//require_once(dirname(__FILE__) .'/../../../../conf/conf.php');
//require_once(dirname(__FILE__) .'/../config/main.php');

// change the following paths if necessary
//$yii = dirname(__FILE__) . '/../yii1/framework/yii.php';
//$config = dirname(__FILE__) . '/protected/config/main.php';

/**
 * Clase RefreshTDCommand
 * 
 * Este comando maneja la actualización de los datos de TusDatos.
 */
class RefreshTDCommand extends CConsoleCommand { //refreshTD

    /**
     * Ejecuta la actualización de los datos de TusDatos.
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

        // Instancia y ejecuta la actualización de TusDatos.
        $tusDatos = new RefreshTD();
        $tusDatos->getTusDatosRefresh();
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
