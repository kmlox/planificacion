<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'asignatura-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="note">Los campos con <span class="required">*</span> son requeridos.

<?php echo $form->errorSummary($model); ?>
        <?php    
        if($model->id_asignatura==NULL){
        //Dropdown Nivel
           echo '</p><br>';
           echo '<span class="required">*</span>Nivel<p></p>';
           echo CHtml::dropDownList('id_nivel','',CHtml::ListData(Nivel::model()->findAll(),'id_nivel','nombre_nivel'),
           array(
           'prompt'=>'Seleccione Nivel',
           'ajax'=>array(
           'type'=>'POST',
           'url'=>CController::createUrl('Asignatura/SelectGrado'),
           'update'=>'#'.CHtml::activeId($model,'id_grado'),
           'data'=>array('id_nivel'=>'js:this.value'),
           ))); 
           
        //Dropdown Grado   
           echo '<br><br><span class="required">*</span>Grado<p></p>';
           echo $form->dropDownList($model,'id_grado',array(),
            array(
            'prompt'=>'Seleccione Grado',
            'ajax'=>array(
            'type'=>'POST',
            'url'=>CController::createUrl('Asignatura/SelectId'),
            'update'=>'#'.CHtml::activeId($model,'id_asignatura'),
            'data'=>array('id_grado'=>'js:this.value'),
            )));
           
           echo '<br><br><br> ';
        }
        else{
            echo "<h4 align='center'>".$model->relGrado->nombre_grado."</h4><br>";
        }
        ?>
 
        <?php echo $form->textFieldGroup($model,'nombre_asignatura',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>45)))); ?>

        <?php echo $form->textFieldGroup($model,'id_asignatura',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>4)))); ?>

	
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear Asignatura' : 'Modificar Asignatura',
		)); ?>
</div>

<?php $this->endWidget(); ?>
