<?php
$this->breadcrumbs=array(
	'Asignaturas'=>array('index'),
	'Crear',
);

$this->menu=array(
array('label'=>'Listado de Asignaturas','url'=>array('index')),
array('label'=>'Administrar Asignaturas','url'=>array('admin')),
);
?>

<h1>Crear Asignatura</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>