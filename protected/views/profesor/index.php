<?php
$this->menu=array(
array('label'=>'Crear Planificacion','url'=>array('/crear')),
);
?>
<?php $collapse = $this->beginWidget('booster.widgets.TbCollapse'); ?>
<h1>Mis Planificaciones</h1>
<p></p>
<p></p>
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Planificación Anual
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">
      <div class="panel-body">
         <?php $box = $this->beginWidget(
            'booster.widgets.TbPanel',
            array(
                'title' => 'Resumen',
                'headerIcon' => 'th-list',
                'padContent' => false,
                'htmlOptions' => array('class' => 'bootstrap-widget-table')
            )
        );?>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Asignatura</th>
            <th>Curso</th>
            <th>Fecha Inicio</th>
            <th>Fecha Término</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            <?php 
            $cont1=1;
            $model_anual=Planificacion::model()->findAll
                    ("id_profesor="."'".Yii::app()->user->name."'"." and "
                    ."tipo='Anual'");
            foreach($model_anual as $datos_anual){
            ?>
        <tr class="odd">
           
            <td style="width: 60px"><?php echo $cont1?></td>
            <td><?php echo Asignatura::model()->findbyPk($datos_anual->id_asignatura)->nombre_asignatura?></td>
            <td><?php 
            $curso=Curso::model()->findbyPk($datos_anual->id_curso);
            $grado=Grado::model()->findbyPk($curso->id_grado);
            echo $grado->nombre_grado." ".$curso->nombre_curso;
            ?></td>
            <td><?php echo $datos_anual->fecha_inicio?></td>
            <td><?php echo $datos_anual->fecha_termino ?></td>            
            <td><?php 
            if($datos_anual->estado=="Borrador"){
                echo '<span style="color:red;">Borrador</span>';                
            }
            elseif ($datos_anual->estado=="Por aprobar") {
                echo '<span style="color:blue;">Por aprobar</span>';  
            }
            elseif ($datos_anual->estado=="Aprobado") {
                echo '<span style="color:green;">Aprobado</span>';  
            }
            ?>
            </td>
            <td class="button-column">
                <a class="view" title="" data-toggle="tooltip" 
                   href=<?php echo "planificacion/".$datos_anual->id_planificacion?>
                   data-original-title="Detalles">
                    <i class="glyphicon glyphicon-eye-open"></i>
                </a> 
                <a class="update" title="" data-toggle="tooltip" 
                   href= <?php echo "planificacion/update/".$datos_anual->id_planificacion?>                 
                   data-original-title="Modificar">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a> 
                <a class="delete" title="" data-toggle="tooltip" 
                   href=<?php echo "planificacion/delete/".$datos_anual->id_planificacion?>
                   data-original-title="Eliminar">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
                <a class="delete" title="" data-toggle="tooltip" 
                   href=<?php echo "impresion/anual/".$datos_anual->id_planificacion?>
                   data-original-title="Impresión">
                    <i class="glyphicon glyphicon-print"></i>
                </a>
                <a class="delete" title="" data-toggle="tooltip" 
                   href=<?php echo "planificacion/revision/".$datos_anual->id_planificacion?>
                   data-original-title="Enviar">
                    <i class="glyphicon glyphicon-check"></i>
                </a>
            </td>
        </tr>  
         <?php $cont1=$cont1+1;} ?>
        </tbody>
    </table>
<?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Planificación por Unidad
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
        <?php 
        $filtro_unidad = Yii::app()->db->createCommand("CALL filtro_tipo("."'".Yii::app()->user->name."'".","."'Unidad'".")")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               
        $idcurso='';
        $idasignatura='';
        foreach ($filtro_unidad as $listado_unidad) { 
            if($idasignatura!=$listado_unidad->id_asignatura OR $idcurso!=$listado_unidad->id_curso){
            $curso=Curso::model()->findbyPk($listado_unidad->id_curso);
            $grado=Grado::model()->findbyPk($listado_unidad->id_grado);
            $asignatura=Asignatura::model()->findbyPk($listado_unidad->id_asignatura);                   
        ?>
       
        <?php echo '<div class="panel-body">';
         $box = $this->beginWidget(
            'booster.widgets.TbPanel',
            array(
                'title' => $grado->nombre_grado." ".$curso->nombre_curso." - ".$asignatura->nombre_asignatura,
                'headerIcon' => 'th-list',
                'padContent' => false,
                'htmlOptions' => array('class' => 'bootstrap-widget-table')
            )
        );
         echo '
            <table class="table">
            <thead>
              <tr>           
            ';
         echo '
            <form action="impresion/unidad" method="post" target="_blank">
            <input type="hidden" name="curso" value="'.$listado_unidad->id_curso.'" />
            <input type="hidden" name="asignatura" value="'.$listado_unidad->id_asignatura.'" />
            <input type="submit" value="Vista de Impresión" />
           </form>';
           echo '
            </tr>
            <tr>
                <th>Unidad N°</th>               
                <th>Fecha Inicio</th>
                <th>Fecha Término</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>';       
            
            $cont1=1;
           
            foreach($filtro_unidad as $datos){
                if($datos->id_curso==$listado_unidad->id_curso &&
                    $datos->id_asignatura==$listado_unidad->id_asignatura){
                
            echo '
            <tr class="odd">           
            <td>';            
           
            echo $cont1.'</td>';            
            
            echo '<td>'.$datos->fecha_inicio.'</td>';
            echo '<td>'.$datos->fecha_termino.'</td>';
            echo '<td>';
             
            if($datos->estado=="Borrador"){
                echo '<span style="color:red;">Borrador</span>';                
            }
            elseif ($datos->estado=="Por aprobar") {
                echo '<span style="color:blue;">Por aprobar</span>';  
            }
            elseif ($datos->estado=="Aprobado") {
                echo '<span style="color:green;">Aprobado</span>';  
            }
            
            echo '</td>';
            echo '
            <td class="button-column">
                <a class="view" title="" data-toggle="tooltip" 
                   href='; echo "planificacion/".$datos->id_planificacion;
                   echo ' target="_blank" data-original-title="Detalles">
                    <i class="glyphicon glyphicon-eye-open"></i>
                </a> 
                <a class="update" title="" data-toggle="tooltip" 
                   href= '; echo "planificacion/update/".$datos->id_planificacion;                 
                    echo ' data-original-title="Modificar">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a> 
                <a class="delete" title="" data-toggle="tooltip" 
                   href='; echo "planificacion/delete/".$datos->id_planificacion;
                    echo ' data-original-title="Eliminar">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
                <a class="delete" title="" data-toggle="tooltip" 
                   href='; echo "planificacion/revision/".$datos->id_planificacion;
                   echo ' data-original-title="Enviar">
                    <i class="glyphicon glyphicon-check"></i>
                </a>            
            </td>
        </tr>';
                    
        $cont1=$cont1+1;  
        ?>
        <?php         
                }
            }
        ?>
        <?php
    echo '    
    </tbody>
    </table>';
    
    $this->endWidget(); 
    echo '</div>';?>
        <?php  
                $idcurso=$listado_unidad->id_curso;
                $idasignatura=$listado_unidad->id_asignatura;
            }       
        } 
        ?>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          Planificación Clase a Clase
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
           <?php 
        $filtro_clase = Yii::app()->db->createCommand("CALL filtro_tipo("."'".Yii::app()->user->name."'".","."'Clase a clase'".")")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               
        $idcurso='';
        $idasignatura='';
        foreach ($filtro_clase as $listado_unidad) { 
            if($idasignatura!=$listado_unidad->id_asignatura OR $idcurso!=$listado_unidad->id_curso){
            $curso=Curso::model()->findbyPk($listado_unidad->id_curso);
            $grado=Grado::model()->findbyPk($listado_unidad->id_grado);
            $asignatura=Asignatura::model()->findbyPk($listado_unidad->id_asignatura);                   
        ?>
       
        <?php echo '<div class="panel-body">';
         $box = $this->beginWidget(
            'booster.widgets.TbPanel',
            array(
                'title' => $grado->nombre_grado." ".$curso->nombre_curso." - ".$asignatura->nombre_asignatura,
                'headerIcon' => 'th-list',
                'padContent' => false,
                'htmlOptions' => array('class' => 'bootstrap-widget-table')
            )
        );
         echo '
            <table class="table">
            <thead>
              <tr>           
            ';
         echo '
            <form action="impresion/clase" method="post" target="_blank">
            <input type="hidden" name="curso" value="'.$listado_unidad->id_curso.'" />
            <input type="hidden" name="asignatura" value="'.$listado_unidad->id_asignatura.'" />
            <input type="submit" value="Vista de Impresión" />
           </form>';
           echo '
            </tr>
            <tr>
                <th>Unidad N°</th>               
                <th>Fecha Inicio</th>
                <th>Fecha Término</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>';       
            
            $cont2=1;
           
            foreach($filtro_clase as $datos){
                if($datos->id_curso==$listado_unidad->id_curso &&
                    $datos->id_asignatura==$listado_unidad->id_asignatura){
                
            echo '
            <tr class="odd">           
            <td>';            
           
            echo $cont2.'</td>';            
            
            echo '<td>'.$datos->fecha_inicio.'</td>';
            echo '<td>'.$datos->fecha_termino.'</td>';
            echo '<td>';
             
            if($datos->estado=="Borrador"){
                echo '<span style="color:red;">Borrador</span>';                
            }
            elseif ($datos->estado=="Por aprobar") {
                echo '<span style="color:blue;">Por aprobar</span>';  
            }
            elseif ($datos->estado=="Aprobado") {
                echo '<span style="color:green;">Aprobado</span>';  
            }
            
            echo '</td>';
            echo '
            <td class="button-column">
                <a class="view" title="" data-toggle="tooltip" 
                   href='; echo "planificacion/".$datos->id_planificacion;
                   echo ' target="_blank" data-original-title="Detalles">
                    <i class="glyphicon glyphicon-eye-open"></i>
                </a> 
                <a class="update" title="" data-toggle="tooltip" 
                   href= '; echo "planificacion/update/".$datos->id_planificacion;                 
                    echo ' data-original-title="Modificar">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a> 
                <a class="delete" title="" data-toggle="tooltip" 
                   href='; echo "planificacion/delete/".$datos->id_planificacion;
                    echo ' data-original-title="Eliminar">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>  
                 <a class="delete" title="" data-toggle="tooltip" 
                   href='; echo "planificacion/revision/".$datos->id_planificacion;
                   echo ' data-original-title="Enviar">
                    <i class="glyphicon glyphicon-check"></i>
                </a>
            </td>
        </tr>';
                    
        $cont2=$cont2+1;  
        ?>
        <?php         
                }
            }
        ?>
        <?php
    echo '    
    </tbody>
    </table>';
    
    $this->endWidget(); 
    echo '</div>';?>
        <?php  
                $idcurso=$listado_unidad->id_curso;
                $idasignatura=$listado_unidad->id_asignatura;
            }       
        } 
        ?>
    </div>
  </div>
</div>
<?php $this->endWidget(); ?>