<?php

/**
 * Clase SvpmailCommand
 * 
 * Este comando se encarga de enviar correos electrónicos utilizando la clase SvpMail.
 */
class SvpmailCommand extends CConsoleCommand {

    /**
     * Ejecuta el envío de correo electrónico utilizando los argumentos proporcionados.
     *
     * @param array $args Argumentos pasados al comando.
     */
    public function run($args) {

        // Verifica si se proporcionó un archivo como argumento.
        if (count($args) == 1) {
            $filename = $args[0];
            // Verifica si el archivo existe.
            if (file_exists($filename)) {
                // Lee los argumentos del correo electrónico desde el archivo serializado.
                $mailArgs = unserialize(file_get_contents($filename));
                // Verifica si se proporcionaron al menos 5 argumentos.
                if (count($mailArgs) >= 5) {
                    // Importa la clase SvpMail.
                    Yii::import('application.models.basic.SvpMail');
                    // Envía el correo electrónico utilizando los argumentos proporcionados.
                    $ans = SvpMail::sendMail($mailArgs['subject'], $mailArgs['body'], $mailArgs['to'], $mailArgs['cc'], $mailArgs['bcc'], $mailArgs['files'], $mailArgs['sender']);
                    // Si el correo se envió correctamente, elimina el archivo.
                    if ($ans) {
                        unlink($filename);
                    }
                }
            }
        }
    }

    /**
     * Obtiene el mensaje de ayuda para el comando VSPMail.
     *
     * @return string El mensaje de ayuda.
     */
    public function getHelp() {
        return "Usage: VSPMail ";
    }

    /**
     * Obtiene el nombre del comando VSPMail.
     *
     * @return string El nombre del comando.
     */
    public function getName() {
        return "VSPMail";
    }

}
