<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<p align="center">Por favor, ingrese sus datos de usuario y contraseña</p>

<div class="form" align="center">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note" align="center">Los datos con <span class="required">*</span> son requeridos</p>

	<div class="row" align="center">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row" align="center">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>		
	</div>

	<div class="row rememberMe" align="center">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo '<p align="left">&nbsp;Recordar contraseña</p>'; ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons" align="center">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
