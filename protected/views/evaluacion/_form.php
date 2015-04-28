<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'evaluacion-form',
	'enableAjaxValidation'=>false,
        //activar widget subir archivos
        'htmlOptions' => array(
        'enctype' => 'multipart/form-data')
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'id_profesor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

	<?php echo $form->textFieldGroup($model,'id_asignatura',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>4)))); ?>

	<?php echo $form->textFieldGroup($model,'id_curso',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>3)))); ?>

	<?php echo $form->textFieldGroup($model,'nombre_evaluacion',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>45)))); ?>

	<?php echo $form->datePickerGroup($model,'fecha',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click on Month/Year to select a different Month/Year.')); ?>

	<?php echo $form->textAreaGroup($model,'contenido', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>
	
        <?php
            $mensaje='';
            //Form de Update
            if ($model->id_evaluacion!=null){
                
                if($model->url_documento!=NULL){
                    echo '</br><label class="control-label">Material de Apoyo</label></br>';
                    echo '<a href='.'"'.$model->url_documento.'"'.'target="_blank">'.$model->nombre_documento.'</a><br/>';;                     
                    
                    $mensaje="<strong>Soporta archivos:</strong></p>jpg, gif, png, doc, docx, xls, xlsx, ppt, pptx, pdf</p></p>"
                        ."<strong>Máximo: 1 archivo en total</p></p>Si sube un archivo, eliminará el archivo asociado anteriormente</strong>";
                }
                else{
                    $mensaje="<strong>Soporta archivos:</strong></p>jpg, gif, png, doc, docx, xls, xlsx, ppt, pptx, pdf</p></p>"
                        ."<strong>Máximo: 1 archivo en total</strong>";
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
