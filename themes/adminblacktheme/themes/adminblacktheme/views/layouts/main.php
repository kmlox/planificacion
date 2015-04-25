<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <link rel="stylesheet" type= "text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yuigrids.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/pager.css" />    
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="mybanner">
	<div id="header">
    <div id="logo"><?php echo Yii::app()->name; ?></div>
    </div>
<div id="mainmenu">
      <?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('site/index')),
                array('label'=>'User', 'url'=>array('user/index')),                
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Profile', 'url'=>array('/user/view','id'=>Yii::app()->user->getId()), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		));
      ?>
	
</div>
<div class="container" id="page">


    <div class="thebreadcrumbs">
	
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
    'homeLink' => CHtml::link('Home', Yii::app()->createAbsoluteUrl('site/index')),
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->
    </div>
    
    <div style="height:1px; background: #c0c0c0; border-bottom:1px solid #fff;"></div>
    <div class="thecontent">
    
	<?php echo $content; ?>
    
    </div>
    <div style="height:1px; background: #c0c0c0; border-bottom:1px solid #fff;"></div>
	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by <a href="http://www.bsourcecode.com/" rel="external">BSOURCECODE.COM</a>.<br/>
		All Rights Reserved.<br/>
		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>