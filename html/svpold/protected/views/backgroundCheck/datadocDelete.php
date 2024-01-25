<br><h1>Se realiza Eliminación de la siguiente información:</h1>
<?php
echo '<br>';
$i=1;
echo '<br><br>'.CHtml::button('Regresar', array('submit' => array('backgroundCheck/formdataDoc')));

foreach ($studies3 as $key => $study3) {
    $subdir = substr($study3['filename'], 0, 3);
    if(empty($subdir)) { // Empy verifica que no venga Vacio
        continue;//omite el que viene vacio y continua todo el foreach desde el siguiente registro
    }
    $subdir3 = substr($study3['filename'], 3, 3);
    $absdir3 = Yii::app()->params['docsDir'].'/'. $subdir . '/' . $subdir3.'/'.$study3['filename'];

    if ($exist= file_exists($absdir3)){
        echo $i++.'. '.$study3['code'].'--'.$study3['name'].'--'. $absdir3.'<br>';
    }

    if(file_exists($absdir3))
    {
        if (!file_exists($absdir3)) {
           // mkdir('/data/client_docs/' .$subdir.'/'.$subdir2 , 0777, true);
            echo 'NO existe';
        }
        unlink($absdir3);
    }
}

if(isset($study2)){
    WebUser::logAccess("Genero la eliminacion de los documentos del cliente : {$study3['name']}");
}else{

    Echo "No se encuentran estudios Asociados a la empresa en el rango de fecha establecido.";
}



