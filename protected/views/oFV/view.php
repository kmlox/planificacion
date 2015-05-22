<?php
$this->breadcrumbs=array(
	'Ofvs'=>array('index'),
	$model->id_OFV,
);

$this->menu=array(
array('label'=>'Lista de OFV','url'=>array('index')),
array('label'=>'Crear OFV','url'=>array('create')),
array('label'=>'Modificar OFV','url'=>array('update','id'=>$model->id_OFV)),
array('label'=>'Eliminar OFV','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_OFV),'confirm'=>'Esta seguro que desea eliminar esta planificacion?')),
array('label'=>'Administrar OFV','url'=>array('admin')),
);
?>

<h1>Detalle Objetivos Fundamentales Verticales #<?php echo $model->id_OFV; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id_OFV',
		'descripcion_OFV',
		'id_asignatura',
		'id_profesor',
),
)); ?>
