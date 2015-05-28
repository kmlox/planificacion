<?php
$this->breadcrumbs=array(
	'Evaluaciones'=>array('index'),
	$model->id_evaluacion=>array('view','id'=>$model->id_evaluacion),
	'Modificar',
);

	$this->menu=array(
	array('label'=>'Lista de Evaluaciones','url'=>array('index')),
	array('label'=>'Crear Evaluación','url'=>array('create')),
	array('label'=>'Detalles Evaluación','url'=>array('view','id'=>$model->id_evaluacion)),
	//array('label'=>'Manage Evaluacion','url'=>array('admin')),
	);
	?>

	<h1>Modificar Evaluación <?php // echo $model->id_evaluacion; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>