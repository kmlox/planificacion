<?php
$this->breadcrumbs=array(
	'Revisions',
);

$this->menu=array(
array('label'=>'Create Revision','url'=>array('create')),
array('label'=>'Manage Revision','url'=>array('admin')),
);
?>

<h1>Revisions</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
