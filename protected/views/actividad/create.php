<?php
$this->breadcrumbs=array(
	'Actividads'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Actividad','url'=>array('index')),
array('label'=>'Manage Actividad','url'=>array('admin')),
);
?>

<h1>Create Actividad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>