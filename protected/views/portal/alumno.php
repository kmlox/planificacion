<!----------------------------------------------------------------------->
<h1>Portal Alumno</h1>
<div class="panel-group" id="acordeon">
   
    <div class="panel panel-default">
         <div class="panel-heading">
            <h4 class="panel-title">
                <img style="float: left; width: 64px; height: 64px;" 
                  src=<?php echo Yii::app()->baseUrl.'/images/portal/notas.png '?>alt="64x64"
                  accesskey=""class="img-circle"/>  
                <br>&nbsp;&nbsp;
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordeon" href="#collapse_cuatro">
                    Mis Notas<br><br>
                </a>
            </h4>
         </div>
         <div id="collapse_cuatro" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="well well-small">
                    <a href='../alumno' title='Informe por Alumno'>Informe por Alumno</a>
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