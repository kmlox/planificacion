<?php
$this->breadcrumbs=array(
	'Indicadores'=>array('index'),
	'Crear Indicador',
);

$this->menu=array(
array('label'=>'Listado de Indicadores','url'=>array('index')),
array('label'=>'Administrar Indicadores','url'=>array('admin')),
);
?>

<h1>Crear Indicador</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>