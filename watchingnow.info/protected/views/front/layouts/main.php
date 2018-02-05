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

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/front.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-lightness/jquery-ui-1.10.3.custom.css" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300&subset=latin,cyrillic,cyrillic-ext' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/e7da3d3b/jquery.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui/development-bundle/ui/jquery-ui.custom.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/autocomplete.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/js.js"></script>
	<title><?php echo Yii::t('t',CHtml::encode($this->pageTitle)); ?></title>
</head>

<body>
<div id="wrap">
	
<div id="header">
<div id="topmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>Yii::t('t','Watching Now').' | ', 'url'=>array('site/index')),
				array('label'=>Yii::t('t','My Films').' | ', 'url'=>array('/films'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('t','WatchList').' | ', 'url'=>array('films/watchlist'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('t','Login').' | ', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('t','Register'), 'url'=>array('/userinfo/register'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('t','Profile').' | ', 'url'=>array('userinfo/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('t','Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				
			),
		)); ?>
		</div>
		<!-- <h1 id="logo"><a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>"><?php echo Yii::t('t','What are you watching now?') ?></a></h1>
		 -->
	</div><!-- header -->
<div class="wrapper">	


	<?php echo $content; ?>


<div id="feed"> 
<?php $this->widget('application.components.Feed'); ?>
</div>
</div>

</div>

<div id="footer">
<div id="lang"><ul><li><a href="<?php echo Yii::app()->request->baseUrl; ?>/lang/en">en | </a></li><li><a href="<?php echo Yii::app()->request->baseUrl; ?>/lang/ru">ru</a></li></ul></div>
		Copyright &copy; <?php echo date('Y',time());?> Watchingnow.info All rights reserved.
	</div><!-- footer -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55391179-1', 'auto');
  ga('send', 'pageview');

</script>	
</body>
</html>
