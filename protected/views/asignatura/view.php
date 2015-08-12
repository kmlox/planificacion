<?php
$this->breadcrumbs=array(
	'Asignaturas'=>array('index'),
	//$model->id_asignatura,
);

$this->menu=array(
array('label'=>'Listado de Asignaturas','url'=>array('index')),
array('label'=>'Crear Asignatura','url'=>array('create')),
//array('label'=>'Modificar Asignatura','url'=>array('update','id'=>$model->id_asignatura)),
//array('label'=>'Eliminar Asignatura','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_asignatura),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Administrar Asignaturas','url'=>array('admin')),
);
?>

<h1>Detalles de Asignatura</h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id_asignatura',
		'nombre_asignatura',
     array(
            'label' => 'Grado',
            'value' => $model->relGrado->nombre_grado,
        ),
),
)); ?>
