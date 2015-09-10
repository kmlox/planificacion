<?php
$this->menu=array(
array('label'=>'Seleccionar Profesor','url'=>array('/usuario/admin')),
array('label'=>'Portal Directivo','url'=>array('/portal/directivo')),
);
?>
<?php $collapse = $this->beginWidget('booster.widgets.TbCollapse'); ?>
<h1>Revisión de Planificaciones</h1>
<p></p>
<p></p>
<h1><?php echo "Profesor(a): ".$model_profesor->nombre_usuario?></h1>
    
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
                    ("id_profesor="."'".$id_profesor."'"." and "
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
                
                <?php 
                
                if($datos_anual->estado=='Borrador'){
                   
                    echo '<a class="view" title="" data-toggle="tooltip" 
                    href='."../../planificacion/".$datos_anual->id_planificacion.'  
                    data-original-title="Detalles">
                    <i class="glyphicon glyphicon-eye-open"></i>
                    </a>';
                    
                    echo '<a class="delete" title="" data-toggle="tooltip" 
                       href='."../../impresion/anual/".$datos_anual->id_planificacion.' 
                        data-original-title="Impresión">
                        <i class="glyphicon glyphicon-print"></i>
                    </a>';
                }
                if($datos_anual->estado=='Por aprobar'){
                    echo '<a class="delete" title="" data-toggle="tooltip"'.
                    'href='."../aprobaranual/".$datos_anual->id_planificacion.' data-original-title="Aprobar">
                    <i class="glyphicon glyphicon-check"></i>
                    </a>';
                    
                     echo '<a class="delete" title="" data-toggle="tooltip"'.
                    'href='."../replanificaranual/".$datos_anual->id_planificacion.' data-original-title="Replanificar">
                    <i class="glyphicon glyphicon-edit"></i>
                    </a>';
                    
                    echo '<a class="view" title="" data-toggle="tooltip" 
                   href='.'../../planificacion/'.$datos_anual->id_planificacion.' 
                    data-original-title="Detalles">
                    <i class="glyphicon glyphicon-eye-open"></i>
                    </a>';
                    
                    echo '<a class="delete" title="" data-toggle="tooltip" 
                       href='."../../impresion/anual/".$datos_anual->id_planificacion.' 
                        data-original-title="Impresión">
                        <i class="glyphicon glyphicon-print"></i>
                    </a>';
                } 
                
                if($datos_anual->estado=='Aprobado'){
                    
                    echo '<a class="delete" title="" data-toggle="tooltip"'.
                    'href='."../replanificaranual/".$datos_anual->id_planificacion.' data-original-title="Replanificar">
                    <i class="glyphicon glyphicon-edit"></i>
                    </a>';
                    
                    echo '<a class="view" title="" data-toggle="tooltip" 
                   href='."../../planificacion/".$datos_anual->id_planificacion.' 
                    data-original-title="Detalles">
                    <i class="glyphicon glyphicon-eye-open"></i>
                    </a>';
                    
                    echo '<a class="delete" title="" data-toggle="tooltip" 
                       href='."../../impresion/anual/".$datos_anual->id_planificacion.' 
                        data-original-title="Impresión">
                        <i class="glyphicon glyphicon-print"></i>
                    </a>';
                    
                    // comprobar si existe al menos una fila que cumpla la condición especificada
                    $exists = Revision::model()->exists('id_planificacion='.$datos_anual->id_planificacion);
                    if($exists==TRUE){
                        $id_revision=  Revision::model()->find('id_planificacion='.$datos_anual->id_planificacion)->id_revision;
                        echo '<a class="delete" title="" data-toggle="tooltip" 
                        href='."../../revision/update/".$id_revision.' 
                        data-original-title="Modificar Registro de Revisión">
                        <i class="glyphicon glyphicon-refresh"></i>
                        </a>';
                    }
                    else{
                        echo '<a class="delete" title="" data-toggle="tooltip" 
                        href='."../../revision/create/".$datos_anual->id_planificacion.' 
                        data-original-title="Registro de Revisión">
                        <i class="glyphicon glyphicon-calendar"></i>
                        </a>';
                    }                       
                    
                } 
                
                ?>
                
                
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
        $filtro_unidad = Yii::app()->db->createCommand("CALL filtro_tipo("."'".$id_profesor."'".","."'Unidad'".")")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               
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
         
        $case='';
        $metodo='';
        $value_button='';
        $metodo2='';
        $value_button2='';
        $visible=TRUE;
        $visible2=TRUE;
        
        foreach($filtro_unidad as $datos){
            if($datos->id_curso==$listado_unidad->id_curso &&
                $datos->id_asignatura==$listado_unidad->id_asignatura){
                $case=$datos->estado;
                switch ($case) {
                    case "Borrador":
                        $metodo='#';
                        $value_button='';
                        $visible=FALSE;
                        $visible2=FALSE;
                        break;
                    case "Por aprobar":
                        $metodo='aprobar';
                        $value_button='Aprobar Planificación';
                        $metodo2='replanificar';
                        $value_button2='Replanificar';
                        break;
                    case "Aprobado":
                        $metodo='replanificar';
                        $value_button='Replanificar'; 
                        $visible2=FALSE;
                        break;                   
                }                                
            }            
        }
        
        echo '
            <form action="../../impresion/unidad" method="post" target="_blank">
            <input type="hidden" name="curso" value="'.$listado_unidad->id_curso.'" />
            <input type="hidden" name="asignatura" value="'.$listado_unidad->id_asignatura.'" />
            <input type="hidden" name="id_profesor" value="'.$id_profesor.'" />
            <input type="hidden" name="estado" value="'.$case.'" />    
            <input type="submit" value="Vista de Impresión" />
           </form>';
        
        
        if($visible==TRUE){
            echo '
                <form action="../'.$metodo.'" method="post">
                <input type="hidden" name="curso" value="'.$listado_unidad->id_curso.'" />
                <input type="hidden" name="asignatura" value="'.$listado_unidad->id_asignatura.'" />
                <input type="hidden" name="profesor" value="'.$id_profesor.'" />
                <input type="hidden" name="tipo" value="Unidad" />
                <input type="submit" value="'.$value_button.'" />
               </form>';
        }
        if($visible2==TRUE){
            echo '
                <form action="../'.$metodo2.'" method="post">
                <input type="hidden" name="curso" value="'.$listado_unidad->id_curso.'" />
                <input type="hidden" name="asignatura" value="'.$listado_unidad->id_asignatura.'" />
                <input type="hidden" name="profesor" value="'.$id_profesor.'" />
                <input type="hidden" name="tipo" value="Unidad" />
                <input type="submit" value="'.$value_button2.'" />
               </form>';
        }
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
                        echo '</td>';
                        echo '
                        <td class="button-column">
                            <a class="view" title="" data-toggle="tooltip" 
                               href='."../../planificacion/".$datos->id_planificacion.
                                ' target="_blank" data-original-title="Detalles">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>                                                  
                        </td>
                    </tr>';
                    }
                    elseif ($datos->estado=="Por aprobar") {
                        echo '<span style="color:blue;">Por aprobar</span>'; 
                        echo '</td>';
                        echo '
                        <td class="button-column">
                            <a class="view" title="" data-toggle="tooltip" 
                               href='."../../planificacion/".$datos->id_planificacion.
                                ' target="_blank" data-original-title="Detalles">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>                                                    
                        </td>
                    </tr>';
                    }
                    elseif ($datos->estado=="Aprobado") {
                        echo '<span style="color:green;">Aprobado</span>';  
                        echo '</td>';
                        echo '
                        <td class="button-column">
                            <a class="view" title="" data-toggle="tooltip" 
                               href='."../../planificacion/".$datos->id_planificacion.
                                ' target="_blank" data-original-title="Detalles">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>';
                            
                            // comprobar si existe al menos una fila que cumpla la condición especificada
                            $exists = Revision::model()->exists('id_planificacion='.$datos->id_planificacion);
                            if($exists==TRUE){
                                $id_revision= Revision::model()->find('id_planificacion='.$datos->id_planificacion)->id_revision;
                                echo '<a class="delete" title="" data-toggle="tooltip" 
                                href='."../../revision/update/".$id_revision.' 
                                data-original-title="Modificar Registro de Revisión">
                                <i class="glyphicon glyphicon-refresh"></i>
                                </a>';
                            }
                            else{
                                echo '<a class="delete" title="" data-toggle="tooltip" 
                                href='."../../revision/create/".$datos->id_planificacion.' 
                                data-original-title="Registro de Revisión">
                                <i class="glyphicon glyphicon-calendar"></i>
                                </a>';
                            } 
                            
                        echo '
                        </td>
                    </tr>';
                    }
                    
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
        $filtro_clase = Yii::app()->db->createCommand("CALL filtro_tipo("."'".$id_profesor."'".","."'Clase a clase'".")")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               
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
        
        $case='';
        $metodo='';
        $value_button='';
        $metodo2='';
        $value_button2='';
        $visible=TRUE;
        $visible2=TRUE;
        
        foreach($filtro_clase as $datos){
            if($datos->id_curso==$listado_unidad->id_curso &&
                $datos->id_asignatura==$listado_unidad->id_asignatura){
                $case=$datos->estado;
                switch ($case) {
                    case "Borrador":
                        $metodo='#';
                        $value_button='';
                        $visible=FALSE;
                        $visible2=FALSE;
                        break;
                    case "Por aprobar":
                        $metodo='aprobar';
                        $value_button='Aprobar Planificación';
                        $metodo2='replanificar';
                        $value_button2='Replanificar';
                        break;
                    case "Aprobado":
                        $metodo='replanificar';
                        $value_button='Replanificar'; 
                        $visible2=FALSE;
                        break;                   
                }                                
            }            
        }
        
         echo '
            <form action="../../impresion/clase" method="post" target="_blank">
            <input type="hidden" name="curso" value="'.$listado_unidad->id_curso.'" />
            <input type="hidden" name="asignatura" value="'.$listado_unidad->id_asignatura.'" />
            <input type="hidden" name="id_profesor" value="'.$id_profesor.'" />
            <input type="hidden" name="estado" value="'.$case.'" /> 
            <input type="submit" value="Vista de Impresión" />
           </form>';
         
        
        if($visible==TRUE){
            echo '
                <form action="../'.$metodo.'" method="post">
                <input type="hidden" name="curso" value="'.$listado_unidad->id_curso.'" />
                <input type="hidden" name="asignatura" value="'.$listado_unidad->id_asignatura.'" />
                <input type="hidden" name="profesor" value="'.$id_profesor.'" />
                <input type="hidden" name="tipo" value="Clase a clase" />
                <input type="submit" value="'.$value_button.'" />
               </form>';
        }
        if($visible2==TRUE){
            echo '
                <form action="../'.$metodo2.'" method="post">
                <input type="hidden" name="curso" value="'.$listado_unidad->id_curso.'" />
                <input type="hidden" name="asignatura" value="'.$listado_unidad->id_asignatura.'" />
                <input type="hidden" name="profesor" value="'.$id_profesor.'" />
                <input type="hidden" name="tipo" value="Clase a clase" />
                <input type="submit" value="'.$value_button2.'" />
               </form>';
        }
                   
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
                echo '</td>';
                echo '
                <td class="button-column">
                    <a class="view" title="" data-toggle="tooltip" 
                       href='."../../planificacion/".$datos->id_planificacion.
                        ' target="_blank" data-original-title="Detalles">
                        <i class="glyphicon glyphicon-eye-open"></i>
                    </a>                                          
                </td>
            </tr>';
            }
            elseif ($datos->estado=="Por aprobar") {
                echo '<span style="color:blue;">Por aprobar</span>'; 
                echo '</td>';
                echo '
                <td class="button-column">
                    <a class="view" title="" data-toggle="tooltip" 
                       href='."../../planificacion/".$datos->id_planificacion.
                        ' target="_blank" data-original-title="Detalles">
                        <i class="glyphicon glyphicon-eye-open"></i>
                    </a>                                                    
                </td>
            </tr>';
            }
            elseif ($datos->estado=="Aprobado") {
                echo '<span style="color:green;">Aprobado</span>';  
                echo '</td>';
                echo '
                <td class="button-column">
                    <a class="view" title="" data-toggle="tooltip" 
                       href='."../../planificacion/".$datos->id_planificacion.
                        ' target="_blank" data-original-title="Detalles">
                        <i class="glyphicon glyphicon-eye-open"></i>
                    </a>';
                    
                    // comprobar si existe al menos una fila que cumpla la condición especificada
                    $exists = Revision::model()->exists('id_planificacion='.$datos->id_planificacion);
                    if($exists==TRUE){
                        $id_revision=  Revision::model()->find('id_planificacion='.$datos->id_planificacion)->id_revision;
                        echo '<a class="delete" title="" data-toggle="tooltip" 
                        href='."../../revision/update/".$id_revision.' 
                        data-original-title="Modificar Registro de Revisión">
                        <i class="glyphicon glyphicon-refresh"></i>
                        </a>';
                    }
                    else{
                        echo '<a class="delete" title="" data-toggle="tooltip" 
                        href='."../../revision/create/".$datos->id_planificacion.' 
                        data-original-title="Registro de Revisión">
                        <i class="glyphicon glyphicon-calendar"></i>
                        </a>';
                    }                       
                
               echo '
               </td>
           </tr>';
            }
                    
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