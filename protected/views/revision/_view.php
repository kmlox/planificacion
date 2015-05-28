<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_revision')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_revision),array('view','id'=>$data->id_revision)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_planificacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_planificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logrado')); ?>:</b>
	<?php echo CHtml::encode($data->logrado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario')); ?>:</b>
	<?php echo CHtml::encode($data->comentario); ?>
	<br />


</div>