<?php
$this->breadcrumbs=array(
	'Asignaturas',
);

$this->menu=array(
array('label'=>'Crear Asignatura','url'=>array('create')),
array('label'=>'Administrar Asignaturas','url'=>array('admin')),
);
?>

<h1>Asignaturas</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
