<?php
$this->breadcrumbs=array(
	'Evaluaciones',
);

$this->menu=array(
array('label'=>'Crear Evaluación','url'=>array('create')),
array('label'=>'Administrar Evaluaciones','url'=>array('admin')),
);
?>

<h1>Resumen de Evaluaciones</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
'summaryText' => 'Mostrando de {start} al {end} - {count} total',
)); ?>
