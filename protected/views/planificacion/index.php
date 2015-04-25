<?php
$this->breadcrumbs=array(
	'Resumen de Planificaciones',
);

$this->menu=array(
array('label'=>'Crear Planificacion','url'=>array('create')),
array('label'=>'Administrar Planificaciones','url'=>array('admin')),
);
?>

<h1>Resumen de Planificaciones</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
