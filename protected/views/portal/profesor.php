
<h1>Portal Profesor</h1>

<!----------------------------------------------------------------------->
<div class="panel-group" id="acordeon">
   <div class="panel panel-default">
      <div class="panel-heading">
      	<h4 class="panel-title">
          <img style="float: left; width: 64px; height: 64px;" 
            src=<?php echo Yii::app()->baseUrl.'/images/portal/planificacion.png '?>alt="64x64"
            accesskey=""class="img-circle"/>  
          <br>&nbsp;&nbsp;
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordeon" href="#collapse_uno">
            Planificaciones<br><br>
	  </a>
     	</h4>
      </div>
      <div id="collapse_uno" class="panel-collapse collapse">
      	<div class="panel-body">
            <div class="well well-small">
                <a href='../profesor' title='Mis Planificaciones'>Mis Planificaciones</a>
            </div> 
            <div class="well well-small">
                <a href='../planificacion' title='Listado de Planificaciones'>Listado de Planificaciones</a>
            </div>
            <div class="well well-small">
                <a href='../planificacion/admin' title='Administración de Planificaciones'>Administración de Planificaciones</a>
            </div>
            <div class="well well-small">
                <a href='../crear' title='Crear Planificación'>Crear Planificación</a>
            </div>          
        </div>
      </div>
   </div>
   <div class="panel panel-default">
      <div class="panel-heading">
      	<h4 class="panel-title">
          <img style="float: left; width: 64px; height: 64px;" 
            src=<?php echo Yii::app()->baseUrl.'/images/portal/ejes.png '?>alt="64x64"
            accesskey=""class="img-circle"/>  
          <br>&nbsp;&nbsp;
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordeon" href="#collapse_dos">
            Ejes Temáticos<br><br>
	  </a>
     	</h4>
      </div>
      <div id="collapse_dos" class="panel-collapse collapse">
         <div class="panel-body">
            <div class="well well-small">
                <strong>Objetivos de Aprendizaje (OA)</strong>
                <div>
                    <a href='../oA' title='Listado'>Listado</a><br>
                    <a href='../oA/admin' title='Administrar'>Administrar</a><br>
                    <a href='../oA/create' title='Crear'>Crear</a>
                </div>
            </div> 
            <div class="well well-small">
                <strong>Indicadores</strong>
                <div>
                    <a href='../indicador' title='Listado'>Listado</a><br>
                    <a href='../indicador/admin' title='Administrar'>Administrar</a><br>
                    <a href='../indicador/create' title='Crear'>Crear</a>
                </div>
            </div> 
            <div class="well well-small">
                <strong>Aprendizajes Esperados (AE)</strong>
                <div>
                    <a href='../aE' title='Listado'>Listado</a><br>
                    <a href='../aE/admin' title='Administrar'>Administrar</a><br>
                    <a href='../aE/create' title='Crear'>Crear</a>
                </div>
            </div> 
            <div class="well well-small">
                <strong>Contenidos Mínimos Obligatorios (CMO)</strong>
                <div>
                    <a href='../cMO' title='Listado'>Listado</a><br>
                    <a href='../cMO/admin' title='Administrar'>Administrar</a><br>
                    <a href='../cMO/create' title='Crear'>Crear</a>
                </div>
            </div> 
            <div class="well well-small">
                <strong>Objetivos Fundamentales Verticales (OFV)</strong>
                <div>
                    <a href='../oFV' title='Listado'>Listado</a><br>
                    <a href='../oFV/admin' title='Administrar'>Administrar</a><br>
                    <a href='../oFV/create' title='Crear'>Crear</a>
                </div>
            </div> 
         </div>
      </div>
      </div>
    <div class="panel panel-default">
       <div class="panel-heading">
          <h4 class="panel-title">
              <img style="float: left; width: 64px; height: 64px;" 
                src=<?php echo Yii::app()->baseUrl.'/images/portal/evaluacion.png '?>alt="64x64"
                accesskey=""class="img-circle"/>  
              <br>&nbsp;&nbsp;
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordeon" href="#collapse_tres">
                Evaluaciones<br><br>
              </a>
          </h4>
       </div>
       <div id="collapse_tres" class="panel-collapse collapse">
          <div class="panel-body">
              <div class="well well-small">
                  <a href='../evaluacion' title='Listado de Evaluaciones'>Listado de Evaluaciones</a>
              </div> 
              <div class="well well-small">
                  <a href='../evaluacion/create' title='Crear Evaluación'>Crear Evaluación</a>
              </div> 
              <div class="well well-small">
                  <a href='../evaluacion/admin' title='Administrar Evaluaciones'>Administrar Evaluaciones</a>
              </div> 
          </div>
       </div>
    </div>
    <div class="panel panel-default">
       <div class="panel-heading">
          <h4 class="panel-title">
              <img style="float: left; width: 64px; height: 64px;" 
                src=<?php echo Yii::app()->baseUrl.'/images/portal/libro_clases.png '?>alt="64x64"
                accesskey=""class="img-circle"/>  
              <br>&nbsp;&nbsp;
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordeon" href="#collapse_cuatro">
                  Libro de Clases<br><br>
              </a>
          </h4>
       </div>
       <div id="collapse_cuatro" class="panel-collapse collapse">
          <div class="panel-body">
              <div class="well well-small">
                  <a href='../notas' title='Registro de Notas'>Registro de Notas</a>
              </div> 
          </div>
       </div>
    </div>
    <div class="panel panel-default">
         <div class="panel-heading">
            <h4 class="panel-title">
                <img style="float: left; width: 64px; height: 64px;" 
                  src=<?php echo Yii::app()->baseUrl.'/images/portal/informes.png '?>alt="64x64"
                  accesskey=""class="img-circle"/>  
                <br>&nbsp;&nbsp;
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordeon" href="#collapse_cinco">
                    Informes<br><br>
                </a>
            </h4>
         </div>
         <div id="collapse_cinco" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="well well-small">
                    <a href='../informealumno' title='Informe por Alumno'>Informe por Alumno</a>
                </div> 
                <div class="well well-small">
                    <a href='../informecurso' title='Informe por Curso'>Informe por Curso</a>
                </div> 
            </div>
         </div>
      </div>
    <div class="panel panel-default">
         <div class="panel-heading">
            <h4 class="panel-title">
                <img style="float: left; width: 64px; height: 64px;" 
                  src=<?php echo Yii::app()->baseUrl.'/images/portal/opciones.png '?>alt="64x64"
                  accesskey=""class="img-circle"/>  
                <br>&nbsp;&nbsp;
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordeon" href="#collapse_seis">
                    Cuenta<br><br>
                </a>
            </h4>
         </div>
         <div id="collapse_seis" class="panel-collapse collapse">
             <div class="panel-body">
                <div class="well well-small">
                  <a href='../usuario/configuracion' title='Cambiar password'>Cambiar password</a>
                </div>
            </div>
         </div>
    </div>
</div>
