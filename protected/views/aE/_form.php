<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'ae-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>
    
    <div class="row">
		<?php //echo $form->labelEx($model,'id_profesor'); ?>
		<?php echo $form->hiddenField($model,'id_profesor', array('type'=>"hidden",'value'=>Yii::app()->user->name)); ?>
		<?php echo $form->error($model,'id_profesor'); ?>
    </div>

    <?php 
        if($model->id_AE==NULL){
            
            //Imagen sólo en crear
            echo 
            '<p>Los campos con <span class="required">*</span> son requeridos.</p>
            <div>
                <div style="float: right;" />
                <img src='.Yii::app()->baseUrl.'/images/web/aE.jpg'.' class="img-rounded">
            </div>';
            
            //Dropdown Nivel
            echo '<br><br><span class="required">*</span>Nivel<p></p>';
            echo CHtml::dropDownList('id_nivel','',CHtml::ListData(Nivel::model()->findAll(),'id_nivel','nombre_nivel'),
            array(
            'prompt'=>'Seleccione Nivel',
            'ajax'=>array(
            'type'=>'POST',
            'url'=>CController::createUrl('aE/SelectGrado'),
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
            'url'=>CController::createUrl('aE/SelectAsignatura'),
            'update'=>'#'.CHtml::activeId($model,'id_asignatura'),
            'data'=>array('id_grado'=>'js:this.value'),
            )));
            
            //Dropdown Asignatura
            echo '<br><br><span class="required">*</span>Asignatura<p></p>';
            echo $form->dropDownList($model,'id_asignatura' ,array(),
            array(
            'prompt'=>'Seleccione Asignatura',
            'ajax'=>array(
            'type'=>'POST',
            'url'=>CController::createUrl('aE/SelectIdae'),
            'update'=>'#'.CHtml::activeId($model,'id_AE'),
            'data'=>array('id_asignatura'=>'js:this.value'),
            )));
            
            //Identificador Aprendizajes Esperados
            echo '<div class="row" align="left">';
            echo $form->hiddenField($model,'id_AE', array('type'=>"hidden",'value'=>"asd"));
            echo '</div>';
        }
        else{
            
            echo $form->hiddenField($model,'id_asignatura', array('type'=>"hidden",'value'=>$model->id_asignatura));
            
            $asignatura=Asignatura::model()->findbyPk($model->id_asignatura);
            $nombre_grado=  Grado::model()->findbyPk($asignatura->id_grado)->nombre_grado;
            echo "<h4 align='center'>".$nombre_grado."</h4>";
       
        
            $nombre_asignatura=$asignatura->nombre_asignatura;
            echo "<h4 align='center'>".$nombre_asignatura."</h4><br>";
        
        }
    ?>


<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textAreaGroup($model,'descripcion_AE', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>1)))); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear AE' : 'Guardar Cambios AE',
		)); ?>
</div>

<?php $this->endWidget(); ?>
