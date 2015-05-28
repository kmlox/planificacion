<?php
$this->breadcrumbs=array(
	'Evaluaciones'=>array('index'),
	$model->id_evaluacion,
);

$this->menu=array(
array('label'=>'Lista de Evaluaciones','url'=>array('index')),
array('label'=>'Crear Evaluación','url'=>array('create')),
array('label'=>'Modificar Evaluación','url'=>array('update','id'=>$model->id_evaluacion)),
array('label'=>'Eliminar Evaluación','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_evaluacion),'confirm'=>'Are you sure you want to delete this item?')),
//array('label'=>'Administrar Evaluaciones','url'=>array('admin')),
);
?>

<h1>Detalles Evaluacion <p>Profesor: <?php echo Usuario::model()->findbyPk($model->id_profesor)->nombre_usuario;?>
       / Curso: <?php $curso=Curso::model()->findbyPk($model->id_curso);
        $grado=Grado::model()->findbyPk($curso->id_grado);
        echo $grado->nombre_grado." ".$curso->nombre_curso;
        ?>
</h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		//'id_evaluacion',
                //id_profesor',
		array(
                    'label' => 'Asignatura',
                    'value' => $model->relAsignatura->nombre_asignatura,
                ),
		'nombre_evaluacion',
		'fecha',
		'contenido',
),
)); 
if($model->url_documento!=NULL){
echo '<strong>&nbsp;Documento&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
. '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>'
. '<a href='.'"'.$model->url_documento.'"'.'target="_blank">'.$model->nombre_documento.'</a>';
}
?>

