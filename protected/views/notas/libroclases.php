<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Notas</title>
<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
.Estilo2 {color: #FF0000; font-weight: bold; }
-->
</style>
</head>

<body>
    
<?php echo CHtml::beginForm('actualizar'); ?>
<table width="800" border="2" align="center">
  <tr>
    <td colspan="7" bordercolor="#000000"><div align="center">
      <h1>Calificaciones</h1>
    </div></td>
  </tr>
  <tr>
    <td colspan="7" bordercolor="#000000">
        <div align="center">
            <strong>
                <?php 
                echo $grado->nombre_grado.' '.'"'.$curso->nombre_curso.'" - '.
                        $asignatura->nombre_asignatura;                
                ?>
            </strong>            
        </div>
    </td>
  </tr>
  <tr>
    <td colspan="7" bordercolor="#000000">&nbsp;</td>
  </tr>
  <tr bordercolor="#A7C0DC" bgcolor="#CCCCCC">
    <td width="507" bordercolor="#000000"><strong>Nombre Alumno</strong></td>
    <?php
        for($i=1;$i<=$n_evaluaciones;$i++){
            echo '<td width="36" bordercolor="#000000"><strong>E'.$i.'</strong></td>';
        }
        
    ?>
    <td width="69" bordercolor="#000000"><strong>Prom</strong></td>
  </tr>
<style type="text/css">
  .uneditable-input {
  display: inline-block;
  height: 28px;
  padding: 4px;
  margin-bottom: 9px;
  font-size: 13px;
  line-height: 18px;
  color: #555555;
  width: initial;
}
</style>
  <?php 
  
  foreach ($alumnos as $row){
       echo
        '<tr>
          <td bordercolor="#000000">'.$row->nombre_usuario.'</td>';
       
        foreach ($evaluaciones as $filas){
            $calificaciones=Calificacion::model()->find("id_alumno="."'".$row->id_usuario."' and "
                    . "id_evaluacion=".$filas->id_evaluacion);
            
            $nota=NULL;
            
            if($calificaciones!=NULL){
                $nota=$calificaciones->nota;
            }
            
           echo '<td bordercolor="#000000">'
            . '<input type="text" size="2" maxlength="3" name="'.$row->id_usuario.",".$filas->id_evaluacion.'"'
            . 'value="'.$nota.'"></input></td>';                     
           
        }
       
        $promedio=Yii::app()->db->createCommand("SELECT promedio_asignatura_alumno("
                ."'".$row->id_usuario."',"."'".$asignatura->id_asignatura."')"                
                )->queryScalar();  
          
           echo '<td bordercolor="#000000" bgcolor="#CCCCCC"><strong>'.$promedio.'</strong></td>';
        echo '</tr>';
  }  
  ?>
  
</table>


<p>&nbsp;</p>
<table width="800" border="0" align="center">
    <?php
    $cont=1;
    foreach ($evaluaciones as $datos){
        echo '
        <tr>
          <td colspan="7">E'.$cont.': '.$datos->nombre_evaluacion.'</td>
        </tr>';
        $cont++;
    }
    ?>
</table>
<p></p>
<p></p>
<?php
echo "<input type='hidden' name='id_curso' value='".$id_curso."' >"; 
echo "<input type='hidden' name='id_asignatura' value='".$id_asignatura."' >"; 
echo "<input type='hidden' name='id_grado' value='".$id_grado."' >"; 

?>
<p align="center">
    
    <?php
    
    $this->widget(
        'booster.widgets.TbButton',
        array(
            'label' => 'Guardar Cambios',
            'context' => 'primary',
            'buttonType'=>'submit',
           // 'buttonName'=>'guardar',
             
        )
    ); 
    echo " ";
    $this->widget(
        'booster.widgets.TbButton',
        array(
            'label' => 'Actualizar Datos',
            'context' => 'success',
            'buttonType'=>'submit',             
        )
    ); 
    
    echo CHtml::endForm();

?>
    
</p>
</body>
</html>
