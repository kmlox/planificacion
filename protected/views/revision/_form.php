<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'revision-form',
	'enableAjaxValidation'=>false,
)); 

// comprobar si existe al menos una fila que cumpla la condición especificada
$exists = Avance::model()->exists('id_planificacion='.$id);

if($exists==FALSE){
    echo '<div class="alert alert-danger" role="alert">No existe un Registro de Avance en esta planificación</div>';
}
else{
    $avance=Avance::model()->find('id_planificacion='.$id);
    $logro=$avance->logrado;
    if((int)$logro<100){
        echo '<div class="alert alert-warning" role="alert">El Registro de Avance realizado por el profesor es del : <strong>'.$logro.'%</strong>';
        echo '<p>Comentario: '.$avance->comentario.'</p></div>';
    }
    else{
        echo '<div class="alert alert-success" role="alert">El Registro de Avance realizado por el profesor es del : <strong>'.$logro.'%</strong>';
         echo '<p>Comentario: '.$avance->comentario.'</p></div>';
    }
}

?>

<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'id_planificacion',array('type'=>"hidden",'value'=>$id)); ?>

	<?php 
        echo $form->labelEx($model,'tipo');
        echo $form->dropDownList($model,'tipo',array('Revisión Prescencial', 'Revisión Libro de Clases','Revisión Cuaderno'),array('empty'=>'Seleccione Tipo')); ?>
        <br><br>
        
	<?php echo $form->datePickerGroup($model,'fecha',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

	<?php 
        echo $form->labelEx($model,'logrado');
        echo $form->dropDownList($model,'logrado',array(1 => 'SI', 0 => 'NO'),array('empty'=>'Seleccione Opción')); ?>
        <br><br>
        
	<?php echo $form->textAreaGroup($model,'comentario', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Guardar Revisión' : 'Guardar Cambios',
		)); ?>
</div>

<?php $this->endWidget(); ?>
