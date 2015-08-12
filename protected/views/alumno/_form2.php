<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'alumno-form',
	'enableAjaxValidation'=>false,
        //habilitar subida de archivos
        'htmlOptions' => array(
        'enctype' => 'multipart/form-data')
)); ?>

<p class="note">Los datos con <span class="required">*</span> son
requeridos</p>

<div class="row">

		<?php echo CHtml::dropDownList('id_nivel','',CHtml::ListData(Nivel::model()->findAll(),'id_nivel','nombre_nivel'),
		array(
		'prompt'=>'Seleccione Nivel',
		'ajax'=>array(
		'type'=>'POST',
		'url'=>CController::createUrl('Planificacion/SelectGrado'),
		'update'=>'#id_grado',
		'data'=>array('id_nivel'=>'js:this.value'),
		)
		)
		);
		?>

		<?php 	
		echo CHtml::dropDownList('id_grado','',array(),
		array(
		'prompt'=>'Seleccione Grado',
		'ajax'=>array(			
			'type'=>'POST',
			'url'=>CController::createUrl('Planificacion/SelectCurso'),
			'update'=>'#'.CHtml::activeId($model,'id_curso'),
			'data'=>array('id_grado'=>'js:this.value'),
		),
		)
		);
		?>

		<?php echo $form->dropDownList($model, 'id_curso', 
		CHtml::listData(Curso::model()->findAll(), 'id_curso','nombre_curso'),
		array('prompt' => 'Seleccione Curso', 
		)); 
                ?>
    
                <?php echo $form->hiddenField($model,'id_alumno',array('type'=>"hidden",'value'=>$id_alumno)); ?>

 
	<?php echo $form->error($model,'id_curso'); ?>

	
</div>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Guardar Cambios' : 'Actualizar',
		)); ?>
</div>


<?php $this->endWidget(); ?>
