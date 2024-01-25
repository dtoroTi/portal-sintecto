<?php
/* @var $this CustomerUserController */
/* @var $model CustomerUser */

if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}

$this->breadcrumbs = array(
    'Customer Users' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List CustomerUser', 'url' => array('admin')),
    array('label' => 'Create CustomerUser', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#customer-user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Customer Users</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'customer-user-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'customerId' => array(
            'name' => 'customer.name',
            'header' => 'Cliente',
            'filter' => CHtml::activeDropDownList($model, 'customerId', CHtml::listData(Customer::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => 'Cliente...')),
            'htmlOptions' => array('width' => '140px'),
        ),
        'username',
        'firstName',
        'lastName',
        'created',
        'lastLogin',
        'isActive' => array(
            'name' => 'isActive',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'isActive', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px'),
        ),
        'isSupervisor' => array(
            'name' => 'isSupervisor',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'isSupervisor', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px'),
        ),
        'accessToReports' => array(
            'name' => 'accessToReports',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'accessToReports', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px'),
        ),
        'accessToTemporalReports' => array(
            'name' => 'accessToTemporalReports',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'accessToTemporalReports', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px'),
        ),
        'accessToNegativeReports' => array(
            'name' => 'accessToNegativeReports',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'accessToNegativeReports', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px'),
        ),
        'accessToOfac' => array(
            'name' => 'accessToOfac',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'accessToOfac', Controller::$optionsYesNo, array('prompt' => '...')),
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
            'value' => '(CHtml::link("Log", array("/log/admin/", "customerUserLogin"=>$data->username )))',
            'type' => 'raw',
            'htmlOptions' => array('width' => '20px'),
            'visible' => Yii::app()->user->isSuperAdmin,
        ),
        'accessToPdfReport' => array(
            'name' => 'accessToPdfReport',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'accessToPdfReport', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px','style' => 'text-align:center',),
        ), /*
          'modified',
          'isActive',
          'lastLoginIP',
          'sessionValidUntil',
          'sessionKey',
          'mustChangePassword',
          'seed',
          'password',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{mail} {view} {update} ' . (Yii::app()->user->isAdmin ? '{delete}' : ''),
            'header' => GridViewFilter::getClearButton($this->route),
            'htmlOptions' => array('width' => '70px'),
            'buttons' => array(
                'mail' => array(
                    'label' => '<i class="fa fa-envelope-o"></i>',
                    'url' => 'Yii::app()->createUrl("/customerUser/sendTestMail",array("id"=>$data->id))',
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
?>
