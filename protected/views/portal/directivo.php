<!----------------------------------------------------------------------->
<h1>Portal Directivo</h1>
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
                <a href='../usuario/admin' title='Control de Planificaciones'>Control de Planificaciones</a>
            </div> 
            <div class="well well-small">
                <a href='../planificacion/admin' title='Administración de Planificaciones'>Administracion de Planificaciones</a>
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
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordeon" href="#collapse_cuatro">
                    Informes<br><br>
                </a>
            </h4>
         </div>
         <div id="collapse_cuatro" class="panel-collapse collapse">
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
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordeon" href="#collapse_cinco">
                    Cuenta<br><br>
                </a>
            </h4>
         </div>
         <div id="collapse_cinco" class="panel-collapse collapse">
             <div class="panel-body">
                <div class="well well-small">
                  <a href='../usuario/configuracion' title='Cambiar password'>Cambiar password</a>
                </div>
            </div>
         </div>
    </div>
</div>