<?php
    $this->breadcrumbs=array(
            'Profesor',
            'Crear',
    );
    /*
    $this->menu=array(
    array('label'=>'List Profesor','url'=>array('index')),
    array('label'=>'Manage Profesor','url'=>array('admin')),
    );
     * 
     */
    $id_profesor=$_POST['id_profesor'];
    $usuario=Usuario::model()->findAll("id_usuario='".$id_profesor."'");
    $nombre_profesor='';
    foreach($usuario as $datos){
        $nombre_profesor=$datos->nombre_usuario;
    }
 ?>


<h1>Asignaturas del Profesor(a)</h1>
<h2 align="center"><?php echo $nombre_profesor;?></h2><br>

<?php 

echo $this->renderPartial('_form', array('model'=>$model,'id_profesor'=>$id_profesor)); 
?>