<?php
$this->breadcrumbs=array(
	'Indicadores'=>array('index'),
	$model->id_indicador=>array('view','id'=>$model->id_indicador),
	'Modificar',
);

	$this->menu=array(
	array('label'=>'Listado de Indicadores','url'=>array('index')),
	array('label'=>'Crear Indicador','url'=>array('create')),
	array('label'=>'Ver detalles Indicador','url'=>array('view','id'=>$model->id_indicador)),
	array('label'=>'Administrar Indicadores','url'=>array('admin')),
	);
	?>

	<h1>Modificar Indicador <?php // echo $model->id_indicador; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>