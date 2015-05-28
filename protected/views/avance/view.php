<?php
$this->breadcrumbs=array(
	'Avances'=>array('index'),
	$model->id_avance,
);

$this->menu=array(
array('label'=>'List Avance','url'=>array('index')),
array('label'=>'Create Avance','url'=>array('create')),
array('label'=>'Update Avance','url'=>array('update','id'=>$model->id_avance)),
array('label'=>'Delete Avance','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_avance),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Avance','url'=>array('admin')),
);
?>

<h1>View Avance #<?php echo $model->id_avance; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id_avance',
		'id_planificacion',
		'fecha',
		'logrado',
		'comentario',
),
)); ?>
