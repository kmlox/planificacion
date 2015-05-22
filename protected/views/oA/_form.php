<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'oa-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

<?php echo $form->errorSummary($model); ?>
    
    <div class="row">
		<?php //echo $form->labelEx($model,'id_profesor'); ?>
		<?php echo $form->hiddenField($model,'id_profesor', array('type'=>"hidden",'value'=>"'".Yii::app()->user->name."'")); ?>
		<?php echo $form->error($model,'id_profesor'); ?>
    </div>

    <div class="row">
             <table>
                     <tr>
                     <td><span class="required">*</span>Nivel
                                     <?php echo CHtml::dropDownList('id_nivel','',CHtml::ListData(Nivel::model()->findAll(),'id_nivel','nombre_nivel'),
                                     array(
                                     'prompt'=>'Seleccione Nivel',
                                     'ajax'=>array(
                                     'type'=>'POST',
                                     'url'=>CController::createUrl('oA/SelectGrado'),
                                     'update'=>'#id_grado',
                                     'data'=>array('id_nivel'=>'js:this.value'),
                                     )));		
                                     ?>
                             </td>

                             <td><span class="required">*</span>Grado
                                     <?php 	
                                     echo CHtml::dropDownList('id_grado','',array(),
                                     array(
                                     'prompt'=>'Seleccione Grado',
                                     'ajax'=>array(			
                                     'type'=>'POST',
                                     'url'=>CController::createUrl('oA/SelectAsignatura'),
                                     'update'=>'#'.CHtml::activeId($model,'id_asignatura'),
                                     'data'=>array('id_grado'=>'js:this.value'),
                                     )));
                                     ?>
                             </td>
                             <td><span class="required">*</span>Asignatura
                                     <?php 		
                                     echo $form->dropDownList($model,'id_asignatura' ,CHtml::listData(Asignatura::model()->findAll(),'id_asignatura','nombre_asignatura'),
                                     array(
                                     'prompt'=>'Seleccione Asignatura',
                                     'ajax'=>array(
                                     'type'=>'POST',
                                     'url'=>CController::createUrl('oA/SelectIdoa'),
                                     'update'=>'#'.CHtml::activeId($model,'id_OA'),
                                     'data'=>array('id_asignatura'=>'js:this.value'),
                                     )));
                                     ?>		
                             </td>
                     </tr>
             </table>  		
     </div>
	
    <div class="row">
            <?php echo $form->hiddenField($model,'id_OA', array('type'=>"hidden",'value'=>"asd")); ?>
    </div>

    <?php echo $form->textAreaGroup($model,'descripcion_OA', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear OA' : 'Guardar Cambios OA',
		)); ?>
</div>

<?php $this->endWidget(); ?>
