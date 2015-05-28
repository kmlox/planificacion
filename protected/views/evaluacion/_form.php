<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'evaluacion-form',
	'enableAjaxValidation'=>false,
        //activar widget subir archivos
        'htmlOptions' => array(
        'enctype' => 'multipart/form-data')
)); ?>

<?php echo $form->errorSummary($model); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php //echo $form->labelEx($model,'id_profesor'); ?>
		<?php echo $form->hiddenField($model,'id_profesor', array('type'=>"hidden",'value'=>Yii::app()->user->name,)); ?>
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
					'url'=>CController::createUrl('Evaluacion/SelectGrado'),
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
					'url'=>CController::createUrl('Evaluacion/SelectCurso'),
					'update'=>'#'.CHtml::activeId($model,'id_curso'),
					'data'=>array('id_grado'=>'js:this.value'),
					)));
					?>
				</td>
                                <td><span class="required">*</span>Curso
					<?php 		
					echo $form->dropDownList($model,'id_curso' ,CHtml::listData(Curso::model()->findAll(),'id_curso','nombre_curso'),
					array(
                                        'prompt'=>'Seleccione Curso',
					'ajax'=>array(
					'type'=>'POST',
					'url'=>CController::createUrl('Evaluacion/SelectAsignatura'),
					'update'=>'#'.CHtml::activeId($model,'id_asignatura'),
                                        'data'=>array('id_curso'=>'js:this.value'),
					)));
					?>		
				</td>
  			</tr>
  		</table>  		
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'id_asignatura'); ?>
		<?php echo $form->dropDownList($model,'id_asignatura',array(),array('empty'=>'Seleccione Asignatura')); ?>
		<?php echo $form->error($model,'id_asignatura'); ?>
	</div>
	
	<?php echo $form->textFieldGroup($model,'nombre_evaluacion',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>45)))); ?>

	<?php echo $form->datePickerGroup($model,'fecha',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

	<?php echo $form->textAreaGroup($model,'contenido', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>
	
        <?php
            $mensaje="<strong>Soporta archivos:</strong></p>jpg, gif, png, doc, docx, xls, xlsx, ppt, pptx, pdf</p></p>"
                        ."<strong>Máximo: 1 archivo en total</strong>";
            //Form de Update
            if ($model->id_evaluacion!=null){
                
                if($model->url_documento!=NULL){
                    echo '</br><label class="control-label">Material de Apoyo</label></br>';
                    echo '<a href='.'"'.$model->url_documento.'"'.'target="_blank">'.$model->nombre_documento.'</a><br/>';;                     
                    
                    $mensaje="<strong>Soporta archivos:</strong></p>jpg, gif, png, doc, docx, xls, xlsx, ppt, pptx, pdf</p></p>"
                        ."<strong>Máximo: 1 archivo en total</p></p>Si sube un archivo, eliminará el archivo asociado anteriormente</strong>";
                }               
            }           
            ?>
</br><label class="control-label">Agregar - Material de Apoyo</label>
            <?php
            $this->widget(
                'booster.widgets.TbButton',
                array(
                    'label' => 'Detalles',
                    'size' => 'extra_small',
                    'context' => 'primary',
                    'htmlOptions' => array(
                        'onclick' => 'js:bootbox.alert('.'"'.$mensaje.'"'.')'
                    ),
                )
            );
            ?>
</br>
<?php      
            $this->widget('CMultiFileUpload', array(
                'model'=>$model,
                'name'=>'Evaluacion',
                'attribute'=>'Evaluacion',
                'accept'=>'jpg|gif|png|doc|docx|xls|xlsx|ppt|pptx|pdf',
                'options'=>array(),
                'denied'=>'Archivo no soportado',
                'max'=>1, // maximo 1 archivo  
                'duplicate'=>'Archivo duplicado',
  		));
            ?>
</br>
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear Evaluación' : 'Modificar Evaluación',
		)); ?>
</div>

<?php $this->endWidget(); ?>
