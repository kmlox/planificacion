<?php
$this->breadcrumbs=array(
	'Objetivos Fundamentales Verticales'=>array('index'),
	'Crear',
);

$this->menu=array(
array('label'=>'Lista de OFV','url'=>array('index')),
array('label'=>'Administrar OFV','url'=>array('admin')),
);
?>

<h1>Crear OFV</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>