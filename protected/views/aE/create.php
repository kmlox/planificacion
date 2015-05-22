<?php
$this->breadcrumbs=array(
	'Aprendizajes Esperados'=>array('index'),
	'Crear',
);

$this->menu=array(
array('label'=>'Lista de AE','url'=>array('index')),
//array('label'=>'Manage AE','url'=>array('admin')),
);
?>

<h1>Crear AE</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>