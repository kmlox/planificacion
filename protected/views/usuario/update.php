<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->id_usuario,
	'Modificar',
);

	$this->menu=array(
	array('label'=>'Lista de Usuarios','url'=>array('index')),
	array('label'=>'Crear Usuario','url'=>array('create')),
	array('label'=>'Detalles del Usuario','url'=>array('view?id='.$model->id_usuario)),
	array('label'=>'Administrar Usuarios','url'=>array('admin')),
	);
	?>

	<h1>Modificar Usuario</h1>
        <h2 align="center"><?php echo $model->nombre_usuario; ?></h2>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>