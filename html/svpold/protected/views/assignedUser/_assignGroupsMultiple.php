<?php
/* @var $backgroundChecks BackgroundCheck[] */
?>
<div class="form wide">
    <?php echo CHtml::beginForm(array('/backgroundCheck/assignUserToMultipleStudies/'), 'post', array('id' => 'asignStudiesForm')); ?>
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
    Asignar los siguientes  <span id="numberOfStudies">#</span> estudios<br/>
    <?php echo CHtml::hiddenField('assignUserSections[selectedStudiesCodes]', '', array('id' => 'assignUserSections_selectedStudiesCodes')); ?>
    <br/>


    <div class="SvpTable" >
        <table>
            <tr>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Grupos de Sección</th>
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
                                    VerificationSectionGroup::model()->findAll(), 'id', 'name'), //
                            array(
                        'template' => '{input}{label}',
                        'labelOptions' => array('style' => 'display:inline'),
                            )
                    );
                    ?>
                </td>
            </tr>

        </table>

    </div>

    <table style="width:10em">
        <tr >
            <td>
                <?php if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()): ?>
                    <?php
                    echo CHtml::ajaxButton('Asignar'
                            , array(
                        'url' => CController::createUrl('/backgroundCheck/assignUserToMultipleStudies'),
                        'success' => 'js:function(data) {alert("Se asignaron " +data+" procesos");$.fn.yiiGridView.update("background-check-grid");}',
                            )
                            , array(
                        'name' => 'assigndSelected',
                        'class' => 'btn btn-success',
                        'confirm' => 'Desea asignar toda las selección? ',
                            )
                    );
                    ?>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <?php echo CHtml::endForm(); ?>

</div><!-- form -->

