<?php
$this->breadcrumbs=array(
	'Indicadores',
);

$this->menu=array(
array('label'=>'Crear Indicador','url'=>array('create')),
array('label'=>'Administrar Indicadores','url'=>array('admin')),
);
?>

<h1>Listado de Indicadores</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
'summaryText' => 'Mostrando de {start} al {end} - {count} total',
)); ?>
