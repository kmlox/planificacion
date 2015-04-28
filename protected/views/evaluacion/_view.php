<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_evaluacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_evaluacion),array('view','id'=>$data->id_evaluacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_profesor')); ?>:</b>
	<?php echo CHtml::encode($data->id_profesor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_asignatura')); ?>:</b>
	<?php echo CHtml::encode($data->id_asignatura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_curso')); ?>:</b>
	<?php echo CHtml::encode($data->id_curso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_evaluacion')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_evaluacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contenido')); ?>:</b>
	<?php echo CHtml::encode($data->contenido); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_documento')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_documento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url_documento')); ?>:</b>
	<?php echo CHtml::encode($data->url_documento); ?>
	<br />

	*/ ?>

</div>