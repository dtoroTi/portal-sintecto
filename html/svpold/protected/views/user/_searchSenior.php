<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('adminSenior'),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255)); ?>
	</div>

    <div class="row">
			<?php echo $form->label($model, 'dateFrom'); ?>
			<?php //echo $form->textField($model, 'studyStartedOnFrom'); ?>
			<?php
				$this->widget('jqueryDateTime', array(
					'name' => 'User[dateFrom]',
					'value' =>  $model->dateFrom,
                    'id'=>'dateFrom',
					// additional javascript options for the date picker plugin
					'options' => [
						'showAnim' => 'fold',
						'buttonText' => '...',
						'format' => 'Y-m-d H:i:s',
						'lang' => 'es',
						'showButtonPanel' => true,
					],
					'htmlOptions' => array(
						'style' => 'width:10em;'
					),
				))
			?>
				<b>Terminado Hasta</b>
				<?php
					$this->widget('jqueryDateTime', array(
						'name' => 'User[dateUntil]',
						'value' =>  $model->dateUntil,
                        'id'=>'dateUntil',
						// additional javascript options for the date picker plugin
						'options' => [
							'showAnim' => 'fold',
							'buttonText' => '...',
							'format' => 'Y-m-d H:i:s',
							'lang' => 'es',
							'showButtonPanel' => true,
						],
						'htmlOptions' => array(
							'style' => 'width:10em;'
						),
					))
				?>
				<br><br>
	</div>
	<div class="row buttons">
		
		<?php
		/*echo CHtml::button('Indicadores Senior por fecha', array(
			'id' => 'export-button',
			'class' => 'btn btn-primary btn-sm',
			'onClick' => "window.open('" . Yii::app()->controller->createUrl('/user/assignSeniorExport', array(
					'_export' => true,
					'from' => $model->dateFrom,
					'until' => $model->dateUntil,               
				)) . "','_blank');"
		));*/
		?>
	</div>
	<div class="row buttons">
    	<?php echo CHtml::button('Indicadores Senior por fecha', array('onclick' => 'assignExport();')); ?> 
	</div>

	<div class="row">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->


<script type="text/javascript">


    function assignExport() {
		
		var from=$('#dateFrom').val();
		var until=$('#dateUntil').val();

		window.open("/user/assignSeniorExport?from="+from+"&until="+until, '_blank');
		//return false;

		/*jQuery.ajax({
                type: 'POST',
                url: '<?php //echo Yii::app()->createAbsoluteUrl("user/assignSeniorExport"); ?>',
                data: {
					'from':  from,
					'until': until,
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
					url = $(this).attr("_exportIndSenior.php?from=&"+from+"until"+until);
					window.open(url);
					return false;
					//window.open("_exportIndSenior.php?from=&"+from+"until"+until, '_blank');
                    //alert('Se quito la asignación con éxito.'+from);
                    //$.fn.yiiGridView.update("background-check-grid");
                },
            });*/


		/*$.ajax({
			type:'POST',
			url: "/user/assignSeniorExport.html",
			dataType: "json",
			data: { 
				'from':  from,
				'until': until,
			},
			contentType: "application/json; charset=utf-8",
			success: function (response) {
				if (response) {
					window.open(response, '_blank');
				}
			},
			error: function (response) {
				alert(response.responseText);
			}
		});*/
		/*$.ajax({
		type:'POST',
		//url: '<?php //echo Yii::app()->createURL("user/assignSeniorExport"); ?>',
		url: "/user/assignSeniorExport",
		dataType: "json",
		data: { 
			'from': $('#dateFrom').val(),
			'until': $('#dateUntil').val(),
		},
		context: document.body
		}).done(function(resp) {
			alert("valor datos:   "+resp);
			$( this ).addClass( "AssignSeniorExport" );
			alert("valor datos:   "+resp);
			window.open(resp, "_blank");
			alert("valor datos:   "+resp);
		if(resp.length>0){
				var data = resp; 
				alert("valor:   "+data);    
			}
		});*/

		/*jQuery.ajax({
            type: 'POST',
            url: '<?php //echo Yii::app()->createURL("/user/assignSeniorExport"); ?>',
			data: { 
				"from":  from,
				"until":  until,
          	},
            dataType: "json",
            success: function (data, status) {
                if (typeof data.error === 'undefined') {
                    alert("success: "+data.error);
                    alert("success: "+data);
                } else {
                    alert("success2: "+data.ans);
                    //$('#seniorAssignment_usernameSenior').val('');
                }
            },
            error: function (request, status, error) {
				alert("error: "+data.ans);
				alert("error: "+request.responseText);
            },
        });*/

    }
</script>