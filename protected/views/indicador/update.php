<?php
$this->breadcrumbs=array(
	'Indicadores'=>array('index'),
	$model->id_indicador=>array('view','id'=>$model->id_indicador),
	'Modificar',
);

	$this->menu=array(
	array('label'=>'Listado de Indicadores','url'=>array('index')),
	array('label'=>'Crear Indicador','url'=>array('create')),
	//array('label'=>'View Indicador','url'=>array('view','id'=>$model->id_indicador)),
	//array('label'=>'Manage Indicador','url'=>array('admin')),
	);
	?>

	<h1>Modificar Indicador <?php // echo $model->id_indicador; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>