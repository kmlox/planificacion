<?php
$this->breadcrumbs=array(
	'Evaluacions',
);

$this->menu=array(
array('label'=>'Create Evaluacion','url'=>array('create')),
array('label'=>'Manage Evaluacion','url'=>array('admin')),
);
?>

<h1>Evaluacions</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
