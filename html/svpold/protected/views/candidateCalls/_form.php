<?php
/* @var $this CandidateCallsController */
/* @var $model CandidateCalls */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'candidate-calls-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campo <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

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
				<th>Resultado Componentes</th> 
				<th>cargo</th> 
			</thead> 
			<tbody id="myTable">
				<td><?php echo $model->backgroundcheck->customer->name; ?></td> 
				<td><?php echo CHtml::link( $model->backgroundcheck->code,array('backgroundCheck/update','code'=> $model->backgroundcheck->code), array("target" => "_blank"))?></td> 
				<td><?php echo ($model->backgroundcheck->formatedIdNumber.(count($model->backgroundcheck->otherReportsOfPerson)>0?"<div class=MultipleStudies>**</div>":"").($model->backgroundcheck->inAmendment?"<div class=MultipleStudies>*ENM*</div>":"").($model->backgroundcheck->blacklist?"<div class=MultipleStudies>*LN*</div>":"")); ?></td> 
				<td><?php echo $model->backgroundcheck->city; ?></td> 
				<td><?php echo ($model->backgroundcheck->firstName.' '.$model->backgroundcheck->lastName.(count($model->backgroundcheck->otherReportsOfPerson)>0?"<div class=MultipleStudies>[**Rep]</div>":"")) ?></td> 
				<td><?php echo $model->backgroundcheck->email; ?></td> 
				<td><?php echo $model->backgroundcheck->tels; ?></td> 
				<td><?php echo $model->backgroundcheck->customerProduct->preliminary?"Si":"No"; ?></td> 
				<td><?php echo $model->backgroundcheck->customerProduct->name; ?></td> 
				<td><?php echo $model->backgroundcheck->percentageSummaryAdv; ?></td> 
				<td><?php echo $model->backgroundcheck->applyToPosition; ?></td> 
			</tbody> 
		</table> 
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateRegistrationEffective'); ?>
		<?php 
			$this->widget('jqueryDateTime', [
				'name' => 'CandidateCalls[dateRegistrationEffective]',
				'value' => $model->dateRegistrationEffective,
				'id'=>'dateRegistrationEffective',
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
				],
				]);
		?>
		<?php echo $form->error($model,'dateRegistrationEffective'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'dateRegistrationNotEffective'); ?>
		<?php 
			$this->widget('jqueryDateTime', [
				'name' => 'CandidateCalls[dateRegistrationNotEffective]',
				'value' => $model->dateRegistrationNotEffective,
				'id'=>'dateRegistrationNotEffective',
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
				],
				]);
		?>
		<?php echo $form->error($model,'dateRegistrationNotEffective'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'observation'); ?>
		<?php echo $form->textArea($model, 'observation', array('rows' => 5, 'cols' => 145)); ?>
		<?php echo $form->error($model,'observation'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model, 'confirmationVisitId'); ?>
        <?php echo $form->dropDownList($model, 'confirmationVisitId', 
		CHtml::listData(User::model()->findAll(
				array(
					'order' => 'firstName',
					'condition' => 'callManager=:idvalue',
					'params' => array(':idvalue' => 1))
		), 'id', 'summaryLine'), array('prompt' => '...'));
        ?>
        <?php echo $form->error($model, 'confirmationVisitId'); ?>
    </div>
	
	<div class="row">
        <?php echo $form->labelEx($model, 'typeVisit'); ?>
        <?php
        echo $form->dropdownList($model, //
            'typeVisit', //
            array(
                '' => '...',
                'OEA' => 'OEA',
                'Preempleo' => 'Preempleo',
                'Rutina' => 'Rutina',
				'Basc Rutina' => 'Basc Rutina',
                'OEA-Preempleo' => 'OEA-Preempleo',
				'Personal Activo' => 'Personal Activo',
				'N/A' => 'N/A'
            )
        );
        ?>
        <?php echo $form->error($model, 'typeVisit'); ?>
    </div>

	<div class="row">
        <?php echo $form->labelEx($model, 'authorizationFormat'); ?>
        <?php
        echo $form->dropdownList($model, //
            'authorizationFormat', //
            array(
                '' => '...',
                'Con Financiero' => 'Con Financiero',
                'Sin Financiero' => 'Sin Financiero',
				'N/A' => 'N/A',
            )
        );
        ?>
        <?php echo $form->error($model, 'authorizationFormat'); ?>
    </div>

	<div class="row">
        <?php //echo $form->labelEx($model, 'responsibleVisitId'); ?>
        <?php //echo $form->dropDownList($model, 'responsibleVisitId', CHtml::listData(User::model()->findAll(
				//array(
					//'order' => 'firstName')
		//), 'id', 'summaryLine'), array('prompt' => '...'));
        ?>
        <?php //echo $form->error($model, 'responsibleVisitId'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model, 'responsibleVisitId'); ?>
		<?php 
			if($model->responsibleVisitId!=''){
				$value=$model->responsibleVisit->summaryLine;
			}else{
				$value='';
			}
		    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name' => 'CandidateCalls[responsibleVisitId]',
				'source' => $this->createUrl('candidateCalls/autocompleteUserResp'),
				'value' => $value,
				// additional javascript options for the autocomplete plugin
				'options' => array(
					'minLength' => '2',
					'select' => "js:function(event, ui) {
								  $('#id').val(ui.item.id);
								}",
					//'onchange'=>'habilitar(this.id)',
				),
				'htmlOptions' => array(
					'style' => 'height:15px;width:430px;',
				),
			));
			echo $form->hiddenfield($model, 'responsibleVisitId', array('id'=>'id'));
		?>
			<?php echo $form->error($model, 'responsibleVisitId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visitProgramdate'); ?>
		<?php 
			$this->widget('jqueryDateTime', [
				'name' => 'CandidateCalls[visitProgramdate]',
				'value' => $model->visitProgramdate,
				'id'=>'visitProgramdate',
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
				],
				]);
		?>
		<b>Forma de Visita:</b>
		<?php
        echo $form->dropdownList($model, //
            'formVisit', //
            array(
                '' => '...',
                'Virtual' => 'Virtual',
                'Presencial' => 'Presencial',
            )
        );
        ?>
		<?php echo $form->error($model,'formVisit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'referenceAddress'); ?>
		<?php echo $form->textField($model,'referenceAddress',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'referenceAddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'neighborhood'); ?>
		<?php echo $form->textField($model,'neighborhood',array('size'=>60,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'neighborhood'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'availability'); ?>
		<?php echo $form->textField($model,'availability',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'availability'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'availabilitydate'); ?>
		<?php 
			$this->widget('jqueryDateTime', [
				'name' => 'CandidateCalls[availabilitydate]',
				'value' => $model->availabilitydate,
				'id'=>'availabilitydate',
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
				],
				]);
		?>
		<?php echo $form->error($model,'availabilitydate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'statusVisit'); ?>
		<?php
        echo $form->dropdownList($model, //
            'statusVisit', //
            array(
                'PENDIENTE' => '...',
				'No Aplica' => 'No Aplica',
                'Visita Ok' => 'Visita Ok',
                'Programada' => 'Programada',
				'Sin Realizar' => 'Sin Realizar',
				'En Proceso' => 'En Proceso'
            )
        );
        ?>
		<?php echo $form->error($model,'statusVisit'); ?>

		<b>Tipo de Novedad:</b>
		<?php
        echo $form->dropdownList($model, //
            'typeEvent', //
            array(
                '' => '...',
				'Visita' => 'Visita',
                'Documentos' => 'Documentos',
                'Visita-Documentos' => 'Visita y Documentos',
            )
        );
        ?>
		<?php echo $form->error($model,'typeEvent'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->