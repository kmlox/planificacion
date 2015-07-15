<?php
	Yii::app()->clientscript		
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="language" content="en" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le styles -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/web/logo.ico" type="image/x-icon" />
</head>

<body>
	<!--div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#"><?php /* echo Yii::app()->name ?></a>
				<div class="nav-collapse">
					<?php $this->widget('zii.widgets.CMenu',array(
						'htmlOptions' => array( 'class' => 'nav' ),
						'activeCssClass'	=> 'active',
						'items'=>array(
							array('label'=>'Inicio', 'url'=>array('/site/index')),
							//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                                                        array('label'=>'Menú Profesor', 'url'=>array('/profesor')),
                                                        array('label'=>'Planificaciones', 'url'=>array('/planificacion')),
                                                        array('label'=>'Alumno', 'url'=>array('/alumno')),
                                                        array('label'=>'Evaluaciones', 'url'=>array('/evaluacion')),
                                                        array('label'=>'OA', 'url'=>array('/oA')),
                                                        array('label'=>'Indicadores', 'url'=>array('/indicador')),
                                                        array('label'=>'AE', 'url'=>array('/aE')),
                                                        array('label'=>'CMO', 'url'=>array('/cMO')),
                                                        array('label'=>'OFV', 'url'=>array('/oFV')),
                                                        array('label'=>'Contacto', 'url'=>array('/site/contact')),
							array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
						),
					)); */?>
					
				</div>
			</div>
		</div>
	</div-->
    
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../"><?php echo Yii::app()->name ?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php $this->widget('zii.widgets.CMenu',array(
						'encodeLabel' => false,
    'htmlOptions' => array('class' => 'nav'),
						'items'=>array(
                                                    array('label'=>'Inicio', 'url'=>array("../..".Yii::app()->baseUrl)),
                                                        /*array('label'=>'Planificaciones', 'url'=>array('/planificacion')),
                                                        array('label'=>'Evaluaciones', 'url'=>array('/evaluacion')),
                                                        array(
                                                            'label' => 'Mis Items<b class="caret"></b>',
                                                            'url' => '#',
                                                            'submenuOptions' => array('class' => 'dropdown-menu','role'=>'menu'),
                                                            'items' => array(
                                                                array(
                                                                    'label' => 'OA',
                                                                    'url' => array('/oA'),
                                                                ),
                                                                array(
                                                                    'label' => 'Indicadores',
                                                                    'url' => array('/indicador'),
                                                                ),
                                                                array(
                                                                    'label' => 'AE',
                                                                    'url' => array('/aE'),
                                                                ),
                                                                array(
                                                                    'label' => 'CMO',
                                                                    'url' => array('/cMO'),
                                                                ),
                                                                array(
                                                                    'label' => 'OFV',
                                                                    'url' => array('/oFV'),
                                                                ),
                                                            ),
                                                            'itemOptions' => array('class' => 'dropdown'),
                                                            'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown','role'=>'button','aria-expanded'=>"false"),
                                                            
                                                        ),
                                                    array(
                                                            'label' => 'Reportes<b class="caret"></b>',
                                                            'url' => '#',
                                                            'submenuOptions' => array('class' => 'dropdown-menu','role'=>'menu'),
                                                            'items' => array(
                                                                array(
                                                                    'label' => 'Notas Alumno',
                                                                    'url' => array('/informealumno'),
                                                                ),
                                                                array(
                                                                    'label' => 'Notas Curso',
                                                                    'url' => array('/informecurso'),
                                                                ),                                                                
                                                            ),
                                                            'itemOptions' => array('class' => 'dropdown'),
                                                            'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown','role'=>'button','aria-expanded'=>"false"),
                                                            
                                                        ),
                                                         * 
                                                         */
                                                        array('label'=>'Contacto', 'url'=>array('/site/contact')),
                                                        array('label'=>'Acerca de este Sitio', 'url'=>array('/site/acerca')),
							//array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                                        
						),
                        
					)); 
                    ?>
                    
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
	<div class="cont">
	<div class="container-fluid">
	  <?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				'homeLink'=>false,
				'tagName'=>'ul',
				'separator'=>'',
				'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
				'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
				'htmlOptions'=>array ('class'=>'breadcrumb')
			)); ?>
		<!-- breadcrumbs -->
	  <?php endif?>
	
	<?php echo $content ?>
	
	
	</div><!--/.fluid-container-->
	</div>
	
	<div class="extra">
	  <div class="container">
		<div class="row">
			<div align="center">
				<h4>Planifica</h4>
				<ul>
					<li><img src=<?php echo Yii::app()->baseUrl."/images/web/logo.png " ?>alt="HTML5Icon" style="width:90px;height:90px;"></li>
					
				</ul>
			</div> <!-- /span3 -->
			
			
			</div> <!-- /row -->
		</div> <!-- /container -->
	</div>
	
	<div class="footer">
	  <div class="container">
		<div class="row">
			<div id="footer-copyright" class="col-md-6">
				Planifica V.<?php echo date('Y'); ?> 
			</div> <!-- /span6 -->
			<div id="footer-terms" class="col-md-6">
				Copyright &copy; <?php echo date('Y'); ?> 
			</div> <!-- /.span6 -->
		 </div> <!-- /row -->
	  </div> <!-- /container -->
	</div>
</body>
</html>
