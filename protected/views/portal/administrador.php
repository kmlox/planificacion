<!----------------------------------------------------------------------->
<h1>Portal Administrador</h1>
<div class="panel-group" id="acordeon">
 <div class="panel panel-default">
      <div class="panel-heading">
      	<h4 class="panel-title">
          <img style="float: left; width: 64px; height: 64px;" 
            src=<?php echo Yii::app()->baseUrl.'/images/portal/usuarios.png '?>alt="64x64"
            accesskey=""class="img-circle"/>  
          <br>&nbsp;&nbsp;
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordeon" href="#collapse_uno">
            Control de Usuarios<br><br>
	  </a>
     	</h4>
      </div>
      <div id="collapse_uno" class="panel-collapse collapse">
      	<div class="panel-body">
            <div class="well well-small">
                <a href='../usuario/create' title='Crear Usuario'>Crear Usuario</a>
            </div>
            <div class="well well-small">
                <a href='../alumno/create' title='Carga Masiva de Alumnos'>Carga Masiva de Alumnos</a>
            </div> 
            <div class="well well-small">
                <a href='../usuario/admin' title='Administrar Usuarios'>Administrar Usuarios</a>
            </div>
            <div class="well well-small">
                <a href='../usuario' title='Listado de Usuarios'>Listado de Usuarios</a>
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
              src=<?php echo Yii::app()->baseUrl.'/images/portal/asignaturas.png '?>alt="64x64"
              accesskey=""class="img-circle"/>  
            <br>&nbsp;&nbsp;
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordeon" href="#collapse_tres">
              Asignaturas<br><br>
            </a>
          </h4>
        </div>
        <div id="collapse_tres" class="panel-collapse collapse">
          <div class="panel-body">
              <div class="well well-small">
                  <a href='../asignatura/create' title='Crear Asignatura'>Crear Asignatura</a>
              </div>
              <div class="well well-small">
                  <a href='../asignatura/admin' title='Administrar Asignaturas'>Administrar Asignaturas</a>
              </div>
              <div class="well well-small">
                  <a href='../asignatura' title='Listado de Asignaturas'>Listado de Asignaturas</a>
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