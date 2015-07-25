<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'ofv-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
		<?php //echo $form->labelEx($model,'id_profesor'); ?>
		<?php echo $form->hiddenField($model,'id_profesor', array('type'=>"hidden",'value'=>Yii::app()->user->name)); ?>
		<?php echo $form->error($model,'id_profesor'); ?>
</div>

<?php echo $form->errorSummary($model); ?>
<?php
     if($model->id_OFV==NULL){
        //Imagen sólo en crear
            echo 
            '<p>Los campos con <span class="required">*</span> son requeridos.</p>
            <div>
                <div style="float: right;" />
                <img src='.Yii::app()->baseUrl.'/images/web/oFV.jpg'.' class="img-rounded">
            </div>';
            
            //Dropdown Nivel
            echo '<br><br><span class="required">*</span>Nivel<p></p>';
            echo CHtml::dropDownList('id_nivel','',CHtml::ListData(Nivel::model()->findAll(),'id_nivel','nombre_nivel'),
            array(
            'prompt'=>'Seleccione Nivel',
            'ajax'=>array(
            'type'=>'POST',
            'url'=>CController::createUrl('oFV/SelectGrado'),
            'update'=>'#id_grado',
            'data'=>array('id_nivel'=>'js:this.value'),
            )));
            
            //Dropdown Grado
            echo '<br><br><span class="required">*</span>Grado<p></p>';
            echo CHtml::dropDownList('id_grado','',array(),
            array(
            'prompt'=>'Seleccione Grado',
            'ajax'=>array(			
            'type'=>'POST',
            'url'=>CController::createUrl('oFV/SelectAsignatura'),
            'update'=>'#'.CHtml::activeId($model,'id_asignatura'),
            'data'=>array('id_grado'=>'js:this.value'),
            )));
            
            //Dropdown Asignatura
            echo '<br><br><span class="required">*</span>Asignatura<p></p>';
            echo $form->dropDownList($model,'id_asignatura',array(),array('empty'=>'Seleccione Asignatura')); 
            echo '<br><br><br><br>'; 
    }
    else{
            $asignatura=Asignatura::model()->findbyPk($model->id_asignatura);
            $nombre_grado=  Grado::model()->findbyPk($asignatura->id_grado)->nombre_grado;
            echo "<h4 align='center'>".$nombre_grado."</h4>";
       
        
            $nombre_asignatura=$asignatura->nombre_asignatura;
            echo "<h4 align='center'>".$nombre_asignatura."</h4><br>";
    }
?>
<div class="row" align="left">      
    <?php echo $form->textAreaGroup($model,'descripcion_OFV', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>1)))); ?>
</div>
	
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear OFV' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>