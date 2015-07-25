<?php
$this->breadcrumbs=array(
	'Objetivos de Aprendizaje'=>array('index'),
	//$model->id_OA,
);

$this->menu=array(
array('label'=>'Lista de Objetivos de Aprendizaje','url'=>array('index')),
array('label'=>'Crear Objetivo de Aprendizaje','url'=>array('create')),
//array('label'=>'Modificar Objetivo de Aprendizaje','url'=>array('update?id='.$data->id_OA)),
//array('label'=>'Delete OA','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_OA),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Administrar Objetivos de Aprendizaje','url'=>array('admin')),
);
?>

<h1>Vista Objetivos de Aprendizaje</h1>

<div class="view">

	<b><?php echo "Código OA" ?>:</b>
	<?php $codigo=substr($data->id_OA,4,8);
        echo $codigo;
        ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion_OA')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion_OA); ?>
	<br />

        <b><?php echo "Grado" ?>:</b>
	<?php $asignatura=Asignatura::model()->findbyPk($data->id_asignatura);
        $nombre_grado=  Grado::model()->findbyPk($asignatura->id_grado)->nombre_grado;
        echo $nombre_grado;
        ?>
	<br />
        
	<b><?php echo "Asignatura" ?>:</b>
	<?php $nombre_asignatura=$asignatura->nombre_asignatura;
        echo $nombre_asignatura;
        ?>
	<br />
        
        <br>
        <?php
        echo CHtml::button('Eliminar',
                    array('submit'=>array('eliminar?id='.$data->id_OA)));          
        echo ' ';
        echo CHtml::button('Actualizar',
                    array('submit'=>array('update?id='.$data->id_OA)));          
        ?>
        <br />
        
</div>
