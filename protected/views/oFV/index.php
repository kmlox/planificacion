<?php
$this->breadcrumbs=array(
	'Objetivos Fundamentales Verticales',
);

$this->menu=array(
array('label'=>'Crear OFV','url'=>array('create')),
//array('label'=>'Administrar OFV','url'=>array('admin')),
);
?>

<h1>Objetivos Fundamentales Verticales</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
'summaryText' => 'Mostrando de {start} al {end} - {count} total',
)); ?>
