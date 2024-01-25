<table>
  <thead>
    <tr>
      <th colspan="2">Trans Unión</th>
    </tr>
  </thead>
  <tbody>
      <tr>
        <td>
            <?php 
                $jsonText = json_encode($resultado->Tercero);
                echo Controller::jsonToDebug($jsonText);
            ?>
        </td>
      </tr>    
  </tbody>
</table>