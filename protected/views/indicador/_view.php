<div class="view">
        
        <?php $oa=OA::model()->findbyPk($data->id_oa);?>
        <b><?php echo "Grado" ?>:</b>
	<?php $asignatura=Asignatura::model()->findbyPk($oa->id_asignatura);
        $nombre_grado=  Grado::model()->findbyPk($asignatura->id_grado)->nombre_grado;
        echo $nombre_grado;
        ?>
	<br />
        
	<b><?php echo "Asignatura" ?>:</b>
	<?php $nombre_asignatura=$asignatura->nombre_asignatura;
        echo $nombre_asignatura;
        ?>
	<br />
        <b><?php echo "OA" ?>:</b>
	<?php 
        echo "[".substr($oa->id_OA,4,8)."] ".$oa->descripcion_OA;
        ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion_indicador')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion_indicador); ?>
	<br />

	<b></b>
        <?php
         echo CHtml::button('Eliminar',
                    array('submit'=>array('eliminar?id='.$data->id_indicador),
                    'confirm' => '¿Esta seguro que desea eliminar este Indicador?',));          
        ?>
        <?php
         echo CHtml::button('Modificar',
                    array('submit'=>array('indicador/update/'.$data->id_indicador),
                    ));          
        ?>
        <br />
        
        <p></p>
        <strong>-----------------------------------------</strong>
        <p></p>

</div>