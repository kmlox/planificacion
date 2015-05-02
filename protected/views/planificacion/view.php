<?php
$this->breadcrumbs=array(
	'Planificaciones'=>array('index'),
	$model->id_planificacion,
);

$this->menu=array(
array('label'=>'Lista de Planificaciones','url'=>array('index')),
array('label'=>'Crear Planificacion','url'=>array('/crear')),
array('label'=>'Modificar Planificacion','url'=>array('update','id'=>$model->id_planificacion)),
array('label'=>'Eliminar Planificacion','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_planificacion),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Administrar Planificaciones','url'=>array('admin')),
);
?>

<h1>Detalles de Planificacion <?php //echo $model->id_planificacion; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id_planificacion',
		 array('name' => 'id_profesor', 'label' => 'Profesor'),
		'id_asignatura',
		'id_curso',
		'tipo',
		'estado',
		'fecha_inicio',
		'fecha_termino',
		'habilidades',
		'actitudes',
		'actividades',
		'recursos',
		'conocimientos_previos',
		'conocimientos',
		'id_evaluacion',
),
)); ?>
