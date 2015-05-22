<?php
$this->breadcrumbs=array(
	'Contenidos Mínimos Obligatorios'=>array('index'),
	//$model->id_CMO=>array('view','id'=>$model->id_CMO),
	'Modificar',
);

	$this->menu=array(
	array('label'=>'Listado de CMO','url'=>array('index')),
	array('label'=>'Crear CMO','url'=>array('create')),
	//array('label'=>'View CMO','url'=>array('view','id'=>$model->id_CMO)),
	//array('label'=>'Manage CMO','url'=>array('admin')),
	);
	?>

	<h1>Modificar CMO <?php //echo $model->id_CMO; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>