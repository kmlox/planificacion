<?php
$this->breadcrumbs=array(
	'Asignaturas'=>array('index'),
	//$model->id_asignatura=>array('view','id'=>$model->id_asignatura),
	'Modificar',
);

	$this->menu=array(
	array('label'=>'Listado de Asignaturas','url'=>array('index')),
	array('label'=>'Crear Asignatura','url'=>array('create')),
	array('label'=>'Detalles de Asignatura','url'=>array('view','id'=>$model->id_asignatura)),
	array('label'=>'Administrar Asignaturas','url'=>array('admin')),
	);
	?>

	<h1>Modificar Asignatura <?php echo $model->id_asignatura; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>