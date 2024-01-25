<?php
/* @var $this ServiceResponseController */

$this->breadcrumbs=array(
	'Service Response',
);
?>
<h1><?php echo CHtml::encode($this->id) . '/' . CHtml::encode($this->action->id); ?></h1>

<pre>
	<?php print_r($response)?>
</pre>
