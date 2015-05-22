<?php
$this->breadcrumbs=array(
	'Cmos'=>array('index'),
	$model->id_CMO,
);

$this->menu=array(
array('label'=>'List CMO','url'=>array('index')),
array('label'=>'Create CMO','url'=>array('create')),
array('label'=>'Update CMO','url'=>array('update','id'=>$model->id_CMO)),
array('label'=>'Delete CMO','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_CMO),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage CMO','url'=>array('admin')),
);
?>

<h1>View CMO #<?php echo $model->id_CMO; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id_CMO',
		'descripcion_CMO',
		'id_asignatura',
		'id_profesor',
),
)); ?>
