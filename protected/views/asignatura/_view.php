<div class="view">

        <b><?php echo CHtml::encode($data->getAttributeLabel('id_asignatura')); ?>:</b>
	<?php echo CHtml::encode($data->id_asignatura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_asignatura')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_asignatura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Grado')); ?>:</b>
	<?php echo CHtml::encode($data->relGrado->nombre_grado); ?>
	<br />
        
        <p></p>
        <strong>-----------------------------------------</strong>
        <p></p>


</div>