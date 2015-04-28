<?php
$this->breadcrumbs=array(
	'Evaluacions'=>array('index'),
	$model->id_evaluacion,
);

$this->menu=array(
array('label'=>'List Evaluacion','url'=>array('index')),
array('label'=>'Create Evaluacion','url'=>array('create')),
array('label'=>'Update Evaluacion','url'=>array('update','id'=>$model->id_evaluacion)),
array('label'=>'Delete Evaluacion','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_evaluacion),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Evaluacion','url'=>array('admin')),
);
?>

<h1>View Evaluacion #<?php echo $model->id_evaluacion; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id_evaluacion',
		'id_profesor',
		'id_asignatura',
		'id_curso',
		'nombre_evaluacion',
		'fecha',
		'contenido',
		'nombre_documento',
		'url_documento',
),
)); ?>
