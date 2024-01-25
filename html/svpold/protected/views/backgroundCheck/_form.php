<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ProcessView.css" />
<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
    <br/>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('notification')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
    <br/>
<?php endif; ?>
<?php
Yii::app()->clientScript->registerScript('countDown', "
 var varFunctionKey=function(){
    if (keyCounter>0){
        $.post( '" . $this->createUrl('/backgroundCheck/updating', array('code' => $model->code)) . "', {keys:keyCounter},function() {
            keyCounter=0;
            inactivityCounter=0;
        });
    }else {
       inactivityCounter++;
       if (inactivityCounter*" . SES_SESSION_KEYBOARD_CHECK . ">=" . SES_SESSION_TIME_OUT . "){
//           window.location.href = '" . $this->createUrl('/site/logout') . "';
       }else  if (inactivityCounter>=" . (SES_SESSION_TIME_OUT / SES_SESSION_KEYBOARD_CHECK) . "-1.1){
            var msg= 'La sesión se cerrará en '+(" . SES_SESSION_TIME_OUT . "-inactivityCounter*" . SES_SESSION_KEYBOARD_CHECK . ")+' segundos si no guarda cambios.';
            var el = document.createElement('div');
            el.setAttribute('id','alertTimeOut');
            el.innerHTML = msg;
            setTimeout(function(){
//             el.parentNode.removeChild(el);
            },5000);
            document.body.appendChild(el);
            $( '#alertTimeOut' ).dialog();
       }
    }
 }
     
window.setInterval(varFunctionKey, " . (SES_SESSION_KEYBOARD_CHECK * 1000) . " );

var keyCounter=0;
var inactivityCounter=0;

$( 'body' ).keypress(function() {
  keyCounter++;
});
");
?>

<?php
$RequestSAC = RequestsSAC::model()->findByAttributes(array('backgroundcheckId' => $model->id));
if($RequestSAC):
    if($RequestSAC->backgroundcheckId==$model->id && $RequestSAC->status!="Entregado" && $RequestSAC->dateRequest>='2023-01-01'): ?>
            <?php echo '<script language="javascript">alert("Estudio priorizado por SAC");</script>'; ?>
            <?php  if($RequestSAC->observation!=""): ?>
                <div class="flash-error">
                    <?php echo $RequestSAC->observation; ?>
                </div>
            <?php endif; ?>
    <?php endif; ?>
<?php endif; 

$customer = Customer::model()->findByAttributes(array('id' => $model->customerId, 'customerGroupId'=>'941'));
if($customer):
    if($customer->dateValidation==null || $customer->dateValidation=='0000-00-00' && $customer->isActive==1): ?>
        <div class="flash-error">
            <?php echo "EL CLIENTE NO HA SIDO VALIDADO."; ?>
        </div>
    <?php elseif(($customer->dateValidation!=null || $customer->dateValidation!='0000-00-00') && $customer->isActive==0): ?>
        <div class="flash-error">
            <?php echo "SE ENCONTRO HALLAZGO EN EL CLIENTE, POR FAVOR NO CONTINUAR CON EL PROCESO."; ?>
        </div>    
    <?php elseif(($customer->dateValidation!=null || $customer->dateValidation!='0000-00-00') && $customer->isActive==1): ?>
        <div class="flash-success">
            <?php echo "EL CLIENTE HA SIDO VALIDADO CON ÉXITO."; ?>
        </div>    
    <?php endif; ?>
<?php endif; 

if (!$model->isNewRecord) {
    if ($model->startStudy==0 && $model->customer->isRecover==1): ?>
        <div class="flash-error">
            <?php echo "Verifique el archivo de soporte de pago en la pestaña Documentos, para iniciar con el estudio de seguridad comuniquese con los encargados del proyecto."; ?>
        </div>      
    <?php endif; 
}

$tabs = array();
if (!$companySurvey) {
    $tabs['Información General'] = $this->renderPartial('_generalDataForm', array(
        'model' => $model,
        'pc' => $pc,
            ), TRUE);
} else {
    $tabs['Información General'] = $this->renderPartial('_generalDataFormCompany', array(
        'model' => $model,
        'pc' => $pc,
            ), TRUE);
}

$selectedTab = 0;

if (!$model->isNewRecord) {
    $tabs['Asignación'] = $this->renderPartial('/assignedUser/_assignedUsers', array(
        'model' => $model,
        'pc' => $pc,
            ), TRUE);

    if (!$pc) {

        if ($model->customerProduct->hasXmlQuestion()) {
            $tabs['Preguntas'] = $this->renderPartial('/xmlQuestion/_xmlQuestions', array('model' => $model), TRUE);
        }

        foreach ($model->verificationSections as $verificationSection) {
            if (Yii::app()->user->getIsByRole()) {
                if(Yii::app()->user->getHasGlobalPermissionTo(Permission::ESTUDIO_SENIOR) || Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS)){
                    $title = CHtml::encode($verificationSection->verificationSectionType->name) . "[" . CHtml::encode($verificationSection->percentCompleted) . "%]";
                    $tabs[$title] = $this->renderPartial('/verificationSection/_verificationSection', array('verificationSection' => $verificationSection), TRUE);
                    if ($verificationSection->id == $activeTab) {
                        $selectedTab = count($tabs) - 1;
                    }

                }else if($verificationSection->userHasAccess(Yii::app()->user->arUser->id)){
                    $title = CHtml::encode($verificationSection->verificationSectionType->name) . "[" . CHtml::encode($verificationSection->percentCompleted) . "%]";
                    $tabs[$title] = $this->renderPartial('/verificationSection/_verificationSection', array('verificationSection' => $verificationSection), TRUE);
                    if ($verificationSection->id == $activeTab) {
                        $selectedTab = count($tabs) - 1;
                    }
                }
               
            }else  if (Yii::app()->user->isAdmin || $verificationSection->userHasAccess(Yii::app()->user->arUser->id)) {
                $title = CHtml::encode($verificationSection->verificationSectionType->name) . "[" . CHtml::encode($verificationSection->percentCompleted) . "%]";
                $tabs[$title] = $this->renderPartial('/verificationSection/_verificationSection', array('verificationSection' => $verificationSection), TRUE);
                if ($verificationSection->id == $activeTab) {
                    $selectedTab = count($tabs) - 1;
                }
            }
        }

        $tabs['Documentos'] = $this->renderPartial('/document/_documents', array(
            'documents' => $model->documents,
            'backgroundCheck' => $model,
                ), TRUE
        );
        if ($activeTab === 'assignedUsers') {
            $selectedTab = 1;
        }
        if ($activeTab === 'xmlQuestion') {
            $selectedTab = 2;
        }
        if ($activeTab === 'docs') {
            $selectedTab = count($tabs) - 1;
        }
    }

    $tabs['Novedades[' . count($model->events) . ']'] = array(
        'content' => $this->renderPartial('/event/_events', array(
            'events' => $model->events,
            'backgroundCheck' => $model,
            'pc' => $pc,
                ), TRUE),
        'id' => 'eventsTab',
    );

    $servicios = ServiceResponse::model()->findAll("code='$model->code'");
    $content = '';
    if(count($servicios)!=0){
        foreach($servicios as $servicio){
            $content .= $this->renderPartial('/serviceResponse/view', array(
                    'model' => $servicio,
                    'codigo' => $model->code,
                    'backgroundCheck' => $model,
                        ), TRUE);
        }
    }
    else {
        $servicio = ServiceResponse::model()->find("code='$model->code'");
        $content = $this->renderPartial('/serviceResponse/view', array(
                    'model' => $servicio,
                    'codigo' => $model->code,
                    'backgroundCheck' => $model,
                        ), TRUE);
    }
    // Se incluye la pestaña de Servicios Web en el formulario
    /*$tabs['Servicios'] = array(
        'content' => $content,
        'id' => 'serviceTab',
    );*/
    if(Yii::app()->user->name== 'jcocoma@sintecto.com' || Yii::app()->user->name== 'ngonzalez@svision.co' || Yii::app()->user->name== 'jospina@svision.co' ||
        Yii::app()->user->name== 'agutierrez@svision.co' || Yii::app()->user->name== 'fperez@sintecto.com' || Yii::app()->user->name== 'sromero@sintecto.com' ||
        Yii::app()->user->name== 'mflorez@svision.co' || Yii::app()->user->name== 'srodriguez@verificacion.co' || Yii::app()->user->name== 'ncamargo@verificacion.co' || Yii::app()->user->name== 'solmos@verificacion.co' || Yii::app()->user->name == 'nhenao@sintecto.com'){
        $tabs['Facturación'] = array(
            'content' => $this->renderPartial('/customerProduct/_FacturacionDescription', array(
                'customerProduct' => $model->customerProduct,
            ), TRUE),
            'id' => 'facturaDescription',
        );
    }

    $tabs['Glosario'] = array(
        'content' => $this->renderPartial('/customerProduct/_GlosarioDescription', array(
            'customerProduct' => $model->customerProduct,
        ), TRUE),
        'id' => 'glosarioDescription',
    );

    $tabs['Instrucciones'] = array(
        'content' => $this->renderPartial('/customerProduct/_productDescription', array(
            'customerProduct' => $model->customerProduct,
                ), TRUE),
        'id' => 'productDescription',
    );

        $tabs['Contacto'] = array(
            'content' => $this->renderPartial('/contact/_contacts', array(
                'contacts' => $model->contacts,
                'backgroundCheck' => $model,
                'pc' => $pc,
            ), TRUE),
            'id' => 'contactsTab',
        );
        
    }

if ($activeTab === 'contacts') {
    $selectedTab = count($tabs) - 1;
}

if ($activeTab === 'events') {
    $selectedTab = count($tabs) - 5;
}

$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs' => $tabs,
    // additional javascript options for the tabs plugin
    'options' => array(
        'collapsible' => true,
        'active' => $selectedTab,
    ),
));
?>
<div style="float:right">
    <?php if (Yii::app()->user->isManager) : ?>
        <?php if ($model->reportAvailable && !$model->inAmendment) : ?>
            <?php if (Yii::app()->user->name == 'jcocoma@sintecto.com' || Yii::app()->user->name == 'nhenao@sintecto.com' || Yii::app()->user->name == 'ngonzalez@svision.co') : ?>
                <?php echo CHtml::button('Enmendar', array('submit' => array('backgroundCheck/initAmendment', 'code' => $model->code, 'valor' => ''))); ?>
                <?php echo CHtml::button('Log', array('submit' => array('log/admin', 'code' => $model->code, 'valor' => ''))); ?>
            <?php else : ?>
                <?php if ($model->approvedOn > '2021-12-31') : ?>
                    <?php echo CHtml::button('Enmendar', array('submit' => array('backgroundCheck/initAmendment', 'code' => $model->code, 'valor' => ''))); ?>
                    <?php echo CHtml::button('Log', array('submit' => array('log/admin', 'code' => $model->code, 'valor' => ''))); ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?> <?php if (Yii::app()->user->isManager) : ?>
        <?php if ($model->reportAvailable && $model->inAmendment) : ?>
            <?php echo CHtml::button('Guardar Enmienda', array('submit' => array('backgroundCheck/finishAmendment', 'code' => $model->code, 'valor' => '1'), 'class' => 'InAmendment')); ?>
        <?php endif; ?>
    <?php endif; ?>
</div>