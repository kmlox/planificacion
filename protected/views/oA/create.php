<?php
$this->breadcrumbs=array(
	'Objetivos de Aprendizaje'=>array('index'),
	'Crear',
);

$this->menu=array(
array('label'=>'Listado de Objetivos de Aprendizaje','url'=>array('index')),
array('label'=>'Administrar Objetivos de Aprendizaje','url'=>array('admin')),
);
?>

<h1>Crear Objetivo de Aprendizaje</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>