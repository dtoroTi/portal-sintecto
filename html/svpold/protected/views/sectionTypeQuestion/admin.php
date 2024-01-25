<?php
/* @var $this SectionTypeQuestionController */
/* @var $model SectionTypeQuestion */

$this->breadcrumbs = array(
    'Section Type Questions' => array('admin'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#section-type-question-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Section Type Questions</h1>

<p>
  You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
  or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'section-type-question-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'question',
        'showOrder',
        'verificationSectionTypeId' => array(
            'name' => 'verificationSectionType.name',
            'header' => 'Tipo de Sección',
            'filter' => CHtml::activeDropDownList(
                    $model, 'verificationSectionTypeId', CHtml::listData(VerificationSectionType::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '250px'),
        ),
        'isActive' => array(
            'name' => 'isActive',
            'header' => 'Activo',
            'type' => 'boolean',
            'filter' => CHtml::activeDropDownList($model, 'isActive', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array('width' => '80px'),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update} {delete}',
        ),
    ),
));
?>
