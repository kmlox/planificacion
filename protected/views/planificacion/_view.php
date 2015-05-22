<div class="view">
<b><?php echo "Profesor"; ?>:</b>
	<?php $nombre_profesor=Usuario::model()->findbyPk($data->id_profesor)->nombre_usuario;
            echo $nombre_profesor;
        ?>
       	<br />

	<b><?php echo "Asignatura" ?>:</b>
	<?php $nombre_asignatura=Asignatura::model()->findbyPk($data->id_asignatura)->nombre_asignatura;
        echo $nombre_asignatura;
        ?>
	<br />

	<b><?php echo "Curso" ?>:</b>
	<?php         
        $nombre_curso=Curso::model()->findbyPk($data->id_curso)->nombre_curso;
        $id_grado=Curso::model()->findbyPk($data->id_curso)->id_grado;
        $nombre_grado= Grado::model()->findbyPk($id_grado)->nombre_grado;
        echo $nombre_grado.' "'.$nombre_curso.'"';
        ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_termino')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_termino); ?>
	<br />
        
        <b></b>
	<?php echo CHtml::link(CHtml::encode("Ver detalle"),array('view','id'=>$data->id_planificacion)); ?>
	<br />
        
        <p></p>
        <strong>-----------------------------------------</strong>
        <p></p>
        

</div>