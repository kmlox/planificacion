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
        <h1>Planificación Curricular</h1>
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
    <td height="80"><strong>[Objetivos de Aprendizaje]</strong>
        <p></p>
      *Indicadores</td>
    <td><strong>Habilidades</strong></td>
    <td><strong>Actitudes</strong></td>
    <td><strong>Actividades</strong></td>
    <td><strong>Recursos</strong></td>
    <td><strong>Conocimientos Previos</strong></td>
    <td><strong>Conocimientos</strong></td>
    <td><strong>Evaluaci&oacute;n</strong></td>
  </tr>
  <?php 
	 foreach ($planificaciones as $row){
	echo '    
    <tr valign="top">    
      <td>';?>
  <?php 
           
         if($tipo=='Anual'){
              $listar_oa = Yii::app()->db->createCommand("CALL filtro_OA_indicadores(".$planificaciones->id_planificacion.")")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               
         }
         else{
             $listar_oa = Yii::app()->db->createCommand("CALL filtro_OA_indicadores(".$row->id_planificacion.")")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               

         }
                $id_oa='';          
        foreach ($listar_oa as $data) {
                    if($id_oa!=$data->id_OA){
                        $codigooa=substr($data->id_OA,4,8);
                        echo "<strong>[".$codigooa."] ".$data->descripcion_OA."</strong><p></p>";                        
                        $id_oa=$data->id_OA;
                    }
                        echo "*".$data->descripcion_indicador."<p></p>"; 
                }
             ?>
  <?php echo '</td>';
     if($tipo=='Anual'){
      echo '<td>'.$planificaciones->habilidades.'</td>'; 
      echo '<td>'.$planificaciones->actitudes.'</td>';
      echo '<td>'.$planificaciones->actividades.'</td>';
      echo '<td>'.$planificaciones->recursos.'</td>'; 
      echo '<td>'.$planificaciones->conocimientos_previos.'</td>'; 
      echo '<td>'.$planificaciones->conocimientos.'</td>'; 
      echo '<td>'."implementar".'</td>'; 
   }
   else{
        echo '<td>'.$row->habilidades.'</td>'; 
        echo '<td>'.$row->actitudes.'</td>';
        echo '<td>'.$row->actividades.'</td>';
        echo '<td>'.$row->recursos.'</td>'; 
        echo '<td>'.$row->conocimientos_previos.'</td>'; 
        echo '<td>'.$row->conocimientos.'</td>'; 
        echo '<td>'."implementar".'</td>'; 
   }
   ?> <?php echo '</tr>'; ?>
  <?php } ?>
</table>
</body>
</html>
    
