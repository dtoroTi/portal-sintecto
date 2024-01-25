<script type="text/javascript">
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
<?php $firstRow = TRUE; ?>
<?php foreach ($data as $row) : ?>
    <?php if ($firstRow): ?>
        <?php echo ("['" . implode("','", array_keys($row)) . "'],\n"); ?>
    <?php endif; ?>
    <?php echo ((!$firstRow ? ",\n" : "\n") . "['" . array_shift($row) . "'," . implode(",", $row) . "] " ); ?>
    <?php $firstRow = false; ?>
<?php endforeach; ?>
        ]);
                var options = {
                    title: 'Estudios solicitados por cliente',
                    isStacked: true,
                    hAxis: {title: 'Cliente', titleTextStyle: {color: 'blue'}}
                };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>


<?php
$this->breadcrumbs = array(
    'Pie',
);
?>
<h1>Estudios solicitados</h1>


<div class="search-form" >
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->


<!--Div that will hold the pie chart-->
<center>
    <div id="chart_div" style="width:800px;height: 500px"></div>
</center>

<br/>
<hr/>

<center>
    <table class="ReportTable">
        <?php $firstRow = TRUE; ?>
        <?php $total = array(); ?>
        <?php foreach ($data as $row) : ?>
            <?php if ($firstRow): ?>
                <tr>
                    <?php $firstCol = TRUE; ?>
                    <?php foreach (array_keys($row) as $key) : ?>
                        <?php if ($firstCol): ?>
                            <th>&nbsp;</th>
                        <?php else: ?>
                            <?php $total[$key] = 0; ?>
                            <th><?php echo CHtml::encode($key) ?></th>
                        <?php endif ?>
                        <?php $firstCol = FALSE; ?>
                    <?php endforeach; ?>
                    <?php $total['total'] = 0 ?>
                    <th>Total</th>
                </tr>
            <?php endif; ?>
            <tr>
                <?php $firstCol = TRUE; ?>
                <?php $totalRow = 0; ?>
                <?php foreach ($row as $key => $val) : ?>
                    <?php if ($firstCol): ?>
                        <td><?php echo CHtml::encode($val) ?></td>
                        <?php $firstCol = FALSE; ?>
                    <?php else: ?>
                        <?php $totalRow = $totalRow + intVal($val); ?>
                        <?php $total[$key] += intVal($val); ?>

                        <td class="ReportData"><?php echo CHtml::encode($val) ?></td>
                    <?php endif ?>
                <?php endforeach; ?>
                <td  class="ReportData ReportTotal"><?php echo CHtml::encode($totalRow) ?></td>
                <?php $total['total']+=$totalRow ?>
            </tr>
            <?php $firstRow = false; ?>
        <?php endforeach; ?>
        <tr>
            <td class="ReportData ReportTotal">
                Total
            </td>

            <?php foreach ($total as $key => $val) : ?>
                <td class="ReportData ReportTotal"><?php echo CHtml::encode($val) ?></td>
            <?php endforeach; ?>
        </tr>
    </table>
</center>
