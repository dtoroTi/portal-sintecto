<div class="ProcessTab">
    <fieldset>
        <legend>
            <a name="assignedUsers">
                Asignación [<?php echo CHtml::encode(count($model->assignedUsers)) ?>]</a> 
        </legend>  
        <?php
        if (Yii::app()->user->hasFlash('assignedUser'))
            echo '<div class="flash-notice">' . Yii::app()->user->getFlash('assignedUser') . "</div>\n";
        ?>
        <div class="form wide">
            <?php echo CHtml::beginForm(array('/backgroundCheck/updateAssignedUsers/', 'code' => $model->code)); ?>
            <div class="SvpTable" >
                <table>
                    <tr>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Sección</th>
                        <th>Límite</th>
                        <th>Asignado en:</th>
                        <th>Terminado en:</th>
                        <th>&nbsp;</th>
                    </tr>

                    <?php foreach ($model->assignedUsers as $assignedUser): ?>
                        <?php
                        echo $this->renderPartial('/assignedUser/_assignedUser', array(
                            'assignedUser' => $assignedUser,
                            'assignedUserIds' => array(),
                            'assignedUserRoleIds' => array(),
                            'backgroundCheck' => $model,
                        ));
                        ?>
                    <?php endforeach ?>
                    <?php if (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::TO_ASSING))): ?>
                        <?php
                        if ($model->canUpdate) {
                            $assignedUser = new assignedUser();
                            $assignedUser->limitAt = $model->oneDayBeforeLimit;
                            echo $this->renderPartial('/assignedUser/_assignedUser', array(
                                'assignedUser' => $assignedUser,
                                'assignedUserIds' => $model->assignedUserIds,
                                'assignedUserRoleIds' => $model->assignedUserRoleIds,
                                'backgroundCheck' => $model,
                            ));
                        }
                        ?>
                    <?php endif; ?>
                </table>

            </div>

            <table style="width:10em">
                <tr >
                    <td>
                        <?php if (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::TO_ASSING))): ?>
                            <?php echo CHtml::submitButton('Actualizar', array('onClick' => 'this.disabled=true;this.form.submit();')); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <div class="row">
            </div>
            <?php echo CHtml::endForm(); ?>

        </div><!-- form -->
        <?php if (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::TO_ASSING))): ?>
            <?php echo $this->renderPartial('/assignedUser/_assignGroups', array('backgroundCheck' => $model,)); ?>
        <?php endif; ?>

    </fieldset>
</div>