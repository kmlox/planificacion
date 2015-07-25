<div class="view">
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
	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion_OFV')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion_OFV); ?>
	<br />
        
        <br>
        <?php
        echo CHtml::button('Eliminar',
                    array('submit'=>array('eliminar?id='.$data->id_OFV),
                    'confirm' => '¿Esta seguro que desea eliminar este OFV?',));  
        echo " ";
        echo CHtml::button('Modificar',
                    array('submit'=>array('oFV/update/'.$data->id_OFV),
                    ));  
        ?>
        <br />
        
        <p></p>
        <strong>-----------------------------------------</strong>
        <p></p>

</div>