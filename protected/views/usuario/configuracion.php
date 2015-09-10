<?php
/* @var $this UsuarioController */
$this->pageTitle='configuracion';

$this->breadcrumbs=array(
	//'Usuario'=>array('/usuario'),
	'Cambiar Password',
);
echo '<br>'.$msg;
?>
<h1>Cambiar Password</h1>
<div class="form">
    <?php
        $form = $this->beginWidget("CActiveForm",
        array(
            'method'=>'POST',
            'action'=>Yii::app()->createUrl('usuario/configuracion'),
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            )
        ));
    ?>  
<div class="row">
    <?php
    echo $form->labelEx($model,'password');
    echo $form->passwordField($model, 'password');
    echo $form->error($model,'password',array('class'=>'text-error'));
    ?>
</div>
<div class="row">
    <?php
    echo $form->labelEx($model,'nuevo_password');
    echo $form->passwordField($model, 'nuevo_password');
    echo $form->error($model,'nuevo_password',array('class'=>'text-error'));
    ?>
</div>
<div class="row">
    <?php
    echo $form->labelEx($model,'repetir_nuevopassword');
    echo $form->passwordField($model, 'repetir_nuevopassword');
    echo $form->error($model,'repetir_nuevopassword',array('class'=>'text-error'));
    ?>
</div>
<div class="row">
    <?php
    echo CHtml::submitButton('Guardar password',array('class'=>'btn btn-primary'));
    ?>
</div>
    <?php 
        $this->endWidget();
    ?>
</div>