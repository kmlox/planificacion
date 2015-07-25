<?php
$this->breadcrumbs=array(
	'Contenidos Mínimos Obligatorios',
);

$this->menu=array(
array('label'=>'Crear CMO','url'=>array('create')),
array('label'=>'Administrar CMO','url'=>array('admin')),
);
?>

<h1>Contenidos Mínimos Obligatorios</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
'summaryText' => 'Mostrando de {start} al {end} - {count} total',
)); ?>
