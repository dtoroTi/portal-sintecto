<?php
//coment
$this->breadcrumbs=array(
	'Manejo de Contactos Laboral',
);
?>
<h1>Lista de Contactos Laboral</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'name',
            'value'=>'$data->name',
		),
		array(
			'name'=>'email',
			'value'=>'$data->email',
		),
        array(
            'name'=>'phone',
            'value'=>'$data->phone',
        ),
        array(
            'name'=>'city',
            'value'=>'$data->city',
        ),
        array(
            'name'=>'contact',
            'value'=>'$data->contact',
        ),
		array(
            'name'=>'dateCreated',
            'value'=>'$data->dateCreated',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
