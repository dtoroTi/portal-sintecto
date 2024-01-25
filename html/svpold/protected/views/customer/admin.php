<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Customers' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Customer', 'url' => array('index')),
    array('label' => 'Create Customer', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('customer-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Customers</h1>

<?php if (Yii::app()->user->hasFlash('notice')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('notice'); ?>
    </div>
<?php endif; ?>

<p>
    Usted puede utilizar alternatvamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
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
    'id' => 'customer-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'customerGroupId' => array(
            'name' => 'customerGroup.name',
            'header' => 'Group',
            'filter' => CHtml::activeDropDownList($model, 'customerGroupId', CHtml::listData(CustomerGroup::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '200px'),
        ),
        'name',
        'userId' => array(
            'name' => 'user.name',
            'header' => 'Líder',
            'filter' =>
            CHtml::activeDropDownList($model, 'userId', //
                    CHtml::listData(User::model()->findAll(array('order' => 'isActive desc,firstName')), 'id', 'summaryLine'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px'),
        ),

        'businessLine' => array(
            'name' => 'businessLine',
            //'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'businessLine', Controller::$optionsBussinesLineClient, array('prompt' => '...')),
        ),
        
        'salesmanId' => array(
            'name' => 'salesman.name',
            'header' => 'Vendedor',
            'filter' =>
            CHtml::activeDropDownList($model, 'salesmanId', //
                    CHtml::listData(User::model()->findAll(array('order' => 'isActive desc,firstName')), 'id', 'summaryLine'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px'),
        ),


        'sacId' => array(
            'name' => 'sac.name',
            'header' => 'SAC',
            'filter' =>
                CHtml::activeDropDownList($model, 'sacId', //
                    CHtml::listData(User::model()->findAll(array('order' => 'isActive desc,firstName')), 'id', 'summaryLine'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px'),
        ),
//        'field1',
//        'field2',
//        'field3',
        'notifyByMail' => array(
            'name' => 'notifyByMail',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'notifyByMail', Controller::$optionsYesNo, array('prompt' => '...')),
        ),
        'accessToReports' => array(
            'name' => 'accessToReports',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'accessToReports', Controller::$optionsYesNo, array('prompt' => '...')),
        ),
        'accessToTemporalReports' => array(
            'name' => 'accessToTemporalReports',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'accessToTemporalReports', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px'),
        ),
        'accessToOfac' => array(
            'name' => 'accessToOfac',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'accessToOfac', Controller::$optionsYesNo, array('prompt' => '...')),
        ),
        'sendToCertificate' => array(
            'name' => 'sendToCertificate',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'sendToCertificate', Controller::$optionsYesNo, array('prompt' => '...')),
        ),
        'graphicsNews' => array(
            'name' => 'graphicsNews',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'graphicsNews', Controller::$optionsYesNo, array('prompt' => '...')),
        ),
        /*
          'created',
          'modified',
         */
        array(
            'class' => 'CButtonColumn',
            'header' => GridViewFilter::getClearButton($this->route),
            'buttons' => array(
                'delete' => array(
                    'visible' => '$data->canBeDeleted',
                ),
            ),
//            'deleteConfirmation' => "js:'Record with ID '+$(this).parent().parent().children(':first-child').text()+' will be deleted! Continue?  ' + $(this).html() + '**' ;",
        ),
    ),
));
//comment
?>
