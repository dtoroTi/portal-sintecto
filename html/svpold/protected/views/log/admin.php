<?php
/* @var $this LogController */
/* @var $model Log */
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}

$this->breadcrumbs = array(
    'Logs' => array('admin'),
    'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#log-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Registro</h1>

<p>
    Usted puede utilizar alternatvamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php echo CHtml::button('Registro Viejo', array('submit' => array('log/adminOld'))); ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-log-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'customerUserLogin',
            'value' => '(CHtml::link($data->customerUserLogin, array("/log/admin/", "customerUserLogin"=>$data->customerUserLogin )))',
            'type' => 'raw',
        ),
        array(
            'name' => 'userLogin',
            'value' => '(CHtml::link($data->userLogin, array("/log/admin/", "userLogin"=>$data->userLogin )))',
            'type' => 'raw',
        ),
        'ip' => array(
            'name' => 'ip',
            'value' => '(CHtml::link($data->ip, array("/log/admin/", "ip"=>$data->ip )))',
            'type' => 'raw',
            'htmlOptions' => array('width' => '100px'),
        ),
//        'module' => array(
//            'name' => 'module',
//            'htmlOptions' => array('width' => '60px'),
//        ),
        'serverName' => array(
            'name' => 'serverName',
            'htmlOptions' => array('width' => '120px'),
        ),
        'controller' => array(
            'name' => 'controller',
            'htmlOptions' => array('width' => '120px'),
        ),
        'action' => array(
            'name' => 'action',
            'htmlOptions' => array('width' => '120px'),
        ),
        array(
            'name' => 'backgroundCheckCode',
            'value' => '(CHtml::link($data->backgroundCheckCode, array("/log/admin/", "code"=>$data->backgroundCheckCode )))',
            'type' => 'raw',
        ),
        array(
            'name' => 'comments',
            'htmlOptions' => array('width' => '250px'),
        ),
        'created' => array(
            'name' => 'created',
            'htmlOptions' => array('width' => '120px'),
        ),
        /*
          'id',
          'modified',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}',
            'header' => GridViewFilter::getClearButton($this->route),
        ),
    ),
));
//comment
?>