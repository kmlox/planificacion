<?php
$this->breadcrumbs=array(
	'Objetivos de Aprendizaje (OA)',
);

$this->menu=array(
//array('label'=>'Lista de Objetivos de Aprendizaje','url'=>array('index')),
array('label'=>'Crear Objetivo de Aprendizaje','url'=>array('create')),
//array('label'=>'Update OA','url'=>array('update','id'=>$model->id_OA)),
//array('label'=>'Delete OA','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_OA),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Administrar Objetivos de Aprendizaje','url'=>array('admin')),
);
?>

<h1>Objetivos de Aprendizaje (OA)</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
'summaryText' => 'Mostrando de {start} al {end} - {count} total',
)); ?>
