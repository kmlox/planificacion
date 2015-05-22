<?php
$this->breadcrumbs=array(
	'Planificaciones'=>array('index'),
	$model->id_planificacion,    
);

$this->menu=array(
array('label'=>'Lista de Planificaciones','url'=>array('index')),
array('label'=>'Crear Planificacion','url'=>array('/crear')),
array('label'=>'Modificar Planificacion','url'=>array('update','id'=>$model->id_planificacion)),
array('label'=>'Eliminar Planificacion','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_planificacion),'confirm'=>'¿Esta ud seguro(a) que desea eliminar esta planificación?')),
array('label'=>'Administrar Planificaciones','url'=>array('admin')),
);
?>

<h1>Detalles de Planificacion<p>Profesor: <?php echo Usuario::model()->findbyPk($model->id_profesor)->nombre_usuario;?>
        <br>
        Curso: <?php $curso=Curso::model()->findbyPk($model->id_curso);
        $grado=Grado::model()->findbyPk($curso->id_grado);
        echo $grado->nombre_grado." ".$curso->nombre_curso;
        ?>
</h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		//'id_planificacion',
		array(
                    'label' => 'Asignatura',
                    'value' => $model->relAsignatura->nombre_asignatura,
                ),
		'tipo',
		'estado',
		'fecha_inicio',
		'fecha_termino',
		'habilidades',
		'actitudes',
		'actividades',
		'recursos',
		'conocimientos_previos',
		'conocimientos',
		//'id_evaluacion',
),
)); ?>
