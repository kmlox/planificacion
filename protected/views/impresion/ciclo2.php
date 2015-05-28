<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<title>Planificación Curricular</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style2.css" />
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
      <td height="80"><strong>Objetivos Fundamentales<p>Verticales</strong></td>
      <td><strong>Contenidos Mínimos<p>Obligatorios</strong></td>
    <td><strong>Aprendizajes Esperados</strong></td>
    <td><strong>Actividades</strong></td>
    <td><strong>Recursos</strong></td>
    <td><strong>Habilidades</strong></td>
    <td><strong>Evaluación</strong></td>
  </tr>
  <?php 
        $array_ofv=array();
        $array_cmo=array();
        $array_ae=array();
	
  ?>
  
  <?php 
     if($tipo=='Anual'){
        $planofv=PlanificacionTieneOFV::model()->findAll("id_planificacion=".$planificaciones->id_planificacion);
            foreach($planofv as $data1){
                    array_push($array_ofv, $data1->id_OFV);                   
            }
            $ofvs = OFV::model()->findAllByAttributes(array("id_OFV"=>$array_ofv));
                    
            $plancmo=PlanificacionTieneCMO::model()->findAll("id_planificacion=".$planificaciones->id_planificacion);
            foreach($plancmo as $data2){
                    array_push($array_cmo, $data2->id_CMO);                   
            }
            $cmos=CMO::model()->findAllByAttributes(array("id_CMO"=>$array_cmo));
            
            $planae=PlanificacionTieneAE::model()->findAll("id_planificacion=".$planificaciones->id_planificacion);
            foreach($planae as $data3){
                    array_push($array_ae, $data3->id_AE);                   
            }
            $aes=AE::model()->findAllByAttributes(array("id_AE"=>$array_ae));
         
        echo '<tr valign="top">';
        echo '<td>';
        foreach($ofvs as $datos){
            echo $datos->descripcion_OFV."<p></p>";
        }
        echo '</td>';
        
        echo '<td>';
        foreach($cmos as $datos){
            echo $datos->descripcion_CMO."<p></p>";
        }
        echo '</td>'; 
        
        echo '<td>';
        foreach($aes as $datos){
            echo $datos->descripcion_AE."<p></p>";
        }
        echo '</td>';
        
        echo '<td>'.$planificaciones->actividades.'</td>';
        echo '<td>';
        echo $planificaciones->recursos."<br>";
        $material= MaterialApoyo::model()->findAll('id_planificacion='.$planificaciones->id_planificacion);
        $cont=1;
        foreach ($material as $data){
            echo "<p><p><strong>Material Apoyo ".$cont.": "."<a href='".$data->url."' target='_blank'>". $data->nombre_material_apoyo."</a>";
            $cont++;            
        }
        echo'</td>'; 
        echo '<td>'.$planificaciones->habilidades.'</td>'; 
        $evaluaciones=PlanificacionTieneEvaluacion::model()->findAll('id_planificacion='.$planificaciones->id_planificacion);
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
   }
   else{
       $n=1;
       foreach ($planificaciones as $row){
            $planofv=PlanificacionTieneOFV::model()->findAll("id_planificacion=".$row->id_planificacion);
            foreach($planofv as $data){
                    array_push($array_ofv, $data->id_OFV);                   
            }
            $ofvs = OFV::model()->findAllByAttributes(array("id_OFV"=>$array_ofv));
                    
            $plancmo=PlanificacionTieneCMO::model()->findAll("id_planificacion=".$row->id_planificacion);
            foreach($plancmo as $data){
                    array_push($array_cmo, $data->id_CMO);                   
            }
            $cmos=CMO::model()->findAllByAttributes(array("id_CMO"=>$array_cmo));
            
            $planae=PlanificacionTieneAE::model()->findAll("id_planificacion=".$row->id_planificacion);
            foreach($planae as $data){
                    array_push($array_ae, $data->id_AE);                   
            }
            $aes=AE::model()->findAllByAttributes(array("id_AE"=>$array_ae));
            
        echo '<tr valign="top">';
        echo '<td><strong>'."N°".$n."</strong><p>Inicio:<br>".$row->fecha_inicio."<br>"."Término:<br>".$row->fecha_termino.'<br></td>'; 
        $n++;
       echo '<td>';
        foreach($ofvs as $datos){
            echo $datos->descripcion_OFV."<p></p>";
        }
        echo '</td>';
        
        echo '<td>';
        foreach($cmos as $datos){
            echo $datos->descripcion_CMO."<p></p>";
        }
        echo '</td>'; 
        
        echo '<td>';
        foreach($aes as $datos){
            echo $datos->descripcion_AE."<p></p>";
        }
        echo '</td>';
        
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
        echo '<td>'.$row->habilidades.'</td>'; 
        
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
   }
   ?> 
</table>
</body>
</html>
    
