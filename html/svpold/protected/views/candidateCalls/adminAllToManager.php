<?php
/* @var $this CandidateCallsController */
/* @var $model CandidateCalls */

$this->breadcrumbs=array(
	'Llamadas a Cargo'=>array('admintoManager'),
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

<h1>Llamadas a Cargo</h1>
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
	'dataProvider'=>$model->searchCallstoManager(),
	'filter'=>$model,
	'columns'=>array(
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
		/*'id' => array(
            'name' => 'id',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),*/
		'created' => array(
            'header' => 'Fecha Ingreso',
            'name' => 'backgroundcheck.studyStartedOn',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckstudyStartedOn'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
		'dateCreate' => array(
            'name' => 'dateCreate',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
		'studyLimitOn' => array(
            'header' => 'Fecha Limite',
            'name' => 'backgroundcheck.studyLimitOn',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckstudyLimitOn'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'username' => array(
            'header' => 'Responsable llamada Inicial',
            'name' => 'callManager.username',
            'filter'=>CHtml::activeTextField($model, 'userName1'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'dateRegistrationEffective' => array(
            'name' => 'dateRegistrationEffective',
            'header' => 'Fecha_envío_correo (Llamada efectiva)',
            'htmlOptions' => array(
                'width' => '150px'
            ),
        ),
        'dateRegistrationNotEffective' => array(
            'name' => 'dateRegistrationNotEffective',
            'header' => 'Fecha_envío_correo (Llamada no efectiva)',
            'htmlOptions' => array(
                'width' => '150px'
            ),
        ),
		'CustomerName' => array(
            'name' => 'backgroundcheck.customer.name',
            'filter'=>CHtml::activeTextField($model, 'customerName'),
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
		'code' => array(
            'name' => 'backgroundcheck.code',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckCode'),
            'value' => '(CHtml::link($data->backgroundcheck->code, array("backgroundCheck/update", "code"=>$data->backgroundcheck->code), array("target" => "_blank")))',
            'type' => 'raw',
            'htmlOptions' => array(
                'width' => '50px'
            ),
        ),
        'idNumber' => array(
            'name' => 'backgroundcheck.idNumber',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckidNumber'),
            'value' => '($data->backgroundcheck->formatedIdNumber.(count($data->backgroundcheck->otherReportsOfPerson)>0?"<div class=MultipleStudies>**</div>":"").($data->backgroundcheck->inAmendment?"<div class=MultipleStudies>*ENM*</div>":"").($data->backgroundcheck->blacklist?"<div class=MultipleStudies>*LN*</div>":""))',
            'htmlOptions' => array(
                'width' => '50px'
            ),
            'type' => 'raw',
        ),
        'firstName' => array(
            'name' => 'backgroundcheck.firstName',
            'filter'=>CHtml::activeTextField($model, 'backgroundcheckfirstName'),
            'value' => '($data->backgroundcheck->firstName.(count($data->backgroundcheck->otherReportsOfPerson)>0?"<div class=MultipleStudies>[**Rep]</div>":""))',
            'htmlOptions' => array(
                'width' => '50px'
            ),
            'type' => 'raw',
        ),
        'lastName' => array(
            'name' => 'backgroundcheck.lastName',
            'filter'=>CHtml::activeTextField($model, 'backgroundchecklastName'),
            'htmlOptions' => array(
                'width' => '50px'
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
        /*'email' => array(
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
                'width' => '30px'
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
                'width' => '80px',
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
            (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole() ?
                    CHtml::activeDropDownList($model, 'assignedUserId', //
                            GridViewFilter::getNullArray() +
                            CHtml::listData(User::model()->findAll(array('order' => 'firstName')), 'id', 'name'), array('prompt' => '...')) :
                    ''),
            'htmlOptions' => array('width' => '80px'),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
            'htmlOptions' => array(
                'width' => '50px',
                //'style' => 'text-align:right'
            ),
            'header' => GridViewFilter::getClearButton($this->route),
            'updateButtonUrl' => 'Yii::app()->createUrl("candidateCalls/update/", array("id"=>$data->id,"pc"=>2))',
        ),
	),
)); 
?>

<?php
echo CHtml::button('Llamadas a cargo', array(
    'id' => 'export-button',
    'class' => 'span-5 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/candidateCalls/admintoManager', array(
        '_exportTocharge' => true
    )) . "','_blank');"
));
?>
<br>
<br>
<?php
echo CHtml::button('Asignaciones', array(
    'id' => 'export-button',
    'class' => 'span-5 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/candidateCalls/admintoManager', array(
        '_exportAssingSection' => true
    )) . "','_blank');"
));
?>



