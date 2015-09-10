<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<style type="text/css">
  .uneditable-input {
  display: inline-block;
  height: 28px;
  padding: 4px;
  margin-bottom: 9px;
  font-size: 13px;
  line-height: 18px;
  color: #555555;
  width: initial;
  float: none;  
}
form label {  
  float: none;
  width: 140px;
  padding-top: 5px;
  text-align: left;
}
</style>

<h1>Login</h1>

<p class="bg-success" align="center">Por favor, ingrese sus datos de usuario y contraseña</p><br>

<div class="form" align="center">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<!--p class="note" align="center">Los datos con <span class="required">*</span> son requeridos</p-->

	<div class="row" align="center">
		<?php echo "Usuario<br>"; //$form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row" align="center">
		<?php echo "Contraseña<br>"; //$form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>		
	</div>
    <br><br>
	<div align="center">
        <?php  $this->widget(
        'booster.widgets.TbButton',
        array(
            'label' => 'Iniciar Sesión',
            'context' => 'primary',
            'buttonType'=>'submit',
            
        )
        );  ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
