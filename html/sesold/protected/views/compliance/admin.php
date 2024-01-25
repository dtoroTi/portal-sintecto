
<h1>Lista de Reportes</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(


        array(
            'name'=>'dateReport',
            'value'=>'$data->dateReport',
        ),
        array(
            'name'=>'name',
            'value'=>'$data->name',
        ),
        array(
            'name'=>'lastname',
            'value'=>'$data->lastname',
        ),
        array(
            'name'=>'address',
            'value'=>'$data->address',
        ),
        array(
            'name'=>'IdCompliance',
            'value'=>'$data->IdCompliance',
        ),
        array(
            'name'=>'typeLink',
            'value'=>'$data->typeLink',
        ),
        'Update' => array(
            'name' => 'Update',
            'filter'=>'',
            'header' => 'Modificar',
            'value' => '(CHtml::link((strlen(trim($data->id))>0?"Actualizar":"Actualizar"), array("compliance/update", "id"=>$data->id )))',
            'type' => 'raw',
        ),
        'View' => array(
            'name' => 'View',
            'filter'=>'',
            'header' => 'Visualizar',
            'value' => '(CHtml::link((strlen(trim($data->id))>0?"Visualizar":"Visualizar"), array("compliance/view", "id"=>$data->id )))',
            'type' => 'raw',
        ),
    ),
));

?>

<?php

echo CHtml::button('Export Compliance', array(
    'id' => 'export-button',
    'class' => 'span-5 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/compliance/Compliance_CSV', array(
            'export' => true
        )) . "','_blank');"
));


?>
