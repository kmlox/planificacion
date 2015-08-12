<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->id_usuario,
);

$this->menu=array(
array('label'=>'Lista de Usuarios','url'=>array('index')),
array('label'=>'Crear Usuario','url'=>array('create')),
array('label'=>'Modificar Usuario','url'=>array('update?id='.$model->id_usuario)),
array('label'=>'Eliminar Usuario','url'=>'#','linkOptions'=>array('submit'=>array('eliminar?id='.$model->id_usuario),'confirm'=>'¿Está seguro que quiere eliminar este usuario?')),
array('label'=>'Administrar Usuarios','url'=>array('admin')),
);
?>

<h1>Detalles del Usuario</h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id_usuario',
		'nombre_usuario',
		//'password',
		'email',
		'rol',
),
)); ?>
