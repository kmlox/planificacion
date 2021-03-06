<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'alumno-form',
	'enableAjaxValidation'=>false,
        //habilitar subida de archivos
        'htmlOptions' => array(
        'enctype' => 'multipart/form-data')
)); ?>

<p class="note">Los datos con <span class="required">*</span> son requeridos</p>
<?php echo $form->errorSummary($model); ?>
<div class="row">

		<?php echo CHtml::dropDownList('id_nivel','',CHtml::ListData(Nivel::model()->findAll(),'id_nivel','nombre_nivel'),
		array(
		'prompt'=>'Seleccione Nivel',
		'ajax'=>array(
		'type'=>'POST',
		'url'=>CController::createUrl('Planificacion/SelectGrado'),
		'update'=>'#id_grado',
		'data'=>array('id_nivel'=>'js:this.value'),
		)
		)
		);
		?>

		<?php 	
		echo CHtml::dropDownList('id_grado','',array(),
		array(
		'prompt'=>'Seleccione Grado',
		'ajax'=>array(			
			'type'=>'POST',
			'url'=>CController::createUrl('Planificacion/SelectCurso'),
			'update'=>'#'.CHtml::activeId($model,'id_curso'),
			'data'=>array('id_grado'=>'js:this.value'),
		),
		)
		);
		?>

		<?php 
                echo $form->error($model,'id_curso');
                echo $form->dropDownList($model,'id_curso', array(),
		array('prompt' => 'Seleccione Curso', 
		)); 
 ?>
	
	
</div>

<div class="row"><?php
$this->widget('CMultiFileUpload', array(
     	'model'=>$model,
		'name'=>'Alumno',
     	'attribute'=>'Alumno',
     	'accept'=>'xlsx',
     	'options'=>array(),
     	'denied'=>'Archivo no soportado',
     	'max'=>1, // max 1 files  
  		'duplicate'=>'Archivo duplicado',
));
?></div>
<br>
<div>
    <A HREF=<?php echo '../../plantillas/plantilla_alumnos.xlsx';?>>Descargar formato de planilla Excel</A>
</div>
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Importar' : 'Actualizar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
