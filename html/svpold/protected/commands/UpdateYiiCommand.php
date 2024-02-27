<?php

/**
 * Clase UpdateYiiCommand
 * 
 * Este comando se utiliza para actualizar la versión de Yii en un servidor local o remoto.
 */
class UpdateYiiCommand extends CConsoleCommand {

    /**
     * Realiza la actualización de Yii en un servidor local.
     *
     * @param string $tag La etiqueta de la versión de Yii a descargar.
     */
    private function localUpdate($tag) {
        // Obtiene la configuración del servidor local.
        $serverName = Yii::app()->params['serverName'];
        $userPath = Yii::app()->params['server'][$serverName]['userPath'];
        $fullBasePath = $userPath . Yii::app()->params['server'][$serverName]['basePath'];
        $yiiPath = $userPath . Yii::app()->params['server'][$serverName]['yiiPath'];
        $yiifwPath = $userPath . Yii::app()->params['server'][$serverName]['yiifwPath']."/{$tag}";

        // Construye y ejecuta los comandos necesarios para actualizar Yii.
        $commands = array(
            "( mkdir --mode=0700 -p " . $yiifwPath  . ") ",
            "( svn checkout  https://github.com/yiisoft/yii/tags/{$tag} {$yiifwPath}  ) ",
            "( rm -rf {$yiiPath} ) ",
            "( ln -s {$yiifwPath} {$yiiPath} ) ",
            "( rm -rf " . $fullBasePath . "assets/* ) ",
        );
        $com = implode(" && ", $commands);
        passthru($com);
    }

    /**
     * Ejecuta la actualización de Yii en el servidor local o remoto.
     *
     * @param array $args Argumentos pasados al comando.
     */
    public function run($args) {
        // Verifica la cantidad de argumentos proporcionados.
        if (count($args) == 1) {
            // Actualiza Yii en el servidor local.
            $this->localUpdate($args[0]);
        } else if (count($args)==2){
            // Actualiza Yii en el servidor remoto.
            $serverName = "";

            // Determina el nombre del servidor según el segundo argumento.
            if (count($args) == 2 && $args[1] == "test") {
                $serverName = "test";
            } else if (count($args) == 2 && $args[1] == "online") {
                $serverName = "online";
            }
            // Verifica que se haya especificado un servidor válido.
            if ($serverName != "") {
                $userPath = Yii::app()->params['server'][$serverName]['userPath'];
                $fullBasePath = $userPath . Yii::app()->params['server'][$serverName]['basePath'];
                $serverUser = Yii::app()->params['server'][$serverName]['serverUser'];
                // Ejecuta el comando de actualización en el servidor remoto.
                $commands = array(
                    "( /usr/bin/php {$fullBasePath}protected/yiic.php updateYii {$args[0]} ) ",
                );
                $com = implode(" && ", $commands);
                passthru("ssh {$serverUser}  \" {$com} \" ");
            }
        }else{
            // Muestra el mensaje de ayuda si se proporcionan argumentos incorrectos.
            print $this->help."\n";
        }
    }

    /**
     * Obtiene el mensaje de ayuda para el comando updateYii.
     *
     * @return string El mensaje de ayuda.
     */
    public function getHelp() {
        return "Usage: \nupdateYii <tag> [<server>]";
    }

    /**
     * Obtiene el nombre del comando updateYii.
     *
     * @return string El nombre del comando.
     */
    public function getName() {
        return "updateYii";
    }

}