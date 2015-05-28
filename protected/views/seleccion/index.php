<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Selección Profesor</title>
<style type="text/css"></style></head>
<body>
    <?php
        echo CHtml::beginForm('utp/index');
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
					'url'=>CController::createUrl('Seleccion/SelectGrado'),
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
					'url'=>CController::createUrl('Seleccion/SelectAsignatura'),
					'update'=>'#id_asignatura',
					'data'=>array('id_grado'=>'js:this.value'),
					)));
					?>
				</td>
                                <td><span class="required">*</span>Asignatura
					<?php 		
					echo CHtml::dropDownList('id_asignatura','',array(),
					array(
                                        'prompt'=>'Seleccione Asignatura',
					'ajax'=>array(
					'type'=>'POST',
					'url'=>CController::createUrl('Seleccion/SelectProfesor'),
					'update'=>'#descripcion',
                                        'data'=>array('id_asignatura'=>'js:this.value'),
					)));
					?>		
				</td>                               
  			</tr>
  		</table>  		
	</div>
        
        <?php  echo '<div id="descripcion"></div></br>';  ?>

</body>
    <div class="form-actions"></br></p>
	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'submit',
		'context'=>'primary',
		'label'=>'Crear planificación',
	)); 
        echo CHtml::endForm();  
        ?>        
    </div>  
</html>