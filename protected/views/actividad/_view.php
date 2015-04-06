<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_actividad')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_actividad),array('view','id'=>$data->id_actividad)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_inicio); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_termino')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_termino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('habilidades')); ?>:</b>
	<?php echo CHtml::encode($data->habilidades); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actitudes')); ?>:</b>
	<?php echo CHtml::encode($data->actitudes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actividades')); ?>:</b>
	<?php echo CHtml::encode($data->actividades); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recursos')); ?>:</b>
	<?php echo CHtml::encode($data->recursos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('conocimientos_previos')); ?>:</b>
	<?php echo CHtml::encode($data->conocimientos_previos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('conocimientos')); ?>:</b>
	<?php echo CHtml::encode($data->conocimientos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_evaluacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_evaluacion); ?>
	<br />

	*/ ?>

</div>