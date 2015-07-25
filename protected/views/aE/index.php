<?php
$this->breadcrumbs=array(
	'Aprendizajes Esperados',
);

$this->menu=array(
array('label'=>'Crear Aprendizajes Esperados','url'=>array('create')),
array('label'=>'Administrar Aprendizajes Esperados','url'=>array('admin')),
);
?>

<h1>Aprendizajes Esperados</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
'summaryText' => 'Mostrando de {start} al {end} - {count} total',
)); ?>
