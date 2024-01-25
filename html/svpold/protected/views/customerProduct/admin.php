<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Customer Products' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List CustomerProduct', 'url' => array('admin')),
    array('label' => 'Create CustomerProduct', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('customer-product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Customer Products</h1>

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
    'id' => 'customer-product-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'customerId' => array(
            'name' => 'customer.name',
            'header' => 'Cliente',
            'filter' => CHtml::activeDropDownList($model, 'customerId', CHtml::listData(Customer::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => 'Cliente...')),
            'htmlOptions' => array('width' => '200px'),
        ),
        'typeProductId' => array(
            'name' => 'typeProduct.value',
            'header' => 'Linea de Negocio',
            'filter' => CHtml::activeDropDownList($model, 'typeProductId', CHtml::listData(Items::model()->findAllByAttributes(array('listId'=> DynamicList::L_TYPE_PRODUCT),array('order'=>'sort')),'id','value'),array('prompt' => 'Linea de Negocio')),
            'htmlOptions' => array('width' => '120px'),
        ),
        'attachmentFileId' => array(
            'name' => 'attachmentFile.name_doc',
            'header' => 'Documento Asociado',
            'filter' => CHtml::activeDropDownList($model, 'attachmentFileId', CHtml::listData(AttachmentFile::model()->findAll(array('order' => 'name_doc')), 'id', 'name_doc'), array('prompt' => 'Doc...')),
            'htmlOptions' => array('width' => '200px'),
        ),
        'name' => array(
            'name' => 'name',
            'header' => 'Nombre Producto',
            'htmlOptions' => array('width' => '120px'),
        ),
        'maxDays' => array(
            'name' => 'maxDays',
            'htmlOptions' => array('width' => '60px', 'style' => 'text-align:right'),
        ),
        'maxInternalDays' => array(
            'name' => 'maxInternalDays',
            'htmlOptions' => array('width' => '60px', 'style' => 'text-align:right'),
        ),

        'contract_Limit' => array(
            'name' => 'contract_Limit',            
            'htmlOptions' => array('width' => '60px', 'style' => 'text-align:right'),
        ),

        'sections' => array(
            'name' => 'sectionsName',
            'header'=> 'Secciones',
            'htmlOptions' => array('style' => 'text-align:left','width' => '300px'),
            'filter'=>'',
        ),
        'total' => array(
            'name' => 'totalWeight',
            'header'=> 'Peso',
            'htmlOptions' => array('width' => '20px', 'style' => 'text-align:right'),
            'filter'=>'',
        ),
        'price' => array(
            'name' => 'price',
            'value' => '"$".HtmlHelper::amount($data->price,true)',
            'htmlOptions' => array(
                'width' => '100px',
                'style' => 'text-align:right',
            ),
        ),
        'isCompanySurvey' => array(
            'name' => 'isCompanySurvey',
            'type' => 'boolean',
            'htmlOptions' => array('width' => '50px'),
        ),
        'pdfReportTypeId' => array(
            'name' => 'pdfReportType.name',
            'filter' => CHtml::activeDropDownList($model, 'pdfReportTypeId', CHtml::listData(PdfReportType::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => 'Reporte')),
            'htmlOptions' => array('width' => '100px'),
        ),
        'xmlFormat' => array(
            'name' => 'xmlFormat',
            'filter'=>'',
            'header' => 'XML',
            'value' => '(CHtml::link((strlen(trim($data->xmlQuestion.$data->questionFormat.$data->reportFormat))>0?"XML":"NO"), array("customerProduct/editXmlFormat", "id"=>$data->id )))',
            'type' => 'raw',
        ),
        'description' => array(
            'name' => 'description',
            'filter'=>'',
            'header' => 'Desc.',
            'value' => '(CHtml::link((strlen(trim($data->description))>0?"Desc.":"NO"), array("customerProduct/editDescription", "id"=>$data->id )))',
            'type' => 'raw',
        ),
        'facturacion' => array(
            'name' => 'facturacion',
            'filter'=>'',
            'header' => 'Fact.',
            'value' => '(CHtml::link((strlen(trim($data->facturacion))>0?"Fact.":"NO"), array("customerProduct/editDescriptionFac", "id"=>$data->id )))',
            'type' => 'raw',
        ),
        'glossary' => array(
            'name' => 'glossary',
            'filter'=>'',
            'header' => 'Glosar.',
            'value' => '(CHtml::link((strlen(trim($data->glossary))>0?"Glosar.":"NO"), array("customerProduct/editDescriptionGlosar", "id"=>$data->id )))',
            'type' => 'raw',
        ),
        'description2' => array(
            'name' => 'description2',
            'filter'=>'',
            'header' => 'Desc New.',
            'value' => '(CHtml::link((strlen(trim($data->description2))>0?"Desc New.":"NO"), array("customerProduct/editDescriptionNew", "id"=>$data->id )))',
            'type' => 'raw',
            'visible' => Yii::app()->user->isDescription,
        ),
        /*
          'created',
          'modified',
          'isActive',
         */
        array(
            'class' => 'CButtonColumn',
            'header' => GridViewFilter::getClearButton($this->route),
        ),
    ),
));
?>

<?php echo CHtml::button('Exportar', 
        array(
            'id'=>'export-button',
            'class'=>'span-3 button', 
            'onClick' =>"window.open('".Yii::app()->controller->createUrl('/customerProduct/admin',array( '_export' => true))."','_blank');")
        ); ?>
<br/>
