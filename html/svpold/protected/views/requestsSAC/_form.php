<?php
/* @var $this AttachmentFileController */
/* @var $model AttachmentFile */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'RequestsSAC-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'userId'); ?>
		<?php echo Yii::app()->user->arUser->name; ?>
		<?php echo $form->hiddenField($model, 'userId',array('value'=>Yii::app()->user->arUser->id,'readonly'=>"readonly")); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'backgroundcheckId'); ?>
		<?php if ($model->isNewRecord): 
		    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name' => 'requestsSAC[backgroundcheckId]',
				'source' => $this->createUrl('requestsSAC/autocompleteAllActiveCode'),
				// additional javascript options for the autocomplete plugin
				'options' => array(
					'minLength' => '2',
					'select' => "js:function(event, ui) {
								  $('#id').val(ui.item.id);
								  habilitar($('#id').val());
								}",
					//'onchange'=>'habilitar(this.id)',
				),
				'htmlOptions' => array(
					'style' => 'height:20px;width:200px;',
				),
			));
			echo $form->hiddenfield($model, 'backgroundcheckId', array('id'=>'id'));
		?>
		<?php else: ?>
			<?php echo CHtml::encode($model->backgroundcheck->code) ?>
		<?php endif; ?>
	</div>

	<b>Datos del Estudio de Seguridad</b>
	<div class="modal-body">
		<table id="detailresultqualitySection" cellspacing="0" style="width: 85%;" class="table table-sm table-striped table-hover table-bordered">
			<thead class="table-primary"> 
				<th>Linea de Negocio</th> 
				<th>Cliente</th> 
				<th>Producto</th> 
				<th>Ref.</th> 
				<th>No. ID</th> 
				<th>Nombre Candidato</th> 
				<th>Cargo</th> 
			</thead> 
		<?php if ($model->isNewRecord): ?>
			<tbody id="myTable"></tbody> 
		<?php else: ?>
			<tbody id="myTable">
				<td><?php echo $model->backgroundcheck->customer->businessLine; ?></td> 
				<td><?php echo $model->backgroundcheck->customer->name; ?></td> 
				<td><?php echo $model->backgroundcheck->customerProduct->name; ?></td> 
				<td><?php echo CHtml::link( $model->backgroundcheck->code,array('backgroundCheck/update','code'=> $model->backgroundcheck->code), array("target" => "_blank"))?></td> 
				<td><?php echo $model->backgroundcheck->idNumber; ?></td> 
				<td><?php echo $model->backgroundcheck->firstName.' '.$model->backgroundcheck->lastName; ?></td> 
				<td><?php echo $model->backgroundcheck->applyToPosition; ?></td> 
			</tbody> 
	<?php endif; ?>
	</table> 
	</div>

	<div class="row">
        <?php echo $form->labelEx($model, 'typeRequest'); ?>
		<?php if ($model->isNewRecord): 
        echo $form->dropdownList($model, //
            'typeRequest', //
            array(
                '' => '...',
                'VIP' => 'VIP',
                //'VIP - Prioritario' => 'VIP - Prioritario',
                //'Prioritario' => 'Prioritario',
                'Inmediato' => 'Inmediato'
            )
        );
		 else: ?>
			<?php echo CHtml::encode($model->typeRequest) ?>
		<?php endif; ?>
        <?php echo $form->error($model, 'typeRequest'); ?>
    </div>

	<div>
	<div class="row">
        <?php echo $form->labelEx($model, 'dateRequest'); ?>
        <?php
		$this->widget('jqueryDateTime', [
			'name' => 'RequestsSAC[dateRequest]',
			'value' => $model->dateRequest,
			'id'=>'dateRequest',
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
				'style' => 'height:20px;',
			],
			]);
        ?>
        <?php echo $form->error($model, 'dateRequest'); ?>
    </div>
	</div>

	
	<div>
		<?php echo $form->labelEx($model, 'dateAnswer'); ?>
		<?php
		$this->widget('jqueryDateTime', [
			'name' => 'RequestsSAC[dateAnswer]',
			'value' => $model->dateAnswer,
			'id'=>'dateAnswer',
			// additional javascript options for the date picker plugin
			'options' => array(
				'showAnim' => 'fold',
				'buttonText' => '...',
				'dateFormat' => 'Y-m-d H:i:s',
				'showButtonPanel' => true,
				'changeYear' => true,
				'changeMonth' => true,
				'onSelect'=> 'js:function( visitedDate ) {
					validaDias($("#dateAnswer").val(), $("#dateRequest").val());
			   	}', 
				// 'maxDate' => "+0D",
			),
			'htmlOptions' => array(
				'style' => 'height:20px;',
				'readonly' => 'readonly',
			),
		]);
		?>
		<?php echo $form->error($model, 'dateAnswer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'deliveryDays'); ?>
		<?php if ($model->isNewRecord): ?>
		<?php else: ?>
			<?php 
				/*$date1 = new DateTime($model->dateRequest);
				$date2 = new DateTime($model->dateAnswer);
				$diff = $date1->diff($date2);*/
				echo $form->textfield($model, 'deliveryDays',array('id'=>'deliveryDays'));
			?>
		<?php endif; ?>
		<?php echo $form->error($model, 'deliveryDays'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model, 'shockedby'); ?>
        <?php
        echo $form->dropdownList($model, //
            'shockedby', //
            array(
                '' => '...',
                'Académico' => 'Académico',
                'Visita' => 'Visita',
                'Laboral' => 'Laboral',
                'Financiero' => 'Financiero',
				'Adversos' => 'Adversos',
				'Localizador' => 'Localizador',
				'Polígrafo' => 'Polígrafo',
				'Pruebas' => 'Pruebas',
				'Todo' => 'Todo',
				'Socios'=>'Socios',
				'Clientes'=>'Clientes',
				'Proveedores'=>'Proveedores',        
				'Visita empresa'=>'Visita empresa',
				'Central de Riesgo'=>'Central de Riesgo',
				'Financiero'=>'Financiero',
				'Documentos'=>'Documentos'
            )
        );
        ?>
        <?php echo $form->error($model, 'shockedby'); ?>
    </div>

	<div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php
        echo $form->dropdownList($model, //
            'status', //
            array(
                'Pendiente' => 'Pendiente',
                'Entregado' => 'Entregado',
                'En Gestión' => 'En Gestión',
                'Ent. Parcial' => 'Ent. Parcial',
				'Recomendado a OPS' => 'Recomendado a OPS',
				'Informado a OPS' => 'Informado a OPS',
				'No aplica' => 'No aplica'
            )
        );
        ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model, 'dateUpdate'); ?>
		<?php echo CHtml::encode($model->dateUpdate) ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model, 'observation'); ?>
        <?php echo $form->textArea($model, 'observation', array('rows' => 5, 'cols' => 145)); ?>
        <?php echo $form->error($model, 'observation'); ?>
    </div>

	<div class="row">
        <?php echo $form->labelEx($model, 'observationOPS'); ?>
        <?php echo $form->textArea($model, 'observationOPS', array('rows' => 5, 'cols' => 145)); ?>
        <?php echo $form->error($model, 'observationOPS'); ?>
    </div>

	<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar'); ?>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	function habilitar(value)
    {

		$('#detailresultqualitySection > tbody').empty();

        $.ajax({
        type:'POST',
        url: "/requestsSAC/dateRequestsSAC.html",
        dataType: "json",
        data: { 
            'backgroundId': value,
        },
        context: document.body
        }).done(function(resp) {
            $( this ).addClass( "DateRequestsSAC");
            if(resp.length>0){
                var data = resp;
                for(var i=0; i<data.length; i++){
                    var tblRow = "<tr>" + 
					"<td>" + data[i]["businessLine"] + "</td>" + 
					"<td>" + data[i]["nameCliente"] + "</td>" + 
					"<td>" + data[i]["nameProduct"] + "</td>" + 
					"<td>" + data[i]["code"] + "</td>" + 
					"<td>" + data[i]["idNumber"] + "</td>" + 
                    "<td>" + data[i]["Nombre"] + "</td>" + 
                    "<td>" + data[i]["applyToPosition"] + "</td>" + 
                    "</tr>" 
                $(tblRow).appendTo("#detailresultqualitySection tbody");
                }
            }
        })
    }

	function validaDias(date1, date2)
    {
		
		var fechaini = new Date(date1);
		var fechafin = new Date(date2);

		if(fechafin>fechaini){
			var diasdif= fechafin.getTime()-fechaini.getTime();
		}else{
			var diasdif= fechaini.getTime()-fechafin.getTime();
		}
		var contdias = Math.round(diasdif/(1000*60*60*24));
		document.getElementById("deliveryDays").value=contdias;
	}
</script>