<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'oa-form',
	'enableAjaxValidation'=>false,
)); ?>



<?php echo $form->errorSummary($model); ?>
    
    <div class="row">
		<?php //echo $form->labelEx($model,'id_profesor'); ?>
		<?php echo $form->hiddenField($model,'id_profesor', array('type'=>"hidden",'value'=>Yii::app()->user->name)); ?>
		<?php echo $form->error($model,'id_profesor'); ?>
    </div>


          
    <?php 
        if($model->id_OA==NULL){
            
            //Imagen sólo en crear
            echo 
            '<p>Los campos con <span class="required">*</span> son requeridos.</p>
            <div>
                <div style="float: right;" />
                <img src='.Yii::app()->baseUrl.'/images/web/oA.jpg'.' class="img-rounded">
            </div>';
            
            //Cursos 1ero a 6to basico
            $array_id=array('1B','2B','3B','4B','5B','6B');            
            $result=Grado::model()->findAllByAttributes(array("id_grado"=>$array_id));
            $data=CHtml::listData($result,'id_grado','nombre_grado');
          
            
            //Dropdown Grado
            echo '<br><br><span class="required">*</span>Grado<p></p>';
            echo CHtml::dropDownList('id_grado','',CHtml::ListData($result,'id_grado','nombre_grado'),            
            array(
            'prompt'=>'Seleccione Grado',
            'ajax'=>array(			
            'type'=>'POST',
            'url'=>CController::createUrl('oA/SelectAsignatura'),
            'update'=>'#'.CHtml::activeId($model,'id_asignatura'),
            'data'=>array('id_grado'=>'js:this.value'),
            )));
            
            //Dropdown Asignatura
            echo '<br><br><span class="required">*</span>Asignatura<p></p>';
            echo $form->dropDownList($model,'id_asignatura' ,array(),array('empty'=>'Seleccione Asignatura'),
            array(
            'prompt'=>'Seleccione Asignatura',
            'ajax'=>array(
            'type'=>'POST',
            'url'=>CController::createUrl('oA/SelectIdoa'),
            'update'=>'#'.CHtml::activeId($model,'id_OA'),
            'data'=>array('id_asignatura'=>'js:this.value'),
            )));
            
            //Identificador Objetivo de Aprendizaje
            echo '<div class="row" align="left">';
            echo $form->hiddenField($model,'id_OA', array('type'=>"hidden",'value'=>"asd"));
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
      
    <div class="row" align="left">
    <?php echo $form->textAreaGroup($model,'descripcion_OA', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>1)))); ?>
    </div>

    <div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear OA' : 'Guardar Cambios OA',
		)); ?>
    </div>

<?php $this->endWidget(); ?>
