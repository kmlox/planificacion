<?php
$this->breadcrumbs=array(
	'Revisions'=>array('index'),
	$model->id_revision,
);

$this->menu=array(
array('label'=>'List Revision','url'=>array('index')),
array('label'=>'Create Revision','url'=>array('create')),
array('label'=>'Update Revision','url'=>array('update','id'=>$model->id_revision)),
array('label'=>'Delete Revision','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_revision),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Revision','url'=>array('admin')),
);
?>

<h1>View Revision #<?php echo $model->id_revision; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id_revision',
		'id_planificacion',
		'tipo',
		'fecha',
		'logrado',
		'comentario',
),
)); ?>
