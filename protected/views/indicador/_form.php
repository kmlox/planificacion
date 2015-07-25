<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'indicador-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
		<?php //echo $form->labelEx($model,'id_profesor'); ?>
		<?php echo $form->hiddenField($model,'id_profesor', array('type'=>"hidden",'value'=>Yii::app()->user->name)); ?>
		<?php echo $form->error($model,'id_profesor'); ?>
</div>
<?php echo $form->errorSummary($model); ?>
<?php 
    
    if($model->id_indicador==NULL){
        echo '<p>Los campos con <span class="required">*</span> son requeridos.</p>';
        echo '<div>
                    <div style="float: right;" />
                    <img src='.Yii::app()->baseUrl.'/images/web/indicador.jpg'.' class="img-rounded">
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
        'url'=>CController::createUrl('Indicador/SelectAsignatura'),
        'update'=>'#id_asignatura',
        'data'=>array('id_grado'=>'js:this.value'),
        )));

        //Dropdown Asignatura
        echo '<br><br><span class="required">*</span>Asignatura<p></p>';
        echo CHtml::dropDownList('id_asignatura','',array(),
        array(
        'prompt'=>'Seleccione Asignatura',
        'ajax'=>array(
        'type'=>'POST',
        'url'=>CController::createUrl('Indicador/SelectOa'),
        'update'=>'#descripcion',
        'data'=>array('id_asignatura'=>'js:this.value'),
        )));

        echo '<br><br><br><br><br><br><br><br><br><div id="descripcion"></div><br><br>';
    }
    
    else{            
            
        $oa=OA::model()->findbyPk($model->id_oa);
        
        echo "<h3 align='center'>";
	$asignatura=Asignatura::model()->findbyPk($oa->id_asignatura);
        $nombre_grado=  Grado::model()->findbyPk($asignatura->id_grado)->nombre_grado;
        echo $nombre_grado." - ";
       
	$nombre_asignatura=$asignatura->nombre_asignatura;
        echo $nombre_asignatura."</h3>";
       
        echo "<h4>Objetivo de Aprendizaje: ";
	echo "[".substr($oa->id_OA,4,8)."] ".$oa->descripcion_OA.'</h4>';
       
    }
?>        
     
<br>
<div class="row" align="left">
    <?php echo $form->textAreaGroup($model,'descripcion_indicador', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>1)))); ?>
</div>	

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear Indicador' : 'Modificar Indicador',
		)); ?>
</div>

<?php $this->endWidget(); ?>
