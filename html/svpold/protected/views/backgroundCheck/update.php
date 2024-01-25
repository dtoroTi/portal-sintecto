<?php
/* @var $model BackgroundCheck */
if(!Yii::app()->user->isValidUser){
     $this->redirect('/noallowed.html');
} ?>



<?php if ($model->observationToCustomer != null & $model->resultId==1): ?>
    <div class="flash-error">

    <?php echo 'El cliente Genero el siguiente comentario: <br><br>!! '.$model->observationToCustomer.' !!';?>

   <?php endif; ?>

</div>

<?php 

$this->breadcrumbs = array(
    'Estudios' => array($pc ? 'pcAdmin' : 'admin'),
    CHtml::encode($model->code) => array('update', 'code' => CHtml::encode($model->code)),
    'Actualizar',
);

if (!$model->canUpdate) {
    Yii::app()->clientScript->registerScript('search', "
  $('#backgroundCheckDetailDiv :input').prop('disabled', true);
    ", CClientScript::POS_LOAD);
}
?>
<?php if ($model->inAmendment) : ?>
    <h1>
        <span id="logoServer">&nbsp; ** EN ENMIENDA **</span>
    </h1>
<?php endif; ?>


<?php if (Yii::app()->user->hasFlash('backgroundCheck')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('backgroundCheck'); ?>
    </div>
<?php endif; ?>

<?php
$image = $model->frontPageImage;

if ($image) {
    $imageLink = CHtml::link('Ver Foto', array('/document/file', 'id' => $image->id), array('target' => '_blank'));
} else {
    $imageLink = '';
}
?>

<div class="ReportHeader">
    <div class="StudyName"><?php echo substr(CHtml::encode($model->fullName), 0, 200); ?>&nbsp;&nbsp;[<?php echo $model->code; ?>] (<?php echo CHtml::encode($model->total) ?>%):<?php echo $imageLink; ?></div> 

    <?php $otherReports = $model->getOtherReportsOfPerson(); ?>
    <?php if (count($otherReports) >= 1): ?>

        <div class="OtherStudies">
            <br/>
            Otros estudios: 
            <?php foreach ($otherReports as $report): ?>
                [<?php echo CHtml::link($report->code, array('/backgroundCheck/update', 'code' => $report->code)); ?> ,
                <div class="<?= ($report->resultId == $model->resultId ? 'PlainResult' : 'AlertResult') ?>">
                    <?= CHtml::encode($report->result->nick) ?>
                </div>
                ], &nbsp;
            <?php endforeach ?>
        </div>

    <?php endif ?>
</div>
<div class="ReportButtons">
    <?php
    if (!$model->reportAvailable) {
        echo CHtml::button('Ver Temp.', array('onclick' =>
            "var a = document.createElement('a');a.href='/backgroundCheck/viewPdf?code=" . $model->code . "&valor=1';a.target = '_blank';document.body.appendChild(a);a.click();"));
        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {
            if ($model->backgroundCheckStatusId == BackgroundCheckStatus::FINISHED) {
                echo CHtml::button('Ver Cert. Temp.', array('onclick' =>
                    "var a = document.createElement('a');a.href='/backgroundCheck/viewCertPdf?code=" . $model->code . "';a.target = '_blank';document.body.appendChild(a);a.click();"));
            }
            if (!$model->temporalReportAvailable) {
                echo CHtml::button('Publ. Temp.', array('onclick' =>
                    'ans=confirm("Está seguro de publicar el reporte de' . $model->fullName .
                    '?");if (ans) {document.location.href="/backgroundCheck/publishTemporalReport?code=' . $model->code . '&pc=' . $pc . '&valor=1";}'));
            } else {
                echo CHtml::button('Borrar Temp.', array('onclick' =>
                    'ans=confirm("Está seguro de borrar el reporte temporal de' . $model->fullName .
                    '?");if (ans) {document.location.href="/backgroundCheck/deleteTemporalReport?code=' . $model->code . '&pc=' . $pc . '";}'));
            }
        }
    }
    if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

        echo CHtml::button('Ver Reporte sin Doc.', array('onclick' =>
        "var a = document.createElement('a');a.href='/backgroundCheck/viewPdfSindoc?code=" . $model->code . "&valor=2';a.target = '_blank';document.body.appendChild(a);a.click();"));

        if ($model->inAmendment) {
            echo CHtml::button('Ver Temp. Enmienda', array('onclick' =>
                "var a = document.createElement('a');a.href='/backgroundCheck/viewPdf?code=" . $model->code . "&valor=1';a.target = '_blank';document.body.appendChild(a);a.click();"
                , 'class' => 'InAmendment'));
        }
        if ($model->getCanBeApproved()) {
            echo CHtml::button('Aprobar', array('onclick' => 'ans=confirm("Está seguro de aprobar el informe de ' . $model->fullName . '?");'
                . ($model->price < BackgroundCheckController::MINIMUN_PRICE ? 'ans=confirm("El informe no tiene VALOR. Desea continuar?");' : '')
                . 'if (ans) {document.location.href="/backgroundCheck/approve?code=' . $model->code . '&pc=' . $pc . '";}'));
        }
        if ($model->isApproved) {
            if (!$model->reportAvailable) {
                echo CHtml::button('Cancelar Aprob.', array('onclick' => 'ans=confirm("Está seguro de cancelar la aprobación del informe de ' .
                    $model->fullName . '?");if (ans) {document.location.href="/backgroundCheck/disapprove?code=' .
                    $model->code . '&pc=' . $pc . '";}', 'disabled' => ($model->invoice ? 'disabled' : '')));
            } else if (Yii::app()->user->isReportManager) {
                echo CHtml::button('Cancelar Publicación', array('onclick' => 'ans=confirm("Está seguro de cancelar la aprobación del informe de ' .
                    $model->fullName . '?");if (ans) {document.location.href="/backgroundCheck/disapprove?code=' .
                    $model->code . '&pc=' . $pc . '";}', 'disabled' => ($model->invoice ? 'disabled' : '')));
            }
            if ($model->reportAvailable) {
//        echo CHtml::link('Final', array('/backgroundCheck/reportPdf', 'code' => $model->code), array('target' => '_blank'));
                echo CHtml::button('Ver Reporte Final', array('onclick' =>
                    "var a = document.createElement('a');a.href='/backgroundCheck/reportPdf?code=" . $model->code . "&valor=1';a.target = '_blank';document.body.appendChild(a);a.click();"));

                if($model->customerId==777){ //777
                    //NATALIA HENAO 30/07/2021
                    //Boton workflow grupo zona franca
                    echo CHtml::button('Workflow', array('onclick' =>'ans=confirm("Está seguro de envíar los datos de '.$model->fullName.' al Grupo Zona Franca Bogotá?");'.($model->WorkflowID != null ? 'ans=alert("Los datos de este estudio ya fueron enviados anteriormente, Id Workflow: '.$model->WorkflowID.'");' : '').'if (ans) {document.location.href="/backgroundCheck/newWorflow?code=' . $model->code . '&pc=' . $pc . '&valor=1";}'));
                }

            } else {
                echo CHtml::button('Publ. Rep.', array('onclick' =>
                    'ans=confirm("Está seguro de publicar el reporte de' . $model->fullName .
                    '?");if (ans) {document.location.href="/backgroundCheck/publishReport?code=' . $model->code . '&pc=' . $pc . '&valor=1";}'));
            }
            if ($model->certificateAvailable) {
//        echo CHtml::link('Final', array('/backgroundCheck/reportPdf', 'code' => $model->code), array('target' => '_blank'));
                echo CHtml::button('Ver Cert', array('onclick' =>
                    "var a = document.createElement('a');a.href='/backgroundCheck/reportCertPdf?code=" . $model->code . "';a.target = '_blank';document.body.appendChild(a);a.click();"));
            } elseif ($model->deliveredToCustomerOn && $model->canPublishCertificate) {
                echo CHtml::button('Publicar Cert.', array('onclick' =>
                    'ans=confirm("Está seguro de publicar el certificado de ' . $model->fullName .
                    '?");if (ans) {document.location.href="/backgroundCheck/publishCert?code=' . $model->code . '&pc=' . $pc . '";}'));
            }
        }
    }
    ?>
</div>
<div id = "backgroundCheckDetailDiv">
    <?php
    echo $this->renderPartial('_form', array(
        'model' => $model,
        'activeTab' => $activeTab,
        'pc' => $pc,
        'companySurvey' => $model->isCompanySurvey,
    ));
    ?>
</div>