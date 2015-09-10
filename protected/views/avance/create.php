<?php
$this->breadcrumbs=array(
	//'Avance'=>array('index'),
	'Registro de Progreso y Avance',
);
/*
$this->menu=array(
array('label'=>'List Avance','url'=>array('index')),
array('label'=>'Manage Avance','url'=>array('admin')),
);
 */
?>

<h1>Registro de Progreso y Avance</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'id'=>$id)); ?>