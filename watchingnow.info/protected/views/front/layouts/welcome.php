<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/images/ico4.ico" rel="shortcut icon">
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/welcome.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-lightness/jquery-ui-1.10.3.custom.css" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300&subset=latin,cyrillic,cyrillic-ext' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/e7da3d3b/jquery.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui/development-bundle/ui/jquery-ui.custom.js"></script>
	
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.parallax.js"></script>

	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.scrollTo.js"></script>
	

	<title><?php echo Yii::t('t',CHtml::encode($this->pageTitle)); ?></title>
</head>

<body>
<?php echo $content; ?>
<?php echo CHtml::link(Yii::t('t','Sign Up Now'),array('userinfo/register'),array('class'=>'register')); ?> 
<div id="footer">
	
	
 <!--<div id="lang"><ul><li><a href="<?php echo Yii::app()->request->baseUrl; ?>/lang/en">en | </a></li><li><a href="<?php echo Yii::app()->request->baseUrl; ?>/lang/ru">ru</a></li></ul></div>-->
		Copyright &copy; Watchingnow.info
	</div><!-- footer -->
</body>
</html>
