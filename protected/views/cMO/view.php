<?php
$this->breadcrumbs=array(
	'Contenidos Mínimos Obligatorios'=>array('index'),
	//$model->id_CMO,
);

$this->menu=array(
array('label'=>'Listado de CMO','url'=>array('index')),
array('label'=>'Crear CMO','url'=>array('create')),
array('label'=>'Modificar CMO','url'=>array('update','id'=>$model->id_CMO)),
array('label'=>'Eliminar CMO','url'=>'eliminar?id='.$model->id_CMO,'linkOptions'=>array('confirm'=>'¿Está seguro que quiere eliminar este CMO?')),
array('label'=>'Administar CMO','url'=>array('admin')),
);
?>

<h1>Detalles CMO</h1>
<?php   $asignatura=Asignatura::model()->findbyPk($model->id_asignatura);
        $grado=Grado::model()->findbyPk($asignatura->id_grado);
        $asignatura->nombre_asignatura
?>
<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		//'id_CMO',
        array(
            'label' => 'Curso',
            'value' => $grado->nombre_grado,
        ),
        array(
                    'label' => 'Asignatura',
                    'value' => $asignatura->nombre_asignatura,
        ),
                array(
                    'label' => 'Descripción CMO',
                    'value' => $model->descripcion_CMO,
                ),
		//'id_asignatura',
		//'id_profesor',
),
)); ?>
