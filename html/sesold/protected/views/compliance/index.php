

<hr/><hr/><h1 align="center">Listado de datos</h1><hr/><hr/><br><br>
<h3><?php echo CHtml::link("Crear",array("create"));?></h3>
<?php foreach ($compliance as $data):?>
<h1><?php echo $data->name.' '.$data->lastname?></h1>
<h3><font color='#06c'><?php echo $data->id.'. ';?> </font><?php echo CHtml::link("Actualizar",array("update","id"=>$data->id)); ?> |
<?php echo CHtml::link("Ver",array("view","id"=>$data->id)); ?></h3>

<?php endforeach;?>

