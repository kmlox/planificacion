<?php
$this->breadcrumbs=array(
	'Actividads',
);

$this->menu=array(
array('label'=>'Create Actividad','url'=>array('create')),
array('label'=>'Manage Actividad','url'=>array('admin')),
);
?>

<h1>Actividads</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
