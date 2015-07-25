<?php
$this->breadcrumbs=array(
	'Aprendizajes Esperados'=>array('index'),
	//$model->id_AE,
);

$this->menu=array(
array('label'=>'Lista de Aprendizajes Esperados','url'=>array('index')),
array('label'=>'Crear Aprendizajes Esperados','url'=>array('create')),
//array('label'=>'Modificar AE','url'=>array('update','id'=>$model->id_AE)),
//array('label'=>'Eliminar AE','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_AE),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Administrar Aprendizajes Esperados','url'=>array('admin')),
);
?>

<h1>Vista Aprendizajes Esperados</h1>

<div class="view">

	<b><?php echo "Código OA" ?>:</b>
	<?php $codigo=substr($data->id_AE,4,12);
        echo $codigo;
        ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion_AE')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion_AE); ?>
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
                    array('submit'=>array('eliminar?id='.$data->id_AE)));          
        echo ' ';
        echo CHtml::button('Actualizar',
                    array('submit'=>array('update?id='.$data->id_AE)));          
        ?>
        <br />
        
</div>