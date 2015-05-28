<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'avance-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'id_planificacion',array('type'=>"hidden",'value'=>$id)); ?>

	<?php echo $form->datePickerGroup($model,'fecha',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

	<?php 
        echo $form->labelEx($model,'logrado');
        echo $form->dropDownList($model,'logrado',array(1 => 'SI', 0 => 'NO'),array('empty'=>'Seleccione Opción')); ?>
        <br><br>
        
	<?php echo $form->textAreaGroup($model,'comentario', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Guardar Registro' : 'Guardar Cambios',
		)); ?>
</div>

<?php $this->endWidget(); ?>
