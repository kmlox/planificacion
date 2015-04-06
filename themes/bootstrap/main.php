<!DOCTYPE html>
 
<html lang="<?php echo Yii::app()->language;?>">
 
<head>
 
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
 
 <meta charset="<?php echo Yii::app()->charset;?>">
 
</head>
 
<body>
 
<header>
<?php
$this->widget('bootstrap.widgets.TbNavbar', array(
 'type'=>'inverse', // null or 'inverse'
 'brand'=>CHtml::encode(Yii::app()->name),
 'brandUrl'=>array('/site/index'),
 'collapse'=>true, // requires bootstrap-responsive.css
 'items'=>array(
 array(
 'class'=>'bootstrap.widgets.TbMenu',
 'items'=>array(
 array('label'=>'Aviso Legal', 'url'=>array('/site/page', 'view'=>'disclaimer')),
 array('label'=>'Contáctenos', 'url'=>array('/site/contact')),
 array('label'=>'FAQs' , 'url'=>array('/faqs/index'), 'visible'=>!Yii::app()->user->isGuest),
 ),
 ),
 array(
 'class'=>'bootstrap.widgets.TbMenu',
 'htmlOptions'=>array('class'=>'pull-right'),
 'items'=>array(
 array('label'=>'Iniciar sesión'
 , 'url'=>Yii::app()->user->ui->loginUrl
 , 'visible'=>Yii::app()->user->isGuest),
 array('label'=>Yii::app()->user->name,
 'url'=>array('/cruge/ui/editprofile/'),
 'visible'=>!Yii::app()->user->isGuest),
 array('label'=>'Cerrar sesión ('.Yii::app()->user->name.')'
 , 'url'=>Yii::app()->user->ui->logoutUrl
 , 'visible'=>!Yii::app()->user->isGuest),
 // array('label'=>'Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'htmlOptions'=>array('class'=>'btn'))
 ),
 ),
 ),
));
?>
</header>
<div class="container" id="main">
 <?php if(isset($this->breadcrumbs)):?>
 <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
 'links'=>$this->breadcrumbs,
 )); ?>
 <?php endif?>
 <?php echo $content; ?>
 <hr>
 <footer>
 Copyright &copy; <?php echo date('Y'); ?> <?php echo CHtml::encode(Yii::app()->params['empresa']); ?> | <?php echo CHtml::encode((Yii::app()->name).' '.Yii::app()->params['version']); ?> - All Rights Reserved.<br/>
 <?php echo Yii::powered(); ?>
 </footer>
 
</div>
</body>
</html>