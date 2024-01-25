<script type="text/javascript">

  // Load the Visualization API and the piechart package.
  google.load('visualization', '1.0', {'packages': ['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
<?php $firstRow = TRUE; ?>
<?php foreach ($data as $row) : ?>
  <?php if ($firstRow): ?>
    <?php echo ("['" . implode("','", array_keys($row)) . "'],\n"); ?>
  <?php endif; ?>
  <?php echo ( (!$firstRow ? ",\n" : "\n") . "['" . implode("',", $row) . "] " ); ?>
  <?php $firstRow = false; ?>
<?php endforeach; ?>
    ]);
            // Set chart options
            var options = {'title': 'Estado de Reportes',
              'width': 600,
              'height': 450};

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>


<?php Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
");
?>


<div class="search-form" >
  <?php
  $this->renderPartial('_search', array(
      'model' => $model,
  ));
  ?>
</div><!-- search-form -->

<?php
$this->breadcrumbs = array(
    'Pie',
);
?>
<h1>Estudios Solicitados</h1>

<!--Div that will hold the pie chart-->
<center>
  <div id="chart_div" ></div>
</center>