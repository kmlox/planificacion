<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'actividad-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'id_profesor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

	<?php echo $form->textFieldGroup($model,'id_asignatura',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>4)))); ?>

	<?php echo $form->textFieldGroup($model,'id_curso',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>3)))); ?>

	<?php echo $form->textFieldGroup($model,'tipo',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

	<?php echo $form->textFieldGroup($model,'estado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

	<?php //echo $form->datePickerGroup($model,'fecha_inicio',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click en Mes/Año para seleccionar un Mes/Año distinto.')); ?>

	<?php echo $form->datePickerGroup($model,'fecha_termino',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click on Month/Year to select a different Month/Year.')); ?>

	<?php echo $form->textAreaGroup($model,'habilidades', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'actitudes', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'actividades', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'recursos', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'conocimientos_previos', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'conocimientos', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textFieldGroup($model,'id_evaluacion',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

        <?php echo $form->dateRangeGroup(
			$model,
			'fecha_inicio',
			array(
				'widgetOptions' => array(
					'callback' => 'js:function(start, end){console.log(start.toString("MMMM d, yyyy") + " - " + end.toString("MMMM d, yyyy"));}'
				), 
		   		'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
				'hint' => 'Click inside! An even a date range field!.',
				'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
			)
	); ?>
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear Planificación' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
