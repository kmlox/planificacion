<?php
$this->breadcrumbs=array(
	'Alumnos'=>array('index'),
	'Crear',
);

$this->menu=array(
array('label'=>'Listado de Alumnos','url'=>array('index')),
array('label'=>'Administración de Alumnos','url'=>array('admin')),
);

if(!empty($_POST['id_alumno'])){
    
    $id_alumno=$_POST['id_alumno'];
    $usuario=Usuario::model()->findAll("id_usuario='".$id_alumno."'");
    $nombre_alumno='';
    foreach($usuario as $datos){
        $nombre_alumno=$datos->nombre_usuario;
    }
    
    echo '<h1>Curso del alumno</h1>';
    echo '<h2 align="center">'.$nombre_alumno.'</h2><br>';
    echo $this->renderPartial('_form2', array('model'=>$model,'id_alumno'=>$id_alumno));     
    
}
else{
    echo '<h1>Carga Masiva de Alumnos</h1>';
    echo $this->renderPartial('_form', array('model'=>$model)); 
}

?>

