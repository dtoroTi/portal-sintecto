<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Background Checks' => array('sendMassiveRecover'),
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

<h1>Envío de Correos Electrónicos Proceso Recaudo</h1>

<?php //echo CHtml::link('Busqueda Avanzada', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
  <?php
  $this->renderPartial('_search', array(
      'model' => $model,
  ));
  ?>
</div>
<div class="search-form">
    <?php echo CHtml::Button('Soporte Pago', array('onclick' => 'ans=confirm("Está seguro de enviar el correo electronico SP ?");if (ans) {sendCorreoSP();}')); ?>
    <b>Limite Formulario Dinámico SP:</b>
    <?php 
      $this->widget('jqueryDateTime', [
          'name' => 'validuntilFD',
          'value' => $model->validuntilFD,
          // additional javascript options for the date picker plugin
          'options' => [
              'showAnim' => 'fold',
              'buttonText' => '...',
              'format' => 'Y-m-d H:i:s',
              'lang' => 'es',
              'showButtonPanel' => true,
              'changeYear' => true,
              'changeMonth' => true,
          ],
          'htmlOptions' => [
              'style' => 'width:10em;',
              'readonly' => 'readonly',
          ],
        ]);
      ?>
    <?php echo CHtml::Button('Actualizar', array('onclick' => 'dateUpdateSP();')); ?> 
</div>
<div class="search-form">
<fieldset>
    <div>
    <?php echo CHtml::Button('Documentos', array('onclick' => 'ans=confirm("Está seguro de enviar el correo electronico Doc. ?");if (ans) {sendCorreoDoc();}')); ?>
    <b>Limite Formulario Dinámico Doc:</b>
    <?php 
      $this->widget('jqueryDateTime', [
          'name' => 'reciptExpiration',
          'value' => $model->reciptExpiration,
          // additional javascript options for the date picker plugin
          'options' => [
              'showAnim' => 'fold',
              'buttonText' => '...',
              'format' => 'Y-m-d H:i:s',
              'lang' => 'es',
              'showButtonPanel' => true,
              'changeYear' => true,
              'changeMonth' => true,
          ],
          'htmlOptions' => [
              'style' => 'width:10em;',
              'readonly' => 'readonly',
          ],
        ]);
      ?>
    <?php echo CHtml::Button('Actualizar', array('onclick' => 'dateUpdateDoc();')); ?> 
    </div>
</fieldset>
</div>

<?php
echo CHtml::button('Reporte', array(
    'id' => 'export-button',
    'class' => 'span-3 button',
    'onClick' => "window.open('" . Yii::app()->controller->createUrl('/backgroundCheck/dateRecover', array(
        '_exportTocharge' => true
    )) . "','_blank');"
));
?>
<br><br>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'background-check-grid',
    'htmlOptions' => array(),
    'dataProvider' => $model->searchRecover(50),
    'selectableRows' => 2,
    'filter' => $model,
    'columns' => array(
        array(
            'id' => 'selectedIds',
            'class' => 'CCheckBoxColumn'
        ),
        'studyStartedOn' => array(
            'name' => 'studyStartedOn',
            'header' => 'Solic',
            'value' => '("<div title=\"Solicitado en:[".$data->studyStartedOn."]  Límite en: [".$data->studyLimitOn."] Creado en:[".$data->created."] \">".substr($data->studyStartedOn,2,8)."</div>")',
            'type' => 'raw',
            'htmlOptions' => array('width' => '30px'),
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
        'mobile' => array(
            'name' => 'mobile',
            'header' => 'Celular',
            'value'=> '("<div>".$data->mobile ."</div>")',
            'type'=>'raw',
            'htmlOptions' => array('width' => '130px'),
        ),
        'email' => array(
            'name' => 'email',
            'header' => 'Correo',
            'value'=> '("<div>".$data->email."</div>")',
            'type'=>'raw',
            'htmlOptions' => array('width' => '130px'),
        ),
        array(
            'name' => 'document',
            'header' => 'Documentos',
            'value' => '$data->getDetailDocuments()',
            'type' => 'raw',
            'filter' => '',
            'htmlOptions' => array('width' => '100px'),
        ),
        'address' => array(
            'name' => 'address',
            'header' => 'Dirección',
            'value'=> '("<div>".$data->address."</div>")',
            'type'=>'raw',
            'htmlOptions' => array('width' => '130px'),
        ),
        'city' => array(
            'name' => 'city',
            'header' => 'Ciudad',
            'value'=> '("<div>".$data->city."</div>")',
            'type'=>'raw',
            'htmlOptions' => array('width' => '130px'),
        ),
        'validuntilFD' => array(
            'name' => 'validuntilFD',
            'header' => 'Limite FD SP',
            'value'=> '("<div>".$data->validuntilFD."</div>")',
            'type'=>'raw',
            'htmlOptions' => array('width' => '130px'),
        ),
        'statusFD' => array(
            'name' => 'statusFD',
            'header' => 'Estado FD SP',
            'value' =>  '($data->statusRecoverFDSP)',
            'type' => 'raw',
            'filter'=> CHtml::activeDropDownList($model, 'statusFD', Controller::$optionsRecover, array('prompt' => '...')),
            'htmlOptions' => array(
                'width' => '20px',
            ),
        ),
        'reciptExpiration' => array(
            'name' => 'reciptExpiration',
            'header' => 'Limite FD Doc.',
            'value'=> '("<div>".$data->reciptExpiration."</div>")',
            'type'=>'raw',
            'htmlOptions' => array('width' => '130px'),
        ),
        'reciptFileStatus' => array(
            'name' => 'reciptFileStatus',
            'header' => 'Estado FD Doc.',
            'value' =>  '($data->statusRecoverFDDoc)',
            'type' => 'raw',
            'filter'=> CHtml::activeDropDownList($model, 'reciptFileStatus', Controller::$optionsRecover, array('prompt' => '...')),
            'htmlOptions' => array(
                'width' => '20px',
            ),
        ),
        /*array(
            'name' => 'contactType',
            'header' => 'Contacto',
            'value' => '$data->getDetailContacts()',
            'type' => 'raw',
            'filter' => CHtml::activeDropDownList($model, 'contactType', CHtml::listData(ContactType::model()->findAll(array('condition' =>'id=1 OR id=2','order' => 'id')), 'id', 'Type'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '70px'),
        ),*/
        array(
            'name' => 'contactType',
            'header' => 'Envío Correos SP',
            'value' => '$data->getDetailContactsSP()',
            'type' => 'raw',
            'filter' => '',
            'htmlOptions' => array('width' => '70px'),
        ),
        array(
            'name' => 'contactType',
            'header' => 'Envío Correos Doc',
            'value' => '$data->getDetailContactsDoc()',
            'type' => 'raw',
            'filter' => '',
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
    function sendCorreoSP() {

        var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');
        var studiesCodes = [];

        if (studiesIds.length > 0) {
           
            jQuery.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl("contact/sendmassiveRecover"); ?>',
                data: {
                        'ids':studiesIds,
                        'val':1
                      },
                dataType: "json",
                success: function (data, status) {
                    if (typeof data.error === 'undefined') {
                        alert(data.error);
                    } else {
                        alert( data.ans);
                    }
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                    //alert('Se realizo el envío de correos electrónicos del soporte de pago con éxito.');
                    $.fn.yiiGridView.update("background-check-grid");
                },
            });

        } else {
            alert("Por favor selecciones los estudios a los que les enviara el correo electrónico SP.");
        }

       
    }


    function sendCorreoDoc() {

        var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');
        var studiesCodes = [];

        if (studiesIds.length > 0) {
        
            jQuery.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl("contact/sendmassiveRecover"); ?>',
                data: {
                        'ids':studiesIds,
                        'val':2
                    },
                dataType: "json",
                success: function (data, status) {
                    if (typeof data.error === 'undefined') {
                        alert(data.error);
                    } else {
                        alert( data.ans);
                    }
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                    //alert('Se realizo el envío de correos electrónicos de documentos con éxito.');
                    $.fn.yiiGridView.update("background-check-grid");
                },
            });

        } else {
            alert("Por favor selecciones los estudios a los que les enviara el correo electrónico Doc.");
        }
    }


    function dateUpdateSP() {

        var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');
        var studiesCodes = [];

        if (studiesIds.length > 0) {

            jQuery.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl("contact/updateValiduntilFDRecover"); ?>',
                data: {
                        'ids':studiesIds,
                        'val':1,
                        'datetime':$("#validuntilFD").val(),
                    },
                dataType: "json",
                success: function (data, status) {
                    if (typeof data.error === 'undefined') {
                        alert(data.error);
                    } else {
                        alert( data.ans);
                    }
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                    $("#validuntilFD").val('');
                    //alert('Se realizo el envío de correos electrónicos de documentos con éxito.');
                    $.fn.yiiGridView.update("background-check-grid");
                },
            });

        } else {
            alert("Por favor selecciones los estudios a los que les actualizara la fecha limite SP.");
        }
    }

    /*function dateUpdateSP() {
        var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');
        if (studiesIds.length > 0) {
            if (confirm("Está seguro de actualizar la fecha limite, para el vencimiento del formulario dinamico SP?")) {
                var a = document.createElement('a');
                a.href = '/contact/updateValiduntilFDRecover?' +
                        'val='+1 +
                        'ids='+studiesIds +
                        '&datetime=' + $("#validuntilFD").val();
                a.click();

                $(this).dialog("close");
            }
        }else {
            alert("Por favor selecciones los estudios a los que les enviara el correo electrónico SP.");
        }
    }*/

    function dateUpdateDoc() {
        var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');
        var studiesCodes = [];

        if (studiesIds.length > 0) {

            jQuery.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl("contact/updateValiduntilFDRecover"); ?>',
                data: {
                        'ids':studiesIds,
                        'val':2,
                        'datetime':$("#reciptExpiration").val(),
                    },
                dataType: "json",
                success: function (data, status) {
                    if (typeof data.error === 'undefined') {
                        alert(data.error);
                    } else {
                        alert( data.ans);
                    }
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                    $("#reciptExpiration").val('');
                    //alert('Se realizo el envío de correos electrónicos de documentos con éxito.');
                    $.fn.yiiGridView.update("background-check-grid");
                },
            });

        } else {
            alert("Por favor selecciones los estudios a los que les actualizara la fecha limite Doc.");
        }
        /*var studiesIds = $.fn.yiiGridView.getSelection('background-check-grid');

        if (studiesIds.length > 0) {
            if (confirm("Está seguro de actualizar la fecha limite, para el vencimiento del formulario dinamico Doc.?")) {
                var a = document.createElement('a');
                a.href = '/contact/updateValiduntilFDRecover?' +
                        'val='+2 +
                        'ids='+studiesIds +
                        '&datetime=' + $("#reciptExpiration").val();
                a.click();

                $(this).dialog("close");
            }
        }else {
            alert("Por favor selecciones los estudios a los que les enviara el correo electrónico Doc.");
        }*/
    }
</script>
