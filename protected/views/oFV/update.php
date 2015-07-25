<?php
$this->breadcrumbs=array(
	'Objetivos Fundamentales Verticales'=>array('index'),
	//$model->id_OFV=>array('view','id'=>$model->id_OFV),
	'Modificar',
);

	$this->menu=array(
	array('label'=>'Listado de OFV','url'=>array('index')),
	array('label'=>'Crear OFV','url'=>array('create')),
	array('label'=>'Detalles OFV','url'=>array('view','id'=>$model->id_OFV)),
	array('label'=>'Administración de OFV','url'=>array('admin')),
	);
	?>

	<h1>Modificar OFV <?php //echo $model->id_OFV; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>