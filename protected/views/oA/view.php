<?php
$this->breadcrumbs=array(
	'Objetivos de Aprendizaje'=>array('index'),
	$model->id_OA,
);

$this->menu=array(
array('label'=>'Lista de Objetivos de Aprendizaje','url'=>array('index')),
array('label'=>'Crear OA','url'=>array('create')),
//array('label'=>'Update OA','url'=>array('update','id'=>$model->id_OA)),
//array('label'=>'Delete OA','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_OA),'confirm'=>'Are you sure you want to delete this item?')),
//array('label'=>'Manage OA','url'=>array('admin')),
);
?>

<h1>View OA #<?php echo $model->id_OA; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id_OA',
		'descripcion_OA',
		'id_asignatura',
		'id_profesor',
),
)); ?>
