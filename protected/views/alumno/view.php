<?php
$this->breadcrumbs=array(
	'Alumnos'=>array('index'),
	$model->id_alumno,
);

$this->menu=array(
array('label'=>'List Alumno','url'=>array('index')),
array('label'=>'Create Alumno','url'=>array('create')),
array('label'=>'Update Alumno','url'=>array('update','id'=>$model->id_alumno)),
array('label'=>'Delete Alumno','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_alumno),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Alumno','url'=>array('admin')),
);
?>

<h1>View Alumno #<?php echo $model->id_alumno; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id_alumno',
		'id_curso',
),
)); ?>
