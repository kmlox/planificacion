<?php
$this->breadcrumbs=array(
	'Aprendizajes Esperados'=>array('index'),
	$model->id_AE,
);

$this->menu=array(
array('label'=>'Lista de AE','url'=>array('index')),
array('label'=>'Crear AE','url'=>array('create')),
array('label'=>'Modificar AE','url'=>array('update','id'=>$model->id_AE)),
array('label'=>'Eliminar AE','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_AE),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Administrar AE','url'=>array('admin')),
);
?>

<h1>Aprendizajes Esperados #<?php echo $model->id_AE; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id_AE',
		'descripcion_AE',
		'id_asignatura',
		'id_profesor',
),
)); ?>
