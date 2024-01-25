<div>
    <a style="padding-left: 10px;"></a><b>Usuario:</b>
    <?php echo $user2->username; ?>
</div>
<div>
    <a style="padding-left: 10px;"></a><b>Empresa:</b>
    <?php echo $user2->customer->name; ?>
</div><br>
<h4><a style="padding-left: 10px;"></a>Actualizar Reporte #<?php echo $model->id?></h4>
<?php echo $this->renderPartial('form', array('model' => $model, 'user2'=>$user2)); ?>
