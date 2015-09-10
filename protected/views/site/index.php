<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
  
<div class="jumbotron">
  <h1>Planifica V.2015</h1>
  <h2 align="center">Crea, Organiza, Administra e Informa</h2>
 </div>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!--slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src=<?php echo Yii::app()->baseUrl."/images/web/slide1.jpg"?> alt="...">     
    </div>
    <div class="item">
      <img src=<?php echo Yii::app()->baseUrl."/images/web/slide2.jpg"?> alt="...">
    </div>
    <div class="item">
      <img src=<?php echo Yii::app()->baseUrl."/images/web/slide3.jpg"?> alt="...">
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
  </a>
</div>
  
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src=<?php echo Yii::app()->baseUrl."/images/web/plan.jpg"?> alt="plan" style="width:370px;height:210px;">
          <div class="caption">
            <h3>Portal Directivos</h3>
            <p>Lleve un control completo de las planificaciones de su colegio
            con la posibilidad de generar informes.
            <p><a href="index.php/portal/directivo" class="btn btn-primary" role="button">Ingresar</a></p>
          </div> 
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src=<?php echo Yii::app()->baseUrl."/images/web/clases.jpg"?> alt="clases" style="width:370px;height:210px;">
          <div class="caption">
            <h3>Portal Profesor</h3>
            <p>Cree y organice sus planificaciones curriculares
            <br>Clase a clase, por unidad, o anual.
            <p><a href="index.php/portal/profesor" class="btn btn-success" role="button">Ingresar</a></p>
          </div> 
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src=<?php echo Yii::app()->baseUrl."/images/web/asignaturas.jpg"?> alt="asignaturas" style="width:370px;height:210px;">
          <div class="caption">
            <h3>Portal Alumno</h3>
            <p>En este portal puedes llevar un seguimiento de tus calificaciones para todas las asignaturas</p>
            <p><a href="index.php/portal/alumno" class="btn btn-warning" role="button">Ingresar</a></p>
           </div> 
        </div>
    </div>
</div>

