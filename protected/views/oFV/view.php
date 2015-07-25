<?php
$this->breadcrumbs=array(
	'Objetivos Fundamentales Verticales'=>array('index'),
	//$model->id_OFV,
);

$this->menu=array(
array('label'=>'Lista de OFV','url'=>array('index')),
array('label'=>'Crear OFV','url'=>array('create')),
array('label'=>'Modificar OFV','url'=>array('update','id'=>$model->id_OFV)),
array('label'=>'Eliminar OFV','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_OFV),'confirm'=>'Esta seguro que desea eliminar esta planificacion?')),
array('label'=>'Administrar OFV','url'=>array('admin')),
);
?>

<h1>Detalle OFV</h1>
<?php   $asignatura=Asignatura::model()->findbyPk($model->id_asignatura);
        $grado=Grado::model()->findbyPk($asignatura->id_grado);
        $asignatura->nombre_asignatura
?>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
       array(
                    'label' => 'Curso',
                    'value' => $grado->nombre_grado,
        ),
        array(
                    'label' => 'Asignatura',
                    'value' => $asignatura->nombre_asignatura,
        ),
        array(
                    'label' => 'Descripción OFV',
                    'value' => $model->descripcion_OFV,
        ),
                //'id_OFV',
		//'id_asignatura',
		//'id_profesor',
),
)); ?>
