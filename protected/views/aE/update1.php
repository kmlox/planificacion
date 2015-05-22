<?php
$this->breadcrumbs=array(
	'Aes'=>array('index'),
	$model->id_AE=>array('view','id'=>$model->id_AE),
	'Update',
);

	$this->menu=array(
	array('label'=>'List AE','url'=>array('index')),
	array('label'=>'Create AE','url'=>array('create')),
	array('label'=>'View AE','url'=>array('view','id'=>$model->id_AE)),
	array('label'=>'Manage AE','url'=>array('admin')),
	);
	?>

	<h1>Update AE <?php echo $model->id_AE; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>