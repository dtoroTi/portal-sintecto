<style>
    td#AssignUserSections label{
        width : 220px;        
    }
</style>

<div class="form wide">
    <?php echo CHtml::beginForm(array('/backgroundCheck/assignUserToSections/', 'code' => $backgroundCheck->code)); ?>
    <?php
    $assignedUser = new assignedUser();
    $assignedUser->limitAt = $backgroundCheck->oneDayBeforeLimit;
    ?>
    <div class="SvpTable" >
        <table>
            <tr>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Grupos de Sección</th>
                <th>Sección</th>
                <th>Límite</th>
            </tr>

            <tr>
                <td>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        'name' => 'assignUserSections[username]',
                        'source' => $this->createUrl('user/autocompleteAllActiveUsers'),
                        // additional javascript options for the autocomplete plugin
                        'options' => array(
                            'minLength' => '2',
                            'select' => "js:function(event, ui) {
                                          $('#User_user_name').val(ui.item.id);
                                        }"
                        ),
                        'htmlOptions' => array(
                            'style' => 'height:20px;width:200px;',
                        ),
                    ));
                    ?>
                </td>
                <td>
                    <?php
                    echo CHtml::radioButtonList(//
                            'assignUserSections[userRoleId]', //
                            null, //
                            CHtml::listData(
                                    UserRole::model()->findAll(), 'id', 'name'), //
                            array(
                            )
                    );
                    ?>
                </td>
                <td>
                    <?php
                    echo CHtml::checkBoxList(//
                            'assignUserSections[verificationSectionGroupId]', //
                            $assignedUser->verificationSectionId, //
                            CHtml::listData(
                                    $backgroundCheck->verificationSectionGroups, 'id', 'name'), //
                            array(
                        'template' => '{input}{label}',
                        'labelOptions' => array('style' => 'display:inline'),
                            )
                    );
                    ?>

                </td>
                <td id="AssignUserSections">
                    <?php
                    echo CHtml::checkBoxList(//
                            'assignUserSections[verificationSectionId]', //
                            $assignedUser->verificationSectionId, //
                            CHtml::listData(
                                    $backgroundCheck->verificationSections, 'id', 'sectionName'), //
                            array(
                        'template' => '{input}{label}',
                        'labelOptions' => array('style' => 'display:inline'),
                            )
                    );
                    ?>

                </td>
                <td>
                    <?php echo CHtml::textField('assignUserSections[limitAt]', $assignedUser->limitAt, array('size' => 20, 'maxlength' => 20)); ?>
                </td>
            </tr>

        </table>

    </div>

    <table style="width:10em">
        <tr >
            <td>
                <?php if (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::TO_ASSING))): ?>
                    <?php echo CHtml::submitButton('Asignar Usuario', array('onClick' => 'this.disabled=true;this.form.submit();')); ?>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <div class="row">
    </div>
    <?php echo CHtml::endForm(); ?>

</div><!-- form -->