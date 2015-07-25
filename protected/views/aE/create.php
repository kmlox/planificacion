<?php
$this->breadcrumbs=array(
	'Aprendizajes Esperados'=>array('index'),
	'Crear Aprendizajes Esperados',
);

$this->menu=array(
array('label'=>'Listado de Aprendizajes Esperados','url'=>array('index')),
array('label'=>'Administrar Aprendizajes Esperados','url'=>array('admin')),
);
?>

<h1>Crear Aprendizajes Esperados</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>