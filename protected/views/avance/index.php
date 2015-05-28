<?php
$this->breadcrumbs=array(
	'Avances',
);

$this->menu=array(
array('label'=>'Create Avance','url'=>array('create')),
array('label'=>'Manage Avance','url'=>array('admin')),
);
?>

<h1>Avances</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
