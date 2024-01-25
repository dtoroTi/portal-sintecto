<?php
/* @var $this PdfReportTypeController */
/* @var $model PdfReportType */

$this->breadcrumbs = array(
    'Pdf Report Types' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List PdfReportType', 'url' => array('index')),
    array('label' => 'Create PdfReportType', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pdf-report-type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Tipos de Reporte</h1>

<p>
    Usted puede utilizar alternatvamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'pdf-report-type-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name',
        'isCertificate' => array(
            'name' => 'isCertificate',
            'header' => 'Cert.',
            'value'=>'($data->isCertificate?Controller::$optionsYesNo[$data->isCertificate]:"")',
            'type' => 'raw',
            'filter' => CHtml::activeDropDownList($model, 'isCertificate', Controller::$optionsYesNo, array(
                'prompt' => '...'
            )),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'header' => array(
            'name' => 'header',
            'filter' => '',
            'header' => 'Enca.',
            'value' => '(CHtml::link((strlen(trim($data->header))>0?"Enc.":"NO"), array("pdfReportType/update", "id"=>$data->id,"section"=>"header" )))',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '20px',
                'style' => 'text-align: center;'
            ),
        ),
        'footer' => array(
            'name' => 'footer',
            'filter' => '',
            'header' => 'Pie',
            'value' => '(CHtml::link((strlen(trim($data->footer))>0?"Pie":"NO"), array("pdfReportType/update", "id"=>$data->id,"section"=>"footer" )))',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '20px',
                'style' => 'text-align: center;'
            ),
        ),
        'body' => array(
            'name' => 'body',
            'filter' => '',
            'header' => 'Cont.',
            'value' => '(CHtml::link((strlen(trim($data->body))>0?"Cont.":"NO"), array("pdfReportType/update", "id"=>$data->id,"section"=>"body" )))',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '20px',
                'style' => 'text-align: center;'
            ),
        ),
        'view' => array(
            'name' => 'view',
            'header' => 'Ver',
            'value' => '(CHtml::link("Ver", array("pdfReportType/view", "id"=>$data->id ), array("target" => "_blank")))',
            'type' => 'raw',
            'filter' => '',
            'htmlOptions' => array(
                'width' => '20px',
                'style' => 'text-align: center;',
            ),
        ),
//        'header',
//        'footer',
//        'body',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'header' => GridViewFilter::getClearButton($this->route),
        ),
    ),
));
?>
