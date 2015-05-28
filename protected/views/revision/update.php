<?php
$this->breadcrumbs=array(
	'Revisiones'=>array('index'),
	$model->id_revision=>array('view','id'=>$model->id_revision),
	'Modificar Revisión',
);

	$this->menu=array(
	//array('label'=>'List Revision','url'=>array('index')),
	//array('label'=>'Create Revision','url'=>array('create')),
	array('label'=>'Detalles Revisión','url'=>array('view','id'=>$model->id_revision)),
	//array('label'=>'Manage Revision','url'=>array('admin')),
	);
	?>

	<h1>Modificar Revisión <?php // echo $model->id_revision; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'id'=>$model->id_planificacion)); ?>