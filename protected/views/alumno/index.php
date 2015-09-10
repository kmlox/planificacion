<h1>Registro de Notas</h1>

<h2>Seleccione Asignatura</h2>
<?php
$alumno=Alumno::model()->findAll("id_alumno='".Yii::app()->user->name."'");
$id_curso="";
foreach ($alumno as $row){
    $id_curso=$row->id_curso;
}

$id_grado=Curso::model()->findbyPk($id_curso)->id_grado;

?>

   <?php 
    echo CHtml::beginForm('alumno/informe');
    echo '<input type="hidden" name="id_alumno" value='.Yii::app()->user->name.'>';
    
    echo CHtml::dropDownList('id_asignatura','',CHtml::ListData(Asignatura::model()->findAll("id_grado="."'".$id_grado."'"),'id_asignatura','nombre_asignatura'),
    array(
    'prompt'=>'Selecciona Asignatura',
    'ajax'=>array(
    'type'=>'POST',
    'url'=>CController::createUrl('Informecurso/SelectGrado'),
    'update'=>'#id_grado',
    'data'=>array('id_nivel'=>'js:this.value'),
    )));		
    ?>
 <div class="form-actions"></br></p>
	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'submit',
		'context'=>'warning',
		'label'=>'Ver notas',
	)); 
        echo CHtml::endForm();  
        ?>        
</div>  