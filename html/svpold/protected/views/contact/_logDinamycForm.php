<tr>
    <?php   
    if(empty($logDynamicForm) && $backgroundCheck->ooidFD!=""){ 
    ?>
    <div class="flash-notice">
        <?php echo 'La persona asociada a este estudio no ha ingresado al proceso de Formulario Dinámico.';?>
    </div>
    <?php
    }else{
    ?>
        <tr>
            <td><?php echo CHtml::encode($logDynamicForm->ip); ?></td>
            <td><?php echo CHtml::encode($logDynamicForm->detail); ?></td>
            <td><?php echo CHtml::encode($logDynamicForm->createdAt); ?></td>
        </tr>
    <?php
    }
    ?>
</tr>

