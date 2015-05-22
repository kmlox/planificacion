<?php
$this->breadcrumbs=array(
	'Evaluaciones'=>array('index'),
	'Crear Evaluación',
);

$this->menu=array(
array('label'=>'Lista de Evaluaciones','url'=>array('index')),
array('label'=>'Administrar Evaluaciones','url'=>array('admin')),
);
?>

<h1>Crear Evaluación</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>