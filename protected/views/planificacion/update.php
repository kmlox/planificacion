<?php
$this->breadcrumbs=array(
	'Planificaciones'=>array('index'),
	$model->id_planificacion=>array('view','id'=>$model->id_planificacion),
	'Modificar',
);

	$this->menu=array(
	array('label'=>'Lista de Planificaciones','url'=>array('index')),
	array('label'=>'Crear Planificacion','url'=>array('create')),
	array('label'=>'Ver listado Planificaciones','url'=>array('view','id'=>$model->id_planificacion)),
	array('label'=>'Administrar Planificaciones','url'=>array('admin')),
	);
	?>

	<h1>Modificar Planificacion <?php //echo $model->id_planificacion; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>