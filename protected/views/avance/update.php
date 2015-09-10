<?php
$this->breadcrumbs=array(
	//'Avances'=>array('index'),
	//$model->id_avance=>array('view','id'=>$model->id_avance),
	'Modificar Progreso y Avance',
);

	$this->menu=array(
	//array('label'=>'List Avance','url'=>array('index')),
	//array('label'=>'Create Avance','url'=>array('create')),
	//array('label'=>'Detalles Progreso y Avance','url'=>array('view','id'=>$model->id_avance)),
	//array('label'=>'Manage Avance','url'=>array('admin')),
	);
	?>

	<h1>Modificar Progreso y Avance <?php // echo $model->id_avance; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'id'=>$model->id_planificacion)); ?>