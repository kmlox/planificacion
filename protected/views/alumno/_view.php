<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_alumno')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_alumno),array('view','id'=>$data->id_alumno)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_curso')); ?>:</b>
	<?php echo CHtml::encode($data->id_curso); ?>
	<br />


</div>