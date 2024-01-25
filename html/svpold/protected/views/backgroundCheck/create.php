<?php
//comment
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}

$this->breadcrumbs = array(
    'Background Checks' => array('admin'),
    'Create',
);
?>

<?php if (!$companySurvey): ?>
    <h1>Crear un Estudio de Seguridad</h1>
<?php else: ?>
    <h1>Crear un Estudio de Seguridad de Empresa</h1>
<?php endif; ?>

<?php echo $this->renderPartial('_form', array('model' => $model, 'activeTab' => $activeTab, 'pc' => $pc, 'companySurvey' => $companySurvey)); ?>
