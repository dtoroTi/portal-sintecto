  
<tr>
    <td>
        <?php if ($assignedUser->isNewRecord): ?>
            <?php
//            if (is_array($assignedUserIds) && count($assignedUserIds) > 0) {
//                $condition = 'id NOT IN (' . implode(',', $assignedUserIds) . ') and isActive=1';
//            } else {
            $condition = 'isActive=1';
//            }
            echo CHtml::dropDownList(//
                    'assignedUsers[new][userId]', //
                    $assignedUser->userId, //
                    CHtml::listData(
                            User::model()->findAll(array(
                                'condition' => $condition,
                                'order' => 'firstname')), //
                            'id', 'name'), //
                    array('prompt' => 'Sin Asignar...', 'style' => 'height:20px;')
            );
            ?>
        <?php else: ?>
            <?php echo Chtml::encode($assignedUser->user->name); ?>
        <?php endif; ?>
    </td>
    <td>
        <?php if ($assignedUser->isNewRecord): ?>
            <?php
            if ($backgroundCheck->responsible) {
                $conditionRoles = 'id != ' . UserRole::ASSIGNED;
            } else {
                $conditionRoles = '';
            }

            echo CHtml::dropDownList(//
                    'assignedUsers[new][userRoleId]', //
                    $assignedUser->userRoleId, //
                    CHtml::listData(
                            UserRole::model()->findAll(array(
                                'condition' => $conditionRoles)), 'id', 'name') //
            );
            ?>
        <?php else: ?>
            <?php echo CHtml::encode($assignedUser->userRole->name); ?>
        <?php endif; ?>
    </td>
    <td>
        <?php if (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::TO_ASSING))): ?>
            <?php
            echo CHtml::dropDownList(//
                    'assignedUsers[' . ($assignedUser->isNewRecord ? 'new' : $assignedUser->id) . '][verificationSectionId]', //
                    $assignedUser->verificationSectionId, //
                    CHtml::listData(
                            $backgroundCheck->verificationSections, 'id', 'sectionName'), //
                    array('prompt' => '',)
            );
            ?>
        <?php elseif ($assignedUser->verificationSection): ?>
            <?php echo CHtml::encode($assignedUser->verificationSection->sectionName); ?>
        <?php endif; ?>
    </td>
    <td>
        <?php if (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::TO_ASSING))): ?>
            <?php echo CHtml::textField('assignedUsers[' . ($assignedUser->isNewRecord ? 'new' : $assignedUser->id) . '][limitAt]', $assignedUser->limitAt, array('size' => 20, 'maxlength' => 20)); ?>
        <?php else: ?>
            <?php echo CHtml::encode($assignedUser->limitAt); ?>
        <?php endif; ?>
    </td>
    <td>
        <?php if (!$assignedUser->isNewRecord): ?>
            <?php echo Chtml::encode($assignedUser->assignedAt); ?>
        <?php else: ?>
            &nbsp;
        <?php endif; ?>
    </td>
    <td>
        <?php if (!$assignedUser->isNewRecord): ?>
            <?php if (!$assignedUser->backgroundCheck->isApproved && !empty($assignedUser->finishedAt)  && Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::TO_ASSING))): ?>
                <a href="<?php echo $this->createUrl('/backgroundCheck/clearFinishedOfAssignedUser/', array('id' => $assignedUser->id)) ?>" 
                   class="ui-button ui-button-icon-only ui-widget ui-state-default ui-corner-all ServiceButton" 
                   title="Borrar"
                   onClick="return (confirm('Realmente desea desasignar el usuario \'<?php echo $assignedUser->user->name; ?>?\''));"> 
                    <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span> 
                    <span class="ui-button-text">Reiniciar</span> 
                </a> 
            <?php endif; ?>
            <?php echo Chtml::encode($assignedUser->finishedAt); ?>
        <?php else: ?>
            &nbsp;
        <?php endif; ?>
    </td>
    <td>
        <?php if (!$assignedUser->isNewRecord && $assignedUser->backgroundCheck->canUpdate && (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::TO_ASSING)))): ?>
            <div class="ServiceButton">
                <a href="<?php echo $this->createUrl('/backgroundCheck/deleteAssignedUser/', array('id' => $assignedUser->id)) ?>" 
                   class="ui-button ui-button-icon-only ui-widget ui-state-default ui-corner-all ServiceButton" 
                   title="Borrar"
                   onClick="return (confirm('Realmente desea desasignar el usuario \'<?php echo $assignedUser->user->name; ?>?\''));"> 
                    <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span> 
                    <span class="ui-button-text">Button</span> 
                </a> 
            </div>
        <?php endif; ?>
    </td>

</tr>
