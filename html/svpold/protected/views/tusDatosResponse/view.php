<div class="ProcessTab">
<?php
/* @var $this TusDatosResponseController */
/* @var $model TusDatosResponse */



if(isset($model->response)&&$model->response){
?>

	<h1>Consultar información de Tus Datos</h1>

	<div id="service-status">
	</div>
	<iframe id="infoTusDatos"
		src="<?php echo Yii::app()->request->baseUrl; ?>/tusDatosResponse/darservicio?code=<?php echo $codigo?>#"
		style="border:none; width: 100%; height: 1200px;">
	</iframe>
	<?php
}
else
{
?>
	<legend>
		<p>Consultar información de Tus Datos</p>
	</legend>


	<div id="service-status">
		<a id="tusDatosClick" href="/tusDatosResponse/darservicio?code=<?php echo $codigo?>&id=<?php echo $idNumber ?>">INICIAR</a>
	</div>


	<script type="text/javascript">

		jQuery(function($){
			$('#tusDatosClick').click(function(e){
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
					/*$.each(msg,function(index,value){
						$('#service-status').append($('<div>').html(value));
						verificarServicio('/serviceResponse/darservicio?code=<?php echo $codigo?>',index)
						console.log( index, value );
					});*/
					//location.reload();
					$('#service-status').append($('<div>').html(msg));
				});
				//verificarServicio(url);
			});
		});

		/*function verificarServicio(url,busqueda){
			jQuery.ajax({
				method: "GET",
				data: {busqueda:busqueda},
				url: url,
				async: false,
			})
			.done(function( msg ) {
				console.log( "Data Saved: ", msg );
			});
		}*/
	</script>

<?php
}
?>
</div>
