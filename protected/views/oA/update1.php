<?php
$this->breadcrumbs=array(
	'Oas'=>array('index'),
	$model->id_OA=>array('view','id'=>$model->id_OA),
	'Update',
);

	$this->menu=array(
	array('label'=>'List OA','url'=>array('index')),
	array('label'=>'Create OA','url'=>array('create')),
	array('label'=>'View OA','url'=>array('view','id'=>$model->id_OA)),
	array('label'=>'Manage OA','url'=>array('admin')),
	);
	?>

	<h1>Update OA <?php echo $model->id_OA; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>