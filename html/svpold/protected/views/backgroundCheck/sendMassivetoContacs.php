<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Background Checks' => array('admin'),
    'VCSP',
);

$this->menu = array(
    array('label' => 'List BackgroundCheck', 'url' => array('index')),
    array('label' => 'Create BackgroundCheck', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('background-check-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<?php if (Yii::app()->user->hasFlash('notification')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
    <br/>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('errorcontact')): ?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('errorcontact'); ?>
    </div>
    <br/>
<?php endif; ?>

<div class="flash-notice">
    <?php echo 'La <b>RESOLUCIÓN 5050 DE 2016, </b> Establece que el envío de SMS y/o USSD con fines comerciales y/o publicitarios solo podrán ser enviados a los usuarios entre las ocho de la mañana (8:00 a. m.) y las nueve de la noche (9:00 p. m.).';?>
</div>

<h1>Envío de Correos Electrónicos, SMS y Voz a Contactos</h1>

<?php //echo CHtml::link('Busqueda Avanzada', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
  <?php
  $this->renderPartial('_search', array(
      'model' => $model,
  ));
  ?>
</div>

<div>
    <?php echo CHtml::Button('Envío Correo Electrónico', array('onclick' => 'sendCorreo();')); ?> 
    <?php echo CHtml::Button('Envío Mensaje de Texto', array('onclick' => 'sendSMS();')); ?> 
    <?php echo CHtml::Button('Llamar', array('onclick' => 'sendVoz();')); ?> 
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'background-check-grid',
    'htmlOptions' => array(),
    'dataProvider' => $model->searchContacts(50),
    'selectableRows' => 2,
    'filter' => $model,
    'columns' => array(
        array(
            'id' => 'selectedIds',
            'class' => 'CCheckBoxColumn'
        ),
        'customer' => array(
            'name' => 'customer.name',
            'filter' => CHtml::activeDropDownList($model, 'customerId', CHtml::listData(Customer::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '100px'),
        ),
        'code' => array(
            'name' => 'code',
            'value' => '"<span id=\'codeId_".$data->id."\'>".$data->code."</span>"',
            'type' => 'raw',
            'htmlOptions' => array('width' => '20px'),
        ),
        'customerProductName' => array(
            'name' => 'customerProduct.name',
            'header' => 'Tipo',
            'htmlOptions' => array(
                'width' => '80px'
            ),
            'filter' => CHtml::activeTextField($model, 'customerProductName'),
        ),
        'result' => array(
            'name' => 'result.nick',
            'filter' => CHtml::activeDropDownList($model, 'resultId', CHtml::listData(Result::model()->findAll(array('order' => 'nick')), 'id', 'nick'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '35px'),
        ),
        'firstName' => array(
            'name' => 'firstName',
            'value'=> '("<div title=\"".$data->customerProduct->name."\">".$data->firstName."</div>")', 
            'type'=>'raw',
            'htmlOptions' => array('width' => '130px'),
        ),
        'lastName' => array(
            'name' => 'lastName',
            'value'=> '("<div title=\"".$data->customerProduct->name."\">".$data->lastName."</div>")', 
            'type'=>'raw',
            'htmlOptions' => array('width' => '130px'),
        ),
        'idNumber' => array(
            'name' => 'idNumber',
            'value' => '($data->formatedIdNumber.(count($data->otherReportsOfPerson)>0?"<div class=MultipleStudies>**</div>":"").($data->inAmendment?"<div class=MultipleStudies>*ENM*</div>":""))',
            'htmlOptions' => array('width' => '80px'),
            'type' => 'raw',
        ),
        'studyStartedOn' => array(
            'name' => 'studyStartedOn',
            'header' => 'Solic',
            'value' => '("<div title=\"Solicitado en:[".$data->studyStartedOn."]  Límite en: [".$data->studyLimitOn."] Creado en:[".$data->created."] \">".substr($data->studyStartedOn,2,8)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '30px'),
        ),
        'email' => array(
            'name' => 'email',
            'header' => 'Correo',
            'value'=> '("<div>".$data->email."</div>")',
            'type'=>'raw',
            'htmlOptions' => array('width' => '130px'),
        ),
        'mobile' => array(
            'name' => 'mobile',
            'header' => 'Celular',
            'value'=> '("<div>".$data->mobile ."</div>")',
            'type'=>'raw',
            'htmlOptions' => array('width' => '130px'),
        ),
        array(
            'name' => 'contactType',
            'header' => 'Contacto',
            'value' => '$data->getDetailContacts()',
            'type' => 'raw',
            'filter' => CHtml::activeDropDownList($model, 'contactType', CHtml::listData(ContactType::model()->findAll(array('order' => 'id')), 'id', 'Type'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px'),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
            'htmlOptions' => array('width' => '15px', 'style' => 'text-align:right'),
            'header' => GridViewFilter::getClearButton($this->route),
            'viewButtonUrl' => 'Yii::app()->createUrl("backgroundCheck/viewPdf/", array("code"=>$data->code, "valor"=>1))',
            'updateButtonUrl' => 'Yii::app()->createUrl("backgroundCheck/update/", array("code"=>$data->code))',
            'buttons' => array(
                'update' => array(
                    'visible' => (Yii::app()->user->isSuperAdmin ? 'true' : '$data->canUpdate'),
                )
            )
        ),
    ),
));

?>

<script>
    function sendCorreo() {

        var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');
        var studiesCodes = [];

        if (studiesIds.length > 0) {
           
            jQuery.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl("contact/sendmassivecont"); ?>',
                data: {'ids':studiesIds},
                dataType: "json",
                success: function (data, status) {
                    if (typeof data.error === 'undefined') {
                        alert(data.error);
                    } else {
                        alert( data.ans);
                    }
                },
                error: function (request, status, error) {
                    alert('Se realizo el envío de correos electrónicos con éxito.');
                    $.fn.yiiGridView.update("background-check-grid");
                },
            });

        } else {
            alert("Por favor selecciones los estudios a los que les enviara el correo electrónico.");
        }

       
    }


    function sendSMS() {

        var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');
        var studiesCodes = [];

        if (studiesIds.length > 0) {
        
            jQuery.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl("contact/sendmassiveSMS"); ?>',
                data: {'ids':studiesIds},
                dataType: "json",
                success: function (data, status) {
                    if (typeof data.error === 'undefined') {
                        alert(data.error);
                    } else {
                        alert( data.ans);
                    }
                },
                error: function (request, status, error) {
                    alert('Se realizo el envío de Mensajes de Texto con éxito.');
                    $.fn.yiiGridView.update("background-check-grid");
                },
            });

        } else {
            alert("Por favor selecciones los estudios a los que les enviara el Mensaje de Texto.");
        }
    }


    function sendVoz() {

        var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');
        var studiesCodes = [];

        if (studiesIds.length > 0) {

            jQuery.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl("contact/sendmassiveToCall"); ?>',
                data: {'ids':studiesIds},
                dataType: "json",
                success: function (data, status) {
                    if (typeof data.error === 'undefined') {
                        alert(data.error);
                    } else {
                        alert( data.ans);
                    }
                },
                error: function (request, status, error) {
                    alert('Se realizaron las llamadas con éxito.');
                    $.fn.yiiGridView.update("background-check-grid");
                },
            });

        } else {
            alert("Por favor selecciones los estudios a los que les realizara la llamada.");
        }
    }
</script>
