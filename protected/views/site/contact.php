<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contacto';
$this->breadcrumbs=array(
	'Contacto',
);
?>

<h1>Contacto</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
Si ud tiene consultas, recomendaciones, inscripciones al sistema o experiencias, por favor complete el formulario. Muchas gracias.
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="help-block">Datos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
        <br>
        
	<div class="row">
		<?php echo "Nombre";//$form->labelEx($model,'name'); ?><span class="required">*</span><br>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo "Email";//$form->labelEx($model,'email'); ?><span class="required">*</span><br>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo "Asunto";//$form->labelEx($model,'subject'); ?><span class="required">*</span><br>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo "Mensaje";//$form->labelEx($model,'body'); ?><span class="required">*</span><br>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php //echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?><br>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Por favor digite las letras que aparecen en la imagen.
		</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>
        <br>
	<div align="left">
        <?php  $this->widget(
        'booster.widgets.TbButton',
        array(
            'label' => 'Enviar Información',
            'context' => 'primary',
            'buttonType'=>'submit',
            
        )
        );  ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>