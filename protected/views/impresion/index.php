<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<title>Planificación Curricular</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style2.css" />
<style>
table th {
    font-weight: bold;
    border-color:white;
    padding: 5px 2px;
    text-align: center; 
}

table td {
    padding: 9px 10px;
    text-align: left; 
    border: 2px solid black;   
}
</style>
</head>
<body>
<input id="printpagebutton" type="image" src="<?php echo Yii::app()->baseUrl."/images/web/imprimir_planificacion.png"?>" style="width:200px;height:40px" value="Print this page" onClick="printpage()" align="center"/>
<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
</script>

<table width="1248" border="3" align="center">
  <tr>
    <th height="5" colspan="8">
        <h1>Planificación Curricular <?php if($estado!='Aprobado'){echo "- ".$estado;} ?></h1>
        <h2>Año Académico: <?php echo date('Y'); ?> </h2>
    </th>
  </tr>
    <tr>
    <?php
        echo '<th height="5" colspan="8"><img src="'.Yii::app()->baseUrl."/images/colegio/logo.png".'" alt="Logo Colegio" style="width:80px;height:80px"></td>';
    
    ?>     
    </tr>
  <tr align="center">
    <th height="5" colspan="8" ><em>Colegio Germania del Verbo Divino</em></th>
  </tr>
  <tr>
    <th height="5" colspan="4"><strong>Tipo de Planificación</strong>: <?php echo $tipo?></th>
    <th colspan="4"><strong>Asignatura:</strong> <?php echo $nombre_asignatura?></th>
  </tr>
  <tr>
    <th height="5" colspan="4"><strong>Profesor (a):</strong> <?php echo $nombre_profesor?></th>
    <th colspan="4"><strong>Curso:</strong> <?php echo $nombre_curso?></th>
  </tr>
</table>
<table  width="1248" height="450" border="4" align="center">
  <tr valign="top">
    <?php 
    
    if($tipo!='Anual'){echo '<td><strong>'.$tipo.'</strong></td>';}
    ?>
    <td height="80"><strong>[Objetivos de Aprendizaje]</strong>
        <p></p>
      *Indicadores</td>
    <td><strong>Habilidades</strong></td>
    <td><strong>Actitudes</strong></td>
    <td><strong>Actividades</strong></td>
    <td><strong>Recursos</strong></td>
    <td><strong>Conocimientos Previos</strong></td>
    <td><strong>Conocimientos</strong></td>
    <td><strong>Evaluación</strong></td>
  </tr>
 <?php 
     if($tipo=='Anual'){
          $listar_oa = Yii::app()->db->createCommand("CALL filtro_OA_indicadores(".$planificaciones->id_planificacion.")")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               
        
         echo '    
    <tr valign="top">';
         echo '<td>';
                $id_oa='';          
        foreach ($listar_oa as $data) {
                    if($id_oa!=$data->id_OA){
                        $codigooa=substr($data->id_OA,4,8);
                        echo "<strong>[".$codigooa."] ".$data->descripcion_OA."</strong><p></p>";                        
                        $id_oa=$data->id_OA;
                    }
                        echo "*".$data->descripcion_indicador."<p></p>"; 
                }
        echo '</td>';
      echo '<td>'.$planificaciones->habilidades.'</td>'; 
      echo '<td>'.$planificaciones->actitudes.'</td>';
      echo '<td>'.$planificaciones->actividades.'</td>';
      echo '<td>'.$planificaciones->recursos."<br>";
    $material= MaterialApoyo::model()->findAll('id_planificacion='.$planificaciones->id_planificacion);
    $cont=1;
    foreach ($material as $data){
        echo "<p><p><strong>Material Apoyo ".$cont.": "."<a href='".$data->url."' target='_blank'>". $data->nombre_material_apoyo."</a>";
        $cont++;            
    }
    echo'</td>'; 
      echo '<td>'.$planificaciones->conocimientos_previos.'</td>'; 
      echo '<td>'.$planificaciones->conocimientos.'</td>'; 
       $evaluaciones=PlanificacionTieneEvaluacion::model()->findAll('id_planificacion='.$planificaciones->id_planificacion);
        $array_id=array();
                  foreach($evaluaciones as $filas){
                      array_push($array_id, $filas->id_evaluacion);                   
                  }                
         $evaluacion = Evaluacion::model()->findAllByAttributes(array("id_evaluacion"=>$array_id));

        echo '<td>';
        foreach ($evaluacion as $informacion){
            echo "<strong>Nombre Evaluación: ".$informacion->nombre_evaluacion."</strong><br>Descripción: ".$informacion->contenido."<br>"
                    ."Documento: "."<a href='".$informacion->url_documento."' target='_blank'>". $informacion->nombre_documento."</a><p><p><p>";
            //para que no se imprima url se cambia en bootstrap linea a[href]:after{content: " (" attr(href) ")"}
            //por a[href]:after {content: none !important;}
     
        }
        echo '</td>'; 
   }
   else{
       $n=1;
       foreach ($planificaciones as $row){
           echo '<tr valign="top">';
       $listar_oa = Yii::app()->db->createCommand("CALL filtro_OA_indicadores(".$row->id_planificacion.")")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               
              
       echo '<td><strong>'."N°".$n."</strong><p>Inicio:<br>".$row->fecha_inicio."<br>"."Término:<br>".$row->fecha_termino.'<br></td>'; 
       $n++;
       
       echo '<td>';
                $id_oa='';          
        foreach ($listar_oa as $data) {
                    if($id_oa!=$data->id_OA){
                        $codigooa=substr($data->id_OA,4,8);
                        echo "<strong>[".$codigooa."] ".$data->descripcion_OA."</strong><p></p>";                        
                        $id_oa=$data->id_OA;
                    }
                        echo "*".$data->descripcion_indicador."<p></p>"; 
                }
        echo '</td>';
        echo '<td>'.$row->habilidades.'</td>'; 
        echo '<td>'.$row->actitudes.'</td>';
        echo '<td>'.$row->actividades.'</td>';
        echo '<td>';
        echo $row->recursos."<br>";
        $material= MaterialApoyo::model()->findAll('id_planificacion='.$row->id_planificacion);
        $cont=1;
        foreach ($material as $data){
            echo "<p><p><strong>Material Apoyo ".$cont.": "."<a href='".$data->url."' target='_blank'>". $data->nombre_material_apoyo."</a>";
            $cont++;            
        }
        echo'</td>'; 
        echo '<td>'.$row->conocimientos_previos.'</td>'; 
        echo '<td>'.$row->conocimientos.'</td>'; 
        $evaluaciones=PlanificacionTieneEvaluacion::model()->findAll('id_planificacion='.$row->id_planificacion);
        $array_id=array();
                  foreach($evaluaciones as $filas){
                      array_push($array_id, $filas->id_evaluacion);                   
                  }                
         $evaluacion = Evaluacion::model()->findAllByAttributes(array("id_evaluacion"=>$array_id));

        echo '<td>';
        foreach ($evaluacion as $informacion){
            echo "<strong>Nombre Evaluación:</strong> ".$informacion->nombre_evaluacion."<br><strong>Descripción:</strong> ".$informacion->contenido."<br>"
                    ."<strong>Documento: "."<a href='".$informacion->url_documento."' target='_blank'>". $informacion->nombre_documento."</a></strong><p><p><p>";
            //para que no se imprima url se cambia en bootstrap linea a[href]:after{content: " (" attr(href) ")"}
            //por a[href]:after {content: none !important;}
     
        }
        echo '</td>';
        
        echo '</tr>';
    }
   ?>
   <?php } ?>
</table>
</body>
</html>
    
