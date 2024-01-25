<?php
/* @var $this ActivityTypeController */
/* @var $model ActivityType */
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
    $this->redirect('/noallowed.html');
}

$this->breadcrumbs = array(
    'AttachmentFile' => array('admin'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#AttachmentFile-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Archivos Subidos</h1>

<p>
    Usted puede utilizar alternatvamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'AttachmentFile-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id' => array(
            'name' => 'id',
            'htmlOptions' => array(
                'width' => '10px'
            ),
        ),
        'name_doc' => array(
            'name' => 'name_doc',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'name' => array(
            'name' => 'dynamicFormJSON.name',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
        ),
    ),
));
?>
