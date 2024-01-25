<div class="ProcessTab">
<?php
/* @var $this ServiceResponseController */
/* @var $model ServiceResponse */



if(isset($model)&&$model){
?>
	<div style="margin-bottom:20px;">
		<?php try{?>
		<?php 
			$resultado = json_decode($model->response);

			$servicio = $model->tipo == 'consultaTransUnion' ? 'CIFIN' : $model->tipo."Result";

			echo $this->renderPartial('/serviceResponse/'.$model->tipo, array(
                    'model' => $model,
					'resultado'=>$resultado->{$servicio},
					'backgroundCheck' => $backgroundCheck,
                        ), TRUE);
		?>
		<?php }
		catch(Exception $e){
		?>
			<pre>
				<?php print_r (json_decode($model->response)) ?>
			</pre>
		<?php }?>
	</div>
	<?php /*$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'code',
			'response',
			'timestamp',
		),
	));*/ 
}
else {
	?>
	<h1>Consultar servicios para este estudio</h1>
	<p>
		Para este estudio aún no se han consultado los servicios.
		De clic en INICIAR para consultar los servicios de este estudio.
	</p>
	<div id="service-status">
		<a id="serviceResponseClick" href="/serviceResponse/darservicio?inicial=op&code=<?php echo $codigo?>#">INICIAR</a>
	</div>
	<?php
}
?>
</div>
<script>
jQuery(function($){
	$('#serviceResponseClick').click(function(e){
		e.preventDefault();
		$('#service-status').html($('<div>').addClass('loading'));
		url = $(this).attr('href');

		$.ajax({
			method: "GET",
			url: url,
			async: false,
		})
		.done(function( msg ) {
			console.log(msg);
			$('#service-status').html('');
			$.each(msg,function(index,value){
				$('#service-status').append($('<div>').html(value));
				verificarServicio('/serviceResponse/darservicio?code=<?php echo $codigo?>',index)
				console.log( index, value );
			});
			//location.reload();
		});
		//verificarServicio(url);
	});
});

function verificarServicio(url,busqueda){
	jQuery.ajax({
		method: "GET",
		data: {busqueda:busqueda},
		url: url,
		async: false,
	})
	.done(function( msg ) {
		console.log( "Data Saved: ", msg );
	});
}
</script>