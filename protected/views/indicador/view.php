<?php
$this->breadcrumbs=array(
	'Indicadores'=>array('index'),
	$model->id_indicador,
);

$this->menu=array(
array('label'=>'Lista de Indicadores','url'=>array('index')),
array('label'=>'Crear Indicador','url'=>array('create')),
array('label'=>'Modificar Indicador','url'=>array('update','id'=>$model->id_indicador)),
//array('label'=>'Eliminar Indicador','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_indicador),'confirm'=>'Are you sure you want to delete this item?')),
//array('label'=>'Administrar Indicadores','url'=>array('admin')),
);
?>

<h1>Detalles Indicador<p>Curso: <?php $oa=OA::model()->findbyPk($model->id_oa);?>
       <?php $asignatura=  Asignatura::model()->findbyPk($oa->id_asignatura);
        $grado=Grado::model()->findbyPk($asignatura->id_grado);
        echo $grado->nombre_grado;
        ?>
        / Asignatura: <?php echo $asignatura->nombre_asignatura?>
</h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		//'id_indicador',
                array(
                    'label' => 'Descripción Indicador',
                    'value' => $model->descripcion_indicador,
                ),
                array(
                    'label' => 'Objetivo Aprendizaje',
                    'value' => "[".substr($model->id_oa,4,8)."] ".$model->relOa->descripcion_OA,
                ),
		
),
)); ?>
