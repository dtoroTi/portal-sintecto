<?php
/* @var $this TusDatosResponseController */

$this->breadcrumbs=array(
	'Tus Datos Response',
);
?>
<h1><?php echo CHtml::encode($this->id) . '/' . CHtml::encode($this->action->id); ?></h1>

<pre>
	<?php print_r($response)?>
</pre>
