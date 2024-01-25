<?php
/* @var $this CandidateCallsController */
/* @var $model CandidateCalls */
/* @var $form CActiveForm */
?>

<div class="form  wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'candidate-calls-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<b>Datos del Estudio de Seguridad</b>
	<div class="modal-body">
		<table id="detailresultqualitySection" cellspacing="0" style="width: 85%;" class="table table-sm table-striped table-hover table-bordered">
			<thead class="table-primary"> 
				<th>Cliente</th> 
				<th>Ref.</th> 
				<th>No. ID</th> 
				<th>Ciudad</th> 
				<th>Candidato</th> 
				<th>Correo Electronico</th> 
				<th>Telefono</th> 
				<th>Es preliminar</th> 
				<th>Componente</th> 
				<th>Adverso</th> 
				<th>cargo</th> 
			</thead> 
			<tbody id="myTable">
				<td><?php echo $model->backgroundcheck->customer->name; ?></td> 
				<td><?php echo CHtml::link( $model->backgroundcheck->code,array('backgroundCheck/update','code'=> $model->backgroundcheck->code), array("target" => "_blank"))?></td> 
				<td><?php echo $model->backgroundcheck->idNumber; ?></td> 
				<td><?php echo $model->backgroundcheck->city; ?></td> 
				<td><?php echo $model->backgroundcheck->firstName.' '.$model->backgroundcheck->lastName; ?></td> 
				<td><?php echo $model->backgroundcheck->email; ?></td> 
				<td><?php echo $model->backgroundcheck->tels; ?></td> 
				<td><?php echo $model->backgroundcheck->customerProduct->preliminary?"Si":"No"; ?></td> 
				<td><?php echo $model->backgroundcheck->customerProduct->name; ?></td> 
				<td><?php echo $model->backgroundcheck->percentageSummaryAdv; ?></td> 
				<td><?php echo $model->backgroundcheck->applyToPosition; ?></td> 
			</tbody> 
		</table> 
	</div><br>
	
	<div class="row">
        <?php echo $form->labelEx($model, 'callManagerId'); ?>
        <?php echo $form->dropDownList($model, 'callManagerId', CHtml::listData(User::model()->findAll(
				array(
					'order' => 'firstName',
					'condition' => 'callManager=:idvalue',
					'params' => array(':idvalue' => 1))
		), 'id', 'summaryLine'), array('prompt' => '...'));
        ?>
        <?php echo $form->error($model, 'callManagerId'); ?>
    </div>

	<div class="row">
        <?php echo $form->labelEx($model, 'callReschedulingManagerId'); ?>
        <?php echo $form->dropDownList($model, 'callReschedulingManagerId', 
		CHtml::listData(User::model()->findAll(
				array(
					'order' => 'firstName',
					'condition' => 'callManager=:idvalue',
					'params' => array(':idvalue' => 1))
		), 'id', 'summaryLine'), array('prompt' => '...'));
        ?>
        <?php echo $form->error($model, 'callReschedulingManagerId'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateCreate'); ?>
		<?php 
			$this->widget('jqueryDateTime', [
				'name' => 'CandidateCalls[dateCreate]',
				'value' => $model->dateCreate,
				'id'=>'dateCreate',
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
		<?php echo $form->error($model,'dateCreate'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'statusVisit'); ?>
		<?php echo CHtml::encode($model->statusVisit) ?>
		<?php echo $form->error($model,'statusVisit'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->