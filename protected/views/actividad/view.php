<?php
$this->breadcrumbs=array(
	'Actividads'=>array('index'),
	$model->id_actividad,
);

$this->menu=array(
array('label'=>'List Actividad','url'=>array('index')),
array('label'=>'Create Actividad','url'=>array('create')),
array('label'=>'Update Actividad','url'=>array('update','id'=>$model->id_actividad)),
array('label'=>'Delete Actividad','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_actividad),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Actividad','url'=>array('admin')),
);
?>

<h1>View Actividad #<?php echo $model->id_actividad; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id_actividad',
		'id_profesor',
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
