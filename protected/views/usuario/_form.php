<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'usuario-form',
	'enableAjaxValidation'=>false,
)); ?>

<p>Los campos con <span class="required">*</span> son requeridos.</p><br>

<?php echo $form->errorSummary($model); ?>

<?php   
    echo $form->textFieldGroup($model,'id_usuario',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); 
    echo $form->passwordFieldGroup($model,'password',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>45)))); 
    echo $form->textFieldGroup($model,'nombre_usuario',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>100)))); 
    echo $form->emailFieldGroup($model,'email',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>45)))); 
?>
<div class="form-group">
         <label class="control-label">Rol<span class="required">*</span></label>
	<?php echo $form->Dropdownlist($model,'rol', array('profesor' => 'Profesor', 'alumno' => 'Alumno','admin' => 'Administrador','directivo' => 'Directivo'),
                array(
                'prompt'=>'Seleccione Rol',               
                ));         
        ?>
</div><br>

<div class="row">
<textarea id="Profesor_Asignaturas" name="Profesor[Asignaturas]" rows="1" cols="1" style="display:none"></textarea>         
</div>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear Usuario' : 'Modificar Usuario',
		)); ?>
</div>

<?php $this->endWidget(); ?>
