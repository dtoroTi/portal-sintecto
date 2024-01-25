<?php
$this->breadcrumbs = array(
    'Verification Section Types' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List VerificationSectionType', 'url' => array('index')),
    array('label' => 'Create VerificationSectionType', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('verification-section-type-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Verification Section Types</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'verification-section-type-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name',
        'nick',
        'class',
        'fieldId',
        'verificationSectionGroupId' => array(
            'name' => 'verificationSectionGroup.name',
            'filter' => CHtml::activeDropDownList($model, 'verificationSectionGroupId', CHtml::listData(VerificationSectionGroup::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '100px'),
        ),
        'component',
        'description',
        'showOrder',
        'html' => array(
            'name' => 'footer',
            'filter' => '',
            'header' => 'HTML',
            'value' => '($data->isHtmlSection?CHtml::link("Html", array("verificationSectionType/update", "id"=>$data->id,"section"=>"htmlSection" )):"")',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '20px',
                'style' => 'text-align: center;'
            ),
        ),
        
        array(            // display 'author.username' using an expression
            'name'=> 'hasPersonalExtras',
            'value'=>'$data->hasPersonalExtras > 0 ? "YES": "NO"',
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => GridViewFilter::getClearButton($this->route),
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'visible' => ( Yii::app()->user->isSuperAdmin ?
                            '($data->isXmlSection || $data->isHtmlSection )' : 'FALSE'),
                ),
            )
        ),
    ),
));
?>
