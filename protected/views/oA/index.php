<?php
$this->breadcrumbs=array(
	'Objetivos de Aprendizaje (OA)',
);

$this->menu=array(
array('label'=>'Crear Objetivos de Aprendizaje','url'=>array('create')),
//array('label'=>'Administrar Objetivos de Aprendizaje','url'=>array('admin')),
);
?>

<h1>Objetivos de Aprendizaje (OA)</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
'summaryText' => 'Mostrando de {start} al {end} - {count} total',
)); ?>
