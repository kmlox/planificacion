<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Crear Planificación</title>
<style type="text/css"></style></head>
<body>

<div align="center">
  <table width="800" border="0">
    <tr>
      <th colspan="2" scope="col">&nbsp;</th>
    </tr>
    <tr>
        <td colspan="2"><h1>Crear Planificación</h1></td>
    </tr>
    <tr>
      <td colspan="2">
	 
	</td>
    </tr>
    <tr>
      <td width="259">
        <?php
        echo CHtml::beginForm('planificacion/create');
        /*
        echo CHtml::beginForm('planificacion/create');
        echo CHtml::dropDownList('nivel',"",
        CHtml::listData(Nivel::model()->findAll(),'id_nivel','nombre_nivel'),
        array('empty'=>'Seleccione Nivel')); 
        */
        ?>
      </td>
        <td width="531">
            <strong>Seleccione ítems requeridos</strong>
          <?php
       $this->menu=array(
array('label'=>'Lista de Planificaciones','url'=>array('planificacion/index')),
array('label'=>'Administrar Planificaciones','url'=>array('admin')),
);
?>
        </td>                 
    </tr>
  </table>
    
    <div class="row">
		<table>
                    <tr>
    			<td><span class="required">*</span>Nivel
					<?php   echo CHtml::dropDownList('id_nivel','',
                                                CHtml::ListData(Nivel::model()->findAll(),
                                                'id_nivel','nombre_nivel'),
                                                    array(
                                                    'prompt'=>'Seleccione Nivel',
                                                    'ajax'=>array(
                                                    'type'=>'POST',
                                                    'url'=>CController::createUrl('Planificacion/SelectGrado'),
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
					'url'=>CController::createUrl('Planificacion/SelectCurso'),
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
					'url'=>CController::createUrl('Planificacion/SelectAsignatura'),
					'update'=>'#id_asignatura',
                                        'data'=>array('id_curso'=>'js:this.value'),
					)));
					?>		
				</td>                              
                                
  			</tr>
                    <tr>
                        <td><span class="required">*</span>Asignatura
					<?php 		
					echo CHtml::dropDownList('id_asignatura','',array(),
                                         array(
                          		'prompt'=>'Seleccione Asignatura',
					'ajax'=>array(
					'type'=>'POST',
					'url'=>CController::createUrl('Planificacion/SelectUnidad'),
					'update'=>'#id_unidad',
                                        'data'=>array('id_asignatura'=>'js:this.value'),
					)));
					?>		
				</td>
                            <td>
                                    <span class="required">*</span>Cargar Unidades
					<?php 		
					echo CHtml::dropDownList('id_unidad','',array(),
                                         array(
                          		'prompt'=>'Seleccione Unidad',
					'ajax'=>array(
					'type'=>'POST',
					//'url'=>CController::createUrl('Planificacion/SelectAsignatura'),
					//'update'=>'#'.CHtml::activeId($model,'id_asignatura'),
                                        'data'=>array('id_unidad'=>'js:this.value'),
					)));
					?>	                                   
                                </td>
                        <td></td>
                    </tr>
                        <tr>
                                <td>
                                    <p><strong>Tipo de Planificación</strong></p>
                                    <label class="radio">
                                        <input placeholder="Radio buttons" id="TestForm_radioButtons_0" value="CC" type="radio" name="tipo" />
                                        Clase a Clase
                                    </label>
                                    <label class="radio"><input placeholder="Radio buttons" id="TestForm_radioButtons_1" value="U" type="radio" name="tipo" />
                                        Unidad
                                    </label>
                                    <label class="radio"><input placeholder="Radio buttons" id="TestForm_radioButtons_2" value="A" type="radio" name="tipo" />
                                        Anual
                                    </label>                                   
                                </td>
                                
                                <td>

                                </td>
                                <td>

                                </td>
                        </tr>
  		</table>
  		<?php // echo $form->error($model,'id_curso'); ?>
	</div>
</div>
 <div class="form-actions"></br></p>
	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'submit',
		'context'=>'primary',
		'label'=>'Crear planificación',
	)); 
        echo CHtml::endForm();  
        ?>        
</div>  

</body>
</html>