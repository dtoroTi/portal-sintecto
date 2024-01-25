<br><h1>Se realiza la copia de la siguiente información:</h1>
<?php
echo '<br>';
$i=1;
echo '<br><br>'.CHtml::button('Regresar', array('submit' => array('backgroundCheck/formdataDoc'))).'<br><br>';


foreach ($studies2 as $key => $study2) {
    if(empty($subdir = substr($study2['filename'], 0, 3))) { // Empy verifica que no venga cacio
        continue;//omite el que viene vacio y continua todo el foreach desde el siguiente registro
    }
    $subdir2 = substr($study2['filename'], 3, 3);
    $absdir2 = Yii::app()->params['docsDir'].'/'. $subdir . '/' . $subdir2.'/'.$study2['filename'];
    $clientdir2 = $study2['name'];
    // $dir2 = Yii::app()->params['docsDir'].'/'. $subdir . '/' . $subdir2;

    if ($exist= file_exists($absdir2)){
        echo $i++.'. '.$study2['code'].'--'.$study2['name'].'--'. $absdir2.'<br>';
    }

    if(file_exists($absdir2))
    {
        if (!file_exists('/data/client_docs/'.$clientdir2.'/'.$subdir.'/'.$subdir2 )) {
            mkdir('/data/client_docs/'.$clientdir2.'/'.$subdir.'/'.$subdir2 , 0777, true);
        }

        copy($absdir2, '/data/client_docs/'.$clientdir2.'/'.$subdir.'/'.$subdir2.'/'.$study2['filename'] );

    }
}
if(isset($study2)){
    WebUser::logAccess("Genero copia de los documentos del cliente : {$study2['name']}");
}else{

    Echo "No se encuentran estudios Asociados a la empresa en el rango de fecha establecido.";
}