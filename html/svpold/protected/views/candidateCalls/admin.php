<?php
/* @var $this CandidateCallsController */
/* @var $model CandidateCalls */

$this->breadcrumbs=array(
	'Llamadas programadas'=>array('admin'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#candidate-calls-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Toda la programación de Llamadas</h1>
<p>
    Usted puede utilizar alternativamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php //echo CHtml::link('Busqueda Avanzada', '#', array('class' => 'search-button')); ?>
<div class="search-form"> <!--style="display:none"-->
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'candidate-calls-grid',
	'dataProvider'=>$model->searchallCalls(),
	'filter'=>$model,
	'columns'=>array(
		/*'id' => array(
            'name' => 'id',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),*/
        'statusVisit' => array(
            'name' => 'statusVisit',
            'value' =>  '($data->statusVisitPend)',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '20px',
            ),
        ),
        'observation' => array(
            'header' => 'Observación',
            'name' => 'observation',
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
		'created' => array(
            'header' => 'Fecha Ingreso',
            'name' => 'backgroundcheck.studyStartedOn',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckstudyStartedOn'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
		'dateCreate' => array(
            'name' => 'dateCreate',
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
		'studyLimitOn' => array(
            'header' => 'Fecha Limite',
            'name' => 'backgroundcheck.studyLimitOn',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckstudyLimitOn'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'username' => array(
            'header' => 'Responsable Inicial',
            'name' => 'callManager.username',
            'filter'=>CHtml::activeTextField($model, 'userName1'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'dateRegistrationEffective' => array(
            'header' => 'Fecha_envío_correo (Llamada efectiva)',
            'name' => 'dateRegistrationEffective',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'dateRegistrationNotEffective' => array(
            'header' => 'Fecha_envío_correo (Llamada no efectiva)',
            'name' => 'dateRegistrationNotEffective',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
		'CustomerName' => array(
            'name' => 'backgroundcheck.customer.name',
            'filter'=>CHtml::activeTextField($model, 'customerName'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
		'code' => array(
            'name' => 'backgroundcheck.code',
            'value' => '(CHtml::link($data->backgroundcheck->code, array("backgroundCheck/update", "code"=>$data->backgroundcheck->code), array("target" => "_blank")))',
            'type' => 'raw',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckCode'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'idNumber' => array(
            'name' => 'backgroundcheck.idNumber',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckidNumber'),
            'value' => '($data->backgroundcheck->formatedIdNumber.(count($data->backgroundcheck->otherReportsOfPerson)>0?"<div class=MultipleStudies>**</div>":"").($data->backgroundcheck->inAmendment?"<div class=MultipleStudies>*ENM*</div>":"").($data->backgroundcheck->blacklist?"<div class=MultipleStudies>*LN*</div>":""))',
            'htmlOptions' => array(
                'width' => '20px'
            ),
            'type' => 'raw',
        ),
        'firstName' => array(
            'name' => 'backgroundcheck.firstName',
            'value' => '($data->backgroundcheck->firstName.(count($data->backgroundcheck->otherReportsOfPerson)>0?"<div class=MultipleStudies>[**Rep]</div>":""))',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckfirstName'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
            'type' => 'raw',
        ),
        'lastName' => array(
            'name' => 'backgroundcheck.lastName',
            'filter'=>CHtml::activeTextField($model, 'backgroundchecklastName'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'city' => array(
            'header' => 'Ciudad',
            'name' => 'backgroundcheck.city',
            'value' =>  '($data->verificationCity)',
            'type' => 'raw',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckcity'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'visitProgramdate' => array(
            'header' => 'Programación',
            'name' => 'visitProgramdate',
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'location' => array(
            'header' => 'Localidad',
            'name' => 'location',
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'referenceAddress' => array(
            'header' => 'Dirección',
            'name' => 'referenceAddress',
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'neighborhood' => array(
            'header' => 'Barrio',
            'name' => 'neighborhood',
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'availability' => array(
            'header' => 'Disponibilidad',
            'name' => 'availability',
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'availabilitydate' => array(
            'header' => 'Fecha Disponibilidad',
            'name' => 'availabilitydate',
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'userNameResVisit' => array(
            'header' => 'Responsable Visita',
            'name' => 'responsibleVisit.username',
            'filter'=>CHtml::activeTextField($model, 'userNameResVisit'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        /* 'email' => array(
            'header' => 'Correo Electronico',
            'name' => 'backgroundcheck.email',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckemail'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),*/
        /*'tels' => array(
            'name' => 'backgroundcheck.tels',
            'filter'=>CHtml::activeTextField($model, 'backgroundchecktels'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),*/
        'preliminar' => array(
            'name' => 'backgroundcheck.customerProduct.preliminary',
            'value' => '($data->preliminary)',
            'type' => 'raw',
            'filter'=> CHtml::activeDropDownList($model, 'customerProductPreliminary', Controller::$optionsYesNo, array('prompt' => '...')),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'productName' => array(
            'header' => 'Componente',
            //'name' => 'backgroundcheck.customerProduct.name',
            'value'=> '("<div title=\"".$data->backgroundcheck->customerProduct->name."\">".$data->backgroundcheck->getBackgroundCheckComponents()."</div>")', 
            'type'=>'raw',
            'filter' => CHtml::activeTextField($model, 'customerProductName'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'Componentes' => array(
            'header' => 'Resultado Componentes',
            'value' => '(" \"".$data->backgroundcheck->percentageSummaryAdv."\"")',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '20px',
                'style' => 'text-align:justify',

            ),
        ),
        'username2' => array(
            'header' => ' Responsable reprogramación',
            'name' => 'callReschedulingManager.username',
            'value' =>  '($data->resreprogram)',
            'type' => 'raw',
            'filter'=>CHtml::activeTextField($model, 'userName2'),
            'htmlOptions' => array(
                'width' => '20px'
            ),
        ),
        'assignedUserId' => array(
            'name' => 'assignedUserId',
            'header' => 'Asignado a',
            'value' => '($data->backgroundcheck->assignedUserNames)',
            'type' => 'raw',
            'filter' =>
            ((Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) ?
                    CHtml::activeDropDownList($model, 'assignedUserId', //
                            GridViewFilter::getNullArray() +
                            CHtml::listData(User::model()->findAll(array('order' => 'firstName')), 'id', 'name'), array('prompt' => '...')) :
                    ''),
            'htmlOptions' => array('width' => '80px'),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'htmlOptions' => array(
                'width' => '20px',
                //'style' => 'text-align:right'
            ),
            'header' => GridViewFilter::getClearButton($this->route),
            'updateButtonUrl' => 'Yii::app()->createUrl("candidateCalls/update/", array("id"=>$data->id,"pc"=>0))',
        ),
	),
)); 
?>
<?php
echo CHtml::button('Todas las Llamadas', array(
    'id' => 'export-button',
    'class' => 'span-5 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/candidateCalls/admin', array(
        '_exportAllCalls' => true
    )) . "','_blank');"
));
?>
<br/>
<br/>
<?php
echo CHtml::button('Programación Visitas', array(
    'id' => 'export-button',
    'class' => 'span-5 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/candidateCalls/admin', array(
        '_exporttoProgram' => true
    )) . "','_blank');"
));
?>
<br>
<br>
<?php
echo CHtml::button('Asignaciones', array(
    'id' => 'export-button',
    'class' => 'span-5 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/candidateCalls/admin', array(
        '_exportAssingSection' => true
    )) . "','_blank');"
));
?>