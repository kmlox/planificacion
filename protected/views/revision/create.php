<?php
$this->breadcrumbs=array(
	'Registro de Revisión'=>array('index'),
	'Crear',
);
/*
$this->menu=array(
array('label'=>'List Revision','url'=>array('index')),
array('label'=>'Manage Revision','url'=>array('admin')),
);
 */
?>

<h1>Registro de Revisión</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'id'=>$id)); ?>