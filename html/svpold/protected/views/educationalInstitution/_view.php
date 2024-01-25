<div class="post">
	<div class="edit">
		<p>
			<?php echo CHtml::link('Editar '.$data->name, array('update', 'id'=>$data->id)); ?>
		</p>
	</div>
	<table class="table table-striped">
		<tbody>
			<tr>
				<td width="20%"><b>ID</b></td>
				<td><?php echo $data->id?></td>
			</tr>
			<tr>
				<td width="20%"><b>Nombre</b></td>
				<td><?php echo $data->name?></td>
			</tr>
			<tr>
				<td width="20%"><b>Teléfono</b></td>
				<td><?php echo $data->phone?></td>
			</tr>
			<tr>
				<td width="20%"><b>Ciudad</b></td>
				<td><?php echo $data->city?></td>
			</tr>
			<tr>
				<td width="20%"><b>País</b></td>
				<td><?php echo $data->country?></td>
			</tr>
			<tr>
				<td width="20%"><b>Email</b></td>
				<td><?php echo $data->email?></td>
			</tr>
			<tr>
				<td width="20%"><b>Contacto</b></td>
				<td><?php echo $data->contact?></td>
			</tr>
		</tbody>
	</table>
</div>
