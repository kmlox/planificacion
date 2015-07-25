<?php
$this->breadcrumbs=array(
	'Contenidos Mínimos Obligatorios'=>array('index'),
	'Crear',
);

$this->menu=array(
array('label'=>'Lista de CMO','url'=>array('index')),
array('label'=>'Administrar CMO','url'=>array('admin')),
);
?>

<h1>Crear Contenido Mínimo Obligatorio</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>