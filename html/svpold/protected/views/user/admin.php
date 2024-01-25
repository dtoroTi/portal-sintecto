<?php
if(!Yii::app()->user->isSuperAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Users' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('index')),
    array('label' => 'Create User', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'username',
        'firstName',
        'lastName',
        //'password',
//        'customerId' => array(
//            'name' => 'customer.name',
//            'header' => 'Cliente',
//            'filter' => CHtml::activeDropDownList($model, 'customerId', CHtml::listData(Customer::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => 'Cliente...')),
//            'htmlOptions' => array('width' => '140px'),
//        ),
        'userTypeId' => array(
            'name' => 'userType.name',
            'header' => 'Tipo',
            'filter' => CHtml::activeDropDownList($model, 'userTypeId', CHtml::listData(UserType::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => 'Tipo...')),
            'htmlOptions' => array('width' => '140px'),
        ),
        'rolelist' => [
            'name' => 'rolesListstr',
            'header' => 'Lista Roles',
            'filter' => CHtml::activeDropDownList($model, 'roleId', CHtml::listData(Role::model()->findAll(['order' => 'name']), 'id', 'name'), ['prompt' => '...']),
            'htmlOptions' => ['width' => '80px'],
		],
        'sate' => array(
            'name' => 'state',
            'htmlOptions' => array('width' => '130px'),
        ),
        'city' => array(
            'name' => 'city',
            'htmlOptions' => array('width' => '130px'),
        ),
        'isInhouse' => array(
            'name' => 'isInhouse',
            'filter' => CHtml::activeDropDownList($model, 'isInhouse', Controller::$optionsYesNo, array('prompt' => '...')),
            'type' => 'boolean',
            'htmlOptions' => array('width' => '70px'),
        ),
        'created' => array(
            'name' => 'created',
            'header' => 'Creado',
            'value' => 'substr($data->created,0,10)',
            'htmlOptions' => array('width' => '70px'),
        ),
        'lastLogin' => array(
            'name' => 'lastLogin',
            'header' => 'Ultimo',
            'value' => 'substr($data->lastLogin,0,10)',
            'htmlOptions' => array('width' => '70px'),
        ),
        'userSeniorType' => array(
            'name' => 'userSeniorType',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'userSeniorType', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '15px'),
        ),
        'isActive' => array(
            'name' => 'isActive',
            'header' => 'Activo',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'isActive', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px'),
        ),
        'online' => array(
            'name' => 'isOnline',
            'header' => 'En linea',
            'value' => '$data->isOnline',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'online', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '15px'),
        ),
        'log' => array(
            'header' => 'log',
            'value' => '(CHtml::link("Log", array("/log/admin/", "userLogin"=>$data->username )))',
            'type' => 'raw',
            'htmlOptions' => array('width' => '20px'),
            'visible' => (Yii::app()->user->isSuperAdmin || Yii::app()->user->getIsByRole()),
        ),
        /*
          'modified',
          'mustChangePassword',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{mail} {update}',
            'header' => GridViewFilter::getClearButton($this->route),
            'buttons' => array(
                'mail' => array(
                    'label' => '<i class="fa fa-envelope-o"></i>',
                    'url' => 'Yii::app()->createUrl("/user/sendTestMail",array("id"=>$data->id))',
                    'options' => array(
                        'confirm' => 'Desea enviar un correo de prueba a este usuario?',
                        'ajax' => array(
                            'type' => 'POST',
                            'dataType' => 'json',
                            'url' => "js:$(this).attr('href')",
                            'success' => 'function(data){
                                           alert("Correo enviado. Por favor verifique su carpeta de correos nuevos.");
                                    }'
                        ),
                    ),
                ),
            ),
        ),
    ),
));
//comment
?>
