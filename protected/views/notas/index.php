<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Seleccion Curso</title>
<style type="text/css"></style></head>
<body>

<h1>Selección</h1>

<div align="center">
  <table width="800" border="0">
   
    <tr>
      <td width="259">
        <?php
        echo CHtml::beginForm('notas/libroclases');
        ?>        
      </td>
    </tr>
</table>
</div>
    
<div class="row">
    <table>
        <tr>
            <td><span class="required">*</span>Nivel
                    <?php echo CHtml::dropDownList('id_nivel','',CHtml::ListData(Nivel::model()->findAll(),'id_nivel','nombre_nivel'),
                    array(
                    'prompt'=>'Seleccione Nivel',
                    'ajax'=>array(
                    'type'=>'POST',
                    'url'=>CController::createUrl('Notas/SelectGrado'),
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
                    'url'=>CController::createUrl('Notas/SelectCurso'),
                    'update'=>'#id_curso',
                    'data'=>array('id_grado'=>'js:this.value'),
                    )));
                    ?>
            </td>
        </tr>
        
        <tr>
            <td><span class="required">*</span>Curso
                <?php 		
                echo CHtml::dropDownList('id_curso','',array(),
                 array(
                'prompt'=>'Seleccione Curso',
                'ajax'=>array(
                'type'=>'POST',
                'url'=>CController::createUrl('Notas/SelectAsignatura'),
                'update'=>'#id_asignatura',
                'data'=>array('id_curso'=>'js:this.value'),
                )));
                ?>		
            </td>
            
            <td>
                <span class="required">*</span>Asignatura
                    <?php 		
                    echo CHtml::dropDownList('id_asignatura','',array(),
                     array(
                    'prompt'=>'Seleccione Asignatura',
                    'ajax'=>array(
                    'type'=>'POST',
                    //'url'=>CController::createUrl('Notas/SelectEvaluacion'),
                    //'update'=>'#id_evaluacion',
                    //'data'=>array('id_asignatura'=>'js:this.value'),
                    )));
                    ?>	                                   
            </td>
        </tr>
    </table>
</div>
    
<div class="form-actions"></br></p>
	<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'submit',
		'context'=>'primary',
		'label'=>'Ir a Libro de Clases',
	)); 
        echo CHtml::endForm();  
        ?>        
</div>  

</body>
</html>