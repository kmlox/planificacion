<?php
$this->breadcrumbs=array(
	'Alumnos',
);

$this->menu=array(
array('label'=>'Create Alumno','url'=>array('create')),
array('label'=>'Manage Alumno','url'=>array('admin')),
);
?>

<h1>Alumnos</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
