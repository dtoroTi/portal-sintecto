<table>
  <thead>
    <tr>
      <th colspan="2">Datos básicos</th>
    </tr>
  </thead>
  <tbody>
    <tr class="even">
      <td width="30%">Denominación</td>
      <td><?php echo $resultado->Denominacion ?></td>
    </tr>
    <tr class="odd">
      <td >Cédula de ciudadanía</td>
      <td><?php echo $backgroundCheck->idNumber ?></td>
    </tr>
    <tr class="even">
      <td >Validación cédula</td>
      <td><?php echo $resultado->EstadoCedula ?></td>
    </tr>
  </tbody>
</table>