<div class="form wide">
        <?php echo CHtml::beginForm('#', 'post', array('id' => 'asignStudiesForm')); ?>
        <?php

        $assignedUser = new AssignedUser();
        $date = new DateTime();
        ?>

        <style>
            #numberOfStudies{
                color: blue;
                font-size: 18px;
                font-weight:  bold;
            }
        </style>
        Asignar los siguientes  <span id="numberOfStudies"><?php echo $numStudies; ?></span> estudios<br/>
        <?php echo CHtml::hiddenField('assignUserSections[selectedStudiesCodes]', $bgkcode, array('id' => 'assignUserSections_selectedStudiesCodes')); ?>
        <br/>
        <div class="SvpTable" >
            <table>
                <tr>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Grupos de Sección</th>
                    <th>Sección</th>
                </tr>

                <tr>
                    <td>
                        <?php
                            echo CHtml::dropDownList(//
                                    'assignUserSections[username]', //
                                    $assignedUser->userId, //
                                    CHtml::listData(
                                            User::model()->findAll(array(
                                                'condition' => 'isActive=1',
                                                'order' => 'firstname')), //
                                            'id', 'name'), //
                                    array('prompt' => 'Asignar a...', 'style' => 'height:20px;width:200px;')
                            );
                        /*$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
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
                        ));*/
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
                                    VerificationSectionGroup::model()->findAll(), 'id', 'name'), //
                                array(
                            'template' => '{input}{label}',
                            'labelOptions' => array('style' => 'display:inline'),
                                )
                        );
                        ?>
                    </td>
                    <td id="AssignUserSections">
                    <?php 
                            //$backgroundCheck = BackgroundCheck::model()->getStudyAssing($bgkcode);

                            echo CHtml::checkBoxList(//
                                'assignUserSections[verificationSectionId]', //
                                $assignedUser->verificationSectionId, //
                                CHtml::listData(
                                    BackgroundCheck::model()->getStudyAssing($bgkcode),  'id', 'name'
                                    ), 
                                array(
                                'template' => '{input}{label}',
                                'labelOptions' => array('style' => 'display:inline;width:350px;text-align:right'),
                                )
                            );
                        ?>
                    </td>
                </tr>
            </table>
            <?php //echo CHtml::Button('Asignar', array('onclick' => 'sendAssignUsers();')); ?> 
        </div>
        <?php echo CHtml::endForm(); ?>
    </div><!-- form -->

<script>
    /*function sendAssignUsers() {
        var dataOut = $("#asignStudiesForm").serialize();

        jQuery.ajax({
            type: 'POST',
            url: '<?php //echo Yii::app()->createAbsoluteUrl("backgroundCheck/assignUserToMultipleStudies"); ?>',
            data: dataOut,
            dataType: "json",
            success: function (data, status) {
                if (typeof data.error === 'undefined') {
                    alert(data.error);
                    alert(data);
                } else {
                    alert(data.ans);
                    $('#assignUserSections_username').val('');
                    $('#assignUserSections_userRoleId input:checked').removeAttr('checked');
                    $('#assignUserSections_verificationSectionGroupId input:checked').removeAttr('checked');
                    $('#assignUserSections_verificationSectionId input:checked').removeAttr('checked');
                }
            },
            error: function (request, status, error) {
                    alert(request.responseText);
            },
        });
    }*/
</script>