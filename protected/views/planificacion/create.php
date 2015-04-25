<?php
$this->breadcrumbs=array(
	'Planificaciones'=>array('index'),
	'Crear Planificación',
);

$this->menu=array(
array('label'=>'Lista de Planificaciones','url'=>array('index')),
array('label'=>'Administrar Planificaciones','url'=>array('admin')),
);
?>

<h1>Crear Planificación</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>