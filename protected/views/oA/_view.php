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
        
        <b></b>
        <?php
         echo CHtml::button('Eliminar',
                    array('submit'=>array('eliminar?id='.$data->id_OA),
                    'confirm' => '¿Esta seguro que desea eliminar este OA?',));          
        ?>
        <br />
               
        <p></p>
        <strong>-----------------------------------------</strong>
        <p></p>
        
</div>