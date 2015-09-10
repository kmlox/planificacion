<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Informe de Notas por Curso</title>
<style type="text/css"></style></head>
<body>
    <h1>Informe de Notas por Curso</h1>
        <?php
        echo CHtml::beginForm('informecurso/asignatura');
        $this->menu=array(
            array('label'=>'Lista de Planificaciones','url'=>array('planificacion/index')),
            array('label'=>'Administrar Planificaciones','url'=>array('admin')),
        );
        ?>
                 
<div class="row">
		<table>
  			<tr>
    			<td><span class="required">*</span>Nivel
					<?php echo CHtml::dropDownList('id_nivel','',CHtml::ListData(Nivel::model()->findAll(),'id_nivel','nombre_nivel'),
					array(
					'prompt'=>'Seleccione Nivel',
					'ajax'=>array(
					'type'=>'POST',
					'url'=>CController::createUrl('Informecurso/SelectGrado'),
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
					'url'=>CController::createUrl('Informecurso/SelectCurso'),
					'update'=>'#id_curso',
					'data'=>array('id_grado'=>'js:this.value'),
					)));
					?>
				</td>
   
   				<td><span class="required">*</span>Curso
					<?php 		
					echo CHtml::dropDownList('id_curso','',array(),
                                         array(
                          		'prompt'=>'Seleccione Curso',
					'ajax'=>array(
					'type'=>'POST',
					'url'=>CController::createUrl('Informecurso/SelectAsignatura'),
					'update'=>'#id_asignatura',
                                        'data'=>array('id_curso'=>'js:this.value'),
					)));
					?>		
				</td> 
  			</tr> 
                    <tr>
                        <td>
                                    <span class="required">*</span>Asignatura
					<?php 		
					echo CHtml::dropDownList('id_asignatura','',array(),
                                         array(
                          		'prompt'=>'Seleccione Asignatura',
					'ajax'=>array(
					'type'=>'POST',
					'url'=>CController::createUrl('Informecurso/SelectEvaluacion'),
					'update'=>'#id_evaluacion',
                                        'data'=>array('id_asignatura'=>'js:this.value'),
					)));
					?>	                                   
                            </td>
                            <td>
                                    <span class="required">*</span>Evaluación
					<?php 		
					echo CHtml::dropDownList('id_evaluacion','',array(),
                                         array(
                          		'prompt'=>'Seleccione Evaluación',
					'ajax'=>array(
					'type'=>'POST',
					//'url'=>CController::createUrl('Planificacion/SelectAsignatura'),
					//'update'=>'#'.CHtml::activeId($model,'id_asignatura'),
                                        'data'=>array('id_asignatura'=>'js:this.value'),
					)));
					?>	                                   
                            </td>
                        <td></td>
                    </tr>
  		</table>
  		
	</div>
</div>
 <div class="form-actions"></br></p>
	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'submit',
		'context'=>'primary',
		'label'=>'Crear Informe',
	)); 
        echo CHtml::endForm();  
        ?>        
</div>  

</body>
</html>